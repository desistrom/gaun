<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Tentang extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');
        $this->load->library('Recaptcha');

	}
    public function index() {
        $url = URL_GET_ABOUT;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['about']=$a['data'];

        $this->db->from('tb_founder');
        $this->db->order_by("sort", "asc");
        $query = $this->db->get(); 
        $this->data['founder'] = $query->result_array();

        $this->ciparser->new_parse('template_frontend','modules_web', 'tentang_layout',$this->data);
    }
      function contact() {
        $url = site_url('api/v1/about') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['about']=$a['data'];
        $this->data = array(
            'action' => site_url('web/tentang/add_contact'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );

        $this->ciparser->new_parse('template_frontend','modules_web', 'contact_layout',$this->data);
    }

    public function add_contact(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('name','Nama Lengkap','trim|required');
            $this->form_validation->set_rules('pesan','Pesan','trim|required');
            $this->form_validation->set_rules('email','email','trim|required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && isset($response['success'])) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['name'] = $data_input['name'];
                $data_user['email'] = $data_input['email'];
                $data_user['pesan'] = $data_input['pesan'];
                $url = base_url()."/api/v1/insert_contact";
                $methode = "POST";
                if (api_helper(json_encode($data_user),$url,$methode,'')) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('web/Tentang/contact');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['name'] = form_error('name');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['pesan'] = form_error('pesan');
            echo json_encode($ret);
            exit();
        }
    }



}