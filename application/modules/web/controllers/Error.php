<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Error extends CI_Controller  {
	  	var $data=array();

    function __construct() {
        parent::__construct();
       
    }

    function index() {
       
    	$this->ciparser->new_parse('template_frontend','modules_web', 'error_layout');
    }
}