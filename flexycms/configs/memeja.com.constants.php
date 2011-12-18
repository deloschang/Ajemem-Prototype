<?php
/*
 * Created on Mar 13, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
define('SMARTY_DIR', $_SERVER['DOCUMENT_ROOT']."/libsext/Smarty/libs/");  // Location of Smarty libraries
define('VAR_DIR', AFIXI_ROOT."../var/".SITE_USED."/");  // Location of temmporay files created by the application 
define("REMOVE_SCRIPT_NAME" ,'SCRIPT_NAME');
define("PARSE_FOR_COLLECT_INPUT" ,'ORIG_PATH_INFO'); 
define("TEMPLATE_EXTENSION",'.tpl.html');
define("SITE_CONSTANTS","configs/".SITE_USED.".site_constants.php");
define("MOGRIFY_CMD",'mogrify');
