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

	}
	public function index(){
		$this->data['anggota'] = $this->db->get('tb_user')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/keanggotaan_layout',$this->data);
	}

	public function add(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name','Nama Lengkap','trim|required');
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('password','Passowrd','trim|required');
			$this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
			$this->form_validation->set_rules('email','email','trim|required');
			$this->form_validation->set_rules('phone','phone','trim|required');
			$this->form_validation->set_rules('instansi','Instansi','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_user['name'] = $this->input->post('name');
				$data_user['username'] = $this->input->post('username');
				$data_user['password'] = sha1($this->input->post('password'));
				$data_user['email'] = $this->input->post('email');
				$data_user['phone'] = $this->input->post('phone');
				$data_user['id_instansi_ref'] = $this->input->post('instansi');
				if ($this->db->insert('tb_user',$data_user)) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/keanggotaan');
				}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['username'] = form_error('username');
			$ret['notif']['password'] = form_error('password');
			$ret['notif']['repassword'] = form_error('repassword');
			$ret['notif']['email'] = form_error('email');
			$ret['notif']['phone'] = form_error('phone');
			$ret['notif']['instansi'] = form_error('instansi');
			echo json_encode($ret);
			exit();
		}
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/keanggotaan_add_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name','Nama Lengkap','trim|required');
			$this->form_validation->set_rules('email','email','trim|required');
			$this->form_validation->set_rules('phone','phone','trim|required');
			// $this->form_validation->set_rules('instansi','Instansi','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_user['name'] = $this->input->post('name');
				$data_user['email'] = $this->input->post('email');
				$data_user['phone'] = $this->input->post('phone');
				$data_user['id_instansi_ref'] = $this->input->post('instansi');
				if ($this->db->update('tb_user',$data_user,array('id_user'=>$id))) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/keanggotaan');
				}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['email'] = form_error('email');
			$ret['notif']['phone'] = form_error('phone');
			// $ret['notif']['instansi'] = form_error('instansi');
			echo json_encode($ret);
			exit();
		}
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->data['anggota'] = $this->db->get_where('tb_user',array('id_user'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/keanggotaan_edit_layout',$this->data);
	}

	public function setting(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('cara','Tata Cara','trim|required');
			$this->form_validation->set_rules('benefit','Benefit','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['profit'] = $this->input->post('benefit');
				$about['cara'] = $this->input->post('cara');
				$id['id_setting'] = $this->input->post('id');
				if ($this->db->update('tb_setting_user',$about,$id)) {
					$ret['status'] = 1;
				}
			}
			$ret['notif']['cara'] = form_error('cara');
			$ret['notif']['benefit'] = form_error('benefit');
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
		$this->data['content'] = $this->db->get('tb_setting_user')->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/setting_layout',$this->data);
	}

	public function instansi(){

	}
}