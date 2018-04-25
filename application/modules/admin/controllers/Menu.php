<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Menu extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->module('home_model');
	}

	public function index(){
		$sql = "SELECT id, label, link, parent FROM tb_menu ORDER BY parent, sort, label";
		$item = $this->db->query($sql)->result_array();
		$menus = array('items'=>array(),'parents'=>array());
		$this->data['menu'] = '';
		foreach ($item as $key => $value) {
			$row = $item;
			$parent = $value['parent'];
			$this->data['menu'] .= $this->build_menu($row,$parent);
		}
		print_r($this->data['menu']);
		$this->data['breadcumb'] = 'adnu';
		// $this->data['menu'] = $this->build_menu(0,$menus);
		$this->ciparser->new_parse('template_admin','modules_admin', 'menu/list_menu_layout',$this->data);
	}

	function build_menu($rows,$parent)
    {
        $temp = "<ul class=\"treeview-menu\">";
        $result = "";
        foreach ($rows as $row)
        {
            if ($row['id'] == $parent){

                $result.= "<li class=\"treeview\"><a href=" . site_url('admin/dashboard?id=') . $row['id'] ."><span>{$row['label']}</span></a>";
                // if ($this->has_children($rows,$row['id']))
                    // $result.= $temp . $this->build_menu($rows,$row['id']);                   
            }
        }
        $result.= "</ul>";

        return $result;
    }
    function has_children($rows,$id)
    {
        foreach ($rows as $row) {
            if ($row['id'] == $id)
            return true;            
        }
        return false;
    }

}