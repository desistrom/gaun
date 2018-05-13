<?php

// To use reCAPTCHA, you need to sign up for an API key pair for your site.
// link: http://www.google.com/recaptcha/admin
if ($_SERVER['SERVER_NAME'] == 'localhost') {
	$config['recaptcha_site_key'] = '6LcluEMUAAAAAFpQYID29hcCHLqZ_swAYMCPqtmK';
	$config['recaptcha_secret_key'] = '6LcluEMUAAAAACw4DieGyawZfxdl9NvP7xBpBS4i';
}elseif ($_SERVER['SERVER_NAME'] == '192.168.88.138') {
	$config['recaptcha_site_key'] = '6Lc1tkMUAAAAAOiWx6tY8JZU0wNDdyLN-FME7sy9';
	$config['recaptcha_secret_key'] = '6Lc1tkMUAAAAACJGOt6y9dmhpWR-xrVDx5NzoIGE';
}else{
	$config['recaptcha_site_key'] = '6LdauUMUAAAAAI1FtUG_c1WsrHqmviswNtqn1VcE';
	$config['recaptcha_secret_key'] = '6LdauUMUAAAAAB6e4HnuCA6pls9XB7F51c8SMDe_';
}

// reCAPTCHA supported 40+ languages listed here:
// https://developers.google.com/recaptcha/docs/language
$config['recaptcha_lang'] = 'en';

/* End of file recaptcha.php */
/* Location: ./application/config/recaptcha.php */
