<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('logo_helper')) {
	function logo_helper()
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => "http://localhost/idren/api/v1/getlogo",
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