<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site create by junaidi
 *
 * @author http://www.roytuts.com
 */
class Testimoni extends MX_Controller  {
	var $data = array();

	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');

	}
    function index() {


        $config['base_url'] = base_url().'web/Testimoni/index';
        $url = URL_GET_TESTIMONI;
        $methode = 'GET';
        // $b = api_helper('',$url,$methode,'');
        $sql = "SELECT content as testimoni, gambar as image, id_testimoni as testimoniId, nama_user as user, jabatan as sebagai FROM tb_testimoni where is_aktif = 1 ORDER BY sort ASC";
        $b = $this->db->query($sql)->result_array();
        foreach ($b as $key => $value) {
            if ($value['image'] == '') {
                $b[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $b[$key]['image_big'] = 'media/'.$value['image'];
                    $b[$key]['image'] = 'media/thumbnail/'.$value['image'];
                }else{
                    $b[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $b[$key]['image'] = 'media/'.$value['image'];
                }
            }

        }
        $config['total_rows'] = count($b);
        $config['per_page'] = 6;
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
        $url = URL_GET_TESTIMONI_PAGGING.$data;
        $methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT content as testimoni, gambar as image, id_testimoni as testimoniId, nama_user as user, jabatan as sebagai  FROM tb_testimoni where is_aktif = 1 LIMIT ".$data.",6";
        $a = $this->db->query($sql)->result_array();
        foreach ($a as $key => $value) {
            if ($value['image'] == '') {
                $a[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $a[$key]['image_big'] = 'media/'.$value['image'];
                    $a[$key]['image'] = 'media/thumbnail/'.$value['image'];
                }else{
                    $a[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $a[$key]['image'] = 'media/'.$value['image'];
                }
            }

        }
        $this->data['testimoni']=$a;
    	$this->ciparser->new_parse('template_frontend','modules_web', 'testimoni_layout',$this->data);
    }
}