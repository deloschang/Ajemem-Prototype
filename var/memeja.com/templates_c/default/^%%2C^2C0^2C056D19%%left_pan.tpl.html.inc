<?php /* Smarty version 2.6.7, created on 2011-10-15 16:53:33
         compiled from user/left_pan.tpl.html */

$this->_cache_serials['/home/bobeveal/public_html/memeja.com/flexycms/../var/memeja.com/templates_c/default/^%%2C^2C0^2C056D19%%left_pan.tpl.html.inc'] = '1b36eafaea10a201982e7f086ea0d896';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/left_pan.tpl.html', 28, false),)), $this); ?>
<?php
function _smarty_tplfunc_1b36eafaea10a201982e7f086ea0d896_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'achievements','mgr' => 'achievements','choice' => 'badge_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_1b36eafaea10a201982e7f086ea0d896_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_1b36eafaea10a201982e7f086ea0d896_2(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_1b36eafaea10a201982e7f086ea0d896_3(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_meme','gmod' => 1), $_smarty);
}



?>
