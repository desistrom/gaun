<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Login_user extends MX_Controller  {
	var $data = array();

	function __construct(){
	$this->load->library('Recaptcha');
    $this->load->library('google');
    $this->load->library('facebook');
    $this->load->model('user');
    $this->load->helper('api');

	}
    public function index() {

        if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $username = $this->input->post('username');
                $password = sha1($this->input->post('password'));
                $sql = "SELECT * FROM tb_pengguna WHERE username = ? AND password = ? AND status = 1 AND id_role_ref = 1";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    // $this->session->set_userdata('data_user', $data_user);
                    // $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    // $this->session->set_userdata('is_login', true);
                    // $this->session->set_flashdata("header","Registrasi Berhasil");
                    // $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // print_r($result);
                    setcookie('user',json_encode($result['token']), time()+"3600","/");
                    // print_r($data_token);
                    $this->session->set_userdata('token', $result['token']);
                    $ret['url'] = site_url('user/dashboard');

                }else{
                    $ret['notif']['login'] = 'username, password worng or user not active';
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
      
    	$this->data = array(
            'action' => site_url('web/keanggotaan/pendaftaran'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['loginURL'] = $this->google->loginURL();
        $this->load->view('login-user',$this->data);
    }

    public function login_mahasiswa() {

        if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $username = $this->input->post('username');
                $password = sha1($this->input->post('password'));
                $sql = "SELECT * FROM tb_pengguna WHERE username = ? AND password = ? AND status = 1 AND id_role_ref = 0";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    // $this->session->set_userdata('data_user', $data_user);
                    // $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    // $this->session->set_userdata('is_login', true);
                    // $this->session->set_flashdata("header","Registrasi Berhasil");
                    // $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // print_r($result);
                    setcookie('user',json_encode($result['token']), time()+"3600","/");
                    // print_r($data_token);
                    $this->session->set_userdata('token', $result['token']);
                    $ret['url'] = site_url('user/dashboard');

                }else{
                    $ret['notif']['login'] = 'username, password worng or user not active';
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
      
        $this->data = array(
            'action' => site_url('web/keanggotaan/pendaftaran'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['loginURL'] = $this->google->loginURL();
        $this->load->view('login-user',$this->data);
    }

    public function facebook(){

        $userData = array();
        $ret['status'] = 0;
        $ret['state'] = 0;
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_id'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['id_role_ref']    = 1;
            $userData['gender'] = $userProfile['gender'];
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('user/login_user'));
                }
            }else{
                if ($userID == 'no') {
	                $this->session->set_flashdata("header","Login Gagal");
	                $this->session->set_flashdata("notif","Akun Anda belum aktif, silahkan menunggu konformasi dari admin");
	                redirect(site_url('user/login_user'));

                }elseif ($userID == 'salah') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda tidak memiliki akses, silahkan menggunakan akun lain");
                    redirect(site_url('user/login_user'));
                }else{
	                $this->session->set_userdata('user_login',true);
	                $this->session->set_userdata('user',$userID);
	                redirect(site_url('user/dashboard'));
                }
            }
    }

    public function google(){
        $this->google->getAuthenticate();
            
        //get user info from google
        $gpInfo = $this->google->getUserInfo();
        
        //preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_id']      = $gpInfo['id'];
        $userData['first_name']     = $gpInfo['given_name'];
        $userData['last_name']      = $gpInfo['family_name'];
        $userData['id_role_ref']    = 1;
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userID = $this->user->checkUser($userData);
        $this->load->helper('email_send_helper');
        if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('user/login_user'));
                }
            }else{
                if ($userID == 'no') {
	                $this->session->set_flashdata("header","Login Gagal");
	                $this->session->set_flashdata("notif","Akun Anda pernah belum aktif, silahkan menunggu konformasi dari admin");
	                redirect(site_url('user/login_user'));

                }elseif ($userID == 'salah') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda tidak memiliki akses, silahkan menggunakan akun lain");
                    redirect(site_url('user/login_user'));
                }else{
	                $this->session->set_userdata('user_login',true);
	                $this->session->set_userdata('user',$userID);
	                redirect(site_url('user/dashboard'));
                }
            }
    }

    public function facebook_mahasiswa(){

        $userData = array();
        $ret['status'] = 0;
        $ret['state'] = 0;
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_id'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['id_role_ref']    = 0;
            $userData['gender'] = $userProfile['gender'];
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('user/login_user/login_mahasiswa'));
                }
            }else{
                if ($userID == 'no') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda pernah belum aktif, silahkan menunggu konformasi dari admin");
                    redirect(site_url('user/login_user/login_mahasiswa'));

                }elseif ($userID == 'salah') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda tidak memiliki akses, silahkan menggunakan akun lain");
                    redirect(site_url('user/login_user/login_mahasiswa'));
                }else{
                    $this->session->set_userdata('user_login',true);
                    $this->session->set_userdata('user',$userID);
                    redirect(site_url('user/dashboard'));
                }
            }
    }

    public function google_mahasiswa(){
        $this->google->getAuthenticate();
            
        //get user info from google
        $gpInfo = $this->google->getUserInfo();
        
        //preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_id']      = $gpInfo['id'];
        $userData['first_name']     = $gpInfo['given_name'];
        $userData['last_name']      = $gpInfo['family_name'];
        $userData['email']          = $gpInfo['email'];
        $userData['id_role_ref']    = 0;
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userID = $this->user->checkUser($userData);
        $this->load->helper('email_send_helper');
        if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.
terima kasih";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('user/login_user/login_mahasiswa'));
                }
            }else{
                if ($userID == 'no') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda belum aktif, silahkan menunggu konformasi dari admin");
                    redirect(site_url('user/login_user/login_mahasiswa'));

                }elseif ($userID == 'salah') {
                    $this->session->set_flashdata("header","Login Gagal");
                    $this->session->set_flashdata("notif","Akun Anda tidak memiliki akses, silahkan menggunakan akun lain");
                    redirect(site_url('user/login_user/login_mahasiswa'));
                }else{
                    $this->session->set_userdata('user_login',true);
                    $this->session->set_userdata('user',$userID);
                    redirect(site_url('user/dashboard'));
                }
            }
    }
  



}