<?php

class Journal_model extends CI_Model 
{
    var $table = 'tb_artikel';
    var $column_order = array(null, 'judul','abstrak','keyword','references'); //set column field database for datatable orderable
    var $column_search = array('judul','abstrak','keyword','references'); //set column field database for datatable searchable 
    var $order = array('judul' => 'asc'); // default order 

    var $table_journal = 'tb_journal';
    var $column_order_journal = array(null, 'issn','judul','deskripsi','visitor'); //set column field database for datatable orderable
    var $column_search_journal = array('issn','judul','deskripsi','visitor'); //set column field database for datatable searchable 
    var $order_journal = array('judul' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
 
    private function _get_datatables_query($id)
    {
        // $user = $this->session->userdata('data_user');
         // $sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news";
        $this->db->select('tb_artikel.*,tb_volume.volume,tb_no_volume.nomor,tb_journal.judul as judul_journal');
        $this->db->from($this->table);
        $this->db->join('tb_no_volume', 'id_no_volume_ref = id_no_volume');
        $this->db->join('tb_volume', 'id_volume_ref = id_volume');
        $this->db->join('tb_journal', 'id_journal_ref = id_journal');
        $this->db->where('tb_journal.id_journal', $id);
 
        $i = 0;
     
        foreach ($this->column_search as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables($id)
    {
        $this->_get_datatables_query($id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered($id)
    {
        $this->_get_datatables_query($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    ###########################################################################################################################

    private function _get_datatables_query_journal()
    {
        $user = $this->session->userdata('data_user');
        // $sql = "SELECT * FROM tb_journal n join tb_pengguna k on n.id_user_ref = k.id_pengguna where id_instansi_ref = ?";
        // if ($this->db->query($sql,$user['id_instansi'])) {
        //     # code...
        // }
        // $this->db->select('tb_artikel.*,tb_volume.*,tb_no_volume.*,tb_journal.judul as judul_journal');
        $this->db->from($this->table_journal);
        $this->db->join('tb_pengguna', 'id_user_ref = id_pengguna');
        // $this->db->join('tb_pengguna', 'id_user_ref = id_pengguna');
        // $this->db->join('tb_volume', 'id_volume_ref = id_volume');
        // $this->db->join('tb_journal', 'id_journal_ref = id_journal');
        $this->db->where('tb_journal.status', '1');
        $this->db->where('tb_pengguna.id_instansi_ref', $user['id_instansi']);
 
        $i = 0;
     
        foreach ($this->column_search_journal as $item) // loop column 
        {
            if($_POST['search']['value']) // if datatable send POST for search
            {
                 
                if($i===0) // first loop
                {
                    $this->db->group_start(); // open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
                    $this->db->like($item, $_POST['search']['value']);
                }
                else
                {
                    $this->db->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search_journal) - 1 == $i) //last loop
                    $this->db->group_end(); //close bracket
            }
            $i++;
        }
         
        if(isset($_POST['order'])) // here order processing
        {
            $this->db->order_by($this->column_order_journal[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } 
        else if(isset($this->order))
        {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
 
    function get_datatables_journal()
    {
        $this->_get_datatables_query_journal();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_journal()
    {
        $this->_get_datatables_query_journal();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_journal()
    {
        $this->db->from($this->table_journal);
        return $this->db->count_all_results();
    }
   
}