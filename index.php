<?php
define("SUB_DIR", "");
session_name("memeja");
ob_start();
ini_set("memory_limit","8M");
$report = array ('stats' => array ());
define("THROUGH_CONTROLLER", 1);
define("AJAX", 0);

define("AFIXI_ROOT", $_SERVER['DOCUMENT_ROOT']."/".SUB_DIR."flexycms/");
define("AFIXI_CORE", $_SERVER['DOCUMENT_ROOT'].'/flexycms/flexycms_core/');
include (AFIXI_CORE."common5.php");

// Code for set multilanguage
if($GLOBALS['conf']['MULTI_LANG']['islang']){
	$_SESSION['multi_language']=$_SESSION['multi_language']?$_SESSION['multi_language']:"default";
}else{
	$_SESSION['multi_language']="";
}
// End code for set multilanguage

include ($_SERVER['DOCUMENT_ROOT'].'/flexycms/common_files.php');
if(defined("SITE_USED") && file_exists(AFIXI_ROOT.'../'.SITE_USED.'.php')){
	include_once(AFIXI_ROOT.'../'.SITE_USED.'.php');
}else{
	include_once(AFIXI_ROOT.'../site.php');
}

$site = new site; // called from site.php
$site->init(); // calls function in instance 'site'
$smarty = getSmarty(); // from common5.php, assigned to $smarty
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
		$_input['choice'] = str_replace('choice_', '', $_input['fail']);
	}
}

$page = isset ($_input['page']) ? $_input['page'] : 'common';
$site->handle_page($page);
$smarty->assign('page_title', $page_title);

if (isset($_input['ce']) ) {
	$site->set_container_enabled($_input['ce']);
}

//Added By Parwesh For Error Handling When Page is not found
$file_test = TEMPLATE_DIR.$_SESSION['multi_language']."/".$site->default_tpl.TEMPLATE_EXTENSION;

if($page =='user' || file_exists($file_test)) {
	if ($site->is_container_enabled()) {
	
		// $content used in common.tpl.html
		$smarty->assign('content', $smarty->add_theme_to_template($site->default_tpl));
		$tpl = isset ($_GET['c_tpl']) ? $_GET['c_tpl'] : $site->get_container_tpl();
	} else {
		$tpl = $site->default_tpl;
	}
	if (!empty ($_SESSION['CACHE_OUTPUT'])) {
		ob_start();
	}
	restore_error_handler();
	$report['debug'] = 0;
	$report['end_code'] = getmicrotime();
	$smarty->assign_by_ref('report', $report);
	$smarty->debugging_ctrl='URL';
	
	$smarty->display($tpl, $cache_id); //display func in AfixiSmarty.php
	
	$time_end = getmicrotime();
	unset ($_SESSION['raise_message']);
	if (!empty ($_SESSION['CACHE_OUTPUT'])) {
		ob_end_flush();
		unset ($_SESSION['CACHE_OUTPUT']);
	}
}else {
	if(!($page =='templates' || $page =='image')){
		$_SESSION['raise_message']['global'] = "<h2>The requested page is not available.<h2>";
		redirect(LBL_SITE_URL);
	}else{
		return;
	}
}
ob_end_flush();
