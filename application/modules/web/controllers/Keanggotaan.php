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
	}
    function index() {
        /*$url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }*/
    	$url_instansi = site_url('api/v1/instansi') ;
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
            $url = base_url().'api/v1/instansi_pagging?data='.$start;
            $a = api_helper('',$url,$methode,$token);
            $this->data['keanggotaan']=$a['data'];
            $result = $this->load->view('keanggotaan_looping',$this->data);
            echo json_encode($result);
        }else{
            $url = base_url().'api/v1/instansi_pagging?data=0';
            $this->data['total_row'] = '10';
            $a = api_helper('',$url,$methode,$token);
            $this->data['keanggotaan']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
        }

    	// $this->ciparser->new_parse('template_frontend','modules_web', 'keanggotaan_layout',$this->data);
    }
     function benefit() {
        $url = site_url('api/v1/profit') ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['benefit']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'benefit_layout',$this->data);
     }
     function pendaftaran() {
        $url = site_url('api/v1/step') ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['step']=$a['data'];
        $this->ciparser->new_parse('template_frontend','modules_web', 'pendaftaran_layout',$this->data);
     }
     public function search()
     {
        $url_instansi = site_url('api/v1/instansi') ;
        $methode = 'GET';
        $token = '';
        $b = api_helper('',$url_instansi,$methode,$token);
        $this->data['total'] = count($b['data']);

        $search['search'] = $_GET['data'];
        $url= site_url('api/v1/search_instansi') ;  
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


