<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Gabung extends MX_Controller  {
		var $data = array();

	function __construct(){
		$this->load->helper('api');

	}
    function index() {


    	$this->ciparser->new_parse('template_frontend','modules_web', 'gabung_layout');
    }
    function register() {
        $url = site_url('api/v1/insert_user') ;

        $this->ciparser->new_parse('template_frontend','modules_web', 'register_layout');
    }
     public function insert_user(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('name','Nama Lengkap','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Passowrd','trim|required');
            $this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
            $this->form_validation->set_rules('email','email','trim|required');
            $this->form_validation->set_rules('phone','phone','trim|required');
            $this->form_validation->set_rules('instansi','Instansi','trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['name'] = $data_input['name'];
                $data_user['username'] = $data_input['username'];
                $data_user['password'] = sha1($data_input['password']);
                $data_user['email'] = $data_input['email'];
                $data_user['number_phone'] = $data_input['phone'];
                $data_user['institusi'] = $data_input['instansi'];
                $url = base_url()."/api/v1/insert_user";
                $methode = "POST";
                if (api_helper(json_encode($data_user),$url,$methode,'')) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('admin/keanggotaan');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['name'] = form_error('name');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['repassword'] = form_error('repassword');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['phone'] = form_error('phone');
            $ret['notif']['instansi'] = form_error('instansi');
            echo json_encode($ret);
            exit();
        }
    }
  
}