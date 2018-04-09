<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class News extends MX_Controller  {
	var $data = array();
	function __construct(){
	}
	public function index(){
		// $rss = file_get_contents('https://rss.kontan.co.id/news/analisis');
		// echo $rss;
		// return false;
		$this->data['view'] = 'list';
		$sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news";
		$this->data['news'] = $this->db->query($sql)->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_layout',$this->data);
	}

	public function add(){
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul', 'Judul Berita', 'trim|required');
			$this->form_validation->set_rules('content', 'Content Berita', 'trim|required');
			$this->form_validation->set_rules('kategori', 'Kategori Berita', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_news['judul'] = $this->input->post('judul');
				$data_news['content'] = $this->input->post('content');
				$data_news['id_kategori_ref'] = $this->input->post('kategori');
				$data_news['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				if ($this->db->insert('tb_news',$data_news)) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/news');
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['kategori'] = form_error('kategori');
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
		$this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
		$this->data['news'] = $this->db->get('tb_news')->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == "POST") {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('judul', 'Judul Berita', 'trim|required');
			$this->form_validation->set_rules('content', 'Content Berita', 'trim|required');
			$this->form_validation->set_rules('kategori', 'Kategori Berita', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_news['judul'] = $this->input->post('judul');
				$data_news['content'] = $this->input->post('content');
				$data_news['id_kategori_ref'] = $this->input->post('kategori');
				$data_news['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				if ($this->db->update('tb_news',$data_news,array('id_news'=>$id))) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/news');
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['kategori'] = form_error('kategori');
			echo json_encode($ret);
			exit();
		}
		$this->data['view'] = 'edit';
		$this->data['news'] = $this->db->get_where('tb_news',array('id_news'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_layout',$this->data);
	}

	public function get_rss(){
		$ret['state'] = 0;
		$ret['status'] = 0;
		$this->load->helper('magpie');
		$rss = fetch_rss(site_url('admin/news/get_data_rss'));
		if($rss)
		{
			$ret['state'] = 1;
			// print_r($rss->items);
			foreach ($rss->items as $key => $value) {
				$data_news['judul'] =  $value['title'];
				$data_news['img'] =  $this->get_img($value['description']);
				$data_news['id_kategori_ref'] =  3;
				$data_news['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				$data_news['kategori_rss'] = $value['category'];
				$data_news['link'] = $value['link'];
				$data_news['content'] = $this->get_detail($data_news['link']);
				if ($this->db->get_where('tb_news',array('link'=>$value['link']))->num_rows() == 0) {
					$this->db->insert('tb_news',$data_news);
						
				}
			}
			
				$ret['url'] = site_url('admin/news');
		}
		redirect(site_url('admin/news'));
	}
	public function get_data_rss(){
		$rss = file_get_contents('https://rss.kontan.co.id/news/analisis');
		echo $rss;
	}

	public function get_detail($data){
		$rss = file_get_contents($data);
		$data = explode("<body>", $rss);
		$detail = explode('articleBody">', $data[1]);
		$detail1 = explode('<script', $detail[1]);
		return $detail1[0];
	}

	function get_img($data){
		$a = explode('src="', $data);
		$b = explode('" >', $a[1]);
		return $b[0];
	}
	
}