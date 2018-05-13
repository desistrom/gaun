<?php

class Keanggotaan_model extends CI_Model 
{
    var $table = 'tb_instansi';
    var $column_order = array(null, 'nm_instansi','nm_jenis_instansi'); //set column field database for datatable orderable
    var $column_search = array('nm_instansi','nm_jenis_instansi'); //set column field database for datatable searchable 
    var $order = array('id_instansi' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
 
    private function _get_datatables_query()
    {
         // $sql = "SELECT * FROM tb_instansi i LEFT join tb_jenis_instansi j on i.id_jenis_instansi = j.id_jenis_instansi";
        $this->db->from($this->table);
        $this->db->join('tb_jenis_instansi', 'tb_instansi.id_jenis_instansi = tb_jenis_instansi.id_jenis_instansi','left');
 
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