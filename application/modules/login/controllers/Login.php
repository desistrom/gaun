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
            		$this->session->set_userdata('token', $this->token($data_user['id_user']));
            		$this->session->set_userdata('previlage', $data_user['id_role_ref']);
            		$this->session->set_userdata('is_login', true);
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
        $tokenData['timestamp'] = time();
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        // $this->set_response($output, REST_Controller::HTTP_OK);
        return $output['token'];
    }
    public function token_post(){
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);
            // return response if token is valid
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}