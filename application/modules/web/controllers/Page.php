<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Page extends MX_Controller  {
		var $data = array();

	function __construct(){
		$this->load->helper('api');

	}
    function index() {
        $url = $this->uri->segment_array();
        $link = end($url);
        // print_r($link);
        $data_page = '';
        if ($this->db->get_where('tb_general_page',array('link'=>$link))->num_rows() > 0) {
            $data_page = $this->db->get_where('tb_general_page',array('link'=>$link))->row_array();
            if ($data_page['page'] == 1) {
                $layout = 'general_layout';
            }
        }else{
            echo "Page Not Found";
            exit();
        }
        $data_page['nama_page'] = $data_page['title'];
        $data_page['image'] = $data_page['img'];
        $this->data['layanan'] = $data_page;        
    	$this->ciparser->new_parse('template_frontend','modules_web', $layout,$this->data);
    }
  
}