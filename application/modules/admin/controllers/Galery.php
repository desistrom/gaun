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
		$this->data['galery'] = $this->galery_model->getTypeGalery("image");
		// print_r($this->data['galery']);
		$this->data['breadcumb'] = 'List Image';
		 $this->ciparser->new_parse('template_admin','modules_admin', 'galery/list_image_layout',$this->data);
	}

	public function list_video(){
		$this->data['galery'] = $this->galery_model->getTypeGalery("video");
		// print_r($this->data['galery']);
		$this->data['breadcumb'] = 'List Video';
		 $this->ciparser->new_parse('template_admin','modules_admin', 'galery/list_video_layout',$this->data);
	}

	public function album(){
		$this->data['album'] = $this->db->get('tb_album_galery')->result_array();
		$this->data['view'] = 'list';
		$this->data['breadcumb'] = 'List Album';
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/album_master_layout',$this->data);
	}

	public function add_album(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name','Judul Album','trim|required');
			$this->form_validation->set_rules('tgl','Tanggal Album','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul_album'] = $this->input->post('name');
				$media['tgl_kegiatan'] = $this->input->post('tgl');
				$media['key_album'] = $this->getRandomString($this->encryption->encrypt(now()));
				if ($this->galery_model->insertAlbum($media) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/galery/album');
            		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
            	}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['tgl'] = form_error('tgl');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'add';
		$this->data['breadcumb'] = 'Add Album';
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/album_master_layout',$this->data);
	}

	function getRandomString($characters) {
	    $string = '';
	    $length = 8;

	    for ($i = 0; $i < $length; $i++) {
	        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
	    }

	    return $string;
	}

	public function edit_album(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name','Judul Album','trim|required');
			$this->form_validation->set_rules('tgl','Tanggal Album','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul_album'] = $this->input->post('name');
				$media['tgl_kegiatan'] = $this->input->post('tgl');
				// $media['tgl_upload'] = date("D m Y", strtotime($this->input->post('tgl')));
				if ($this->galery_model->updateAlbum($media,$id) == true) {
            		$ret['status'] = 1;
            		$ret['url'] = site_url('admin/galery/album');
            		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
            	}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['tgl'] = form_error('tgl');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['breadcumb'] = 'Edit Album';
		$this->data['content'] = $this->db->get_where('tb_album_galery',array('id_album'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'galery/album_master_layout',$this->data);
	}

	public function add_image(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul','Judul','trim|required');
			$this->form_validation->set_rules('deskripsi','deskripsi','trim|required');
			$this->form_validation->set_rules('album','Album','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul'] = $this->input->post('judul');
				$media['deskripsi'] = $this->input->post('deskripsi');
				$media['id_album'] = $this->input->post('album');
				$media['tgl_upload'] = date('Y-m-d');
				$media['type'] = 'image';
				$media['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				if (isset($_FILES['file_names'])) {
					$filesCount = count($_FILES['file_names']['name']);
					for ($i=0; $i < $filesCount ; $i++) { 
						$_FILES['file_name']['name'] = $_FILES['file_names']['name'][$i];
		                $_FILES['file_name']['type'] = $_FILES['file_names']['type'][$i];
		                $_FILES['file_name']['tmp_name'] = $_FILES['file_names']['tmp_name'][$i];
		                $_FILES['file_name']['error'] = $_FILES['file_names']['error'][$i];
		                $_FILES['file_name']['size'] = $_FILES['file_names']['size'][$i];
		                $image = $this->upload_logo($_FILES);
						if (isset($image['error'])) {
							$ret['notif'] = $image;
						}else{
							$ret['state'] = 1;
							$media['file_name'] = $image['asli'];
							if ($this->galery_model->insertGalery($media) == true) {
		                		$ret['status'] = 1;
		                		$ret['url'] = site_url('admin/galery/list_image');
		                		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		                	}
						}
					}
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['album'] = form_error('album');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Image';
		$this->data['view'] = 'add';
		$this->data['album'] = $this->db->get('tb_album_galery')->result_array();
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
			$this->form_validation->set_rules('album','Album','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$media['judul'] = $this->input->post('judul');
				$media['deskripsi'] = $this->input->post('deskripsi');
				$media['id_album'] = $this->input->post('album');
				$media['tgl_upload'] = date('Y-m-d');
				if (isset($_FILES['file_name'])) {
					$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$media['file_name'] = $image['asli'];
		    			if ($this->db->get('tb_layanan')->num_rows() > 0) {
		    				if ($this->galery_model->editGalery($media,$id) == true) {
		    					if (file_exists(FCPATH."assets/media/".$this->data['galery']['file_name'])) {
			            			@chmod(FCPATH."assets/media/".$this->data['galery']['file_name'], 0777);
			            			unlink(FCPATH."assets/media/".$this->data['galery']['file_name']);
			            		}
			            		if (file_exists(FCPATH."assets/media/thumbnail/".$this->data['galery']['file_name'])) {
			            			@chmod(FCPATH."assets/media/thumbnail/".$this->data['galery']['file_name'], 0777);
			            			unlink(FCPATH."assets/media/thumbnail/".$this->data['galery']['file_name']);
			            		}
			            		if (file_exists(FCPATH."assets/media/crop/".$this->data['galery']['file_name'])) {
			            			@chmod(FCPATH."assets/media/crop/".$this->data['galery']['file_name'], 0777);
			            			unlink(FCPATH."assets/media/crop/".$this->data['galery']['file_name']);
			            		}
		    					$ret['status'] = 1;
		    					$ret['url'] = site_url('admin/galery/list_image');
		    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		    				}
		    			}
					}
				}else{
					if ($this->galery_model->editGalery($media,$id) == true) {
                		$ret['status'] = 1;
                		$ret['url'] = site_url('admin/galery/list_image');
                		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
                	}
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			$ret['notif']['album'] = form_error('album');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Edit Image';
		$this->data['view'] = 'edit';
		$this->data['album'] = $this->db->get('tb_album_galery')->result_array();
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
            		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
            	}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Edit Video';
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
			$this->session->set_flashdata("notif","Data Berhasil di Masukan");
			echo json_encode($ret);
		}
	}

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['file_name']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."assets/media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 400;
        $config['max_width']            = 2048;
        $config['min_width']            = 600;
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('file_name'))
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
                $config_r['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 150;
                $config_r['new_image'] = FCPATH."assets/media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);

                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('assets/media/thumbnail/')."/".$upload_data['file_name'];
                }
            }
            if ($upload_data['image_width'] > 768) {
                $config_c['image_library'] = 'GD2';
                $config_c['new_image'] = FCPATH."assets/media/crop/".$upload_data['file_name'];
                $config_c['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                $config_c['x_axis'] = 100;
                $config_c['y_axis'] = 60;

                $this->image_lib->initialize($config_c);

                if ( ! $this->image_lib->crop())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil Crop";
                        $data_upload['crop'] = site_url('assets/media/crop/')."/".$upload_data['file_name'];
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