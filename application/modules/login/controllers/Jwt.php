<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Jwt extends REST_Controller
{

    public function token_post($data)
    {
        $tokenData = array();
        $tokenData['id']['username'] = $param['username']; 
        $tokenData['id']['password'] = $param['password']; 
        $tokenData['timestamp'] = now();
        $output['status'] = "ok";
        $output['data'] = $tokenData;
        $output['token'] = AUTHORIZATION::generateToken($tokenData);
        $result = $this->set_response($output, REST_Controller::HTTP_OK);
        return $output['token'];
    }
    public function check_token_post()
    {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);
            // return response if token is valid
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}