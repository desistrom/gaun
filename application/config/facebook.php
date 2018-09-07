<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------
|  Facebook App details
| -------------------------------------------------------------------
|
| To get an facebook app details you have to be a registered developer
| at http://developer.facebook.com and create an app for your project.
|
|  facebook_app_id               string   Your facebook app ID.
|  facebook_app_secret           string   Your facebook app secret.
|  facebook_login_type           string   Set login type. (web, js, canvas)
|  facebook_login_redirect_url   string   URL tor redirect back to after login. Do not include domain.
|  facebook_logout_redirect_url  string   URL tor redirect back to after login. Do not include domain.
|  facebook_permissions          array    The permissions you need.
|  facebook_graph_version        string   Set Facebook Graph version to be used. Eg v2.6
|  facebook_auth_on_load         boolean  Set to TRUE to have the library to check for valid access token on every page load.
*/
// print_r(DOMAIN);
// if(DOMAIN == 'localhost'){
// 	$config['facebook_app_id']              = '117942632203648';
// 	$config['facebook_app_secret']          = 'f86ea994cadb7cd6730781ded4bf679c';
// 	// print_r('work');
// }else{
// 	$config['facebook_app_id']              = '607824559619085';
// 	$config['facebook_app_secret']          = 'fbd158fe5954d6f9d2676350909ebae1';
// }
$config['facebook_login_type']          = 'web';

// if (PAGE == 'login_user') {
	// $config['facebook_login_redirect_url']  = URL_API.'user/login_user/facebook';
	
// }elseif (PAGE == 'login_mahasiswa') {
// 	$config['facebook_login_redirect_url']  = 'user/login_user/facebook_mahasiswa';
	
// }else{
// 	if (PAGE == 'pendaftaran_dosen') {
// 		$config['facebook_login_redirect_url']  = 'web/keanggotaan/facebook';
// 	}else{
// 		$config['facebook_login_redirect_url']  = 'web/keanggotaan/facebook_mahasiswa';
// 	}
// }
$config['facebook_logout_redirect_url'] = 'login/user_authentication_facebook/logout';
$config['facebook_permissions']         = array('email');
$config['facebook_graph_version']       = 'v3.1';
$config['facebook_auth_on_load']        = TRUE;
