<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-01-14 07:08:49
=======
<?php /* Smarty version 2.6.7, created on 2012-04-01 08:49:19
>>>>>>> test2
         compiled from common/menu.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/menu.tpl.html', 81, false),)), $this); ?>

<<<<<<< HEAD
<!-- Template: common/menu.tpl.html Start 14/01/2012 07:08:49 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
<script type="text/javascript">
    function get_random_meme(){
	var url = "http://memeja.com/meme/meme_list/cat/rand";
=======
<!-- Template: common/menu.tpl.html Start 01/04/2012 08:49:19 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script type="text/javascript">
    function get_random_meme(){
	var url = "http://www.memeja.com/meme/meme_list/cat/rand";
>>>>>>> test2
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
<<<<<<< HEAD
	var url = "http://memeja.com/meme/meme_nlu_rand";
=======
	var url = "http://www.memeja.com/meme/meme_nlu_rand";
>>>>>>> test2
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
	/*$(document).ready(function(){
	$(window).scroll(function(e){
		var scrollTop = $(window).scrollTop();
		console.log(scrollTop);
		if(scrollTop > 85){
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
			    top:\'80px\',
			 });
			$(\'#xpbar_status\').css({
			    position:\'absolute\',
			    top:\'82px\',
			 });
			$(\'#user_level\').css({
			    position:\'absolute\',
			    top:\'82px\',
			 });
		 }
	 });
 });*/
</script>
'; ?>

<div id="follower">
<div id="xpbar"></div>
<div id="fbstuff">
<?php if ($_SESSION['id_user']): ?>	
<<<<<<< HEAD
	    <a href ="http://memeja.com/">Welcome <?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
=======
	    <a href ="http://www.memeja.com/">Welcome <?php echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
>>>>>>> test2
 !</a>
	<?php else: ?>
	<div class="fb-login-button" scope="email, publish_stream ,user_education_history 	">
        Memebook
      </div>
<?php endif; ?>	  
</div>
</div>	
<div id="user_level"></div>
<div id="xpbar_status"></div>
<div class="clear"></div>

<!-- Template: common/menu.tpl.html End --> 