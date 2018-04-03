<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class Authtimeout extends REST_Controller
{

    public function token_post()
    {
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'),true);
        // $login_platform = $this->getData($param);
        // if ($login_platform['status'] == 1) {
            $tokenData = array();
            $tokenData['id']['username'] = $param['username']; 
            $tokenData['id']['password'] = $param['password']; 
            $tokenData['timestamp'] = now();
            $output['status'] = "ok";
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            $result = $this->set_response($output, REST_Controller::HTTP_OK);
            return $output;
        // }
        $ret['status'] = 'failed';
        $ret['message'] = 'FAILED AUTHORIZATION';
        $this->set_response($ret, 400);
    }
    public function check_token_get()
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