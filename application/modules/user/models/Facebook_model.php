<?php
class Facebook_model extends CI_Model {
	
	public function __construct($url = '')
	{
		parent::__construct();
		$config = array(
						'appId'  => FACEBOOK_APP_ID,
						'secret' => FACEBOOK_APP_SECRET,
						'fileUpload' => true, // Indicates if the CURL based @ syntax for file uploads is enabled.
						);
		
		$this->load->library('Facebook_load', $config);
		// $a = $this->uri->segment_array();
		// $b = $a[1].'/'.$a[2];
		// if (PAGE == 'login_user') {
		// 	$url = 'user/login_user/';
		// }
		// print_r(base_url().$b);
		$user = $this->facebook_load->getUser();
		// print_r($user);
		// We may or may not have this data based on whether the user is logged in.
		//
		// If we have a $user id here, it means we know the user is logged into
		// facebook_load, but we don't know if the access token is valid. An access
		// token is invalid if the user logged out of facebook_load.
		$profile = null;
		if($user)
		{
			try {
			    // Proceed knowing you have a logged in user who's authenticated.
				$profile = $this->facebook_load->api('//me?fields=id,first_name,last_name,email,gender,locale,picture');
			} catch (FacebookApiException $e) {
				error_log($e);
			    $user = null;
			}		
		}
		
		$fb_data = array(
						'me' => $profile,
						'uid' => $user,
						'loginUrl' => $this->facebook_load->getLoginUrl(
							array(
								'scope' => 'email', // app permissions
								'redirect_uri' => base_url().'user/welcome/topsecret/' // URL where you want to redirect your users after a successful login
							)
						),
						'logoutUrl' => $this->facebook_load->getLogoutUrl(),
					);

		$this->session->set_userdata('fb_data', $fb_data);
	}
}
