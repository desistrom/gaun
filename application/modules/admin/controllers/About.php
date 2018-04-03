<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class About extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->module('login');
	}

	public function index(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['content'] = $this->input->post('content');
				$id['id_about'] = $this->input->post('id');
				if ($this->db->update('tb_about',$about,$id)) {
					$ret['status'] = 1;
				}
			}
			$ret['notif']['content'] = form_error('content');
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList' )
		                                                    );
		$this->ckeditor->config['language'] = 'it';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';  
		$this->data['about'] = $this->db->get('tb_about')->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/about_layout',$this->data);
	}
}