<?php /* Smarty version 2.6.7, created on 2011-11-02 08:34:59
         compiled from user/right_pan.tpl.html */

$this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%35^35C^35CD1516%%right_pan.tpl.html.inc'] = '78945e8c0df1ab99f9434a5a134a24ca';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'user/right_pan.tpl.html', 15, false),)), $this); ?>
<?php
function _smarty_tplfunc_78945e8c0df1ab99f9434a5a134a24ca_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'user','mgr' => 'user','choice' => 'friend_list','gmod' => 1), $_smarty);
}


function _smarty_tplfunc_78945e8c0df1ab99f9434a5a134a24ca_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'paypal','mgr' => 'paypal','choice' => 'form'), $_smarty);
}



?>