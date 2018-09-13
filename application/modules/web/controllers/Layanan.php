<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Layanan extends MX_Controller  {
	   var $data = array();

    function __construct(){
        $this->load->helper('api');
            $this->load->library('pagination');

    }
    function index() {
        if (!empty($this->input->get('page'))) {
            $limit = ceil($this->input->get('page') * 4);
            $this->data['total'] = $this->db->get_where('tb_menu',array('parent'=>24))->num_rows();
            $this->data['total_row'] = $limit;
            $sql = "SELECT * FROM tb_menu where parent=24 ORDER BY sort ASC LIMIT ".$limit.",4";
            $this->data['page'] = $this->db->query($sql)->result_array();
            foreach ($this->data['page'] as $key => $value) {
                $url = explode('/', $value['link']);
                $link = end($url);
                $sql_page = "SELECT * FROM tb_general_page where link = '".$link."'";
                $this->data['page'][$key]['content'] = $this->db->query($sql_page)->row_array()['content'];
                $this->data['page'][$key]['image'] = $this->db->query($sql_page)->row_array()['img'];
            }
            $result = $this->load->view('looping_layanan',$this->data);
            echo json_encode($result);
        }else{
            $limit = 0;
            $this->data['total'] = $this->db->get_where('tb_menu',array('parent'=>24))->num_rows();
            $this->data['total_row'] = $limit;
            $sql = "SELECT * FROM tb_menu where parent=24 ORDER BY sort ASC LIMIT ".$limit.",4";
            $this->data['page'] = $this->db->query($sql)->result_array();
            foreach ($this->data['page'] as $key => $value) {
                $url = explode('/', $value['link']);
                $link = end($url);
                $sql_page = "SELECT * FROM tb_general_page where link = '".$link."'";
                $this->data['page'][$key]['content'] = $this->db->query($sql_page)->row_array()['content'];
                $this->data['page'][$key]['image'] = $this->db->query($sql_page)->row_array()['img'];
            }
    	   $this->ciparser->new_parse('template_frontend','modules_web', 'layanan_layout',$this->data);
        }
        /*$this->data['book'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->row_array();
        $this->data['journal'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->row_array();
        $this->data['tube'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-TUBE'))->row_array();
        $this->data['mail'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->row_array();
        $this->data['research'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->row_array();
        $this->data['link'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->row_array();
        $this->data['rank'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->row_array();*/
    }
     function idroam() {
        $url = site_url('api/v1/getlayanan_idroam') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['idroam']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'idroam_layout',$this->data);
    }
    function cloud_federation() {
        $url = site_url('api/v1/getlayanan_cloud') ;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['cloud']=$a['data'];

    	$this->ciparser->new_parse('template_frontend','modules_web', 'cloudfederation_layout',$this->data);
    }
    function general_layanan() {


        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout');
    }

    public function id_book(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function id_journal(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function id_tube(){
        $token = '';
        $data = '';
        $methode = 'GET';
        // $url = URL_GET_ALL_VIDEO ;
        
        // $b = api_helper('',$url,$methode,'');
        $type = 'video';
        $sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1";
        $b = $this->db->query($sql,$type)->result_array();
        $this->data['total'] = count($b);
        /*if (!empty($this->input->get('page'))) {
            $start = ceil($this->input->get('page') * 9);
            $this->data['total_row'] = $start;
            $url = URL_GET_VIDEO_PAGGING.$start;
            $a = api_helper('',$url,$methode,$token);
            $this->data['video']=$a['data'];
            // print_r($a['data']);
            $result = $this->load->view('video_looping',$this->data);
            echo json_encode($result);
        }else{
            $url = URL_GET_VIDEO_PAGGING.'0';
            $a = api_helper('',$url,$methode,$token);
            $this->data['total_row'] = '9';
            $this->data['video']=$a['data'];
            $this->ciparser->new_parse('template_frontend','modules_web', 'list_video_layout',$this->data);
        }*/
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
            $this->data['video']=$a;
            $this->ciparser->new_parse('template_frontend','modules_web', 'list_video_layout',$this->data);
        }
/*        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-TUBE'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);*/
    }
     function list_idtube() {
        $config['base_url'] = base_url().'web/layanan/list_idtube';
        $url = base_url().'api/v1/tube_video';
        // $url = site_url('api/v1/galery_video') ;
        $data = '';
        $methode = 'GET';
        
        $a = api_helper('',$url,$methode,'');
        $config['total_rows'] = count($a['data']);
        $config['per_page'] = 9;
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link'] = 'Next';
        $this->pagination->initialize($config);

        
        $url = $this->uri->segment_array();
        $data = end($url);
        if (!is_numeric($data)) {
            $data = 0;
        }
        $url = base_url().'api/v1/tube_video_pagging?data='.$data;
        $token = '';
        $b = api_helper('',$url,$methode,'');
        $this->data['id_tube']=$b['data'];    
        $this->ciparser->new_parse('template_frontend','modules_web', 'list_generalvideo_layout',$this->data);
    }

    public function id_mail(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function id_research(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function id_link(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function id_rank(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }

    public function monitoring(){
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'MONITORING GRAPH'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
    }


  
}