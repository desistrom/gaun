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

/*if (!function_exists('instansi_helper')) {
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
}*/
if (!function_exists('footer_helper')) {
	function footer_helper()
	{
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		//   CURLOPT_URL => URL_GET_FOOTER,
		//   CURLOPT_RETURNTRANSFER => true,
		//   CURLOPT_ENCODING => "",
		//   CURLOPT_MAXREDIRS => 10,
		//   CURLOPT_TIMEOUT => 30,
		//   CURLOPT_SSL_VERIFYPEER => FALSE,
		//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		//   CURLOPT_CUSTOMREQUEST => "GET",
		//   CURLOPT_POSTFIELDS => "",
		//   CURLOPT_HTTPHEADER => array(
		//     "authorization:",
		//     "cache-control: no-cache",
		//     "accept: application/json",
		//     "content-type: application/json",
		//     "postman-token: a565886e-2a43-91de-681e-b95b72138cf0"
		//   ),
		// ));

		// $response = curl_exec($curl);
		// $err = curl_error($curl);

		// curl_close($curl);

		// if ($err) {
		//   echo "cURL Error #:" . $err;
		// } else {
		// 	$result = json_decode($response, TRUE);
		// 	return $result;
		// }
		$CI = & get_instance();
		$sql = "SELECT alamat as address, alamat2 as address2, facebook as FacebookLink, twitter as TwitterLink, instagram as InstagramLink FROM tb_footer";
		$user['data'] = $CI->db->query($sql)->row_array();
		return $user;
	}

	if (!function_exists('kalender_helper')) {
		function kalender_helper(){
			$CI = & get_instance();
			$prefs = array(
	        // 'start_day'    => 'saturday',
		        'month_type'   => 'long',
		        'day_type'     => 'abr',
		        'show_next_prev'  => false,
		        'next_prev_url'   => ''
			);
			$prefs['template'] = '{table_open}<div class="table-responsive" ><table border="0" style="text-align:center;" cellpadding="0" class="table table-bordered table-condensed" cellspacing="0">{/table_open}

	        {heading_row_start}<tr class="heading">{/heading_row_start}

	        {heading_previous_cell}<th style="text-align:center;"><a href="{previous_url}"><i class="fa fa-arrow-circle-left"></i></a></th>{/heading_previous_cell}
	        {heading_title_cell}<th style="text-align:center;" colspan="{colspan}">{heading}</th>{/heading_title_cell}
	        {heading_next_cell}<th style="text-align:center;"><a href="{next_url}"><i class="fa fa-arrow-circle-right"></i></a></th>{/heading_next_cell}

	        {heading_row_end}</tr>{/heading_row_end}

	        {week_row_start}<tr class="week">{/week_row_start}
	        {week_day_cell}<td>{week_day}</td>{/week_day_cell}
	        {week_row_end}</tr>{/week_row_end}

	        {cal_row_start}<tr class="day">{/cal_row_start}
	        {cal_cell_start}<td>{/cal_cell_start}
	        {cal_cell_start_today}<td style="background-color:#329a7d61;">{/cal_cell_start_today}
	        {cal_cell_start_other}<td class="other-month">{/cal_cell_start_other}

	        {cal_cell_content}<div style="background-color:#b4ff0070;padding:5px"><div class="gambar" style=""><i class="fa fa-calendar"></i></div><div class="tgl" style="">{day}</div><div class="gambar2" style=""><i class="fa fa-calendar"></i></div></div><div><ul class="list-unstyled">{content}</ul></div>{/cal_cell_content}
	        {cal_cell_content_today}<div style="background-color:#b4ff0070;padding:5px"><div class="gambar"><i class="fa fa-calendar"></i></div><div class="tgl"><b>{day}</b></div><div class="gambar2" style=""><i class="fa fa-calendar"></i></div></div><div><ul class="list-unstyled">{content}</ul></div></div>{/cal_cell_content_today}

	        {cal_cell_no_content}{day}{/cal_cell_no_content}
	        {cal_cell_no_content_today}<div class="highlight"><b>{day}</b></div>{/cal_cell_no_content_today}

	        {cal_cell_blank}&nbsp;{/cal_cell_blank}

	        {cal_cell_other}{day}{/cal_cel_other}

	        {cal_cell_end}</td>{/cal_cell_end}
	        {cal_cell_end_today}</td>{/cal_cell_end_today}
	        {cal_cell_end_other}</td>{/cal_cell_end_other}
	        {cal_row_end}</tr>{/cal_row_end}

	        {table_close}</table></div>{/table_close}';	

			$CI->load->library('calendar', $prefs);
			return $CI->calendar->generate('', '','');
		}
	}
}