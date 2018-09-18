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
        $this->load->helper('api');
        $this->load->library('Recaptcha');
        $this->load->module('Token');
    }

    public function index(){
        // print_r(file_get_contents(FCPATH."media/15264596851.jpg"));
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
                $sql = "SELECT * FROM tb_user WHERE username = ? AND password = ?";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    $this->session->set_userdata('data_user', $data_user);
                    $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('is_login', true);
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    // $this->load->library('../modules/login/controllers/token');
                    // $a modules::run('module/jwt/token_post', $data_token);
                    // $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // $result = file_get_contents(site_url('login/token/token').'/'.$username.'/'.$password);
                    // $token_jwt = json_decode($result,true);
                    /*$a = $this->token->token_get($username,$password);
                    print_r($a);
                    return false;*/
                    // print_r($result);
                    // print_r($data_token);
            		// $this->session->set_userdata('token', $data_token);
            		$ret['url'] = site_url('login/token/token').'/'.$username.'/'.$password;

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

    public function hmm(){
        $request = new HttpRequest();
        $request->setUrl('http://localhost/idren/login/jwt/token');
        $request->setMethod(HTTP_METH_POST);

        $request->setHeaders(array(
          'postman-token' => '5ec9b16c-3eda-96af-a06d-186577f2e75e',
          'cache-control' => 'no-cache',
          'content-type' => 'application/json'
        ));

        $request->setBody('{
          "username" : "admin",
          "password" : "qwerty"
        }');

        try {
          $response = $request->send();

          echo $response->getBody();
        } catch (HttpException $ex) {
          echo $ex;
        }
    }
}