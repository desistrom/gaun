<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
define('EXIT_SUCCESS', 0); // no errors
define('EXIT_ERROR', 1); // generic error
define('EXIT_CONFIG', 3); // configuration error
define('EXIT_UNKNOWN_FILE', 4); // file not found
define('EXIT_UNKNOWN_CLASS', 5); // unknown class
define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
define('EXIT_USER_INPUT', 7); // invalid user input
define('EXIT_DATABASE', 8); // database error
define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code

define('URL_CHARGE', 'https://api.sandbox.midtrans.com/v2/charge');
define('URL_UNIVERSAL', 'https://api.sandbox.midtrans.com/v2/');

//for API versi 1

//define local
/*define('URL_GET_ALL_MEDIA_V1','http://localhost/idren/api/v1/galery');
define('URL_GET_ALL_ALBUM_V1','http://localhost/idren/api/v1/albumAll');
define('URL_GET_ALBUM_BY_ID_V1','http://localhost/idren/api/v1/getAlbumById?data=');
define('URL_GET_ALL_IMAGE_V1','http://localhost/idren/api/v1/galery_image');
define('URL_GET_ALL_VIDEO_V1','http://localhost/idren/api/v1/galery_video');
define('URL_GET_ID_TUBE_V1','http://localhost/idren/api/v1/tube_video');
define('URL_GET_VIDEO_PAGGING_V1','http://localhost/idren/api/v1/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING_V1','http://localhost/idren/api/v1/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID_V1','http://localhost/idren/api/v1/select_galery');
define('URL_GET_IMAGE_BY_ID_V1','http://localhost/idren/api/v1/search_galery_image');
define('URL_GET_VIDEO_BY_ID_V1','http://localhost/idren/api/v1/search_galery_video');
define('URL_REGISTER_V1','http://localhost/idren/api/v1/insert_instansi');
define('URL_INSERT_CONTACT_US_V1','http://localhost/idren/api/v1/insert_contact');
define('URL_GET_ABOUT_V1','http://localhost/idren/api/v1/about');
define('URL_GET_PENDAFTARAN_V1','http://localhost/idren/api/v1/step');
define('URL_GET_BENEFIT_V1','http://localhost/idren/api/v1/profit');
define('URL_GET_ALL_INSTANSI_V1','http://localhost/idren/api/v1/instansi');
define('URL_SEARCH_INSTANSI_V1','http://localhost/idren/api/v1/search_instansi');
define('URL_GET_INSTANSI_PAGGING_V1','http://localhost/idren/api/v1/instansi_pagging?data=');
define('URL_GET_ALL_NEWS_V1','http://localhost/idren/api/v1/news');
define('URL_GET_NEWS_PAGGING_V1','http://localhost/idren/api/v1/pagging_news?data=');
define('URL_SEARCH_NEWS_V1','http://localhost/idren/api/v1/search_news');
define('URL_GET_NEWS_BY_ID_V1','http://localhost/idren/api/v1/get_news_byid');
define('URL_GET_NEWS_BY_SLUG_V1','http://localhost/idren/api/v1/get_news_byslug?news=');
define('URL_GET_RSS_V1','http://localhost/idren/api/v1/get_rss');
define('URL_GET_TESTIMONI_V1','http://localhost/idren/api/v1/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING_V1','http://localhost/idren/api/v1/gettestimoni_pagging?data=');
define('URL_GET_HERO_V1','http://localhost/idren/api/v1/gethero');
define('URL_GET_TOPOLOGI_V1','http://localhost/idren/api/v1/gettopologi');
define('URL_GET_LOGO_V1','http://localhost/idren/api/v1/getlogo');
define('URL_GET_FOOTER_V1','http://localhost/idren/api/v1/getfooter');
define('URL_GET_AKADEMISI_TITLE_V1','http://localhost/idren/api/v1/gettitleslider');
define('URL_GET_FOUNDER_V1','http://localhost/idren/api/v1/founder');*/

//server
define('URL_GET_ALL_MEDIA_V1','http://128.199.233.73/idren/api/v1/galery');
define('URL_GET_ALL_ALBUM_V1','http://128.199.233.73/idren/api/v1/albumAll');
define('URL_GET_ALBUM_BY_ID_V1','http://128.199.233.73/idren/api/v1/getAlbumById?data=');
define('URL_GET_ALL_IMAGE_V1','http://128.199.233.73/idren/api/v1/galery_image');
define('URL_GET_ALL_VIDEO_V1','http://128.199.233.73/idren/api/v1/galery_video');
define('URL_GET_ID_TUBE_V1','http://128.199.233.73/idren/api/v1/tube_video');
define('URL_GET_VIDEO_PAGGING_V1','http://128.199.233.73/idren/api/v1/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING_V1','http://128.199.233.73/idren/api/v1/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID_V1','http://128.199.233.73/idren/api/v1/select_galery');
define('URL_GET_IMAGE_BY_ID_V1','http://128.199.233.73/idren/api/v1/search_galery_image');
define('URL_GET_VIDEO_BY_ID_V1','http://128.199.233.73/idren/api/v1/search_galery_video');
define('URL_REGISTER_V1','http://128.199.233.73/idren/api/v1/insert_instansi');
define('URL_INSERT_CONTACT_US_V1','http://128.199.233.73/idren/api/v1/insert_contact');
define('URL_GET_ABOUT_V1','http://128.199.233.73/idren/api/v1/about');
define('URL_GET_PENDAFTARAN_V1','http://128.199.233.73/idren/api/v1/step');
define('URL_GET_BENEFIT_V1','http://128.199.233.73/idren/api/v1/profit');
define('URL_GET_ALL_INSTANSI_V1','http://128.199.233.73/idren/api/v1/instansi');
define('URL_SEARCH_INSTANSI_V1','http://128.199.233.73/idren/api/v1/search_instansi');
define('URL_GET_INSTANSI_PAGGING_V1','http://128.199.233.73/idren/api/v1/instansi_pagging?data=');
define('URL_GET_ALL_NEWS_V1','http://128.199.233.73/idren/api/v1/news');
define('URL_GET_NEWS_PAGGING_V1','http://128.199.233.73/idren/api/v1/pagging_news?data=');
define('URL_SEARCH_NEWS_V1','http://128.199.233.73/idren/api/v1/search_news');
define('URL_GET_NEWS_BY_ID_V1','http://128.199.233.73/idren/api/v1/get_news_byid');
define('URL_GET_NEWS_BY_SLUG_V1','http://128.199.233.73/idren/api/v1/get_news_byslug?news=');
define('URL_GET_RSS_V1','http://128.199.233.73/idren/api/v1/get_rss');
define('URL_GET_TESTIMONI_V1','http://128.199.233.73/idren/api/v1/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING_V1','http://128.199.233.73/idren/api/v1/gettestimoni_pagging?data=');
define('URL_GET_HERO_V1','http://128.199.233.73/idren/api/v1/gethero');
define('URL_GET_TOPOLOGI_V1','http://128.199.233.73/idren/api/v1/gettopologi');
define('URL_GET_LOGO_V1','http://128.199.233.73/idren/api/v1/getlogo');
define('URL_GET_FOOTER_V1','http://128.199.233.73/idren/api/v1/getfooter');
define('URL_GET_AKADEMISI_TITLE_V1','http://128.199.233.73/idren/api/v1/gettitleslider');
define('URL_GET_FOUNDER_V1','http://128.199.233.73/idren/api/v1/founder');

//productio
/*define('URL_GET_ALL_MEDIA_V1','http://103.107.100.9/idren_new/api/v1/galery');
define('URL_GET_ALL_ALBUM_V1','http://103.107.100.9/idren_new/api/v1/albumAll');
define('URL_GET_ALBUM_BY_ID_V1','http://103.107.100.9/idren_new/api/v1/getAlbumById?data=');
define('URL_GET_ALL_IMAGE_V1','http://103.107.100.9/idren_new/api/v1/galery_image');
define('URL_GET_ALL_VIDEO_V1','http://103.107.100.9/idren_new/api/v1/galery_video');
define('URL_GET_ID_TUBE_V1','http://103.107.100.9/idren_new/api/v1/tube_video');
define('URL_GET_VIDEO_PAGGING_V1','http://103.107.100.9/idren_new/api/v1/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING_V1','http://103.107.100.9/idren_new/api/v1/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID_V1','http://103.107.100.9/idren_new/api/v1/select_galery');
define('URL_GET_IMAGE_BY_ID_V1','http://103.107.100.9/idren_new/api/v1/search_galery_image');
define('URL_GET_VIDEO_BY_ID_V1','http://103.107.100.9/idren_new/api/v1/search_galery_video');
define('URL_REGISTER_V1','http://103.107.100.9/idren_new/api/v1/insert_instansi');
define('URL_INSERT_CONTACT_US_V1','http://103.107.100.9/idren_new/api/v1/insert_contact');
define('URL_GET_ABOUT_V1','http://103.107.100.9/idren_new/api/v1/about');
define('URL_GET_PENDAFTARAN_V1','http://103.107.100.9/idren_new/api/v1/step');
define('URL_GET_BENEFIT_V1','http://103.107.100.9/idren_new/api/v1/profit');
define('URL_GET_ALL_INSTANSI_V1','http://103.107.100.9/idren_new/api/v1/instansi');
define('URL_SEARCH_INSTANSI_V1','http://103.107.100.9/idren_new/api/v1/search_instansi');
define('URL_GET_INSTANSI_PAGGING_V1','http://103.107.100.9/idren_new/api/v1/instansi_pagging?data=');
define('URL_GET_ALL_NEWS_V1','http://103.107.100.9/idren_new/api/v1/news');
define('URL_GET_NEWS_PAGGING_V1','http://103.107.100.9/idren_new/api/v1/pagging_news?data=');
define('URL_SEARCH_NEWS_V1','http://103.107.100.9/idren_new/api/v1/search_news');
define('URL_GET_NEWS_BY_ID_V1','http://103.107.100.9/idren_new/api/v1/get_news_byid');
define('URL_GET_NEWS_BY_SLUG_V1','http://103.107.100.9/idren_new/api/v1/get_news_byslug?news=');
define('URL_GET_RSS_V1','http://103.107.100.9/idren_new/api/v1/get_rss');
define('URL_GET_TESTIMONI_V1','http://103.107.100.9/idren_new/api/v1/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING_V1','http://103.107.100.9/idren_new/api/v1/gettestimoni_pagging?data=');
define('URL_GET_HERO_V1','http://103.107.100.9/idren_new/api/v1/gethero');
define('URL_GET_TOPOLOGI_V1','http://103.107.100.9/idren_new/api/v1/gettopologi');
define('URL_GET_LOGO_V1','http://103.107.100.9/idren_new/api/v1/getlogo');
define('URL_GET_FOOTER_V1','http://103.107.100.9/idren_new/api/v1/getfooter');
define('URL_GET_AKADEMISI_TITLE_V1','http://103.107.100.9/idren_new/api/v1/gettitleslider');
define('URL_GET_FOUNDER_V1','http://103.107.100.9/idren_new/api/v1/founder');*/

//for API versi 2

//define local
/*define('URL_GET_ALL_MEDIA_V2','http://localhost/idren/api/v2/galery');
define('URL_GET_ALL_ALBUM_V2','http://localhost/idren/api/v2/albumAll');
define('URL_GET_ALBUM_BY_ID_V2','http://localhost/idren/api/v2/getAlbumById?data=');
define('URL_GET_ALL_IMAGE_V2','http://localhost/idren/api/v2/galery_image');
define('URL_GET_ALL_VIDEO_V2','http://localhost/idren/api/v2/galery_video');
define('URL_GET_ID_TUBE_V2','http://localhost/idren/api/v2/tube_video');
define('URL_GET_VIDEO_PAGGING_V2','http://localhost/idren/api/v2/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING_V2','http://localhost/idren/api/v2/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID_V2','http://localhost/idren/api/v2/select_galery');
define('URL_GET_IMAGE_BY_ID_V2','http://localhost/idren/api/v2/search_galery_image');
define('URL_GET_VIDEO_BY_ID_V2','http://localhost/idren/api/v2/search_galery_video');
define('URL_REGISTER_V2','http://localhost/idren/api/v2/insert_instansi');
define('URL_INSERT_CONTACT_US_V2','http://localhost/idren/api/v2/insert_contact');
define('URL_GET_ABOUT_V2','http://localhost/idren/api/v2/about');
define('URL_GET_PENDAFTARAN_V2','http://localhost/idren/api/v2/step');
define('URL_GET_BENEFIT_V2','http://localhost/idren/api/v2/profit');
define('URL_GET_ALL_INSTANSI_V2','http://localhost/idren/api/v2/instansi');
define('URL_SEARCH_INSTANSI_V2','http://localhost/idren/api/v2/search_instansi');
define('URL_GET_INSTANSI_PAGGING_V2','http://localhost/idren/api/v2/instansi_pagging?data=');
define('URL_GET_ALL_NEWS_V2','http://localhost/idren/api/v2/news');
define('URL_GET_NEWS_PAGGING_V2','http://localhost/idren/api/v2/pagging_news?data=');
define('URL_SEARCH_NEWS_V2','http://localhost/idren/api/v2/search_news');
define('URL_GET_NEWS_BY_ID_V2','http://localhost/idren/api/v2/get_news_byid');
define('URL_GET_NEWS_BY_SLUG_V2','http://localhost/idren/api/v2/get_news_byslug?news=');
define('URL_GET_RSS_V2','http://localhost/idren/api/v2/get_rss');
define('URL_GET_TESTIMONI_V2','http://localhost/idren/api/v2/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING_V2','http://localhost/idren/api/v2/gettestimoni_pagging?data=');
define('URL_GET_HERO_V2','http://localhost/idren/api/v2/gethero');
define('URL_GET_TOPOLOGI_V2','http://localhost/idren/api/v2/gettopologi');
define('URL_GET_LOGO_V2','http://localhost/idren/api/v2/getlogo');
define('URL_GET_FOOTER_V2','http://localhost/idren/api/v2/getfooter');
define('URL_GET_AKADEMISI_TITLE_V2','http://localhost/idren/api/v2/gettitleslider');
define('URL_GET_PAGE_V2','http://localhost/idren/api/v2/page?link=');
define('URL_GET_SLIDER_FOTO_V2','http://localhost/idren/api/v2/getSliderFoto?key=');
define('URL_GET_DATA_FOTO_V2','http://localhost/idren/api/v2/getDataFoto');
define('URL_GET_COMMENT_V2','http://localhost/idren/api/v2/getComment?id=');
define('URL_GET_FOUNDER_V2','http://localhost/idren/api/v2/founder');*/

//server
define('URL_GET_ALL_MEDIA','http://128.199.233.73/idren/api/v2/galery');
define('URL_GET_ALL_ALBUM','http://128.199.233.73/idren/api/v2/albumAll');
define('URL_GET_ALBUM_BY_ID','http://128.199.233.73/idren/api/v2/getAlbumById?data=');
define('URL_GET_ALL_IMAGE','http://128.199.233.73/idren/api/v2/galery_image');
define('URL_GET_ALL_VIDEO','http://128.199.233.73/idren/api/v2/galery_video');
define('URL_GET_ID_TUBE','http://128.199.233.73/idren/api/v2/tube_video');
define('URL_GET_VIDEO_PAGGING','http://128.199.233.73/idren/api/v2/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING','http://128.199.233.73/idren/api/v2/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID','http://128.199.233.73/idren/api/v2/select_galery');
define('URL_GET_IMAGE_BY_ID','http://128.199.233.73/idren/api/v2/search_galery_image');
define('URL_GET_VIDEO_BY_ID','http://128.199.233.73/idren/api/v2/search_galery_video');
define('URL_REGISTER','http://128.199.233.73/idren/api/v2/insert_instansi');
define('URL_INSERT_CONTACT_US','http://128.199.233.73/idren/api/v2/insert_contact');
define('URL_GET_ABOUT','http://128.199.233.73/idren/api/v2/about');
define('URL_GET_PENDAFTARAN','http://128.199.233.73/idren/api/v2/step');
define('URL_GET_BENEFIT','http://128.199.233.73/idren/api/v2/profit');
define('URL_GET_ALL_INSTANSI','http://128.199.233.73/idren/api/v2/instansi');
define('URL_SEARCH_INSTANSI','http://128.199.233.73/idren/api/v2/search_instansi');
define('URL_GET_INSTANSI_PAGGING','http://128.199.233.73/idren/api/v2/instansi_pagging?data=');
define('URL_GET_ALL_NEWS','http://128.199.233.73/idren/api/v2/news');
define('URL_GET_NEWS_PAGGING','http://128.199.233.73/idren/api/v2/pagging_news?data=');
define('URL_SEARCH_NEWS','http://128.199.233.73/idren/api/v2/search_news');
define('URL_GET_NEWS_BY_ID','http://128.199.233.73/idren/api/v2/get_news_byid');
define('URL_GET_NEWS_BY_SLUG','http://128.199.233.73/idren/api/v2/get_news_byslug?news=');
define('URL_GET_RSS','http://128.199.233.73/idren/api/v2/get_rss');
define('URL_GET_TESTIMONI','http://128.199.233.73/idren/api/v2/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING','http://128.199.233.73/idren/api/v2/gettestimoni_pagging?data=');
define('URL_GET_HERO','http://128.199.233.73/idren/api/v2/gethero');
define('URL_GET_TOPOLOGI','http://128.199.233.73/idren/api/v2/gettopologi');
define('URL_GET_LOGO','http://128.199.233.73/idren/api/v2/getlogo');
define('URL_GET_FOOTER','http://128.199.233.73/idren/api/v2/getfooter');
define('URL_GET_AKADEMISI_TITLE','http://128.199.233.73/idren/api/v2/gettitleslider');
define('URL_GET_PAGE','http://128.199.233.73/idren/api/v2/page?link=');
define('URL_GET_SLIDER_FOTO','http://128.199.233.73/idren/api/v2/getSliderFoto?key=');
define('URL_GET_DATA_FOTO','http://128.199.233.73/idren/api/v2/getDataFoto');
define('URL_GET_COMMENT','http://128.199.233.73/idren/api/v2/getComment?id=');
define('URL_GET_FOUNDER','http://128.199.233.73/idren/api/v2/founder');

//production di pasang di server development
/*define('URL_GET_ALL_MEDIA','http://103.107.100.9/idren_new/api/v2/galery');
define('URL_GET_ALL_ALBUM','http://103.107.100.9/idren_new/api/v2/albumAll');
define('URL_GET_ALBUM_BY_ID','http://103.107.100.9/idren_new/api/v2/getAlbumById?data=');
define('URL_GET_ALL_IMAGE','http://103.107.100.9/idren_new/api/v2/galery_image');
define('URL_GET_ALL_VIDEO','http://103.107.100.9/idren_new/api/v2/galery_video');
define('URL_GET_ID_TUBE','http://103.107.100.9/idren_new/api/v2/tube_video');
define('URL_GET_VIDEO_PAGGING','http://103.107.100.9/idren_new/api/v2/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING','http://103.107.100.9/idren_new/api/v2/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID','http://103.107.100.9/idren_new/api/v2/select_galery');
define('URL_GET_IMAGE_BY_ID','http://103.107.100.9/idren_new/api/v2/search_galery_image');
define('URL_GET_VIDEO_BY_ID','http://103.107.100.9/idren_new/api/v2/search_galery_video');
define('URL_REGISTER','http://103.107.100.9/idren_new/api/v2/insert_instansi');
define('URL_INSERT_CONTACT_US','http://103.107.100.9/idren_new/api/v2/insert_contact');
define('URL_GET_ABOUT','http://103.107.100.9/idren_new/api/v2/about');
define('URL_GET_PENDAFTARAN','http://103.107.100.9/idren_new/api/v2/step');
define('URL_GET_BENEFIT','http://103.107.100.9/idren_new/api/v2/profit');
define('URL_GET_ALL_INSTANSI','http://103.107.100.9/idren_new/api/v2/instansi');
define('URL_SEARCH_INSTANSI','http://103.107.100.9/idren_new/api/v2/search_instansi');
define('URL_GET_INSTANSI_PAGGING','http://103.107.100.9/idren_new/api/v2/instansi_pagging?data=');
define('URL_GET_ALL_NEWS','http://103.107.100.9/idren_new/api/v2/news');
define('URL_GET_NEWS_PAGGING','http://103.107.100.9/idren_new/api/v2/pagging_news?data=');
define('URL_SEARCH_NEWS','http://103.107.100.9/idren_new/api/v2/search_news');
define('URL_GET_NEWS_BY_ID','http://103.107.100.9/idren_new/api/v2/get_news_byid');
define('URL_GET_NEWS_BY_SLUG','http://103.107.100.9/idren_new/api/v2/get_news_byslug?news=');
define('URL_GET_RSS','http://103.107.100.9/idren_new/api/v2/get_rss');
define('URL_GET_TESTIMONI','http://103.107.100.9/idren_new/api/v2/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING','http://103.107.100.9/idren_new/api/v2/gettestimoni_pagging?data=');
define('URL_GET_HERO','http://103.107.100.9/idren_new/api/v2/gethero');
define('URL_GET_TOPOLOGI','http://103.107.100.9/idren_new/api/v2/gettopologi');
define('URL_GET_LOGO','http://103.107.100.9/idren_new/api/v2/getlogo');
define('URL_GET_FOOTER','http://103.107.100.9/idren_new/api/v2/getfooter');
define('URL_GET_AKADEMISI_TITLE','http://103.107.100.9/idren_new/api/v2/gettitleslider');
define('URL_GET_PAGE','http://103.107.100.9/idren_new/api/v2/page?link=');
define('URL_GET_SLIDER_FOTO','http://103.107.100.9/idren_new/api/v2/getSliderFoto?key=');
define('URL_GET_DATA_FOTO','http://103.107.100.9/idren_new/api/v2/getDataFoto');
define('URL_GET_COMMENT','http://103.107.100.9/idren_new/api/v2/getComment?id=');
define('URL_GET_FOUNDER','http://103.107.100.9/idren_new/api/v2/founder');*/

//for API versi 3

//define local
/*define('URL_GET_ALL_MEDIA','http://localhost/idren/api/v3/galery');
define('URL_GET_ALL_ALBUM','http://localhost/idren/api/v3/albumAll');
define('URL_GET_ALBUM_BY_ID','http://localhost/idren/api/v3/getAlbumById?data=');
define('URL_GET_ALL_IMAGE','http://localhost/idren/api/v3/galery_image');
define('URL_GET_ALL_VIDEO','http://localhost/idren/api/v3/galery_video');
define('URL_GET_ID_TUBE','http://localhost/idren/api/v3/tube_video');
define('URL_GET_VIDEO_PAGGING','http://localhost/idren/api/v3/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING','http://localhost/idren/api/v3/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID','http://localhost/idren/api/v3/select_galery');
define('URL_GET_IMAGE_BY_ID','http://localhost/idren/api/v3/search_galery_image');
define('URL_GET_VIDEO_BY_ID','http://localhost/idren/api/v3/search_galery_video');
define('URL_REGISTER','http://localhost/idren/api/v3/insert_instansi');
define('URL_INSERT_CONTACT_US','http://localhost/idren/api/v3/insert_contact');
define('URL_GET_ABOUT','http://localhost/idren/api/v3/about');
define('URL_GET_PENDAFTARAN','http://localhost/idren/api/v3/step');
define('URL_GET_BENEFIT','http://localhost/idren/api/v3/profit');
define('URL_GET_ALL_INSTANSI','http://localhost/idren/api/v3/instansi');
define('URL_SEARCH_INSTANSI','http://localhost/idren/api/v3/search_instansi');
define('URL_GET_INSTANSI_PAGGING','http://localhost/idren/api/v3/instansi_pagging?data=');
define('URL_GET_ALL_NEWS','http://localhost/idren/api/v3/news');
define('URL_GET_NEWS_PAGGING','http://localhost/idren/api/v3/pagging_news?data=');
define('URL_SEARCH_NEWS','http://localhost/idren/api/v3/search_news');
define('URL_GET_NEWS_BY_ID','http://localhost/idren/api/v3/get_news_byid');
define('URL_GET_NEWS_BY_SLUG','http://localhost/idren/api/v3/get_news_byslug?news=');
define('URL_GET_RSS','http://localhost/idren/api/v3/get_rss');
define('URL_GET_TESTIMONI','http://localhost/idren/api/v3/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING','http://localhost/idren/api/v3/gettestimoni_pagging?data=');
define('URL_GET_HERO','http://localhost/idren/api/v3/gethero');
define('URL_GET_TOPOLOGI','http://localhost/idren/api/v3/gettopologi');
define('URL_GET_LOGO','http://localhost/idren/api/v3/getlogo');
define('URL_GET_FOOTER','http://localhost/idren/api/v3/getfooter');
define('URL_GET_AKADEMISI_TITLE','http://localhost/idren/api/v3/gettitleslider');
define('URL_GET_PAGE','http://localhost/idren/api/v3/page?link=');
define('URL_GET_SLIDER_FOTO','http://localhost/idren/api/v3/getSliderFoto?key=');
define('URL_GET_DATA_FOTO','http://localhost/idren/api/v3/getDataFoto');
define('URL_GET_FOUNDER','http://localhost/idren/api/v3/founder');*/

//server di pasanag di server production
/*define('URL_GET_ALL_MEDIA','http://128.199.233.73/idren/api/v3/galery');
define('URL_GET_ALL_ALBUM','http://128.199.233.73/idren/api/v3/albumAll');
define('URL_GET_ALBUM_BY_ID','http://128.199.233.73/idren/api/v3/getAlbumById?data=');
define('URL_GET_ALL_IMAGE','http://128.199.233.73/idren/api/v3/galery_image');
define('URL_GET_ALL_VIDEO','http://128.199.233.73/idren/api/v3/galery_video');
define('URL_GET_ID_TUBE','http://128.199.233.73/idren/api/v3/tube_video');
define('URL_GET_VIDEO_PAGGING','http://128.199.233.73/idren/api/v3/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING','http://128.199.233.73/idren/api/v3/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID','http://128.199.233.73/idren/api/v3/select_galery');
define('URL_GET_IMAGE_BY_ID','http://128.199.233.73/idren/api/v3/search_galery_image');
define('URL_GET_VIDEO_BY_ID','http://128.199.233.73/idren/api/v3/search_galery_video');
define('URL_REGISTER','http://128.199.233.73/idren/api/v3/insert_instansi');
define('URL_INSERT_CONTACT_US','http://128.199.233.73/idren/api/v3/insert_contact');
define('URL_GET_ABOUT','http://128.199.233.73/idren/api/v3/about');
define('URL_GET_PENDAFTARAN','http://128.199.233.73/idren/api/v3/step');
define('URL_GET_BENEFIT','http://128.199.233.73/idren/api/v3/profit');
define('URL_GET_ALL_INSTANSI','http://128.199.233.73/idren/api/v3/instansi');
define('URL_SEARCH_INSTANSI','http://128.199.233.73/idren/api/v3/search_instansi');
define('URL_GET_INSTANSI_PAGGING','http://128.199.233.73/idren/api/v3/instansi_pagging?data=');
define('URL_GET_ALL_NEWS','http://128.199.233.73/idren/api/v3/news');
define('URL_GET_NEWS_PAGGING','http://128.199.233.73/idren/api/v3/pagging_news?data=');
define('URL_SEARCH_NEWS','http://128.199.233.73/idren/api/v3/search_news');
define('URL_GET_NEWS_BY_ID','http://128.199.233.73/idren/api/v3/get_news_byid');
define('URL_GET_NEWS_BY_SLUG','http://128.199.233.73/idren/api/v3/get_news_byslug?news=');
define('URL_GET_RSS','http://128.199.233.73/idren/api/v3/get_rss');
define('URL_GET_TESTIMONI','http://128.199.233.73/idren/api/v3/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING','http://128.199.233.73/idren/api/v3/gettestimoni_pagging?data=');
define('URL_GET_HERO','http://128.199.233.73/idren/api/v3/gethero');
define('URL_GET_TOPOLOGI','http://128.199.233.73/idren/api/v3/gettopologi');
define('URL_GET_LOGO','http://128.199.233.73/idren/api/v3/getlogo');
define('URL_GET_FOOTER','http://128.199.233.73/idren/api/v3/getfooter');
define('URL_GET_AKADEMISI_TITLE','http://128.199.233.73/idren/api/v3/gettitleslider');
define('URL_GET_PAGE','http://128.199.233.73/idren/api/v3/page?link=');
define('URL_GET_SLIDER_FOTO','http://128.199.233.73/idren/api/v3/getSliderFoto?key=');
define('URL_GET_DATA_FOTO','http://128.199.233.73/idren/api/v3/getDataFoto');
define('URL_GET_COMMENT','http://128.199.233.73/idren/api/v3/getComment?id=');
define('URL_GET_FOUNDER','http://128.199.233.73/idren/api/v3/founder');*/

//productio
/*define('URL_GET_ALL_MEDIA','http://103.107.100.9/idren_new/api/v3/galery');
define('URL_GET_ALL_ALBUM','http://103.107.100.9/idren_new/api/v3/albumAll');
define('URL_GET_ALBUM_BY_ID','http://103.107.100.9/idren_new/api/v3/getAlbumById?data=');
define('URL_GET_ALL_IMAGE','http://103.107.100.9/idren_new/api/v3/galery_image');
define('URL_GET_ALL_VIDEO','http://103.107.100.9/idren_new/api/v3/galery_video');
define('URL_GET_ID_TUBE','http://103.107.100.9/idren_new/api/v3/tube_video');
define('URL_GET_VIDEO_PAGGING','http://103.107.100.9/idren_new/api/v3/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_PAGGING','http://103.107.100.9/idren_new/api/v3/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID','http://103.107.100.9/idren_new/api/v3/select_galery');
define('URL_GET_IMAGE_BY_ID','http://103.107.100.9/idren_new/api/v3/search_galery_image');
define('URL_GET_VIDEO_BY_ID','http://103.107.100.9/idren_new/api/v3/search_galery_video');
define('URL_REGISTER','http://103.107.100.9/idren_new/api/v3/insert_instansi');
define('URL_INSERT_CONTACT_US','http://103.107.100.9/idren_new/api/v3/insert_contact');
define('URL_GET_ABOUT','http://103.107.100.9/idren_new/api/v3/about');
define('URL_GET_PENDAFTARAN','http://103.107.100.9/idren_new/api/v3/step');
define('URL_GET_BENEFIT','http://103.107.100.9/idren_new/api/v3/profit');
define('URL_GET_ALL_INSTANSI','http://103.107.100.9/idren_new/api/v3/instansi');
define('URL_SEARCH_INSTANSI','http://103.107.100.9/idren_new/api/v3/search_instansi');
define('URL_GET_INSTANSI_PAGGING','http://103.107.100.9/idren_new/api/v3/instansi_pagging?data=');
define('URL_GET_ALL_NEWS','http://103.107.100.9/idren_new/api/v3/news');
define('URL_GET_NEWS_PAGGING','http://103.107.100.9/idren_new/api/v3/pagging_news?data=');
define('URL_SEARCH_NEWS','http://103.107.100.9/idren_new/api/v3/search_news');
define('URL_GET_NEWS_BY_ID','http://103.107.100.9/idren_new/api/v3/get_news_byid');
define('URL_GET_NEWS_BY_SLUG','http://103.107.100.9/idren_new/api/v3/get_news_byslug?news=');
define('URL_GET_RSS','http://103.107.100.9/idren_new/api/v3/get_rss');
define('URL_GET_TESTIMONI','http://103.107.100.9/idren_new/api/v3/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING','http://103.107.100.9/idren_new/api/v3/gettestimoni_pagging?data=');
define('URL_GET_HERO','http://103.107.100.9/idren_new/api/v3/gethero');
define('URL_GET_TOPOLOGI','http://103.107.100.9/idren_new/api/v3/gettopologi');
define('URL_GET_LOGO','http://103.107.100.9/idren_new/api/v3/getlogo');
define('URL_GET_FOOTER','http://103.107.100.9/idren_new/api/v3/getfooter');
define('URL_GET_AKADEMISI_TITLE','http://103.107.100.9/idren_new/api/v3/gettitleslider');
define('URL_GET_PAGE','http://103.107.100.9/idren_new/api/v3/page?link=');
define('URL_GET_SLIDER_FOTO','http://103.107.100.9/idren_new/api/v3/getSliderFoto?key=');
define('URL_GET_DATA_FOTO','http://103.107.100.9/idren_new/api/v3/getDataFoto');
define('URL_GET_COMMENT','http://103.107.100.9/idren_new/api/v3/getComment?id=');
define('URL_GET_FOUNDER','http://103.107.100.9/idren_new/api/v3/founder');*/

/*define('URL_GET_ALL_MEDIA_V2','http://192.168.88.157/idren/api/v3/galery');
define('URL_GET_ALL_ALBUM_V2','http://192.168.88.157/idren/api/v3/albumAll');
define('URL_GET_ALBUM_BY_ID_V2','http://192.168.88.157/idren/api/v3/getAlbumById?data=');
define('URL_GET_ALL_IMAGE_V2','http://192.168.88.157/idren/api/v3/galery_image');
define('URL_GET_ALL_VIDEO_V2','http://192.168.88.157/idren/api/v3/galery_video');
define('URL_GET_VIDEO_PAGGING_V2','http://192.168.88.157/idren/api/v3/galery_video_pagging?data=');
define('URL_GET_ID_TUBE_V2','http://192.168.88.157/idren/api/v3/tube_video');
define('URL_GET_ID_TUBE_PAGGING_V2','http://192.168.88.157/idren/api/v3/tube_video_pagging?data=');
define('URL_GET_GALERY_BY_ID_V2','http://192.168.88.157/idren/api/v3/select_galery');
define('URL_GET_IMAGE_BY_ID_V2','http://192.168.88.157/idren/api/v3/search_galery_image');
define('URL_GET_VIDEO_BY_ID_V2','http://192.168.88.157/idren/api/v3/search_galery_video');
define('URL_REGISTER_V2','http://192.168.88.157/idren/api/v3/insert_instansi');
define('URL_INSERT_CONTACT_US_V2','http://192.168.88.157/idren/api/v3/insert_contact');
define('URL_GET_ABOUT_V2','http://192.168.88.157/idren/api/v3/about');
define('URL_GET_PENDAFTARAN_V2','http://192.168.88.157/idren/api/v3/step');
define('URL_GET_BENEFIT_V2','http://192.168.88.157/idren/api/v3/profit');
define('URL_GET_ALL_INSTANSI_V2','http://192.168.88.157/idren/api/v3/instansi');
define('URL_SEARCH_INSTANSI_V2','http://192.168.88.157/idren/api/v3/search_instansi');
define('URL_GET_INSTANSI_PAGGING_V2','http://192.168.88.157/idren/api/v3/instansi_pagging?data=');
define('URL_GET_ALL_NEWS_V2','http://192.168.88.157/idren/api/v3/news');
define('URL_GET_NEWS_PAGGING_V2','http://192.168.88.157/idren/api/v3/pagging_news?data=');
define('URL_SEARCH_NEWS_V2','http://192.168.88.157/idren/api/v3/search_news');
define('URL_GET_NEWS_BY_ID_V2','http://192.168.88.157/idren/api/v3/get_news_byid');
define('URL_GET_NEWS_BY_SLUG_V2','http://192.168.88.157/idren/api/v3/get_news_byslug?news=');
define('URL_GET_RSS_V2','http://192.168.88.157/idren/api/v3/get_rss');
define('URL_GET_TESTIMONI_V2','http://192.168.88.157/idren/api/v3/gettestimoni');
define('URL_GET_TESTIMONI_PAGGING_V2','http://192.168.88.157/idren/api/v3/gettestimoni_pagging?data=');
define('URL_GET_HERO_V2','http://192.168.88.157/idren/api/v3/gethero');
define('URL_GET_TOPOLOGI_V2','http://192.168.88.157/idren/api/v3/gettopologi');
define('URL_GET_LOGO_V2','http://192.168.88.157/idren/api/v3/getlogo');
define('URL_GET_FOOTER_V2','http://192.168.88.157/idren/api/v3/getfooter');
define('URL_GET_AKADEMISI_TITLE_V2','http://192.168.88.157/idren/api/v3/gettitleslider');
define('URL_GET_PAGE_V2','http://192.168.88.157/idren/api/v3/page?link=');
define('URL_GET_SLIDER_FOTO_V2','http://192.168.88.157/idren/api/v3/getSliderFoto?key=');
define('URL_GET_DATA_FOTO_V2','http://192.168.88.157/idren/api/v3/getDataFoto');
define('URL_GET_FOUNDER_V2','http://192.168.88.157/idren/api/v3/founder');*/