<?php
define("SUB_DIR", "");
session_name("memeja");
ob_start();
ini_set("memory_limit","16M");

require_once('/FirePHPCore/fb.php');

ini_set('display_errors', true);
error_reporting(E_ALL + E_NOTICE);

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

if (isset($_input['id'])){
	global $link;
	
	$sanitize_id =  mysql_real_escape_string($_input['id']);
	
	$sql = get_search_sql("user","dupe_username = '".$sanitize_id."' LIMIT 1");
	$temp_data = getrows($sql,$err);
	$profile_data = $temp_data[0];
	
	if ($profile_data['id_user']){
		$_SESSION['profile'] = $profile_data['username'];				//username
		$_SESSION['profile_id'] = $profile_data['id_user'];		
		$_SESSION['profile_uid'] = $profile_data['uid'];
		$_SESSION['profile_picture'] = $profile_data['fb_pic_normal'];
		$_SESSION['profile_dupe_username'] = $profile_data['dupe_username'];
		
		// count followers
		$page_sql="SELECT COUNT(*) FROM memeje__friends WHERE following=".$_SESSION['profile_id'];
	    $page_res=mysqli_query($link,$page_sql);
		
		if ($page_res){
			$page_row = $page_res->fetch_row();
			$_SESSION['profile_follower_count'] = $page_row[0];
		} else {
			$_SESSION['profile_follower_count'] = '0';
		}
		
		
		
		if ($_SESSION['id_user'] && $_SESSION['profile_id'] != $_SESSION['id_user']){
			// check if already following profile user
			$sql = get_search_sql("friends"," following=".$_SESSION['profile_id']." AND id_user=".$_SESSION['id_user']);
			$check = getrows($sql, $err);
			
			if ($check){
				$_SESSION['following'] = 'y';
			} else {
				$_SESSION['following'] = 'n';
			}
		} else {
			$_SESSION['following'] = 'self'; 
		}
		
		// requests to view a meme
		if ($_input['meme']){
			$input_meme = mysql_real_escape_string($_input['meme']);
			$sql = get_search_sql("meme","id_meme = '".$input_meme."' LIMIT 1");
			$temp_meme = getrows($sql,$err);
			$profile_meme = $temp_meme[0];
			
			if ($profile_meme['id_user'] == $profile_data['id_user']){
				//fb($profile_meme, 'profile meme is found');
				$_SESSION['profile_meme_title'] = $profile_meme['title'];
				$_SESSION['profile_meme_image'] = $profile_meme['image'];
				
				if ($profile_meme['tagged_user']){
					$tagged_data = explode(',',$profile_meme['tagged_user']);
					foreach($tagged_data as $key => $value){
						$tagged_data[$key] = array();
						$tagged_data[$key]['id'] = $value;
						$tagged_data[$key]['name'] = json_decode(file_get_contents('http://graph.facebook.com/'.$value))->name;
					}
					
					$_SESSION['profile_meme_tagged'] = $tagged_data;
				}
			} else{
			}
		}
	} else { 
		$_SESSION['profile'] = 'invalid';  // stop rendering, profile does not exist
		//fb('profile is deactivated');
	}
} else {
	$_SESSION['profile'] = 0;
	$_SESSION['profile_id'] = 0;
	$_SESSION['profile_uid'] = 0;
	$_SESSION['profile_picture'] = 0;
	
	$_SESSION['profile_meme_title'] = 0;
	$_SESSION['profile_meme_image'] = 0;
	$_SESSION['profile_meme_tagged'] = 0;
	
	$_SESSION['following'] = 0;
}

$site->handle_page($page); //sets default_tpl to $page/home UNLESS static

$smarty->assign('page_title', $page_title);

if (isset($_input['ce']) ) {
	$site->set_container_enabled($_input['ce']);
}

$file_test = TEMPLATE_DIR.$_SESSION['multi_language']."/".$site->default_tpl.TEMPLATE_EXTENSION;

if($page =='user' || file_exists($file_test)) {
	if ($site->is_container_enabled()) {
	
		// $content used in common.tpl.html to show live feed/meme editor
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
	
	$smarty->display($tpl, $cache_id); //display func in AfixiSmarty.php; executes template
	
	$time_end = getmicrotime();
	unset ($_SESSION['raise_message']);
	if (!empty ($_SESSION['CACHE_OUTPUT'])) {
		ob_end_flush();
		unset ($_SESSION['CACHE_OUTPUT']);
	}

} else {

	// Error handling because file does not exist
	if(!($page =='templates' || $page =='image')){
		$_SESSION['raise_message']['global'] = "<h2>Herp a derp?<h2>";
		redirect(LBL_SITE_URL);
	}else{
		return;
	}
}
ob_end_flush();
