<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
require_once(APPPATH.'third_party/Facebook/autoload.php');
class Keanggotaan extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');
        $this->load->library('Recaptcha');
        // $this->load->library('google');
        // $this->load->library('facebook');
        $this->load->model('user');
	}
    function index() {
        /*$url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }*/
    	$url_instansi = URL_GET_ALL_INSTANSI;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        // $b = api_helper('',$url_instansi,$methode,$token);
        $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where is_aktif = 1 AND status = 2 order by -sort DESC";
        $b = $this->db->query($sql)->result_array();
        foreach ($b as $key => $value) {
            if ($value['image'] == '') {
                $b[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $b[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                    $galery[$key]['image'] = 'media/'.$value['image'];
                }else{
                    $b[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $b[$key]['image'] = 'media/'.$value['image'];
                }
            }                                                                                                                     
        }
        $this->data['total'] = count($b);
        // $config['base_url'] = base_url().'web/keanggotaan/index';
        // $url = base_url().'api/v1/news';
        /*$methode = 'GET';
        $config['total_rows'] = count($b['data']);
        $config['per_page'] = 8;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);
        $url = base_url().'api/v1/instansi_pagging?data='.$data;
        $a = api_helper('',$url,$methode,$token);
        $this->data['keanggotaan']=$a['data'];*/

        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 10);
            $this->data['total_row'] = $start;
            $url = URL_GET_INSTANSI_PAGGING.$start;
            // $a = api_helper('',$url,$methode,$token);
            $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where status = 2 AND is_aktif = 1 order by sort ASC LIMIT ".$start.",10";
            
            $a = $this->db->query($sql)->result_array();
            foreach ($a as $key => $value) {
                if ($value['image'] == '') {
                    $a[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
                }else{
                    if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                        $a[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                        $galery[$key]['image'] = 'media/'.$value['image'];
                    }else{
                        $a[$key]['image_thumbnail'] = 'media/'.$value['image'];
                        $a[$key]['image'] = 'media/'.$value['image'];
                    }
                }                                                                                                                     
            }
            $this->data['keanggotaan']=$a;
            $result = $this->load->view('keanggotaan_looping',$this->data);
            echo json_encode($result);
        }else{
            $url = URL_GET_INSTANSI_PAGGING.'0';
            $this->data['total_row'] = '10';
            $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where status = 2 AND is_aktif = 1 order by sort ASC LIMIT 0,10";
            $a = $this->db->query($sql)->result_array();
            foreach ($a as $key => $value) {
                if ($value['image'] == '') {
                    $a[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
                }else{
                    if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                        $a[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                        $galery[$key]['image'] = 'media/'.$value['image'];
                    }else{
                        $a[$key]['image_thumbnail'] = 'media/'.$value['image'];
                        $a[$key]['image'] = 'media/'.$value['image'];
                    }
                }                                                                                                                     
            }
            $this->data['keanggotaan']=$a;
            $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
        }

    	// $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }
     function benefit() {
        $url = URL_GET_BENEFIT;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT profit as benefit, cara as step, image as picture, image_profit as picture_profit FROM tb_setting_user";
        $profit['benefit'] = $this->db->query($sql)->row_array()['benefit'];
        $profit['picture'] = $this->db->query($sql)->row_array()['picture_profit'];
        $ret['code'] = '200';
        $retData['status'] = 'Success';
        if ($this->db->query($sql)->row_array()['picture_profit'] == '') {
            $profit['picture']='assets/images/logo/IDREN-2.png';
        }else{
            $profit['picture']='media/'.$this->db->query($sql)->row_array()['picture_profit'];
        }
        $this->data['benefit']=$profit;
        $this->ciparser->new_parse('template_frontend','modules_web', 'benefit_layout',$this->data);
     }
     function pendaftaran() {
        $url = URL_GET_PENDAFTARAN ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('instansi','Institute Name','trim|required');
            $this->form_validation->set_rules('address','Address Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|is_unique[tb_instansi.email]');
            $this->form_validation->set_rules('phone','Phone','trim|required');
            $this->form_validation->set_rules('website','Website','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required|is_unique[tb_instansi.username]');
            $this->form_validation->set_rules('jinstansi','Instansi','trim|required');
            // $this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            // print_r($response);
            // return false;
            // $response['success'] = 1;
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['nm_instansi'] = $data_input['instansi'];
                $data_user['alamat'] = $data_input['address'];
                $data_user['email'] = $data_input['email'];
                $data_user['phone'] = $data_input['phone'];
                $data_user['website'] = $data_input['website'];
                $data_user['username'] = $data_input['username'];
                $data_user['id_jenis_instansi'] = $data_input['jinstansi'];
                $data_user['password'] = sha1('password'.$data_input['username']);
            
                $url = URL_REGISTER ;

                
                $methode = "POST";
                // $ret['cek']=api_helper(json_encode($data_user),$url,$methode,'');
                if ($this->db->get_where('tb_instansi',array('username'=>$data_user['username']))->num_rows() > 0) {
                    $ret['check']['code'] = "500";
                    $ret['status'] = 'Failed';
                    $ret['data'] = "Username alredy exist";
                    $this->response($ret,200);
                    exit();
                }
                if (!$this->db->insert('tb_instansi',$data_user)) {
                    $ret['code'] = "500";
                    $ret['status'] = 'Failed';
                    $ret['data'] = "Can't add user";
                }else{
                    $template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>1,'status'=>1))->row_array()['source_code'];
                    $final = str_replace("Email_User", $data_input['username'], $template);
                    // $final = str_replace("subject_email", "Registrasi", $final);
                    $sender = $this->db->get('tb_setting_email')->row_array();
                    $this->load->helper('email_send_helper');
                    $data_email['email_from'] = $sender['email'];
                    $data_email['name_from'] = $sender['nama_user'];
                    $data_email['email_to'] = $data_input['email'];
                    $data_email['subject'] = "Registerasi";
                    $content = '';
                    $content .= "<tr><td>Username </td><td>:</td> ".$data_input['username']."</td></tr>";
                    $content .= "<tr><td>Instansi </td><td>:</td> ".$data_input['instansi']."</td></tr>";
                    $content .= "<tr><td>Email </td><td>:</td> ".$data_input['email']."</td></tr>";
                    $content .= "<tr><td>Website </td><td>:</td> ".$data_input['website']."</td></tr>";
                    $content .= "<tr><td>Alamat </td><td>:</td> ".$data_input['address']."</td></tr>";
                    $data_email['content'] = str_replace("content_email", $content, $final);
                    if (email_send($data_email) == true) {
                        $ret['cek']['code'] = '200';
                        $ret['status'] = 'Success';
                        $ret['data'] = 'User Has been inserted';
                        $ret['data'] = $template;
                    }else{
                        $ret['cek']['code'] = '500';
                        $ret['status'] = 'failed';
                        $ret['data'] = 'Email Not Send';
                    }
                    if ($ret['cek']['code']=='200') {
                           if (1==1) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('admin/keanggotaan');

                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                        else{
                            $ret['notif']['username-already']='username already exist, please change your username';
                        }
                    }
                    
                }
              
            }else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }
            $ret['notif']['instansi'] = form_error('instansi');
            $ret['notif']['address'] = form_error('address');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['phone'] = form_error('phone');
            $ret['notif']['website'] = form_error('website');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['jinstansi'] = form_error('jinstansi');
            // $ret['notif']['repassword'] = form_error('repassword');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
    
            echo json_encode($ret);
            exit();
        }
        $url = URL_GET_PENDAFTARAN ;
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT profit as benefit, cara as step, image as picture, image_profit as picture_profit FROM tb_setting_user";
        $profit['step'] = $this->db->query($sql)->row_array()['step'];
        $profit['picture'] = $this->db->query($sql)->row_array()['picture'];
        if ($this->db->query($sql)->row_array()['picture'] == '') {
            $profit['picture']='assets/images/logo/IDREN-2.png';
        }else{
            $profit['picture']='media/'.$this->db->query($sql)->row_array()['picture'];
        }
        $this->data = array(
            'action' => site_url('web/keanggotaan/pendaftaran'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['step']=$profit;
        $this->data['instansi'] = $this->db->get('tb_jenis_instansi')->result_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'pendaftaran_layout',$this->data);
     }
     public function search()
     {
        $url_instansi = URL_GET_ALL_INSTANSI ;
        $methode = 'GET';
        $token = '';
        // $b = api_helper('',$url_instansi,$methode,$token);
        $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where is_aktif = 1 AND status = 2 order by -sort DESC";
        $b = $this->db->query($sql)->result_array();
        foreach ($b as $key => $value) {
            if ($value['image'] == '') {
                $b[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $b[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                    $galery[$key]['image'] = 'media/'.$value['image'];
                }else{
                    $b[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $b[$key]['image'] = 'media/'.$value['image'];
                }
            }                                                                                                                     
        }

        $search['search'] = $_GET['data'];
        // $sql = "select * from tb_instansi where nm_instansi like '%".$search['search']."%'";
        // $this->data['total'] = $this->db->query($sql)->num_rows();
        $url=URL_SEARCH_INSTANSI;  
        $methode = 'POST';
        $token='';
        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 10);
            $this->data['total_row'] = $start;
            $search['page'] = $start;
            // $a = api_helper(json_encode($search),$url,$methode,$token);
            $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where status = 2 AND is_aktif = 1 AND nm_instansi like'%".$search['search'] ."%' order by sort ASC LIMIT ".$search['page'].",10";
            $a = $this->db->query($sql)->result_array();
            foreach ($a as $key => $value) {
                if ($value['image'] == '') {
                    $a[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
                }else{
                    if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                        $a[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                        $galery[$key]['image'] = 'media/'.$value['image'];
                    }else{
                        $a[$key]['image_thumbnail'] = 'media/'.$value['image'];
                        $a[$key]['image'] = 'media/'.$value['image'];
                    }
                }                                                                                                                     
            }
            $this->data['total'] = count($a);
            $this->data['keanggotaan']=$a;
            $result = $this->load->view('keanggotaan_looping',$this->data);
            echo json_encode($result);
        }else{
            // $url = base_url().'api/v1/instansi_pagging?data=0';
            // print_r($search);
            $search['page'] = 0;
            $this->data['total_row'] = '10';
            // $a = api_helper(json_encode($search),$url,$methode,$token);
            $sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where status = 2 AND is_aktif = 1 AND nm_instansi like'%".$search['search'] ."%' order by sort ASC LIMIT 0,10";
            $a = $this->db->query($sql)->result_array();
            foreach ($a as $key => $value) {
                if ($value['image'] == '') {
                    $a[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
                }else{
                    if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                        $a[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                        $galery[$key]['image'] = 'media/'.$value['image'];
                    }else{
                        $a[$key]['image_thumbnail'] = 'media/'.$value['image'];
                        $a[$key]['image'] = 'media/'.$value['image'];
                    }
                }                                                                                                                     
            }
            $this->data['total'] = count($a);
            $this->data['keanggotaan']=$a;
            $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_search',$this->data);
        }

    }
    public function pendaftaran_dosen() {
        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl(site_url('web/keanggotaan/facebook/'), $permissions);
        $loginUrl = htmlspecialchars($loginUrl);
        // print_r(PAGE);
        $this->load->library('google',URL_API.'web/keanggotaan/google/');
        // print_r($_SERVER['SERVER_NAME']);
        $methode = 'GET';
        $token = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('instansi','Institute Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|is_unique[tb_pengguna.email]',array('is_unique'=>'email is not available'));
            $this->form_validation->set_rules('no_hp','No. Handphone','trim|required');
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required|min_length[8]|max_length[10]|is_unique[tb_pengguna.username]',array('is_unique'=>'username is not available'));
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['email'] = $data_input['email'];
                $data_user['username'] = $data_input['username'];
                $data_user['id_role_ref'] = 1;
                $data_user['password'] = sha1($this->generate());
                $data_user['id_instansi_ref'] = $data_input['instansi'];
                 if ($this->db->insert('tb_pengguna',$data_user)) {
                    $id = $this->db->insert_id();
                    $dosen['id_pengguna_ref'] = $id;
                    $dosen['no_hp'] = $data_input['no_hp'];
                    $dosen['nama'] = $data_input['name'];
                    if ($this->db->insert('tb_dosen',$dosen)) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('admin/keanggotaan');
                        $this->load->helper('email_send_helper');
                        $data['email_from'] = 'support@IDREN';
                        $data['name_from'] = 'Admin Support';
                        $data['email_to'] = $data_user['email'];
                        $data['subject'] = 'Pendaftaran Berhasil';
                        $data['content'] = 'Halo '.$dosen['nama']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                        if (email_send($data) == true) {
                            $user_data = 'success';
                            $this->session->set_flashdata("header","Registrasi Berhasil");
                            $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                        }
                    }
                 }
              
            }else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }
            $ret['notif']['instansi'] = form_error('instansi');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['no_hp'] = form_error('no_hp');
            $ret['notif']['name'] = form_error('name');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
    
            echo json_encode($ret);
            exit();
        }
        $this->data = array(
            'action' => site_url('web/keanggotaan/pendaftaran'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['loginURL'] = $this->google->loginURL();
        $this->data['fb_data'] = $loginUrl;
        $this->data['instansi'] = $this->db->query('select id_instansi, nm_instansi from tb_instansi where status = 2 and is_aktif = 1')->result_array();
        $this->data['breadcumb'] = 'Dosen';
        $this->data['step']=array('picture'=>'','step'=>'');
        $this->ciparser->new_parse('template_frontend','modules_web', 'pendaftaran_dosen',$this->data);
    }

    public function pendaftaran_mahasiswa() {
        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();
        $permissions = ['email'];
        $loginUrl = $helper->getLoginUrl(site_url('web/keanggotaan/facebook_mahasiswa/'), $permissions);
        $loginUrl = htmlspecialchars($loginUrl);
        $this->load->library('google',URL_API.'web/keanggotaan/google_mahasiswa/');
        $methode = 'GET';
        $token = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('instansi','Institute Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required|is_unique[tb_pengguna.email]',array('is_unique'=>'email is not available'));
            $this->form_validation->set_rules('no_hp','No. Handphone','trim|required');
            $this->form_validation->set_rules('name','name','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required|min_length[8]|max_length[10]|is_unique[tb_pengguna.username]',array('is_unique'=>'username is not available'));
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['email'] = $data_input['email'];
                $data_user['username'] = $data_input['username'];
                $data_user['id_role_ref'] = 0;
                $data_user['password'] = sha1($this->generate());
                $data_user['id_instansi_ref'] = $data_input['instansi'];
                 if ($this->db->insert('tb_pengguna',$data_user)) {
                    $id = $this->db->insert_id();
                    $mahasiswa['id_pengguna_ref'] = $id;
                    $mahasiswa['no_hp'] = $data_input['no_hp'];
                    $mahasiswa['nama'] = $data_input['name'];
                    if ($this->db->insert('tb_mahasiswa',$mahasiswa)) {
                        $ret['status'] = 1;
                        $this->load->helper('email_send_helper');
                        $ret['url'] = site_url('admin/keanggotaan');
                        $data['email_from'] = 'support@IDREN';
                        $data['name_from'] = 'Admin Support';
                        $data['email_to'] = $data_user['email'];
                        $data['subject'] = 'Pendaftaran Berhasil';
                        $data['content'] = 'Halo '.$mahasiswa['nama']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                        if (email_send($data) == true) {
                            $user_data = 'success';
                            $this->session->set_flashdata("header","Registrasi Berhasil");
                            $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                        }
                    }
                 }
              
            }else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }
            $ret['notif']['instansi'] = form_error('instansi');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['no_hp'] = form_error('no_hp');
            $ret['notif']['name'] = form_error('name');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
    
            echo json_encode($ret);
            exit();
        }
        $this->data = array(
            'action' => site_url('web/keanggotaan/pendaftaran'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['loginURL'] = $this->google->loginURL();
        $this->data['fb_data'] = $loginUrl;
        $this->data['instansi'] = $this->db->query('select id_instansi, nm_instansi from tb_instansi where status = 2 and is_aktif = 1')->result_array();
        $this->data['breadcumb'] = 'Mahasiswa';
        $this->data['step']=array('picture'=>'','step'=>'');
        $this->ciparser->new_parse('template_frontend','modules_web', 'pendaftaran_dosen',$this->data);
    }

    function generate(){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
    }

    public function facebook(){
            if(!session_id()) {
                session_start();
            }
        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper(); if (isset($_GET['state'])) { $helper->getPersistentDataHandler()->set('state', $_GET['state']); }

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              // echo 'Graph returned an error: ' . $e->getMessage();
              // echo '<a href="{site_url("web/keanggotaan/pendaftaran_dosen")}">Back to Register Dosen</a>';
              $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';;
              $this->session->set_flashdata('notif',$this->data['error']);
              
              redirect('web/keanggotaan/error'.'/'.$url);
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';
              $this->session->set_flashdata('notif',$this->data['error']);
              
              redirect('web/keanggotaan/error'.'/'.$url);
              exit;
        }
        if (!isset($accessToken)) {
          if ($helper->getError()) {
            // header('HTTP/1.0 401 Unauthorized');
            $this->data['error'] = "Error: " . $helper->getError() . "\n";
            $this->data['error'] .= "Error Code: " . $helper->getErrorCode() . "\n";
            $this->data['error'] .= "Error Reason: " . $helper->getErrorReason() . "\n";
            $this->data['error'] .= "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            // header('HTTP/1.0 400 Bad Request');
            $this->data['error'] = 'Bad request';
          }
          // $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';
              
              $this->session->set_flashdata('notif',$this->data['error']);
              redirect('web/keanggotaan/error'.'/'.$url);
          exit;
        }
        // Logged in
        /*echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());*/

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        /*echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);*/

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(FACEBOOK_APP_ID); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
          // Exchanges a short-lived access token for a long-lived one
          try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';
              $this->session->set_flashdata('notif',$this->data['error']);
              
              redirect('web/keanggotaan/error'.'/'.$url);
            exit;
          }
        }


        $accessToken = (string) $accessToken;
        if(!empty($accessToken)){

            try {
            // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday,location,gender', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';
              $this->session->set_flashdata('notif',$this->data['error']);
              
              redirect('web/keanggotaan/error'.'/'.$url);
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_dosen';
              $this->session->set_flashdata('notif',$this->data['error']);
              
              redirect('web/keanggotaan/error'.'/'.$url);
                exit;
            }
            $me = $response->getGraphUser();
            if ($me->getProperty('email') == null || $me->getProperty('email') == '') {
                // echo 
                $this->data['error'] = urlencode("Tidak ada email yang tertaut dengan Facebook anda, silahkan menggunakan akun lain");
            $this->session->set_flashdata('notif',$this->data['error']);
                $url = 'login_mahasiswa';
                redirect('web/keanggotaan/error'.'/'.$url);
                exit();
            }
        // $this->load->library('facebook','user/login_user/facebook');
        // $userData = array();
        // $ret['status'] = 0;
        // $ret['state'] = 0;
        //     $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
        //     print_r($userProfile);
            // Preparing data for database insertion
            // print_r($userProfile);
            // return false;
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_id'] = $me->getProperty('id');
            $userData['first_name'] = $me->getProperty('first_name');
            $userData['last_name'] = $me->getProperty('last_name');
            $userData['email'] = $me->getProperty('email');
            $userData['gender'] = $me->getProperty('gender');
            $userData['status'] = 'dosen';
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
                }
            }else{
                $this->session->set_flashdata("header","Registrasi Gagal");
                $this->session->set_flashdata("notif","Email pernah didaftarkan sebelumnya, silahkan login untuk masuk");
                redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
            }
        }
    }

    public function google(){
        $this->load->library('google',URL_API.'web/keanggotaan/google/');
        $this->google->getAuthenticate();
        $gpInfo = $this->google->getUserInfo();
        
        //preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_id']      = $gpInfo['id'];
        $userData['first_name']     = $gpInfo['given_name'];
        $userData['last_name']      = $gpInfo['family_name'];
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userData['status']         = 'dosen';
        
        $userID = $this->user->checkUser($userData);
        $this->load->helper('email_send_helper');
        if ($userID == 'insert') {
            $data['email_from'] = 'support@IDREN';
            $data['name_from'] = 'IDREN support';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Pendaftaran Berhasil';
            $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Registrasi Berhasil");
                $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
            }
        }else{
            $this->session->set_flashdata("header","Registrasi Gagal");
            $this->session->set_flashdata("notif","Email pernah didaftarkan sebelumnya, silahkan login untuk masuk");
            redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
        }
    }

    public function facebook_mahasiswa(){

        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper(); if (isset($_GET['state'])) { $helper->getPersistentDataHandler()->set('state', $_GET['state']); }

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
              exit;
        }
        if (!isset($accessToken)) {
          if ($helper->getError()) {
            // header('HTTP/1.0 401 Unauthorized');
            $this->data['error'] = "Error: " . $helper->getError() . "\n";
            $this->data['error'] .= "Error Code: " . $helper->getErrorCode() . "\n";
            $this->data['error'] .= "Error Reason: " . $helper->getErrorReason() . "\n";
            $this->data['error'] .= "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            // header('HTTP/1.0 400 Bad Request');
            $this->data['error'] = 'Bad request';
          }
          // $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
          exit;
        }
        // Logged in
        /*echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());*/

        // The OAuth 2.0 client handler helps us manage access tokens
        $oAuth2Client = $fb->getOAuth2Client();

        // Get the access token metadata from /debug_token
        $tokenMetadata = $oAuth2Client->debugToken($accessToken);
        /*echo '<h3>Metadata</h3>';
        var_dump($tokenMetadata);*/

        // Validation (these will throw FacebookSDKException's when they fail)
        $tokenMetadata->validateAppId(FACEBOOK_APP_ID); // Replace {app-id} with your app id
        // If you know the user ID this access token belongs to, you can validate it here
        //$tokenMetadata->validateUserId('123');
        $tokenMetadata->validateExpiration();

        if (! $accessToken->isLongLived()) {
          // Exchanges a short-lived access token for a long-lived one
          try {
            $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
          } catch (Facebook\Exceptions\FacebookSDKException $e) {
            $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
            exit;
          }
        }


        $accessToken = (string) $accessToken;
        if(!empty($accessToken)){

            try {
            // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday,location,gender', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                $this->data['error'] = $e->getMessage();
              $url = 'pendaftaran_mahasiswa';
              redirect('web/keanggotaan/error'.'/'.$url.'/'.$this->data['error']);
                exit;
            }
            $me = $response->getGraphUser();
        // $this->load->library('facebook','user/login_user/facebook');
        // $userData = array();
        // $ret['status'] = 0;
        // $ret['state'] = 0;
        //     $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');
        //     print_r($userProfile);
            // Preparing data for database insertion
            // print_r($userProfile);
            // return false;
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_id'] = $me->getProperty('id');
            $userData['first_name'] = $me->getProperty('first_name');
            $userData['last_name'] = $me->getProperty('last_name');
            $userData['email'] = $me->getProperty('email');
            $userData['gender'] = $me->getProperty('gender');
            $userData['status'] = 'mahasiswa';
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('web/keanggotaan/pendaftaran_mahasiswa'));
                }
            }else{
                $this->session->set_flashdata("header","Registrasi Gagal");
                $this->session->set_flashdata("notif","Email Anda pernah didaftarkan sebelumnya, silahkan login untuk masuk");
                redirect(site_url('web/keanggotaan/pendaftaran_mahasiswa'));
            }
        }
    }

    public function google_mahasiswa(){
        $this->load->library('google',URL_API.'web/keanggotaan/google_mahasiswa/');
        $this->google->getAuthenticate();
        $gpInfo = $this->google->getUserInfo();
        // print_r($gpInfo);
        // return false;
        //preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_id']      = $gpInfo['id'];
        $userData['first_name']     = $gpInfo['given_name'];
        $userData['last_name']      = $gpInfo['family_name'];
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userData['status'] = 'mahasiswa';
        
        $userID = $this->user->checkUser($userData);
        if ($userID == 'insert') {
        $this->load->helper('email_send_helper');
            $data['email_from'] = 'support@IDREN';
            $data['name_from'] = 'IDREN support';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Pendaftaran Berhasil';
            $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                // print_r($data);
                $em = email_send($data);
                // print_r($em);
                // return false;
            if ($em == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Registrasi Berhasil");
                $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                redirect(site_url('web/keanggotaan/pendaftaran_mahasiswa'));
            }
        }else{
            print_r('gagal');
            $this->session->set_flashdata("header","Registrasi Gagal");
            $this->session->set_flashdata("notif","Email pernah didaftarkan sebelumnya, silahkan login untuk masuk");
            redirect(site_url('web/keanggotaan/pendaftaran_mahasiswa'));
        }
    }

    public function email(){
        $this->load->helper('email_send_helper');
            $data['email_from'] = 'support@IDREN';
            $data['name_from'] = 'IDREN support';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Pendaftaran Berhasil';
            $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Registrasi Berhasil");
                $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                redirect(site_url('web/keanggotaan/pendaftaran_mahasiswa'));
            }
    }

    public function error($url=null,$error=null){
        $a = urldecode($error);
        $this->data['url'] = $url;
        $this->data['error'] = $a;
        $this->ciparser->new_parse('template_frontend','modules_web', 'error_layout',$this->data);    
    }
}


