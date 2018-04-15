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
		$sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function getInstansi_pagging($data){
		$sql = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi LIMIT ".$data.",8";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function getUser(){
		$sql = "SELECT u.id_user as UserId, u.name as user_nama, u.email as user_email, u.phone as user_phone, u.gambar as image FROM tb_user u join tb_instansi i on u.id_instansi_ref = id_instansi where u.is_aktif = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function rowUser($id){
		$sql = "SELECT u.id_user as UserId, u.name as user_nama, u.email as user_email, u.phone as user_phone, u.gambar as image FROM tb_user u join tb_instansi i on u.id_instansi_ref = id_instansi where u.id_user = ".$id;
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
		$sql = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function newsPagging($data){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal,n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 ORDER BY n.id_news DESC  LIMIT ".$data.",4 ";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function searchNews($data){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal, n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 AND n.judul like '%".$data."%'";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function rowNews($data){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal, n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar 
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 AND n.id_news = '".$data."'";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->row_array();
			exit();	
		}
		return false;
	}

	public function slugNews($data){
		$sql = "SELECT n.id_news as newsId, n.created as tanggal, n.judul as title, n.content as news_content, u.name as author, k.nm_kategori as kategori, n.link as sumber, n.img as gambar 
			FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news 
			join tb_user u on n.id_user_ref = u.id_user where n.is_aktif = 1 AND n.link = '".$data."'";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();	
		}
		return false;
	}

	public function getTestimoni(){
		$sql = "SELECT content as testimoni, gambar as image, id_testimoni as testimoniId, nama_user as user, jabatan as sebagai  FROM tb_testimoni where is_aktif = 1";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return false;
	}

	public function getHero(){
		$sql = "SELECT title as judul, link_video as video, content as deskripsi FROM tb_hero";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->row_array();
			exit();
		}
		return false;
	}

	public function getLayanan($id){
		$sql = "SELECT title as judul, gambar as image, content as deskripsi FROM tb_layanan WHERE kategori = ".$id;
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->row_array();
			exit();
		}
		return false;
	}

	public function getLogo($id){
		$sql = "SELECT logo as image FROM tb_logo where status = ".$id;
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->row_array();
			exit();
		}
		return false;
	}
}