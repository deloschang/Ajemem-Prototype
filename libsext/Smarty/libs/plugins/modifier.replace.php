<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php
 *          replace (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_replace($string, $search, $replace)
{
    return str_replace($search, $replace, $string);
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
 * Smarty replace modifier plugin
 *
 * Type:     modifier<br>
 * Name:     replace<br>
 * Purpose:  simple search/replace
 * @link http://smarty.php.net/manual/en/language.modifier.replace.php
 *          replace (Smarty online manual)
 * @param string
 * @param string
 * @param string
 * @return string
 */
function smarty_modifier_replace($string, $search, $replace)
{
    return str_replace($search, $replace, $string);
}

/* vim: set expandtab: */

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
