<?php 

/**
* 
*/
class Admin extends MX_Controller
{
        var $idUser;
        var $data = array();
        var $user = array();
    function __construct()
    {
        // if ($this->session->userdata('journal_login') != true) {
        //     redirect('journal/login');
        // }
        if(!isset($_COOKIE['data_journal']) || decode_token_jwt($_COOKIE['data_journal']) != true){
            redirect(site_url('journal/login'));
        }
        $this->user = data_jwt($_COOKIE['data_journal']);
    }

    public function index(){
        
        $this->data['breadcumb'] = 'Journal';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_layout',$this->data);
    }

    public function home(){
        $user = $this->user->user;
        $data = $this->db->get_where('tb_instansi',array('id_instansi'=>$user->id_instansi))->row_array();
        // print_r($user->id_instansi);
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ? and j.status = 2";
        $journal = $this->db->query($sql,$user->id_instansi)->num_rows();
        $active = $journal;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ? and j.status = 1";
        $journal = $this->db->query($sql,$user->id_instansi)->num_rows();
        $pending = $journal;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ? and j.status = 3";
        $journal = $this->db->query($sql,$user->id_instansi)->num_rows();
        $ignore = $journal;
        $this->data['breadcumb'] = 'Journal';
        $this->data['view'] = 'list';
        $this->data['active'] = $active;
        $this->data['pending'] = $pending;
        $this->data['ignore'] = $ignore;
        $this->data['user'] = $data['nm_instansi'];
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'dashboard_layout',$this->data);
    }

    public function myjournal()
    {
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['breadcumb'] = 'My Journal';
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'journal_layout',$this->data);
    }

    public function dashboard(){
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $this->db->select('tb_artikel.*,tb_volume.volume,tb_no_volume.publish,tb_journal.judul as judul_journal,tb_pengguna.status as status_user,tb_pengguna.id_pengguna');
        $this->db->from('tb_artikel');
        $this->db->join('tb_no_volume', 'id_no_volume_ref = id_no_volume');
        $this->db->join('tb_volume', 'id_volume_ref = id_volume');
        $this->db->join('tb_journal', 'id_journal_ref = id_journal');
        $this->db->join('tb_pengguna', 'tb_journal.id_user_ref = id_pengguna');
        $this->db->where('tb_pengguna.id_instansi_ref',$user->id_instansi);
        $this->db->order_by('id_artikel', 'desc');
        $this->db->limit('4');
        $a = $this->db->get()->result_array();
        // print_r($a);
        foreach ($a as $key => $value) {
            $author = $this->db->get_where('tb_author',array('id_artikel_ref'=>$value['id_artikel']))->result_array();
            $a[$key]['author'] = $author[0]['nama'];
            if ($value['status_user'] == 0) {
                $p = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $a[$key]['publisher'] = $p['nama'];
            }else{
                $p = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $a[$key]['publisher'] = $p['nama'];
            }
        }
        $this->data['breadcumb'] = 'My Journal';
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->data['artikel'] = $a;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'journal_layout',$this->data);
    }

    public function alljournal()
    {
        
         $sql = "SELECT * FROM tb_journal Where status = 2";
        $journal = $this->db->query($sql)->result_array();
        // foreach ($journal as $key => $value) {
        //     $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
        //     $journal[$key]['jumlah'] = $jumlah;
        // }
        // print_r($journal);
        $this->db->select('tb_artikel.*,tb_volume.volume,tb_no_volume.publish,tb_journal.judul as judul_journal,,tb_pengguna.status as status_user,tb_pengguna.id_pengguna');
        $this->db->from('tb_artikel');
        $this->db->join('tb_no_volume', 'id_no_volume_ref = id_no_volume');
        $this->db->join('tb_volume', 'id_volume_ref = id_volume');
        $this->db->join('tb_journal', 'id_journal_ref = id_journal');
        $this->db->join('tb_pengguna', 'tb_journal.id_user_ref = id_pengguna');
        $this->db->where('tb_journal.status',2);
        $this->db->order_by('id_artikel', 'desc');
        $this->db->limit('4');
        $a = $this->db->get()->result_array();
        foreach ($a as $key => $value) {
            $author = $this->db->get_where('tb_author',array('id_artikel_ref'=>$value['id_artikel']))->result_array();
            $a[$key]['author'] = $author[0]['nama'];
            if ($value['status_user'] == 0) {
                $p = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $a[$key]['publisher'] = $p['nama'];
            }else{
                $p = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $a[$key]['publisher'] = $p['nama'];
            }
        }
        $this->data['view'] = 'list';
        $this->data['artikel'] = $a;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'all_journal_layout',$this->data);
    }

    public function add(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Journal', 'trim|required');
            $this->form_validation->set_rules('content', 'Deskripsi Journal', 'trim|required');
            $this->form_validation->set_rules('kategori', 'kategori Journal', 'trim|required');
            $this->form_validation->set_rules('user', 'user Journal', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['slug'] = $this->slugify($this->input->post('judul'));
                $data_news['deskripsi'] = $this->input->post('content');
                $data_news['issn'] = $this->input->post('issn');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                $data_news['id_user_ref'] = $this->input->post('user');
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->insert('tb_journal',$data_news)) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('journal/admin/dashboard');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['kategori'] = form_error('kategori');
            $ret['notif']['user'] = form_error('user');
            if (!isset($_FILES['file_name'])) {
             $ret['notif']['file_name'] = "Please Select File";
            }
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '656px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'add';
        $this->data['kategori'] = $this->db->get('tb_kategori_journal')->result_array();
        $user = $this->user->user;
        $us =  $this->db->get_where('tb_pengguna',array('id_instansi_ref'=>$user->id_instansi))->result_array();
        foreach ($us as $key => $value) {
            if ($value['status'] == 0) {
                $m = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $us[$key]['nama'] = $m['nama'];
            }else{
                $d = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$value['id_pengguna']))->row_array();
                $us[$key]['nama'] = $d['nama'];
            }
        }
        $this->data['user'] = $us;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'journal_action',$this->data);
    }

    public function edit($id=null){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Journal', 'trim|required');
            $this->form_validation->set_rules('content', 'Deskripsi Journal', 'trim|required');
            $this->form_validation->set_rules('kategori', 'kategori Journal', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['slug'] = $this->slugify($this->input->post('judul'));
                $data_news['deskripsi'] = $this->input->post('content');
                $data_news['issn'] = $this->input->post('issn');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                // $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->update('tb_journal',$data_news,array('id_journal'=>$id))) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('journal/admin/dashboard');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }else{
                    $ret['state'] = 1;
                    // $data_news['futured_image'] = $image['asli'];
                    if ($this->db->update('tb_journal',$data_news,array('id_journal'=>$id))) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('journal/admin/dashboard');
                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['kategori'] = form_error('kategori');
            // if (!isset($_FILES['file_name'])) {
            //  $ret['notif']['file_name'] = "Please Select File";
            // }
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '656px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'edit';
        $this->data['journal'] = $this->db->get_where('tb_journal',array('id_journal'=>$id))->row_array();
        $this->data['kategori'] = $this->db->get('tb_kategori_journal')->result_array();
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'journal_action',$this->data);
    }

    public function detail_journal($id=null){
        $sql = 'SELECT * FROM tb_journal where id_journal = ?';
        $journal = $this->db->query($sql,$id)->row_array();
        $sql = "SELECT j.*, v.id_volume, v.volume FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where j.id_journal = ".$id;
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['journal'] = $journal;
        $this->data['volume'] = $data;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_journal_layout',$this->data);

    }

    public function detail_volume($id=null){
        $sql = 'SELECT j.*, v.volume FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref where id_volume = ?';
        $journal = $this->db->query($sql,$id)->row_array();
        $sql = 'SELECT j.*, v.id_volume, v.volume, n.* FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['no_volume'] = $data;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_volume_layout',$this->data);
    }

    public function detail_no_volume($id=null){
        $sql = 'SELECT j.*,j.status as jstatus,v.volume,n.nomor FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref where id_no_volume = ?';
        $journal = $this->db->query($sql,$id)->row_array();
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['artikel'] = $data;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_no_volume_layout',$this->data);
    }

    public function add_artikel(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $nama_c = str_replace(',', '', $this->input->post('nama'));
            $jabatan_c = str_replace(",","", $this->input->post('jabatan'));
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Artikel', 'trim|required');
            $this->form_validation->set_rules('content', 'Abstraksi Artikel', 'trim|required');
            $this->form_validation->set_rules('journal', 'Journal Artikel', 'trim|required');
            $this->form_validation->set_rules('volume', 'Volume Artikel', 'trim|required');
            $this->form_validation->set_rules('no_volume', 'No Volume Artikel', 'trim|required');
            $this->form_validation->set_rules('keyword', 'Keywords Artikel', 'trim|required');
            $this->form_validation->set_rules('ref', 'References Artikel', 'trim|required');
            $this->form_validation->set_rules('nama', 'Nama Autho', 'trim|required');
            $this->form_validation->set_rules('jabatan', 'Jabatan Author', 'trim|required');
            $this->form_validation->set_rules('agree', 'agrrement', 'trim|required');
            
            if ($this->form_validation->run() == true && $nama_c !='' && $jabatan_c != '') {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['abstrak'] = $this->input->post('content');
                $data_news['keyword'] = $this->input->post('keyword');
                $data_news['references'] = $this->input->post('ref');
                $us = $this->db->get_where('tb_journal',array('id_journal'=>$this->input->post('journal')))->row_array();
                $data_news['id_user_ref'] = $us['id_user_ref'];
                $data_news['id_no_volume_ref'] = $this->input->post('no_volume');
                $cekjournal = $this->db->get_where('tb_journal',array('id_journal'=>$this->input->post('journal')))->row_array();
                if ($cekjournal['status'] == 1 ) {
                    $ret['notif']['journal'] = 'Journal dalam tahap persetujuan, tidak dapat menambah artikel baru';
                    echo json_encode($ret);
                    exit();
                }
                if (isset($_FILES['file_name']) && isset($_FILES['file_name_abs'])) {
                    // print_r($_FILES['file_name']);
                    // print_r($_FILES['file_name_abs']);
                    $file = $this->upload_file($_FILES['file_name']);
                    $file_abs = $this->upload_file_abstract($_FILES['file_name_abs']);
                    // print_r($file);
                    // print_r($file_abs);
                    // return false;
                    if (isset($file['error']) || isset($file_abs['abs_error'])) {
                        if (isset($file['error'])) {
                            $ret['notif'] = $file;
                        }
                        if (isset($file_abs['abs_error'])) {
                            $ret['notif'] = $file_abs;
                            print_r($file_abs);
                        }
                    }else{
                        $ret['state'] = 1;
                        $data_news['file'] = $file;
                        $data_news['abstract_file'] = $file_abs;
                        if ($this->db->insert('tb_artikel',$data_news)) {
                            $data_author['id_artikel_ref'] = $this->db->insert_id();
                            $nama = explode(",", $this->input->post('nama'));
                            $jabatan = explode(",", $this->input->post('jabatan'));
                            for ($i=0; $i < count($nama) ; $i++) { 
                                $data_author['nama'] = $nama[$i];
                                if($nama[$i] != ''){
                                    if (isset($jabatan[$i]) && $jabatan[$i] != '') {
                                        $data_author['jabatan'] = $jabatan[$i];
                                        $this->db->insert('tb_author',$data_author);
                                        $ret['status'] = 1;
                                        $ret['url'] = site_url('journal/admin');
                                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                                    }
                                }
                            }
                        }
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['volume'] = form_error('volume');
            $ret['notif']['journal'] = form_error('journal');
            $ret['notif']['no_volume'] = form_error('no_volume');
            $ret['notif']['keyword'] = form_error('keyword');
            $ret['notif']['ref'] = form_error('ref');
            $ret['notif']['agree'] = form_error('agree');
            $ret['notif']['nama'] = form_error('nama');
            $ret['notif']['jabatan'] = form_error('jabatan');
            if ($nama_c == '') {
                $ret['notif']['nama'] = 'please fill one column';
            }
            if ($jabatan_c == '') {
                $ret['notif']['jabatan'] = 'please fill one column';
            }
            if (!isset($_FILES['file_name'])) {
             $ret['notif']['file_name'] = "Please Select File";
            }
            if (!isset($_FILES['file_name_abs'])) {
             $ret['notif']['file_name_abs'] = "Please Select File";
            }
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '656px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'add';
        // $this->data['breadcumb'] = $journal['judul'];
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'artikel_layout',$this->data);
    }

    public function edit_artikel($id=null){
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            // print_r($this->data['user'])
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Artikel', 'trim|required');
            $this->form_validation->set_rules('content', 'Abstraksi Artikel', 'trim|required');
            $this->form_validation->set_rules('journal', 'Journal Artikel', 'trim|required');
            $this->form_validation->set_rules('volume', 'Volume Artikel', 'trim|required');
            $this->form_validation->set_rules('no_volume', 'No Volume Artikel', 'trim|required');
            $this->form_validation->set_rules('keyword', 'Keywords Artikel', 'trim|required');
            $this->form_validation->set_rules('ref', 'References Artikel', 'trim|required');
            $this->form_validation->set_rules('agree', 'agrrement', 'trim|required');
            // $this->form_validation->set_rules('nama', 'Nama Autho', 'trim|required');
            // $this->form_validation->set_rules('jabatan', 'Jabatan Author', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['abstrak'] = $this->input->post('content');
                $data_news['keyword'] = $this->input->post('keyword');
                $data_news['references'] = $this->input->post('ref');
                $data_news['status'] = 0;
                // $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                $data_news['id_no_volume_ref'] = $this->input->post('no_volume');
                $cekjournal = $this->db->get_where('tb_journal',array('id_journal'=>$this->input->post('journal')))->row_array();
                if ($cekjournal['status'] == 1 ) {
                    // $this->db->update('tb_journal',array('status'=>0))
                    $ret['notif']['journal'] = 'Journal dalam tahap persetujuan, tidak dapat menambah artikel baru';
                    echo json_encode($ret);
                    exit();
                }
                $ret['state_file'] = 1;
                $ret['state_abs'] = 1;
                if (isset($_FILES['file_name'])) {
                    if (file_exists(FCPATH."assets/file/".$artikel['file'])) {
                        @chmod(FCPATH."assets/file/".$artikel['file'], 0777);
                        unlink(FCPATH."assets/file/".$artikel['file']);
                    }
                    $file = $this->upload_file($_FILES['file_name']);
                    // $ret['bbb'] = $file;
                    if (isset($file['error'])) {
                        $ret['notif'] = $file;
                        $ret['state_abs'] = 0;
                    }else{
                        $ret['state_file'] = 1;
                        $data_news['file'] = $file;
                    }
                }
                if(isset($_FILES['file_name_abs'])){
                    if (file_exists(FCPATH."assets/file/abstract/".$artikel['abstract_file'])) {
                        @chmod(FCPATH."assets/file/abstract/".$artikel['abstract_file'], 0777);
                        unlink(FCPATH."assets/file/abstract/".$artikel['abstract_file']);
                    }
                    $file_abs = $this->upload_file_abstract($_FILES['file_name_abs']);
                    // $ret['aaa'] = $file_abs;
                    if (isset($file_abs['abs_error'])) {
                        $ret['notif'] = $file_abs;
                        $ret['state_abs'] = 0;
                    }else{
                        $ret['state_abs'] = 1;
                        $data_news['abstract_file'] = $file_abs;
                    }
                }
                if($ret['state_abs'] == 1 && $ret['state_file'] == 1){
                    if ($this->db->update('tb_artikel',$data_news,array('id_artikel'=>$id))) {
                    // print_r('data_news');
                        if ($this->input->post('nama') != '') {
                            $data_author['id_artikel_ref'] = $id;
                            $nama = explode(",", $this->input->post('nama'));
                            $jabatan = explode(",", $this->input->post('jabatan'));
                            for ($i=0; $i < count($nama) ; $i++) { 
                                $data_author['nama'] = $nama[$i];
                                if (isset($jabatan[$i]) && $jabatan[$i] != '') {
                                    $data_author['jabatan'] = $jabatan[$i];
                                    $this->db->insert('tb_author',$data_author);
                                    $ret['status'] = 1;
                                    $ret['url'] = site_url('journal/admin/dashboard');
                                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                                }
                            }
                        }else{
                            $ret['status'] = 1;
                            $ret['url'] = site_url('journal/admin/dashboard');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['volume'] = form_error('volume');
            $ret['notif']['journal'] = form_error('journal');
            $ret['notif']['no_volume'] = form_error('no_volume');
            $ret['notif']['keyword'] = form_error('keyword');
            $ret['notif']['ref'] = form_error('ref');
            $ret['notif']['agree'] = form_error('agree');
            // $ret['notif']['nama'] = form_error('nama');
            // $ret['notif']['jabatan'] = form_error('jabatan');
            // if (!isset($_FILES['file_name'])) {
            //  $ret['notif']['file_name'] = "Please Select File";
            // }
            echo json_encode($ret);
            exit();
        }
        
        // $author = '';
        $sql_author = 'SELECT * FROM tb_author where id_artikel_ref = ?';
        $author = $this->db->query($sql_author,$id)->result_array();
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '656px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'edit';
        // $this->data['breadcumb'] = $journal['judul'];
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['artikel'] = $artikel;
        $this->data['author'] = $author;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'artikel_layout_edit',$this->data);
    }

    public function save_author($id=null){
        $input = $this->input->post();
        $ret['status'] = 0;
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $this->form_validation->set_rules('nama', 'Nama Autho', 'trim|required');
            $this->form_validation->set_rules('jabatan', 'Jabatan Author', 'trim|required');
            if ($this->form_validation->run() == true) {
                $data['nama'] = $input['nama'];
                $data['jabatan'] = $input['jabatan'];
                $au['id_author'] = $id;
                if ($this->db->update('tb_author',$data,$au)) {
                    $ret['status'] = 1;
                }
            }
            $ret['notif']['nama'] = form_error('nama');
            $ret['notif']['jabatan'] = form_error('jabatan');
            echo json_encode($ret);
        }
    }

    public function delete_author($id=null){
        $ret['status'] = 0;
        if ($this->db->delete('tb_author',array('id_author'=>$id))) {
            $ret['status'] = 1;
        }
        echo json_encode($ret);
    }

    public function add_volume(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            // print_r($this->data['user'])
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('volume', 'Nomor Volume', 'trim|required');
            $this->form_validation->set_rules('journal', 'Journal Volume', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['volume'] = $this->input->post('volume');
                $data_news['id_journal_ref'] = $this->input->post('journal');
                if ($this->db->insert('tb_volume',$data_news)) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('journal/admin/volume');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['volume'] = form_error('volume');
            $ret['notif']['journal'] = form_error('journal');
            echo json_encode($ret);
            exit();
        }
        $this->data['view'] = 'add';
        // $this->data['breadcumb'] = $journal['judul'];
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'create_volume_layout',$this->data);
    }

    public function edit_volume($id=null){
        $user = $this->user->user;
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            // print_r($this->data['user'])
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('volume', 'Nomor Volume', 'trim|required');
            // $this->form_validation->set_rules('journal', 'Journal Volume', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['volume'] = $this->input->post('volume');
                // $data_news['id_journal_ref'] = $this->input->post('journal');
                if ($this->db->update('tb_volume',$data_news,array('id_volume'=>$id))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('journal/admin/volume');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['volume'] = form_error('volume');
            // $ret['notif']['journal'] = form_error('journal');
            echo json_encode($ret);
            exit();
        }
        $this->data['view'] = 'edit';
        // $this->data['breadcumb'] = $journal['judul'];
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $sql = "SELECT * FROM tb_volume WHERE id_volume = ?";
        $no = $this->db->query($sql,$id)->row_array();
        $this->data['volume'] = $no;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'volume_layout',$this->data);
    }

    public function add_no_volume(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            // print_r($this->data['user'])
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('nomor', 'Nomor Volume', 'trim|required');
            $this->form_validation->set_rules('volume', 'Volume', 'trim|required');
            $this->form_validation->set_rules('journal', 'Journal Volume', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['nomor'] = $this->input->post('nomor');
                $data_news['id_volume_ref'] = $this->input->post('volume');
                $data_news['publish'] = date('Y-m-d');
                if ($this->db->insert('tb_no_volume',$data_news)) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('journal/admin/novolume');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['nomor'] = form_error('nomor');
            $ret['notif']['volume'] = form_error('volume');
            $ret['notif']['journal'] = form_error('journal');
            echo json_encode($ret);
            exit();
        }
        $this->data['view'] = 'add';
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'create_no_volume_layout',$this->data);
    }

    public function edit_no_volume($id=null){
        $user = $this->user->user;
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('nomor', 'Nomor Volume', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['nomor'] = $this->input->post('nomor');
                if ($this->db->update('tb_no_volume',$data_news,array('id_no_volume'=>$id))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('journal/admin/novolume');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['nomor'] = form_error('nomor');
            echo json_encode($ret);
            exit();
        }
        $sql = "SELECT * FROM tb_no_volume n join tb_volume v WHERE id_no_volume = ?";
        $no = $this->db->query($sql,$id)->row_array();
        $this->data['nomor'] = $no;
        $this->data['view'] = 'edit';
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ?";
        $journal = $this->db->query($sql,$user->id_instansi)->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'nomor_layout',$this->data);
    }

    public function no_volume($id){
        $volume = $this->db->get_where('tb_no_volume',array('id_volume_ref'=>$id))->result_array();
        $html = '<option value="">-- Pilih No Volume --</option>';
        foreach ($volume as $key => $value) {
            $html .= '<option value="'.$value['id_no_volume'].'">No. '.$value['nomor'].'</option>';
        }
        echo json_encode($html);
    }

    public function select_volume($id){
        $volume = $this->db->get_where('tb_volume',array('id_journal_ref'=>$id))->result_array();
        $html = '<option value="">-- Pilih Volume --</option>';
        foreach ($volume as $key => $value) {
            $html .= '<option value="'.$value['id_volume'].'">Volume. '.$value['volume'].'</option>';
        }
        echo json_encode($html);
    }

    public function submit($id=null){
        $sql = 'SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where j.id_journal = ?';
        if ($this->db->query($sql,$id)->num_rows() > 0) {
            if ($this->db->update('tb_journal',array('status'=>1),array('id_journal'=>$id))) {
                if ($this->db->update('tb_volume',array('status'=>1),array('id_journal_ref'=>$id))) {
                    $this->session->set_flashdata('header','Sukes');
                    $this->session->set_flashdata('notif','Journal berhasil disubmit');
                    redirect('journal/admin');
                }
            }else{
                $this->session->set_flashdata('header','Gagal');
                $this->session->set_flashdata('notif','Journal gagal disubmit');
                redirect('journal/admin');
            }
        }else{
            $this->session->set_flashdata('header','Gagal');
            $this->session->set_flashdata('notif','Journal tidak memiliki artikel');
            redirect('journal/admin');
        }
    }

    public function artikel($id=null){
        $user = $this->user->user;
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_journal = ?";
        $journal = $this->db->query($sql,$id)->row_array();
        $this->data['journal'] = $journal;
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_artikel_layout',$this->data);
    }

    public function detail_artikel_journal($id=null){
        $sql = "SELECT *, j.judul as journal FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();

        $sql_author = 'SELECT * FROM tb_author where id_artikel_ref = ?';
        $author = $this->db->query($sql_author,$id)->result_array();
        // $artikel['nama'] = '';
        // foreach ($author as $key => $value) {
        //     $artikel['nama'] .= '<li>'.$value['nama'].'</li>';
        //     $artikel['nama'] .= '<li>'.$value['jabatan'].'</li>';
        //     $artikel['nama'] .= '<br>';
        // }
        // print_r($artikel);
        // echo json_encode($artikel);
        $this->data['artikel'] = $artikel;
        $this->data['author'] = $author;
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $data_v = $this->db->query($sql,$artikel['id_no_volume'])->result_array();
        $this->data['volume'] = $data_v;
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $data_v = $this->db->query($sql,$artikel['id_no_volume'])->result_array();
        $this->data['no_vol'] = $data_v;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_artikel_layout',$this->data);
    }

    public function detail_artikel($id){
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();

        $sql_author = 'SELECT * FROM tb_author where id_artikel_ref = ?';
        $author = $this->db->query($sql_author,$id)->result_array();
        $artikel['nama'] = '';
        foreach ($author as $key => $value) {
            $artikel['nama'] .= '<li>'.$value['nama'].'</li>';
            $artikel['nama'] .= '<li>'.$value['jabatan'].'</li>';
            $artikel['nama'] .= '<br>';
        }
        // print_r($artikel);
        echo json_encode($artikel);
    }

    public function response_artikel($id){
        $input = $this->input->post();
        // print_r($input);
        $data = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_journal = ?';
        if ($input['status'] == 1) {
            // $journal = $this->db->query($sql,$data['id_no_volume_ref'])->row_array();
            // $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_volume = ?';
            if($this->db->update('tb_artikel',array('status'=>1),array('id_artikel'=>$input['id']))){
                $artikel = $this->db->query($sql,$id)->num_rows();
                $sql .= ' AND a.status = 1';
                $aktif = $this->db->query($sql,$id)->num_rows();
                if ($artikel == $aktif) {
                    $this->db->update('tb_journal',array('status'=>2),array('id_journal'=>$id));
                }
                $ret['url'] = site_url('journal/admin/artikel/'.$id);
                $this->session->set_flashdata('notif','Artikel berhasil disetujui'); 
                $this->session->set_flashdata('header','Sukes'); 
            }else{
                $this->session->set_flashdata('notif','Artikel gagal disetujui'); 
                $this->session->set_flashdata('header','Gagal');
            }
        }else{
            if($this->db->update('tb_artikel',array('status'=>2,'reason'=>$input['reason']),array('id_artikel'=>$input['id']))){
                $artikel = $this->db->query($sql,$id)->num_rows();
                $sql .= ' AND a.status = 2';
                $aktif = $this->db->query($sql,$id)->num_rows();
                if ($artikel == $aktif) {
                    $this->db->update('tb_journal',array('status'=>3),array('id_journal'=>$id));
                }
                $ret['url'] = site_url('journal/admin/artikel/'.$id);
                // print_r($input);
                // return false;
                $this->session->set_flashdata('notif','Artikel berhasil ditolak'); 
                $this->session->set_flashdata('header','Sukes'); 
            }else{
                $this->session->set_flashdata('notif','Artikel gagal ditolak'); 
                $this->session->set_flashdata('header','Gagal');
            }
        }
        echo json_encode($ret);
    }

    public function accepted(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal Accepted';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_accepted_layout',$this->data);
    }

    public function rejected(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal Rejected';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_rejected_layout',$this->data);
    }

    public function reason($id=null){
        $a = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array()['reason'];
        echo json_encode($a);
    }

    public function report_download(){
        $slq_journal = "SELECT SUM(download_1) as download_1, SUM(download_2) as download_2, SUM(download_3) as download_3, SUM(download_4) as download_4, SUM(download_5) as download_5, SUM(anonym) as anonym FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna where p.id_instansi_ref = ?";
        $sum_journal = $this->db->query($slq_journal,$this->user->user->id_instansi)->row_array();
        if (is_null($sum_journal['anonym']) || $sum_journal['anonym'] == '') {
            $sum_journal['anonym'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sum_journal['download_'.$i]) || $sum_journal['download_'.$i] == '') {
                $sum_journal['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sum_journal['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        $slq_artikel = "SELECT SUM(download_1) as download_1, SUM(download_2) as download_2, SUM(download_3) as download_3, SUM(download_4) as download_4, SUM(download_5) as download_5, SUM(anonym) as anonym FROM tb_artikel a join tb_pengguna p on a.id_user_ref = p.id_pengguna where p.id_instansi_ref = ?";
        $sum_artikel = $this->db->query($slq_artikel,$this->user->user->id_instansi)->row_array();
        if (is_null($sum_artikel['anonym']) || $sum_artikel['anonym'] == '') {
            $sum_artikel['anonym'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sum_artikel['download_'.$i]) || $sum_artikel['download_'.$i] == '') {
                $sum_artikel['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sum_artikel['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        $this->data['sum_artikel'] = $sum_artikel;
        $this->data['sum_journal'] = $sum_journal;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'download_journal_layout',$this->data);
    }

    public function report_download_journal($id=null){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_journal = ?";
        $journal = $this->db->query($sql,$id)->row_array();
        if (is_null($journal['anonym']) || $journal['anonym'] == '') {
            $journal['anonym'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($journal['download_'.$i]) || $journal['download_'.$i] == '') {
                $journal['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $journal['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        $this->data['journal'] = $journal;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'download_artikel_layout',$this->data);
    }

    public function report_download_artikel($id=null){
        $sql = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        if (is_null($sql['anonym']) || $sql['anonym'] == '') {
            $sql['anonym'] = 0;
        }
        if (is_null($sql['total']) || $sql['total'] == '') {
            $sql['total'] = 0;
        }
        if (is_null($sql['anonym_abs']) || $sql['anonym_abs'] == '') {
            $sql['anonym_abs'] = 0;
        }
        if (is_null($sql['total_abs']) || $sql['total_abs'] == '') {
            $sql['total_abs'] = 0;
        }
        if (is_null($sql['total_download']) || $sql['total_download'] == '') {
            $sql['total_download'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sql['download_'.$i]) || $sql['download_'.$i] == '') {
                $sql['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sql['nama_'.$i] = $nama['nm_jenis_instansi'];
            if (is_null($sql['downloadabs_'.$i]) || $sql['downloadabs_'.$i] == '') {
                $sql['downloadabs_'.$i] = 0;
            }
            // $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array()
            $sql['namaabs_'.$i] = $nama['nm_jenis_instansi'];
        }
        $this->data['artikel'] = $sql;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_report_download_layout',$this->data);
    }

    public function ajax_list($id=null)
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        foreach ($list as $news) {
        $button = '';
        $btn_ign = '';
            $no++;
            if ($news->status==1) {
                $aktif = '<span class="text-success"><b>Accepted</b></span>';                
            }else{
                if($news->status == 0){
                    if ($news->reason != '') {
                        $aktif = '<span class="text-warning"><b>Repaired</b></span>';
                        $btn_ign = '<button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i></button> ';
                    }else{
                        $aktif = '<span class="text-defafult"><b>Pending</b></span>';
                        $btn_ign = '<button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i></button> ';
                    }
                    
                }else{
                    $aktif = '<span class="text-danger"><b>Ignored</b></span>';
                }
                $button = '<button class="btn btn-info btn-sm btn-acc" id="'.$news->id_artikel.'" data-toggle="tooltip" title="accept"><i class="fa fa-check"></i></button> ';
            }
            // $button .= ' <button class="btn btn-success btn-sm btn-detail" id="'.$news->id_artikel.'"><i class="fa fa-eye"></i> Detail</button>';
            if (!is_null($news->reason)) {
                $button .= ' <button class="btn btn-warning btn-sm btn-reason" id="'.$news->id_artikel.'"><i class="fa fa-comment-o"></i> Reason</button> ';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="btn-detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).' <i class="fa fa-external-link" aria-hidden="true"></i></u></div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            // $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button.' '.$btn_ign;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered($id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-default">Pending</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal_accepted()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_accepted();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-default">Accepted</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_accepted(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_accepted(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal_rejected()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_rejected();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-danger">Rejected</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_rejected(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_rejected(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_volume()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_volume();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            $button = '<a href="'.site_url("journal/admin/edit_volume").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            $row = array();
            $row[] = $no;
            $row[] = $news->volume;
            $row[] = $news->judul;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_volume(),
                        "recordsFiltered" => $this->journal_model->count_filtered_volume(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_no_volume()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_no_volume();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
                $button = '<a href="'.site_url("journal/admin/edit_no_volume").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            $row = array();
            $row[] = $no;
            $row[] = $news->nomor;
            $row[] = $news->volume;
            $row[] = $news->judul;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_no_volume(),
                        "recordsFiltered" => $this->journal_model->count_filtered_no_volume(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal_download()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_download();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
            $button = '<a href="'.site_url('journal/admin/report_download_journal').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            if ($news->total_download == '' || is_null($news->total_download)) { $total = 0; }else{ $total = $news->total_download;}
            $row[] = $total;
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_download(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_download(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel($id=null)
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        foreach ($list as $news) {
        $button = '';
        $btn_ign = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div class="btn-detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).' <i class="fa fa-external-link" aria-hidden="true"></i></u></div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            if ($news->total_download == '' || is_null($news->total_download)) { $total = 0; }else{ $total = $news->total_download;}
            $row[] = $total;
            $button = '<a href="'.site_url('journal/admin/report_download_artikel').'/'.$news->id_artikel.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row[] = $button;
            // $row[] = $btn_ign.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered($id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function upload_file_abstract($file){
        $imagename = $file['name'];
        ini_set('max_file_uploads', 3);
        // return $imagename;
        // exit();
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH.'./assets/file/abstract/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['file_name']            = time().".".$ext;
        // return $config['file_name'];
        // exit();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('file_name_abs'))
        {
                // $error = array('error' => $this->upload->display_errors());
            $ret['abs_error'] = $this->upload->display_errors();
            // $ret['status'] = 0;

            return $ret;
        }
        else
        {
            $ret['message'] = $this->upload->data('file_name');
            $ret['status'] = 0;
            return $this->upload->data('file_name');
        }
    }

    public function upload_file($file){
        $imagename = $file['name'];
        ini_set('max_file_uploads', 3);
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH.'./assets/file/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['file_name']            = time().".".$ext;
        // return $config['file_name'];
        // exit();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if ( ! $this->upload->do_upload('file_name'))
        {
                // $error = array('error' => $this->upload->display_errors());
            $ret['error'] = $this->upload->display_errors();
            // $ret['status'] = 0;

            return $ret;
        }
        else
        {
            $ret['message'] = $this->upload->data('file_name');
            $ret['status'] = 0;
            return $this->upload->data('file_name');
        }
    }

    public function upload_logo($logo){             
        
        $imagename = $logo['file_name']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."assets/media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['min_width']            = 200;
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_name'))
        {
            $data_upload['error'] = $this->upload->display_errors();
        }
        else
        {
            $upload_data = $this->upload->data();
            $data_upload['asli'] = $upload_data['file_name'];
            if ($upload_data['image_width'] > 420 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 420;
                $config_r['new_image'] = FCPATH."assets/media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);

                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('assets/media/thumbnail/')."/".$upload_data['file_name'];
                        
                }
            }
        }
        return $data_upload;
    }

    function _getExtension($str){
        $i = strrpos($str,".");
        if (!$i){
            return "";
        }   
        $l = strlen($str) - $i;
        $ext = substr($str,$i+1,$l);
        return $ext;
    }

     public function create_journal(){
        
    $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '100%';
        $this->ckeditor->config['height'] = '300px'; 
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'create_journal_layout');
    }

     public function volume(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'volume_layout');
    }
     public function create_volume(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'create_volume_layout');
    }
    public function novolume(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'no_volume_layout');
    }
    public function create_novolume(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'create_no_volume_layout');
    }
     public function detail_download(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_download_layout');
    }
     public function detail_report_download(){
    
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_report_download_layout');
    }

    public function add_slug(){
         $data = $this->db->get('tb_journal')->result_array();
    foreach ($data as $key => $value) {
             $data_j['slug'] = $this->slugify($value['judul']);
             $this->db->update('tb_journal',$data_j,array('id_journal'=>$value['id_journal']));
         }
     }

    public static function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

    public function detail_all_journal(){
        $sql = "SELECT * FROM tb_journal Where status = 2 limit 8";
        $journal = $this->db->query($sql)->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_all_journal_layout',$this->data);
    }
    public function loadmore_detail($limit,$ofset){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where j.status = 2 limit ".$limit.",".$ofset;
        $journal = $this->db->query($sql)->result_array();
        $html = '';
        foreach ($journal as $key => $value) {
            $html .= '<div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="">
                    <div class="box-thumbnail">
                      <div class="header-box-thumbnail">
                        <img class="thumbnail-cover" src="'.base_url().'assets/media/'.$value['futured_image'].'">
                      </div>
                      <div class="body-box-thumbnail">
                    <h5 class="title-thumbnail"><a href="'.site_url('user/journal/detail_journal/'.$value['id_journal']).'">'.$value['judul'].'</a> </h5>
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                          <a href="'.site_url('user/journal/download_journal/'.$value['id_journal']).'" style="float: right;color: #EF7314;text-decoration: none;font-size: 20px;"><i class="fa fa-download"></i></a>
                        </div>

                      </div>

                    </div>
                </div>';
        }

        echo json_encode($html);
    }

    public function detail_myjournal(){
        $sql = "SELECT * FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where  p.id_instansi_ref = ? limit 8";
        $journal = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'detail_myjournal_layout',$this->data);
    }

    public function loadmore_detail_myjournal($limit,$ofset){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_instansi_ref = ? limit ".$limit.",".$ofset;
        $journal = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
        $html = '';
        foreach ($journal as $key => $value) {
            $html .= '<div class="filter-box-thumbnail col-md-3 col-sm-3 col-xs-12 " style="padding:15px">
                    <div class="box-thumbnail">
                      <div class="header-box-thumbnail">
                        <img class="thumbnail-cover" src="'.base_url().'assets/media/'.$value['futured_image'].'">
                      </div>
                      <div class="body-box-thumbnail">
                    <h5 class="title-thumbnail"><a href="'.site_url('user/journal/detail_journal/'.$value['id_journal']).'">'.$value['judul'].'</a> </h5>
                        <div class="col col-md-12 col-sm-12 col-xs-12 none-padding">
                          <a href="'.site_url('user/journal/download_journal/'.$value['id_journal']).'" style="float: right;color: #008d4c;text-decoration: none;font-size: 20px;"><i class="fa fa-download"></i></a>
                        </div>

                      </div>

                    </div>
                </div>';
        }

        echo json_encode($html);
    }

    public function download_journal($id=null){
        $this->load->library('zip');
        $sql = "SELECT *, j.judul as journal, j.anonym as anonym_j FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_journal = ?";
        $artikel = $this->db->query($sql,$id)->result_array();
        $this->zip->read_file(FCPATH.'assets/media/'.$artikel[0]['futured_image']);
        $downartikel = $this->db->get_where('tb_instansi',array('id_instansi'=>$this->user->user->id_instansi))->row_array();
        

        $sql_val = 'SELECT p.id_instansi_ref, j.total_download FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna where j.id_journal = ?';
        $validasi = $this->db->query($sql_val,$id)->row_array();
        // print_r($validasi);
        if ($validasi['id_instansi_ref'] != $this->user->user->id_instansi) {
            $data['download_'.$downartikel['id_jenis_instansi']] = $artikel[0]['download_'.$downartikel['id_jenis_instansi']] + 1;
            $data['total_download'] = $validasi['total_download'] + 1;
            $this->db->update('tb_journal',$data,array('id_journal'=>$artikel[0]['id_journal']));
        }
        // $data['total'] = $artikel[0]['total'] + 1;
        // $data['anonym'] = $artikel[0]['anonym_j'] + 1;
        foreach ($artikel as $key => $value) {

            // $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$value['id_artikel']))->row_array();

            /*$data['total'] = $art['total'] + 1;
            $data['anonym'] = $art['anonym'] + 1;

            $data['anonym_abs'] = $art['anonym_abs'] + 1;
            $data['total_abs'] = $art['total_abs'] + 1;
            $data['total_download'] = $art['total_download'] + 2;
            $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
            $this->db->update('tb_artikel',$data,array('id_artikel'=>$value['id_artikel']));*/

            $this->zip->read_file(FCPATH.'assets/file/'.$value['file']);
            $this->zip->read_file(FCPATH.'assets/file/abstract/'.$value['abstract_file']);
        }
        $this->zip->download('journal.zip');
    }

    public function downloads($id=null){
        $downartikel = $this->db->get_where('tb_instansi',array('id_instansi'=>$this->user->user->id_instansi))->row_array();
        $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        /*if ($downartikel['id_jenis_instansi'] == 1) {
            $data['university'] = $art['university'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 2) {
            $data['business'] = $art['business'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 3) {
            $data['goverment'] = $art['goverment'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 4) {
            $data['comunity'] = $art['comunity'] + 1;
        }else{
            $data['media'] = $art['media'] + 1;
        }*/
        $sql_val = 'SELECT p.id_instansi_ref FROM tb_artikel j join tb_pengguna p on j.id_user_ref = p.id_pengguna where j.id_artikel = ?';
        $validasi = $this->db->query($sql_val,$id)->row_array();
        if ($validasi['id_instansi_ref'] != $this->user->user->id_instansi) {
            $data['download_'.$downartikel['id_jenis_instansi']] = $art['download_'.$downartikel['id_jenis_instansi']] + 1;
            $data['total'] = $art['total'] + 1;
            $data['total_download'] = $art['total_download'] + 1;
            $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
        }
        redirect(site_url('assets/file/'.$art['file']));
    }
}