<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class V1_model extends CI_Model{

	public function getAllGalery(){
		return $this->db->get('tb_galery')->result_array();
	}

	public function getTypeGalery($type){
		$sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.type = ? and g.status = 1";
		if ($this->db->query($sql,$type)->num_rows() > 0) {
			return $this->db->query($sql,$type)->result_array();
			exit();
		}
		return false;
	}

	public function selectGalery($id){
		$sql = "select u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis from tb_galery g join tb_user u on g.id_user_ref = u.id_user where g.id_galery = ?";
		if ($this->db->query($query,$id)->num_rows() > 0) {
			return $this->db->query($query,$id)->row_array();
			exit();
		}
		return false;
	}

	public function searchGaleryImage($data){
		$sql = "SELECT u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%' AND g.type = 'image' AND g.status = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function searchGaleryVideo($data){
		$sql = "SELECT u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%' AND g.type = 'video' AND g.status = 1";
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