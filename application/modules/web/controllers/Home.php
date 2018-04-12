<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Home extends CI_Controller  {


    function __construct() {
        parent::__construct();
        $this->load->helper('api');
    }

    function index() {
        $url = site_url('api/v1/gethero') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper($token,$url,$methode,$token);

        $url_layanan =  site_url('api/v1/getlayanan') ;
        $b = api_helper($token,$url_layanan,$methode,$token);

        $url_instansi = site_url('api/v1/instansi') ;
        $c = api_helper($token,$url_instansi,$methode,$token);
        
        
        $url_testi =site_url('api/v1/gettestimoni');
        $d = api_helper($token,$url_testi,$methode,$token);


        // $url = "http://192.168.88.138/idren/api/v1/about";
        // $a = json_decode($this->hit_api($url),true);
        $this->data['hero']=$a['data'];
        $this->data['layanan']=$b['data'];
        $this->data['instansi']=$c['data'];
        $this->data['testimoni']=$d['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    }


   

}
