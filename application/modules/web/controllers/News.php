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
         $this->load->library('pagination');
    }

    function index() {
        $config['base_url'] = base_url().'web/news/index';
        $url = base_url().'api/v1/news';
        $methode = 'GET';
        $b = api_helper('',$url,$methode,'');
        $config['total_rows'] = count($b['data']);
        $config['per_page'] = 4;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        
        $url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }
        $url = base_url().'api/v1/pagging_news?data='.$data;
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $url = base_url().'api/v1/news';
        $b = api_helper('',$url,$methode,$token);

        


        $this->data['news']=$a['data'];
        $this->data['recent']=$b['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
    }
        function get_news() {
        $id=$_GET['data'];

        $url = site_url('api/v1/get_news_byid');
        $methode = 'POST';
        $token = '';
        $data['data']=$id;
        $a = api_helper(json_encode($data),$url,$methode,$token);

        $methode = 'GET';
        $url_allnews =  site_url('api/v1/news');
        $b = api_helper($token,$url_allnews,$methode,$token);

        $this->data['detail_news']=$a['data'];
        $this->data['news']=$b['data'];
      
       
   
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout',$this->data);
    }
    


    //   function get_news() {

    //   $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    // }

    function hit_api($url) {



    }
 
 

}
