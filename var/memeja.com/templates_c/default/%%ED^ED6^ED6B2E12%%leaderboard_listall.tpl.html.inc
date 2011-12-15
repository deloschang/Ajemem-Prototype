<?php /* Smarty version 2.6.7, created on 2011-10-12 11:09:50
         compiled from leaderboard/leaderboard_listall.tpl.html */

$this->_cache_serials['/home/bobeveal/public_html/memeja.com/flexycms/../var/memeja.com/templates_c/default/%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = '9107c264438dd21f976d901cb4890bb9';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php
function _smarty_tplfunc_9107c264438dd21f976d901cb4890bb9_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $_smarty->_tpl_vars['sm']['uname'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_9107c264438dd21f976d901cb4890bb9_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $_smarty->_tpl_vars['sm']['uname'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_9107c264438dd21f976d901cb4890bb9_2(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $_smarty->_tpl_vars['sm']['uname'],'iduser' => $_smarty->_tpl_vars['sm']['id_user'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_9107c264438dd21f976d901cb4890bb9_3(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $_smarty->_tpl_vars['sm']['uname'],'iduser' => $_smarty->_tpl_vars['sm']['id_user'],'chk' => 1), $_smarty);
}



?>
