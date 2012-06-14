<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-12-25 14:22:26
         compiled from leaderboard/leaderboard_listall.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = 'c6c1709570bb51f68ba0662f913bf9ec'; ?><table align="center">
    <tr>
	<td>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'duels'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c6c1709570bb51f68ba0662f913bf9ec#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c6c1709570bb51f68ba0662f913bf9ec#0}';}?>

	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'exp_point'): ?>
	     <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c6c1709570bb51f68ba0662f913bf9ec#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c6c1709570bb51f68ba0662f913bf9ec#1}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'ques_won'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c6c1709570bb51f68ba0662f913bf9ec#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c6c1709570bb51f68ba0662f913bf9ec#2}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'achievements'): ?>
		 <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c6c1709570bb51f68ba0662f913bf9ec#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c6c1709570bb51f68ba0662f913bf9ec#3}';}?>
=======
<?php /* Smarty version 2.6.7, created on 2012-06-03 21:36:20
         compiled from leaderboard/leaderboard_listall.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = 'f16a435e66a2aa087157d2194e9edc9d'; ?><table align="center">
    <tr>
	<td>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'duels'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f16a435e66a2aa087157d2194e9edc9d#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:f16a435e66a2aa087157d2194e9edc9d#0}';}?>

	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'exp_point'): ?>
	     <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f16a435e66a2aa087157d2194e9edc9d#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:f16a435e66a2aa087157d2194e9edc9d#1}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'ques_won'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f16a435e66a2aa087157d2194e9edc9d#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:f16a435e66a2aa087157d2194e9edc9d#2}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'achievements'): ?>
		 <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:f16a435e66a2aa087157d2194e9edc9d#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:f16a435e66a2aa087157d2194e9edc9d#3}';}?>
>>>>>>> test2

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


<<<<<<< HEAD

=======
<?php /* Smarty version 2.6.7, created on 2012-04-01 01:07:58
         compiled from leaderboard/leaderboard_listall.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'leaderboard/leaderboard_listall.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\%%ED^ED6^ED6B2E12%%leaderboard_listall.tpl.html.inc'] = '3d7c9ceef4aa3b7e315e2112f5ff803d'; ?><table align="center">
    <tr>
	<td>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'duels'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_duels','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#0}';}?>

	    <?php endif; ?>
	    <?php if ($this->_tpl_vars['sm']['lb_flag'] == 'exp_point'): ?>
	     <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_exp_point','uname' => $this->_tpl_vars['sm']['uname'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#1}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'ques_won'): ?>
		<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_ques_won','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#2}';}?>

	    <?php endif;  if ($this->_tpl_vars['sm']['lb_flag'] == 'achievements'): ?>
		 <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'leaderboard','mgr' => 'leaderboard','choice' => 'lb_achievements','uname' => $this->_tpl_vars['sm']['uname'],'iduser' => $this->_tpl_vars['sm']['id_user'],'chk' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:3d7c9ceef4aa3b7e315e2112f5ff803d#3}';}?>

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


>>>>>>> test2
=======
>>>>>>> test2
