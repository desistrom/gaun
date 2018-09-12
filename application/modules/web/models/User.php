<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->tableName = 'tb_pengguna';
        $this->primaryKey = 'id_pengguna';
    }
    public function checkUser($data = array()){
        $this->db->select($this->primaryKey);
        $this->db->from($this->tableName);
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_id'=>$data['oauth_id']));
        $query = $this->db->get();
        $check = $query->num_rows();
        $user_data = '';
        if($check > 0){
            $result = $query->row_array();
            // $data['modified'] = date("Y-m-d H:i:s");
            // $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $user_data = 'exist';
        }else{
            // $data['created'] = date("Y-m-d H:i:s");
            // $data['modified']= date("Y-m-d H:i:s");
            $pengguna['oauth_id'] = $data['oauth_id'];
            $pengguna['oauth_provider'] = $data['oauth_provider'];
            $pengguna['email'] = $data['email'];
            $pengguna['username'] = $data['email'];
            $pengguna['password'] = sha1($data['oauth_id']);
            if ($data['status'] == 'dosen') {
                $pengguna['id_role_ref'] = 1;
                }else{
                $pengguna['id_role_ref'] = 0;
            }
            $insert = $this->db->insert($this->tableName,$pengguna);
            $userID = $this->db->insert_id();
            $dosen['nama'] = $data['first_name']." ".$data['last_name'];
            $dosen['jeniskelamin'] = $data['gender'] == 'male'?'L':'P';
            $dosen['id_pengguna_ref'] = $userID;
            if ($data['status'] == 'dosen') {
                // $pengguna['id_role_ref'] = 1;
                $this->db->insert('tb_dosen',$dosen);
            }else{
                // $pengguna['id_role_ref'] = 0;
                $this->db->insert('tb_mahasiswa',$dosen);
            }
            $user_data = 'insert';
        }

        return $user_data?$user_data:false;
    }
}