<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Keanggotaan extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');
        $this->load->library('Recaptcha');
	}
    function index() {
        /*$url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }*/
    	$url_instansi = URL_GET_ALL_INSTANSI;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $b = api_helper('',$url_instansi,$methode,$token);
        $this->data['total'] = count($b['data']);
        // $config['base_url'] = base_url().'web/keanggotaan/index';
        // $url = base_url().'api/v1/news';
        /*$methode = 'GET';
        $config['total_rows'] = count($b['data']);
        $config['per_page'] = 8;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);
        $url = base_url().'api/v1/instansi_pagging?data='.$data;
        $a = api_helper('',$url,$methode,$token);
        $this->data['keanggotaan']=$a['data'];*/

        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 10);
            $this->data['total_row'] = $start;
            $url = URL_GET_INSTANSI_PAGGING.$start;
            $a = api_helper('',$url,$methode,$token);
            $this->data['keanggotaan']=$a['data'];
            $result = $this->load->view('keanggotaan_looping',$this->data);
            echo json_encode($result);
        }else{
            $url = URL_GET_INSTANSI_PAGGING.'0';
            $this->data['total_row'] = '10';
            $a = api_helper('',$url,'GET','');
            // print_r($a);
            $this->data['keanggotaan']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
        }

    	// $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }
     function benefit() {
        $url = URL_GET_BENEFIT;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['benefit']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'benefit_layout',$this->data);
     }
     function pendaftaran() {
        $url = URL_GET_PENDAFTARAN ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('instansi','Institute Name','trim|required');
            $this->form_validation->set_rules('address','Address Name','trim|required');
            $this->form_validation->set_rules('email','Email','trim|required');
            $this->form_validation->set_rules('phone','Phone','trim|required');
            $this->form_validation->set_rules('website','Website','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Passowrd','trim|required');
            $this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            // print_r($response);
            // return false;
            // $response['success'] = 1;
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['instansi'] = $data_input['instansi'];
                $data_user['address'] = $data_input['address'];
                $data_user['email'] = $data_input['email'];
                $data_user['number_phone'] = $data_input['phone'];
                $data_user['website'] = $data_input['website'];
                $data_user['username'] = $data_input['username'];
                $data_user['password'] = sha1($data_input['password']);
            
                $url = URL_REGISTER ;

                
                $methode = "POST";
                 $ret['cek']=api_helper(json_encode($data_user),$url,$methode,'');
                 if ($ret['cek']['code']=='200') {
                       if (api_helper(json_encode($data_user),$url,$methode,'')) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('admin/keanggotaan');

                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                    }
                    else{
                        $ret['notif']['username-already']='username already exist, please change your username';
                    }
                 }
              
            }else{
                if ($response['success'] == '') {
                    $ret['notif']['g-recaptcha-response'] = 'Captcha Expired';
                }
            }
            $ret['notif']['instansi'] = form_error('instansi');
            $ret['notif']['address'] = form_error('address');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['phone'] = form_error('phone');
            $ret['notif']['website'] = form_error('website');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['repassword'] = form_error('repassword');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');
    
            echo json_encode($ret);
            exit();
        }
        $a = api_helper('',$url,$methode,$token);
        $this->data = array(
            'action' => site_url('web/tentang/add_contact'),
            'captcha' => $this->recaptcha->getWidget(), // menampilkan recaptcha
            'script_captcha' => $this->recaptcha->getScriptTag(), // javascript recaptcha ditaruh di head
        );
        $this->data['step']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'pendaftaran_layout',$this->data);
     }
     public function search()
     {
        $url_instansi = URL_GET_ALL_INSTANSI ;
        $methode = 'GET';
        $token = '';
        $b = api_helper('',$url_instansi,$methode,$token);

        $search['search'] = $_GET['data'];
        $sql = "select * from tb_instansi where nm_instansi like '%".$search['search']."%'";
        $this->data['total'] = $this->db->query($sql)->num_rows();
        $url=URL_SEARCH_INSTANSI;  
        $methode = 'POST';
        $token='';
        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 10);
            $this->data['total_row'] = $start;
            $search['page'] = $start;
            $a = api_helper(json_encode($search),$url,$methode,$token);
            $this->data['keanggotaan']=$a['data'];
            $result = $this->load->view('keanggotaan_looping',$this->data);
            echo json_encode($result);
        }else{
            // $url = base_url().'api/v1/instansi_pagging?data=0';
            // print_r($search);
            $search['page'] = 0;
            $this->data['total_row'] = '10';
            $a = api_helper(json_encode($search),$url,$methode,$token);
            $this->data['keanggotaan']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_search',$this->data);
        }

    }
}


