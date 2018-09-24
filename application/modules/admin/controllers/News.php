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
		$this->load->model('news_model');
	}
	public function index(){
		// $rss = file_get_contents('https://rss.kontan.co.id/news/analisis');
		// echo $rss;
		// return false;
		$this->data['view'] = 'list';
		$sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news where id_instansi_ref IS NULL";
		$this->data['news'] = $this->db->query($sql)->result_array();
		$this->data['breadcumb'] = 'List News';
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
			$this->form_validation->set_rules('status', 'Status Berita', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_news['judul'] = $this->input->post('judul');
				$data_news['content'] = $this->input->post('content');
				$data_news['is_aktif'] = $this->input->post('status');
				$data_news['id_kategori_ref'] = $this->input->post('kategori');
				$data_news['id_user_ref'] = $this->session->userdata('data_user')['id_user'];
				$data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
				if (isset($_FILES['file_name'])) {
					$image = $this->upload_logo($_FILES);
					if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$ret['state'] = 1;
						$data_news['img'] = $image['asli'];
						if ($this->db->insert('tb_news',$data_news)) {
							$ret['status'] = 1;
							$ret['url'] = site_url('admin/news');
							$this->session->set_flashdata("notif","Data Berhasil di Masukan");
						}
					}
				}else{
					$ret['state'] = 1;
					// $data_news['img'] = $image['asli'];
					if ($this->db->insert('tb_news',$data_news)) {
						$ret['status'] = 1;
						$ret['url'] = site_url('admin/news');
						$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					}
				}
			}
			$ret['notif']['judul'] = form_error('judul');
			$ret['notif']['content'] = form_error('content');
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['status'] = form_error('status');
			// if (!isset($_FILES['file_name'])) {
			// 	$ret['notif']['file_name'] = "Please Select File";
			// }
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
		$this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
		$this->data['news'] = $this->db->get('tb_news')->result_array();
		$this->data['breadcumb'] = 'Add News';
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		$this->data['news'] = $this->db->get_where('tb_news',array('id_news'=>$id))->row_array();
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
				$data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
				if (isset($_FILES['file_name'])) {
					$image = $this->upload_logo($_FILES);
	    			if (isset($image['error'])) {
						$ret['notif'] = $image;
					}else{
						$data_news['img'] = $image['asli'];
    					if (file_exists(FCPATH."assets/media/".$this->data['news']['img'])) {
	            			@chmod(FCPATH."assets/media/".$this->data['news']['img'], 0777);
	            			unlink(FCPATH."assets/media/".$this->data['news']['img']);
	            		}
	            		if (file_exists(FCPATH."assets/media/thumbnail/".$this->data['news']['img'])) {
	            			@chmod(FCPATH."assets/media/thumbnail/".$this->data['news']['img'], 0777);
	            			unlink(FCPATH."assets/media/thumbnail/".$this->data['news']['img']);
	            		}
	            		if (file_exists(FCPATH."assets/media/crop/".$this->data['news']['img'])) {
	            			@chmod(FCPATH."assets/media/crop/".$this->data['news']['img'], 0777);
	            			unlink(FCPATH."assets/media/crop/".$this->data['news']['img']);
	            		}
					}
				}
				if ($this->db->update('tb_news',$data_news,array('id_news'=>$id))) {
					$ret['status'] = 1;
					$ret['url'] = site_url('admin/news');
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
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
		/*$this->ckeditor->config['toolbar'] = array(
		                array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
		                                                    );*/
		$this->ckeditor->config['language'] = 'eng';
		$this->ckeditor->config['width'] = '1024px';
		$this->ckeditor->config['height'] = '300px'; 
		$this->data['view'] = 'edit';
		$this->data['breadcumb'] = 'Edit News';
		$this->data['kategori'] = $this->db->get('tb_kategori_news')->result_array();
		
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_layout',$this->data);
	}

	public function status(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			if ($this->db->get_where('tb_news',array('id_news'=>$id))->row_array()['is_aktif'] == 1) {
				$this->db->update('tb_news',array('is_aktif'=>0),array('id_news'=>$id));
				$this->session->set_flashdata("notif","Berita Berhasil di Non Aktifkan");
			}else{
				$this->db->update('tb_news',array('is_aktif'=>1),array('id_news'=>$id));
				$this->session->set_flashdata("notif","Berita Berhasil di Aktifkan");
			}
			echo json_encode("finish");
			exit();
		}
	}

	public function instansi(){
		// $rss = file_get_contents('https://rss.kontan.co.id/news/analisis');
		// echo $rss;
		// return false;
		$this->data['view'] = 'list';
		// $sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news where id_instansi_ref != NULL";
		// $this->data['news'] = $this->db->query($sql)->result_array();
		$this->data['breadcumb'] = 'List News';
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/news_instansi_layout',$this->data);
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
				$data_news['link'] = url_title($value['title'], 'dash', true);
				$data_news['content'] = $this->get_detail($value['link'])."<br> Sumber : ".$value['link'];;
				if ($this->db->get_where('tb_news',array('link'=>$value['link']))->num_rows() == 0) {
					$this->db->insert('tb_news',$data_news);
						
				}
			}
			
				$ret['url'] = site_url('admin/news');
				$this->session->set_flashdata("notif","Data Berhasil di Masukan");
		}
		redirect(site_url('admin/news'));
	}

	public function slugify($text)
	{
	  // replace non letter or digits by -
	  $text = preg_replace('~[^\pL\d]+~u', '-', $text);

	  // transliterate
	  $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

	  // remove unwanted characters
	  $text = preg_replace('~[^-\w]+~', '', $text);

	  // trim
	  $text = trim($text, '-');

	  // remove duplicate -
	  $text = preg_replace('~-+~', '-', $text);

	  // lowercase
	  $text = strtolower($text);

	  if (empty($text)) {
	    return 'n-a';
	  }

	  return $text;
	}

	public function view()
	{
		$url = $this->uri->segment_array();
		$slug = end($url);
	    $query = $this->db->get_where('tb_news', array('link' => $slug), 1)->row_array();

	    print_r($query);
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
		$tag = explode("<!--", $detail1[0]);
		return $tag[0];
	}

	public function get_detail_coba(){
		$rss = file_get_contents('http://analisis.kontan.co.id/news/angkutan-daring');
		$data = explode("<body>", $rss);
		$detail = explode('articleBody">', $data[1]);
		$detail1 = explode('<script', $detail[1]);
		$tag = explode("<!--", $detail1[0]);
		echo $tag[0];
	}

	function get_img($data){
		$a = explode('src="', $data);
		$b = explode('" >', $a[1]);
		return $b[0];
	}

	public function upload_logo($logo){	    		
    	
        $imagename = $logo['file_name']['name'];
        $ext = strtolower($this->_getExtension($imagename));
        $config['upload_path']          = FCPATH."assets/media/";
        $config['allowed_types']        = 'gif|jpg|png';
        $config['max_size']             = 2048;
        $config['max_width']            = 1024;
        $config['min_width']            = 200;
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

    public function ajax_list()
    {
        $list = $this->news_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->is_aktif == 1) {
            	$aktif = '<span class="text-success">Enable</span>';
            	$button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Disabled</span> </button>
							<a href="'.site_url("admin/news/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
            	$aktif = '<span class="text-Success">Disable</span>';
            	$button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Enable</span> </button>
							<a href="'.site_url("admin/news/edit").'/'.$news->id_news.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$news->id_news.'">'.$news->judul.'</div>';
            $row[] = word_limiter($news->content, 5);
            $row[] = $news->nm_kategori;
            $row[] = $news->created;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->news_model->count_all(),
                        "recordsFiltered" => $this->news_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_instansi()
    {
    	$this->load->model('news_instansi_model');
        $list = $this->news_instansi_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->is_aktif == 1) {
            	$aktif = '<span class="text-success">Enable</span>';
            	$button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Disabled</span> </button>
							';
            }else{
            	$aktif = '<span class="text-Success">Disable</span>';
            	$button = '<button class="btn btn-default btn-sm btn_status" id="'.$news->id_news.'"> <span class="text-danger">Enable</span> </button>
							';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$news->id_news.'">'.$news->judul.'</div>';
            $row[] = word_limiter($news->content, 5);
            $row[] = $news->nm_kategori;
            $row[] = $news->created;
            $row[] = $news->nm_instansi;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->news_instansi_model->count_all(),
                        "recordsFiltered" => $this->news_instansi_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function comment_ajax(){
    	$id = $this->input->post('id');
    	$comment = $this->news_model->news_comment($id);
    	$data = '<table class="table table-bordered  dataTable" id="example2">
			<thead>
				<th>No</th>
				<th>News</th>
				<th>From</th>
				<th>Email</th>
				<th>Subject</th>
			</thead>
			<tbody>';
			if(!empty($comment)){ foreach ($comment as $key => $value):
				$data .= '<tr>
					<td>'.($key+1).'</td>
					<td><div class="judul">'.$value['judul'].'</div></td>
					<td><div class="from">'.$value['nama'].'</div></td>
					<td><div class="email">'.$value['email'].'</div></td>
					<td><div class="subject">'.word_limiter($value['content'],5).'</div></td>
				</tr>';
			endforeach; }
			$data .= '</tbody>
		</table>';
		echo json_encode($data);
    }

	
}