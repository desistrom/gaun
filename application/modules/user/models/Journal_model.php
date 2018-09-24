<?php

class Journal_model extends CI_Model 
{
    var $table = 'tb_journal';
    var $column_order = array(null, 'issn','judul','deskripsi'); //set column field database for datatable orderable
    var $column_search = array('issn','judul','deskripsi'); //set column field database for datatable searchable 
    var $order = array('issn' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
 
    private function _get_datatables_query()
    {
        $user = $this->session->userdata('data_user');
        $sql = "SELECT * FROM tb_journal j JOIN tb_volume v ON j.id_journal = v.id_journal_ref JOIN tb_no_volume n ON v.id_volume = n.id_volume_ref JOIN tb_artikel a ON n.id_no_volume = a.id_no_volume_ref JOIN tb_author au ON a.id_artikel = au.id_artikel_ref";
        $this->db->query($sql);
        $this->db->from($this->table);
        $this->db->join('tb_volume', 'id_journal = id_journal_ref');
        $this->db->join('tb_no_volume', 'id_volume = id_volume_ref');
        $this->db->join('tb_artikel', 'id_no_volume = id_no_volume_ref');
        $this->db->join('tb_author', 'id_artikel = id_artikel_ref');
        // $this->db->where('id_instansi_ref', $user['id_instansi']);
 
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
 
    function get_datatables()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
   
}