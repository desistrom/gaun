<?php

 if (!function_exists('check_token')) {
 	function check_token(){
 		$CI =& get_instance();
        $CI->load->library("jwt");
        // $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        // $CONSUMER_TTL = 86400;
        $token = $_COOKIE['token'];
        $data =  $CI->jwt->decode($token, $CONSUMER_SECRET);
        // $token = 'a';
        if (is_object($data)) {
            return true;
        }else{
            return false;
        }
    }
 }