<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Model{
    function __construct() {
        $this->tableName = 'tb_pengguna';
        $this->primaryKey = 'id_pengguna';
    }
    public function checkUser($data = array()){
        $this->db->select('*');
        $this->db->from($this->tableName);
        $this->db->where(array('oauth_provider'=>$data['oauth_provider'],'oauth_id'=>$data['oauth_id']));
        $query = $this->db->get();
        $check = $query->num_rows();
        $user_data = '';
        if($check > 0){
            $result = $query->row_array();
            // $data['modified'] = date("Y-m-d H:i:s");
            // $update = $this->db->update($this->tableName,$data,array('id'=>$result['id']));
            $userID = $result['id_pengguna'];
            if ($result['status'] == 0) {
                $user_data = 'no';
            }else{
                if ($result['id_role_ref'] != $data['id_role_ref']) {
                    $user_data = 'salah';
                }else{
                    $user_data = $userID;
                }
            }
        }else{
            // $data['created'] = date("Y-m-d H:i:s");
            // $data['modified']= date("Y-m-d H:i:s");
            $pengguna['oauth_id'] = $data['oauth_id'];
            $pengguna['oauth_provider'] = $data['oauth_provider'];
            $pengguna['email'] = $data['email'];
            $pengguna['username'] = $data['email'];
            $pengguna['id_role_ref'] = $data['id_role_ref'];
            $insert = $this->db->insert($this->tableName,$pengguna);
            $userID = $this->db->insert_id();
            $dosen['nama'] = $data['first_name']." ".$data['last_name'];
            $dosen['jeniskelamin'] = $data['gender'] == 'male'?'L':'P';
            $dosen['id_pengguna_ref'] = $userID;
            if ($data['id_role_ref'] == 1) {
                $this->db->insert('tb_dosen',$dosen);
            }else{
                $this->db->insert('tb_mahasiswa',$dosen);
            }
            $user_data = 'insert';
        }

        return $user_data?$user_data:false;
    }
}