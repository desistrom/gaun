<?php
defined('BASEPATH') OR exit('No direct script access allowed');


if (!function_exists('api_helper')) {
	function api_helper($data,$url,$methode)
	{
		$curl = curl_init();
		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_SSL_VERIFYPEER => FALSE,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $methode,
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
		    "authorization: Basic U0ItTWlkLXNlcnZlci04ZHR3SHZCRWdaM1NrU2xQdnVWa2dReUk=",
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