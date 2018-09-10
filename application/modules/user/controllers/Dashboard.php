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
  



}