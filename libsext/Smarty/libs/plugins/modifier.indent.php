<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty indent modifier plugin
 *
 * Type:     modifier<br>
 * Name:     indent<br>
 * Purpose:  indent lines of text
 * @link http://smarty.php.net/manual/en/language.modifier.indent.php
 *          indent (Smarty online manual)
 * @param string
 * @param integer
 * @param string
 * @return string
 */
function smarty_modifier_indent($string,$chars=4,$char=" ")
{
    return preg_replace('!^!m',str_repeat($char,$chars),$string);
}

?>
=======
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */


/**
 * Smarty indent modifier plugin
 *
 * Type:     modifier<br>
 * Name:     indent<br>
 * Purpose:  indent lines of text
 * @link http://smarty.php.net/manual/en/language.modifier.indent.php
 *          indent (Smarty online manual)
 * @param string
 * @param integer
 * @param string
 * @return string
 */
function smarty_modifier_indent($string,$chars=4,$char=" ")
{
    return preg_replace('!^!m',str_repeat($char,$chars),$string);
}

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
