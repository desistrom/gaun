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

        $this->ciparser->new_parse('template_frontend','modules_web', 'register_layout');
    }
  
}