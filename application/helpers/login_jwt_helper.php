<?php    

    function generate_token_jwt($data){
        $CI =& get_instance();
        $CI->load->library("jwt");
        $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        $CONSUMER_TTL = 86400;
        $token =  $CI->jwt->encode(array(
          'consumerKey'=>$CONSUMER_KEY,
          'user' => $data,
          'issuedAt'=>date(DATE_ISO8601, strtotime("now")),
          'ttl'=>$CONSUMER_TTL
        ), $CONSUMER_SECRET);
        // $token = 'a';
        return $token;
    }

    function decode_token_jwt($data){
        $CI =& get_instance();
        $CI->load->library("jwt");
        // $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        // $CONSUMER_TTL = 86400;
        $token = $data;
        $data =  $CI->jwt->decode($token, $CONSUMER_SECRET);
        // $token = 'a';
        if (is_object($data)) {
            return true;
        }else{
            return false;
        }
    }

    function data_jwt($data){
        $CI =& get_instance();
        $CI->load->library("jwt");
        // $CONSUMER_KEY = 'ingDLMRuGe9UKHRNjs7cYckS2yul4lc3';
        $CONSUMER_SECRET = 'junaedi19981101';
        // $CONSUMER_TTL = 86400;
        $token = $data;
        $data =  $CI->jwt->decode($token, $CONSUMER_SECRET);
        // $token = 'a';
        if (is_object($data)) {
            return $data;
        }else{
            return false;
        }
    }