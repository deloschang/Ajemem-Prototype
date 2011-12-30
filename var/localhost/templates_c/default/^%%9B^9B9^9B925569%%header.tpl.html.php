<?php /* Smarty version 2.6.7, created on 2011-12-30 13:38:12
         compiled from common/header.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/header.tpl.html', 34, false),)), $this); ?>

<!-- Template: common/header.tpl.html Start 30/12/2011 13:38:12 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
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

<div id="header">
   <div id ="headerbtns"> <table>
	<tr>
	<td>
	<h1><a href="http://localhost/">MEMEJA</a></h1>
	</td>
	<!-- 
	
	   Move next to exp bar
	
	<center>
	    <?php if ($_SESSION['id_user']): ?>
		 Welcome <?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>

	    <?php endif; ?>
	</center>-->
	<td>
	<?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'addMeme'): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/meme/addMeme">Make-a-Meme</a>
	</td>
	<td>
	<a href="javascript:void(0);" onclick="get_random_meme();">Go Random</a>
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