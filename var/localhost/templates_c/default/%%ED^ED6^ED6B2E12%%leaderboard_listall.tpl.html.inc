<?php /* Smarty version 2.6.7, created on 2011-12-27 05:15:41
         compiled from leaderboard/leaderboard_listall.tpl.html */

$this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = 'dbdbf369e24bdbd579fdcaf755e656f3';

?><?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php
function _smarty_tplfunc_dbdbf369e24bdbd579fdcaf755e656f3_0(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $_smarty->_tpl_vars['sm']['uname'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_dbdbf369e24bdbd579fdcaf755e656f3_1(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $_smarty->_tpl_vars['sm']['uname'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_dbdbf369e24bdbd579fdcaf755e656f3_2(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $_smarty->_tpl_vars['sm']['uname'],'iduser' => $_smarty->_tpl_vars['sm']['id_user'],'chk' => 1), $_smarty);
}


function _smarty_tplfunc_dbdbf369e24bdbd579fdcaf755e656f3_3(&$_smarty)
{
echo $_smarty->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $_smarty->_tpl_vars['sm']['uname'],'iduser' => $_smarty->_tpl_vars['sm']['id_user'],'chk' => 1), $_smarty);
}



?>
