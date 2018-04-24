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
		$this->data['breadcumb'] = 'List User';
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
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		$this->data['breadcumb'] = 'Add User';
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
					$image = $this->upload_logo($_FILES);
					if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$data_gambar = $this->upload_logo($_FILES);
						$data_user['gambar'] = $data_gambar['asli'];
						if (file_exists(FCPATH."media/".$this->data['anggota']['gambar'])) {
	            			@chmod(FCPATH."media/".$this->data['anggota']['gambar'], 0777);
	            			unlink(FCPATH."media/".$this->data['anggota']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/thumbnail/".$this->data['anggota']['gambar'])) {
	            			@chmod(FCPATH."media/thumbnail/".$this->data['anggota']['gambar'], 0777);
	            			unlink(FCPATH."media/thumbnail/".$this->data['anggota']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/crop/".$this->data['anggota']['gambar'])) {
	            			@chmod(FCPATH."media/crop/".$this->data['anggota']['gambar'], 0777);
	            			unlink(FCPATH."media/crop/".$this->data['anggota']['gambar']);
	            		}
					}
				}
				if ($this->db->update('tb_user',$data_user,array('id_user'=>$id))) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/keanggotaan');
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		$this->data['breadcumb'] = 'Edit user';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/keanggotaan_edit_layout',$this->data);
	}

	public function setting(){
		$this->data['content'] = $this->db->get('tb_setting_user')->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('benefit','Benefit','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['profit'] = $this->input->post('benefit');
				$id['id_setting'] = $this->input->post('id');
				if ($this->input->post('id') == '') {
					$about['cara'] = 'dumy';
					if ($this->db->insert('tb_setting_user',$about)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if ($this->db->update('tb_setting_user',$about,$id)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['benefit'] = form_error('benefit');
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
		$this->data['view'] = 'benefit';
		$this->data['breadcumb'] = 'Dashboard';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/setting_layout',$this->data);
	}

	public function setting_reg(){
		$this->data['content'] = $this->db->get('tb_setting_user')->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('cara','Tata Cara','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$about['cara'] = $this->input->post('cara');
				$id['id_setting'] = $this->input->post('id');
				// print_r($this->data['content']['image']);
				// return false;
				if(!is_null($this->data['content']['image'])){
					if ($this->input->post('id') == '') {
						// $about['profit'] = 'dumy';
						$data_gambar = $this->upload_logo($_FILES);
						if (isset($data_gambar['error'])) {
							$ret['notif'] = $data_gambar;
						}else{	
							$about['image'] = $data_gambar['asli'];
							if ($this->db->insert('tb_setting_user',$about)) {
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}					
						
					}else{
						if (isset($_FILES['userfile'])) {
							$image = $this->upload_logo($_FILES);
							if (isset($image['error'])) {
								$ret['notif'] = $image;
							}else{
								$data_gambar = $this->upload_logo($_FILES);
								$about['image'] = $data_gambar['asli'];
								if (file_exists(FCPATH."media/".$this->data['content']['image'])) {
			            			@chmod(FCPATH."media/".$this->data['content']['image'], 0777);
			            			@unlink(FCPATH."media/".$this->data['content']['image']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['content']['image'])) {
			            			@chmod(FCPATH."media/thumbnail/".$this->data['content']['image'], 0777);
			            			@unlink(FCPATH."media/thumbnail/".$this->data['content']['image']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['content']['image'])) {
			            			@chmod(FCPATH."media/crop/".$this->data['content']['image'], 0777);
			            			@unlink(FCPATH."media/crop/".$this->data['content']['image']);
			            		}

			            		if ($this->db->update('tb_setting_user',$about,$id)) {
									$ret['status'] = 1;
									$this->session->set_flashdata("notif","Data Berhasil di Masukan");
								}
							}
						}else{
							if ($this->db->update('tb_setting_user',$about,$id)) {
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}
						
					}
				}else{
					if (!isset($_FILES['userfile'])) {
						$ret['notif']['userfile'] = "Please Select File";
					}
				}
			}
			$ret['notif']['cara'] = form_error('cara');
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
		$this->data['breadcumb'] = 'Dashboard';
		$this->data['view'] = 'cara';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/setting_layout',$this->data);
	}

	public function instansi(){
		$this->data['view'] = 'list';
		$this->data['breadcumb'] = 'List Instansi';
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	public function add_instansi(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name', 'Nama Instransi', 'trim|required');
			$this->form_validation->set_rules('website','Website','trim|required');
			$this->form_validation->set_rules('alamat','Alamat','trim|required');
			$this->form_validation->set_rules('phone','phone','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required');
			$this->form_validation->set_rules('username','Username','trim|required');
			$this->form_validation->set_rules('password','Passowrd','trim|required');
			if ($this->form_validation->run() == true && isset($_FILES['userfile'])) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('name');
				$data_instansi['website'] = $this->input->post('website');
				$data_instansi['phone'] = $this->input->post('phone');
				$data_instansi['alamat'] = $this->input->post('alamat');
				$data_instansi['username'] = $this->input->post('username');
				$data_instansi['email'] = $this->input->post('email');
				$data_instansi['password'] = $this->input->post('password');
				$data_gambar = $this->upload_logo($_FILES);
				if (isset($data_gambar['error'])) {
					$ret['notif'] = $data_gambar;
				}else{	
					$data_instansi['gambar'] = $data_gambar['asli'];
					if ($this->db->insert('tb_instansi',$data_instansi)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/keanggotaan/instansi');
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['website'] = form_error('website');
			$ret['notif']['phone'] = form_error('phone');
			$ret['notif']['alamat'] = form_error('alamat');
			$ret['notif']['username'] = form_error('username');
			$ret['notif']['email'] = form_error('email');
			$ret['notif']['password'] = form_error('password');
			if (!isset($_FILES['userfile'])) {
				$ret['notif']['userfile'] = "Please Select File";
			}
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Instansi';
		$this->data['view'] = 'add';
		$this->data['instansi'] = $this->db->get('tb_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	public function edit_instansi(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['instansi'] = $this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('name', 'Nama Instransi', 'trim|required');
			$this->form_validation->set_rules('website','Website','trim|required');
			$this->form_validation->set_rules('alamat','Alamat','trim|required');
			$this->form_validation->set_rules('phone','phone','trim|required');
			$this->form_validation->set_rules('email','Email','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('name');
				$data_instansi['website'] = $this->input->post('website');
				$data_instansi['phone'] = $this->input->post('phone');
				$data_instansi['alamat'] = $this->input->post('alamat');
				$data_instansi['email'] = $this->input->post('email');
				if (isset($_FILES['userfile'])) {
					$image = $this->upload_logo($_FILES);
					if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$data_gambar = $this->upload_logo($_FILES);
						$data_instansi['gambar'] = $data_gambar['asli'];
						if (file_exists(FCPATH."media/".$this->data['instansi']['gambar'])) {
	            			@chmod(FCPATH."media/".$this->data['instansi']['gambar'], 0777);
	            			@unlink(FCPATH."media/".$this->data['instansi']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/thumbnail/".$this->data['instansi']['gambar'])) {
	            			@chmod(FCPATH."media/thumbnail/".$this->data['instansi']['gambar'], 0777);
	            			@unlink(FCPATH."media/thumbnail/".$this->data['instansi']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/crop/".$this->data['instansi']['gambar'])) {
	            			@chmod(FCPATH."media/crop/".$this->data['instansi']['gambar'], 0777);
	            			@unlink(FCPATH."media/crop/".$this->data['instansi']['gambar']);
	            		}

	            		if ($this->db->update('tb_instansi',$data_instansi,array('id_instansi'=>$id))) {
							$ret['status'] = 1;
							$ret['url'] = site_url('admin/keanggotaan/instansi');
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}else{
					if ($this->db->update('tb_instansi',$data_instansi,array('id_instansi'=>$id))) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/keanggotaan/instansi');
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
				
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['website'] = form_error('website');
			$ret['notif']['phone'] = form_error('phone');
			$ret['notif']['alamat'] = form_error('alamat');
			$ret['notif']['email'] = form_error('email');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['breadcumb'] = 'Edit Instansi';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_instansi_layout',$this->data);
	}

	public function detail_instansi(){
		$id = $this->input->post('id');
		$data = $this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array();
		$html = '';
		$html .= '<li> Nama : '.$data['nm_instansi'].'</li>';
		$html .= '<li> E-mail : '.$data['email'].'</li>';
		$html .= '<li> Alamat : '.$data['alamat'].'</li>';
		$html .= '<li> Phone : '.$data['phone'].'</li>';
		$html .= '<li> Website : '.$data['website'].'</li>';
		$html .= '<li> Logo : <img src="'.base_url().'media/'.$data['gambar'].'" width="120px" /></li>';
		echo json_encode($html);
		exit();
	}

	public function delete_instansi(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id['id_instansi'] = $this->input->post('id');
			$file_name = $this->db->get_where('tb_instansi',$id)->row_array()['gambar'];
			if (file_exists(FCPATH."media/".$file_name)) {
    			@chmod(FCPATH."media/".$file_name, 0777);
    			@unlink(FCPATH."media/".$file_name);
    		}
    		if (file_exists(FCPATH."media/thumbnail/".$file_name)) {
    			@chmod(FCPATH."media/thumbnail/".$file_name, 0777);
    			@unlink(FCPATH."media/thumbnail/".$file_name);
    		}
    		if (file_exists(FCPATH."media/crop/".$file_name)) {
    			@chmod(FCPATH."media/crop/".$file_name, 0777);
    			@unlink(FCPATH."media/crop/".$file_name);
    		}
    		$this->db->delete('tb_instansi',$id);
    		$this->session->set_flashdata("notif","Data Berhasil di Hapus");
    		echo json_encode("finish");
    		exit();
		}
	}

	

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 4000;
        $config['max_width']            = 2048;
        $config['min_width']            = 400;
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

    public function active_instansi(){
    	$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array()['is_aktif'] == 1) {
			$this->db->update('tb_instansi',array('is_aktif'=>0),array('id_instansi'=>$id));
		}else{
			$this->db->update('tb_instansi',array('is_aktif'=>1),array('id_instansi'=>$id));
		}
		$this->session->set_flashdata("notif","Data Berhasil di Ubah");
		echo json_encode("berhasil");
    }

    public function status_instansi(){
    	$url = explode("##", $this->input->post('id'));
		$id = end($url);
		$status = $url[0];
		$data = $this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array();
    	if($status==0){
    		$template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>2,'status'=>1))->row_array()['source_code'];
	        $final = str_replace("Email_User", $data['username'], $template);
	        // $final = str_replace("subject_email", "On Process", $final);
	        $sender = $this->db->get('tb_setting_email')->row_array();
	        $this->load->helper('email_send_helper');
	        $data_email['email_from'] = $sender['email'];
	        $data_email['name_from'] = $sender['nama_user'];
	        $data_email['email_to'] = $data['email'];
	        $data_email['subject'] = "Permintaan Sedang di Proces";
	        $content = '';
	        $content .= "<td>Nama Instansi </td><td>:</td> ".$data['nm_instansi']."</td>";
	        $content .= "<td>Username </td><td>:</td> ".$data['username']."</td>";
	        // $content .= "<td>Password</td><td>:</td> ".$data['password']."</td>";
	        $content .= "<td>Email</td><td>:</td> ".$data['email']."</td>";
	        $content .= "<td>Website</td><td>:</td> ".$data['website']."</td>";
	        $content .= "<td>Alamat</td><td>:</td> ".$data['alamat']."</td>";
	        $data_email['content'] = str_replace("content_email", $content, $final);
	        if (email_send($data_email) == true) {
    			$this->db->update('tb_instansi',array('status'=>1),array('id_instansi'=>$id));
	    		$this->session->set_flashdata("notif","Data Berhasil di Ubah, Email berhasil di Kirim");
	    		$ret['url'] = site_url('admin/keanggotaan/instansi');
	        }
    	}elseif($status==1){
    		$template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>2,'status'=>1))->row_array()['source_code'];
	        $final = str_replace("Email_User", $data['username'], $template);
	        // $final = str_replace("subject_email", "Done", $final);
	        $sender = $this->db->get('tb_setting_email')->row_array();
	        $this->load->helper('email_send_helper');
	        $data_email['email_from'] = $sender['email'];
	        $data_email['name_from'] = $sender['nama_user'];
	        $data_email['email_to'] = $data['email'];
	        $data_email['subject'] = "Permintaan Sudah di Proces";
	        $content = '';
	        $content .= "<td>Nama Instansi</td><td>:</td> ".$data['nm_instansi']."</td>";
	        $content .= "<td>Username</td><td>:</td> ".$data['username']."</td>";
	        // $content .= "<td>Password</td><td>:</td> ".$data['password']."</td>";
	        $content .= "<td>Email</td><td>:</td> ".$data['email']."</td>";
	        $content .= "<td>Website</td><td>:</td> ".$data['website']."</td>";
	        $content .= "<td>Alamat</td><td>:</td> ".$data['alamat']."</td>";
	        $data_email['content'] = str_replace("content_email", $content, $final);
	        if (email_send($data_email) == true) {
	    		$this->db->update('tb_instansi',array('status'=>2),array('id_instansi'=>$id));
	    		$ret['url'] = site_url('admin/keanggotaan/instansi');
	    		$this->session->set_flashdata("notif","Data Berhasil di Ubah, Email berhasil di Kirim");
	    	}else{
	    		$ret['status'] = "false";
	    	}
    	}
    	echo json_encode($ret);
    	exit();
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