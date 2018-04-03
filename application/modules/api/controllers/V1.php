<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class V1 extends REST_Controller {
	var $data = array();
	public function __construct() {
        parent::__construct();
        $this->load->library('REST_Controller');
        $this->load->model('v1_model');
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

}