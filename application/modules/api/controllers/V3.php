<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class V3 extends REST_Controller {
	var $data = array();
	public function __construct() {
        parent::__construct();
        $this->load->library('REST_Controller');
        $this->load->model('v1_model');
        $this->load->helper('api');
        ini_set('allow_url_fopen',1);
    }

    public function token_post()
    {
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'),true);
        // $login_platform = $this->getData($param);
        // if ($login_platform['status'] == 'ok') {
        if (isset($param['username'])) {
            $tokenData = array();
            $tokenData['id']['username'] = $param['username']; 
            $tokenData['id']['password'] = $param['password']; 
            $tokenData['timestamp'] = now();
            $output['status'] = "ok";
            $output['data'] = $tokenData;
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            $result = $this->set_response($output, REST_Controller::HTTP_OK);
            return $result;
        }
        // $ret['status'] = $param;
        $ret['status'] = 'failed';
        // $ret['message'] = $param;
        $ret['message'] = 'FAILED AUTHORIZATION';
        $this->set_response($ret, 400);
    }
    public function check_token_get()
    {
        $headers = $this->input->request_headers();
        if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization'])) {
            //TODO: Change 'token_timeout' in application\config\jwt.php
            $decodedToken = AUTHORIZATION::validateTimestamp($headers['Authorization']);
            // return response if token is valid
            if ($decodedToken != false) {
                $this->set_response($decodedToken, REST_Controller::HTTP_OK);
                return;
            }
        }
        
        $this->set_response("Unauthorised", REST_Controller::HTTP_UNAUTHORIZED);
    }

    public function albumAll_get(){
        header('Content-Type: application/json');
        $this->_albumAll();
    }

    public function getAlbumById_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        $this->_getAlbumById($param);
    }

    public function galery_get(){
        header('Content-Type: application/json');
        $this->_galery();
    }


    public function galery_image_get(){
    	header('Content-Type: application/json');
    	$this->_galery_image();
    }

    public function galery_video_get(){
    	header('Content-Type: application/json');
    	$this->_galery_video();
    }

    public function tube_video_get(){
        header('Content-Type: application/json');
        $this->_tube_video();
    }

    public function tube_video_pagging_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        if(!isset($param) || $param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_tube_video_pagging($param);
    }

    public function galery_video_pagging_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        if(!isset($param) || $param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_galery_video_pagging($param);
    }

    public function search_galery_image_post(){
    	header('Content-Type: application/json');
    	$param = json_decode(file_get_contents('php://input'), true);
    	if(!isset($param['search']) || $param['search'] == ''){
            $retData['code'] = '500';
    		$retData['status'] = 'failed';
    		$retData['error'] = 'Your parameter is invalid';
    		$this->response($retData,400);
    	}
    	$this->_search_galery_image($param);
    }

    public function search_galery_video_post(){
    	header('Content-Type: application/json');
    	$param = json_decode(file_get_contents('php://input'), true);
    	if(!isset($param['search']) || $param['search'] == ''){
            $retData['code'] = '500';
    		$retData['status'] = 'failed';
    		$retData['error'] = 'Your parameter is invalid';
    		$this->response($retData,400);
    	}
    	$this->_search_galery_video($param);
    }

    public function select_galery_post(){
    	header('Content-Type: application/json');
    	$param = json_decode(file_get_contents('php://input'), true);
    	if(!isset($param['data']) || $param['data'] == ''){
            $retData['code'] = '500';
    		$retData['status'] = 'failed';
    		$retData['error'] = 'Your parameter is invalid';
    		$this->response($retData,400);
    	}
    	$this->_select_galery($param);
    }

    //About

    public function about_get(){
        header('Content-Type: application/json');
        $this->_about();
    }

    //Setting User
    public function profit_get(){
        header('Content-Type: application/json');
        $this->_profit();
    }

    public function step_get(){
        header('Content-Type: application/json');
        $this->_step();
    }

    public function instansi_get(){
        header('Content-Type: application/json');
        $this->_getinstansi();
    }

    public function instansi_pagging_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        $this->_getinstansi_pagging($param);
    }

    public function search_instansi_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        // if(!isset($param['search']) || $param['search'] == ''){
        //     $retData['code'] = '500';
        //     $retData['status'] = 'failed';
        //     $retData['error'] = 'Your parameter is invalid';
        //     $this->response($retData,400);
        // }
        $this->_search_instansi($param);
    }

    //User

    public function alluser_get(){
        header('Content-Type: application/json');
        $this->_getuser();
    }

    public function user_by_id_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if(!isset($param['data']) || $param['data'] == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_select_user($param);
    }

    public function insert_user_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if ($param['username'] == '' || !isset($param['username'])) {
            $retData['username'] = 'username is required, "username" : "example"';
        }
        if ($param['password'] == '' || !isset($param['password'])) {
            $retData['password'] = 'password is required, "password" : "example"';
        }
        if ($param['name'] == '' || !isset($param['name'])) {
            $retData['name'] = 'name is required, "name" : "example"';
        }
        if ($param['email'] == '' || !isset($param['email'])) {
            $retData['email'] = 'Email is required, "email" : "example@ex.com"';
        }
        if ($param['number_phone'] == '' || !isset($param['number_phone'])) {
            $retData['number_phone'] = 'number_phone is required, "number_phone" : "08xxx"';
        }
        if ($param['username'] == '' || !isset($param['username']) || $param['password'] == '' || !isset($param['password']) || $param['name'] == '' || !isset($param['name']) || $param['email'] == '' || !isset($param['email']) || $param['number_phone'] == '' || !isset($param['number_phone'])) {
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,200);
        }
        $this->_register($param);
    }

    public function insert_instansi_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if ($param['username'] == '' || !isset($param['username'])) {
            $retData['username'] = 'username is required, "username" : "example"';
        }
        if ($param['password'] == '' || !isset($param['password'])) {
            $retData['password'] = 'password is required, "password" : "example"';
        }
        if ($param['instansi'] == '' || !isset($param['instansi'])) {
            $retData['name'] = 'name is required, "name" : "example"';
        }
        if ($param['email'] == '' || !isset($param['email'])) {
            $retData['email'] = 'Email is required, "email" : "example@ex.com"';
        }
        if ($param['number_phone'] == '' || !isset($param['number_phone'])) {
            $retData['number_phone'] = 'number_phone is required, "number_phone" : "08xxx"';
        }
        if ($param['address'] == '' || !isset($param['address'])) {
            $retData['address'] = 'Address is required, "address" : "Region ...."';
        }
        if ($param['website'] == '' || !isset($param['website'])) {
            $retData['website'] = 'Website Address is required, "website" : "www.example.com"';
        }
        if ($param['username'] == '' || !isset($param['username']) || $param['password'] == '' || !isset($param['password']) || $param['instansi'] == '' || !isset($param['instansi']) || $param['email'] == '' || !isset($param['email']) || $param['number_phone'] == '' || !isset($param['number_phone']) || $param['address'] == '' || !isset($param['address']) || $param['website'] == '' || !isset($param['website'])) {
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,200);
        }
        $this->_register_instansi($param);
    }

    public function search_user_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if(!isset($param['data']) || $param['data'] == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_search_user($param);
    }

    public function news_get(){
        header('Content-Type: application/json');
        $this->_getnews();
    }

    public function pagging_news_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        $this->_paggingnews($param);
    }

    public function search_news_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if(!isset($param['search']) || $param['search'] == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_search_news($param);
    }

    public function get_news_byid_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if(!isset($param['data']) || $param['data'] == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_get_news_by_id($param);
    }

    public function get_news_byslug_get(){
        header('Content-Type: application/json');
        $param['news'] = $_GET['news'];
        if(!isset($param['news']) || $param['news'] == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_get_news_by_slug($param);
    }

    //untuk testimoni

    public function gettestimoni_get(){
        header('Content-Type: application/json');
        $this->_getTestimoni();
    }

    public function gettestimoni_pagging_get(){
        header('Content-Type: application/json');
        $param = $_GET['data'];
        $this->_getTestimoni_pagination($param);
    }

    //hero
    public function gethero_get(){
        header('Content-Type: application/json');
        $this->_getHero();
    }

    public function getlayanan_idroam_get(){
        header('Content-Type: application/json');
        $this->_getLayanan_idroam();
    }

    public function getlayanan_cloud_get(){
        header('Content-Type: application/json');
        $this->_getLayanan_cloud();
    }

    public function getlogo_get(){
        header('Content-Type: application/json');
        $this->_getLogo();
    }

    public function gettopologi_get(){
        header('Content-Type: application/json');
        $this->_getTopologi();
    }

    public function founder_get(){
        header('Content-Type: application/json');
        $this->_getFounder();
    }

    public function insert_contact_post(){
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'), true);
        if (!isset($param['name']) || $param['name'] == '') {
            $retData['name'] = 'Name is required, "name" : "Jhon Doe"';
        }
        if (!isset($param['emial']) || $param['email'] == '') {
            $retData['email'] = 'Email is required, "email" : "example@example.com"';
        }
        if (!isset($param['pesan']) || $param['pesan'] == '') {
            $retData['pesan'] = 'pesan is required, "pesan" : "example..."';
        }
        if (!isset($param['name']) || $param['name'] == '' || !isset($param['emial']) || $param['email'] == '' || !isset($param['pesan']) || $param['pesan'] == '') {
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
        }
        $this->_insertContact($param);
    }

    public function getfooter_get(){
        header('Content-Type: application/json');
        $this->_getFooter();
    }

    public function gettitleslider_get(){
        header('Content-Type: application/json');
        $this->_getSlider();
    }

    function _albumAll(){
        $url = URL_GET_ALL_ALBUM;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token);
        $this->response($retData,200);
    }

    function _getAlbumById($param){
    	$id = $param;
        $url =  URL_GET_ALBUM_BY_ID.$id ;
        $data = '';
        $methode = 'GET';
        $token = '';
        $galery = api_helper(json_encode($id),$url,$methode,$token);        
        $retData['data'] = $galery;
        $this->response($retData,200);
    }

    function _galery(){
    	$url = URL_GET_ALL_MEDIA;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token);
        $this->response($retData,200);
    }

    function _galery_image(){
    	$url = URL_GET_ALL_IMAGE;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token);
        $this->response($retData,200);
    }

    function _galery_video(){
    	$url = URL_GET_ALL_VIDEO;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token);
        $this->response($retData,200);
    }

    function _galery_video_pagging($param){
        $url = URL_GET_VIDEO_PAGGING_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _tube_video(){
        $url = URL_GET_ID_TUBE_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _tube_video_pagging($param){
        $url = URL_GET_ID_TUBE_PAGGING_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _select_galery($data){
    	$param = $data['data'];
    	$galery = $this->v1_model->selectGalery($param);
		
		if ($galery == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
		}else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $galery;
		}
		$this->response($retData,200);
    }

    function _search_galery_image($data){
    	$param = $data['search'];
    	$galery = $this->v1_model->searchGaleryImage($param);
		
		if ($galery == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
		}else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $galery;
		}
		$this->response($retData,200);
    }

    function _search_galery_video($data){
    	$param = $data['search'];
    	$galery = $this->v1_model->searchGaleryVideo($param);
		
        if ($galery == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
		}else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $galery;
		}
		$this->response($retData,200);
    }

    //about

    function _about(){
        $url = URL_GET_ABOUT_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    //Setting User
    function _profit(){
        $url = URL_GET_BENEFIT_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _step(){
        $url = URL_GET_PENDAFTARAN_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _getinstansi(){
    	$url = URL_GET_ALL_INSTANSI_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        // $this->response($retData,200);
        // $user = $this->v1_model->getInstansi();
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        /*foreach ($user as $key => $value) {
            if ($value['image'] == '') {
                $user[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $user[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                    $galery[$key]['image'] = 'media/'.$value['image'];
                }else{
                    $user[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $user[$key]['image'] = 'media/'.$value['image'];
                }
            }                                                                                                                     
        }*/
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _getinstansi_pagging($param){
    	$url = URL_GET_INSTANSI_PAGGING_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        // $retData['data'] = $user;
        $this->response($retData,200);
        /*$user = $this->v1_model->getInstansi_pagging($param);
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        foreach ($user as $key => $value) {
            if ($value['image'] == '') {
                $user[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."media/thumbnail/".$value['image'])) {
                    $user[$key]['image_thumbnail'] = 'media/thumbnail/'.$value['image'];
                    $user[$key]['image'] = 'media/'.$value['image'];
                }else{
                    $user[$key]['image_thumbnail'] = 'media/'.$value['image'];
                    $user[$key]['image'] = 'media/'.$value['image'];
                }
            }                                                                                                                     
        }
        $retData['data'] = $user;
        $this->response($retData,200);*/
    }

    function _search_instansi($data){
    	$url = URL_SEARCH_INSTANSI_V2;
    	$data = json_encode($data);
        $methode = 'POST';
        $token = '';
        $retData['data'] = api_helper($data,$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
        /*$param = $data['search'];
        $page = $data['page'];
        $instansi = $this->v1_model->searchInstansi($param,$page);
        
        if ($instansi == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
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
            $retData['data'] = $instansi;
        }
        $this->response($retData,200);*/
    }

    function _getuser(){
        $user = $this->v1_model->getUser();
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        foreach ($user as $key => $value) {
            if ($value['image'] == '') {
                $user[$key]['image_thumbnail']='assets/images/logo/IDREN-2.png';
            }else{
                $user[$key]['image_large']='media/'.$user[$key]['image'];
                $user[$key]['image_thumbnail']='media/thumbnail/'.$user[$key]['image'];
            }                                                                                                                     
        }
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _select_user($data){
        $param = $data['data'];
        $user = $this->v1_model->rowUser($param);
        
        if ($user == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $user;
        }
        $this->response($retData,200);
    }

    function _register($data){
        $data_register['username'] = $data['username'];
        $data_register['password'] = sha1($data['password']);
        $data_register['name'] = $data['name'];
        $data_register['phone'] = $data['number_phone'];
        $data_register['email'] = $data['email'];
        if ($this->db->get_where('tb_user',array('username'=>$data['username']))->num_rows() > 0) {
            $retData['code'] = "500";
            $retData['status'] = 'Failed';
            $retData['data'] = "Username alredy exist";
            $this->response($retData,200);
            exit();
        }
        if ($this->v1_model->insertUser($data_register) == false) {
            $retData['code'] = "500";
            $retData['status'] = 'Failed';
            $retData['data'] = "Can't add user";
            $this->response($retData,200);
            exit();
        }
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = 'User Has been inserted';
        $this->response($retData,200);
    }

    function _register_instansi($data){
    	$url = URL_REGISTER_V2;
    	$data = json_encode($data);
        $methode = 'POST';
        $token = '';
        $retData['data'] = api_helper($data,$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
        /*$data_register['username'] = $data['username'];
        $data_register['password'] = sha1($data['password']);
        $data_register['nm_instansi'] = $data['instansi'];
        $data_register['phone'] = $data['number_phone'];
        $data_register['alamat'] = $data['address'];
        $data_register['website'] = $data['website'];
        $data_register['email'] = $data['email'];
        $data_register['status'] = 0;
        if ($this->db->get_where('tb_instansi',array('username'=>$data['username']))->num_rows() > 0) {
            $retData['code'] = "500";
            $retData['status'] = 'Failed';
            $retData['data'] = "Username alredy exist";
            $this->response($retData,200);
            exit();
        }
        if ($this->v1_model->insertInstansi($data_register) == false) {
            $retData['code'] = "500";
            $retData['status'] = 'Failed';
            $retData['data'] = "Can't add user";
            $this->response($retData,200);
            exit();
        }
        $template = $this->db->get_where('tb_template_email',array('id_kategori_email_ref'=>1,'status'=>1))->row_array()['source_code'];
        $final = str_replace("Email_User", $data['username'], $template);
        // $final = str_replace("subject_email", "Registrasi", $final);
        $sender = $this->db->get('tb_setting_email')->row_array();
        $this->load->helper('email_send_helper');
        $data_email['email_from'] = $sender['email'];
        $data_email['name_from'] = $sender['nama_user'];
        $data_email['email_to'] = $data['email'];
        $data_email['subject'] = "Registerasi";
        $content = '';
        $content .= "<tr><td>Username </td><td>:</td> ".$data['username']."</td></tr>";
        $content .= "<tr><td>Password </td><td>:</td> ".$data['password']."</td></tr>";
        $content .= "<tr><td>Email </td><td>:</td> ".$data['email']."</td></tr>";
        $content .= "<tr><td>Website </td><td>:</td> ".$data['website']."</td></tr>";
        $content .= "<tr><td>Alamat </td><td>:</td> ".$data['address']."</td></tr>";
        $data_email['content'] = str_replace("content_email", $content, $final);
        if (email_send($data_email) == true) {
            $retData['code'] = '200';
            $retData['status'] = 'Success';
            $retData['data'] = 'User Has been inserted';
            $retData['data'] = $template;
        }else{
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['data'] = 'Email Not Send';
        }
        $this->response($retData,200);*/
    }

    function _search_user($data){
        $param = $data['data'];
        $user = $this->v1_model->searchUser($param);
        
        if ($user == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $user;
        }
        $this->response($retData,200);
    }

    function _getnews(){
        $url = URL_GET_ALL_NEWS_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _paggingnews($param){
        $url = URL_GET_NEWS_PAGGING_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _search_news($data){
    	$url = URL_SEARCH_NEWS_V2;
    	$data = json_encode($data['search']);
        $methode = 'POST';
        $token = '';
        $retData['data'] = api_helper($data,$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _get_news_by_id($data){
       $url = URL_GET_NEWS_BY_SLUG_V2.$data['data'];
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _get_news_by_slug($data){
    	$url = URL_GET_NEWS_BY_SLUG_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _getTestimoni(){
        $url = URL_GET_TESTIMONI_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _getTestimoni_pagination($data){
        $url = URL_GET_TESTIMONI_PAGGING_V2.$data;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    //hero
    function _getHero(){
        $url = URL_GET_HERO_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    //layanan
    function _getLayanan_idroam(){
        $user = $this->v1_model->getLayanan(1);
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $user['image'] = 'media/'.$user['image'];
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _getLayanan_cloud(){
        $user = $this->v1_model->getLayanan(2);
        $retData['code'] = '200';
        $user['image'] = 'media/'.$user['image'];
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _getLogo(){
    	$url = URL_GET_LOGO_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $user = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }

    function _getTopologi(){
    	$url = URL_GET_TOPOLOGI_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _insertContact($data){
        $data_register['nama'] = $data['name'];
        $data_register['email'] = $data['email'];
        $data_register['pesan'] = $data['pesan'];
        if ($this->v1_model->insertContact($data_register) == false) {
            $retData['code'] = "500";
            $retData['status'] = 'Failed';
            $retData['data'] = "Can't add Message";
            $this->response($retData,200);
            exit();
        }
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = 'Message Has been Send';
        $this->response($retData,200);
    }

    function _getFooter(){
        $url = URL_GET_FOOTER_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _getFounder(){
        $url = URL_GET_FOUNDER_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    function _getSlider(){
        $url = URL_GET_AKADEMISI_TITLE_V2;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

    public function menu_get(){
        $sql = "SELECT id, label, link, parent FROM tb_menu ORDER BY parent, sort, label";
        $item = $this->db->query($sql)->result_array();
        $menus = array('items'=>array(),'parents'=>array());
        $this->data['menu'] = '';
        foreach ($item as $key => $value) {
            $menus['items'][$value['id']] = $value;
            $menus['parents'][$value['parent']][]= $value['id'];
        }
        $this->createTreeView(0,$menus);
    }

    function createTreeView($parent, $menu){
       $html = "";
       if (isset($menu['parents'][$parent])) {
          $html .= '<ul class="nav navbar-nav">';
           foreach ($menu['parents'][$parent] as $itemId) {
              if(!isset($menu['parents'][$itemId])) {
                 $html .= "<li><a href='".$menu['items'][$itemId]['link']."'>"
    .$menu['items'][$itemId]['label']."</a></li>";
              }
              if(isset($menu['parents'][$itemId])) {
                 $html .= "<li class='dropdown'><a href='".$menu['items'][$itemId]['link']."'>".$menu['items'][$itemId]['label']."</a>";
                 $html .= "<ul class='dropdown-menu'>";
                 $html .= "<li>".$this->createTreeView($itemId, $menu)."</li>";
                 $html .= "</ul>";
              }
           }
           $html .= "</ul>";
       }
       // return $html;
       $retData['code'] = 200;
       $retData['status'] = 'Success';
       $retData['data'] = $html;
       $this->response($retData,200);
    }

    public function page_get(){
        header('Content-Type: application/json');
        $param = $_GET['link'];
        if($param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_getPage($param);
    }

    function _getPage($param){
    	$url = URL_GET_PAGE_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
        /*$user = $this->v1_model->getPage($param);
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);*/
    }

    public function getSliderFoto_get(){
        header('Content-Type: application/json');
        $param = $_GET['key'];
        if($param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_getSliderFoto($param);
    }

    function _getSliderFoto($param){
    	$url = URL_GET_SLIDER_FOTO_V2.$param;
    	$data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
        /*$galery = $this->v1_model->getSliderFoto($param);
        foreach ($galery as $key => $value) {
            if ($value['image'] == '') {
                $galery[$key]['image']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."assets/media/thumbnail/".$value['image'])) {
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }else{
                    $galery[$key]['image_big'] = 'assets/media/'.$value['image'];
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }
            }

        }
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $galery;
        $this->response($retData,200);*/
    }

    public function getDataFoto_post(){
        header('Content-Type: application/json');
        // $param = $_GET['key'];
        $param = json_decode(file_get_contents('php://input'), true);
        if($param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_getDataFoto($param['key']);
    }

    function _getDataFoto($param){
    	$url = URL_GET_DATA_FOTO_V2;
    	$data['key'] = $param;
        $methode = 'POST';
        $token = '';
        $retData['data'] = api_helper(json_encode($data),$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
        /*$galery = $this->v1_model->getDataFoto($param);
        foreach ($galery as $key => $value) {
            if ($value['image'] == '') {
                $galery[$key]['image']='assets/images/logo/IDREN-2.png';
            }else{
                if (file_exists(FCPATH."assets/media/thumbnail/".$value['image'])) {
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }else{
                    $galery[$key]['image_big'] = 'assets/media/'.$value['image'];
                    $galery[$key]['image'] = 'assets/media/thumbnail/'.$value['image'];
                }
            }

        }
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $galery;
        $this->response($retData,200);*/
    }

    public function getComment_get(){
        header('Content-Type: application/json');
        $param = $_GET['id'];
        if($param == ''){
            $retData['code'] = '500';
            $retData['status'] = 'failed';
            $retData['error'] = 'Your parameter is invalid';
            $this->response($retData,400);
        }
        $this->_getPage($param);
    }

    function _getComment($param){
        $url = URL_GET_COMMENT_V2.$param;
        $data = '';
        $methode = 'GET';
        $token = '';
        $retData['data'] = api_helper('',$url,$methode,$token)['data'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $this->response($retData,200);
    }

}