<?php /* Smarty version 2.6.7, created on 2012-01-01 03:05:06
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 01/01/2012 03:05:06 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
<script type="text/javascript">
    function get_random_meme(){
	$(window).scrollBy(0,5);
	$(window).scroll(function(e){
	$(\'#xpbar\').css({
			    position:\'fixed\',
			    top:\'0px!important!\',
			 });
	 }
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
	function submit()
	{
	 $(\'#searches\').submit();
	 }
	
</script>
'; ?>

<!-- Memeja Logo -->
<div id= "logoc">
<a href="http://localhost/"> <img src="http://localhost/templates/images/rmemejalogo.png" width="280px"  height="200px" id="logo"></a>
</div>

<!-- Memeja Top Bar -->
<div id="header">
   <div id ="headerbtns"> 
   <?php if (! $_SESSION['id_user']): ?>
      <img src="http://localhost/templates/images/joinmemeja.png" id="joinmemeja" onclick="$('#fblogin').slideToggle();" style="margin:-2px;">
   <?php else: ?>
      <img src="http://localhost/templates/images/logout.png" id="logout" onclick="fb_logout();" style="margin:-2px;">
   <?php endif; ?>
		<a href="http://localhost/meme/addMeme"><img src="http://localhost/templates/images/create.png" id="create"style="margin:-2px;"></a>
	<?php if ($_SESSION['id_user']): ?>
		<a href="javascript:void(0);" onclick="get_random_meme();"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
		<?php else: ?>
		<a href="javascript:void(0);" onclick="alert('you need to be logged in');"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
	    <?php endif; ?>	
		<a href="http://localhost/achievements/whatisMemeja"><img src="http://localhost/templates/images/help.png"style="margin:-2px;"></a>
		<img src="http://localhost/templates/images/searchend.png"style="margin:-2px;position:absolute;left:375px;z-index:99;" onclick="submit();">
		<div style="position:absolute; top:8px; left:385px;z-index:100;">
		<form id ="searches">
		<input type="text" name="mtitle" id="mtitle" value="<?php echo $_REQUEST['mtitle']; ?>
" onUnfocus="submit();"/>
		</form>
		</div>
	</div>
	</div>
</div>

<!-- FB LOGIN -->
<div id="fblogin" style="display:none;"width="50px;"><div class="fb-login-button" scope="email, publish_stream ,user_education_history 	">
              Login with Facebook
                                                     </div>
</div>
<!-- Template: common/header.tpl.html End --> 