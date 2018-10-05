<?php

class Journal extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
        // $this->load->model('login_model');
        /*$this->load->helper('api');
        $this->load->library('Recaptcha');
        $this->load->module('Token');*/
        $this->load->model('journal_model');
        $data = $this->session->userdata('user');
        // print_r($data);
        $tb = '';
        if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data))->row_array()['id_role_ref'] == 0) {
            // $user = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$data))->row_array();
            $tb = 'tb_mahasiswa';
        }else{
            // $user = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$data))->row_array();
            $tb = 'tb_dosen';
        }
        $sql = 'select * from tb_pengguna p join '.$tb.' d on p.id_pengguna = d.id_pengguna_ref where id_pengguna = ?';
        $user = $this->db->query($sql,$data)->row_array();
        $this->data['user'] = $user;
    }

    public function index(){
        
        $sql = "SELECT * FROM tb_journal Where id_user_ref = ?";
        $journal = $this->db->query($sql,$this->data['user']['id_pengguna'])->result_array();
        // print_r($journal);
        // $list = $this->journal_model->get_datatables();
        // if (current_url() == ) {
        //     echo "string";
        // }
        // print_r(current_url());
        // print_r($list);
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function all_journal(){
        
        $sql = "SELECT * FROM tb_journal Where status = 2";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'all_journal_layout',$this->data);
    }

    public function katalog($param=null){
        $sql = "SELECT * FROM tb_journal WHERE id_user_ref = ? AND judul LIKE '".$param."%'";
        $journal = $this->db->query($sql,$this->data['user']['id_pengguna'])->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function search($param=null){
        $sql = "SELECT * FROM tb_journal WHERE id_user_ref = ? AND judul LIKE '%".$param."%'";
        $journal = $this->db->query($sql,$this->data['user']['id_pengguna'])->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function add(){
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
                $data_news['deskripsi'] = $this->input->post('content');
                $data_news['issn'] = $this->input->post('issn');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->insert('tb_journal',$data_news)) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('user/journal');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['kategori'] = form_error('kategori');
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
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout_backup',$this->data);
    }

    public function edit($id){
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
                $data_news['deskripsi'] = $this->input->post('content');
                $data_news['issn'] = $this->input->post('issn');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->update('tb_journal',$data_news,array('id_journal'=>$id))) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('user/journal');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }else{
                    $ret['state'] = 1;
                    // $data_news['futured_image'] = $image['asli'];
                    if ($this->db->update('tb_journal',$data_news,array('id_journal'=>$id))) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('user/journal');
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
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout_backup',$this->data);
    }

    public function detail_journal($id=null){
        $sql = "SELECT j.*, v.id_volume, v.volume FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref where j.id_journal = ".$id;
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['volume'] = $data;
        $this->ciparser->new_parse('template_user','modules_user', 'detail_jurnal_layout',$this->data);

    }

    public function detail_volume($id=null){
        $sql = 'SELECT j.*, v.id_volume, v.volume, n.* FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref where id_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['no_volume'] = $data;
        $this->ciparser->new_parse('template_user','modules_user', 'detail_volume_layout',$this->data);
    }

    public function detail_no_volume($id=null){
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['artikel'] = $data;
        $this->ciparser->new_parse('template_user','modules_user', 'detail_no_volume_layout',$this->data);
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
            
            if ($this->form_validation->run() == true && $nama_c !='' && $jabatan_c != '') {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['abstrak'] = $this->input->post('content');
                $data_news['keyword'] = $this->input->post('keyword');
                $data_news['references'] = $this->input->post('ref');
                $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                $data_news['id_no_volume_ref'] = $this->input->post('no_volume');
                $cekjournal = $this->db->get_where('tb_journal',array('id_journal'=>$this->input->post('journal')))->row_array();
                if ($cekjournal['status'] == 1 ) {
                    $ret['notif']['journal'] = 'Journal dalam tahap persetujuan, tidak dapat menambah artikel baru';
                    echo json_encode($ret);
                    exit();
                }
                if (isset($_FILES['file_name']) && isset($_FILES['file_name_abs'])) {
                    $file = $this->upload_file($_FILES['file_name']);
                    $file_abs = $this->upload_file($_FILES['file_name_abs']);
                    if (isset($file['error']) && isset($file_abs['abs_error'])) {
                        $ret['notif'] = $file;
                        $ret['notif'] = $file_abs;
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
                                        $ret['url'] = site_url('user/journal/list_artikel');
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
        $journal = $this->db->get('tb_journal')->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_layout',$this->data);
    }

    public function edit_artikel($id=null){
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
            // $this->form_validation->set_rules('nama', 'Nama Autho', 'trim|required');
            // $this->form_validation->set_rules('jabatan', 'Jabatan Author', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['abstrak'] = $this->input->post('content');
                $data_news['keyword'] = $this->input->post('keyword');
                $data_news['references'] = $this->input->post('ref');
                $data_news['status'] = 0;
                $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
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
                                    $ret['url'] = site_url('user/journal/list_artikel');
                                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                                }
                            }
                        }else{
                            $ret['status'] = 1;
                            $ret['url'] = site_url('user/journal/list_artikel');
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
            // $ret['notif']['nama'] = form_error('nama');
            // $ret['notif']['jabatan'] = form_error('jabatan');
            // if (!isset($_FILES['file_name'])) {
            //  $ret['notif']['file_name'] = "Please Select File";
            // }
            echo json_encode($ret);
            exit();
        }
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();
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
        $journal = $this->db->get('tb_journal')->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['artikel'] = $artikel;
        $this->data['author'] = $author;
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_layout',$this->data);
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
                    $ret['url'] = site_url('user/journal/volume');
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
        $journal = $this->db->get('tb_journal')->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'volume_layout',$this->data);
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
                    $ret['url'] = site_url('user/journal/list_nomor');
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
        $journal = $this->db->get('tb_journal')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'nomor_layout',$this->data);
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
                    redirect('user/journal');
                }
            }else{
                $this->session->set_flashdata('header','Gagal');
                $this->session->set_flashdata('notif','Journal gagal disubmit');
                redirect('user/journal');
            }
        }else{
            $this->session->set_flashdata('header','Gagal');
            $this->session->set_flashdata('notif','Journal tidak memiliki artikel');
            redirect('user/journal');
        }
    }

    public function list_artikel(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_layout',$this->data);
    }

    public function list_artikel_accepted(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_accepted_layout',$this->data);
    }

    public function list_download(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_download_layout',$this->data);
    }

    public function list_artikel_rejected(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_rejected_layout',$this->data);
    }

    public function detail_artikel($id=null){
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
        $this->data['no_vol'] = $data_v;
        $this->ciparser->new_parse('template_user','modules_user', 'detail_artikel_jurnal_layout',$this->data);
    }

    public function volume(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'volume_layout',$this->data);
    }

    public function list_nomor(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'nomor_layout',$this->data);
    }

    public function reason($id=null){
        $a = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array()['reason'];
        echo json_encode($a);
    }

    public function ajax_list()
    {
        
        $list = $this->journal_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->status == 1) {
                $aktif = '<span class="text-success">Pending</span>';
                $button = '<a href="'.site_url("user/journal/Edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="#"><button class="btn btn-warning btn-sm" id="2" data-toggle="tooltip" title="Pending"><i class="fa fa-clock-o"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("user/journal/edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a> <a href="'.site_url("user/journal/submit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="2" data-toggle="tooltip" title="Submit"><i class="fa fa-upload "></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_journal.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail" id="'.$news->id_journal.'">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            $row[] = $news->visitor;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel()
    {
        
        $list = $this->journal_model->get_datatables_artikel();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->status == 1) {
                $aktif = '<span class="text-success">Enable</span>';
                $button = '';
            }else{
                if ($news->status == 2) {
                    $aktif = '<span class="text-danger">Reject</span>';
                    $button = '<a href="'.site_url("user/journal/edit_artikel").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                }else{
                    $button = '';
                    if ($news->reason != '') {
                        $aktif = '<span class="text-warning">Repaired</span>';
                    }else{
                        $aktif = '<span class="text-default">Disable</span>';
                    }
                    if($news->status_journal != 1 ){
                        $button = '<a href="'.site_url("user/journal/edit_artikel").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    }
                }
                // $aktif = '<span class="text-Success">Disable</span>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).'</u></div>';
            $row[] = $news->nomor;
            $row[] = $news->volume;
            $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_artikel(),
                        "recordsFiltered" => $this->journal_model->count_filtered_artikel(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel_accepted()
    {
        
        $list = $this->journal_model->get_datatables_artikel_accepted();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            $aktif = '<span class="text-success">Accepted</span>';
            // $button = '<a href="'.site_url("user/journal/edit_artikel").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).'</u></div>';
            $row[] = $news->nomor;
            $row[] = $news->volume;
            $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_artikel_accepted(),
                        "recordsFiltered" => $this->journal_model->count_filtered_artikel_accepted(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel_rejected()
    {
        
        $list = $this->journal_model->get_datatables_artikel_rejected();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            $aktif = '<span class="text-danger">Rejected</span>';
            $button = '<a href="'.site_url("user/journal/edit_artikel").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            $btn = '<button class="btn btn-danger btn-sm btn-reason" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Reason"><i class="fa fa-comment"></i></button>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).'</u></div>';
            $row[] = $news->nomor;
            $row[] = $news->volume;
            $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button.$btn;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_artikel_rejected(),
                        "recordsFiltered" => $this->journal_model->count_filtered_artikel_rejected(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel_download()
    {
        
        $list = $this->journal_model->get_datatables_artikel_accepted();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if($news->total_download != ''){$total = $news->total_download;}else{$total = 0;}
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).'</u></div>';
            $row[] = $news->nomor;
            $row[] = $news->volume;
            $row[] = $news->judul_journal;
            $row[] = $total;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_artikel_accepted(),
                        "recordsFiltered" => $this->journal_model->count_filtered_artikel_accepted(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_volume()
    {
        
        $list = $this->journal_model->get_datatables_volume();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            $button = '<a href="'.site_url("user/journal/edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
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
        
        $list = $this->journal_model->get_datatables_no_volume();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            // if ($news->status == 1) {
            //     $aktif = '<span class="text-success">Enable</span>';
            //     $button = '<a href="'.site_url("user/journal/Edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            // }else{
                // $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("user/journal/edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            // }
            $row = array();
            $row[] = $no;
            // $row[] = '<div class="detail" id="'.$news->id_journal.'">'.word_limiter($news->judul,10).'</div>';
            // $row[] = '<div class="detail" id="'.$news->id_journal.'">'.$news->issn.'</div>';
            // $row[] = word_limiter($news->deskripsi, 10);
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

    public function upload_file($file){
        $imagename = $file['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH.'./assets/file/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

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

    public function upload_file_abstract($file){
        $imagename = $file['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH.'./assets/file/abstract/';
        $config['allowed_types']        = 'pdf|doc|docx';
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

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

    public function downloads($id=null){
        $downartikel = $this->db->get_where('tb_instansi',array('id_instansi'=>$this->data['user']['id_instansi_ref']))->row_array();
        $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        if ($downartikel['id_jenis_instansi'] == 1) {
            $data['university'] = $art['university'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 2) {
            $data['business'] = $art['business'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 3) {
            $data['goverment'] = $art['goverment'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 4) {
            $data['comunity'] = $art['comunity'] + 1;
        }else{
            $data['media'] = $art['media'] + 1;
        }
        $data['total'] = $art['total'] + 1;
        $data['total_download'] = $art['total_download'] + 1;
        $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
        redirect(site_url('assets/file/'.$art['file']));
    }

    public function downloads_abs($id=null){
        $downartikel = $this->db->get_where('tb_instansi',array('id_instansi'=>$this->data['user']['id_instansi_ref']))->row_array();
        $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        if ($downartikel['id_jenis_instansi'] == 1) {
            $data['university_abs'] = $art['university_abs'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 2) {
            $data['business_abs'] = $art['business_abs'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 3) {
            $data['goverment_abs'] = $art['goverment_abs'] + 1;
        }elseif ($downartikel['id_jenis_instansi'] == 4) {
            $data['comunity_abs'] = $art['comunity_abs'] + 1;
        }else{
            $data['media_abs'] = $art['media_abs'] + 1;
        }
        $data['total_abs'] = $art['total_abs'] + 1;
        $data['total_download'] = $art['total_download'] + 1;
        $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
        redirect(site_url('assets/file/'.$art['abstract_file']));
    }
}