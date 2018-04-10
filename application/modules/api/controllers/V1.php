<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';
class V1 extends REST_Controller {
	var $data = array();
	public function __construct() {
        parent::__construct();
        $this->load->library('REST_Controller');
        $this->load->model('v1_model');
    }

    public function token_post()
    {
        header('Content-Type: application/json');
        $param = json_decode(file_get_contents('php://input'),true);
        // $login_platform = $this->getData($param);
        // if ($login_platform['status'] == 1) {
            $tokenData = array();
            $tokenData['id']['username'] = $param['username']; 
            $tokenData['id']['password'] = $param['password']; 
            $tokenData['timestamp'] = now();
            $output['status'] = "ok";
            $output['token'] = AUTHORIZATION::generateToken($tokenData);
            $result = $this->set_response($output, REST_Controller::HTTP_OK);
            return $result;
        // }
        $ret['status'] = 'failed';
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

    //untuk testimoni

    public function gettestimoni_get(){
        header('Content-Type: application/json');
        $this->_getTestimoni();
    }


    function _galery(){
    	$galery = $this->v1_model->getAllGalery();
		$retData['code'] = '200';
		$retData['status'] = 'success';
		$retData['data'] = $galery;
		$this->response($retData,200);
    }

    function _galery_image(){
    	$type = 'image';
    	$galery = $this->v1_model->getTypeGalery($type);
		
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

    function _galery_video(){
    	$type = 'video';
    	$galery = $this->v1_model->getTypeGalery($type);
		
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
        $about = $this->v1_model->about();
        $retData['code'] = '200';
        $retData['status'] = 'success';
        $retData['data'] = $about;
        $this->response($retData,200);
    }

    //Setting User
    function _profit(){
        $profit = $this->v1_model->user_setting()['benefit'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $profit;
        $this->response($retData,200);
    }

    function _step(){
        $profit = $this->v1_model->user_setting()['step'];
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $profit;
        $this->response($retData,200);
    }

    function _getinstansi(){
        $user = $this->v1_model->getInstansi();
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }   

    function _getuser(){
        $user = $this->v1_model->getUser();
        $retData['code'] = '200';
        $retData['status'] = 'Success';
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
        $news = $this->v1_model->news();
        $retData['code'] = '200';
        $retData['status'] = 'success';
        foreach ($news as $key => $value) {
            if ($value['gambar'] == '') {
                $news[$key]['gambar']=base_url().'assets/images/logo/IDREN-2.png';
            }
        }
        $retData['data'] = $news;
        $this->response($retData,200);
    }

    function _search_news($data){
        $param = $data['search'];
        $news = $this->v1_model->searchNews($param);
        
        if ($news == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $news;
        }
        $this->response($retData,200);
    }

    function _get_news_by_id($data){
        $param = $data['data'];
        $news = $this->v1_model->rowNews($param);
        
        if ($news == '') {
            $retData['code'] = '500';
            $retData['status'] = 'Failed';
            $retData['data'] = 'data not found';
        }else{
            $retData['code'] = '200';
            $retData['status'] = 'success';
            $retData['data'] = $news;
        }
        $this->response($retData,200);
    }

    function _getTestimoni(){
        $user = $this->v1_model->getTestimoni();
        $retData['code'] = '200';
        $retData['status'] = 'Success';
        $retData['data'] = $user;
        $this->response($retData,200);
    }

}