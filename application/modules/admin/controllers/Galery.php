<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Galery extends MX_Controller  {

	var $data = array();

	public function __construct(){
		$this->load->model('galery_model');
	}

	public function list_image(){
		$this->data['galery'] = $this->galery_model->getTypeGalery(1);
		// print_r($this->data['galery']);
		 $this->ciparser->new_parse('template_admin','modules_admin', 'galery/list_image_layout',$this->data);
	}

	public function list_video(){
		$this->data['galery'] = $this->galery_model->getTypeGalery(2);
		// print_r($this->data['galery']);
		 $this->ciparser->new_parse('template_admin','modules_admin', 'galery/list_video_layout',$this->data);
	}

	public function add_image(){
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
				$media['type'] = 'image';
				$media['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				if (isset($_FILES['file_name'])) {
					$imagename = $_FILES['file_name']['name'];
                	$ext = strtolower($this->_getExtension($imagename));
					$config['upload_path']          = FCPATH."assets/media/";
	                $config['allowed_types']        = 'gif|jpg|png';
	                $config['max_size']             = 400;
	                $config['max_width']            = 2048;
	                $config['min_width']            = 600;
	                $config['file_name']            = time().".".$ext;
	                $this->load->library('upload', $config);
	                if ( ! $this->upload->do_upload('file_name')){
	                	$error = $this->upload->display_errors();
	                	$ret['notif']['file_name'] = $error;
	                }else{
	                	$upload_data = $this->upload->data();
	                	$media['file_name'] = $upload_data['file_name'];
	                	if ($this->galery_model->insertGalery($media) == true) {
	                		$ret['status'] = 1;
	                		$ret['url'] = site_url('admin/galery/list_image');
	                	}
	                }
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			if (!isset($_FILES['file_name'])) {
				$ret['notif']['file_name'] = "Please Select File";
			}
			echo json_encode($ret);
			exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/image_layout',$this->data);
	}

	public function add_video(){
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
				if ($this->galery_model->insertGalery($media) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/galery/list_video');
            	}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			$ret['notif']['file_name'] = form_error('file_name');
			echo json_encode($ret);
			exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/video_layout',$this->data);
	}

	public function edit_image(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['galery'] = $this->galery_model->rowGalery($id);
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
				if (isset($_FILES['file_name'])) {
					$imagename = $_FILES['file_name']['name'];
                	$ext = strtolower($this->_getExtension($imagename));
					$config['upload_path']          = FCPATH."assets/media/";
	                $config['allowed_types']        = 'gif|jpg|png';
	                $config['max_size']             = 400;
	                $config['max_width']            = 2048;
	                $config['min_width']            = 600;
	                $config['file_name']            = time().".".$ext;
	                $this->load->library('upload', $config);
	                if ( ! $this->upload->do_upload('file_name')){
	                	$error = array('error' => $this->upload->display_errors());
	                }else{
	                	$upload_data = $this->upload->data();
	                	$media['file_name'] = $upload_data['file_name'];
	                	if ($this->galery_model->editGalery($media,$id) == true) {
	                		$ret['status'] = 1;
	                		if (file_exists(FCPATH."assets/media/".$this->data['galery']['file_name'])) {
	                			chmod(FCPATH."assets/media/".$this->data['galery']['file_name'], 0777);
	                			unlink(FCPATH."assets/media/".$this->data['galery']['file_name']);
	                		}
	                		$ret['url'] = site_url('admin/galery/list_image');
	                	}
	                }
				}else{
					if ($this->galery_model->editGalery($media,$id) == true) {
                		$ret['status'] = 1;
                		$ret['url'] = site_url('admin/galery/list_image');
                	}
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			echo json_encode($ret);
			exit();
		}
		
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/image_layout',$this->data);
	}

	public function edit_video(){
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
				if ($this->galery_model->editGalery($media,$id) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/galery/list_video');
            	}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			echo json_encode($ret);
			exit();
		}
		$this->data['galery'] = $this->galery_model->rowGalery($id);
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/video_layout',$this->data);
	}

	public function preview(){

	}

	public function delete(){
		$id = $this->input->post('id');
		$data = $this->galery_model->rowGalery($id);
		// print_r(FCPATH."assets/media/".$data['file_name']);
		// return false;
		if (file_exists(FCPATH."assets/media/".$data['file_name'])) {
			chmod(FCPATH."assets/media/".$data['file_name'], 0777);
			unlink(FCPATH."assets/media/".$data['file_name']);
		}
		if($this->db->delete('tb_galery',array('id_galery'=>$id))){
			$ret = 1;
			echo json_encode($ret);
		}
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