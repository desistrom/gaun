<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/**
 * Description of site
 *
 * @author http://www.roytuts.com
 */
class Image extends CI_Controller  {


    function __construct() {
        parent::__construct();
    }

    function index() {
    // print_r($this->session->userdata('token'));
    $this->ciparser->new_parse('template_admin','modules_home', 'image_layout');
    }



   public function email(){
   	$this->load->helper('sendgrid');
   	$param['emailTo'] = 'desistrom0@gmail.com';
	$param['setFrom'] = 'admin@idren.id';
	$param['subject'] = 'Order di Terima';
	$param['emailBody'] = 'Berikut Data Pesanan Anda ';
	$param['emailBody'] .= '<div class="col-md-12">
    	<div class="col-md-6">
    		<h4>Data User</h4>
            <ul>
            	<li>Nama : <span>Junaedi</span></li>
            	<li>Alamat : <span>Ds. Mayangrejo</span></li>
            	<li>No. Telp : <span>082331472499</span></li>
            	<li>E - Mail : <span>desistrom0@gmail.com</span></li>
            </ul>
    	</div>
    	<div class="col-md-6">
    		<h4>Data Barang</h4>';
		$param['emailBody'] .= '<ul class="well">
                        	<li>Nama Barang : Grid</li>
                        	<li>Harga : Rp. 90.000</li>
                        	<li>Jumlah Pesan : 3</li>
                        	<li>Request Barang : harus</li>
                        </ul>';
    $param['emailBody'] .= '<li>Harga Khusus : Rp. 40.000</li>
    						<li>Estimasi : 30 Hari</li>
    						<li>Catatan : Jadi</li>';
    $param['emailBody'] .= '<h3 style="float: right;">Total Harga : Rp. 90.000</h3>
    	</div>
    </div>';
    if(send_mail_sendgrid($param)){
		print_r($param);
	}else{
		echo "Salah";
	}
   }

   public function data_email(){
   		$this->load->library('email');

		$this->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => 'desistrom',
		  'smtp_pass' => '3137spendaka',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));

		$this->email->from('Junaedi@idren.com', 'M. Puji Junaedi');
		$this->email->to('desistrom0@gmail.com');
		// $this->email->cc('another@another-example.com');
		// $this->email->bcc('them@their-example.com');
		$this->email->subject('Email Test');
		$param['emailBody'] = 'Berikut Data Pesanan Anda ';
		$param['emailBody'] .= '<div class="col-md-12">
    	<div class="col-md-6">
    		<h4>Data User</h4>
            <ul>
            	<li>Nama : <span>Junaedi</span></li>
            	<li>Alamat : <span>Ds. Mayangrejo</span></li>
            	<li>No. Telp : <span>082331472499</span></li>
            	<li>E - Mail : <span>desistrom0@gmail.com</span></li>
            </ul>
    	</div>
    	<div class="col-md-6">
    		<h4>Data Barang</h4>';
		$param['emailBody'] .= '<ul class="well">
                        	<li>Nama Barang : Grid</li>
                        	<li>Harga : Rp. 90.000</li>
                        	<li>Jumlah Pesan : 3</li>
                        	<li>Request Barang : harus</li>
                        </ul>';
    $param['emailBody'] .= '<li>Harga Khusus : Rp. 40.000</li>
    						<li>Estimasi : 30 Hari</li>
    						<li>Catatan : Jadi</li>';
    $param['emailBody'] .= '<h3 style="float: right;">Total Harga : Rp. 90.000</h3>
    	</div>
    </div>';
    	$this->email->set_mailtype("html");
		$this->email->message($param['emailBody']);
		$this->email->send();

		echo $this->email->print_debugger();
   }

   public function check_help(){
   	$this->load->helper('email_send_helper');
   	$data['email_from'] = "junaedi@presiden.com";
   	$data['name_from'] = "Presiden Junaedi";
   	$data['email_to'] = "desistrom0@gmail.com";
   	$data['content'] = "Ini adalah contoh email dari helper";
   	$data['subject'] = "email helper";
   	if (email_send($data) == true) {
   		// redirect(site_url('admin'));
   	}else{
   		// redirect(site_url());
   	}
   	// echo email_send($data);
   }

   

}
