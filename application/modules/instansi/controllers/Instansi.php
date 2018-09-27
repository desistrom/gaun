<?php 

/**
* 
*/
class Instansi extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
    	// $this->load->model('login_model');
        $this->load->helper('api');
        $this->load->library('Recaptcha');
        $this->load->module('Token');
        if ($this->session->userdata('instansi_login') != true) {
            redirect('instansi/login');
        }
    }

    public function index(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = '';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'dashboard_layout',$this->data);
    }

    public function berita(){
        $user = $this->session->userdata('data_user');
        // print_r($user);
        $this->data['view'] = 'list';
        $sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news where id_instansi_ref = ?";
        $this->data['news'] = $this->db->query($sql,$user['id_instansi'])->result_array();
        // print_r($this->data['news']);
        $this->data['breadcumb'] = 'List News';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'news_layout',$this->data);
    }

    public function add_berita(){
        $user = $this->session->userdata('data_user');
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Berita', 'trim|required');
            $this->form_validation->set_rules('content', 'Content Berita', 'trim|required');
            $this->form_validation->set_rules('kategori', 'Kategori Berita', 'trim|required');
            $this->form_validation->set_rules('status', 'Status Berita', 'trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['content'] = $this->input->post('content');
                $data_news['is_aktif'] = $this->input->post('status');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                $data_news['id_user_ref'] = $this->session->userdata('data_user')['id_instansi'];
                $data_news['id_instansi_ref'] = $this->session->userdata('data_user')['id_instansi'];
                $data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['img'] = $image['asli'];
                        if ($this->db->insert('tb_news',$data_news)) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('instansi/berita');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }else{
                    $ret['state'] = 1;
                    // $data_news['img'] = $image['asli'];
                    if ($this->db->insert('tb_news',$data_news)) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('instansi/berita');
                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['kategori'] = form_error('kategori');
            $ret['notif']['status'] = form_error('status');
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
        $this->ckeditor->config['width'] = '1024px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'add';
        $this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
        $this->data['news'] = $this->db->get('tb_news')->result_array();
        $this->data['breadcumb'] = 'Add News';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'news_layout',$this->data);
    }

    public function edit(){
        $url = $this->uri->segment_array();
        $id = end($url);
        $this->data['news'] = $this->db->get_where('tb_news',array('id_news'=>$id))->row_array();
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Berita', 'trim|required');
            $this->form_validation->set_rules('content', 'Content Berita', 'trim|required');
            $this->form_validation->set_rules('kategori', 'Kategori Berita', 'trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul'] = $this->input->post('judul');
                $data_news['content'] = $this->input->post('content');
                $data_news['id_kategori_ref'] = $this->input->post('kategori');
                $data_news['id_user_ref'] = $this->session->userdata('data_user')['id_instansi'];
                $data_news['id_instansi_ref'] = $this->session->userdata('data_user')['id_instansi'];
                $data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $data_news['img'] = $image['asli'];
                        if (file_exists(FCPATH."assets/media/".$this->data['news']['img'])) {
                            @chmod(FCPATH."assets/media/".$this->data['news']['img'], 0777);
                            unlink(FCPATH."assets/media/".$this->data['news']['img']);
                        }
                        if (file_exists(FCPATH."assets/media/thumbnail/".$this->data['news']['img'])) {
                            @chmod(FCPATH."assets/media/thumbnail/".$this->data['news']['img'], 0777);
                            unlink(FCPATH."assets/media/thumbnail/".$this->data['news']['img']);
                        }
                        if (file_exists(FCPATH."assets/media/crop/".$this->data['news']['img'])) {
                            @chmod(FCPATH."assets/media/crop/".$this->data['news']['img'], 0777);
                            unlink(FCPATH."assets/media/crop/".$this->data['news']['img']);
                        }
                    }
                }
                if ($this->db->update('tb_news',$data_news,array('id_news'=>$id))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('instansi/berita');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
                
            
                
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['kategori'] = form_error('kategori');
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '1024px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'edit';
        $this->data['breadcumb'] = 'Edit News';
        $this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
        
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'news_layout',$this->data);
    }

    public function event(){
        $this->data['view'] = 'list';
        $this->data['breadcumb'] = 'List Events';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'event_layout',$this->data);
    }

    public function add_event(){
        $user = $this->session->userdata('data_user');
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Event', 'trim|required');
            $this->form_validation->set_rules('content', 'Content Event', 'trim|required');
            $this->form_validation->set_rules('tempat', 'Lokasi Evet', 'trim|required');
            $this->form_validation->set_rules('tgl_event', 'Tanggal Event', 'trim|required');
            $this->form_validation->set_rules('start_event', 'Start Event', 'trim|required');
            $this->form_validation->set_rules('end_event', 'End Event', 'trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul_event'] = $this->input->post('judul');
                $data_news['deskripsi_event'] = $this->input->post('content');
                $data_news['tempat_event'] = $this->input->post('tempat');
                $data_news['tgl_event'] = $this->input->post('tgl_event');
                $data_news['start_event'] = $this->input->post('start_event');
                $data_news['end_event'] = $this->input->post('end_event');
                $data_news['id_instansi_ref'] = $this->session->userdata('data_user')['id_instansi'];
                // $data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->insert('tb_event',$data_news)) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('instansi/event');
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
            $ret['notif']['tempat'] = form_error('tempat');
            $ret['notif']['tgl_event'] = form_error('tgl_event');
            $ret['notif']['start_event'] = form_error('start_event');
            $ret['notif']['end_event'] = form_error('end_event');
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
        $this->ckeditor->config['width'] = '1024px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'add';
        // $this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
        // $this->data['news'] = $this->db->get('tb_news')->result_array();
        $this->data['breadcumb'] = 'Add Event';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'event_layout',$this->data);
    }

    public function edit_event(){
        $url = $this->uri->segment_array();
        $id = end($url);
        $this->data['news'] = $this->db->get_where('tb_event',array('id_event'=>$id))->row_array();
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Event', 'trim|required');
            $this->form_validation->set_rules('content', 'Content Event', 'trim|required');
            $this->form_validation->set_rules('tempat', 'Lokasi Evet', 'trim|required');
            $this->form_validation->set_rules('tgl_event', 'Tanggal Event', 'trim|required');
            $this->form_validation->set_rules('start_event', 'Start Event', 'trim|required');
            $this->form_validation->set_rules('end_event', 'End Event', 'trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul_event'] = $this->input->post('judul');
                $data_news['deskripsi_event'] = $this->input->post('content');
                $data_news['tempat_event'] = $this->input->post('tempat');
                $data_news['tgl_event'] = $this->input->post('tgl_event');
                $data_news['start_event'] = $this->input->post('start_event');
                $data_news['end_event'] = $this->input->post('end_event');
                $data_news['id_instansi_ref'] = $this->session->userdata('data_user')['id_instansi'];
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $data_news['futured_image'] = $image['asli'];
                        if (file_exists(FCPATH."assets/media/".$this->data['news']['futured_image'])) {
                            @chmod(FCPATH."assets/media/".$this->data['news']['futured_image'], 0777);
                            unlink(FCPATH."assets/media/".$this->data['news']['futured_image']);
                        }
                        if (file_exists(FCPATH."assets/media/thumbnail/".$this->data['news']['futured_image'])) {
                            @chmod(FCPATH."assets/media/thumbnail/".$this->data['news']['futured_image'], 0777);
                            unlink(FCPATH."assets/media/thumbnail/".$this->data['news']['futured_image']);
                        }
                        if (file_exists(FCPATH."assets/media/crop/".$this->data['news']['futured_image'])) {
                            @chmod(FCPATH."assets/media/crop/".$this->data['news']['futured_image'], 0777);
                            unlink(FCPATH."assets/media/crop/".$this->data['news']['futured_image']);
                        }
                    }
                }
                if ($this->db->update('tb_event',$data_news,array('id_event'=>$id))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('instansi/event');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
                
            
                
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['tempat'] = form_error('tempat');
            $ret['notif']['tgl_event'] = form_error('tgl_event');
            $ret['notif']['start_event'] = form_error('start_event');
            $ret['notif']['end_event'] = form_error('end_event');
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '1024px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'edit';
        $this->data['breadcumb'] = 'Edit Event';
        // $this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
        
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'event_layout',$this->data);
    }

    public function ajax_list()
    {
        $this->load->model('news_model');
        $list = $this->news_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->is_aktif == 1) {
                $aktif = '<span class="text-success">Enable</span>';
                $button = '<a href="'.site_url("instansi/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("instansi/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$news->id_news.'">'.$news->judul.'</div>';
            $row[] = word_limiter($news->content, 5);
            $row[] = $news->nm_kategori;
            $row[] = $news->created;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->news_model->count_all(),
                        "recordsFiltered" => $this->news_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_event()
    {
        $this->load->model('event_model');
        $list = $this->event_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $event) {
            $no++;
            // if ($event->is_aktif == 1) {
            //     $aktif = '<span class="text-success">Enable</span>';
            //     $button = '<a href="'.site_url("instansi/edit").'/'.$event->id_event.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            // }else{
            //     $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("instansi/edit_event").'/'.$event->id_event.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            // }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$event->id_event.'">'.$event->judul_event.'</div>';
            $row[] = word_limiter($event->deskripsi_event, 5);
            $row[] = $event->tempat_event;
            $row[] = $event->tgl_event;
            $row[] = $event->start_event.' - '.$event->end_event;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->event_model->count_all(),
                        "recordsFiltered" => $this->event_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
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
            if ($upload_data['image_width'] > 768 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 150;
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
            if ($upload_data['image_width'] > 768) {
                $config_c['image_library'] = 'GD2';
                $config_c['new_image'] = FCPATH."assets/media/crop/".$upload_data['file_name'];
                $config_c['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                $config_c['x_axis'] = 100;
                $config_c['y_axis'] = 60;

                $this->image_lib->initialize($config_c);

                if ( ! $this->image_lib->crop())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil Crop";
                        $data_upload['crop'] = site_url('assets/media/crop/')."/".$upload_data['file_name'];
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

    public function logout(){
        // $this->session->sess_destroy();
        $this->session->unset_userdata('data_user');
        $this->session->unset_userdata('instansi_login');
        redirect(site_url('instansi/login'));
    }
}