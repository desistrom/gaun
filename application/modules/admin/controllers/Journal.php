<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Journal extends MX_Controller  {

	var $data = array();

	public function __construct(){
        if(!isset($_COOKIE['data_admin']) || decode_token_jwt($_COOKIE['data_admin']) != true){
            redirect(site_url('login'));
        }
		// $this->load->model('home_model');
	}

	public function index(){
		$this->data['kategori'] = $this->db->get('tb_kategori_journal')->result_array();
		$this->data['view'] = 'list';
		$this->data['breadcumb'] = 'List Kategori Journal';
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function add(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori journal', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$datakat['nama'] = $this->input->post('kategori');
				if ($this->db->insert('tb_kategori_journal',$datakat)) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/journal/');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Add Kategori journal';
		$this->data['view'] = 'add';
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function edit(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$ret['state'] = 0;
			$ret['status'] = 0;
			$this->form_validation->set_error_delimiters('','');
			$this->form_validation->set_rules('kategori','Kategori journal', 'trim|required');
			if ($this->form_validation->run() == true) {
				$ret['state'] = 1;
				$data_email['nama'] = $this->input->post('kategori');
				if ($this->db->update('tb_kategori_journal',$data_email,array('id_kategori'=>$id))) {
					$ret['status'] = 1;
					$this->session->set_flashdata("notif","Data Berhasil di Masukan");
					$ret['url'] = site_url('admin/journal/index');
				}
			}
			$ret['notif']['kategori'] = form_error('kategori');
			$ret['notif']['kategori'] = form_error('kategori');

			echo json_encode($ret);
			exit();
		}
		$this->data['breadcumb'] = 'Edit Kategori journal';
		$this->data['view'] = 'edit';
		$this->data['kategori'] = $this->db->get_where('tb_kategori_journal',array('id_kategori'=>$id))->row_array();
		$this->ciparser->new_parse('template_admin','modules_admin', 'journal/master_journal_layout',$this->data);
	}

	public function delete(){
		$url = $this->uri->segment_array();
		$id = end($url);
		if ($this->db->get_where('tb_journal',array('id_kategori_ref'=>$id))->num_rows() > 0) {
			$ret['status'] = 0;
			$ret['notifikasi'] = "Kategori ini Memiliki data yang terkait, harap hapus data tersebut";
			$this->session->set_flashdata("notif","Kategori ini Memiliki data yang terkait, harap hapus data tersebut");
			$this->session->set_flashdata("header","Gagal");
		}else{
			if ($this->db->delete('tb_kategori_journal',array('id_kategori'=>$id))) {
				$this->session->set_flashdata("notif","Data Berhasil di Delete");
				$ret['status'] = 1;
				// redirect(site_url('admin/email/kategori'));
			}else{
				$ret['status'] = 0;
				$this->session->set_flashdata("notif","Data Gagal di Delete");
				$this->session->set_flashdata("header","Gagal");
				$ret['notifikasi'] = "Kategori Gagal di hapus";
			}
		}
		echo json_encode($ret);
	}

	public function report_download(){
        // print_r($this->session->userdata('data_user'));
        $slq_journal = "SELECT SUM(download_1) as download_1, SUM(download_2) as download_2, SUM(download_3) as download_3, SUM(download_4) as download_4, SUM(download_5) as download_5, SUM(anonym) as anonym, sum(total_download) as total_download FROM tb_journal";
        $sum_journal = $this->db->query($slq_journal)->row_array();
        if (is_null($sum_journal['anonym']) || $sum_journal['anonym'] == '') {
            $sum_journal['anonym'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sum_journal['download_'.$i]) || $sum_journal['download_'.$i] == '') {
                $sum_journal['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sum_journal['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        $slq_artikel = "SELECT SUM(download_1) as download_1, SUM(download_2) as download_2, SUM(download_3) as download_3, SUM(download_4) as download_4, SUM(download_5) as download_5, SUM(anonym) as anonym, sum(total_download) as total_download FROM tb_artikel";
        $sum_artikel = $this->db->query($slq_artikel)->row_array();
        if (is_null($sum_artikel['anonym']) || $sum_artikel['anonym'] == '') {
            $sum_artikel['anonym'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sum_artikel['download_'.$i]) || $sum_artikel['download_'.$i] == '') {
                $sum_artikel['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sum_artikel['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        $this->data['sum_artikel'] = $sum_artikel;
        
        $this->data['sum_journal'] = $sum_journal;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin','modules_admin', 'journal/download_journal_layout',$this->data);
    }

    public function report_download_journal($id=null){
        

        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_journal = ?";
        $journal = $this->db->query($sql,$id)->row_array();
        // if (is_null($journal['university']) || $journal['university'] == '') {
        //     $journal['university'] = 0;
        // }
        // if (is_null($journal['goverment']) || $journal['goverment'] == '') {
        //     $journal['goverment'] = 0;
        // }
        // if (is_null($journal['business']) || $journal['business'] == '') {
        //     $journal['business'] = 0;
        // }
        // if (is_null($journal['media']) || $journal['media'] == '') {
        //     $journal['media'] = 0;
        // }
        if (is_null($journal['anonym']) || $journal['anonym'] == '') {
            $journal['anonym'] = 0;
        }
        if (is_null($journal['total_download']) || $journal['total_download'] == '') {
            $journal['total_download'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($journal['download_'.$i]) || $journal['download_'.$i] == '') {
                $journal['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $journal['nama_'.$i] = $nama['nm_jenis_instansi'];
        }
        // print_r($journal['total_download']);
        $this->data['journal'] = $journal;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_admin','modules_admin', 'journal/download_artikel_layout',$this->data);
    }

    public function report_download_artikel($id=null){
        $sql = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        if (is_null($sql['anonym']) || $sql['anonym'] == '') {
            $sql['anonym'] = 0;
        }
        if (is_null($sql['total']) || $sql['total'] == '') {
            $sql['total'] = 0;
        }
        if (is_null($sql['anonym_abs']) || $sql['anonym_abs'] == '') {
            $sql['anonym_abs'] = 0;
        }
        if (is_null($sql['total_abs']) || $sql['total_abs'] == '') {
            $sql['total_abs'] = 0;
        }
        if (is_null($sql['total_download']) || $sql['total_download'] == '') {
            $sql['total_download'] = 0;
        }
        for ($i=1; $i < 6; $i++) { 
            if (is_null($sql['download_'.$i]) || $sql['download_'.$i] == '') {
                $sql['download_'.$i] = 0;
            }
            $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array();
            $sql['nama_'.$i] = $nama['nm_jenis_instansi'];
            if (is_null($sql['downloadabs_'.$i]) || $sql['downloadabs_'.$i] == '') {
                $sql['downloadabs_'.$i] = 0;
            }
            // $nama = $this->db->get_where('tb_jenis_instansi',array('id_jenis_instansi'=>$i))->row_array()
            $sql['namaabs_'.$i] = $nama['nm_jenis_instansi'];
        }
        $this->data['artikel'] = $sql;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin','modules_admin', 'journal/detail_report_download_layout',$this->data);
    }

    public function ajax_list_journal_download()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_download();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
            $button = '<a href="'.site_url('admin/journal/report_download_journal').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            if ($news->total_download == '' || is_null($news->total_download)) { $total = 0; }else{ $total = $news->total_download;}
            $row[] = $total;
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_download(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_download(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_artikel($id=null)
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        foreach ($list as $news) {
        $button = '';
        $btn_ign = '';
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = '<div class="btn-detail" id="'.$news->id_artikel.'" style="cursor:pointer;"><u>'.word_limiter($news->judul,10).' <i class="fa fa-external-link" aria-hidden="true"></i></u></div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            if ($news->total_download == '' || is_null($news->total_download)) { $total = 0; }else{ $total = $news->total_download;}
            $row[] = $total;
            $button = '<a href="'.site_url('admin/journal/report_download_artikel').'/'.$news->id_artikel.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row[] = $button;
            // $row[] = $aktif;
            // $row[] = $btn_ign.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered($id),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}