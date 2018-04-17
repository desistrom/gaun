<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Email extends MX_Controller  {

	var $data = array();

	public function __construct(){
		$this->load->model('home_model');
	}

	public function index(){
		$this->data['email'] = $this->home_model->getemail();
		$this->data['view'] = 'list';
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_email_layout',$this->data);
	}

	public function add_email(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori Email', 'trim|required');
			$this->form_validation->set_rules('subject','Email Penerima', 'trim|required');
			$this->form_validation->set_rules('title','Subject Email', 'trim|required');
			$this->form_validation->set_rules('content','Content Email', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_email['id_kategori_email_ref'] = $this->input->post('kategori');
				$data_email['subject'] = $this->input->post('subject');
				$data_email['title'] = $this->input->post('title');
				$data_email['content'] = $this->input->post('content');
				$template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>$this->input->post('kategori'),'status'=>1))->row_array()['source_code'];
				$final = str_replace("Email_User", $this->input->post('subject'), $template);
				$final = str_replace("subject_email", $this->input->post('title'), $final);
				// str_replace("content_email", $this->input->post('content'), $template);
				$this->load->helper('email_send_helper');
			   	$data['email_from'] = "junaedi@presiden.com";
			   	$data['name_from'] = "Presiden Junaedi";
			   	$data['email_to'] = $this->input->post('subject');
			   	$data['subject'] = $this->input->post('title');
			   	$data['content'] = str_replace("content_email", $this->input->post('content'), $final);
			   	if (email_send($data) == true) {
					if ($this->db->insert('tb_notifikasi_email',$data_email)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/email');
					}
			   	}else{
			   		$ret['notif']['email'] = "Can't Send Email";
			   	}
			}
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['subject'] = form_error('subject');
			$ret['notif']['title'] = form_error('title');
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
		$this->data['view'] = 'add';
		$this->data['kategori'] = $this->db->get('tb_kategori_email')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_email_layout',$this->data);
	}

	public function kategori(){
		$this->data['kategori'] = $this->db->get('tb_kategori_email')->result_array();
		$this->data['view'] = 'list';
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_kategori_email_layout',$this->data);
	}

	public function add_kategori(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori Email', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_email['nm_kategori'] = $this->input->post('kategori');
				if ($this->db->update('tb_kategori_email',$data_email)) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/email/kategori');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_kategori_email_layout',$this->data);
	}

	public function edit_kategori(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori Email', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_email['nm_kategori'] = $this->input->post('kategori');
				if ($this->db->update('tb_kategori_email',$data_email,array('id_kategori_email'=>$id))) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/email/kategori');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['kategori'] = $this->db->get_where('tb_kategori_email',array('id_kategori_email'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_kategori_email_layout',$this->data);
	}

	public function delete_kategori(){
		$url = $this->uri->segment_array();
		$id = end($url);

		if ($this->db->delete('tb_kategori_email',array('id_kategori_email'=>$id))) {
			$this->session->set_flashdata("notif","Data Berhasil di Delete");
			redirect(site_url('admin/email/kategori'));
		}
	}

	public function template(){
		$this->data['kategori'] = $this->db->get('tb_kategori_email')->result_array();
		$this->data['view'] = 'list';
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_template_layout',$this->data);
	}

	public function edit_template(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['view'] = 'edit';
		$this->data['kategori'] = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>$id))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('template','Template Email', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$sc = str_replace("&lt;", "<", $this->input->post('template'));
				$cs = str_replace("&gt;", ">", $sc);
				$data_email['source_code'] = $cs;
				if ($this->data['kategori'] != '') {
					if ($this->db->update('tb_template_email',$data_email,array('id_kategori_email_ref'=>$id))) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/email/template');
					}
				}else{
					$data_email['status'] = 1;
					$data_email['id_kategori_email_ref'] = $id;
					if ($this->db->insert('tb_template_email',$data_email)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/email/template');
					}
				}
			}
			$ret['notif']['template'] = form_error('template');

			echo json_encode($ret);
			exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'email/master_template_layout',$this->data);
	}
}