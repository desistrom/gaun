<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Tentang extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');

	}
        function index() {
        $url = site_url('api/v1/about') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['about']=$a['data'];

        $this->ciparser->new_parse('template_frontend','modules_web', 'tentang_layout',$this->data);
    }
      function contact() {
        $url = site_url('api/v1/about') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['about']=$a['data'];

        $this->ciparser->new_parse('template_frontend','modules_web', 'contact_layout',$this->data);
    }



}