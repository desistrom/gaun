<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Pentahelix extends MX_Controller  {
	var $data = array();
	function __construct(){
		$this->load->helper('api');
        $this->load->library('pagination');
	}
    function index() {
/*       $url = site_url('api/v1/profit') ;
        // $a = json_decode($this->api_helper($url),true);
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);
        $this->data['benefit']=$a['data'];*/
        $this->data['instansi'] = $this->db->query('SELECT * FROM tb_jenis_instansi ORDER BY nm_jenis_instansi ASC')->result_array();
        $this->data['penta'] = $this->db->get_where('tb_pentahelix',array('jenis'=>1))->row_array();
        $this->data['helix'] = $this->db->query('SELECT * FROM tb_pentahelix where jenis != 1 order by sort asc')->result_array();
        $this->ciparser->new_parse('template_frontend','modules_web', 'pentahelix_layout',$this->data);
    }
    
}


