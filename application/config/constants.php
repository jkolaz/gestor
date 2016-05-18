<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

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
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');
define('URL_PANEL',		'seguridad/principal/index');
define('URL_NO_LOGIN',		'index/index/1');
define('URL_LOGOUT',		'seguridad/seguridad/logout');
define('PREFIJO',		'gc_');

/*DATOS INSTITUCION*/
define('EMPRESA', '.:: GESTOR DE CONTENIDOS ::.');
define("IS_PRODUCTION", FALSE);
define("SERVER_HTTPS_PRO", "http://");
define("SUBCARPETA_NAME", "/");
define("SERVER_PATH", $_SERVER['DOCUMENT_ROOT'] . SUBCARPETA_NAME);
if(IS_PRODUCTION){
    define("SERVER_NAME", SERVER_HTTPS_PRO . 'www.jkolaz.com/tesis/');
    define("PATH_ADMIN", SERVER_PATH.'tesis/' );
}else{
    define("SERVER_NAME", SERVER_HTTPS_PRO . 'www.contenidos.devel/');
    define("PATH_ADMIN", SERVER_PATH );
}
define("PATH_LIBRARY", PATH_ADMIN . "application/libraries/");
define("PATH_GALLERY", PATH_ADMIN . "img/upload/");
define("PATH_PDF", PATH_ADMIN . "PDF/");
define("SERVER_PDF", SERVER_NAME . "PDF/");
/* End of file constants.php */
/* Location: ./application/config/constants.php */