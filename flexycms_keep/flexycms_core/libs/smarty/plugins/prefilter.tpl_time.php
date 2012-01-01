<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* File:     prefilter.tpl.php
* Type:     prefilter
* Name:     tpl_time
* Purpose:  Adds tag to print current date and time  
*           Convert Labels identified with defined values in the labels file.
* -------------------------------------------------------------
*/
function smarty_prefilter_tpl_time($source, &$smarty)
{

	//Adds tag to print current date and time

	$source = "{current_date_time tpl_file=".$smarty->_current_file."}".$source; 
	 return $source;
	 
}



?> 