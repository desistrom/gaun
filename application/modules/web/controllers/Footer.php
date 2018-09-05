<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Footer extends MX_Controller  {
		var $data = array();

	function __construct(){
		$this->load->helper('api');

	}
    function index() {

    	$url = URL_GET_FOOTER;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT alamat as address, alamat2 as address2, facebook as FacebookLink, twitter as TwitterLink, instagram as InstagramLink FROM tb_footer";
        $a['data'] = $this->db->query($sql)->row_array();
        $this->data['footer']=$a['data'];

    	$this->ciparser->new_parse('template_frontend',$this->data);
    }
  
}