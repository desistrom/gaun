<?php

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
                $sql = "SELECT * FROM tb_journal_user WHERE username = ? AND password = ?";
                $data = $this->db->query($sql,[$username,$password]);
                if ($data->num_rows() == 1) {
                    $ret['status'] = 1;
                    $data_user = $data->row_array();
                    $this->session->set_userdata('data_user_journal', $data_user);
                    // $this->session->set_userdata('previlage', $data_user['id_role_ref']);
                    $this->session->set_userdata('journal_login', true);
                    $data_token['username'] = $username;
                    $data_token['password'] = $password;
                    $url = URL_GET_TOKEN;
                    $method = 'POST';
                    $token = "";
                    $ret['url'] = site_url('journal/admin');

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

    public function reset_password(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('email','E-Mail', 'required');
            if ($this->form_validation->run() == true) {
                $input = $this->input->post();
                $sql = $this->db->get_where('tb_instansi',array('email'=>$input['email']));
                if ($sql->num_rows() > 0) {
                    $ret['state'] = 1;
                    $user = $sql->row_array();
                    $mail = sha1($user['email']);
                    $reset = $mail.$user['password'];
                    $this->load->helper('email_send_helper');
                    $data['email_from'] = 'support@IDREN';
                    $data['name_from'] = 'IDREN support';
                    $data['email_to'] = $user['email'];
                    $data['subject'] = 'Request reset Password';
                    $data['content'] = 'Ini Adalah link reset Password anda<br/>'.site_url('instansi/login/reset?data='.$reset);
                    if (email_send($data) == true) {
                        $this->db->update('tb_instansi',array('reset'=>$reset),array('id_instansi'=>$user['id_instansi']));
                        $user_data = 'success';
                        $ret['status'] = 1;
                        $this->session->set_flashdata("header","Request Reset Password Berhasil");
                        $this->session->set_flashdata("notif","Email Request Reset Password berhasil dikirim ke E-mail anda, Silahkan kunjungi link yang kami berikan");
                        // redirect(site_url('dashboard/reset_password'));
                    }
                }else{
                    $ret['notif']['login'] = 'E-mail tidak terdaftar, pastikan email yang anda masukan benar';
                }
            }
            $ret['notif']['current'] = form_error('current');
            echo json_encode($ret);
            exit();
        }
        $this->ciparser->new_parse('template_frontend','modules_user', 'reset_pass');
        // $this->load->view('reset_pass',$this->data);
        // $this->ciparser->new_parse('template_user','modules_user', 'reset_password_layout',$this->data);
    }

    public function reset(){
        $input = $this->input->get('data');
        $data = $this->db->get_where('tb_instansi',array('reset'=>$input));
        if ($data->num_rows() == 0) {
               redirect(site_url('instansi/login/link_expired'));
           }   
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('new','New Password', 'required');
            $this->form_validation->set_rules('re','Re-type New Password', 'required|matches[new]');
            if ($this->form_validation->run() == true) {
                $input = $this->input->post();
                    $ret['state'] = 1;
                    $data_user['password'] = $input['new'];
                    if ($this->db->update('tb_instansi',array('password'=>sha1($input['new']),'reset'=>''),array('id_instansi'=>$data->row_array()['id_instansi']))) {
                        $ret['status'] = 1;
                        $this->session->set_flashdata("header","Reset Password Berhasil");
                        $this->session->set_flashdata("notif","Reset Password Berhasil, silahkan login untuk melanjutkan");
                        // if ($data->row_array()['id_role_ref'] == 0) {
                        $ret['url'] = site_url('instansi/login');
                        // }else{
                        //     $ret['url'] = site_url('user/login_user');
                        // }
                    }
            }
            $ret['notif']['new'] = form_error('new');
            $ret['notif']['re'] = form_error('re');
            echo json_encode($ret);
            exit();
        }
        $this->ciparser->new_parse('template_frontend','modules_user', 'reset_layout');
        // $this->load->view('reset_layout',$this->data);
    }

    public function link_expired(){
        echo "<h2>Link expired</h2><h3><a href='".site_url('instansi/login/reset_password')."'>Back to Reset Password</a>";
    }

    public function logout(){
        // $this->session->sess_destroy();
        $this->session->unset_userdata('data_user_journal');
        $this->session->unset_userdata('journal_login');
        redirect(site_url('journal/login'));
    }
}