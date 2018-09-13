<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Galery extends CI_Controller  {
	  	var $data=array();

    function __construct() {
        parent::__construct();
        $this->load->helper('api');
        $this->load->library('pagination');
    }

    function index() {
        $url = URL_GET_ALL_ALBUM;
    	$data = '';
        $methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT a.id_album as albumId, a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image FROM tb_album_galery a join tb_galery g on a.id_album = g.id_album where g.status = 1 group by a.id_album";
        $a = $this->db->query($sql)->result_array();
        // $id=$a['data'][0]['albumId'];
        if ($galery == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            foreach ($a as $key => $value) {
                $a[$key]['date_album'] = date("d M Y", strtotime($value['date_album']));
                if ($value['image'] == '') {
                    $a[$key]['image']='assets/images/logo/IDREN-2.png';
                }else{
                    if (file_exists(FCPATH."assets/media/thumbnail/".$value['file'])) {
                        $a[$key]['image'] = 'assets/media/thumbnail/'.$value['file'];
                    }else{
                        $a[$key]['image_big'] = 'assets/media/'.$value['file'];
                        $a[$key]['image'] = 'assets/media/thumbnail/'.$value['file'];
                    }
                }

            }
        }
        $id=$a[0]['albumId'];
        $sql_a = "SELECT a.id_album as albumId, a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image FROM tb_album_galery a join tb_galery g on a.id_album = g.id_album where g.status = 1 AND a.id_album = ".$id;
        $galery = $this->db->query($sql_a)->result_array();
        foreach ($galery as $key => $value) {
            $galery[$key]['date_album'] = date("d M Y", strtotime($value['date_album']));
            if ($value['image'] == '') {
                $galery[$key]['image']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."assets/media/thumbnail/".$value['image'])) {
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }else{
                    $galery[$key]['image_big'] = 'assets/media/'.$value['image'];
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }
            }

        }
        $url_album_id =  URL_GET_ALBUM_BY_ID.$id ;
        // $b = api_helper('',$url_album_id,$methode,$token);



        $this->data['foto']=$a;
    	$this->data['album_id']=$b;
    	$this->ciparser->new_parse('template_frontend','modules_web', 'foto_layout',$this->data);
    }

    function detail_album() {
        $id = $_GET['data'];
        $url =  URL_GET_ALBUM_BY_ID.$id ;
        $data = '';
        $methode = 'GET';
        $token = '';
        // $app_data = api_helper(json_encode($id),$url,$methode,$token);
        $sql_a = "SELECT a.id_album as albumId, a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image, judul, deskripsi FROM tb_album_galery a join tb_galery g on a.id_album = g.id_album where g.status = 1 AND a.id_album = ".$id;
        $galery = $this->db->query($sql_a)->result_array();
        foreach ($galery as $key => $value) {
            $galery[$key]['date_album'] = date("d M Y", strtotime($value['date_album']));
            if ($value['image'] == '') {
                $galery[$key]['image']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."assets/media/thumbnail/".$value['image'])) {
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }else{
                    $galery[$key]['image_big'] = 'assets/media/'.$value['image'];
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }
            }

        }
        $html['judul'] = $galery[0]['title'];
        $html['tanggal'] = $galery[0]['date_album'];
        $html['slideshow']='';
        $html['thumbnail_album']='';
        foreach ($galery as $key => $value) :
            $html['slideshow'].='<div class="item ';
            if($key==0){ $html['slideshow'] .= 'active';} 
            $html['slideshow'] .= '"><img width="100%" src="'.base_url().$value['image'] .'" ><h2 class="title-slider">'.$value['judul'].'</h2><p class="description-slider">'.$value['deskripsi'].'</p></div>';
        endforeach;

        $hmtl['thumbnail_album']='';
        foreach ($galery as $key => $value) :
            $html['thumbnail_album'].='<li class="thumbnail-indicator" data-target="#myCarousel-pop" data-slide-to="'.$key.'" class="' ;
             if($key==0){ $html['thumbnail_album'] .= 'active';} 
            $html['thumbnail_album'].='"><img class="img-responsive" src="'.base_url().$value['image'] .'">
                </li>';
        endforeach;

        echo json_encode($html);

        
    }
    function video() {
        $url = URL_GET_ALL_VIDEO ;
    	$data = '';
    	$methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $type = 'video';
        $sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1";
        $a = $this->db->query($sql,$type)->result_array();
    	$this->data['video']=$a;	
    	$this->ciparser->new_parse('template_frontend','modules_web', 'video_layout',$this->data);
    }
     function list_video() {
        // $config['base_url'] = base_url().'web/galery/list_video';
        // $url = base_url().'api/v1/galery_video';
        $url = URL_GET_ALL_VIDEO ;
        $data = '';
        $methode = 'GET';
        
        // $b = api_helper('',$url,$methode,'');
        $type = 'video';
        $sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1";
        $b = $this->db->query($sql,$type)->result_array();
        $this->data['total'] = count($b);
        // $config['total_rows'] = count($a['data']);
        // $config['per_page'] = 9;
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
        $token = '';
        if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 9);
            $this->data['total_row'] = $start;
            $url = URL_GET_VIDEO_PAGGING.$start;
            // $a = api_helper('',$url,$methode,$token);
            $sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1 LIMIT ".$start.",9";
            $a = $this->db->query($sql,$type)->result_array();
            $this->data['video']=$a;
            // print_r($a['data']);
            $result = $this->load->view('video_looping',$this->data);
            echo json_encode($result);
        }else{
            $url = URL_GET_VIDEO_PAGGING.'0';
            // $a = api_helper('',$url,$methode,$token);
            $sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1 LIMIT 0,9";
            $a = $this->db->query($sql,$type)->result_array();
            $this->data['video']=$a;
            $this->data['total_row'] = '9';
            $this->data['video']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'list_video_layout',$this->data);
        }
        // $url = base_url().'api/v1/galery_video_pagging?data='.$data;
        // $b = api_helper('',$url,$methode,'');
        // $this->data['video']=$b['data'];
        // $this->ciparser->new_parse('template_frontend','modules_web', 'list_video_layout',$this->data);
    }

      function search_foto() {
        $search['search'] = $_GET['data'];
        $url= "http://192.168.88.138/idren/api/v1/search_galery_image";  
        $methode = 'POST';
        $token='';
        $app_data = api_helper(json_encode($search),$url,$methode,$token);
        $html = '';
        if (is_array($app_data['data']) !="") {

            foreach ($app_data['data'] as $key => $value) :
            $html .= '<div class="col-lg-4 col-md-4 col-xs-6 filter-img">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="';
            $html .= $value['title'];
            $html .='" data-caption="'. $value['keterangan'] .'" data-image="'.base_url().'assets/media/'. $value['file'] .'" data-target="#image-gallery" data-date="'. $value['modify_date'] .'" data-user="by : '. $value['nama_user'] .'  style="padding: 0;">
                <div class="box">
                 <h3 class="text-title" style="width: 100%;text-align: center;}">'. $value['title'].'</h3>
                    <div class="sub-box">
                        <div class="filter-image">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </div>
                        <img src="'.base_url().'assets/media/'. $value['file'] .'" class="image-gallery" id="myImg">
                    </div>
                </div>
            </a>
        </div>';
        endforeach;
        }else{
            $html.='<h3 style="margin-top:2em;">Data Not Found</h3>';
        }
        
        echo json_encode($html);

    }
    function search_video() {
        $search['search'] = $_GET['data'];
        $url= "http://192.168.88.138/idren/api/v1/search_galery_video";  
        $methode = 'POST';
        // $app_data = json_decode($this->api_helper($url,$methode,json_encode($search)),true);
        $token='';
        $app_data = api_helper(json_encode($search),$url,$methode,$token);
        // print_r($app_data);
        $html = '';


        if (is_array($app_data['data']) !="") {

            foreach ($app_data['data'] as $key => $value) :
            $html .= '<div class="col-lg-4 col-md-4 col-xs-6 filter-img">
            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title="';
            $html .= $value['title'];
            $html .='" data-caption="'. $value['keterangan'] .'" data-image="'.base_url().'assets/media/'. $value['file'] .'" data-target="#image-gallery" data-date="'. $value['modify_date'] .'" data-user="by : '. $value['nama_user'] .'  style="padding: 0;">
                <div class="box">
                <h3 class="text-title" style="width: 100%;text-align: left;}">'. $value['title'] .'</h3>
                    <div class="sub-box">
                        <div class="filter-image">
                            <i class="glyphicon glyphicon-zoom-in"></i>
                        </div>
                        <iframe class="video-up"  src="'. $value['file'] .'" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                    </div>
                </div>
            </a>
        </div>';
        endforeach;
        }else{
            $html.='<h3 style="margin-top:2em;text-align:center;">Data Not Found</h3>';
        }

        echo json_encode($html);

    }
}
