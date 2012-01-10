<?php
error_reporting(E_ALL^E_NOTICE);
define("SUB_DIR", "");
session_name("memeja");
$report = array ('stats' => array ());
define("THROUGH_CONTROLLER", 1);
define("AJAX", 0);

define("AFIXI_ROOT", $_SERVER['DOCUMENT_ROOT']."/".SUB_DIR."flexycms/");
define("AFIXI_ROOT_ADMIN", $_SERVER['DOCUMENT_ROOT']."/".SUB_DIR."flexyadmin/");
define("AFIXI_CORE", $_SERVER['DOCUMENT_ROOT'].'/flexycms/flexycms_core/');

include (AFIXI_CORE."common5.php");

// Code for set multilanguage
if($GLOBALS['conf']['MULTI_LANG']['islang']){
	$_SESSION['multi_language']="default/";
}else{
	$_SESSION['multi_language']="";
}
// End code for set multilanguage

include ($_SERVER['DOCUMENT_ROOT'].'/flexycms/common_files.php');
define("ADMIN", 1);

if(defined("SITE_USED") && file_exists(AFIXI_ROOT_ADMIN.SITE_USED.'.php')){
	include_once(AFIXI_ROOT_ADMIN.SITE_USED.'.php');
}else{
	include_once(AFIXI_ROOT_ADMIN.'site.php');
}

$report['start_code'] = getmicrotime();

$smarty = getSmarty();
$site = new site;
$site->init();
$site->smarty= &$smarty;
$site->cache_id= &$cache_id;

if ($_input['mod']) {
	$result = user_templates::get_mod($_input,'',"ACTION");
	unset($_input['choice']);
    if ($result) {
		if(is_array($result)){
            redirect($result['redirect_url']);
        }else{
			$mgr = $_input['mgr'];
			if($mgr){
				$_input[$mgr.'_choice'] = str_replace('choice_', '', $_input['success']);
			}else{
	            $_input['choice'] = str_replace('choice_', '', $_input['success']);
			}
        }
	} else {
		$mgr = $_input['mgr'];
		if($mgr){
			$_input[$mgr.'_choice'] = str_replace('choice_', '', $_input['fail']);
		}else{
			$_input['choice'] = str_replace('choice_', '', $_input['fail']);
		}
	}
}
$page = isset ($_input['page']) ? $_input['page'] : 'admin';
$smarty->assign('page', $page);
$site->handle_page($page);
$page_title=$GLOBALS['conf']['PAGE_HEADERS'][$page.'_page_title'];
$smarty->assign('page_title', $page_title);

$ce = isset($_input['ce'])?$_input['ce']:"1";

//Added By Parwesh For Error Handling
$file_test = TEMPLATE_DIR.$_SESSION['multi_language']."/".$site->default_tpl.TEMPLATE_EXTENSION;
if($page =='user' || file_exists($file_test)) {
	if ($site->is_container_enabled($ce)) {
		$smarty->assign('content', $smarty->add_theme_to_template($site->default_tpl));
		$tpl = isset ($_GET['c_tpl']) ? $_GET['c_tpl'] : $site->get_container_tpl();
	} else {
		$tpl = $site->default_tpl;
	}

	if (!empty ($_SESSION['CACHE_OUTPUT'])) {
		ob_start();
	}
	restore_error_handler();
	error_reporting(E_ALL ^ E_NOTICE);
	$report['debug'] = 1;
	$report['end_code'] = getmicrotime();
	$smarty->assign_by_ref('report', $report); //&
	$smarty->display($tpl, $cache_id);
	$time_end = getmicrotime();
	unset ($_SESSION['raise_message']);
	if (!empty ($_SESSION['CACHE_OUTPUT'])) {
		ob_end_flush();
		unset ($_SESSION['CACHE_OUTPUT']);
	}
}else{
//	$_SESSION['raise_message']['global'] = "<h2>The requested page is not available.</h2>";
	redirect(LBL_ADMIN_SITE_URL);
}
