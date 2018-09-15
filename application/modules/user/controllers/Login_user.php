<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
    /*require APPPATH.'third_party/facebook/Facebook/FacebookSession.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookRedirectLoginHelper.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookRequest.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookResponse.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookSDKException.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookRequestException.php';
    require APPPATH.'third_party/facebook/Facebook/FacebookAuthorizationException.php';
    require APPPATH.'third_party/facebook/Facebook/GraphObject.php';
    require APPPATH.'third_party/facebook/Facebook/Entities/AccessToken.php';
    require APPPATH.'third_party/facebook/Facebook/HttpClients/FacebookHttpable.php';
    require APPPATH.'third_party/facebook/Facebook/HttpClients/FacebookCurlHttpClient.php';

        use Facebook\FacebookSession;
        use Facebook\FacebookRedirectLoginHelper;
        use Facebook\FacebookRequest;
        use Facebook\FacebookResponse;
        use Facebook\FacebookSDKException;
        use Facebook\FacebookRequestException;
        use Facebook\FacebookAuthorizationException;
        use Facebook\GraphObject;
        use Facebook\Entities\AccessToken;
        use Facebook\HttpClients\FacebookHttpable;
        use Facebook\HttpClients\FacebookCurlHttpClient;*/
        // init app with app id and secret
    require_once(APPPATH.'third_party/Facebook/autoload.php');
class Login_user extends MX_Controller  {
    var $data = array();

    function __construct(){
    $this->load->library('Recaptcha');
    // $this->load->library('google');
    // $this->load->library('facebook');
    $this->load->model('user');
    $this->load->helper('api');
        // $this->load->model('Facebook_model','user/login_user/');

    }
    public function index() {
        // $this->load->library('facebook','user/login_user/facebook');
        // $this->fb_dosen();
            $this->load->library('google',URL_API.'user/login_user/google/');
            $fb = new Facebook\Facebook([
                  'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
                  'app_secret' => FACEBOOK_APP_SECRET,
                  'default_graph_version' => 'v2.2',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl(site_url('user/login_user/facebook'), $permissions);
            $loginUrl = htmlspecialchars($loginUrl);
            

        // print_r(PAGE);
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
                    $this->session->set_userdata('data_user', $data_user);
                    $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('user_login', true);
                    $this->session->set_flashdata("header","Registrasi Berhasil");
                    $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    // $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // print_r($result);
                    // setcookie('user',json_encode($result['token']), time()+"3600","/");
                    // print_r($data_token);
                    // $this->session->set_userdata('token', $result['token']);
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
        // print_r($this->session->userdata('fb_data'));
        // $fb_data = $this->session->userdata('fb_data');
        $this->data['fb_data'] = $loginUrl;
        $this->data['loginURL'] = $this->google->loginURL();
        $this->load->view('login-user',$this->data);
    }

    public function login_mahasiswa() {
        $fb = new Facebook\Facebook([
                  'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
                  'app_secret' => FACEBOOK_APP_SECRET,
                  'default_graph_version' => 'v2.2',
            ]);
            $helper = $fb->getRedirectLoginHelper();
            $permissions = ['email'];
            $loginUrl = $helper->getLoginUrl(site_url('user/login_user/facebook_mahasiswa'), $permissions);
            $loginUrl = htmlspecialchars($loginUrl);
        $this->load->library('google',URL_API.'user/login_user/google_mahasiswa/');
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
                    $this->session->set_userdata('data_user', $data_user);
                    $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('user_login', true);
                    // $this->session->set_flashdata("header","Registrasi Berhasil");
                    // $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    // $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // print_r($result);
                    // setcookie('user',json_encode($result['token']), time()+"3600","/");
                    // print_r($data_token);
                    // $this->session->set_userdata('token', $result['token']);
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
        $this->data['fb_data'] = $loginUrl;
        $this->data['loginURL'] = $this->google->loginURL();
        $this->load->view('login-user',$this->data);
    }

    public function facebook(){
        // if(!session_id()) {
        //     session_start();
        // }

        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              echo '<a href="{site_url("user/login_user")}">Back to Balaisehat</a>';
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              echo '<a href="{site_url()}">Back to Balaisehat</a>';
              exit;
        }
        if (!isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          echo '<a href="{site_url()}">Back to Balaisehat</a>';
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
            echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
            echo '<a href="{site_url()}">Back to Balaisehat</a>';
            exit;
          }
        }


        $accessToken = (string) $accessToken;
        if(!empty($accessToken)){

            try {
            // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday,location,gender', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                echo '<a href="{site_url()}">Back to Balaisehat</a>';
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                echo '<a href="{site_url()}">Back to Balaisehat</a>';
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
            $userData['id_role_ref']    = 1;
            $userData['gender'] = $me->getProperty('gender');
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.<br>
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.<br>
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
    }

    public function google(){
        $this->load->library('google',URL_API.'user/login_user/google/');
        $this->google->getAuthenticate();
            
        //get user info from google
        $gpInfo = $this->google->getUserInfo();
        // print_r($gpInfo);
        // return false;
        
        //preparing data for database insertion
        $userData['oauth_provider'] = 'google';
        $userData['oauth_id']      = $gpInfo['id'];
        $userData['first_name']     = $gpInfo['given_name'];
        $userData['last_name']      = $gpInfo['family_name'];
        $userData['id_role_ref']    = 1;
        $userData['email']          = $gpInfo['email'];
        $userData['gender']         = !empty($gpInfo['gender'])?$gpInfo['gender']:'';
        $userID = $this->user->checkUser($userData);
        // print_r($userID);
        // return false;
        $this->load->helper('email_send_helper');
        if ($userID == 'insert') {
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.<br>
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.<br>
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

    public function facebook_mahasiswa(){
        $fb = new Facebook\Facebook([
              'app_id' => FACEBOOK_APP_ID, // Replace {app-id} with your app id
              'app_secret' => FACEBOOK_APP_SECRET,
              'default_graph_version' => 'v2.2',
        ]);
        $helper = $fb->getRedirectLoginHelper();

        try {
          $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
              // When Graph returns an error
              echo 'Graph returned an error: ' . $e->getMessage();
              echo '<a href="{site_url("user/login_user")}">Back to Balaisehat</a>';
          exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
              // When validation fails or other local issues
              echo 'Facebook SDK returned an error: ' . $e->getMessage();
              echo '<a href="{site_url()}">Back to Balaisehat</a>';
              exit;
        }
        if (!isset($accessToken)) {
          if ($helper->getError()) {
            header('HTTP/1.0 401 Unauthorized');
            echo "Error: " . $helper->getError() . "\n";
            echo "Error Code: " . $helper->getErrorCode() . "\n";
            echo "Error Reason: " . $helper->getErrorReason() . "\n";
            echo "Error Description: " . $helper->getErrorDescription() . "\n";
          } else {
            header('HTTP/1.0 400 Bad Request');
            echo 'Bad request';
          }
          echo '<a href="{site_url()}">Back to Balaisehat</a>';
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
            echo "<p>Error getting long-lived access token: " . $e->getMessage() . "</p>\n\n";
            echo '<a href="{site_url()}">Back to Balaisehat</a>';
            exit;
          }
        }


        $accessToken = (string) $accessToken;
        if(!empty($accessToken)){

            try {
            // Returns a `Facebook\FacebookResponse` object
              $response = $fb->get('/me?fields=id,name,email,first_name,last_name,birthday,location,gender', $accessToken);
            } catch(Facebook\Exceptions\FacebookResponseException $e) {
                echo 'Graph returned an error: ' . $e->getMessage();
                echo '<a href="{site_url()}">Back to Balaisehat</a>';
                exit;
            } catch(Facebook\Exceptions\FacebookSDKException $e) {
                echo 'Facebook SDK returned an error: ' . $e->getMessage();
                echo '<a href="{site_url()}">Back to Balaisehat</a>';
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
            $userData['id_role_ref']    = 0;
            $userData['gender'] = $me->getProperty('gender');
            $userID = $this->user->checkUser($userData);
            // Check user data insert or update status
            $this->load->helper('email_send_helper');
            if ($userID == 'insert') {
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.<br>
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.<br>
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
    }

    public function google_mahasiswa(){
        $this->load->library('google',URL_API.'user/login_user/google_mahasiswa/');
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
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $userData['email'];
                $data['subject'] = 'Pendaftaran Berhasil';
                $data['content'] = 'Halo '.$userData['first_name']." ".$userData['last_name']."<br> request akun anda sedang diproses, silakan ditunggu.<br>
admin kami akan mengirimkan email notifikasi aktivasi akun anda dalam 1 x 24 jam dari waktu pendaftaran.<br>
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
    
    public function logout(){
        $this->session->sess_destroy();
        redirect(site_url('user/login_user'));
    }

    public function fb_dosen(){
        $config = array(
                        'appId'  => FACEBOOK_APP_ID,
                        'secret' => FACEBOOK_APP_SECRET,
                        'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
                        );
        
        $this->load->library('Facebook', $config);
        $user = $this->facebook->getUser();
        // print_r($user);
        // We may or may not have this data based on whether the user is logged in.
        //
        // If we have a $user id here, it means we know the user is logged into
        // Facebook, but we don't know if the access token is valid. An access
        // token is invalid if the user logged out of Facebook.
        $profile = null;
        if($user)
        {
            try {
                // Proceed knowing you have a logged in user who's authenticated.
                $profile = $this->facebook->api('//me?fields=id,first_name,last_name,email,gender,locale,picture');
                $fb_data['jun'] = 'junaedi';
            } catch (FacebookApiException $e) {
                error_log($e);
                $user = null;
            }       
        }
        
        $fb_data = array(
                        'me' => $profile,
                        'uid' => $user,
                        'loginUrl' => $this->facebook->getLoginUrl(
                            array(
                                'scope' => 'email', // app permissions
                                'redirect_uri' => base_url().'user/login_user/jadi/' // URL where you want to redirect your users after a successful login
                            )
                        ),
                        'logoutUrl' => $this->facebook->getLogoutUrl(),
                    );

        $this->session->set_userdata('fb_data', $fb_data);
    }

    public function jadi(){
        print_r($this->session->userdata('fb_data'));
    }


}