<?php
// defined('BASEPATH') OR exit('No direct script access allowed');
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
        // return $output['token'];
        $this->session->set_userdata('token', $output['token']);
        redirect(site_url('admin/home'));
    }
    public function check_token_get()
    {
        // print_r($_GET);
        // return false;
        $data = $this->input->get();

        // $headers = $this->input->request_headers();
        if (isset($data['token']) && !empty($data['token'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($data['token']);
            // return response if token is valid
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                $this->session->set_flashdata('tkn','1');
                redirect(site_url($data['url']));
                // return;
            }else{
                redirect(site_url('login'));
            }
        }
        
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }
}