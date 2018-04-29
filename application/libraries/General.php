<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class General
{
	// This is parse function based on special html tag for codeigniter
	// Created by Ibnu Syuhada <ibnusyuhadap3@gmail.com>
	// Version 1.0

	// new parse function
	// $template is template path
	// $data is data for module view
	// $key is module name
	// $embed_template is module view path
	private $CI;

	public function __construct() {
		$this->CI = & get_instance();
		//$this->CI->load->model('users');
	}

	public function get_current_page(){
		return $this->CI->router->fetch_method();
	}

 	public function is_login(){
        if($this->CI->session->userdata('is_login') == '' || $this->CI->session->userdata('previlage') == '' || $this->CI->session->userdata('userid') == '') {
            return false;
        }else{
            return true;
        }
    }

    public function get_idRole(){
    	return $this->CI->session->userdata('previlage');
    }

    public function limit_text($string, $limit) {
			$stringX = strip_tags($string);
			if (strlen($stringX) > $limit) {
					// truncate string
					$stringCut = substr($string, 0, $limit);
					// make sure it ends in a word so assassinate doesn't become ass...
					$stringX = substr($stringCut, 0, strrpos($stringCut, ' '))." ...";
			}
      return $stringX;
    }

    public function menu(){
        $sql = "SELECT id, label, link, parent FROM tb_menu ORDER BY sort ASC";
        $item = $this->CI->db->query($sql)->result_array();
        $menus = array('items'=>array(),'parents'=>array());
        foreach ($item as $key => $value) {
            $menus['items'][$value['id']] = $value;
            $menus['parents'][$value['parent']][]= $value['id'];
        }
        echo $this->createTreeView(0,$menus);
    }

    function createTreeView($parent, $menu){
       $html = "";
       if (isset($menu['parents'][$parent])) {
          $html .= '';
           foreach ($menu['parents'][$parent] as $itemId) {
              if(!isset($menu['parents'][$itemId])) {
                 $html .= "<li><a href='".$menu['items'][$itemId]['link']."'>"
    .$menu['items'][$itemId]['label']."</a></li>";
              }
              if(isset($menu['parents'][$itemId])) {
                 $html .= "<li class='dropdown'>
                 <a data-toggle='dropdown' aria-expanded='false' href='#' class='dropdown-toggle' href='".$menu['items'][$itemId]['link']."'>".$menu['items'][$itemId]['label']." <span class='fa fa-angle-down'></span></a>";
                 $html .= "<ul class='dropdown-menu'>";
                 $html .= "<li>".$this->createTreeView($itemId, $menu)."</li>";
                 $html .= "</ul>";
              }
           }
           $html .= "";
       }
       return $html;
    }


}
