<?php 

/**
* 
*/
class Login extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
    	// $this->load->model('login_model');
        // $this->load->helper('api');
        $this->load->library('Recaptcha');
        $this->load->module('Token');
        // $this->load->library('jwt');
    }

    public function index(){
        // print_r(file_get_contents(FCPATH."media/15264596851.jpg"));
        if($this->input->method() == 'post'){
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            // $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            // $recaptcha = $this->input->post('g-recaptcha-response');
            // $response = $this->recaptcha->verifyResponse($recaptcha);
            /*print_r($response);
            return false;*/
            // $response['success'] = 1;
            // if ($this->form_validation->run() == true && $response['success'] == 1) {
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $username = $this->input->post('username');
                $password = sha1($this->input->post('password'));
                $sql = "SELECT * FROM tb_user WHERE username = ? AND password = ?";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    /*$this->session->set_userdata('data_user', $data_user);
                    $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('is_login', true);*/
                    $data_token = $username;
                    // $data_token['password'] = $password;
                    // $url = URL_GET_TOKEN;
                    // $method = 'POST';
                    // $token = "";
                    $a = generate_token_jwt($data_user);
                    setcookie('data_admin',$a,time() + (3600 * 30), "/");
                    // print_r($_COOKIE['data_admin']);
            		$ret['url'] = site_url('admin');

            	}else{
                    $ret['notif']['login'] = 'username or password worng';
                }
            }/*else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }*/
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            // $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
            echo  json_encode($ret);
            exit();
        }
        // $this->data['captcha'] = $this->recaptcha->getWidget();
        $this->data['action'] = site_url('login');
        // $this->data['script_captcha'] = $this->recaptcha->getScriptTag();
        $this->load->view('login_layout',$this->data);
    }

    public function logout(){
    	$this->session->sess_destroy();
    	redirect(site_url('login'));
    }

    public function token_post($data)
    {
        require(APPPATH.'libraries/REST_Controller.php');
        // require APPPATH . '/libraries/REST_Controller.php';
        // $this->load->library('REST_Controller');
        $tokenData = array();
        $tokenData['id']['username'] = $data['username']; 
        $tokenData['id']['password'] = $data['password']; 
        $tokenData['timestamp'] = now();
        $output['status'] = "ok";
        $output['data'] = $data;
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $result = $this->REST_Controller->set_response($output, REST_Controller::HTTP_OK);
        return $output['token'];
    }

    public function generate_token($user_id){
        $this->load->library("jwt");
        $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        $CONSUMER_TTL = 86400;
        $token =  $this->jwt->encode(array(
          'consumerKey'=>$CONSUMER_KEY,
          'userId'=>$user_id,
          'issuedAt'=>date(DATE_ISO8601, strtotime("now")),
          'ttl'=>$CONSUMER_TTL
        ), $CONSUMER_SECRET);
        // $token = 'a';
        return $token;
    }

    public function decode_token(){
        $this->load->library("jwt");
        // $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        // $CONSUMER_TTL = 86400;
        $token = $_COOKIE['token'];
        $data =  $this->jwt->decode($token, $CONSUMER_SECRET);
        // $token = 'a';
        if (is_object($data)) {
            return true;
        }else{
            return false;
        }
    }
}