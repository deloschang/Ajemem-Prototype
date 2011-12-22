<?php /* Smarty version 2.6.7, created on 2011-12-22 10:30:05
         compiled from common/header.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/header.tpl.html', 7, false),)), $this); ?>

<!-- Template: common/header.tpl.html Start 22/12/2011 10:30:05 --> 
 <div id="header">
	<h1><a href="http://localhost/">Memeja logo here</a></h1>
	<center>
	    <?php if ($_SESSION['id_user']): ?>
		 Welcome <?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>

	    <?php endif; ?>
	</center>
	<div class="fltrht" style="margin-top:0px;">
		<?php if ($_SESSION['id_admin'] || $_SESSION['id_user']): ?>
			<a href ="javascript:void(0);" onclick="fb_logout();">Logout</a>
	    <?php endif; ?>
	    
		<?php if ($_SESSION['id_admin']): ?>
			<br/><a href="http://localhost/flexyadmin/">Return to Admin Site</a>
		<?php endif; ?>
		
		<?php if (! $_SESSION['id_user']): ?>
		    <br/><a href="http://localhost/">Login</a>
		<?php endif; ?>
		
		<br/><a href="http://localhost/cms/show/code/aboutus">About Us</a>
		<!--<br/><a href="http://localhost/cms/show/code/memeja">What is Memeja</a>-->
		<br/><a href="http://localhost/achievements/whatisMemeja">What is Memeja</a>
		<br/><a href="http://localhost/leaderboard/leaderboard">Leaderboard</a>
	</div>
</div>

<!-- Template: common/header.tpl.html End --> 