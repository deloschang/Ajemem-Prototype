<?php
class cms_bl extends business
{

function getbitsum($arr){
	$final = str_pad('',20,'0',STR_PAD_LEFT);
	foreach ($arr as $cur ){
		$cur = str_pad(decbin($cur),20,'0',STR_PAD_LEFT);
//			echo " Now in final is $final and I have got $cur  that is  :: ";
		$final = ($final | $cur) ;
//			echo " After addition $final <BR>";
	}
//		echo bindec($final)." final<BR>";
	return bindec($final);
}

};
?>