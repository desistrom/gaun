<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//nama class harus diawali dengan kapital, walaupun nama file semua kecil
class Sitemap extends CI_Controller {
 
 public function index(){
     $this->load->helper('url');
     // $this->load->model('m_sitemap');
     $sql_menu = "select * from tb_menu where link != '#'";
     $data['menu'] = $this->db->query($sql_menu)->result_array();
     $sql_news = "select * from tb_news";
     $data['news'] = $this->db->query($sql_news)->result_array();
     
     // $data['artikel'] = $this->m_sitemap->generate();
     $this->load->view('site_map',$data);
 }
 
}