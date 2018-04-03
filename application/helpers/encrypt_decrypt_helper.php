<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


if (!function_exists('encrypt_text')){

    function encrypt_text($plain_text){
	 	$CI =& get_instance(); 
		$CI->load->library('encryption');
        return $CI->encryption->encrypt($plain_text);
    }   
}

if (!function_exists('decrypt_text')){
	function decrypt_text($ciphertext){
		$CI =& get_instance(); 
		$CI->load->library('encryption');
		return $CI->encryption->decrypt($ciphertext);
	}
}

if (!function_exists('get_random_password')){
  
    function get_random_password($chars_min=8, $chars_max=10, $use_upper_case=false, $include_numbers=false, $include_special_chars=true){
        $length = rand($chars_min, $chars_max);
        $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
        if($include_numbers) {
            $selection .= "1234567890";
        }
        if($include_special_chars) {
            $selection .= "!@\#$%&^-";
        }
                                
        $password = "";
        for($i=0; $i<$length; $i++) {
            $current_letter = $use_upper_case ? (rand(0,1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];            
            $password .=  $current_letter;
        }                
        
      return $password;
    }
}
