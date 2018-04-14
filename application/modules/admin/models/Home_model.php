<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model{

	public function getTestimoni(){
		$sql = "SELECT * FROM tb_testimoni ";
		return $this->db->query($sql)->result_array();
	}

	public function getemail(){
		$sql = "SELECT * FROM tb_notifikasi_email e join tb_kategori_email k on e.id_kategori_email_ref = k.id_kategori_email";
		if ($this->db->query($sql)->num_rows() > 0) {
			return $this->db->query($sql)->result_array();
			exit();
		}
		return array();
	}
}