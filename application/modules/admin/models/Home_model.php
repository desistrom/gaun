<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home_model extends CI_Model{

	public function getTestimoni(){
		$sql = "SELECT * FROM tb_testimoni ";
		return $this->db->query($sql)->result_array();
	}
}