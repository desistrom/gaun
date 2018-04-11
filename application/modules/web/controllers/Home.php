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
        $url = "http://192.168.1.13/idren/api/v1/gethero";
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);

        $url_layanan = "http://192.168.1.13/idren/api/v1/getlayanan";
        $b = api_helper('',$url_layanan,$methode,$token);

        $url_user = "http://192.168.1.13/idren/api/v1/alluser";
        $c = api_helper('',$url_user,$methode,$token);
        
        $url_testi =  "http://192.168.1.13/idren/api/v1/gettestimoni";
        $d = api_helper('',$url_testi,$methode,$token);


        // $url = "http://192.168.88.138/idren/api/v1/about";
        // $a = json_decode($this->hit_api($url),true);
        $this->data['hero']=$a['data'];
        $this->data['layanan']=$b['data'];
        $this->data['user']=$c['data'];
        $this->data['testimoni']=$d['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    }


    // function get_hero() {
    //     $url = "http://192.168.1.13/idren/api/v1/gethero";
    //     $methode = 'GET';
    //     $token = '';
    //     $a = api_helper('',$url,$methode,$token);


    //     // $url = "http://192.168.88.138/idren/api/v1/about";
    //     // $a = json_decode($this->hit_api($url),true);
    //     $this->data['hero']=$a['data'];
    //     $this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    // }

    // function hit_api($url) {


    //     $curl = curl_init();

    //     curl_setopt_array($curl, array(
    //       CURLOPT_URL => $url,
    //       CURLOPT_RETURNTRANSFER => true,
    //       CURLOPT_ENCODING => "",
    //       CURLOPT_MAXREDIRS => 10,
    //       CURLOPT_TIMEOUT => 30,
    //       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    //       CURLOPT_CUSTOMREQUEST => "GET",
    //       CURLOPT_HTTPHEADER => array(
    //         "Cache-Control: no-cache",
    //         "Content-Type: application/json",
    //         "Postman-Token: eacc0d40-c9a6-4d77-8e45-a6f0c97b9fe7"
    //       ),
    //     ));

    //     $response = curl_exec($curl);
    //     $err = curl_error($curl);

    //     curl_close($curl);

    //     if ($err) {
    //       echo "cURL Error #:" . $err;
    //     } else {
    //       return $response;
    //     }
    // }
 
 

}
