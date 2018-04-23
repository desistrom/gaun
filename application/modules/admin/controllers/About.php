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
		// if ($this->login->token_check() == 0) {
		// 	// redirect('login');
		// }
	}

	public function index(){
		// print_r($this->session->userdata('token'));
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
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['about'] = $this->db->get('tb_about')->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/about_layout',$this->data);
	}

	public function contact(){
		$this->data['contact'] = $this->db->get('tb_contact')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/list_message_layout',$this->data);
	}

	public function footer(){
		$this->data['footer'] = $this->db->get('tb_footer')->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('alamat','Alamat Kantor','trim|required');
			$this->form_validation->set_rules('facebook','Link Facebook','trim|required');
			$this->form_validation->set_rules('twitter','Link Twitter','trim|required');
			$this->form_validation->set_rules('instagram','Link Instagram','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_footer['alamat'] = $this->input->post('alamat');
				$data_footer['facebook'] = $this->input->post('facebook');
				$data_footer['twitter'] = $this->input->post('twitter');
				$data_footer['instagram'] = $this->input->post('instagram');
				if ($this->db->get('tb_footer')->num_rows() > 0) {
					if ($this->db->update('tb_footer',$data_footer,array('id_footer'=>1))) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if ($this->db->insert('tb_footer',$data_footer)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['alamat'] = form_error('alamat');
			$ret['notif']['facebook'] = form_error('facebook');
			$ret['notif']['twitter'] = form_error('twitter');
			$ret['notif']['instagram'] = form_error('Instagram');
			echo json_encode($ret);
			exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/footer_layout',$this->data);
	}
}