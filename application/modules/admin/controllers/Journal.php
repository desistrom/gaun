<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Journal extends MX_Controller  {

	var $data = array();

	public function __construct(){
		// $this->load->model('home_model');
	}

	public function index(){
		$this->data['kategori'] = $this->db->get('tb_kategori_journal')->result_array();
		$this->data['view'] = 'list';
		$this->data['breadcumb'] = 'List Kategori Journal';
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function add(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori journal', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$datakat['nama'] = $this->input->post('kategori');
				if ($this->db->insert('tb_kategori_journal',$datakat)) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/journal/');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Kategori journal';
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori journal', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_email['nama'] = $this->input->post('kategori');
				if ($this->db->update('tb_kategori_journal',$data_email,array('id_kategori'=>$id))) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/journal/index');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Edit Kategori journal';
		$this->data['view'] = 'edit';
		$this->data['kategori'] = $this->db->get_where('tb_kategori_journal',array('id_kategori'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function delete(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->db->get_where('tb_journal',array('id_kategori_ref'=>$id))->num_rows() > 0) {
			$ret['status'] = 0;
			$ret['notifikasi'] = "Kategori ini Memiliki data yang terkait, harap hapus data tersebut";
			$this->session->set_flashdata("notif","Kategori ini Memiliki data yang terkait, harap hapus data tersebut");
			$this->session->set_flashdata("header","Gagal");
		}else{
			if ($this->db->delete('tb_kategori_journal',array('id_kategori'=>$id))) {
				$this->session->set_flashdata("notif","Data Berhasil di Delete");
				$ret['status'] = 1;
				// redirect(site_url('admin/email/kategori'));
			}else{
				$ret['status'] = 0;
				$this->session->set_flashdata("notif","Data Gagal di Delete");
				$this->session->set_flashdata("header","Gagal");
				$ret['notifikasi'] = "Kategori Gagal di hapus";
			}
		}
		echo json_encode($ret);
	}
}