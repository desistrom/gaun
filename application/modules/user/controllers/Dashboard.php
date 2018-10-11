<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Dashboard extends MX_Controller  {
	var $data = array();
	function __construct(){
		if ($this->session->userdata('user_login') != true) {
			redirect('user/login_user');
		}
		$this->load->helper('api');
        $this->load->library('Recaptcha');

	}
    public function index() {
        // print_r($this->general->status());
    	$data = $this->session->userdata('user');
    	// print_r($data);

    	if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data))->row_array()['id_role_ref'] == 0) {
    		$user = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$data))->row_array();
    		# code...
    	}else{
    		$user = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$data))->row_array();
    	}
    	$this->data['user'] = $user;
    	// print_r($user);
        $this->ciparser->new_parse('template_user','modules_user', 'dashboard_layout',$this->data);
    }

    public function change_password(){
                $data = $this->session->userdata('user');
        // print_r($data);
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('current','Current Password', 'required');
            $this->form_validation->set_rules('new','New Password', 'required');
            $this->form_validation->set_rules('re','Re-type New Password', 'required|matches[new]');
            if ($this->form_validation->run() == true) {
                $input = $this->input->post();
                if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data,'password'=>sha1($input['current'])))->num_rows() > 0) {
                    $ret['state'] = 1;
                    $data_user['password'] = $input['new'];
                    if ($this->db->update('tb_pengguna',array('password'=>sha1($input['new'])),array('id_pengguna'=>$data))) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('user/dashboard/change_password');
                        $this->session->set_flashdata("notif","1");
                    }
                }else{
                    $ret['notif']['wr'] = 'Current Password salah, pastikan password yang anda masukan benar';
                }
            }
            $ret['notif']['current'] = form_error('current');
            $ret['notif']['new'] = form_error('new');
            $ret['notif']['re'] = form_error('re');
            echo json_encode($ret);
            exit();
        }
        $this->ciparser->new_parse('template_user','modules_user', 'change_password_layout',$this->data);
    }

    public function profil(){
                $data = $this->session->userdata('user');
        // print_r($data);
        $user = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$data))->row_array();
        $this->data['instansi_id'] = $user['id_instansi_ref'];
        $this->data['ins_us'] = $this->db->get_where('tb_instansi',array('id_instansi'=>$user['id_instansi_ref']))->row_array()['nm_instansi'];
        $role = '';
        if ($user['id_role_ref'] == 1) {
            $role = 'tb_dosen';
            $this->data['user'] = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$data))->row_array();
        }else{
            $role = 'tb_mahasiswa';
            $this->data['user'] = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$data))->row_array();
        }
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('', '');
            $this->form_validation->set_rules('nama','Nama Lengkap', 'required');
            $this->form_validation->set_rules('jk','Jenis Kelamin', 'required');
            $this->form_validation->set_rules('hp','Nomor HP', 'required');
            $this->form_validation->set_rules('alamat','Alamat', 'required');
            if(is_null($this->general->status())){
            $this->form_validation->set_rules('instansi','Instansi', 'required');
            }
            if ($role == 'tb_mahasiswa') {
            $this->form_validation->set_rules('angkatan','Tahun Angkatan', 'required');
            $this->form_validation->set_rules('jurusan','Jurusan', 'required');
            }
            if ($this->form_validation->run() == true) {
                $input = $this->input->post();
                $ret['state'] = 1;
                $data_user['nama'] = $input['nama'];
                $data_user['jeniskelamin'] = $input['jk'];
                $data_user['no_hp'] = $input['hp'];
                $data_user['alamat'] = $input['alamat'];
                if ($role == 'tb_mahasiswa') {
                    $data_user['angkatan'] = $input['angkatan'];
                    $data_user['jurusan'] = $input['jurusan'];
                }
                if(is_null($this->general->status())){
                $data_pengguna['id_instansi_ref'] = $input['instansi'];
                $this->db->update('tb_pengguna',$data_pengguna,array('id_pengguna'=>$data));
                }
                if ($this->db->update($role,$data_user,array('id_pengguna_ref'=>$data))) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('user/dashboard/profil');
                    $this->session->set_flashdata("notif","berhasil");
                }
            }
            $ret['notif']['nam'] = form_error('nam');
            $ret['notif']['jk'] = form_error('jk');
            $ret['notif']['hp'] = form_error('hp');
            $ret['notif']['alamat'] = form_error('alamat');
            if(is_null($this->general->status())){
            $ret['notif']['instansi'] = form_error('instansi');
            }
            if ($role == 'tb_mahasiswa') {
                $ret['notif']['angkatan'] = form_error('angkatan');
                $ret['notif']['jurusan'] = form_error('jurusan');
            }
            echo json_encode($ret);
            exit();
        }
        
        // print_r($this->data['user']);
        $this->data['role'] = $role;
        $this->data['instansi'] = $this->db->get_where('tb_instansi',array('id_jenis_instansi'=>5,'status'=>2))->result_array();
        $this->ciparser->new_parse('template_user','modules_user', 'profil_layout',$this->data);
    }
  



}