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
        // if ($this->session->userdata('is_login') == false) {
        // 	redirect(site_url('login'));
        // }
        if(!isset($_COOKIE['data_admin']) || decode_token_jwt($_COOKIE['data_admin']) != true){
        	redirect(site_url('login'));
        }
        /*$token = $this->session->userdata('token');
        $url = $this->uri->segment_array();
        $cl = $url[1];
        if (isset($url[2])) {
        	$cl = $cl.'/'.$url[2];
        	if (isset($url[3])) {
        		$cl = $cl.'/'.$url[3];
        		if (isset($url[4])) {
        			$cl = $cl.'/'.$url[4];
        		}
        	}
        }
        if ($this->session->flashdata('tkn') == '') {
        	redirect(site_url('login/token/check_token?token='.$token.'&url='.$cl));
        }*/
    }

    function index() {
    // print_r($this->session->userdata('token'));
    	$this->data['breadcumb'] = 'Dashboard';
    	$this->data['user'] = $this->db->get('tb_instansi')->num_rows();
    	$instansi = $this->db->get('tb_jenis_instansi')->result_array();
    	foreach ($instansi as $key => $value) {
    		$this->data[$value['nm_jenis_instansi']] = $this->db->get_where('tb_instansi',array('id_jenis_instansi'=>$value['id_jenis_instansi'],'is_aktif'=>1))->num_rows();
    	}
    	$this->data['daftar_instansi'] = $instansi;
    	// print_r($this->data);
    	$this->data['news'] = $this->db->get('tb_news')->num_rows();
    	$this->data['page'] = $this->db->get('tb_general_page')->num_rows();
    	$this->data['video'] = $this->db->get_where('tb_galery',array('type'=>'video'))->num_rows();
    	$jdosen = $this->db->get_where('tb_pengguna',array('is_login'=>1,'id_role_ref'=>1))->result_array();
    	foreach ($jdosen as $key => $value) {
	    	$last = $value['last_login'];
	    	$endtime = date('Y-m-d H:i:s',strtotime('+30 minutes',strtotime($last)));
	    	$times = date('Y-m-d H:i:s', strtotime($endtime));
	    	$now = date('Y-m-d H:i:s');
	    	// print_r($times.' - '.$now);
	    	if ($times < $now) {
	    		$this->db->update('tb_pengguna',array('is_login'=>0,'last_login'=>null),array('id_pengguna'=>$value['id_pengguna']));
	    	}
    	}
    	// print_r($jdosen);
    	$this->data['dosen'] = $this->db->get_where('tb_pengguna',array('is_login'=>1,'id_role_ref'=>1))->num_rows();
    	$jmahasiswa = $this->db->get_where('tb_pengguna',array('is_login'=>1,'id_role_ref'=>0))->result_array();
    	foreach ($jmahasiswa as $key => $value) {
	    	$last = $value['last_login'];
	    	$endtime = strtotime("+30 minutes", strtotime($last));
	    	$now = date('H:i:s');
	    	if ($endtime < $now) {
	    		$this->db->update('tb_pengguna',array('is_login'=>0),array('id_pengguna'=>$value['id_pengguna']));
	    	}
    	}
    	$this->data['mahasiswa'] = $this->db->get_where('tb_pengguna',array('is_login'=>1,'id_role_ref'=>0))->num_rows();
    	$this->data['jdosen'] = $this->db->get_where('tb_pengguna',array('status'=>1,'id_role_ref'=>1))->num_rows();
    	$this->data['jmahasiswa'] = $this->db->get_where('tb_pengguna',array('status'=>1,'id_role_ref'=>0))->num_rows();
    	$this->data['picture'] = $this->db->get_where('tb_galery',array('type'=>'image'))->num_rows();
    	$sql = "SELECT sum(total_download) as total from tb_journal where status = 2";
    	$total_journal = $this->db->query($sql)->row_array();
    	if (is_null($total_journal['total']) || $total_journal['total'] == '') {
    		$total_journal['total'] = 0;
    	}
    	$this->data['total_journal'] = $total_journal['total'];
    	$sql = "SELECT sum(total_download) as total from tb_artikel";
    	$total_artikel = $this->db->query($sql)->row_array();
    	if (is_null($total_artikel['total']) || $total_artikel['total'] == '') {
    		$total_artikel['total'] = 0;
    	}
    	$this->data['total_artikel'] = $total_artikel['total'];
    	$this->ciparser->new_parse('template_admin','modules_admin', 'home/home_layout',$this->data);
    }

    public function logo(){

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
					$data_image['logo'] = $image['asli'];
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
					$data_image['logo'] = $image['asli'];
					$data_image['status'] = 1;
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
		$this->data['breadcumb'] = 'Logo';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/Upload_layout',$this->data);
	}

	public function topologi(){

		$this->data['image'] = $this->db->get_where('tb_logo',array('status'=>2))->row_array();
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
					$data_image['status'] = 2;
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
					$data_image['logo'] = $image['asli'];
					$data_image['status'] = 2;
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
		$this->data['breadcumb'] = 'Topologi';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/Upload_layout',$this->data);
	}

	public function testimoni(){
		$this->data['view'] = 'list';
		// print_r($this->home_model->getTestimoni());
		$this->data['breadcumb'] = 'Testimoni';
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
			$this->form_validation->set_rules('sort','Urutan','trim|integer');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$testimoni['content'] = $this->input->post('content');
				$testimoni['nama_user'] = $this->input->post('name');
				$testimoni['jabatan'] = $this->input->post('jabatan');
				$testimoni['sort'] = $this->input->post('sort');
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
			$ret['notif']['sort'] = form_error('sort');
			if (!isset($_FILES['userfile'])) {
				$ret['notif']['userfile'] = "Please Select File";
			}
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
		$this->data['view'] = 'add';
		$this->data['breadcumb'] = 'Add Testimoni';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/master_testimoni_layout',$this->data);
	}

	public function edit_testimoni(){
		$url = $this->uri->segment_array();
		$id = end($url);
		// print_r($url);
		// return false;
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
			$this->form_validation->set_rules('sort','Urutan','integer');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$testimoni['content'] = $this->input->post('content');
				// $testimoni['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				$testimoni['nama_user'] = $this->input->post('name');
				$testimoni['jabatan'] = $this->input->post('jabatan');
				$testimoni['sort'] = $this->input->post('sort');
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
			$ret['notif']['sort'] = form_error('sort');
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );
		*/$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px';  
		$this->data['view'] = 'edit';
		$this->data['breadcumb'] = 'Edit Testimoni';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/master_testimoni_layout',$this->data);
	}

	public function pentahelix(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['satus'] = 0;
			// print_r($this->input->post());
			$this->form_validation->set_error_delimiters('','');
			// $this->form_validation->set_rules('title','Judul','required');
			$this->form_validation->set_rules('deskripsi','Deskripsi','required');
			$this->form_validation->set_rules('network','Judul Network','required');
			$this->form_validation->set_rules('research','Judul research','required');
			$this->form_validation->set_rules('education','Judul Education','required');
			$this->form_validation->set_rules('content_net','Content Network','required');
			$this->form_validation->set_rules('content_res','Content Research','required');
			$this->form_validation->set_rules('content_edu','Judul Education','required');
			$this->form_validation->set_rules('sort_res','Urutan Research','required');
			$this->form_validation->set_rules('sort_net','Urutan Network','required');
			$this->form_validation->set_rules('sort_edu','Urutan Education','required');
			$this->form_validation->set_rules('icon_edu','Icon Education','required');
			$this->form_validation->set_rules('icon_res','Icon Research','required');
			$this->form_validation->set_rules('icon_net','Icon Network','required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_m['deskripsi'] = $this->input->post('deskripsi');
				$data_m['jenis'] = 1;
				if ($this->db->get_where('tb_pentahelix',array('jenis'=>1))->num_rows() > 0) {
					if ($this->db->update('tb_pentahelix',$data_m,array('jenis'=>1))) {
						$ret['status'] = 1;
					}
				}else{
					if ($this->db->insert('tb_pentahelix',$data_m)) {
						$ret['status'] = 1;
					}
				}

				$data_net['judul'] = $this->input->post('network');
				$data_net['deskripsi'] = $this->input->post('content_net');
				$data_net['icon'] = $this->input->post('icon_net');
				$data_net['jenis'] = 2;
				$data_net['sort'] = $this->input->post('sort_net');
				if ($this->db->get_where('tb_pentahelix',array('jenis'=>2))->num_rows() > 0) {
					if ($this->db->update('tb_pentahelix',$data_net,array('jenis'=>2))) {
						$ret['status'] = 1;
					}
				}else{
					if ($this->db->insert('tb_pentahelix',$data_net)) {
						$ret['status'] = 1;
					}
				}

				$data_ser['judul'] = $this->input->post('research');
				$data_ser['deskripsi'] = $this->input->post('content_res');
				$data_ser['icon'] = $this->input->post('icon_res');
				$data_ser['jenis'] = 3;
				$data_ser['sort'] = $this->input->post('sort_res');
				if ($this->db->get_where('tb_pentahelix',array('jenis'=>3))->num_rows() > 0) {
					if ($this->db->update('tb_pentahelix',$data_ser,array('jenis'=>3))) {
						$ret['status'] = 1;
					}
				}else{
					if ($this->db->insert('tb_pentahelix',$data_ser)) {
						$ret['status'] = 1;
					}
				}

				$data_edu['judul'] = $this->input->post('education');
				$data_edu['deskripsi'] = $this->input->post('content_edu');
				$data_edu['sort'] = $this->input->post('sort_edu');
				$data_edu['icon'] = $this->input->post('icon_edu');
				$data_edu['jenis'] = 4;
				if ($this->db->get_where('tb_pentahelix',array('jenis'=>4))->num_rows() > 0) {
					if ($this->db->update('tb_pentahelix',$data_edu,array('jenis'=>4))) {
						$ret['status'] = 1;
					}
				}else{
					if ($this->db->insert('tb_pentahelix',$data_edu)) {
						$ret['status'] = 1;
					}
				}
			}
			// $ret['notif']['title'] = form_error('title');
			$ret['notif']['deskripsi'] = form_error('deskripsi');
			$ret['notif']['research'] = form_error('research');
			$ret['notif']['content_res'] = form_error('content_res');
			$ret['notif']['network'] = form_error('network');
			$ret['notif']['content_net'] = form_error('content_net');
			$ret['notif']['education'] = form_error('education');
			$ret['notif']['content_edu'] = form_error('content_edu');
			$ret['notif']['sort_edu'] = form_error('sort_edu');
			$ret['notif']['sort_net'] = form_error('sort_net');
			$ret['notif']['sort_res'] = form_error('sort_res');
			$ret['notif']['icon_res'] = form_error('icon_res');
			$ret['notif']['icon_net'] = form_error('icon_net');
			$ret['notif']['icon_edu'] = form_error('icon_edu');
			echo json_encode($ret);
			exit();
		}
		$this->load->library('ckeditor');
		$this->ckeditor->basePath = base_url().'assets/ckeditor/';
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link','-','Styles' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px'; 
		// $this->data['breadcumb'] = 'Hero';
		// $this->ciparser->new_parse('template_admin','modules_admin', 'home/hero_layout',$this->data);
		$this->data['breadcumb'] = 'Setting Pentahelix Testimoni';
		$this->data['penta'] = $this->db->get_where('tb_pentahelix',array('jenis'=>1))->row_array();
		$this->data['penta_net'] = $this->db->get_where('tb_pentahelix',array('jenis'=>2))->row_array();
		$this->data['penta_res'] = $this->db->get_where('tb_pentahelix',array('jenis'=>3))->row_array();
		$this->data['penta_edu'] = $this->db->get_where('tb_pentahelix',array('jenis'=>4))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/pentahelix_layout',$this->data);
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

            // if ($upload_data['image_width'] > 768 ) {
                $data = array('upload_data' => $this->upload->data());
                $config_r['image_library'] = 'GD2';
                $config_r['source_image'] = FCPATH."media/".$upload_data['file_name'];
                // $config_r['create_thumb'] = TRUE;
                $config_r['quality'] = 60;
                $config_r['maintain_ratio'] = TRUE;
                $config_r['width']         = 150;
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
            // }
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
		$this->session->set_flashdata("notif","Data Berhasil di Ubah");
		redirect(site_url('admin/home/testimoni'));
    }

    public function hero(){
    	$this->data['hero'] = $this->db->get('tb_hero')->row_array();
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
    		// print_r($this->input->post('judul'));
    		// return false;
    		$ret['state'] = 0;
    		$ret['status'] = 0;
    		$this->form_validation->set_error_delimiters('','');
    		$this->form_validation->set_rules('link','Video','trim|required');
    		$this->form_validation->set_rules('judul','Judul Hero','trim|required');
    		$this->form_validation->set_rules('content','Description','trim|required');
    		if ($this->form_validation->run() == true) {
    			$ret['state'] = 1;
    			$dt_hero['link_video'] = $this->input->post('link');
    			$j1 = str_replace("<p>", "", $this->input->post('judul'));
    			$j2 = str_replace("</p>", "", $j1);
    			$dt_hero['title'] = $j2;
    			$dt_hero['content'] = $this->input->post('content');
    			if ($this->db->get('tb_hero')->num_rows() > 0) {
    				if ($this->db->update('tb_hero',$dt_hero,array('id_hero'=>$this->data['hero']['id_hero']))) {
    					$ret['status'] = 1;
    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
    				}
    			}else{
    				if ($this->db->insert('tb_hero',$dt_hero)) {
    					$ret['status'] = 1;
    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link','-','Styles' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px'; 
		$this->data['breadcumb'] = 'Hero';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/hero_layout',$this->data);
    }

    public function layanan_idroam(){
    	$this->data['layanan'] = $this->db->get_where('tb_layanan',array('kategori'=>1))->row_array();
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
    			$dt_hero['kategori'] = 1;
    			if (isset($_FILES['userfile'])) {
    				$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$dt_hero['gambar'] = $image['asli'];
		    			if ($this->db->get_where('tb_layanan',array('kategori'=>1))->num_rows() > 0) {
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
		    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		    					$ret['status'] = 1;
		    				}
		    			}
					}
    			}else{
    				if ($this->db->get('tb_layanan')->num_rows() > 0) {
	    				if ($this->db->update('tb_layanan',$dt_hero,array('id_layanan'=>$this->data['layanan']['id_layanan']))) {
	    					$ret['status'] = 1;
	    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
	    				}
	    			}else{
	    				if ($this->db->insert('tb_layanan',$dt_hero)) {
	    					$ret['status'] = 1;
	    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px'; 
		$this->data['breadcumb'] = 'Layanan ID-ROAM';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/layanan_layout',$this->data);
    }

    public function layanan_cloud(){
    	$this->data['layanan'] = $this->db->get_where('tb_layanan',array('kategori'=>2))->row_array();
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
    			$dt_hero['kategori'] = 2;
    			if (isset($_FILES['userfile'])) {
    				$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$dt_hero['gambar'] = $image['asli'];
		    			if ($this->db->get_where('tb_layanan',array('kategori'=>2))->num_rows() > 0) {
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
		    					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px'; 
		$this->data['breadcumb'] = 'Layanan Cloud';
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

    public function re_upload(){
    	$data = $this->db->get('tb_testimoni')->result_array();
    	foreach ($data as $key => $value) {
    		if ($value['gambar'] != '') {
	    		$config_r['image_library'] = 'GD2';
		        $config_r['source_image'] = FCPATH."media/".$value['gambar'];
		        $config_r['quality'] = 60;
		        // $config_r['maintain_ratio'] = TRUE;
		       	$config_r['width'] = 250;
		        $config_r['new_image'] = FCPATH."media/thumbnail/".$value['gambar'];

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

    public function kolaborasi()
    {
    	if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul','Judul Page','trim|required');
			$this->form_validation->set_rules('content','Content','trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$layanan['content'] = $this->input->post('content');
				$layanan['title'] = $this->input->post('judul');
				$layanan['gambar'] = "dumy";
				$layanan['kategori'] = 3;
				if ($this->db->get_where('tb_layanan',array('kategori'=>3))->num_rows() == 0) {
					if($this->db->insert('tb_layanan',$layanan)){
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}else{
					if($this->db->update('tb_layanan',$layanan,array('kategori'=>3))){
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['title'] = form_error('judul');
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
		$this->data['kolaborasi'] = $this->db->get_where('tb_layanan',array('kategori'=>3))->row_array();
		$this->data['breadcumb'] = 'Kolaborasi';
		$this->ciparser->new_parse('template_admin','modules_admin', 'home/kolaborasi_layout',$this->data);
    }
   

   

}
