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
        // print_r($_SERVER['SERVER_NAME']);
        $url = URL_GET_HERO;
        $methode = 'GET';
        $token = '';
        // $a = api_helper('',$url,$methode,$token);
        $sql = "SELECT title as judul, link_video as video, content as deskripsi FROM tb_hero";
        $hero = $this->db->query($sql)->row_array();

        // $url_layanan =  site_url('api/v1/getlayanan_idroam') ;
        // $b = api_helper('',$url_layanan,$methode,$token);

        $url_instansi = URL_GET_ALL_INSTANSI;
        // $c = api_helper('',$url_instansi,$methode,$token);
        $sql_instansi = "SELECT nm_instansi as instansi, id_instansi as id, phone as number_phone, website as link, alamat as address, gambar as image FROM tb_instansi where is_aktif = 1 AND status = 2 order by -sort DESC";
        $instansi = $this->db->query($sql_instansi)->result_array();
        foreach ($instansi as $key => $value) {
            if ($value['image'] == '') {
                $instansi[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $instansi[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                    $instansi[$key]['image'] = 'media/'.$value['image'];
                }else{
                    $instansi[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $instansi[$key]['image'] = 'media/'.$value['image'];
                }
            }                                                                                                                     
        }

        
        
        $url_testi = URL_GET_TESTIMONI;
        // $d = api_helper('',$url_testi,$methode,$token);
        $sql_testimoni = "SELECT content as testimoni, gambar as image, id_testimoni as testimoniId, nama_user as user, jabatan as sebagai FROM tb_testimoni where is_aktif = 1 ORDER BY sort ASC";
        $testimoni = $this->db->query($sql_testimoni)->result_array();
        foreach ($testimoni as $key => $value) {
            if ($value['image'] == '') {
                $testimoni[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $testimoni[$key]['image_big'] = 'media/'.$value['image'];
                    $testimoni[$key]['image'] = 'media/thumbnail/'.$value['image'];
                }else{
                    $testimoni[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $testimoni[$key]['image'] = 'media/'.$value['image'];
                }
            }

        }
        // print_r($testimoni);

         $url_titleslider = URL_GET_AKADEMISI_TITLE;
        // $e = api_helper('',$url_titleslider,$methode,$token);
        $sql_slider = "SELECT content as title FROM tb_layanan WHERE kategori = 4";
        $slider = $this->db->query($sql_slider)->row_array();


        // $url = "http://192.168.88.138/idren/api/v1/about";
        // $a = json_decode($this->hit_api($url),true);
        // $this->data['hero']=$a['data'];
        $this->data['hero']=$hero;
        // $this->data['layanan']=$b['data'];
        // $this->data['instansi']=$c['data'];
        $this->data['instansi']=$instansi;
        // $this->data['testimoni']=$d;
        $this->data['testimoni']=$testimoni;
        // $this->data['title_slider']=$e;
        $this->data['title_slider']=$slider;
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
