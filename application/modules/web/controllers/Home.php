<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Home extends CI_Controller  {


    function __construct() {
        parent::__construct();
        $this->load->helper('api');
    }

    function index() {
        $url = URL_GET_HERO;
        $methode = 'GET';
        $token = '';
        $a = api_helper('',$url,$methode,$token);

        // $url_layanan =  site_url('api/v1/getlayanan_idroam') ;
        // $b = api_helper('',$url_layanan,$methode,$token);

        $url_instansi = URL_GET_ALL_INSTANSI;
        $c = api_helper('',$url_instansi,$methode,$token);
        
        
        $url_testi = URL_GET_TESTIMONI;
        $d = api_helper('',$url_testi,$methode,$token);

         $url_titleslider = URL_GET_AKADEMISI_TITLE;
        $e = api_helper('',$url_titleslider,$methode,$token);


        // $url = "http://192.168.88.138/idren/api/v1/about";
        // $a = json_decode($this->hit_api($url),true);
        $this->data['hero']=$a['data'];
        // $this->data['layanan']=$b['data'];
        $this->data['instansi']=$c['data'];
        $this->data['testimoni']=$d['data'];
        $this->data['title_slider']=$e['data'];
        $this->data['penta'] = $this->db->get_where('tb_pentahelix',array('jenis'=>1))->row_array();
        $this->data['helix'] = $this->db->query('SELECT * FROM tb_jenis_instansi order by nm_jenis_instansi asc')->result_array();

        $this->data['kolaborasi'] = $this->db->get_where('tb_layanan',array('kategori'=>3))->row_array();

    	$this->ciparser->new_parse('template_frontend','modules_web', 'home_layout',$this->data);
    }

    public function insert_user(){
        if ($this->input->server('REQUEST_METHOD') == 'POST') {
            $ret['state'] = 0;
            $ret['status'] = 0;
            $this->form_validation->set_error_delimiters('','');
            $this->form_validation->set_rules('name','Nama Lengkap','trim|required');
            $this->form_validation->set_rules('username','Username','trim|required');
            $this->form_validation->set_rules('password','Passowrd','trim|required');
            $this->form_validation->set_rules('repassword','Re - Passowrd','trim|required|matches[password]');
            $this->form_validation->set_rules('email','email','trim|required');
            $this->form_validation->set_rules('phone','phone','trim|required');
            $this->form_validation->set_rules('instansi','Instansi','trim|required');
            if ($this->form_validation->run() == true) {
                $ret['state'] = 1;
                $data_input = $this->input->post();
                $data_user['name'] = $data_input['name'];
                $data_user['username'] = $data_input['username'];
                $data_user['password'] = sha1($data_input['password']);
                $data_user['email'] = $data_input['email'];
                $data_user['number_phone'] = $data_input['phone'];
                $data_user['institusi'] = $data_input['instansi'];
                $url = base_url()."/api/v1/insert_user";
                $methode = "POST";
                if (api_helper(json_encode($data_user),$url,$methode,'')) {
                    $ret['status'] = 1;
                    $ret['url'] = site_url('admin/keanggotaan');
                    $this->session->set_flashdata("notif","Data Berhasil di Masukan");
                }
            }
            $ret['notif']['name'] = form_error('name');
            $ret['notif']['username'] = form_error('username');
            $ret['notif']['password'] = form_error('password');
            $ret['notif']['repassword'] = form_error('repassword');
            $ret['notif']['email'] = form_error('email');
            $ret['notif']['phone'] = form_error('phone');
            $ret['notif']['instansi'] = form_error('instansi');
            echo json_encode($ret);
            exit();
        }
    }

}
