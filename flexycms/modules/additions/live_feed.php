<?php
global $link;

// has not been defined yet
define("AFIXI_ROOT", $_SERVER['DOCUMENT_ROOT']."/flexycms/");

$_SESSION['site_used'] = !empty($_SESSION['site_used'])?$_SESSION['site_used']:$_SERVER["HTTP_HOST"];

$_SESSION['site_used'] = preg_replace("/www./","",$_SESSION['site_used']);

if(!defined("SITE_USED") || $_SESSION['site_used'] != SITE_USED ){

	define("SITE_USED",$_SESSION['site_used']);

}

include_once(AFIXI_ROOT."configs/".SITE_USED."/constants.php");

$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);

//end
	    
	    $sql="SELECT tot_honour FROM ".TABLE_PREFIX."meme WHERE id_meme=130 LIMIT 1";
	    $res=mysqli_fetch_assoc(mysqli_query($link,$sql));
	    
	    if(!$res){
	    	// Could not find exp_point in MySQL database for user
			exit("2");
		}
		
		exit();
		var_dump($res);
		
		if($_SESSION['exp_point'] == $res['tot_honour']){
			// Exp points have not changed
			exit("9099999999909");		
			// Note: set high so that data cannot reach this XP and trigger incorrect update
	    } else {
	    	exit("1220");
	    
	    }
?>
