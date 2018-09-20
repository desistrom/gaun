<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class News extends CI_Controller  {


    function __construct() {
        parent::__construct();
         $this->load->helper('api');
         $this->load->library('pagination');
         $this->load->library('Recaptcha');
    }

    function index() {
        /*$config['base_url'] = base_url().'web/news/index';
        $url = base_url().'api/v1/news';*/
        $methode = 'GET';
        // $b = api_helper('',$url,$methode,'');
        // $config['total_rows'] = count($b);
        // $config['per_page'] = 4;
        // $config['prev_tag_open'] = '<li>';
        // $config['prev_tag_close'] = '</li>';
        // $config['prev_link'] = 'Prev';
        // $config['next_tag_open'] = '<li>';
        // $config['next_tag_close'] = '</li>';
        // $config['next_link'] = 'Next';
        // $this->pagination->initialize($config);

        
        // $url = $this->uri->segment_array();
        // $data = end($url);
        // if (!is_numeric($data)) {
        //     $data = 0;
        // }
        // $url = base_url().'api/v1/pagging_news?data='.$data;
        // $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $url = URL_GET_ALL_NEWS;
        // $b = api_helper('',$url,$methode,'');
        $sql = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
            FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
            join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC";
        $news = $this->db->query($sql)->result_array();
        // foreach ($news as $key => $value) {
        //     if ($value['kategori'] != 'rss' && $value['gambar'] != '') {
        //         $news[$key]['gambar'] = 'assets/media/'.$news[$key]['gambar'];
        //     }
        //     if ($value['gambar'] == '') {
        //         $news[$key]['gambar']='assets/images/logo/IDREN-2.png';
        //     }
        // }
        /*$this->data['recent']=$b['data'];
        $this->data['total'] = count($b['data']);*/
        $this->data['recent']=$news;
        $this->data['total'] = count($news);
        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 4);
            $this->data['total_row'] = $start;
            $url = URL_GET_NEWS_PAGGING.$start;
            // $a = api_helper('',$url,$methode,'');
            $sql_paging = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
                FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
                join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC  LIMIT ".$start.",4 ";
            // $this->data['news']=$a['data'];
            $pagging_news = $this->db->query($sql_paging)->result_array();
            // foreach ($pagging_news as $key => $value) {
            //     if ($value['kategori'] != 'rss' && $value['gambar'] != '') {
            //         $pagging_news[$key]['gambar'] = 'assets/media/'.$pagging_news[$key]['gambar'];
            //     }
            //     if ($value['gambar'] == '') {
            //         $pagging_news[$key]['gambar']='assets/images/logo/IDREN-2.png';
            //     }

            // }
            $this->data['news']=$pagging_news;
            $result = $this->load->view('news_looping',$this->data);
            echo json_encode($result);
        }else{
            $this->data['total_row'] = 0;
            $url = URL_GET_NEWS_PAGGING.'0';
            // $a = api_helper('',$url,$methode,'');
            $sql_paging = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
                FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
                join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC  LIMIT 0,4 ";
            // $this->data['news']=$a['data'];
            $pagging_news = $this->db->query($sql_paging)->result_array();
            
            $this->data['news']=$pagging_news;
            // $this->data['news']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
        }

        // $this->data['news']=$a['data'];
        // $this->data['recent']=$b['data'];
    	// $this->ciparser->new_parse('template_frontend','modules_web', 'news_layout',$this->data);
    }
        function get_news() {
        $url = $this->uri->segment_array();
        $id = end($url);
        // $id=$_GET['data'];

        $url = URL_GET_NEWS_BY_SLUG.$id;
        $methode = 'GET';
        $token = '';
        // $data['data']=$id;
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT n.id_news as newsId, n.created as tanggal, n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar 
            FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
            join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 AND n.link = '".$id."'";
        $a = $this->db->query($sql)->row_array();
        // print_r($a);
        if ($a!= '') {
        $methode = 'GET';
        $url_allnews =  URL_GET_ALL_NEWS;
        // $b = api_helper($token,$url_allnews,$methode,$token);
        $sql = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
            FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
            join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC";
        $b = $this->db->query($sql)->result_array();
        $gambar = '';
        $c = explode('/', $a['gambar']); if(isset($c[1])){ $gambar = $a['gambar']; }else{ $gambar = base_url().'assets/media/'.$a['gambar']; }
        $this->data['detail_news']=$a;
        $share_link['title'] = $a['title'];
        $this->load->helper('text');
        $share_link['description'] = word_limiter($a['news_content'], 20);
        $share_link['image'] = $gambar;
        $share_link['type'] = $a['kategori'];
        $share_link['url'] = site_url('web/news/get_news/'.$a['sumber']);
        $this->data['share'] = $share_link;
        // print_r($a);
        $this->data['news']=$b;
      
       $this->data['action'] = site_url('web/news/get_news');
       $this->data['captcha'] = $this->recaptcha->getWidget();
       $this->data['script_captcha'] = $this->recaptcha->getScriptTag();
       // $url_page = $this->uri->segment_array();
       // $slug = end($url_page);
       // $idnews = $this->db->get_where('tb_news',$url_page)->row_array()['id_news'];
       $this->data['comment'] = $this->db->get_where('tb_comment',array('id_berita'=>$id))->result_array();;
       // print_r($this->data['comment']);
   
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout',$this->data);
        }else{
            $this->output->set_status_header('404'); 
            $this->ciparser->new_parse('template_frontend','modules_web', 'notfound_layout');
            // exit();
        }
    }

    public function comment(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            // print_r($this->input->post());
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('nama','Nama','required');
            $this->form_validation->set_rules('email','Email','required');
            $this->form_validation->set_rules('content','Comment','required');
            $this->form_validation->set_rules('g-recaptcha-response','Pleas Insert Captcha', 'required');
            $recaptcha = $this->input->post('g-recaptcha-response');
            $response = $this->recaptcha->verifyResponse($recaptcha);
            if ($this->form_validation->run() == true && $response['success'] == 1) {
                $ret['state'] = 1;
                $data_nama['nama'] = $this->input->post('nama');
                $data_nama['email'] = $this->input->post('email');
                $data_nama['content'] = $this->input->post('content');
                $data_nama['id_berita'] = $this->input->post('id_berita');
                if ($this->db->insert('tb_comment',$data_nama)) {
                    $ret['status'] = 1;
                    // $ret['url'] = site_url('')
                }
            }
            $ret['notif']['nama'] = form_error('nama');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['g-recaptcha-response'] = form_error('g-recaptcha-response');

            echo json_encode($ret);
            exit();
        }
    }
    


    //   function get_news() {

    //   $this->ciparser->new_parse('template_frontend','modules_web', 'detail_news_layout');
    // }

    function hit_api($url) {



    }
 
 

}
