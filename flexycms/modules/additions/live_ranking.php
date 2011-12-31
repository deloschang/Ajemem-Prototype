<?php
global $link;

// has not been defined yet
define("AFIXI_ROOT", $_SERVER['DOCUMENT_ROOT']."/flexycms/");
define("AFIXI_CORE", $_SERVER['DOCUMENT_ROOT'].'/flexycms/flexycms_core/');

$_SESSION['site_used'] = !empty($_SESSION['site_used'])?$_SESSION['site_used']:$_SERVER["HTTP_HOST"];

$_SESSION['site_used'] = preg_replace("/www./","",$_SESSION['site_used']);

if(!defined("SITE_USED") || $_SESSION['site_used'] != SITE_USED ){

	define("SITE_USED",$_SESSION['site_used']);

}

include_once(AFIXI_ROOT."configs/".SITE_USED."/constants.php");
include(AFIXI_CORE."common.php");

$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);

//end
	    
	    $sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=".$_SESSION['id_user'];
	    $res=getsingleindexrow($sql_ach);
	    
	    if(!$res){
	    	// Could not find exp_point in MySQL database for user
			exit("no update");
		}
		
		//var_dump($res);
		
		if($_SESSION['ach_rank'] == $res['POSITION']){
			// Exp points have not changed
			exit("9099999999909");		
			// Note: set high so that data cannot reach this XP and trigger incorrect update
	    } else {
	    	exit();
	    
	    }
?>
