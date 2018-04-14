<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * CodeIgniter Email Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		https://codeigniter.com/user_guide/helpers/email_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('email_send'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function email_send($content_mail=array(""))
	{
		$CI = & get_instance();	
		$CI->load->library('email');

		$CI->email->initialize(array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'smtp.sendgrid.net',
		  'smtp_user' => 'desistrom',
		  'smtp_pass' => '3137spendaka',
		  'smtp_port' => 587,
		  'crlf' => "\r\n",
		  'newline' => "\r\n"
		));

		$CI->email->from($content_mail['email_from'], $content_mail['name_from']);
		$CI->email->to($content_mail['email_to']);
		$CI->email->subject($content_mail['subject']);
    	$CI->email->set_mailtype("html");
		$CI->email->message($content_mail['content']);
		if($CI->email->send()){
			return true;
			// echo $CI->email->print_debugger();
		}else{
			return falses;
		}

	
		
	}
		
}

?>