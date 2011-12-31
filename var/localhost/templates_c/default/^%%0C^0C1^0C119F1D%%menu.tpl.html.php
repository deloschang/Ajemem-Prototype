<?php /* Smarty version 2.6.7, created on 2011-12-31 10:21:16
         compiled from common/menu.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/menu.tpl.html', 82, false),)), $this); ?>

<!-- Template: common/menu.tpl.html Start 31/12/2011 10:21:16 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script type="text/javascript">
    function get_random_meme(){
	var url = "http://localhost/meme/meme_list/cat/rand";
	$.fancybox.showLoading();
	$.post(url,{ce:0 },function(res){
	    $("#randpgexist").val(1);
	    $.fancybox.open(res,{
	    	minHeight : 630,
	    	minWidth : 480,
	    	//autoSize : true,
	    	//scrolling : true,
		    afterClose : function (){
				$("#randpgexist").val(0);
		     }
	     });
	    $.fancybox.update();
	 });
     }
    
    function get_random_meme_nlu(){
	var url = "http://localhost/meme/meme_nlu_rand";
	$.fancybox.showLoading();
	$.post(url,{ce:0 },function(res){
	    $("#randpgexist").val(1);
	    $.fancybox.open(res,{
	    	minHeight : 630,
	    	minWidth : 480,
	    	//autoSize : true,
	    	//scrolling : true,
		    afterClose : function (){
				$("#randpgexist").val(0);
		     }
	     });
	    $.fancybox.update();
	 });
     }
	$(document).ready(function(){
	$(window).scroll(function(e){
		var scrollTop = $(window).scrollTop();
		console.log(scrollTop);
		if(scrollTop > 35){
			   $(\'#xpbar\').css({
			    position:\'fixed\',
			    top:\'0px\',
			 });
			$(\'#xpbar_status\').css({
			    position:\'fixed\',
			    top:\'2px\',
			 });
			$(\'#user_level\').css({
			    position:\'fixed\',
			    top:\'2px\',
			 });
			
		 }else{
			$(\'#xpbar\').css({
			    position:\'absolute\',
			    top:\'30px\',
			 });
			$(\'#xpbar_status\').css({
			    position:\'absolute\',
			    top:\'32px\',
			 });
			$(\'#user_level\').css({
			    position:\'absolute\',
			    top:\'32px\',
			 });
		 }
	 });
 });
</script>
'; ?>

<table>
<tr><td>
<div id="xpbar">
</td><td>
<?php if ($_SESSION['id_user']): ?>	
	    Welcome <?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 !
	<?php else: ?>
	<div class="fb-login-button" scope="email, publish_stream ,user_education_history 	">
        Login with Facebook
      </div>
<?php endif; ?>	  
</td></tr>
<div id="user_level"></div>
<div id="xpbar_status"></div>
</div>

<div class="clear"></div>

<!-- Template: common/menu.tpl.html End --> 