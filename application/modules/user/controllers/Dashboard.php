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
		if ($this->session->userdata('is_login') != true) {
			redirect('user/login_user');
		}
		$this->load->helper('api');
        $this->load->library('Recaptcha');

	}
    public function index() {
      

        $this->ciparser->new_parse('template_user','modules_user', 'dashboard_layout');
    }
  



}