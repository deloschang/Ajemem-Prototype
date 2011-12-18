<?php
define("APP_ROOT",$_SERVER['DOCUMENT_ROOT']."/".SUB_DIR); // Document root of application
define("TEMPLATE_DIR",APP_ROOT."templates/"); // Document root of templates
define("TEMPLATE_BACKUP_DIR",APP_ROOT."templates_backup/"); // Document root of templates
define("APP_ADMIN_ROOT",APP_ROOT.'flexyadmin/'); // Document root of admin application
define("ADMIN_TEMPLATE_DIR",'templates_admin'); // Directory inside templates dir that contains all the admin templates
define("SITE_DOMAIN_NAME", $_SERVER['HTTP_HOST']."/".SUB_DIR);
define("APP_ROOT_URL",'http://'.SITE_DOMAIN_NAME);
define("APP_ROOT_URLS",'https://'.SITE_DOMAIN_NAME);
define("APP_ROOT_PATH",APP_ROOT_URL.'flexycms/');
define("APP_ADMIN_ROOT_URL",APP_ROOT_URL.'flexyadmin/'); // URL for admin application
define("LBL_SITE_URL",APP_ROOT_URL);
define("LBL_ADMIN_SITE_URL",APP_ROOT_URL.'flexyadmin/');
define("JS_PATH",'http://'.$_SERVER['HTTP_HOST']."/");

if($_SERVER['SERVER_ADDR']=='192.168.1.222'){
	define("JS_PATH_EXT",'http://'.$_SERVER['HTTP_HOST']."/libsext/");
}else{
	define("JS_PATH_EXT","http://ajax.googleapis.com/ajax/libs/");
}

define("LBL_SITE_RESOURCES_URL",APP_ROOT_URL.'waf_res/');
define("TEMP_ROOT",APP_ROOT.'waf_res/temp_content/'); // Remote file uploading
define("MAX",99999);
define('SESSION_TIMEOUT', 60);    //sets minutes
if(defined("SITE_USED")){
	include_once(AFIXI_ROOT.'configs/'.SITE_USED.'/constants.php');
}
?>
