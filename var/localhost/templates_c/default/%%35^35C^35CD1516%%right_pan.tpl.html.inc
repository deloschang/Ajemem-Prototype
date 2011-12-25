<?php /* Smarty version 2.6.7, created on 2011-12-25 06:47:19
         compiled from user/right_pan.tpl.html */

$this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/%%35^35C^35CD1516%%right_pan.tpl.html.inc'] = '57895892a2bf240741962d39cf31010f';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/right_pan.tpl.html', 35, false),)), $this); ?>
<?php
function _smarty_tplfunc_57895892a2bf240741962d39cf31010f_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'user','mgr' => 'user','choice' => 'friend_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_57895892a2bf240741962d39cf31010f_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'paypal','mgr' => 'paypal','choice' => 'form'), $_smarty);
}



?>
