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

if ( ! function_exists('send_mail_sendgrid'))
{
	/**
	 * Validate email address
	 *
	 * @deprecated	3.0.0	Use PHP's filter_var() instead
	 * @param	string	$email
	 * @return	bool
	 */
	function send_mail_sendgrid($content_mail=array(""))
	{
		//$i = 0;
		//$EMAILTO = 	$data['EMAILTO'];	
		require 'vendor/autoload.php';
		require 'lib/SendGrid.php';
		(@__DIR__ == '__DIR__') && define('__DIR__', realpath(dirname(__FILE__)));

		
		$sendgrid = new SendGrid('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');
		$email = new SendGrid\Email();
		$email
		    ->addTo($content_mail['emailTo'])
		    ->setFrom($content_mail['setFrom'])
		    ->setSubject($content_mail['subject'])
		    ->setHtml($content_mail['emailBody']);
		$res = $sendgrid->send($email);
		//echo $res->getCode();
		return $res->getCode();

	
		
	}
		
}

?>