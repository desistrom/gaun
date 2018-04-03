<?php 

/**
* 
*/
class Login extends MX_Controller
{
        var $idUser;

    function __construct()
    {
    	// $this->load->model('login_model');
        $this->load->helper('api');
    }

    public function index(){
    	if($this->input->method() == 'post'){
    		$ret['state'] = 0;
    		$ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            if ($this->form_validation->run() == true) {
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
                    $url = site_url('jwt/authtimeout/token');
                    $method = 'POST';
                    $token = "";
                    $result = api_helper(json_encode($data_token),$url,$method,$token);
                    // print_r($result);
                    // print_r($data_token);
            		$this->session->set_userdata('token', $result['token']);
            		$ret['url'] = site_url('admin/home');

            	}else{
                    $ret['notif']['login'] = 'username or password worng';
                }
            }
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            echo  json_encode($ret);
            exit();
        }
        $this->load->view('login_layout.php');
    }

    public function logout(){
    	$this->session->sess_destroy();
    	redirect(site_url('login'));
    }
    function token($id)
    {
        $tokenData = array();
        $tokenData['id'] = $id;
        $tokenData['timestamp'] = now();
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        // $this->set_response($output, REST_Controller::HTTP_OK);
        return $output['token'];
    }
    public function token_check(){
        $headers = $this->session->userdata('token');
        // if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers);
            // return response if token is valid
            if ($decodedToken != false) {
                return 1;
            }else{
                return 0;
            }
        // }
        // $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}