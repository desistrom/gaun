<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Layanan extends CI_Controller  {

	var $data = array();
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        if ($this->session->userdata('is_login') == false) {
        	redirect(site_url('login'));
        }
    }

    public function index()
    {
    	$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'ID-BOOK';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
					
				}else{
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-BOOK'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-BOOK'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
					
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->num_rows() == 0) {
				if (isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-BOOK';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function id_journal()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'ID-JOURNAL';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-JOURNAL'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-JOURNAL'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-JOURNAL';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function id_tube()
    {
		$this->data['galery'] = $this->db->get('tb_tube')->result_array();
		// print_r($this->data['galery']);
		$this->data['breadcumb'] = 'List ID Tube';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/tube_layout',$this->data);
    }

    public function add_tube(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul','Judul','trim|required');
			$this->form_validation->set_rules('deskripsi','deskripsi','trim|required');
			$this->form_validation->set_rules('file_name','Link Video','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul'] = $this->input->post('judul');
				$media['deskripsi'] = $this->input->post('deskripsi');
				$media['tgl_upload'] = date('Y-m-d');
				$media['type'] = 'video';
				$media['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				$media['file_name'] = $this->input->post('file_name');
				if ($this->db->insert('tb_tube',$media) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/layanan/id_tube');
            		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
            	}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			$ret['notif']['file_name'] = form_error('file_name');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Video';
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/video_layout',$this->data);
	}

	public function edit_tube(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul','Judul','trim|required');
			$this->form_validation->set_rules('deskripsi','deskripsi','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul'] = $this->input->post('judul');
				$media['deskripsi'] = $this->input->post('deskripsi');
				$media['tgl_upload'] = date('Y-m-d');
				$media['file_name'] = $this->input->post('file_name');
				if ($this->db->update('tb_tube',$media,array('id_galery'=>$id)) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/layanan/id_tube');
            		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
            	}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Edit Video';
		$this->data['galery'] = $this->db->get_where('tb_tube',array('id_galery'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/video_layout',$this->data);
	}

    public function id_mail()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'ID-MAIL';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-MAIL'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-MAIL'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-MAIL';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function id_research()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'ID-RESEARCH';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-RESEARCH'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-RESEARCH'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-RESEARCH';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function id_links()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'ID-LINKS';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-LINKS'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-LINKS'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-LINKS';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function id_rank()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$subcontent = $this->input->post('content');
				$content = str_replace('&lt;', '<', $subcontent);
				$final = str_replace('&gt;', '>', $content);
				// print_r($final);
				// return false;
				$layanan['content'] = $final;
				$layanan['nama_page'] = 'ID-RANK';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-RANK'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'ID-RANK'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		// $this->ckeditor->config['toolbar'] = array(	                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'ID-RANK';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    public function monitoring_graph()
    {
		$this->data['about'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'MONITORING GRAPH'))->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['nama_page'] = 'MONITORING GRAPH';
				if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'MONITORING GRAPH'))->num_rows() == 0) {
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							if($this->db->insert('tb_page_layanan',$layanan)){
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						$ret['notif']['error'] = "Please Choose file";
					}
				}else{
					if (isset($_FILES['userfile'])) {
						$image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$layanan['image'] = $image['asli'];
							
							if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'MONITORING GRAPH'))){
								$ret['status'] = 1;
								if (file_exists(FCPATH."media/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/thumbnail/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['about']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['about']['image'])) {
			            			chmod(FCPATH."media/crop/".$this->data['about']['image'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['about']['image']);
			            		}
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
					}else{
						if($this->db->update('tb_page_layanan',$layanan,array('nama_page'=>'MONITORING GRAPH'))){
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			if ($this->db->get_where('tb_page_layanan',array('nama_page'=>'MONITORING GRAPH'))->num_rows() == 0) {
				if (!isset($_FILES['userfile'])) {
					$ret['notif']['error'] = "Please Choose file";
				}
			}
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'MONITORING GRAPH';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/layanan_layout',$this->data);
    }

    

    public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 4056;
        $config['min_width']            = 200;
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $data_upload['error'] = $this->upload->display_errors();
        }
        else
        {
            $upload_data = $this->upload->data();
            $data_upload['asli'] = $upload_data['file_name'];

            if ($upload_data['image_width'] > 768 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 150;
                $config_r['new_image'] = FCPATH."media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);

                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('media/thumbnail/')."/".$upload_data['file_name'];
                        
                }
            }
            if ($upload_data['image_width'] > 768) {
                $config_c['image_library'] = 'GD2';
                $config_c['new_image'] = FCPATH."media/crop/".$upload_data['file_name'];
                $config_c['source_image'] = FCPATH."media/".$upload_data['file_name'];
                $config_c['x_axis'] = 100;
                $config_c['y_axis'] = 60;

                $this->image_lib->initialize($config_c);

                if ( ! $this->image_lib->crop())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil Crop";
                        $data_upload['crop'] = site_url('media/crop/')."/".$upload_data['file_name'];
                }
            }
        }
        return $data_upload;
    }

    function _getExtension($str){
            $i = strrpos($str,".");
            if (!$i){
                return "";
            }   
            $l = strlen($str) - $i;
            $ext = substr($str,$i+1,$l);
            return $ext;
    }
}