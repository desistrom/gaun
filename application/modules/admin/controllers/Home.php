<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Home extends CI_Controller  {


    function __construct() {
        parent::__construct();
    }

    function index() {
    // print_r($this->session->userdata('token'));
    $this->ciparser->new_parse('template_admin','modules_admin', 'home/home_layout');
    }



   

   

}
