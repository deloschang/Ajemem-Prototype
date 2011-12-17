<<<<<<< HEAD
<?php
/**
 * Smarty plugin
 * @package Smarty
 * @subpackage plugins
 */

/**
 * Get seconds and microseconds
 * @return double
 */
function smarty_core_get_microtime($params, &$smarty)
{
    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = (double)($mtime[1]) + (double)($mtime[0]);
    return ($mtime);
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
 * Get seconds and microseconds
 * @return double
 */
function smarty_core_get_microtime($params, &$smarty)
{
    $mtime = microtime();
    $mtime = explode(" ", $mtime);
    $mtime = (double)($mtime[1]) + (double)($mtime[0]);
    return ($mtime);
}


/* vim: set expandtab: */

?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
