<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Galery extends CI_Controller  {
	  	var $data=array();

    function __construct() {
        parent::__construct();
    }

    function index() {

    	$url="http://192.168.88.138/idren/api/v1/galery_image";
    	$data = '';
    	$methode = 'GET';
    	$a=json_decode($this->api($url,$methode,$data),true);


    	$this->data['foto']=$a['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'foto_layout',$this->data);
    }
    function video() {
    	$url= "http://192.168.88.138/idren/api/v1/galery_video";
    	$data = '';
    	$methode = 'GET';
    	$a=json_decode($this->api($url,$methode,$data),true);



    	$this->data['video']=$a['data'];	
    	$this->ciparser->new_parse('template_frontend','modules_web', 'video_layout',$this->data);
    }

      function search_foto() {
    	$url= "http://192.168.88.138/idren/api/v1/search_galery_image";
    	$search['search'] = $_GET['data'];
    	$methode = 'POST';
    	$app_data = json_decode($this->api($url,$methode,json_encode($search)),true);
        $html = '';
        if (is_array($app_data['data']) !="") {

            foreach ($app_data['data'] as $key => $value) :
            $html .= '<div class="col-lg-4 col-md-4 col-xs-6 filter-img">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="';
            $html .= $value['title'];
            $html .='" data-caption="'. $value['keterangan'] .'" data-image="'.base_url().'assets/media/'. $value['file'] .'" data-target="#image-gallery" data-date="'. $value['modify_date'] .'" data-user="by : '. $value['nama_user'] .'  style="padding: 0;">
                <div class="box">
                 <h3 class="text-title" style="width: 100%;text-align: center;}">'. $value['title'].'</h3>
                    <div class="sub-box">
                        <div class="filter-image">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </div>
                        <img src="'.base_url().'assets/media/'. $value['file'] .'" class="image-gallery" id="myImg">
                    </div>
                </div>
            </a>
        </div>';
        endforeach;
        }else{
            $html.='<h3 style="margin-top:2em;">Data Not Found</h3>';
        }
        
        echo json_encode($html);

    }
    function search_video() {
        $url= "http://192.168.88.138/idren/api/v1/search_galery_video";
        $search['search'] = $_GET['data'];
        $methode = 'POST';
        $app_data = json_decode($this->api($url,$methode,json_encode($search)),true);
        // print_r($app_data);
        $html = '';


        if (is_array($app_data['data']) !="") {

            foreach ($app_data['data'] as $key => $value) :
            $html .= '<div class="col-lg-4 col-md-4 col-xs-6 filter-img">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="';
            $html .= $value['title'];
            $html .='" data-caption="'. $value['keterangan'] .'" data-image="'.base_url().'assets/media/'. $value['file'] .'" data-target="#image-gallery" data-date="'. $value['modify_date'] .'" data-user="by : '. $value['nama_user'] .'  style="padding: 0;">
                <div class="box">
                <h3 class="text-title" style="width: 100%;text-align: left;}">'. $value['title'] .'</h3>
                    <div class="sub-box">
                        <div class="filter-image">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </div>
                        <iframe class="video-up"  src="'. $value['file'] .'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </a>
        </div>';
        endforeach;
        }else{
            $html.='<h3 style="margin-top:2em;text-align:center;">Data Not Found</h3>';
        }
        // foreach ($app_data['data'] as $key => $value) :
        //     $html .= '<div class="col-lg-4 col-md-4 col-xs-6 filter-img">
        //     <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="';
        //     $html .= $value['title'];
        //     $html .='" data-caption="'. $value['keterangan'] .'" data-image="'.base_url().'assets/media/'. $value['file'] .'" data-target="#image-gallery" data-date="'. $value['modify_date'] .'" data-user="by : '. $value['nama_user'] .'  style="padding: 0;">
        //         <div class="box">
        //         <h3 class="text-title" style="width: 100%;text-align: left;}">'. $value['title'] .'</h3>
        //             <div class="sub-box">
        //                 <div class="filter-image">
        //                     <i class="glyphicon glyphicon-zoom-in"></i>
        //                 </div>
        //                 <iframe class="video-up"  src="'. $value['file'] .'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
        //             </div>
        //         </div>
        //     </a>
        // </div>';
        // endforeach;
        echo json_encode($html);

    }
    
    function api($url,$metode,$data) {


		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => $url,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => $metode,
		  CURLOPT_POSTFIELDS => $data,
		  CURLOPT_HTTPHEADER => array(
		    "Cache-Control: no-cache",
		    "Content-Type: application/json",
		    "Postman-Token: 6283f8c9-806c-4552-9d2b-56935a0a362b"
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
