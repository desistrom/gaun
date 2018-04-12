<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class News extends CI_Controller  {


    function __construct() {
        parent::__construct();
         $this->load->helper('api');
    }

    function index() {
        $url = site_url('api/v1/news');
        $methode = 'GET';
        $token = '';
        $a = api_helper($token,$url,$methode,$token);

        $this->data['news']=$a['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
    }
        function get_news() {
        $id=$_GET['data'];

        $url = site_url('api/v1/get_news_byid');
        $methode = 'POST';
        $token = '';
        $data['data']=$id;
        $a = api_helper(json_encode($data),$url,$methode,$token);


        $a = json_decode($this->hit_api($url),true);
        $this->data['detail_news']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout',$this->data);
    }
    


    //   function get_news() {

    //   $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    // }

    function hit_api($url) {



    }
 
 

}
