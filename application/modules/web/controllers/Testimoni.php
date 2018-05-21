<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Testimoni extends MX_Controller  {
	var $data = array();

	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');

	}
    function index() {

    	
        $config['base_url'] = base_url().'web/Testimoni/index';
        $url = URL_GET_TESTIMONI;
        $methode = 'GET';
        $b = api_helper('',$url,$methode,'');
        $config['total_rows'] = count($b['data']);
        $config['per_page'] = 6;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        
        $url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }
        $url = URL_GET_TESTIMONI_PAGGING.$data;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);

        $this->data['testimoni']=$a['data'];
    	$this->ciparser->new_parse('template_frontend','modules_web', 'testimoni_layout',$this->data);
    }
}