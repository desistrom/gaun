<?php 

/**
* 
*/
class Admin extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
    	// $this->load->model('login_model');
        // $this->load->helper('api');
        // $this->load->library('Recaptcha');
        // $this->load->module('Token');
        if ($this->session->userdata('journal_login') != true) {
            redirect('journal/login');
        }
    }

    public function index(){
        
        $this->data['breadcumb'] = 'Journal';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_layout',$this->data);
    }

    public function dashboard(){
        $user = $this->session->userdata('data_user_journal');
        // print_r($user);
        $this->data['breadcumb'] = 'Journal';
        $ins = $this->db->get_where('tb_instansi',array('id_instansi'=>$user['id_instansi']))->row_array();
        $this->data['user']['nama'] = $ins['nm_instansi'];
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'dashboard_layout',$this->data);
    }

    public function artikel($id){
        $j = $this->db->get_where('tb_journal',array('id_journal'=>$id))->row_array();
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'List Artikel '.$j['judul'];
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_artikel_layout',$this->data);
    }

    public function detail_artikel($id){
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();

        $sql_author = 'SELECT * FROM tb_author where id_artikel_ref = ?';
        $author = $this->db->query($sql_author,$id)->result_array();
        $artikel['nama'] = '';
        foreach ($author as $key => $value) {
            $artikel['nama'] .= '<li>'.$value['nama'].'</li>';
            $artikel['nama'] .= '<li>'.$value['jabatan'].'</li>';
            $artikel['nama'] .= '<br>';
        }
        // print_r($artikel);
        echo json_encode($artikel);
    }

    public function response_artikel($id){
        $input = $this->input->post();
        // print_r($input);
        $data = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_journal = ?';
        if ($input['status'] == 1) {
            // $journal = $this->db->query($sql,$data['id_no_volume_ref'])->row_array();
            // $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_volume = ?';
            if($this->db->update('tb_artikel',array('status'=>1),array('id_artikel'=>$input['id']))){
                $artikel = $this->db->query($sql,$id)->num_rows();
                $sql .= ' AND a.status = 1';
                $aktif = $this->db->query($sql,$id)->num_rows();
                if ($artikel == $aktif) {
                    $this->db->update('tb_journal',array('status'=>2),array('id_journal'=>$id));
                }
                $ret['url'] = site_url('journal/admin/artikel/'.$id);
                $this->session->set_flashdata('notif','Artikel berhasil disetujui'); 
                $this->session->set_flashdata('header','Sukes'); 
            }else{
                $this->session->set_flashdata('notif','Artikel gagal disetujui'); 
                $this->session->set_flashdata('header','Gagal');
            }
        }else{
            if($this->db->update('tb_artikel',array('status'=>2,'reason'=>$input['reason']),array('id_artikel'=>$input['id']))){
                $artikel = $this->db->query($sql,$id)->num_rows();
                $sql .= ' AND a.status = 2';
                $aktif = $this->db->query($sql,$id)->num_rows();
                if ($artikel == $aktif) {
                    $this->db->update('tb_journal',array('status'=>3),array('id_journal'=>$id));
                }
                $ret['url'] = site_url('journal/admin/artikel/'.$id);
                // print_r($input);
                // return false;
                $this->session->set_flashdata('notif','Artikel berhasil ditolak'); 
                $this->session->set_flashdata('header','Sukes'); 
            }else{
                $this->session->set_flashdata('notif','Artikel gagal ditolak'); 
                $this->session->set_flashdata('header','Gagal');
            }
        }
        echo json_encode($ret);
    }

    public function accepted(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal Accepted';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_accepted_layout',$this->data);
    }

    public function rejected(){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal Accepted';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_admin_journal','modules_journal', 'list_journal_rejected_layout',$this->data);
    }

    public function reason($id=null){
        $a = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array()['reason'];
        echo json_encode($a);
    }

    public function ajax_list($id=null)
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
            if ($news->status==1) {
                $aktif = '<span class="text-success"><b>Accepted</b></span>';                
            }else{
                if($news->status == 0){
                    if ($news->reason != '') {
                        $aktif = '<span class="text-warning"><b>Repaired</b></span>';
                        $btn_ign = '<button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i> Ignored</button> ';
                    }else{
                        $aktif = '<span class="text-defafult"><b>Pending</b></span>';
                        $btn_ign = '<button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i> Ignored</button> ';
                    }
                    
                }else{
                    $aktif = '<span class="text-danger"><b>Ignored</b></span>';
                }
                $button = '<button class="btn btn-info btn-sm btn-acc" id="'.$news->id_artikel.'" data-toggle="tooltip" title="accept"><i class="fa fa-check"></i> Accepted</button>';
            }
            $button .= ' <button class="btn btn-success btn-sm btn-detail" id="'.$news->id_artikel.'"><i class="fa fa-eye"></i> Detail</button>';
            $button .= ' <button class="btn btn-warning btn-sm btn-reason" id="'.$news->id_artikel.'"><i class="fa fa-comment-o"></i> Reason</button>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            // $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $btn_ign.$button;
 
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

    public function ajax_list_journal()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-default">Pending</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal_accepted()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_accepted();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-default">Accepted</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_accepted(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_accepted(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }

    public function ajax_list_journal_rejected()
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables_journal_rejected();
        $data = array();
        $no = $_POST['start'];
        // $aktif = 'Pending';
        $button = '';
        $btn = '';
        foreach ($list as $news) {
            $no++;
        if ($news->status == 1) {
                $aktif = '<span class="text-danger">Rejected</span>';
            }else{
                if ($news->status == 2) {
                $btn = '<button class="btn btn-info btn-sm btn-hide" id="'.$news->id_journal.'" data-toggle="tooltip" title="accept"><i class="fa fa-eye"></i> Show</button>';
                $aktif = '<span class="text-Success">Aktif</span>';
                    # code...
                }
                // $button = '<a href="'.site_url("user/journal/artikel_edit").'/'.$news->id_artikel.'"><button class="btn btn-info btn-sm" id="edit" data-toggle="tooltip" title="Edit"><i class="fa fa-pencil"></i></button></a>';
            }
                $button = '<a href="'.site_url('journal/admin/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail">'.word_limiter($news->judul,10).'</div>';
            $row[] = '<div class="detail">'.$news->issn.'</div>';
            $row[] = word_limiter($news->deskripsi, 5);
            if ($news->futured_image != '') {
                $row[] = '<a class="futured_image" id="'.$news->id_journal.'">Image</a>';
                
            }else{
                $row[] = 'No Image';
            }
            if ($news->id_role_ref == 0) {
                $nama = $this->db->get_where('tb_mahasiswa',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }else{
                $nama = $this->db->get_where('tb_dosen',array('id_pengguna_ref'=>$news->id_pengguna))->row_array()['nama'];
            }
            $row[] = $nama;
            $row[] = $aktif;
            $row[] = $btn.$button;
 
            $data[] = $row;
        }
 
        $output = array(
                        "draw" => $_POST['draw'],
                        "recordsTotal" => $this->journal_model->count_all_journal_rejected(),
                        "recordsFiltered" => $this->journal_model->count_filtered_journal_rejected(),
                        "data" => $data,
                );
        //output to json format
        echo json_encode($output);
    }
}