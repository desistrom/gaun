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
		$this->data['about'] = $this->db->get('tb_about')->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			// print_r($this->input->post());
			/*print_r($this->input->post('id_founder')[2]);
			if ($this->input->post('id_founder')[2] == '') {
				print_r("string");
			}*/
			// return false;
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['content'] = $this->input->post('content');
				$id['id_about'] = $this->input->post('id');
				if ($this->db->get('tb_about')->num_rows() > 0) {
					if ($this->db->update('tb_about',$about,$id)) {
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if ($this->db->insert('tb_about',$about)) {
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
				$name = $this->input->post('nama');
				// print_r($_FILES['file_names']);
				$jabatan = $this->input->post('jabatan');
				$id_founder = $this->input->post('id_founder');
				$sort = $this->input->post('sort');
				$file = $this->input->post('file');
				for ($i=0; $i < count($name); $i++) {
					
					if (isset($_FILES['file_names']['name'][$i])) {	
						$_FILES['file_name']['name'] = $_FILES['file_names']['name'][$i];
		                $_FILES['file_name']['type'] = $_FILES['file_names']['type'][$i];
		                $_FILES['file_name']['tmp_name'] = $_FILES['file_names']['tmp_name'][$i];
		                $_FILES['file_name']['error'] = $_FILES['file_names']['error'][$i];
		                $_FILES['file_name']['size'] = $_FILES['file_names']['size'][$i];
		                $image = $this->upload_logo($_FILES);
		                if (isset($image['error'])) {
							$ret['notif'] = $image;
						}
					}
					$ret['state'] = 1;
					if ($id_founder[$i] == '') {
						$data_founder_insert['nama'] = $name[$i];
						$data_founder_insert['jabatan'] = $jabatan[$i];
						$data_founder_insert['foto'] = $image['asli'];
						$data_founder_insert['sort'] = $sort[$i];
						if ($this->db->insert('tb_founder',$data_founder_insert)) {
	                		$ret['status'] = 1;
	                		$ret['url'] = current_url();
	                		$this->session->set_flashdata("notif","Data Berhasil di Insert");
	                	}
					}else{
						if($file[$i] == 'file'){
							$data_founder_update['nama'] = $name[$i];
							$data_founder_update['jabatan'] = $jabatan[$i];
							$data_founder_update['foto'] = $image['asli'];
							$data_founder_update['sort'] = $sort[$i];
							if ($this->db->update('tb_founder',$data_founder_update,array('id_founder'=>$id_founder[$i]))) {
		                		$ret['status'] = 1;
		                		$ret['url'] = current_url();
		                		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		                	}
						}else{
							$data_founder['nama'] = $name[$i];
							$data_founder['jabatan'] = $jabatan[$i];
							$data_founder['sort'] = $sort[$i];
							if ($this->db->update('tb_founder',$data_founder,array('id_founder'=>$id_founder[$i]))) {
		                		$ret['status'] = 1;
		                		$ret['url'] = current_url();
		                		$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		                	}
						}
					}
					
				}
			}
			// return false;
			$ret['notif']['content'] = form_error('content');
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';
		$this->data['breadcumb'] = 'About';
		$this->data['founder'] = $this->db->get('tb_founder')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/about_layout',$this->data);
	}

	public function delete_about(){
		$id = $this->input->post('id');
		$ret = 0;
		if ($this->db->delete('tb_founder',array('id_founder'=>$id))) {
			$ret = 1;
			$this->session->set_flashdata("notif","Data Berhasil di Hapus");
		}
		echo json_encode($ret);
		exit();
	}

	public function contact(){
		$this->data['breadcumb'] = 'Kontak';
		$this->data['contact'] = $this->db->get('tb_contact')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/list_message_layout',$this->data);
	}

	public function footer(){
		$this->data['breadcumb'] = 'Setting Footer';
		$this->data['footer'] = $this->db->get('tb_footer')->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('alamat','Alamat Kantor','trim|required');
			$this->form_validation->set_rules('alamat2','Alamat Kantor ke-2','trim|required');
			$this->form_validation->set_rules('facebook','Link Facebook','trim|required');
			$this->form_validation->set_rules('twitter','Link Twitter','trim|required');
			$this->form_validation->set_rules('instagram','Link Instagram','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_footer['alamat'] = $this->input->post('alamat');
				$data_footer['alamat2'] = $this->input->post('alamat2');
				$data_footer['facebook'] = $this->input->post('facebook');
				$data_footer['twitter'] = $this->input->post('twitter');
				$data_footer['instagram'] = $this->input->post('instagram');
				if ($this->db->get('tb_footer')->num_rows() > 0) {
					if ($this->db->update('tb_footer',$data_footer,array('id_footer'=>$this->data['footer']['id_footer']))) {
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
			$ret['notif']['alamat2'] = form_error('alamat2');
			$ret['notif']['facebook'] = form_error('facebook');
			$ret['notif']['twitter'] = form_error('twitter');
			$ret['notif']['instagram'] = form_error('Instagram');
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '200px';
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/footer_layout',$this->data);
	}

	public function slider(){
		$this->data['breadcumb'] = 'Setting Footer';
		$this->data['slider'] = $this->db->get_where('tb_layanan',array('kategori'=>4))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Title Slider','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_footer['content'] = $this->input->post('content');
				$data_footer['title'] = 'Slider Keanggotaan';
				$data_footer['kategori'] = 4;
				$data_footer['gambar'] = 'dummy';
				if ($this->db->get_where('tb_layanan',array('kategori'=>4))->num_rows() > 0) {
					if ($this->db->update('tb_layanan',$data_footer,array('kategori'=>4))) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if ($this->db->insert('tb_layanan',$data_footer)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			echo json_encode($ret);
			exit();
		}
		$this->ciparser->new_parse('template_admin','modules_admin', 'about/slider_layout',$this->data);
	}

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['file_name']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."assets/media/";
        $config['allowed_types']        = 'gif|jpg|png|jpeg|PNG|JPG';
        $config['max_size']             = 400;
        $config['max_width']            = 2048;
        $config['min_width']            = 150;
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
            // if ($upload_data['image_width'] > 768 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."assets/media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['quality'] = 60;
                $config_r['width']         = 150;
                $config_r['new_image'] = FCPATH."assets/media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);
                $this->image_lib->initialize($config_r);
                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('assets/media/thumbnail/')."/".$upload_data['file_name'];
                }
            // }
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

    public function re_upload(){
    	$data = $this->db->get('tb_founder')->result_array();
    	foreach ($data as $key => $value) {
    		if ($value['foto'] != '') {
	    		$config_r['image_library'] = 'GD2';
		        $config_r['source_image'] = FCPATH."assets/media/".$value['foto'];
		        $config_r['quality'] = 60;
		        // $config_r['maintain_ratio'] = TRUE;
		       	$config_r['width'] = 250;
		        $config_r['new_image'] = FCPATH."assets/media/thumbnail/".$value['foto'];

		        $this->load->library('image_lib', $config_r);
		        $this->image_lib->initialize($config_r);
		        $this->image_lib->resize();
		        if ( ! $this->image_lib->resize())
		        {
		                $data_upload['error'] = $this->image_lib->display_errors();
		        }else{
		                // echo "berhasil resize";
		                $data_upload['resize'] = site_url('assets/media/thumbnail/')."/".$value['foto'];
		        }

		        print_r($data_upload);
    		}
    	}
    }
}