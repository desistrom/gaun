<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Home extends CI_Controller  {

	var $data = array();
    function __construct() {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->model('home_model');
        if ($this->session->userdata('is_login') == false) {
        	redirect(site_url('login'));
        }
    }

    function index() {
    // print_r($this->session->userdata('token'));
    $this->ciparser->new_parse('template_admin','modules_admin', 'home/home_layout');
    }

    public function logo(){

		$this->data['image'] = $this->db->get('tb_logo')->row_array();
		if (isset($_FILES['userfile'])){
			$ret['state'] = 0;
			$ret['status'] = 0;
			if ($this->data['image'] == '') {
				$image = $this->upload_logo($_FILES);
				if (isset($image['error'])) {
					$ret['notif'] = $image;
				}else{
					$ret['state'] = 1;
					$data_image['logo'] = $image['asli'];
					if ($this->db->insert('tb_logo',$data_image)) {
						$ret['status'] = 1;
						$ret['url'] = current_url();
					}
				}
			}else{
				$image = $this->upload_logo($_FILES);
				if (isset($image['error'])) {
					$ret['notif'] = $image;
				}else{
					$ret['state'] = 1;
					$data_image['logo'] = $image['asli'];
					if ($this->db->update('tb_logo',$data_image,array('id_logo'=>$this->data['image']['id_logo']))) {
						$ret['status'] = 1;
						if (file_exists(FCPATH."media/".$this->data['image']['logo'])) {
	            			chmod(FCPATH."media/".$this->data['image']['logo'], 0777);
	            			unlink(FCPATH."media/".$this->data['image']['logo']);
	            		}
	            		if (file_exists(FCPATH."media/thumbnail/".$this->data['image']['logo'])) {
	            			chmod(FCPATH."media/thumbnail/".$this->data['image']['logo'], 0777);
	            			unlink(FCPATH."media/thumbnail/".$this->data['image']['logo']);
	            		}
	            		if (file_exists(FCPATH."media/crop/".$this->data['image']['logo'])) {
	            			chmod(FCPATH."media/crop/".$this->data['image']['logo'], 0777);
	            			unlink(FCPATH."media/crop/".$this->data['image']['logo']);
	            		}
						$ret['url'] = current_url();
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
		echo json_encode($ret);
		exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/Upload_layout',$this->data);
	}

	public function testimoni(){
		$this->data['view'] = 'list';
		// print_r($this->home_model->getTestimoni());
		$this->data['testimoni'] = $this->home_model->getTestimoni();
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/master_testimoni_layout',$this->data);
	}

	public function add_testimoni(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			$this->form_validation->set_rules('name','Nama User','trim|required');
			$this->form_validation->set_rules('jabatan','Jabatan','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$testimoni['content'] = $this->input->post('content');
				$testimoni['nama_user'] = $this->input->post('name');
				$testimoni['jabatan'] = $this->input->post('jabatan');
				if (isset($_FILES['userfile'])) {
					$image = $this->upload_logo($_FILES);
					if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$ret['state'] = 1;
						$testimoni['gambar'] = $image['asli'];
						if ($this->db->insert('tb_testimoni',$testimoni)) {
							$ret['status'] = 1;
							$ret['url'] = site_url('admin/home/testimoni');
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['jabatan'] = form_error('jabatan');
			if (!isset($_FILES['userfile'])) {
				$ret['notif']['userfile'] = "Please Select File";
			}
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
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/master_testimoni_layout',$this->data);
	}

	public function edit_testimoni(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['testimoni'] = $this->db->get_where('tb_testimoni',array('id_testimoni'=>$id))->row_array();
		/*print_r($this->input->post());
		return false;*/
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			$this->form_validation->set_rules('name','Nama User','trim|required');
			$this->form_validation->set_rules('jabatan','Jabatan','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$testimoni['content'] = $this->input->post('content');
				// $testimoni['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				$testimoni['nama_user'] = $this->input->post('name');
				$testimoni['jabatan'] = $this->input->post('jabatan');
				$id_testimoni['id_testimoni'] = $id;
				if (isset($_FILES['userfile'])) {
					$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$testimoni['gambar'] = $image['asli'];
		    			if ($this->db->get('tb_layanan')->num_rows() > 0) {
		    				if ($this->db->update('tb_testimoni',$testimoni,$id_testimoni)) {
		    					if (file_exists(FCPATH."media/".$this->data['testimoni']['gambar'])) {
			            			@chmod(FCPATH."media/".$this->data['testimoni']['gambar'], 0777);
			            			@unlink(FCPATH."media/".$this->data['testimoni']['gambar']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['testimoni']['gambar'])) {
			            			@chmod(FCPATH."media/thumbnail/".$this->data['testimoni']['gambar'], 0777);
			            			@unlink(FCPATH."media/thumbnail/".$this->data['testimoni']['gambar']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['testimoni']['gambar'])) {
			            			@chmod(FCPATH."media/crop/".$this->data['testimoni']['gambar'], 0777);
			            			@unlink(FCPATH."media/crop/".$this->data['testimoni']['gambar']);
			            		}
		    					$ret['status'] = 1;
		    					$ret['url'] = site_url('admin/home/testimoni');
		    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		    				}
		    			}
					}
				}else{
					if ($this->db->update('tb_testimoni',$testimoni,$id_testimoni)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/home/testimoni');
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}/*
				if ($this->db->update('tb_testimoni',$testimoni,$id_testimoni)) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/home/testimoni');
				}*/
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['jabatan'] = form_error('jabatan');
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
		$this->data['view'] = 'edit';
		
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/master_testimoni_layout',$this->data);
	}

    public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 2048;
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

    public function status_testimoni(){
    	$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->db->get_where('tb_testimoni',array('id_testimoni'=>$id))->row_array()['is_aktif'] == 1) {
			$this->db->update('tb_testimoni',array('is_aktif'=>0),array('id_testimoni'=>$id));
		}else{
			$this->db->update('tb_testimoni',array('is_aktif'=>1),array('id_testimoni'=>$id));
		}
		redirect(site_url('admin/home/testimoni'));
    }

    public function hero(){
    	$this->data['hero'] = $this->db->get('tb_hero')->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
    		$ret['state'] = 0;
    		$ret['status'] = 0;
    		$this->form_validation->set_error_delimiters('','');
    		$this->form_validation->set_rules('link','Video','trim|required');
    		$this->form_validation->set_rules('judul','Judul Hero','trim|required');
    		$this->form_validation->set_rules('content','Description','trim|required');
    		if ($this->form_validation->run() == true) {
    			$ret['state'] = 1;
    			$dt_hero['link_video'] = $this->input->post('link');
    			$dt_hero['title'] = $this->input->post('judul');
    			$dt_hero['content'] = $this->input->post('content');
    			if ($this->db->get('tb_hero')->num_rows() > 0) {
    				if ($this->db->update('tb_hero',$dt_hero,array('id_hero'=>$this->data['hero']['id_hero']))) {
    					$ret['status'] = 1;
    				}
    			}else{
    				if ($this->db->insert('tb_hero',$dt_hero)) {
    					$ret['status'] = 1;
    				}
    			}
    		}
    		$ret['notif']['link'] = form_error('link');
    		$ret['notif']['judul'] = form_error('judul');
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
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/hero_layout',$this->data);
    }

    public function layanan(){
    	$this->data['layanan'] = $this->db->get('tb_layanan')->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
    		$ret['state'] = 0;
    		$ret['status'] = 0;
    		$this->form_validation->set_error_delimiters('','');
    		// $this->form_validation->set_rules('link','Video','trim|required');
    		$this->form_validation->set_rules('judul','Judul Hero','trim|required');
    		$this->form_validation->set_rules('content','Description','trim|required');
    		if ($this->form_validation->run() == true) {
    			$ret['state'] = 1;
    			$dt_hero['title'] = $this->input->post('judul');
    			$dt_hero['content'] = $this->input->post('content');
    			if (isset($_FILES['userfile'])) {
    				$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$dt_hero['gambar'] = $image['asli'];
		    			if ($this->db->get('tb_layanan')->num_rows() > 0) {
		    				if ($this->db->update('tb_layanan',$dt_hero,array('id_layanan'=>$this->data['layanan']['id_layanan']))) {
		    					if (file_exists(FCPATH."media/".$this->data['layanan']['gambar'])) {
			            			@chmod(FCPATH."media/".$this->data['layanan']['gambar'], 0777);
			            			unlink(FCPATH."media/".$this->data['layanan']['gambar']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['layanan']['gambar'])) {
			            			@chmod(FCPATH."media/thumbnail/".$this->data['layanan']['gambar'], 0777);
			            			unlink(FCPATH."media/thumbnail/".$this->data['layanan']['gambar']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['layanan']['gambar'])) {
			            			@chmod(FCPATH."media/crop/".$this->data['layanan']['gambar'], 0777);
			            			unlink(FCPATH."media/crop/".$this->data['layanan']['gambar']);
			            		}
		    					$ret['status'] = 1;
		    				}
		    			}else{
		    				if ($this->db->insert('tb_layanan',$dt_hero)) {
		    					$ret['status'] = 1;
		    				}
		    			}
					}
    			}else{
    				if ($this->db->get('tb_layanan')->num_rows() > 0) {
	    				if ($this->db->update('tb_layanan',$dt_hero,array('id_layanan'=>$this->data['layanan']['id_layanan']))) {
	    					$ret['status'] = 1;
	    				}
	    			}else{
	    				if ($this->db->insert('tb_layanan',$dt_hero)) {
	    					$ret['status'] = 1;
	    				}
	    			}
    			}
    			
    		}
    		// $ret['notif']['link'] = form_error('link');
    		$ret['notif']['judul'] = form_error('judul');
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
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/layanan_layout',$this->data);
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
