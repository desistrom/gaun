<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Pentahelix extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');
	}
    function index() {
/*       $url = site_url('api/v1/profit') ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['benefit']=$a['data'];*/
        $this->ciparser->new_parse('template_frontend','modules_web', 'pentahelix_layout',$this->data);
    }
    
}


