<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General
{
	// This is parse function based on special html tag for codeigniter
	// Created by Ibnu Syuhada <ibnusyuhadap3@gmail.com>
	// Version 1.0

	// new parse function
	// $template is template path
	// $data is data for module view
	// $key is module name
	// $embed_template is module view path
	private $CI;

	public function __construct() {
		$this->CI = & get_instance();
		//$this->CI->load->model('users');
	}

	public function get_current_page(){
		return $this->CI->router->fetch_method();
	}

 	public function is_login(){
        if($this->CI->session->userdata('is_login') == '' || $this->CI->session->userdata('previlage') == '' || $this->CI->session->userdata('userid') == '') {
            return false;
        }else{
            return true;
        }
    }

    public function get_idRole(){
    	return $this->CI->session->userdata('previlage');
    }

    public function limit_text($string, $limit) {
			$stringX = strip_tags($string);
			if (strlen($stringX) > $limit) {
					// truncate string
					$stringCut = substr($string, 0, $limit);
					// make sure it ends in a word so assassinate doesn't become ass...
					$stringX = substr($stringCut, 0, strrpos($stringCut, ' '))." ...";
			}
      return $stringX;
    }


}
