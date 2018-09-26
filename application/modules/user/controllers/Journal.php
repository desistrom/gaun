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
        
        // $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref JOIN tb_author au ON a.id_artikel = au.id_artikel_ref";
        // $journal = $this->db->query($sql)->result_array();
        // print_r($journal);
        // $list = $this->journal_model->get_datatables();
        // if (current_url() == ) {
        //     echo "string";
        // }
        // print_r(current_url());
        // print_r($list);
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function add(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Journal', 'trim|required');
            $this->form_validation->set_rules('content', 'Deskripsi Journal', 'trim|required');
            $this->form_validation->set_rules('issn', 'ISSN Journal', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['deskripsi'] = $this->input->post('content');
                $data_news['issn'] = $this->input->post('issn');
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
                }else{
                    $ret['state'] = 1;
                    // $data_news['img'] = $image['asli'];
                    if ($this->db->insert('tb_event',$data_news)) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('instansi/event');
                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['issn'] = form_error('issn');
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
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function detail_journal($id){
        $sql = "SELECT j.*, sum(id_no_volume) as no_volume, sum(id_artikel) as artikel, v.volume FROM tb_journal j left JOIN tb_volume v ON j.id_journal = v.id_journal_ref left JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref left JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref left JOIN tb_author au ON a.id_artikel = au.id_artikel_ref where j.id_journal = ".$id." Group BY v.id_volume";
        $data = $this->db->query($sql,$id)->result_array();
        $ret['id'] = $id;
        $ret['issn'] = $data[0]['issn'];
        $ret['visitor'] = $data[0]['visitor'];
        // print_r($sql);
        $ret['table'] = '';
        foreach ($data as $key => $value) {
            $ret['table'] .= '<tr>';
            $ret['table'] .= '<td>'.$value['volume'].'</td>';
            $ret['table'] .= '<td>'.$value['no_volume'].'</td>';
            $ret['table'] .= '<td>'.$value['artikel'].'</td>';
            $ret['table'] .= '<tr>';
        }
        echo json_encode($ret);

    }

    public function add_artikel(){
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
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['abstrak'] = $this->input->post('content');
                $data_news['keyword'] = $this->input->post('keyword');
                $data_news['references'] = $this->input->post('ref');
                $data_news['id_user_ref'] = $this->data['user']['id_pengguna'];
                $data_news['id_no_volume_ref'] = $this->input->post('no_volume');
                if (isset($_FILES['file_name'])) {
                    $file = $this->upload_file($_FILES);
                    if (isset($file['error'])) {
                        $ret['notif'] = $file;
                    }else{
                        $ret['state'] = 1;
                        $data_news['file'] = $file;
                        if ($this->db->insert('tb_artikel',$data_news)) {
                            $data_author['id_artikel_ref'] = $this->db->insert_id();
                            $nama = explode(",", $this->input->post('nama'));
                            $jabatan = explode(",", $this->input->post('jabatan'));
                            for ($i=0; $i < count($nama) ; $i++) { 
                                $data_author['nama'] = $nama[$i];
                                if (isset($jabatan[$i]) && $jabatan[$i] != '') {
                                    $data_author['jabatan'] = $jabatan[$i];
                                    $this->db->insert('tb_author',$data_author);
                                    $ret['status'] = 1;
                                    $ret['url'] = site_url('user/journal');
                                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
        // $this->data['breadcumb'] = $journal['judul'];
        $journal = $this->db->get('tb_journal')->result_array();
        // $volume = $this->db->get('tb_volume')->result_array();
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_layout',$this->data);
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

    public function list_artikel(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'artikel_layout',$this->data);
    }

    public function volume(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'volume_layout',$this->data);
    }

    public function list_nomor(){
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'nomor_layout',$this->data);
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
                $aktif = '<span class="text-success">Enable</span>';
                $button = '<a href="'.site_url("user/journal/Edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("user/journal/edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_journal.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail" id="'.$news->id_journal.'">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 10);
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
                $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail" id="'.$news->nomor.'">'.$news->nomor.'</div>';
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

    public function ajax_list_volume()
    {
        
        $list = $this->journal_model->get_datatables_volume();
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
        $config['upload_path']          = FCPATH.'./assets/file/';
        $config['allowed_types']        = 'pdf|doc|docx';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_name'))
        {
                // $error = array('error' => $this->upload->display_errors());

            return $this->upload->display_errors();
        }
        else
        {
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
}