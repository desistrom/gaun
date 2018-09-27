<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Event extends CI_Controller  {
	var $data = array();
	function __construct() {
        parent::__construct();
    }

    public function index(){
    	if (!empty($this->input->get('page'))) {
            $limit = ceil($this->input->get('page') * 4);
            $this->data['total'] = $this->db->get('tb_event')->num_rows();
            $this->data['total_row'] = $limit;
            $sql = "SELECT * FROM tb_event ORDER BY tgl_event ASC LIMIT ".$limit.",4";
            $this->data['page'] = $this->db->query($sql)->result_array();
            $result = $this->load->view('looping_event',$this->data);
            echo json_encode($result);
        }else{
            $limit = 0;
            $this->data['total'] = $this->db->get('tb_event')->num_rows();
            $this->data['total_row'] = $limit;
            $sql = "SELECT * FROM tb_event ORDER BY tgl_event ASC LIMIT ".$limit.",4";
            $this->data['page'] = $this->db->query($sql)->result_array();
    	   $this->ciparser->new_parse('template_frontend','modules_web', 'event_layout',$this->data);
        }
    	// $this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    }

    public function detail_event($id){
    	$sql = "SELECT * FROM tb_event where id_event = ?";
        $profit = $this->db->query($sql,$id)->row_array();
        // $profit['picture'] = $this->db->query($sql)->row_array()['picture_profit'];
        // $ret['code'] = '200';
        // $retData['status'] = 'Success';
        // if ($this->db->query($sql)->row_array()['picture_profit'] == '') {
        //     $profit['picture']='assets/images/logo/IDREN-2.png';
        // }else{
        //     $profit['picture']='media/'.$this->db->query($sql)->row_array()['picture_profit'];
        // }
        $this->data['event']=$profit;
        $this->ciparser->new_parse('template_frontend','modules_web', 'detail_event',$this->data);
    }

}