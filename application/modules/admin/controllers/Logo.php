<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Logo extends MX_Controller  {
	var $data = array();
	function __construct(){

	}

	public function index(){
		$this->data['image'] = $this->db->get_where('tb_logo',array('status'=>1))->row_array();
		if (isset($_FILES['userfile'])){
			$ret['state'] = 0;
			$ret['status'] = 0;
			if ($this->data['image'] == '') {
				$image = $this->upload_logo($_FILES);
				if (isset($image['error'])) {
					$ret['notif'] = $image;
				}else{
					$ret['state'] = 1;
					$data_image['favicon'] = $image['asli'];
					$data_image['status'] = 1;
					if ($this->db->insert('tb_logo',$data_image)) {
						$ret['status'] = 1;
						$ret['url'] = current_url();
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}else{
				$image = $this->upload_logo($_FILES);
				if (isset($image['error'])) {
					$ret['notif'] = $image;
				}else{
					$ret['state'] = 1;
					$data_image['favicon'] = $image['asli'];
					$data_image['status'] = 1;
					if ($this->db->update('tb_logo',$data_image,array('id_logo'=>$this->data['image']['id_logo']))) {
						$ret['status'] = 1;
						if (file_exists(FCPATH."media/".$this->data['image']['favicon'])) {
	            			chmod(FCPATH."media/".$this->data['image']['favicon'], 0777);
	            			unlink(FCPATH."media/".$this->data['image']['favicon']);
	            		}
	            		if (file_exists(FCPATH."media/thumbnail/".$this->data['image']['favicon'])) {
	            			chmod(FCPATH."media/thumbnail/".$this->data['image']['favicon'], 0777);
	            			unlink(FCPATH."media/thumbnail/".$this->data['image']['favicon']);
	            		}
	            		if (file_exists(FCPATH."media/crop/".$this->data['image']['favicon'])) {
	            			chmod(FCPATH."media/crop/".$this->data['image']['favicon'], 0777);
	            			unlink(FCPATH."media/crop/".$this->data['image']['favicon']);
	            		}
						$ret['url'] = current_url();
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
		echo json_encode($ret);
		exit();
		}

		$this->data['breadcumb'] = 'Setting Favicon';
		$this->ciparser->new_parse('template_admin','modules_admin', 'logo/logo_layout',$this->data);
	}

	public function title(){
		$this->data['title'] = $this->db->get_where('tb_logo',array('status'=>1))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('content','Title Page','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['title'] = $this->input->post('content');
				$id['id_logo'] = $this->input->post('id');
				if ($this->data['title'] == '') {
					if ($this->db->insert('tb_logo',$about)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if ($this->db->update('tb_logo',$about,$id)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Setting Title';
		$this->ciparser->new_parse('template_admin','modules_admin', 'logo/title_layout',$this->data);
	}

	public function profile(){
		$id = $this->session->userdata('data_user')['id_user'];
		$this->data['profile'] = $this->db->get_where('tb_user',array('id_user'=>$id))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('old_password','Old Passowrd','trim|required');
			$this->form_validation->set_rules('password','Passowrd','trim|required');
			$this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
			if ($this->form_validation->run() == True) {
				$ret['state'] = 1;
				$data_input = $this->input->post();
				$data_user['username'] = $data_input['username'];
				$data_user['password'] = sha1($data_input['password']);
				if ($this->db->get_where('tb_user',array('username'=>$data_input['username'],'password'=>sha1($data_input['old_password'])))->num_rows() > 0) {
					if ($this->db->update('tb_user',$data_user,array('id_user'=>$id))) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/logo/profile');
						$this->session->set_flashdata("notif","Data Berhasil di Update");
					}
				}else{
					$ret['notif']['true_password'] = 'Old Password is Wrong';
				}
			}
			$ret['notif']['username'] = form_error('username');
			$ret['notif']['old_password'] = form_error('old_password');
			$ret['notif']['password'] = form_error('password');
			$ret['notif']['repassword'] = form_error('repassword');
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Account';
		$this->ciparser->new_parse('template_admin','modules_admin', 'logo/profile_layout',$this->data);
	}

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 4056;
        $config['min_width']            = 200;
        $config['file_name']            = "favicon.".$ext;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
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
                $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 500;
                // $config_c['height'] = 100;
                $config_r['new_image'] = FCPATH."media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);

                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('media/thumbnail/')."/".$upload_data['file_name'];
                        $data_upload['crop'] = $this->crop($upload_data['file_name']);
                        
                }
            // }
            /*if ($upload_data['image_width'] > 768) {
                
            }*/
        }
        return $data_upload;
    }

    function crop($file_name){
    	$config_c['image_library'] = 'gd2';
                        // $config_c['library_path'] = '/usr/X11R6/bin/';
            $config_c['new_image'] = FCPATH."media/crop/".$file_name;
            $config_c['source_image'] = FCPATH."media/thumbnail/".$file_name;
            $config_c['width']  = 170;
            $config_c['height'] = 160;
            $config_c['maintain_ratio'] = false;
            $config_c['x_axis'] = 0;
			$config_c['y_axis'] = 0;

            $this->image_lib->initialize($config_c);

            if ( ! $this->image_lib->crop())
            {
                    return $this->image_lib->display_errors();
            }else{
                    return site_url('media/crop/')."/".$file_name;
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