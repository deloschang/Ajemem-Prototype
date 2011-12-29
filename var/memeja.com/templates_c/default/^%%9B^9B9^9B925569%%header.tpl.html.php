<?php /* Smarty version 2.6.7, created on 2011-12-22 13:18:28
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 22/12/2011 13:18:28 --> 
 <div id="header">
	<h1><a href="http://memeja.com/">Memeja logo here</a></h1>
	<center>
	    <?php if ($_SESSION['id_user']): ?>
		 Welcome <?php echo $_SESSION['fname']; ?>

	    <?php endif; ?>
	</center>
	<div class="fltrht" style="margin-top:0px;">
		<?php if ($_SESSION['id_admin'] || $_SESSION['id_user']): ?>
			<a href ="javascript:void(0);" onclick="fb_logout();">Logout</a>
	    <?php endif; ?>
		<?php if ($_SESSION['id_admin']): ?>
			<br/><a href="http://memeja.com/flexyadmin/">Return to Admin Site</a>
		<?php endif; ?>
		<?php if (! $_SESSION['id_user']): ?>
		    <br/><a href="http://memeja.com/">Login</a>
		<?php endif; ?>

		<br/><a href="http://memeja.com/cms/show/code/aboutus">About Us</a>
		<!--<br/><a href="http://memeja.com/cms/show/code/memeja">What is Memeja</a>-->
		<br/><a href="http://memeja.com/achievements/whatisMemeja">What is Memeja</a>
		<br/><a href="http://memeja.com/leaderboard/leaderboard">Leaderboard</a>
	</div>
</div>
<!-- Template: common/header.tpl.html End --> 