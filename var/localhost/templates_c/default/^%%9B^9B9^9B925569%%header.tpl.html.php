<?php /* Smarty version 2.6.7, created on 2011-12-31 11:32:08
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 31/12/2011 11:32:08 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
<script type="text/javascript">
    function get_random_meme(){
	var url = "http://localhost/meme/meme_list/cat/rand";
	//$.fancybox.showActivity();
	$.fancybox.showLoading();
	$.post(url,{ce:0 },function(res){
	    $("#randpgexist").val(1);
	    $.fancybox.open(res,{
		    afterClose : function (){
				$("#randpgexist").val(0);
		     }
	     });
	    $.fancybox.update();
	 });
     }
</script>
'; ?>

<div id= "logoc">
<a href="http://localhost/"> <img src="http://localhost/templates/images/wmemejalogo.png" width="280px"  height="200px" id="logo"></a>
</div>
<div id="header">
   <div id ="headerbtns"> <table>
	<tr>
	<td>
	<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'addMeme'): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/meme/addMeme">Make-a-Meme</a>
	</td>
	<td>
	<?php if ($_SESSION['id_user']): ?>
		<li>
		<a href="javascript:void(0);" onclick="get_random_meme();">Go Random</a>
		</li>
		<?php else: ?>
		<li>
		<a href="javascript:void(0);" onclick="alert('you need to be logged in');">Go Random</a>
		</li>
	    <?php endif; ?>
	</td>
	<td>
	<a href="http://localhost/achievements/whatisMemeja">What is Memeja?</a>
	</td>
	<!--
	    Move this next to Exp Bar
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
		<!--<br/><a href="http://localhost/cms/show/code/memeja">What is Memeja</a>
		<br/><a href="http://localhost/achievements/whatisMemeja">What is Memeja</a>
		<br/><a href="http://localhost/leaderboard/leaderboard">Leaderboard</a>
		-->
	</div>
	</tr>
	</table>
	</div>
</div>
<!-- Template: common/header.tpl.html End --> 