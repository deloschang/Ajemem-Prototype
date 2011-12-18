<?php
/*
 * Created on Mar 13, 2006
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 

/*
* Smarty plugin
* -------------------------------------------------------------
* File:     prefilter.tpl_theme.php
* Type:     prefilter
* Name:     tpl_theme
* Purpose:  Adds the current theme to templates foundin includes.
* -------------------------------------------------------------
*/
function smarty_prefilter_tpl_theme($source, &$smarty)
{
    return "\necho '" . $smarty->_current_file . " compiled at " . date('Y-m-d H:M'). "';";
}

?>
