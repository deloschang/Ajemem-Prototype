<?php /* Smarty version 2.6.7, created on 2011-10-12 11:09:50
         compiled from leaderboard/leaderboard_listall.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['/home/bobeveal/public_html/memeja.com/flexycms/../var/memeja.com/templates_c/default/%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = '9107c264438dd21f976d901cb4890bb9'; ?><table align="center">
    <tr>
	<td>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'duels'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:9107c264438dd21f976d901cb4890bb9#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:9107c264438dd21f976d901cb4890bb9#0}';}?>

	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'exp_point'): ?>
	     <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:9107c264438dd21f976d901cb4890bb9#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:9107c264438dd21f976d901cb4890bb9#1}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'ques_won'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:9107c264438dd21f976d901cb4890bb9#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:9107c264438dd21f976d901cb4890bb9#2}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'achievements'): ?>
		 <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:9107c264438dd21f976d901cb4890bb9#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:9107c264438dd21f976d901cb4890bb9#3}';}?>

	    <?php endif; ?>
	</td>
    </tr>
</table>
<?php echo '
<script type="text/javascript">
    if(\'';  echo $this->_tpl_vars['sm']['search1'];  echo '\'==\'1\'){
	     $(\'#hsid\').html(" No such user in the rankings.");
     }
</script>
'; ?>


