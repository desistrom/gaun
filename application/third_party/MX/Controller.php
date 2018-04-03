<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	
	public function __construct() 
	{
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
	}
	
	public function __get($class) 
	{
		return CI::$APP->$class;
	}

	/*for handle upload*/
	public function do_upload($fileName,$directoryDestinationServer){

            ini_set('memory_limit','-1');
            set_time_limit(0);
            $return['memory'] = ini_get('memory_limit');

            if(!isset($_FILES["{$fileName}"]["name"])) {
                $return['status'] = 'failed';
                $return['notif'] = 'there are no data'; 
                echo json_encode($return);
                exit();
            }else{
                if($_FILES["{$fileName}"]["size"] > (2*1024*1024)){
                    $return['status'] = 'failed';
                    $return['notif'] = "Image file size max 2 MB"; 
                    echo json_encode($return);
                    exit();
                }
            }

            
            
            $validFormats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
            $imageName = $_FILES["{$fileName}"]["name"];
            $size = $_FILES["{$fileName}"]["size"];
            $extension = pathinfo($imageName, PATHINFO_EXTENSION);

            //$return['memory'] = $size;
            //echo json_encode($return); exit();

            if(in_array($extension,$validFormats)){
                //if($size < (2 * 1024 *1024)){ // Image size max 2 MB

                $newName = time().".".$extension;
                $imageTemp = $_FILES["{$fileName}"]["tmp_name"];
                header("Content-type: image/".$extension);
                if (move_uploaded_file($imageTemp, $directoryDestinationServer.$newName)){
                	$imageMaster = $directoryDestinationServer.$newName;
                    $return['status'] = 'success';
                    $return['newName'] = $newName;
                    $return['oldImage'] = $imageMaster;
                    $return['extension'] = $extension;
                    
                }else{
                    $return['status'] = 'failed';
                    $return['notif'] = "Sorry, there was an error uploading your file.";
                }
                //}else{
                    //$return['status'] = 'failed';
                    //$return['notif'] = "Image file size max 2 MB"; 
                //}
            }else{
                $return['status'] = 'failed';
                $return['notif'] =  "Invalid file format.."; 
            }
            return $return;
    }

    public function compressImage($ext,$imageResource,$targetDirectory,$newImageName,$newWidth,$setnewHeight){

        if($ext == "jpg" || $ext == "jpeg" || $ext == "JPG" || $ext == "JPEG" ){
            $src = imagecreatefromjpeg($imageResource);
        }else if($ext == "png"){
            $src = imagecreatefrompng($imageResource);
        }else if($ext == "gif"){
            $src = imagecreatefromgif($imageResource);
        }else{
            $src = imagecreatefrombmp($imageResource);
        }

        //$thumbs_dir = $target_dir."thumbs/";    
        list($width,$height) = getimagesize($imageResource);
        $newHeight = ($height/$width)*$newWidth;
       
        if($setnewHeight != ""){
            $newHeight = $setnewHeight;
        }

        $tmp = imagecreatetruecolor($newWidth,$newHeight);
        imagecopyresampled($tmp,$src,0,0,0,0,$newWidth,$newHeight,$width,$height);
        $filename = $targetDirectory.$newImageName; //PixelSize_TimeStamp.jpg
        imagejpeg($tmp,$filename,100);
        imagedestroy($tmp);
        header("Content-type: image/".$ext);
        return $filename;
    }

    public function is_login(){
             if($this->session->userdata('is_login') == '' || $this->session->userdata('is_login') != true ) {
                     return false;
             }else{
                     return true;
             }
     }
}