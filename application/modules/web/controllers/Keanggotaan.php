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

	}
    function index() {

    	$url = "http://192.168.88.138/idren/api/v1/profit";
        $a = json_decode($this->api_keanggotaan($url),true);
        $this->data['keanggotaan']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }
        function insert_user() {

    	$url = "http://192.168.88.138/idren/api/v1/profit";
        $a = json_decode($this->api_keanggotaan($url),true);
        $this->data['keanggotaan']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }
    
    function api_keanggotaan($url) {



		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "{\n\t\"search\" : \"develop\"\n}",
		  CURLOPT_HTTPHEADER => array(
		    "Cache-Control: no-cache",
		    "Content-Type: application/json",
		    "Postman-Token: 747ab98d-4536-4b63-8c80-788088b23a88"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  return $response;
		}
    }

}