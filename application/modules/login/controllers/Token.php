<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Token extends REST_Controller
{

    public function token_get($data,$pass)
    {
        $tokenData = array();
        $tokenData['id']['username'] = $data; 
        $tokenData['id']['password'] = $pass; 
        $tokenData['timestamp'] = now();
        $output['status'] = "ok";
        $output['data'] = $data;
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