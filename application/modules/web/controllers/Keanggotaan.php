<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Keanggotaan extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');

	}
    function index() {

    	$url_instansi = site_url('api/v1/instansi') ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url_instansi,$methode,$token);
        $this->data['keanggotaan']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }



}