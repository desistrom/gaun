<?php

class Journal extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {

    }

    public function add_slug(){
         $data = $this->db->get('tb_journal')->result_array();
    foreach ($data as $key => $value) {
             $data_j['slug'] = $this->slugify($value['judul']);
             $this->db->update('tb_journal',$data_j,array('id_journal'=>$value['id_journal']));
         }
     }

    public static function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

    public function index(){
    	$sql = "SELECT * FROM tb_journal Where status = 2 limit 12";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/home_layout',$this->data);
    }

    public function katalog($param=null){
        $sql = "SELECT * FROM tb_journal WHERE status = 2 AND judul LIKE '".$param."%'";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->data['param'] = strtoupper($param);
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/katalog_layout',$this->data);
    }

    public function search($param=null){
        $sql = "SELECT * FROM tb_journal WHERE status = 2 AND judul LIKE '%".$param."%' limit 12";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/home_layout',$this->data);
    }

    public function kategori($param=null){
        $sql = "SELECT * FROM tb_kategori_journal k join tb_journal j on k.id_kategori = j.id_kategori_ref WHERE j.status = 2 AND k.nama = '".$param."'";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/home_layout',$this->data);
    }

    public function detail_journal_back($id=null){
    	$sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref where j.status = 2 and j.id_journal = ".$id;
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['journal'] = $data;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_journal_layout',$this->data);
    }

    public function detail_journal($slug=null){
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref where j.status = 2 and j.slug = '".$slug."'";
        $data = $this->db->query($sql)->result_array();
        $this->data['journal'] = $data;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_journal_layout',$this->data);
    }

    public function detail_volume($id=null)
    {
    	$sql = 'SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref where id_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['journal'] = $data;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_volume_layout',$this->data);
    }

    public function detail_no_volume($id=null)
    {
    	$sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['journal'] = $data;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_no_volume_layout',$this->data);
    }

    public function detail_artikel($id = null){
    	$sql = "SELECT *, j.judul as journal FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_artikel = ?";
        $artikel = $this->db->query($sql,$id)->row_array();

        $sql_author = 'SELECT * FROM tb_author where id_artikel_ref = ?';
        $author = $this->db->query($sql_author,$id)->result_array();
        $this->data['journal'] = $artikel;
        $this->data['author'] = $author;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $sql = 'SELECT *, a.judul as artikel, j.status as jstatus FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref join tb_artikel a ON n.id_no_volume = a.id_no_volume_ref where id_no_volume = ?';
        $no_vol = $this->db->query($sql,$artikel['id_no_volume'])->result_array();
        $this->data['no_vol'] = $no_vol;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_artikel_layout',$this->data);
    }

    public function downloads($id=null){
        $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();

        $data['total'] = $art['total'] + 1;
        $data['anonym'] = $art['anonym'] + 1;
        $data['total_download'] = $art['total_download'] + 1;
        $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
        redirect(site_url('assets/file/'.$art['file']));
    }

    public function downloads_abs($id=null){
        $art = $this->db->get_where('tb_artikel',array('id_artikel'=>$id))->row_array();

        $data['anonym_abs'] = $art['anonym_abs'] + 1;
        $data['total_abs'] = $art['total_abs'] + 1;
        $data['total_download'] = $art['total_download'] + 1;
        $this->db->update('tb_artikel',$data,array('id_artikel'=>$id));
        redirect(site_url('assets/file/'.$art['abstract_file']));
    }

    public function logins($id=null){
        $this->session->set_flashdata('lgn','1');
        // print_r($id);
        // return false;
        if ($id == 1) {
            redirect(site_url('user/login_user'));
        }else{
            redirect(site_url('user/login_user/login_mahasiswa'));
        }
    }

    public function loadmore($limit,$ofset){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where j.status = 2 limit ".$limit.",".$ofset;
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $html = '';
        foreach ($journal as $key => $value) {
            $html .= '<div class="col col-md-2 col-sm-4 col-xs-12 filter-box-jurnal" >
                        <div class="box-jurnal" >
                            <div class="box-header">
                                <img class="img-responsive thumbnail-jurnal" src="'.base_url().'assets/media/'.$value['futured_image'].'">
                            </div>
                            <div class="box-body">
                                <h5><a href="'.site_url('journal/detail_journal/'.$value['slug']).'">'.$value['judul'].'</a></h5>
                                <h5>Jumlah Volume : '.$value['jumlah'].'</h5>
                            </div>
                            <a href="'.site_url('journal/detail_journal/'.$value['slug']).'" class="link_detail"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        </div>
                    </div>';
        }

        echo json_encode($html);
    }

    public function loadmore_search($id=null,$limit,$ofset){
        $sql = "SELECT j.* FROM tb_journal j join tb_pengguna p on j.id_user_ref = p.id_pengguna Where j.status = 2 and judul LIKE '%".$id."%' limit ".$limit.",".$ofset;
        $journal = $this->db->query($sql,$id)->result_array();
        $html = '';
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        foreach ($journal as $key => $value) {
            $html .= '<div class="col col-md-2 col-sm-4 col-xs-12 filter-box-jurnal" >
                        <div class="box-jurnal" >
                            <div class="box-header">
                                <img class="img-responsive thumbnail-jurnal" src="'.base_url().'assets/media/'.$value['futured_image'].'">
                            </div>
                            <div class="box-body">
                                <h5><a href="'.site_url('journal/detail_journal/'.$value['slug']).'">'.$value['judul'].'</a></h5>
                                <h5>Jumlah Volume : '.$value['jumlah'].'</h5>
                            </div>
                            <a href="'.site_url('journal/detail_journal/'.$value['slug']).'" class="link_detail"><i class="fa fa-arrow-circle-o-right" aria-hidden="true"></i></a>
                        </div>
                    </div>';
        }

        echo json_encode($html);
    }


}