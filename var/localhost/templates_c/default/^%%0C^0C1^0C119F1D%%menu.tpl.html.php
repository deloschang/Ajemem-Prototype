<?php /* Smarty version 2.6.7, created on 2012-04-09 04:52:09
         compiled from common/menu.tpl.html */ ?>

<!-- Template: common/menu.tpl.html Start 09/04/2012 04:52:09 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
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


<?php if ($_SESSION['id_user'] && $_REQUEST['choice'] != 'addMeme'): ?>
<div id="follower">
	<div id="xpbar"></div>
</div>	

<div id="user_level"></div>
<div id="xpbar_status"></div>
<div class="clear"></div>
<?php endif; ?>
<!-- Template: common/menu.tpl.html End --> 