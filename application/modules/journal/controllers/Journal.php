<?php

class Journal extends MX_Controller
{
        var $idUser;
        var $data = array();

    function __construct()
    {
        
    }

    public function index(){
    	$sql = "SELECT * FROM tb_journal Where status = 2";
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
        $sql = "SELECT * FROM tb_journal WHERE status = 2 AND judul LIKE '%".$param."%'";
        $journal = $this->db->query($sql)->result_array();
        foreach ($journal as $key => $value) {
            $jumlah = $this->db->get_where('tb_volume',array('id_journal_ref'=>$value['id_journal']))->num_rows();
            $journal[$key]['jumlah'] = $jumlah;
        }
        $this->data['view'] = 'list';
        $this->data['journal'] = $journal;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/home_layout',$this->data);
    }

    public function detail_journal($id=null){
    	$sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref where j.status = 2 and j.id_journal = ".$id;
        $data = $this->db->query($sql,$id)->result_array();
        $this->data['journal'] = $data;
        $sql = "SELECT * FROM tb_journal where status = 2 order by id_journal asc limit 4";
        $last = $this->db->query($sql)->result_array();
        $this->data['last'] = $last;
        $this->ciparser->new_parse('template_journal','modules_journal','journal/detail_journal_layout',$this->data);
    }

}