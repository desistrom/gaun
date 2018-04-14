<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Layanan extends MX_Controller  {
	   var $data = array();

    function __construct(){
        $this->load->helper('api');

    }
    function index() {

        $url_idroam = site_url('api/v1/getlayanan_idroam') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url_idroam,$methode,$token);

        $url_cloud =  site_url('api/v1/getlayanan_cloud') ;
        $b = api_helper('',$url_cloud,$methode,$token);

        $this->data['idroam']=$a['data'];
        $this->data['cloud_federation']=$b['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'layanan_layout',$this->data);
    }
     function idroam() {
        $url = site_url('api/v1/getlayanan_idroam') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['idroam']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'idroam_layout',$this->data);
    }
    function cloud_federation() {
        $url = site_url('api/v1/getlayanan_cloud') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['cloud']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'cloudfederation_layout',$this->data);
    }

  
}