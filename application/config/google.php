<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
|  Google API Configuration
| -------------------------------------------------------------------
|  client_id         string   Your Google API Client ID.
|  client_secret     string   Your Google API Client secret.
|  redirect_uri      string   URL to redirect back to after login.
|  application_name  string   Your Google application name.
|  api_key           string   Developer key.
|  scopes            string   Specify scopes
*/
$config['google']['client_id']        = '241538137751-cebmc4661fvfj5pvseu3vdqi5jd6g4ke.apps.googleusercontent.com';
$config['google']['client_secret']    = 'N8CqiOO32Y7fvakqyhNAmbyB';

    // print_r(PAGE);
// echo PAGE;
    // $this->CI = & get_instance();
// if (PAGE == 'login_user') {
	// print_r('work');
	// $config['google']['redirect_uri']     = URL_API.'user/login_user/google/';
// }elseif(PAGE == 'pendaftaran_dosen'){
	// $config['google']['redirect_uri']     = URL_API.'web/keanggotaan/google/';
// }elseif(PAGE == 'login_mahasiswa'){
	// $config['google']['redirect_uri']     = URL_API.'web/keanggotaan/google/';
// }else{
	// $config['google']['redirect_uri']     = URL_API.'web/keanggotaan/google_mahasiswa/';
// }
$config['google']['application_name'] = 'IDREN';
$config['google']['api_key']          = '';
$config['google']['scopes']           = array();