<?php /* Smarty version 2.6.7, created on 2012-01-11 08:46:26
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 11/01/2012 08:46:26 --> 
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
		<form action="https://www.paypal.com/cgi-bin/webscr" method="post" align="right">
		<input type="hidden" name="cmd" value="_s-xclick">
		<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----">
		<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
		<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
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