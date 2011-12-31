<?php /* Smarty version 2.6.7, created on 2011-12-31 15:26:59
         compiled from common/header.tpl.html */ ?>

<!-- Template: common/header.tpl.html Start 31/12/2011 15:26:59 --> 
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
<a href="http://localhost/"> <img src="http://localhost/templates/images/rmemejalogo.png" width="280px"  height="200px" id="logo"></a>
</div>
<div id="header">
   <div id ="headerbtns"> 
      <img src="http://localhost/templates/images/joinmemeja.png" id="joinmemeja" onclick="$('#fblogin').slideToggle();" style="margin:-2px;">
		<a href="http://localhost/meme/addMeme"><img src="http://localhost/templates/images/create.png" id="create"style="margin:-2px;"></a>
	<?php if ($_SESSION['id_user']): ?>
		<a href="javascript:void(0);" onclick="get_random_meme();"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
		<?php else: ?>
		<a href="javascript:void(0);" onclick="alert('you need to be logged in');"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
	    <?php endif; ?>	
		<a href="http://localhost/achievements/whatisMemeja"><img src="http://localhost/templates/images/help.png"style="margin:-2px;"></a>
	</div>
	</div>
</div>
<div id="fblogin" style="display:none;"width="50px;"><div class="fb-login-button" scope="email, publish_stream ,user_education_history 	">
              Login with Facebook
          </div>
		  </div>
<!-- Template: common/header.tpl.html End --> 