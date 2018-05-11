<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
//nama class harus diawali dengan kapital, walaupun nama file semua kecil
class Sitemap extends CI_Controller {
 
	public function indexas(){
	     $this->load->helper('url');
	     // $this->load->model('m_sitemap');
	     $sql_menu = "select * from tb_menu where link != '#'";
	     $data['menu'] = $this->db->query($sql_menu)->result_array();
	     $sql_news = "select * from tb_news";
	     $data['news'] = $this->db->query($sql_news)->result_array();
	     
	     // $data['artikel'] = $this->m_sitemap->generate();
	     $this->load->view('site_map',$data);
	}
	public function index(){
        $sql = "SELECT id, label, link, parent FROM tb_menu ORDER BY sort ASC";
        $item = $this->db->query($sql)->result_array();
        $menus = array('items'=>array(),'parents'=>array());
        foreach ($item as $key => $value) {
            $menus['items'][$value['id']] = $value;
            $menus['parents'][$value['parent']][]= $value['id'];
        }
        $data['menu'] = $this->createTreeView(0,$menus);
        $this->ciparser->new_parse('template_frontend','modules_web', 'site_map',$data);
        // $this->load->view('site_map',$data);
    }

    function createTreeView($parent, $menu){
       $html = "";
       if (isset($menu['parents'][$parent])) {
          $html .= '';
           foreach ($menu['parents'][$parent] as $itemId) {
              if(!isset($menu['parents'][$itemId])) {
                 $html .= "<li class='menu-parent'><a class='menu' href='".base_url().$menu['items'][$itemId]['link']."'";
                  if(current_url() == base_url().$menu['items'][$itemId]['link']){ $html .= "class='active'"; }
                 $html .= ">".$menu['items'][$itemId]['label']."</a></li>";
              }
              if(isset($menu['parents'][$itemId])) {
                 $html .= "<li class='dropdown '>
                 <a class='inline-site menu' data-toggle='dropdown' aria-expanded='false' href='#' class='dropdown-toggle' href='".base_url().$menu['items'][$itemId]['link']."'>".$menu['items'][$itemId]['label']." <span class='fa fa-angle-down'></span></a>";
                 $html .= "<ul class='inline-site sub-menu'>";
                 $html .= "<li>".$this->createTreeView($itemId, $menu)."</li>";
                 $html .= "</ul>";
              }
           }
           $html .= "";
       }
       return $html;
    }
 
}