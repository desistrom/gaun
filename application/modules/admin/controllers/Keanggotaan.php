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
			// $this->form_validation->set_rules('password','Passowrd','trim|required');
			// $this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
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
			// $ret['notif']['password'] = form_error('password');
			// $ret['notif']['repassword'] = form_error('repassword');
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
				if(!is_null($this->data['content']['image_profit'])){
					if ($this->input->post('id') == '') {
						// $about['profit'] = 'dumy';
						$data_gambar = $this->upload_logo($_FILES);
						if (isset($data_gambar['error'])) {
							$ret['notif'] = $data_gambar;
						}else{	
							$about['image_profit'] = $data_gambar['asli'];
							if ($this->db->insert('tb_setting_user',$about)) {
								$ret['status'] = 1;
								$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							}
						}					
						
					}else{
						if (isset($_FILES['userfile'])) {
							$data_gambar = $this->upload_logo($_FILES);
							if (isset($data_gambar['error'])) {
								$ret['notif'] = $data_gambar;
							}else{
								$about['image_profit'] = $data_gambar['asli'];
								if (file_exists(FCPATH."media/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/".$this->data['content']['image_profit']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/thumbnail/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/thumbnail/".$this->data['content']['image_profit']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/crop/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/crop/".$this->data['content']['image_profit']);
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
					}else{
						if (isset($_FILES['userfile'])) {
							$data_gambar = $this->upload_logo($_FILES);
							if (isset($data_gambar['error'])) {
								$ret['notif'] = $data_gambar;
							}else{
								$about['image_profit'] = $data_gambar['asli'];
								if (file_exists(FCPATH."media/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/".$this->data['content']['image_profit']);
			            		}
			            		if (file_exists(FCPATH."media/thumbnail/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/thumbnail/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/thumbnail/".$this->data['content']['image_profit']);
			            		}
			            		if (file_exists(FCPATH."media/crop/".$this->data['content']['image_profit'])) {
			            			@chmod(FCPATH."media/crop/".$this->data['content']['image_profit'], 0777);
			            			@unlink(FCPATH."media/crop/".$this->data['content']['image_profit']);
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
							$data_gambar = $this->upload_logo($_FILES);
							if (isset($data_gambar['error'])) {
								$ret['notif'] = $data_gambar;
							}else{
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
					}else{
						if (isset($_FILES['userfile'])) {
							$data_gambar = $this->upload_logo($_FILES);
							if (isset($data_gambar['error'])) {
								$ret['notif'] = $data_gambar;
							}else{
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
		$sql = 'SELECT * FROM tb_instansi i LEFT join tb_jenis_instansi j on i.id_jenis_instansi = j.id_jenis_instansi';
		$this->data['instansi'] = $this->db->query($sql)->result_array();
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
			$this->form_validation->set_rules('jenis','Kategori Instansi','trim|required');
			$this->form_validation->set_rules('username','Username','trim|required');
			// $this->form_validation->set_rules('password','Passowrd','trim|required');
			// $this->form_validation->set_rules('sort','Urutan','trim|numeric');
			if ($this->form_validation->run() == true && isset($_FILES['userfile'])) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('name');
				$data_instansi['website'] = $this->input->post('website');
				$data_instansi['phone'] = $this->input->post('phone');
				$data_instansi['alamat'] = $this->input->post('alamat');
				$data_instansi['username'] = $this->input->post('username');
				$data_instansi['email'] = $this->input->post('email');
				$data_instansi['id_jenis_instansi'] = $this->input->post('jenis');
				$data_instansi['password'] = sha1('password'.$data_instansi['username']);
				if ($this->input->post('sort') == '') {
					$data_instansi['sort'] = NULL;
				}
				$data_gambar = $this->upload_instansi($_FILES);
				if (isset($data_gambar['error'])) {
					$ret['notif'] = $data_gambar;
				}else{	
					$data_instansi['gambar'] = $data_gambar['asli'];
					if ($this->db->insert('tb_instansi',$data_instansi)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/keanggotaan/instansi_request');
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['name'] = form_error('name');
			$ret['notif']['website'] = form_error('website');
			$ret['notif']['phone'] = form_error('phone');
			$ret['notif']['alamat'] = form_error('alamat');
			$ret['notif']['username'] = form_error('username');
			$ret['notif']['jenis'] = form_error('jenis');
			$ret['notif']['email'] = form_error('email');
			// $ret['notif']['password'] = form_error('password');
			// $ret['notif']['sort'] = form_error('sort');
			if (!isset($_FILES['userfile'])) {
				$ret['notif']['userfile'] = "Please Select File";
			}
			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Instansi';
		$this->data['view'] = 'add';
		$this->data['kategori'] = $this->db->get('tb_jenis_instansi')->result_array();
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
			$this->form_validation->set_rules('jenis','Kategori Instansi','trim|required');
			$this->form_validation->set_rules('sort','Urutan','trim|numeric');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_instansi['nm_instansi'] = $this->input->post('name');
				$data_instansi['website'] = $this->input->post('website');
				$data_instansi['phone'] = $this->input->post('phone');
				$data_instansi['alamat'] = $this->input->post('alamat');
				$data_instansi['id_jenis_instansi'] = $this->input->post('jenis');
				$data_instansi['email'] = $this->input->post('email');
				if ($this->input->post('sort') == '') {
					$data_instansi['sort'] = NULL;
				}
				//
				if (isset($_FILES['userfile'])) {
					$image = $this->upload_instansi($_FILES);
					if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$data_instansi['gambar'] = $image['asli'];
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
			$ret['notif']['jenis'] = form_error('jenis');
			$ret['notif']['email'] = form_error('email');
			$ret['notif']['sort'] = form_error('sort');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['kategori'] = $this->db->get('tb_jenis_instansi')->result_array();
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
		$html .= '<button class="btn btn-success btn-sm btn_reset" id="'.$data['id_instansi'].'"><i class="fa fa-key"></i> reset</button>';
		echo json_encode($html);
		exit();
	}

	public function reset($id){
		$ret['state'] = 0;
        $ret['status'] = 0;
        // $this->form_validation->set_error_delimiters('', '');
        // $this->form_validation->set_rules('email','E-Mail', 'required');
        // if ($this->form_validation->run() == true) {
            // $input = $this->input->post();
            $sql = $this->db->get_where('tb_instansi',array('id_instansi'=>$id));
            // if ($sql->num_rows() > 0) {
                $ret['state'] = 1;
                $user = $sql->row_array();
                $mail = sha1($user['email']);
                $reset = $mail.$user['password'];
                $this->load->helper('email_send_helper');
                $data['email_from'] = 'support@IDREN';
                $data['name_from'] = 'IDREN support';
                $data['email_to'] = $user['email'];
                $data['subject'] = 'Request reset Password';
                $data['content'] = 'Ini Adalah link reset Password anda<br/>'.site_url('instansi/login/reset?data='.$reset);
                if (email_send($data) == true) {
                    $this->db->update('tb_instansi',array('reset'=>$reset),array('id_instansi'=>$user['id_instansi']));
                    $user_data = 'success';
                    $ret['status'] = 1;
                    $this->session->set_flashdata("header","Request Reset Password Berhasil");
                    $this->session->set_flashdata("notif","Email Request Reset Password berhasil dikirim ke E-mail anda, Silahkan kunjungi link yang kami berikan");
                    $ret['url'] = site_url('admin/keanggotaan/instansi');
                    // redirect(site_url('dashboard/reset_password'));
                }
        echo json_encode($ret);
        // exit();
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

	public function kategori_instansi(){
		$this->data['breadcumb'] = 'List Kategori Instansi';
		$this->data['view'] = 'list';
		$this->data['kategori'] = $this->db->get('tb_jenis_instansi')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_jenis_instansi',$this->data);
	}

	public function add_jenis(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Jenis Instansi', 'trim|required');
			$this->form_validation->set_rules('content','Deskripsi Instansi', 'trim|required');
			$this->form_validation->set_rules('short','Deskripsi Singkat', 'trim|required');
			$this->form_validation->set_rules('icon','icon Instansi', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$datakat['nm_jenis_instansi'] = $this->input->post('kategori');
				$datakat['deskripsi'] = $this->input->post('content');
				$datakat['short_description'] = $this->input->post('short');
				$datakat['icon'] = $this->input->post('icon');
				/*$data_gambar = $this->upload_logo($_FILES);
				if (isset($data_gambar['error'])) {
					$ret['notif'] = $data_gambar;
				}else{	
					$datakat['gambar'] = $data_gambar['asli'];*/
					if ($this->db->insert('tb_jenis_instansi',$datakat)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/keanggotaan/kategori_instansi');
					}
				// }
			}
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['short'] = form_error('short');
			$ret['notif']['icon'] = form_error('icon');
			/*if (!isset($_FILES['userfile'])) {
				$ret['notif']['userfile'] = "Please Select File";
			}*/
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
		$this->data['breadcumb'] = 'Edit Kategori Instansi';
		$this->data['view'] = 'edit';
		$this->data['breadcumb'] = 'Add Kategori Instansi';
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_jenis_instansi',$this->data);
	}

	public function edit_jenis(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['kategori'] = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$id))->row_array();
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Jenis Instansi', 'trim|required');
			$this->form_validation->set_rules('short','Deskripsi Singkat', 'trim|required');
			$this->form_validation->set_rules('icon','icon Instansi', 'trim|required');
			$this->form_validation->set_rules('content','Deskripsi Instansi', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_kategori['nm_jenis_instansi'] = $this->input->post('kategori');
				$data_kategori['deskripsi'] = $this->input->post('content');
				$data_kategori['short_description'] = $this->input->post('short');
				$data_kategori['icon'] = $this->input->post('icon');
				/*if (isset($_FILES['userfile'])) {
					$data_gambar = $this->upload_logo($_FILES);
					if (isset($data_gambar['error'])) {
						$ret['notif'] = $data_gambar;
					}else{
						$data_kategori['gambar'] = $data_gambar['asli'];
						if (file_exists(FCPATH."media/".$this->data['kategori']['gambar'])) {
	            			@chmod(FCPATH."media/".$this->data['kategori']['gambar'], 0777);
	            			@unlink(FCPATH."media/".$this->data['kategori']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/thumbnail/".$this->data['kategori']['gambar'])) {
	            			@chmod(FCPATH."media/thumbnail/".$this->data['kategori']['gambar'], 0777);
	            			@unlink(FCPATH."media/thumbnail/".$this->data['kategori']['gambar']);
	            		}
	            		if (file_exists(FCPATH."media/crop/".$this->data['kategori']['gambar'])) {
	            			@chmod(FCPATH."media/crop/".$this->data['kategori']['gambar'], 0777);
	            			@unlink(FCPATH."media/crop/".$this->data['kategori']['gambar']);
	            		}

	            		if ($this->db->update('tb_jenis_instansi',$data_kategori,array('id_jenis_instansi'=>$id))) {
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							$ret['url'] = site_url('admin/keanggotaan/kategori_instansi');
						}
					}
				}else{*/
					if ($this->db->update('tb_jenis_instansi',$data_kategori,array('id_jenis_instansi'=>$id))) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/keanggotaan/kategori_instansi');
					}
				// }
			}
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['short'] = form_error('short');
			$ret['notif']['icon'] = form_error('icon');
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
		$this->data['breadcumb'] = 'Edit Kategori Instansi';
		$this->data['view'] = 'edit';
		// $this->data['kategori'] = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/master_jenis_instansi',$this->data);
	}

	public function delete_jenis(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$ret['status'] = 0;
		if ($this->db->get_where('tb_instansi',array('id_jenis_instansi'=>$id))->num_rows() > 0) {
			$ret['notif'] = 'Data Tidak Bisa Di Hapus';
			$this->session->set_flashdata("notif","Data Tidak Bisa Di Hapus");
		}else{
			if ($this->db->delete('tb_jenis_instansi',array('id_jenis_instansi'=>$id))) {
				$ret['status'] = 1;
				$this->session->set_flashdata("notif","Data Berhasil di Hapus");
			}
		}

		echo json_encode($ret);
	}

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['min_width']            = 100;
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
           	$data = array('upload_data' => $this->upload->data());
            $config_r['image_library'] = 'GD2';
            $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
            $config_r['quality'] = 10;
            $config_r['maintain_ratio'] = FALSE;
            if ($upload_data['image_width'] > 50) {
            	$config_r['width'] = 45;
            }
            $config_r['new_image'] = FCPATH."media/thumbnail/".$upload_data['file_name'];

            $this->load->library('image_lib', $config_r);
            $this->image_lib->initialize($config_r);
            $this->image_lib->resize();
            if ( ! $this->image_lib->resize())
            {
                    $data_upload['error'] = $this->image_lib->display_errors();
            }else{
                    // echo "berhasil resize";
                    $data_upload['resize'] = site_url('media/thumbnail/')."/".$upload_data['file_name'];
            }
        }
        return $data_upload;
    }

    public function upload_instansi($logo){	    		
    	
        $imagename = $logo['userfile']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
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
           	$data = array('upload_data' => $this->upload->data());
            $config_r['image_library'] = 'GD2';
            $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
            $config_r['quality'] = 20;
            $config_r['maintain_ratio'] = TRUE;
            if ($upload_data['image_width'] > 85) {
            	$config_r['width'] = 85;
            }
            // if ($upload_data['file_size'] > 15) {
            // 	$config_r['quality'] = 40;
            // }
            $config_r['new_image'] = FCPATH."media/thumbnail/".$upload_data['file_name'];

            $this->load->library('image_lib', $config_r);
            $this->image_lib->initialize($config_r);
            $this->image_lib->resize();
            if ( ! $this->image_lib->resize())
            {
                    $data_upload['error'] = $this->image_lib->display_errors();
            }else{
                    // echo "berhasil resize";
                    $data_upload['resize'] = site_url('media/thumbnail/')."/".$upload_data['file_name'];
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
		$ret['status'] = 0;
		if ($this->db->get_where('tb_instansi',array('id_instansi'=>$id))->row_array()['is_aktif'] == 1) {
			$this->db->update('tb_instansi',array('is_aktif'=>0),array('id_instansi'=>$id));
			$ret['status'] = 1;
			$ret['url'] = site_url('admin/keanggotaan/instansi');
		}else{
			$ret['status'] = 1;
			$ret['url'] = site_url('admin/keanggotaan/instansi');
			$this->db->update('tb_instansi',array('is_aktif'=>1),array('id_instansi'=>$id));
			$this->session->set_flashdata("notif","Instansi Berhasil di Aktifkan");
		}
		echo json_encode($ret);
		// redirect(site_url('admin/keanggotaan/instansi'));
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
	        $data_email['subject'] = "Permintaan Sedang di Proses";
	        $content = '';
	        $content .= "<tr><td>Nama Instansi </td><td>:</td> ".$data['nm_instansi']."</td></tr>";
	        $content .= "<tr><td>Username </td><td>:</td> ".$data['username']."</td></tr>";
	        // $content .= "<td>Password</td><td>:</td> ".$data['password']."</td>";
	        $content .= "<tr><td>Email</td><td>:</td> ".$data['email']."</td></tr>";
	        $content .= "<tr><td>Website</td><td>:</td> ".$data['website']."</td></tr>";
	        $content .= "<tr><td>Alamat</td><td>:</td> ".$data['alamat']."</td></tr>";
	        $data_email['content'] = str_replace("content_email", $content, $final);
	        if (email_send($data_email) == true) {
    			$this->db->update('tb_instansi',array('status'=>1),array('id_instansi'=>$id));
	    		$this->session->set_flashdata("notif","Instansi Berhasil di Proses, Email berhasil di Kirim");
	    		$ret['url'] = site_url('admin/keanggotaan/instansi_request');
	        }
    	}elseif($status==1){
    		$template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>3,'status'=>1))->row_array()['source_code'];
	        $final = str_replace("Email_User", $data['username'], $template);
	        $password = '';
	        // $final = str_replace("subject_email", "Done", $final);
	        $sender = $this->db->get('tb_setting_email')->row_array();
	        $this->load->helper('email_send_helper');
	        $data_email['email_from'] = $sender['email'];
	        $data_email['name_from'] = $sender['nama_user'];
	        $data_email['email_to'] = $data['email'];
	        $data_email['subject'] = "Permintaan Sudah di Proses";
	        $content = '';
	        $content .= "<tr><td>Nama Instansi</td><td>:</td> ".$data['nm_instansi']."</td></tr>";
	        $content .= "<tr><td>Username</td><td>:</td> ".$data['username']."</td></tr>";
	        if ($data['password'] == sha1('password'.$data['username'])) {
	        	$status_pass = 1;
	        	$password = $this->generate();
				$data['password'] = sha1($password);
	        	$content .= "<tr><td>Password</td><td>:</td> ".$password."</td></tr>";
			}
	        $content .= "<tr><td>Email</td><td>:</td> ".$data['email']."</td></tr>";
	        $content .= "<tr><td>Website</td><td>:</td> ".$data['website']."</td></tr>";
	        $content .= "<tr><td>Alamat</td><td>:</td> ".$data['alamat']."</td></tr>";
	        $data_email['content'] = str_replace("content_email", $content, $final);
	        if (email_send($data_email) == true) {
	        	if (isset($status_pass)) {
	        		$this->db->update('tb_instansi',array('status'=>2,'password'=>$password),array('id_instansi'=>$id));
	        	}else{
	    			$this->db->update('tb_instansi',array('status'=>2),array('id_instansi'=>$id));
	        	}
	    		$ret['url'] = site_url('admin/keanggotaan/instansi_request');
	    		$this->session->set_flashdata("notif","Instansi Berhasil di Aktifkan, Email berhasil di Kirim");
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

    public function ajax_list()
    {
    	$this->load->model('keanggotaan_model');
        $list = $this->keanggotaan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $instansi) {
            $no++;
            if ($instansi->is_aktif == 1) {
            	$aktif = '<span class="text-success">YES</span>';
            	$button = '<button class="btn btn-default btn_active btn-sm" id="'.$instansi->id_instansi.'"><span class="text-success"><i class="fa fa-eye-slash"></i></span> </button>
							<a href="'.site_url("admin/keanggotaan/edit_instansi").'/'.$instansi->id_instansi.'"><button class="btn btn-info btn-sm" id="edit">Edit</button></a>';
            }else{
            	$aktif = '<span class="text-Success">NO</span>';
            	$button = '<button class="btn btn-default btn_active btn-sm" id="'.$instansi->id_instansi.'"><span class="text-danger"><i class="fa fa-eye"></i></span></button>
							<a href="'.site_url("admin/keanggotaan/edit_instansi").'/'.$instansi->id_instansi.'"><button class="btn btn-info btn-sm" id="edit">Edit</button></a>';
            }
            $status = '';
            if($instansi->status == 0){ $status .= '<span class="text-info">Not Actived</span>'; }elseif($instansi->status == 1 ){ $status .= '<span class="text-primary">On Proces</span>'; }else{ $status .= '<span class="text-success">Active</span>'; }
            $proses = '<button class="btn btn-info status btn-sm" id="'.$instansi->status.'##'.$instansi->id_instansi.'">';
             if($instansi->status == 0){ $proses .= 'Proses'; }elseif($instansi->status==1){ $proses .= 'Done'; }else{ $proses .= 'Active';  } $proses .= '</button>';
            $row = array();
            $row[] = $no;
            $row[] = $instansi->nm_jenis_instansi;
            $row[] = '<span class="btn_detail" id="'.$instansi->id_instansi.'" style="cursor : pointer; color:blue;"><u>'.$instansi->nm_instansi.'<u/></span>';
            $row[] = $instansi->email;
            $row[] = $status;
            $row[] = $instansi->sort;
            $row[] = $aktif;
            $row[] = $button.' <button class="btn btn-danger btn-sm btn_delete" id="'.$instansi->id_instansi.'"> Delete </button>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->keanggotaan_model->count_all(),
                        "recordsFiltered" => $this->keanggotaan_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function instansi_request(){
		$this->data['view'] = 'list';
		$this->data['breadcumb'] = 'List Request Join Instansi';
		$this->ciparser->new_parse('template_admin','modules_admin', 'keanggotaan/request_layout',$this->data);
	}

    public function ajax_list_request()
    {
    	$this->load->model('keanggotaan_model');
        $list = $this->keanggotaan_model->get_datatables_request();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $instansi) {
            $no++;
            if ($instansi->is_aktif == 1) {
            	$aktif = '<span class="text-success">YES</span>';
            	$button = '<button class="btn btn-default btn_active btn-sm" id="'.$instansi->id_instansi.'"><span class="text-success"><i class="fa fa-eye-slash"></i></span> </button>
							<a href="'.site_url("admin/keanggotaan/edit_instansi").'/'.$instansi->id_instansi.'"><button class="btn btn-info btn-sm" id="edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
            	$aktif = '<span class="text-Success">NO</span>';
            	$button = '<button class="btn btn-default btn_active btn-sm" id="'.$instansi->id_instansi.'"><span class="text-danger"><i class="fa fa-eye"></i></span></button>
							<a href="'.site_url("admin/keanggotaan/edit_instansi").'/'.$instansi->id_instansi.'"><button class="btn btn-info btn-sm" id="edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $status = '';
            if($instansi->status == 0){ $status .= '<span class="text-info">Not Actived</span>'; }elseif($instansi->status == 1 ){ $status .= '<span class="text-primary">On Proces</span>'; }else{ $status .= '<span class="text-success">Active</span>'; }
            $proses = '<button class="btn btn-info status btn-sm" id="'.$instansi->status.'##'.$instansi->id_instansi.'">';
             if($instansi->status == 0){ $proses .= 'Proses'; }elseif($instansi->status==1){ $proses .= 'Done'; }else{ $proses .= 'Active';  } $proses .= '</button>';
            $row = array();
            $row[] = $no;
            $row[] = $instansi->nm_jenis_instansi;
            $row[] = '<span class="btn_detail" id="'.$instansi->id_instansi.'" style="cursor : pointer">'.$instansi->nm_instansi.'</span>';
            $row[] = $instansi->email;
            $row[] = $status;
            $row[] = $instansi->sort;
            $row[] = $proses.' <button class="btn btn-danger btn-sm btn_delete" id="'.$instansi->id_instansi.'"> Delete </button>';
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->keanggotaan_model->count_all_request(),
                        "recordsFiltered" => $this->keanggotaan_model->count_filtered_request(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function re_upload(){
    	$data = $this->db->get('tb_instansi')->result_array();
    	foreach ($data as $key => $value) {
    		if ($value['gambar'] != '') {
	    		$config_r['image_library'] = 'GD2';
		        $config_r['source_image'] = FCPATH."media/".$value['gambar'];
		        $config_r['quality'] = 20;
		        $config_r['maintain_ratio'] = TRUE;
		       	$config_r['width'] = 85;
		        $config_r['new_image'] = FCPATH."media/thumbnail/thumbnail/".$value['gambar'];

		        $this->load->library('image_lib', $config_r);
		        $this->image_lib->initialize($config_r);
		        $this->image_lib->resize();
		        if ( ! $this->image_lib->resize())
		        {
		                $data_upload['error'] = $this->image_lib->display_errors();
		        }else{
		                // echo "berhasil resize";
		                $data_upload['resize'] = site_url('media/thumbnail/')."/".$value['gambar'];
		        }

		        print_r($data_upload);
    		}
    	}
    }

    function generate(){
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
    }
}