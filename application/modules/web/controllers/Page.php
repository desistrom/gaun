<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Page extends MX_Controller  {
		var $data = array();

	function __construct(){
		$this->load->helper('api');

	}
    function index() {
        $url = $this->uri->segment_array();
        $link = end($url);
        // print_r($link);
        $data_page = '';
        $url = URL_GET_PAGE.$link;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token)['data'];
        if (count($a) > 0) {
            $data_page = $a;
            if ($data_page['page'] == 1) {
                $layout = 'general_layout';
                $data_page['nama_page'] = $data_page['title'];
                $data_page['image'] = $data_page['img'];
            }else{
                $layout = 'general_foto_layout';
                $content = explode('@["slideshow":"', $data_page['content']);
                $slide = explode('"];</p>', $content[1]);
                $sql = "select a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image from tb_galery g join tb_album_galery a on g.id_album = a.id_album where a.key_album = '".$slide[0]."'";
                    $url = URL_GET_SLIDER_FOTO.$slide[0];
                    $methode = 'GET';
                    $token = '';
                    $b = api_helper('',$url,$methode,$token)['data'];
                if (count($b) > 0) {
                    $this->data['slideshow'] = $b;
                    // print_r($slideshow);
                }
                    $data = str_replace('<p>@["set_album":"', "'", $data_page['content']);
                    $foto = str_replace('"];</p>', "',", $data);
                    $foto = str_replace('<p>@["slideshow":"', "'", $foto);
                    // $foto = explode(',', $foto);
                    $foto = substr($foto, 0, -3);
                    $album['key'] = $foto;
                    // $url_foto = str_replace("'", "%27", $foto);
                    $url = URL_GET_DATA_FOTO;
                    $methode = 'POST';
                    $token = '';
                    $c = api_helper(json_encode($album),$url,$methode,$token)['data'];
                    // print_r($c);
                    $sql = "select a.id_album as albumId, a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image, g.id_album from tb_galery g join tb_album_galery a on g.id_album = a.id_album where a.key_album in (".$foto.") group by a.id_album, g.id_album";
                if (count($c) > 0) {
                    $this->data['foto'] = $c;
                    // print_r($sql);
                }
            }
            
        $this->data['layanan'] = $data_page;        
        $this->ciparser->new_parse('template_frontend','modules_web', $layout,$this->data);
        }else{
            $this->output->set_status_header('404'); 
            $this->ciparser->new_parse('template_frontend','modules_web', 'notfound_layout');
            // exit();
        }
        
    }

    public function not_found(){
        $this->output->set_status_header('404'); 
        $this->ciparser->new_parse('template_frontend','modules_web', 'notfound_layout');
    }
  
}