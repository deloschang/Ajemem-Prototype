<?php /* Smarty version 2.6.7, created on 2011-12-20 03:22:56
         compiled from user/right_pan.tpl.html */

$this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%35^35C^35CD1516%%right_pan.tpl.html.inc'] = '903086609b0e5625dabe9abfb8efb5ba';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/right_pan.tpl.html', 34, false),)), $this); ?>
<?php
function _smarty_tplfunc_903086609b0e5625dabe9abfb8efb5ba_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'user','mgr' => 'user','choice' => 'friend_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_903086609b0e5625dabe9abfb8efb5ba_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'paypal','mgr' => 'paypal','choice' => 'form'), $_smarty);
}



?>
