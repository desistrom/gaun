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
        $url = "http://192.168.88.138/idren/api/v1/news";
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);


        // $url = "http://192.168.88.138/idren/api/v1/about";
        // $a = json_decode($this->hit_api($url),true);
        $this->data['news']=$a['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
    }
        function get_news() {
        $url = "http://192.168.88.138/idren/api/v1/get_news_byid";
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);


        $url = "http://192.168.88.138/idren/api/v1/about";
        $a = json_decode($this->hit_api($url),true);
        $this->data['news']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout',$this->data);
    }
    


    //   function get_news() {

    //   $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    // }

    function hit_api($url) {



    }
 
 

}
