<?php /* Smarty version 2.6.7, created on 2011-12-23 08:34:51
         compiled from user/mail_conf_frnd_request.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/mail_conf_frnd_request.tpl.html', 3, false),)), $this); ?>
Hi <?php echo $this->_tpl_vars['sm']['name']; ?>
,<br/>
	<?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp, true) : smarty_modifier_capitalize($_tmp, true)); ?>
 accepted your friend request.
 Regards,
  Admin