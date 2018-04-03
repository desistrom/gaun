<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('base_url_css_customize')){

    function base_url_css_customize(){
	 	return base_url()."assets/front/css/mycustom/";
    }   
}

if (!function_exists('base_url_js_customize')){
	function base_url_js_customize(){
		return base_url()."assets/front/js/mycustom/";
	}
}






