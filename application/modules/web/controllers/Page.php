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
        if ($this->db->get_where('tb_general_page',array('link'=>$link))->num_rows() > 0) {
            $data_page = $this->db->get_where('tb_general_page',array('link'=>$link))->row_array();
            if ($data_page['page'] == 1) {
                $layout = 'general_layout';
                $data_page['nama_page'] = $data_page['title'];
                $data_page['image'] = $data_page['img'];
            }else{
                $layout = 'general_foto_layout';
                $content = explode('@["slideshow":"', $data_page['content']);
                $slide = explode('"];</p>', $content[1]);
                $sql = "select a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image from tb_galery g join tb_album_galery a on g.id_album = a.id_album where a.key_album = '".$slide[0]."'";
                if ($this->db->query($sql)->num_rows() > 0) {
                    $this->data['slideshow'] = $this->db->query($sql)->result_array();
                    // print_r($slideshow);
                }
                    $data = str_replace('<p>@["set_album":"', "'", $data_page['content']);
                    $foto = str_replace('"];</p>', "',", $data);
                    $foto = str_replace('<p>@["slideshow":"', "'", $foto);
                    // $foto = explode(',', $foto);
                    $foto = substr($foto, 0, -3);
                    $sql = "select a.id_album as albumId, a.judul_album as title, a.tgl_kegiatan as date_album, g.file_name as image from tb_galery g join tb_album_galery a on g.id_album = a.id_album where a.key_album in (".$foto.") group by a.id_album";
                if ($this->db->query($sql)->num_rows() > 0) {
                    $this->data['foto'] = $this->db->query($sql)->result_array();
                    // print_r($sql);
                }
            }
            
        $this->data['layanan'] = $data_page;        
        $this->ciparser->new_parse('template_frontend','modules_web', $layout,$this->data);
        }else{
            $this->ciparser->new_parse('template_frontend','modules_web', 'notfound_layout');            
            // exit();
        }
        
    }
  
}