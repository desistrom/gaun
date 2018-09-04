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

	}
    public function index() {
      
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

        // Check if user is logged in
        // if($this->facebook->is_authenticated()){
            // Get user facebook profile details
            $userProfile = $this->facebook->request('get', '/me?fields=id,first_name,last_name,email,gender,locale,picture');

            // Preparing data for database insertion
            $userData['oauth_provider'] = 'facebook';
            $userData['oauth_id'] = $userProfile['id'];
            $userData['first_name'] = $userProfile['first_name'];
            $userData['last_name'] = $userProfile['last_name'];
            $userData['email'] = $userProfile['email'];
            $userData['gender'] = $userProfile['gender'];
            /*$userData['locale'] = $userProfile['locale'];
            $userData['profile_url'] = 'https://www.facebook.com/'.$userProfile['id'];
            $userData['picture_url'] = $userProfile['picture']['data']['url'];*/

            // Insert or update user data
            // print_r($userData);
            // return false;
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> Permintaan sedang diproses, harap bersabar";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
                }
            }else{
                if ($userID == 'no') {
	                $this->session->set_flashdata("header","Login Gagal");
	                $this->session->set_flashdata("notif","Akun Anda pernah belum aktif, silahkan menunggu konformasi dari admin");
	                redirect(site_url('user/login_user'));

                }else{
	                $this->session->set_userdata('user_login',true);
	                $this->session->set_userdata('user',$userID);
	                redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
                }
            }

            // Get logout URL
            $data['logoutUrl'] = $this->facebook->logout_url();
        // }else{
            // $fbuser = '';

            // Get login URL
            // $data['authUrl'] =  $this->facebook->login_url();
        // }

        // Load login & profile view
        // $this->load->view('index_facebook',$data);
        
                // redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
        // echo json_encode($ret);
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
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userID = $this->user->checkUser($userData);
        // print_r($userID.'asdas<br>');
        // print_r($gpInfo);
        // return false;
        $this->load->helper('email_send_helper');
        if ($userID == 'insert') {
                $data['email_from'] = 'support@idren';
                $data['name_from'] = 'Admin Support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> Permintaan sedang diproses, harap bersabar";
                if (email_send($data) == true) {
                    $user_data = 'success';
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
                }
            }else{
                if ($userID == 'no') {
	                $this->session->set_flashdata("header","Login Gagal");
	                $this->session->set_flashdata("notif","Akun Anda pernah belum aktif, silahkan menunggu konformasi dari admin");
	                redirect(site_url('user/login_user'));

                }else{
	                $this->session->set_userdata('user_login',true);
	                $this->session->set_userdata('user',$userID);
	                redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
                }
            }
        // print_r($userID);
        // return f
        // $this->session->set_flashdata("notif","Data Berhasil di Masukan");
        //store status & user info in session
        // $this->session->set_userdata('loggedIn', true);
        // $this->session->set_userdata('userData', $userData);
        
        //redirect to profile page
        // if ($userID == 'success') {
            // redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
        // }
    }
  



}