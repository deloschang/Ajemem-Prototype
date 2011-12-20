<?php /* Smarty version 2.6.7, created on 2011-12-20 12:40:34
         compiled from user/left_pan.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/left_pan.tpl.html', 12, false),array('function', 'get_mod', 'user/left_pan.tpl.html', 28, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\^%%2C^2C0^2C056D19%%left_pan.tpl.html.inc'] = '32b168ceb2650cf359c29b0d796cebbe';  if ($_SESSION['id_user']): ?>
<table style="margin-top:0px" >
    <tr>
		<td valign="top">
			<div id="changePhoto" style="margin-top:1px">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/avatar.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
		</td>
    </tr>
     <tr>
		<td><b><?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  if ($_SESSION['mname']): ?> <?php echo $_SESSION['mname'];  endif; ?> <?php echo ((is_array($_tmp=$_SESSION['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></td>
    </tr>
    <tr>
		<td>Rank #<b><?php if ($_SESSION['achv_rank']):  echo $_SESSION['achv_rank'];  else: ?>NA<?php endif; ?></b></td>
    </tr>
    <tr>
		<td><a href="javascript:void(0);">Account Setting</a></td>
    </tr>
    <tr>

    </tr>
    <tr>
		<td>
			<div id="badge_list" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:32b168ceb2650cf359c29b0d796cebbe#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'achievements','mgr' => 'achievements','choice' => 'badge_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:32b168ceb2650cf359c29b0d796cebbe#0}';}?>

			</div>
		</td>
    </tr>
    <tr>
		<td>
		<div id="my_meme_list" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:32b168ceb2650cf359c29b0d796cebbe#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:32b168ceb2650cf359c29b0d796cebbe#1}';}?>

		</div>
		</td>
    </tr>
	<tr>
		<td>
		<div id="my_favorites" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:32b168ceb2650cf359c29b0d796cebbe#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:32b168ceb2650cf359c29b0d796cebbe#2}';}?>

		</div>
		</td>
    </tr>
	<tr>
		<td>
		<div id="tagged_meme" >
			<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:32b168ceb2650cf359c29b0d796cebbe#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_meme','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:32b168ceb2650cf359c29b0d796cebbe#3}';}?>

		</div>
		</td>
    </tr>
	<tr>     </tr>
	
</table>
<?php endif; ?>
