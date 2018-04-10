<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model{

	public function getTestimoni(){
		$sql = "SELECT u.name, u.email, t.content, t.id_testimoni, t.is_aktif FROM tb_testimoni t join tb_user u on t.id_user_ref = u.id_user";
		return $this->db->query($sql)->result_array();
	}
}