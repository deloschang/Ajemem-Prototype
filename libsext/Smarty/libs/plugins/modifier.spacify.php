<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty spacify modifier plugin
 *
 * Type:     modifier<br>
 * Name:     spacify<br>
 * Purpose:  add spaces between characters in a string
 * @link http://smarty.php.net/manual/en/language.modifier.spacify.php
 *          spacify (Smarty online manual)
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_spacify($string, $spacify_char = ' ')
{
    return implode($spacify_char,
                   preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY));
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
 * Smarty spacify modifier plugin
 *
 * Type:     modifier<br>
 * Name:     spacify<br>
 * Purpose:  add spaces between characters in a string
 * @link http://smarty.php.net/manual/en/language.modifier.spacify.php
 *          spacify (Smarty online manual)
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_spacify($string, $spacify_char = ' ')
{
    return implode($spacify_char,
                   preg_split('//', $string, -1, PREG_SPLIT_NO_EMPTY));
}

/* vim: set expandtab: */

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
