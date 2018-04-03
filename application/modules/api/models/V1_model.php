<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V1_model extends CI_Model{

	public function getAllGalery(){
		return $this->db->get('tb_galery')->result_array();
	}

	public function getTypeGalery($type){
		$sql = "select u.name, g.* from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1";
		if ($this->db->query($sql,$type)->num_rows() > 0) {
			return $this->db->query($sql,$type)->result_array();
			exit();
		}
		return false;
	}

	public function selectGalery($id){
		if ($this->db->get_where('tb_galery',array('id_galery' => $id))->num_rows() > 0) {
			return $this->db->get_where('tb_galery',array('id_galery' => $id))->row_array();
			exit();
		}
		return false;
	}

	public function searchGaleryImage($data){
		$sql = "SELECT u.name, g.* FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%' AND g.type = 'image' AND g.status = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function searchGaleryVideo($data){
		$sql = "SELECT u.name, g.* FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%' AND g.type = 'video' AND g.status = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function about(){
		return $this->db->get('tb_about')->row_array();
	}
}