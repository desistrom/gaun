<?php

class Keanggotaan_model extends CI_Model 
{
    var $table = 'tb_instansi';
    var $column_order = array(null, 'nm_jenis_instansi','nm_instansi','email','status','sort','is_aktif',null); //set column field database for datatable orderable
    var $column_search = array('nm_jenis_instansi','nm_instansi','email','status','sort','is_aktif'); //set column field database for datatable searchable 
    var $order = array('id_instansi' => 'asc'); // default order 
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
    }
 
    private function _get_datatables_query($id)
    {
         // $sql = "SELECT * FROM tb_instansi i LEFT join tb_jenis_instansi j on i.id_jenis_instansi = j.id_jenis_instansi";
        $this->db->from($this->table);
        $this->db->join('tb_jenis_instansi', 'tb_instansi.id_jenis_instansi = tb_jenis_instansi.id_jenis_instansi','left');
        $this->db->where('status = ', 2);
        $this->db->where('tb_jenis_instansi.id_jenis_instansi = ',$id);
 
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
        $this->db->where('status = ', 2);
        return $query->num_rows();
    }
 
    public function count_all($id)
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    private function _get_datatables_query_request($id)
    {
         // $sql = "SELECT * FROM tb_instansi i LEFT join tb_jenis_instansi j on i.id_jenis_instansi = j.id_jenis_instansi";
        $this->db->from($this->table);
        $this->db->join('tb_jenis_instansi', 'tb_instansi.id_jenis_instansi = tb_jenis_instansi.id_jenis_instansi','left');
        $this->db->where('status != ', 2);
        $this->db->where('tb_jenis_instansi.id_jenis_instansi = ',$id);
 
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
 
    function get_datatables_request($id)
    {
        $this->_get_datatables_query_request($id);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
 
    function count_filtered_request($id)
    {
        $this->_get_datatables_query_request($id);
        $query = $this->db->get();
        return $query->num_rows();
    }
 
    public function count_all_request()
    {
        $this->db->from($this->table);
        $this->db->where('status != ', 2);
        return $this->db->count_all_results();
    }
   
}