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
		if ($this->db->query($sql,$id)->num_rows() > 0) {
			return $this->db->query($sql,$id)->row_array();
			exit();
		}
		return false;
	}

	public function searchGaleryImage($data){
		$sql = "SELECT u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.type = 'image' AND (g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%')  AND g.status = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function searchGaleryVideo($data){
		$sql = "SELECT u.name as nama_user, g.id_galery as galeryId, g.file_name as file, g.judul as title, g.deskripsi as keterangan, g.tgl_upload as modify_date, g.type as jenis FROM tb_galery g join tb_user u on g.id_user_ref = u.id_user WHERE g.type = 'video' AND g.status = 1 AND (g.tgl_upload LIKE '%".$data."%' OR g.deskripsi like '%".$data."%' OR g.judul like '%".$data."%')";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function about(){
		return $this->db->get('tb_about')->row_array();
	}

	public function user_setting(){
		$sql = "SELECT profit as benefit, cara as step FROM tb_setting_user";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->row_array();
			exit();
		}
		return false;
	}

	public function getInstansi(){
		$sql = "SELECT nm_instansi as instansi, id_instansi as id FROM tb_instansi";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function getUser(){
		$sql = "SELECT name as user_nama, email as user_email, phone as user_phone FROM tb_user u join tb_instansi i on u.id_instansi_ref = id_instansi";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function insertUser($data){
		if ($this->db->insert('tb_user',$data)) {
			return true;
			exit();
		}
		return false;
	}

	public function searchUser($data){
		$sql = "SELECT u.name as user_nama, u.email as user_email, u.phone as user_phone, i.nm_instansi as instansi FROM tb_user u join tb_instansi i on u.id_instansi_ref = i.id_instansi WHERE u.name LIKE '%".$data."%' OR i.nm_instansi like '%".$data."%'";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function news(){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal, n.content as news_content, u.name as author, k.nm_kategori as kategori 
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function searchNews($data){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal, n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori 
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 AND n.judul like '%".$data."%'";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}
}