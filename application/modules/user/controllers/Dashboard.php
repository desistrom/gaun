<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Dashboard extends MX_Controller  {
	var $data = array();
	function __construct(){
		if ($this->session->userdata('user_login') != true) {
			redirect('user/login_user');
		}
		$this->load->helper('api');
        $this->load->library('Recaptcha');

	}
    public function index() {
      
    	$data = $this->session->userdata('user');
    	// print_r($data);

    	if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data))->row_array()['id_role_ref'] == 1) {
    		$user = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$data))->row_array();
    		# code...
    	}else{
    		$user = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$data))->row_array();
    	}
    	$this->data['user'] = $user;
    	print_r($user);
        $this->ciparser->new_parse('template_user','modules_user', 'dashboard_layout',$this->data);
    }

    public function change_password(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('current','Current Password', 'required');
            $this->form_validation->set_rules('new','New Password', 'required');
            $this->form_validation->set_rules('re','Re-type New Password', 'required|matches[new]');
            if ($this->form_validation->run() == true) {
                $data = $this->session->userdata('user');
                $input = $this->input->post();
                if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data['id_pengguna'],'password'=>sha1($input['current'])))->num_rows() > 0) {
                    $ret['state'] = 1;
                    $data_user['password'] = $input['new'];
                    if ($this->db->update('tb_pengguna',array('password'=>sha1($input['new'])),array('id_pengguna'=>$data['id_pengguna']))) {
                        $ret['status'] = 1;
                    }
                }
            }
            $ret['notif']['current'] = form_error('current');
            $ret['notif']['new'] = form_error('new');
            $ret['notif']['re'] = form_error('re');
            echo json_encode($ret);
            exit();
        }
        $this->ciparser->new_parse('template_user','modules_user', 'change_password_layout',$this->data);
    }


  



}