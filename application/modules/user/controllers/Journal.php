<?php

class Journal extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
        // $this->load->model('login_model');
        /*$this->load->helper('api');
        $this->load->library('Recaptcha');
        $this->load->module('Token');*/
        $this->load->model('journal_model');
        $data = $this->session->userdata('user');
        // print_r($data);
        $tb = '';
        if ($this->db->get_where('tb_pengguna',array('id_pengguna'=>$data))->row_array()['id_role_ref'] == 0) {
            // $user = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$data))->row_array();
            $tb = 'tb_mahasiswa';
        }else{
            // $user = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$data))->row_array();
            $tb = 'tb_dosen';
        }
        $sql = 'select * from tb_pengguna p join '.$tb.' d on p.id_pengguna = d.id_pengguna_ref where id_pengguna = ?';
        $user = $this->db->query($sql,$data)->row_array();
        $this->data['user'] = $user;
    }

    public function index(){
        
        // $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref JOIN tb_author au ON a.id_artikel = au.id_artikel_ref";
        // $journal = $this->db->query($sql)->result_array();
        // print_r($journal);
        // $list = $this->journal_model->get_datatables();
        // print_r($list);
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function add(){
        if ($this->input->server('REQUEST_METHOD') == "POST") {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('judul', 'Judul Journal', 'trim|required');
            $this->form_validation->set_rules('content', 'Deskripsi Journal', 'trim|required');
            $this->form_validation->set_rules('issn', 'ISSN Journal', 'trim|required');
            
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_news['judul_event'] = $this->input->post('judul');
                $data_news['deskripsi_event'] = $this->input->post('content');
                $data_news['tempat_event'] = $this->input->post('tempat');
                $data_news['tgl_event'] = $this->input->post('tgl_event');
                $data_news['start_event'] = $this->input->post('start_event');
                $data_news['end_event'] = $this->input->post('end_event');
                $data_news['id_instansi_ref'] = $this->session->userdata('data_user')['id_instansi'];
                // $data_news['link'] = url_title($this->input->post('judul'), 'dash', true);
                if (isset($_FILES['file_name'])) {
                    $image = $this->upload_logo($_FILES);
                    if (isset($image['error'])) {
                        $ret['notif'] = $image;
                    }else{
                        $ret['state'] = 1;
                        $data_news['futured_image'] = $image['asli'];
                        if ($this->db->insert('tb_event',$data_news)) {
                            $ret['status'] = 1;
                            $ret['url'] = site_url('instansi/event');
                            $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                        }
                    }
                }else{
                    $ret['state'] = 1;
                    // $data_news['img'] = $image['asli'];
                    if ($this->db->insert('tb_event',$data_news)) {
                        $ret['status'] = 1;
                        $ret['url'] = site_url('instansi/event');
                        $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                    }
                }
            }
            $ret['notif']['judul'] = form_error('judul');
            $ret['notif']['content'] = form_error('content');
            $ret['notif']['tempat'] = form_error('tempat');
            $ret['notif']['tgl_event'] = form_error('tgl_event');
            $ret['notif']['start_event'] = form_error('start_event');
            $ret['notif']['end_event'] = form_error('end_event');
            if (!isset($_FILES['file_name'])) {
             $ret['notif']['file_name'] = "Please Select File";
            }
            echo json_encode($ret);
            exit();
        }
        $this->load->library('ckeditor');
        $this->ckeditor->basePath = base_url().'assets/ckeditor/';
        /*$this->ckeditor->config['toolbar'] = array(
                        array( 'Source', '-', 'Bold', 'Italic', 'Underline', '-','Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo','-','NumberedList','BulletedList','Link' )
                                                            );*/
        $this->ckeditor->config['language'] = 'eng';
        $this->ckeditor->config['width'] = '656px';
        $this->ckeditor->config['height'] = '300px'; 
        $this->data['view'] = 'add';
        $this->ciparser->new_parse('template_user','modules_user', 'journal_layout',$this->data);
    }

    public function ajax_list()
    {
        
        $list = $this->journal_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $no++;
            if ($news->status == 1) {
                $aktif = '<span class="text-success">Enable</span>';
                $button = '<a href="'.site_url("user/journal/Edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }else{
                $aktif = '<span class="text-Success">Disable</span>';
                $button = '<a href="'.site_url("user/journal/edit").'/'.$news->id_journal.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
            $row = array();
            $row[] = $no;
            $row[] = '<div class="comment" id="'.$news->id_journal.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="comment" id="'.$news->id_journal.'">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 10);
            $row[] = $news->visitor;
            $row[] = $aktif;
            $row[] = $button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all(),
                        "recordsFiltered" => $this->journal_model->count_filtered(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function upload(){
        $config['upload_path']          = FCPATH.'./assets/file/';
        $config['allowed_types']        = 'pdf|doc|docx';

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('surat'))
        {
                // $error = array('error' => $this->upload->display_errors());

            return $this->upload->display_errors();
        }
        else
        {
            return $this->upload->data('file_name');
        }
    }
}