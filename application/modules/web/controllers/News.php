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
    }

    function index() {

    	$this->ciparser->new_parse('template_frontend','modules_web', 'news_layout');
    }

      function detail_news() {

      $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    }

    function hit_api($url) {



    }
 
 

}
