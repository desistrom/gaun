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
    }

    public function index(){
    	if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            /*print_r($response);
            return false;*/
            // $response['success'] = 1;
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $username = $this->input->post('username');
                $password = sha1($this->input->post('password'));
                $sql = "SELECT * FROM tb_instansi WHERE username = ? AND password = ?";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    $this->session->set_userdata('data_user', $data_user);
                    // $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('is_login', true);
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
            		$ret['url'] = site_url('instansi/dashboard');

            	}else{
                    $ret['notif']['login'] = 'username or password worng';
                }
            }else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
            echo  json_encode($ret);
            exit();
        }
    	$this->data['captcha'] = $this->recaptcha->getWidget();
        $this->data['action'] = site_url('login');
        $this->data['script_captcha'] = $this->recaptcha->getScriptTag();
    	$this->load->view('login_layout',$this->data);
    }

    public function dashboard(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = '';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'dashboard_layout',$this->data);
    }

    public function event(){
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'event_layout',$this->data);
    }

    public function add_event(){
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'event_layout',$this->data);
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
                $data_news['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
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
                            $ret['url'] = site_url('admin/news');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }else{
                    $ret['state'] = 1;
                    // $data_news['img'] = $image['asli'];
                    if ($this->db->insert('tb_news',$data_news)) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('admin/news');
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
        $this->ciparser->new_parse('template_instansi','modules_admin', 'news/news_layout',$this->data);
    }

    public function ajax_list()
    {
        $list = $this->news_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->is_aktif == 1) {
                $aktif = '<span class="text-success">Enable</span>';
                $button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Disabled</span> </button>
                            <a href="'.site_url("admin/news/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Disabled</span> </button>
                            <a href="'.site_url("admin/news/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
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

    public function logout(){
        // $this->session->sess_destroy();
        $this->session->unset_userdata('data_user');
        redirect(site_url('instansi'));
    }
}