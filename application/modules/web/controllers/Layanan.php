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

    }
    function index() {

        $this->data['book'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-BOOK'))->row_array();
        $this->data['journal'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-JOURNAL'))->row_array();
        $this->data['tube'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-TUBE'))->row_array();
        $this->data['mail'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-MAIL'))->row_array();
        $this->data['research'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RESEARCH'))->row_array();
        $this->data['link'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-LINKS'))->row_array();
        $this->data['rank'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-RANK'))->row_array();
    	$this->ciparser->new_parse('template_frontend','modules_web', 'layanan_layout',$this->data);
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
        $this->data['layanan'] = $this->db->get_where('tb_page_layanan',array('nama_page'=>'ID-TUBE'))->row_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'general_layout',$this->data);
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