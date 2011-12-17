<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strip<br>
 * Purpose:  Replace all repeated spaces, newlines, tabs
 *           with a single space or supplied replacement string.<br>
 * Example:  {$var|strip} {$var|strip:"&nbsp;"}
 * Date:     September 25th, 2002
 * @link http://smarty.php.net/manual/en/language.modifier.strip.php
 *          strip (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version  1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_strip($text, $replace = ' ')
{
    return preg_replace('!\s+!', $replace, $text);
}

/* vim: set expandtab: */

?>
=======
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty strip modifier plugin
 *
 * Type:     modifier<br>
 * Name:     strip<br>
 * Purpose:  Replace all repeated spaces, newlines, tabs
 *           with a single space or supplied replacement string.<br>
 * Example:  {$var|strip} {$var|strip:"&nbsp;"}
 * Date:     September 25th, 2002
 * @link http://smarty.php.net/manual/en/language.modifier.strip.php
 *          strip (Smarty online manual)
 * @author   Monte Ohrt <monte at ohrt dot com>
 * @version  1.0
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_strip($text, $replace = ' ')
{
    return preg_replace('!\s+!', $replace, $text);
}

/* vim: set expandtab: */

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
