<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('logo_helper')) {
	function logo_helper()
	{
		/*$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_GET_LOGO,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYPEER => FALSE,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "authorization:",
		    "cache-control: no-cache",
		    "accept: application/json",
		    "content-type: application/json",
		    "postman-token: a565886e-2a43-91de-681e-b95b72138cf0"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$result = json_decode($response, TRUE);
			return $result;
		}*/
		$CI = & get_instance();
		$sql = "SELECT logo as image FROM tb_logo where status = 1";
		// if ($this->db->query($sql)->num_rows() > 0) {
		$user = $CI->db->query($sql)->row_array();
			// exit();
		// }
		if ($user['image'] == '') {
            $user['image'] = 'assets/images/logo/IDREN-2.png';
        }else{
            $user['image'] = "media/".$user['image'];
        }
		return $user;
	}
}

if (!function_exists('instansi_helper')) {
	function instansi_helper()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/idren/api/v1/instansi",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYPEER => FALSE,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "authorization:",
		    "cache-control: no-cache",
		    "accept: application/json",
		    "content-type: application/json",
		    "postman-token: a565886e-2a43-91de-681e-b95b72138cf0"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$result = json_decode($response, TRUE);
			return $result;
		}
	}
}
if (!function_exists('footer_helper')) {
	function footer_helper()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => URL_GET_FOOTER,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYPEER => FALSE,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "GET",
		  CURLOPT_POSTFIELDS => "",
		  CURLOPT_HTTPHEADER => array(
		    "authorization:",
		    "cache-control: no-cache",
		    "accept: application/json",
		    "content-type: application/json",
		    "postman-token: a565886e-2a43-91de-681e-b95b72138cf0"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
			$result = json_decode($response, TRUE);
			return $result;
		}
	}
}