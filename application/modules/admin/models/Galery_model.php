<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galery_model extends CI_Model{

	public function getAllGalery(){
		return $this->db->get('tb_galery')->result_array();
	}

	public function getTypeGalery($data){
		return $this->db->get_where('tb_galery',array('type'=>$data))->result_array();
	}

	public function rowGalery($id){
		return $this->db->get_where('tb_galery',array('id_galery' => $id))->row_array();
	}

	public function insertGalery($data){
		if($this->db->insert('tb_galery',$data)){
			return true;
			exit();
		}
		return false;
	}

	public function editGalery($data,$id){
		if ($this->db->update('tb_galery',$data,array('id_galery' => $id))) {
			return true;
			exit();
		}
		return false;
	}

	public function insertAlbum($data){
		if ($this->db->insert('tb_album_galery',$data)) {
			return true;
			exit();
		}
		return false;
	}

	public function updateAlbum($data,$id){
		if ($this->db->update('tb_album_galery',$data,array('id_album'=>$id))) {
			return true;
			exit();
		}
		return false;
	}
}