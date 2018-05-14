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
    }

    public function index(){
    	if($this->input->method() == 'post'){
    		$ret['state'] = 0;
    		$ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('username','username', 'required');
            $this->form_validation->set_rules('password','password', 'required');
            //$this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            /*print_r($response);
            return false;*/
            $response['success'] = 1;
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
                    $url = site_url('api/v1/token');
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
}