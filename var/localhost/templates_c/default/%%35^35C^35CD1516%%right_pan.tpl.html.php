<?php /* Smarty version 2.6.7, created on 2012-06-05 03:20:50
         compiled from user/right_pan.tpl.html */ ?>

<!-- Template: user/right_pan.tpl.html Start 05/06/2012 03:20:50 --> 
 <span id="right_pan">

<?php if ($_SESSION['id_user']): ?>  <!-- If not logged in, then don't show -->
	<!--<div class="fbfrnd">
		<a href="javascript:void(0);" onclick="invitePopup();" class="facebook">Invite Facebook Friends </a>
	</div>-->
<?php endif; ?>

<?php if ($_SESSION['id_user']): ?>
            
    <div>
		<br>
				</br>
	</div>
	    
	

<?php endif; ?>
</span>
<?php echo '
<script type="text/javascript">

// Find friends in Memeja to add
function show_memeje_frnds(){
	var url="http://localhost/index.php";
	$.post(url,{page:"user",choice:"get_memeje_frnds",ce:0 },function(res){//alert(res);
		//show_fancybox(res);
		 $.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				 $("#show_profile_info").html("");
			 }
		     });
	 })
 }

<!--function invitePopup() {-->
<!--	var z;-->
<!--	var url="http://localhost/index.php?page=user&choice=get_sent_users&ce=0";-->
<!--	var httpRequest = new XMLHttpRequest();-->
<!--	httpRequest.open(\'POST\', url, false);-->
<!--	httpRequest.send();-->
<!--	if (httpRequest.status == 200) {-->
<!--		z=httpRequest.responseText;-->
<!--	 }-->
<!--	FB.login(function(response) {-->
<!--		if (response.session) {-->
<!--			// user successfully logged in-->
<!--			FB.ui({-->
<!--				method:\'fbml.dialog\',-->
<!--				fbml: (-->
<!--				\'<fb:request-form method="post" action="http://localhost/user/invited/p/';  echo $_REQUEST['page']; ?>
/c/<?php echo $_REQUEST['choice'];  if ($_REQUEST['cat']): ?>/cat/<?php echo $_REQUEST['cat'];  endif;  echo '/*" type="Memeje"\' +-->
<!--				\'content="Share your thoughts through memes <fb:req-choice url=\\\'http://localhost/\\\' label=\\\'Accept\\\' />" >\' +-->
<!--				\'<fb:multi-friend-selector bypass="cancel" showborder="false" actiontext="Invite your friends to this network." exclude_ids="\'+z+\'"  max="20" rows="2" cols="3" email_invite="false" import_external_friends="false" condensed="false" uid=""/> \'+-->
<!--				\'</fb:request-form>\'-->
<!--				),-->
<!--				size: { \'width\':\'485\', height:480 }, \'width\':\'485\', height:480-->
<!--			 });-->

<!--			$(".FB_UI_Dialog").css(\'width\', \'485px\'); // 80% of window width  $(window).width()*0.65-->
<!--		 } else {-->
<!--			// user cancelled login-->
<!--		 }-->
<!--	 });-->

<!-- }-->

</script>
'; ?>


<!-- Template: user/right_pan.tpl.html End --> 