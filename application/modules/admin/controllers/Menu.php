<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Menu extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->module('home_model');
	}

	public function index(){
		$sql = 'SELECT * FROM tb_menu ORDER BY parent ASC';
		$this->data['menu'] = $this->db->query($sql)->result_array();
		$this->data['breadcumb'] = 'Menu Setting';
		$this->data['view'] = 'list';
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_menu_layout',$this->data);
	}

	public function add(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('label','Label Menu','required');
			$this->form_validation->set_rules('menu','Parent Menu','required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$menu['label'] = $this->input->post('label');
				$menu['link'] = 'page/'.$this->input->post('slug');
				$menu['parent'] = $this->input->post('menu');
				if ($this->input->post('order') != '') {
					$menu['sort'] = $this->input->post('order');
				}else{

					$menu['sort'] = null;
				}
				$menu['type'] = 2;
				if ($this->db->insert('tb_menu',$menu)) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/menu');
				}
			}
			$ret['notif']['label'] = form_error('label');
			$ret['notif']['menu'] = form_error('menu');
			echo json_encode($ret);
			exit();
		}
		$this->data['menu'] = $this->db->get('tb_menu')->result_array();
		$this->data['breadcumb'] = 'Menu Setting';
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_menu_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('label','Label Menu','required');
			$this->form_validation->set_rules('menu','Parent Menu','required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$menu['label'] = $this->input->post('label');
				// $menu['link'] = base_url().'page/'.$this->input->post('slug');
				$menu['parent'] = $this->input->post('menu');
				$menu['sort'] = $this->input->post('order');
				if ($this->db->update('tb_menu',$menu,array('id'=>$id))) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/menu');
				}
			}
			$ret['notif']['label'] = form_error('label');
			$ret['notif']['menu'] = form_error('menu');
			echo json_encode($ret);
			exit();
		}
		$this->data['menu'] = $this->db->get('tb_menu')->result_array();
		$this->data['current'] = $this->db->get_where('tb_menu',array('id'=>$id))->row_array();
		$this->data['breadcumb'] = 'Menu Setting';
		$this->data['view'] = 'edit';
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_menu_layout',$this->data);
	}

	public function delete(){
		$id = $this->input->post('id');
		$link = $this->db->get_where('tb_menu',array('parent'=>$id))->row_array()['link'];
		if ($this->db->get_where('tb_menu',array('parent'=>$id))->num_rows() > 0) {
			$ret['status'] = 0;
			$ret['notif'] = 'This menu has submenus, please first delete submenus from this menu';
		}else{
			if($this->db->get_where('tb_menu',array('id'=>$id))->row_array()['type'] == 1){
				$ret['status'] = 0;
				$ret['notif'] = 'cant deleted static menu';
			}else{
				if ($this->db->delete('tb_menu',array('id'=>$id))) {
					$this->db->update('tb_general_page',array('link'=>null),array('link'=>$link));
					$ret['status'] = 1;
					$ret['notif'] = 'menu successfully deleted';
				}else{
					$ret['status'] = 0;
					$ret['notif'] = 'menu unsuccessfully deleted';
				}
			}
		}
		echo json_encode($ret);
	}

    public function menu(){
        $sql = "SELECT id, label, link, parent FROM tb_menu ORDER BY parent, sort, label";
        $item = $this->db->query($sql)->result_array();
        $menus = array('items'=>array(),'parents'=>array());
        $this->data['menu'] = '';
        foreach ($item as $key => $value) {
            $menus['items'][$value['id']] = $value;
            $menus['parents'][$value['parent']][]= $value['id'];
        }
        $this->data['menu'] = $this->createTreeView(0,$menus);
        $this->data['breadcumb'] = 'adnu';      
        $this->data['style'] = '$style';
        $this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    }

    function createTreeView($parent, $menu){
       $html = "";
       if (isset($menu['parents'][$parent])) {
          $html .= '';
           foreach ($menu['parents'][$parent] as $itemId) {
              if(!isset($menu['parents'][$itemId])) {
                 $html .= "<li><a href='".$menu['items'][$itemId]['link']."'>"
    .$menu['items'][$itemId]['label']."</a></li>";
              }
              if(isset($menu['parents'][$itemId])) {
                 $html .= "<li class='dropdown'>
                 <a data-toggle='dropdown' aria-expanded='false' href='#' class='dropdown-toggle' href='".$menu['items'][$itemId]['link']."'>".$menu['items'][$itemId]['label']."<span class='fa fa-angle-down'></span></a>";
                 $html .= "<ul class='dropdown-menu'>";
                 $html .= "<li>".$this->createTreeView($itemId, $menu)."</li>";
                 $html .= "</ul>";
              }
           }
           $html .= "";
       }
       return $html;
    }

	public function page(){
		
		$this->data['menu'] = $this->db->get('tb_general_page')->result_array();
		$this->data['breadcumb'] = 'General Page';
		$this->data['view'] = 'list';
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_page_layout',$this->data);
	}

	public function add_page(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('label','Label Menu','required');
			$this->form_validation->set_rules('content','Content Page','required');
			$this->form_validation->set_rules('page','Jenis Page','required');
			$this->form_validation->set_rules('menu','Menu Page','required');
			if ($this->form_validation->run() == true ) {
				$ret['state'] = 1;
				$page['title'] = $this->input->post('label');
				if ($this->input->post('menu') != '') {
					$url = explode("/", $this->input->post('menu'));
					$page['link'] = end($url);
				}else{
					$page['link'] = $this->input->post('slug');
				}
				$page['content'] = $this->input->post('content');
				$page['page'] = $this->input->post('page');
				if (isset($_FILES['userfile'])) {
					$data_gambar = $this->upload_logo($_FILES);
					if (isset($data_gambar['error'])) {
						$ret['notif'] = $data_gambar;
					}else{	
						$page['img'] = $data_gambar['asli'];
						if ($this->db->insert('tb_general_page',$page)) {
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							$ret['url'] = site_url('admin/menu/page');
						}
					}
				}else{
					$page['img'] = 'dummy';
					if ($this->db->insert('tb_general_page',$page)) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/menu/page');
					}
				}
				
			}
			$ret['notif']['label'] = form_error('label');
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['page'] = form_error('page');
			$ret['notif']['menu'] = form_error('menu');
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
		$this->data['menu'] = $this->db->get('tb_menu')->result_array();
		$this->data['breadcumb'] = 'Menu Setting';
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_page_layout',$this->data);
	}

	public function edit_page(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('label','Label Menu','required');
			$this->form_validation->set_rules('content','Content Page','required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$page['title'] = $this->input->post('label');
				if ($this->input->post('menu') != '') {
					$url = explode("/", $this->input->post('menu'));
					$page['link'] = end($url);
				}else{
					$page['link'] = $this->input->post('slug');
				}
				$page['content'] = $this->input->post('content');
				// $page['page'] = 1;
				if (isset($_FILES['userfile'])) {
					$data_gambar = $this->upload_logo($_FILES);
					if (isset($data_gambar['error'])) {
						$ret['notif'] = $data_gambar;
					}else{	
						$page['img'] = $data_gambar['asli'];
						if ($this->db->update('tb_general_page',$page,array('id_general_page'=>$id))) {
							$ret['status'] = 1;
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
							$ret['url'] = site_url('admin/menu/page');
						}
					}
				}else{
					if ($this->db->update('tb_general_page',$page,array('id_general_page'=>$id))) {
						$ret['status'] = 1;
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						$ret['url'] = site_url('admin/menu/page');
					}
				}
				
			}
			$ret['notif']['label'] = form_error('label');
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
		$this->data['menu'] = $this->db->get('tb_menu')->result_array();
		$this->data['breadcumb'] = 'Menu Setting';
		$this->data['view'] = 'edit';
		$this->data['current'] = $this->db->get_where('tb_general_page',array('id_general_page'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/master_page_layout',$this->data);
	}

	public function delete_page(){
		$id = $this->input->post('id');
		if ($this->db->delete('tb_general_page',array('id_general_page'=>$id))) {
			$ret['status'] = 1;
			$ret['notif'] = 'menu successfully deleted';
		}else{
			$ret['status'] = 0;
			$ret['notif'] = 'menu unsuccessfully deleted';
		}
		echo json_encode($ret);
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