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
			/*print_r($_FILES['userfile']);
			return false;*/
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
			if ($this->form_validation->run() == true AND isset($_FILES['userfile'])) {
				$ret['state'] = 1;
				$data_input = $this->input->post();
				$data_user['name'] = $data_input['name'];
				$data_user['username'] = $data_input['username'];
				$data_user['password'] = sha1($data_input['password']);
				$data_user['email'] = $data_input['email'];
				$data_user['phone'] = $data_input['phone'];
				$data_user['id_instansi_ref'] = $data_input['instansi'];
				$data_gambar = $this->upload_logo($_FILES);
				if (isset($data_gambar['error'])) {
					$ret['notif'] = $data_gambar;
				}else{	
					$data_user['gambar'] = $data_gambar['asli'];
					if ($this->db->insert('tb_user',$data_user)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/keanggotaan');
					}
				}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['username'] = form_error('username');
			$ret['notif']['password'] = form_error('password');
			$ret['notif']['repassword'] = form_error('repassword');
			$ret['notif']['email'] = form_error('email');
			$ret['notif']['phone'] = form_error('phone');
			$ret['notif']['instansi'] = form_error('instansi');
			if(!isset($_FILES['userfile'])){
				$ret['notif']['userfile'] = 'Please Select File';
			}
			echo json_encode($ret);
			exit();
		}
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/keanggotaan_add_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['anggota'] = $this->db->get_where('tb_user',array('id_user'=>$id))->row_array();
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
				if (isset($_FILES['userfile'])) {
					$data_gambar = $this->upload_logo($_FILES);
					$data_user['gambar'] = $data_gambar['asli'];
					if (file_exists(FCPATH."media/".$this->data['anggota']['gambar'])) {
            			chmod(FCPATH."media/".$this->data['anggota']['gambar'], 0777);
            			unlink(FCPATH."media/".$this->data['anggota']['gambar']);
            		}
            		if (file_exists(FCPATH."media/thumbnail/".$this->data['anggota']['gambar'])) {
            			chmod(FCPATH."media/thumbnail/".$this->data['anggota']['gambar'], 0777);
            			unlink(FCPATH."media/thumbnail/".$this->data['anggota']['gambar']);
            		}
            		if (file_exists(FCPATH."media/crop/".$this->data['anggota']['gambar'])) {
            			chmod(FCPATH."media/crop/".$this->data['anggota']['gambar'], 0777);
            			unlink(FCPATH."media/crop/".$this->data['anggota']['gambar']);
            		}
				}
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
		$this->data['view'] = 'list';
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	public function add_instansi(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('nama', 'Nama Instransi', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('nama');
				if ($this->db->insert('tb_instansi',$data_instansi)) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/keanggotaan/instansi');
				}
			}
			$ret['notif']['nama'] = form_error('nama');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'add';
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	public function edit_instansi(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('nama', 'Nama Instransi', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('nama');
				if ($this->db->update('tb_instansi',$data_instansi,array('id_instansi'=>$id))) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/keanggotaan/instansi');
				}
			}
			$ret['notif']['nama'] = form_error('nama');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['instansi'] = $this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 400;
        $config['max_width']            = 2048;
        $config['min_width']            = 600;
        $config['file_name']            = time().".".$ext;

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('userfile'))
        {
            $data_upload['error'] = $this->upload->display_errors();
        }
        else
        {
            $upload_data = $this->upload->data();

            if ($upload_data['image_width'] > 768 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 132;
                $config_r['new_image'] = FCPATH."media/thumbnail/".$upload_data['file_name'];

                $this->load->library('image_lib', $config_r);

                $this->image_lib->resize();
                if ( ! $this->image_lib->resize())
                {
                        $data_upload['error'] = $this->image_lib->display_errors();
                }else{
                        // echo "berhasil resize";
                        $data_upload['resize'] = site_url('media/thumbnail/')."/".$upload_data['file_name'];
                        $data_upload['asli'] = $upload_data['file_name'];
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

    public function status(){
    	$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->db->get_where('tb_user',array('id_user'=>$id))->row_array()['is_aktif'] == 1) {
			$this->db->update('tb_user',array('is_aktif'=>0),array('id_user'=>$id));
		}else{
			$this->db->update('tb_user',array('is_aktif'=>1),array('id_user'=>$id));
		}
		redirect(site_url('admin/keanggotaan'));
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