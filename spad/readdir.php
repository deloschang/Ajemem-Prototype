<?php
$dir=isset($_REQUEST['dir'])?$_REQUEST['dir']."/":'';
$dir = "images_new/".$dir;
listfile($dir);
function listfile($dir){
	$files = scandir($dir);
	$reg='/.LCK$/';
	$html="";
	foreach($files as $key => $value){
		if(!is_dir($value)){
			preg_match($reg,$value,$m);
			if(!$m){
				$html .= "<div class='idrag' style='float:left'><img height='100px' width='100px' src='http://".$_SERVER['HTTP_HOST']."/memeje/spad/".$dir.$value."' /></div>";
                                //$html .= "<img class='idrag' height='100px' width='100px' src='".$dir.$value."' />";
			}
		}
	}
	print $html;
}
