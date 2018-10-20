<?php

class News_model extends CI_Model 
{
    var $table = 'tb_news';
    var $column_order = array(null, 'Judul','nm_kategori','link'); //set column field database for datatable orderable
    var $column_search = array('Judul','nm_kategori','link'); //set column field database for datatable searchable 
    var $order = array('id_news' => 'asc'); // default order 

    var $user = array();
 
    public function __construct()
    {
        parent::__construct();
        // $this->load->database();
        $this->user = data_jwt($_COOKIE['data_instansi']);
    }
 
    private function _get_datatables_query()
    {
        $user = $this->user->user;
         $sql = "SELECT * FROM tb_news n join tb_kategori_news k on n.id_kategori_ref = k.id_kategori_news";
        $this->db->from($this->table);
        $this->db->join('tb_kategori_news', 'id_kategori_news = id_kategori_ref');
        $this->db->where('id_instansi_ref', $user->id_instansi);
 
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

    public function news_comment($id){
        $sql = "SELECT n.judul, c.nama, c.email, c.content FROM tb_comment c JOIN tb_news n ON c.id_berita = n.id_news WHERE c.id_berita = ?";
        if ($this->db->query($sql,$id)->num_rows() > 0) {
            return $this->db->query($sql,$id)->result_array();
            exit();
        }
        return false;
    }
   
}