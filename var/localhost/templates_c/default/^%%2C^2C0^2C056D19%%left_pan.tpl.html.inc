<?php /* Smarty version 2.6.7, created on 2011-12-28 02:54:48
         compiled from user/left_pan.tpl.html */

$this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/^%%2C^2C0^2C056D19%%left_pan.tpl.html.inc'] = '9daec4fc5e2d7f030288f5d757b7b396';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/left_pan.tpl.html', 12, false),array('function', 'get_mod', 'user/left_pan.tpl.html', 44, false),)), $this); ?>
<?php
function _smarty_tplfunc_9daec4fc5e2d7f030288f5d757b7b396_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'achievements','mgr' => 'achievements','choice' => 'badge_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_9daec4fc5e2d7f030288f5d757b7b396_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_9daec4fc5e2d7f030288f5d757b7b396_2(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_9daec4fc5e2d7f030288f5d757b7b396_3(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_meme','gmod' => 1), $_smarty);
}



?>
