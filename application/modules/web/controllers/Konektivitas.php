<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Konektivitas extends MX_Controller  {
		var $data = array();

	function __construct(){
		$this->load->helper('api');

	}
    function index() {

    	$url = URL_GET_TOPOLOGI;
        // $a = json_decode($this->api_helper($url),true);
        $sql = "SELECT logo as image FROM tb_logo where status = 2";
        $a =  $this->db->query($sql)->row_array();
        $methode = 'GET';
        $token = '';
        $a['image'] = "media/".$a['image'];
        // $a = api_helper('',$url,$methode,$token);
        $this->data['topologi']=$a;

    	$this->ciparser->new_parse('template_frontend','modules_web', 'topologi_layout',$this->data);
    }
  
}