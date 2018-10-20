<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Event extends MX_Controller  {
	var $data = array();
	function __construct(){
        if(!isset($_COOKIE['data_admin']) || decode_token_jwt($_COOKIE['data_admin']) != true){
            redirect(site_url('login'));
        }
		$this->load->model('news_model');
	}
	public function index(){
		// $rss = file_get_contents('https://rss.kontan.co.id/news/analisis');
		// echo $rss;
		// return false;
		$this->data['view'] = 'list';
		// $sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news where id_instansi_ref IS NULL";
		// $this->data['news'] = $this->db->query($sql)->result_array();
		$this->data['breadcumb'] = 'List Event';
		$this->ciparser->new_parse('template_admin','modules_admin', 'news/event_layout',$this->data);
	}

	public function status(){
		if ($this->input->server('REQUEST_METHOD') == 'POST') {
			$id = $this->input->post('id');
			/*print_r($id);
			return false;*/
			if ($this->db->get_where('tb_event',array('id_event'=>$id))->row_array()['is_aktif'] == 1) {
				$this->db->update('tb_event',array('is_aktif'=>0),array('id_event'=>$id));
				$this->session->set_flashdata("notif","Event Berhasil di Non Aktifkan");
			}else{
				$this->db->update('tb_event',array('is_aktif'=>1),array('id_event'=>$id));
				$this->session->set_flashdata("notif","Event Berhasil di Aktifkan");
			}
			echo json_encode("finish");
			exit();
		}
	}

    public function ajax_list()
    {
        $this->load->model('event_model');
        $list = $this->event_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $event) {
            $no++;
            if ($event->is_aktif == 1) {
                $aktif = '<span class="text-success">Enable</span>';
                $button = '<button class="btn btn-default btn-sm btn_status" id="'.$event->id_event.'"> <span class="text-danger">Disable</span> </button>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<button class="btn btn-default btn-sm btn_status" id="'.$event->id_event.'"> <span class="text-danger">Enable</span> </button>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$event->id_event.'">'.$event->judul_event.'</div>';
            $row[] = word_limiter($event->deskripsi_event, 5);
            $row[] = $event->tempat_event;
            $row[] = $event->tgl_event;
            $row[] = $event->start_event.' - '.$event->end_event;
            $row[] = $event->nm_instansi;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->event_model->count_all(),
                        "recordsFiltered" => $this->event_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

	
}