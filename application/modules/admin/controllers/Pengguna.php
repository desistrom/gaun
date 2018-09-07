<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Pengguna extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->module('login');
		// if ($this->login->token_check() == 0) {
		// 	// redirect('login');
		// }
	}

	public function index(){
		$this->data['breadcumb'] = 'Request Dosen';
		$sql = "SELECT * FROM tb_pengguna p JOIN tb_dosen d on p.id_pengguna = d.id_pengguna_ref where status = 0";
		$this->data['user'] = $this->db->query($sql)->result_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'pengguna/pengguna_layout',$this->data);
	}

    public function mahasiswa(){
        $this->data['breadcumb'] = 'Request Mahasiswa';
        $sql = "SELECT * FROM tb_pengguna p JOIN tb_mahasiswa d on p.id_pengguna = d.id_pengguna_ref where status = 1";
        $this->data['user'] = $this->db->query($sql)->result_array();
        $this->ciparser->new_parse('template_admin','modules_admin', 'pengguna/pengguna_layout',$this->data);
    }

	public function confirm($id = null){
		// print_r($id);
		$data_p['status'] = 1;
		$password = $this->generate();
		$data_p['password'] = sha1($password);
		$this->load->helper('email_send_helper');
        if ($this->db->update('tb_pengguna',$data_p,array('id_pengguna'=>$id))) {
        	$userData = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
            $data['email_from'] = 'support@idren';
            $data['name_from'] = 'IDREN';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Aktifasi Akun';
            $data['content'] = 'Akun Anda Telah diaktifasi, berikut rincian data login anda<br> username : '.$userData['username'].'<br>Password : '.$password.'<br>Selamat berkontribusi untuk Negeri';
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Aktifasi Berhasil");
                $this->session->set_flashdata("notif","Aktifasi Akun berhasil dilakukan");
                redirect(site_url('admin/pengguna'));
            }
        }else{
            $this->session->set_flashdata("header","Aktifasi Gagal");
            $this->session->set_flashdata("notif","Akun gagal diaktifasi");
            redirect(site_url('admin/pengguna/'));
        }
	}

	public function decline($id = null){
		// print_r($id);
		$data_p['status'] = 1;
		$password = $this->generate();
		$data_p['password'] = sha1($password);
		$this->load->helper('email_send_helper');
        if ($this->db->update('tb_pengguna',$data_p,array('id_pengguna'=>$id))) {
        	$userData = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
            $data['email_from'] = 'support@idren';
            $data['name_from'] = 'IDREN';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Konfirmasi Akun';
            $data['content'] = 'Akun Anda Telah di konfirmasi, berikut rincian data login anda<br> username : '.$userData['username'].'<br>Password : '.$password.'<br>Selamat berkontribusi untuk Negeri';
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Registrasi Berhasil");
                $this->session->set_flashdata("notif","Registrasi Anda sedang kami Proses, tunggu konfirmasi selanjutnya dari Admin");
                redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
            }
        }else{
            $this->session->set_flashdata("header","Registrasi Gagal");
            $this->session->set_flashdata("notif","Akun Google Anda pernah didaftarkan sebelumnya, silahkan login untuk masuk");
            redirect(site_url('web/keanggotaan/pendaftaran_dosen'));
        }
	}

	function generate(){
        $chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $res = "";
        for ($i = 0; $i < 10; $i++) {
            $res .= $chars[mt_rand(0, strlen($chars)-1)];
        }
        return $res;
    }
}