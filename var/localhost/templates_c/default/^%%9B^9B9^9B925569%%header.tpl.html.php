<?php /* Smarty version 2.6.7, created on 2011-12-21 10:39:10
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 21/12/2011 10:39:10 --> 
 <div id="header">
	<h1><a href="http://localhost/">Memeja logo here</a></h1>
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