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
        /*$config['base_url'] = base_url().'web/news/index';
        $url = base_url().'api/v1/news';*/
        $methode = 'GET';
        // $b = api_helper('',$url,$methode,'');
        // $config['total_rows'] = count($b['data']);
        // $config['per_page'] = 4;
        // $config['prev_tag_open'] = '<li>';
        // $config['prev_tag_close'] = '</li>';
        // $config['prev_link'] = 'Prev';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';
        // $config['next_link'] = 'Next';
        // $this->pagination->initialize($config);

        
        // $url = $this->uri->segment_array();
        // $data = end($url);
        // if (!is_numeric($data)) {
        //     $data = 0;
        // }
        // $url = base_url().'api/v1/pagging_news?data='.$data;
        // $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $url = base_url().'api/v1/news';
        $b = api_helper('',$url,$methode,'');
        $this->data['recent']=$b['data'];
        $this->data['total'] = count($b['data']);
        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 4);
            $this->data['total_row'] = $start;
            $url = base_url().'api/v1/pagging_news?data='.$start;
            $a = api_helper('',$url,$methode,'');
            $this->data['news']=$a['data'];
            $result = $this->load->view('news_looping',$this->data);
            echo json_encode($result);
        }else{
            $this->data['total_row'] = 0;
            $url = base_url().'api/v1/pagging_news?data=0';
            $a = api_helper('',$url,$methode,'');
            $this->data['news']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
        }

        // $this->data['news']=$a['data'];
        // $this->data['recent']=$b['data'];
    	// $this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
    }
        function get_news() {
        $url = $this->uri->segment_array();
        $id = end($url);
        // $id=$_GET['data'];

        $url = site_url('api/v1/get_news_byslug?news='.$id);
        $methode = 'GET';
        $token = '';
        $data['data']=$id;
        $a = api_helper(json_encode($data),$url,$methode,$token);

        $methode = 'GET';
        $url_allnews =  site_url('api/v1/news');
        $b = api_helper($token,$url_allnews,$methode,$token);

        $this->data['detail_news']=$a['data'];
        // print_r($a['data']);
        $this->data['news']=$b['data'];
      
       
   
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout',$this->data);
    }
    


    //   function get_news() {

    //   $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    // }

    function hit_api($url) {



    }
 
 

}
