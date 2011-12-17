<<<<<<< HEAD
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
=======
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
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>