<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Pengguna extends MX_Controller  {
	var $data = array();
    var $user = array();
	function __construct(){
		$this->load->module('login');
		// if ($this->login->token_check() == 0) {
		// 	// redirect('login');
		// }
        if(!isset($_COOKIE['data_instansi']) || decode_token_jwt($_COOKIE['data_instansi']) != true){
            redirect(site_url('instansi/login'));
        }
        $this->user = data_jwt($_COOKIE['data_instansi']);
        $this->load->library('Excel');
        // $this->user->user = $this->session->userdata('data_user');
	}

    public function list_dosen(){
        $this->data['breadcumb'] = 'List Dosen';
        $sql = "SELECT * FROM tb_pengguna p JOIN tb_dosen d on p.id_pengguna = d.id_pengguna_ref where id_role_ref = 1 AND status = 1 AND id_instansi_ref = ? ";
        $this->data['user'] = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'pengguna/list_layout',$this->data);
    }

    public function list_mahasiswa(){
        $this->data['breadcumb'] = 'List Mahasiswa';
        $sql = "SELECT * FROM tb_pengguna p JOIN tb_mahasiswa d on p.id_pengguna = d.id_pengguna_ref where id_role_ref = 0 AND status = 1 AND status = 1 AND id_instansi_ref = ?";
        $this->data['user'] = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'pengguna/list_layout',$this->data);
    }

    public function detail($id){
        $data = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
        if ($data['id_role_ref'] == 1) {
            $sql = "SELECT * FROM tb_pengguna p JOIN tb_dosen d on p.id_pengguna = d.id_pengguna_ref where id_pengguna = ?";
        }else{
            $sql = "SELECT * FROM tb_pengguna p JOIN tb_mahasiswa d on p.id_pengguna = d.id_pengguna_ref where id_pengguna = ?";
        }
        $user = $this->db->query($sql,$id)->row_array();
        $html = '';
        $html .= '<li>Nama : '.$user['nama'].'</li>';
        $html .= '<li>Email : '.$user['email'].'</li>';
        $html .= '<li>No. Hp : '.$user['no_hp'].'</li>';
        $html .= '<li>Jenis Kelamin : '.$user['jeniskelamin'].'</li>';
        $html .= '<li>Alamat : '.$user['alamat'].'</li>';
        if ($data['id_role_ref'] == 0) {
            $html .= '<li>Angkatan : '.$user['angkatan'].'</li>';
            $html .= '<li>Jurusan : '.$user['jurusan'].'</li>';
        }
        echo json_encode($html);
    }

	public function index(){
		$this->data['breadcumb'] = 'Request Dosen';
		$sql = "SELECT * FROM tb_pengguna p JOIN tb_dosen d on p.id_pengguna = d.id_pengguna_ref where id_role_ref = 1 AND status = 0 AND id_instansi_ref = ?";
		$this->data['user'] = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
		$this->ciparser->new_parse('template_instansi','modules_instansi', 'pengguna/pengguna_layout',$this->data);
	}

    public function mahasiswa(){
        $this->data['breadcumb'] = 'Request Mahasiswa';
        $sql = "SELECT * FROM tb_pengguna p JOIN tb_mahasiswa d on p.id_pengguna = d.id_pengguna_ref where id_role_ref = 0 AND status = 0 AND id_instansi_ref = ?";
        $this->data['user'] = $this->db->query($sql,$this->user->user->id_instansi)->result_array();
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'pengguna/pengguna_layout',$this->data);
    }

	public function confirm($id = null){
		// print_r($id);
		$data_p['status'] = 1;
		$password = $this->generate();
		$data_p['password'] = sha1($password);
		$this->load->helper('email_send_helper');
        if ($this->db->update('tb_pengguna',$data_p,array('id_pengguna'=>$id))) {
        	$userData = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
            $data['email_from'] = 'support@IDREN';
            $data['name_from'] = 'IDREN support';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Aktifasi Akun';
            $data['content'] = 'Akun Anda Telah diaktifasi, berikut rincian data login anda<br> username : '.$userData['username'].'<br>Password : '.$password.'<br>Selamat berkontribusi untuk Negeri';
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Aktifasi Berhasil");
                $this->session->set_flashdata("notif","Aktifasi Akun berhasil dilakukan");
                if ($userData['id_role_ref'] == 1) {
                    redirect(site_url('instansi/pengguna'));
                }else{
                    redirect(site_url('instansi/pengguna/mahasiswa'));
                }
            }
        }else{
            $this->session->set_flashdata("header","Aktifasi Gagal");
            $this->session->set_flashdata("notif","Akun gagal diaktifasi");
            redirect(site_url('instansi/pengguna/'));
        }
	}

	public function decline($id = null){
		// print_r($id);
		$data_p['status'] = 2;
		$password = $this->generate();
		// $data_p['password'] = sha1($password);
		$this->load->helper('email_send_helper');
        if ($this->db->update('tb_pengguna',$data_p,array('id_pengguna'=>$id))) {
        	$userData = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id))->row_array();
            $data['email_from'] = 'support@IDREN';
            $data['name_from'] = 'IDREN support';
            $data['email_to'] = $userData['email'];
            $data['subject'] = 'Konfirmasi Akun';
            $data['content'] = 'Akun Anda Telah di Tolak oleh instansi';
            if (email_send($data) == true) {
                $user_data = 'success';
                $this->session->set_flashdata("header","Penolakan Berhasil");
                $this->session->set_flashdata("notif","Penolakan Akun berhasil dilakukan");
                redirect(site_url('instansi/pengguna'));
            }
        }else{
            $this->session->set_flashdata("header","Aktifasi Gagal");
            $this->session->set_flashdata("notif","Akun gagal diaktifasi");
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

    public function reset($id){

        $sql = $this->db->get_where('tb_pengguna',array('id_pengguna'=>$id));
        $mail = sha1($id);
        $user = $sql->row_array();
        $reset = $mail.$user['password'];
        $this->load->helper('email_send_helper');
        $data['email_from'] = 'support@IDREN';
        $data['name_from'] = 'IDREN support';
        $data['email_to'] = $user['email'];
        $data['subject'] = 'Request reset Password';
        $data['content'] = 'Ini Adalah link reset Password anda<br/>'.site_url('user/login_user/reset?data='.$reset);
        if (email_send($data) == true) {
            $this->db->update('tb_pengguna',array('reset'=>$reset),array('id_pengguna'=>$user['id_pengguna']));
            $user_data = 'success';
            $ret['status'] = 1;
            $this->session->set_flashdata("header","Request Reset Password Berhasil");
            $this->session->set_flashdata("notif","Email Request Reset Password berhasil dikirim ke E-mail anda, Silahkan kunjungi link yang kami berikan");
            // redirect(site_url('dashboard/reset_password'));
        }
        if ($user['id_role_ref'] == 0) {
            redirect(site_url('instansi/pengguna/list_mahasiswa'));
        }else{
            redirect(site_url('instansi/pengguna/list_dosen'));
        }
    }

    function report() {
        // $str = mb_convert_encoding($str, "SJIS","UTF-8");
        $objPHPExcel    = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        
        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);
        
        /*$header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FF0000'),
                'name' => 'Verdana'
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle("A1:D2")
                ->applyFromArray($header)
                ->getFont()->setSize(16);
        $wajib = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'FF0000'))),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FF0000')),'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'name' => 'Verdana'
            ));
        $sunah = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'5FBA7D'))));
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($wajib);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D2');*/
        $ex = $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No.')

            // ->setCellValue('A3', 'Email')
            // ->setCellValue('B3', 'Password')
            ->setCellValue('B1', 'user Dosen aktif')
            ->setCellValue('C1', 'user Dosen tidak aktif')
            ->setCellValue('D1', 'user Mahasiswa aktif')
            ->setCellValue('E1', 'user Mahasiswa tidak aktif');
            // ->setCellValue('D1', 'No. Hp');
            // ->setCellValue('F3', 'Last Rotasi Klinik');
        
        
        // $counter = 4;
        // foreach ($formSoal as $key => $row) :
            $jumlah_aktif_dosen = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>1))->num_rows();
            $jumlah_pasif_dosen = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>0))->num_rows();
            $jumlah_aktif_mahasiswa = $this->db->get_where('tb_pengguna',array('id_role_ref'=>0,'status'=>1))->num_rows();
            $jumlah_pasif_mahasiswa = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>0))->num_rows();
            $ex->setCellValue('A2', '1');
            $ex->setCellValue('B2', $jumlah_aktif_dosen);
            $ex->setCellValue('C2', $jumlah_pasif_dosen);
            $ex->setCellValue('D2', $jumlah_aktif_mahasiswa);
            $ex->setCellValue('E2', $jumlah_pasif_mahasiswa);
            
            // $counter = $counter+1;
        // endforeach;
        $objPHPExcel->getProperties()->setCreator("instansi")
            ->setLastModifiedBy("instansi")
            ->setTitle("Export PHPExcel Test Document")
            ->setSubject("Export PHPExcel Test Document")
            ->setDescription("Test doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("PHPExcel");
        $objPHPExcel->setActiveSheetIndex(0);
        foreach($objPHPExcel->getActiveSheet()->getColumnDimension() as $col) {
            $col->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->calculateColumnWidths();
        
        $objWriter  = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Last-Modified:'. gmdate("D, d M Y H:i:s").'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="RekabUser'. date('Ymd') .'.xlsx"');
        ob_end_clean();
        ob_start();
        $objWriter->save('php://output');  
        $objWriter->save('php://output');
    }
    function download_user() {
        // $select = $this->db->get('user')->result();
        
        $objPHPExcel    = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        
        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);
        
        $header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FF0000'),
                'name' => 'Verdana'
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle("A1:D2")
                ->applyFromArray($header)
                ->getFont()->setSize(16);
        $wajib = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'FF0000'))),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FF0000')),'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'name' => 'Verdana'
            ));
        $sunah = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'5FBA7D'))));
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($wajib);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D2');
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Form User')

            ->setCellValue('A3', 'Email')
            // ->setCellValue('B3', 'Password')
            ->setCellValue('B3', 'Nama')
            ->setCellValue('C3', 'Institusi')
            ->setCellValue('D3', 'No. Hp');
            // ->setCellValue('F3', 'Last Rotasi Klinik');
        
        

        $objPHPExcel->getProperties()->setCreator("instansi")
            ->setLastModifiedBy("instansi")
            ->setTitle("Export PHPExcel Test Document")
            ->setSubject("Export PHPExcel Test Document")
            ->setDescription("Test doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("PHPExcel");
        $objPHPExcel->setActiveSheetIndex(0);
        foreach($objPHPExcel->getActiveSheet()->getColumnDimension() as $col) {
            $col->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->calculateColumnWidths();
        
        $objWriter  = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Last-Modified:'. gmdate("D, d M Y H:i:s").'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Insert User'. date('Ymd') .'.xlsx"');
        
        $objWriter->save('php://output');
    }

    function hasil(){
        // $select = $this->db->get('user')->result();
        
        $objPHPExcel    = new PHPExcel();
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(35);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(17);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(25);
        
        $objPHPExcel->getActiveSheet()->getStyle(1)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(2)->getFont()->setBold(true);
        $objPHPExcel->getActiveSheet()->getStyle(3)->getFont()->setBold(true);
        
        /*$header = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FF0000'),
                'name' => 'Verdana'
            )
        );

        $objPHPExcel->getActiveSheet()->getStyle("A1:D2")
                ->applyFromArray($header)
                ->getFont()->setSize(16);
        $wajib = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'FF0000'))),'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'FF0000')),'font' => array(
                'bold' => true,
                'color' => array('rgb' => 'FFFFFF'),
                'name' => 'Verdana'
            ));
        $sunah = array('borders'=>array('allborders'=>array('style'=>PHPExcel_Style_Border::BORDER_THIN,'color'=>array('argb'=>'5FBA7D'))));
        $objPHPExcel->getActiveSheet()->getStyle('A3:D3')->applyFromArray($wajib);
        $objPHPExcel->getActiveSheet()->mergeCells('A1:D2');*/
        $ex = $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'No.')

            // ->setCellValue('A3', 'Email')
            // ->setCellValue('B3', 'Password')
            ->setCellValue('B1', 'user Dosen aktif')
            ->setCellValue('C1', 'user Dosen tidak aktif')
            ->setCellValue('D1', 'user Mahasiswa aktif')
            ->setCellValue('E1', 'user Mahasiswa tidak aktif');
            // ->setCellValue('D1', 'No. Hp');
            // ->setCellValue('F3', 'Last Rotasi Klinik');
        
        
        // $counter = 4;
        // foreach ($formSoal as $key => $row) :
            $jumlah_aktif_dosen = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>1))->num_rows();
            $jumlah_pasif_dosen = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>0))->num_rows();
            $jumlah_aktif_mahasiswa = $this->db->get_where('tb_pengguna',array('id_role_ref'=>0,'status'=>1))->num_rows();
            $jumlah_pasif_mahasiswa = $this->db->get_where('tb_pengguna',array('id_role_ref'=>1,'status'=>0))->num_rows();
            $ex->setCellValue('A2', '1');
            $ex->setCellValue('B2', $jumlah_aktif_dosen);
            $ex->setCellValue('C2', $jumlah_pasif_dosen);
            $ex->setCellValue('D2', $jumlah_aktif_mahasiswa);
            $ex->setCellValue('E2', $jumlah_pasif_mahasiswa);
            
            // $counter = $counter+1;
        // endforeach;
        $objPHPExcel->getProperties()->setCreator("instansi")
            ->setLastModifiedBy("instansi")
            ->setTitle("Export PHPExcel Test Document")
            ->setSubject("Export PHPExcel Test Document")
            ->setDescription("Test doc for Office 2007 XLSX, generated by PHPExcel.")
            ->setKeywords("office 2007 openxml php")
            ->setCategory("PHPExcel");
        $objPHPExcel->setActiveSheetIndex(0);
        foreach($objPHPExcel->getActiveSheet()->getColumnDimension() as $col) {
            $col->setAutoSize(true);
        }
        $objPHPExcel->getActiveSheet()->calculateColumnWidths();
        
        $objWriter  = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        header('Last-Modified:'. gmdate("D, d M Y H:i:s").'GMT');
        header('Chace-Control: no-store, no-cache, must-revalation');
        header('Chace-Control: post-check=0, pre-check=0', FALSE);
        header('Pragma: no-cache');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="RekabUser'. date('Ymd') .'.xlsx"');
        
        $objWriter->save('php://output');
    }
}