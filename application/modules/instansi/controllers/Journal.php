<?php 

/**
* 
*/
class Journal extends MX_Controller
{
        var $idUser;
        var $data = array();
        var $user = array();
    function __construct()
    {
    	// $this->load->model('login_model');
        // $this->load->helper('api');
        // $this->load->library('Recaptcha');
        // $this->load->module('Token');
        if(!isset($_COOKIE['data_instansi']) || decode_token_jwt($_COOKIE['data_instansi']) != true){
            redirect(site_url('instansi/login'));
        }
    }

    public function index(){
        // $user = $this->session->userdata('data_user');
        // print_r($user);
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'Journal';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'list_journal_layout',$this->data);
    }

    public function artikel($id){
        $this->data['user']['nama'] = '';
        $this->data['breadcumb'] = 'List Artikel';
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'journal_layout',$this->data);
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
        if ($input['status'] == 1) {
            if($this->db->update('tb_artikel',array('status'=>1),array('id_artikel'=>$input['id']))){
                $ret['url'] = 'instansi/journal/artikel/'.$id;
                $this->session->set_flashdata('notif','Artikel berhasil disetujui'); 
                $this->session->set_flashdata('header','Sukes'); 
            }else{
                $this->session->set_flashdata('notif','Artikel gagal disetujui'); 
                $this->session->set_flashdata('header','Gagal');
            }
        }else{
            if($this->db->update('tb_artikel',array('status'=>2,'reason'=>$input['reason']),array('id_artikel'=>$input['id']))){
                $ret['url'] = site_url().'instansi/journal/artikel/'.$id;
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

    public function ajax_list($id)
    {
        $this->load->model('journal_model');
        $list = $this->journal_model->get_datatables($id);
        $data = array();
        $no = $_POST['start'];
        $aktif = '';
        $button = '';
        foreach ($list as $news) {
            $aktif = '';
        $button = '';
        $aktif = '';
            $no++;
            if ($news->status==1) {
                $aktif = '<span class="text-success"><b>Accepted</b></span>';                
            }else{
                if($news->status == 0){
                    $aktif = '<span class="text-defafult"><b>Pending</b></span>';
                }else{
                    $aktif = '<span class="text-danger"><b>Ignored</b></span>';
                }
                $button = '<button class="btn btn-info btn-sm btn-acc" id="'.$news->id_artikel.'" data-toggle="tooltip" title="accept"><i class="fa fa-check"></i> Accepted</button> <button class="btn btn-danger btn-sm btn-ign" id="'.$news->id_artikel.'" data-toggle="tooltip" title="Ignore"><i class="fa fa-times"></i> Ignored</button>';
            }
            $button .= ' <button class="btn btn-success btn-sm btn-detail" id="'.$news->id_artikel.'"><i class="fa fa-eye"></i> Detail</button>';
            $row = array();
            $row[] = $no;
            $row[] = '<div class="detail" id="'.$news->id_artikel.'">'.word_limiter($news->judul,10).'</div>';
            $row[] = $news->volume;
            $row[] = $news->nomor;
            // $row[] = $news->judul_journal;
            $row[] = $aktif;
            $row[] = $button;
 
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
            $button = '';
        $btn = '';
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
                $button = '<a href="'.site_url('instansi/journal/artikel').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
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

    /*public function all_journal(){
        
        $sql = "SELECT * FROM tb_journal Where status = 2";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['breadcumb'] = 'All Journal';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_instansi','modules_user', 'all_journal_layout',$this->data);
    }

    public function katalog($param=null){
        $sql = "SELECT * FROM tb_journal WHERE id_user_ref = 2 AND judul LIKE '".$param."%'";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['breadcumb'] = 'All Journal';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_instansi','modules_user', 'journal_layout',$this->data);
    }

    public function search($param=null){
        $sql = "SELECT * FROM tb_journal WHERE id_user_ref = 2 AND judul LIKE '%".$param."%'";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        // print_r($journal);
        $this->data['view'] = 'list';
        $this->data['breadcumb'] = 'All Journal';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_instansi','modules_user', 'journal_layout',$this->data);
    }*/

    public function report_download(){
        // print_r($this->session->userdata('data_user'));
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'download_journal_layout',$this->data);
    }

    public function report_download_journal($id=null){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where id_journal = ?";
        $journal = $this->db->query($sql,$id)->row_array();
        if (is_null($journal['university']) || $journal['university'] == '') {
            $journal['university'] = 0;
        }
        if (is_null($journal['goverment']) || $journal['goverment'] == '') {
            $journal['goverment'] = 0;
        }
        if (is_null($journal['business']) || $journal['business'] == '') {
            $journal['business'] = 0;
        }
        if (is_null($journal['media']) || $journal['media'] == '') {
            $journal['media'] = 0;
        }
        if (is_null($journal['comunity']) || $journal['comunity'] == '') {
            $journal['comunity'] = 0;
        }
        $this->data['journal'] = $journal;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->data['id'] = $id;
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'download_artikel_layout',$this->data);
    }

    public function report_download_artikel($id=null){
        $sql = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();
        if (is_null($sql['university']) || $sql['university'] == '') {
            $sql['university'] = 0;
        }
        if (is_null($sql['goverment']) || $sql['goverment'] == '') {
            $sql['goverment'] = 0;
        }
        if (is_null($sql['business']) || $sql['business'] == '') {
            $sql['business'] = 0;
        }
        if (is_null($sql['media']) || $sql['media'] == '') {
            $sql['media'] = 0;
        }
        if (is_null($sql['comunity']) || $sql['comunity'] == '') {
            $sql['comunity'] = 0;
        }
        if (is_null($sql['anonym']) || $sql['anonym'] == '') {
            $sql['anonym'] = 0;
        }
        if (is_null($sql['total']) || $sql['total'] == '') {
            $sql['total'] = 0;
        }
        if (is_null($sql['university_abs']) || $sql['university_abs'] == '') {
            $sql['university_abs'] = 0;
        }
        if (is_null($sql['goverment_abs']) || $sql['goverment_abs'] == '') {
            $sql['goverment_abs'] = 0;
        }
        if (is_null($sql['business_abs']) || $sql['business_abs'] == '') {
            $sql['business_abs'] = 0;
        }
        if (is_null($sql['media_abs']) || $sql['media_abs'] == '') {
            $sql['media_abs'] = 0;
        }
        if (is_null($sql['comunity_abs']) || $sql['comunity_abs'] == '') {
            $sql['comunity_abs'] = 0;
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
        $this->data['artikel'] = $sql;
        $this->data['breadcumb'] = 'Report Download';
        $this->data['view'] = 'list';
        $this->ciparser->new_parse('template_instansi','modules_instansi', 'detail_report_download_layout',$this->data);
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
            $button = '<a href="'.site_url('instansi/journal/report_download_journal').'/'.$news->id_journal.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
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
            $button = '<a href="'.site_url('instansi/journal/report_download_artikel').'/'.$news->id_artikel.'" class="btn btn-success btn-sm"><i class="fa fa-link"></i>Detail</a>';
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