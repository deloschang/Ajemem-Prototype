<?php /* Smarty version 2.6.7, created on 2012-06-17 02:08:52
         compiled from common/common.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/common.tpl.html', 562, false),array('function', 'get_mod', 'common/common.tpl.html', 593, false),)), $this); ?>
<?php $this->_cache_serials['C:/xampp/htdocs/flexycms/../var/localhost/templates_c/default\^%%4F^4F7^4F7F9384%%common.tpl.html.inc'] = '49df79673400ace4f30a693476e0865d'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memeja: You Know What I Meme?</title>
<link rel="shortcut icon" href="http://localhost/templates/images/memeja_icon.ico" >
<?php $this->assign('appid', $this->_tpl_vars['util']->get_values_from_config('FACEBOOK')); ?>
<?php $this->assign('chc', $_REQUEST['choice']); ?>
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>

<script type="text/javascript" src="http://localhost/libsext/jquery/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox.pack.js?v=2.0.5"></script>
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-buttons.js?v=2.0.5"></script>
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-thumbs.js?v=2.0.5"></script>
<script type="text/javascript" src="http://localhost/templates/flexyjs/flexymessage.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ui.datepicker.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://localhost/libsext/hotkeys/jquery.hotkeys.js"></script>
<script type="text/javascript" src="http://localhost/libsext/hoverintent/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.core.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.highlight.js"></script>
<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<?php echo '

<script type="text/javascript">
	var chc = "';  echo $this->_tpl_vars['chc'];  echo '";
	var idu = "';  echo $_SESSION['id_user'];  echo '";
	
	var follow_count = parseInt(';  echo $_SESSION['profile_follower_count'];  echo ');
	
		// Variables for XP updating
		var curr_xp = ';  if ($_SESSION['exp_point']):  echo $_SESSION['exp_point'];  else: ?>0<?php endif;  echo ';
		var xp_to_level = ';  if ($_SESSION['xp_to_level']):  echo $_SESSION['xp_to_level'];  else: ?>0<?php endif;  echo ';
		var previous_xp_to_level = ';  if ($_SESSION['previous_xp_to_level']):  echo $_SESSION['previous_xp_to_level'];  else: ?>0<?php endif;  echo ';

		var user_level = ';  if ($_SESSION['level']):  echo $_SESSION['level'];  else: ?>0<?php endif;  echo ';

		if (user_level == 1) {
			var xp_percent = (curr_xp / xp_to_level) * 100;
		 } else {
			';  if ($_SESSION['exp_point']): ?>
				xp_percent = (curr_xp - previous_xp_to_level) / (xp_to_level - previous_xp_to_level) * 100;
			<?php else: ?>xp_percent = 0<?php endif;  echo '
		 }
		
		var rank_wait = 40000;
		var xp_wait = 8000;
	
	$(document).ready(function(){
		if (idu) {
			// User XP initial display
			$("#xpbar").progressbar({
				value: xp_percent
			 });
			
			$("#user_level").html(\'L\'+user_level);
			$("#xpbar_status").html(xp_percent.toFixed(2) +\'%\');
			
			// Mouseover shows XP and %
			$("#xpbar, #xpbar_status").hoverIntent({
				interval: 200,
				timeout:1000
			 });
			
			$("#xpbar, #xpbar_status, #user_level").hoverIntent(function(){
				$("#xpbar_status").delay(200).show();
			 }, function() {
				$("#xpbar_status").delay(1000).fadeOut();
			 });
		 }

		var scrn_height = window.screen.availHeight;
            $("#mid_cont").height(scrn_height/2 + scrn_height/9);

	    /* For notification */
	    $(".inner").hide();
	    $(\'#slidebottom div\').click(function() {
			get_details_notification();
			$(this).next().slideToggle();
	     });

	    if(idu!="" && chc!=\'addMeme\'){
			//setInterval("getall_notification()",7000); for notifications
			
	    /* For popup bar */
			setTimeout("popup_expbar()", 7000); 	
			setTimeout("live_ranking()", 20000);
	     }

	    /* TOS Fancybox Popup on First Login */
	    var first_login="';  echo $_SESSION['toc'];  echo '";
	    if(first_login==\'0\'){
		    $.get(\'http://localhost/user/first_login_msg/ce/0\', function(res) {
				$.fancybox(res,{
			    	closeBtn:false,
			    	closeClick:false,
					modal:true,
			    	helpers : {
						overlay : {
							opacity : 0.8
						 }
					 }
				 });
		     });
	     }

	    /*if (idu) {
		    /* For updating total login time */
		    /*upd_log_time();
	     }  */
	    
	 });
	
	function log_in_reminder(){
		 var url="http://localhost/user/log_in_reminder";
		 
		$.post(url,{ce:0 }, function(res){
			$.fancybox(res);
    	 });
	 }
	
	function getall_notification(){
	    var url="http://localhost/manage/getall_notification";
	    $.post(url,{ce:0 },function(res){
			if(res[0] != "-1"){
				if(res[2]==0)
			    	$(".not_txt").hide();
				else
			    	$(".not_txt").show();
				$(\'#user_ids\').val(res[0]);
				$(\'#id_badges\').val(res[1]);
				$("#not_cnt").html(res[2]);
			 }
	     },\'json\');
	 }
	
	function get_details_notification(){
	    var url="http://localhost//manage/get_details_notification";
	    $.post(url,{id_users:$(\'#user_ids\').val(),id_badges:$(\'#id_badges\').val(),ce:0 },function(data){
			$(".inner").html(data);
			$(".not_txt").hide();
	     });
	 }
	
	function live_ranking() {
		var ranking_data;
		var url="http://localhost/user/live_ranking/";
		
		$.post(url,{ce:0,chk:1 }, function(ranking_data){
			if (ranking_data.trim() == "no update" || ranking_data.trim() == "no rank"){
				setTimeout("live_ranking()", rank_wait);
				rank_wait *= 1.5
				return false;
			 } else {
				var ajax_response_exp = ranking_data.split(\',\');
				
				console.log(ajax_response_exp);
				// Rank? No. 1- User? No. 1- XP? Yes.
				if (ajax_response_exp[0].trim() == "AAB"){
					
					//$("#trailing_exp").html(ajax_response_exp[1]+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');
				
				// Rank? No 1- User? Yes.
				 } else if (ajax_response_exp[0].trim() == "AB") {
					trailing_pic = ajax_response_exp[1];
					trailing_dupe = ajax_response_exp[2];
					
					$("#trailing_user_profile_pic").html(\'<a href="/?id=\'+trailing_dupe+\'"><img src="\'+trailing_pic+\'" style="width:30px;height:30px"/></a>\');
					
					$("#trailing_ranking_number").css("color", \'#FEEB4E\');
					$("#trailing_ranking_number").animate( { "opacity" : 0.4  }, 700, function() {
						$("#trailing_ranking_number").css("color","#81cdfe");
						$("#trailing_ranking_number").animate( { "opacity" : 1  }, 300)
					 });
					
					//$("#trailing_exp").html(ajax_response_exp[1]+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
						
				// Rank? Yes. Improvement? Yes.
				 } else if (ajax_response_exp[0].trim() == "BA") {
					new_rank = ajax_response_exp[1];
					trailing_pic = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					trailing_dupe = ajax_response_exp[5];
					
					$("#ranking_number").html(new_rank);
					
					// Green flash

					$("#ranking_number").css("color", \'#B9FE4E\');
					$("#ranking_number").animate( { "opacity" : 0.4  }, 700, function() {
						$("#ranking_number").css("color","#81cdfe");
						$("#ranking_number").animate( { "opacity" : 1  }, 300)
					 });
					
					if (trailing_user) {
					
						$("#trailing_ranking_number").html(trailing_rank);
						$("#trailing_user_profile_pic").html(\'<a href="/?id=\'+trailing_dupe+\'"><img src="\'+trailing_pic+\'" style="width:30px;height:30px"/></a>\');	
							
						//$("#trailing_user").html(trailing_user);
						
						//$("#trailing_user_pic").css("background", \'#FE4EB9\');
						//$("#trailing_user_pic").animate( { "opacity" : 0.4  }, 700, function() {
						//	$("#trailing_user_pic").css("background","#aad450");
						//	$("#trailing_user_pic").animate( { "opacity" : 1  }, 300)
						// });
					
					 }					
				
				// Rank? Yes. Improve? No.
				 } else {
					new_rank = ajax_response_exp[1];
					trailing_xp = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					trailing_dupe = ajax_response_exp[5];
					
					$("#ranking_number").html(new_rank);
							
					// Red flash

					$("#ranking_number").css("color", \'#FE4EB9\');
					$("#ranking_number").animate( { "opacity" : 0.4  }, 700, function() {
						$("#ranking_number").css("color","#81cdfe");
						$("#ranking_number").animate( { "opacity" : 1  }, 300)
					 });
					
					if (trailing_user) {
						$("#trailing_ranking_number").html(trailing_rank);
						$("#trailing_user_profile_pic").html(\'<a href="/?id=\'+trailing_dupe+\'"><img src="\'+trailing_pic+\'" style="width:30px;height:30px"/></a>\');	
						
						//$("#trailing_exp").html(trailing_xp+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
								
						//$("#trailing_user").html(trailing_user);
						
						//$("#trailing_user_pic").css("background", \'#B9FE4E\');
						//$("#trailing_user_pic").animate( { "opacity" : 0.4  }, 700, function() {
						//	$("#trailing_user_pic").css("background","#aad450");
						//	$("#trailing_user_pic").animate( { "opacity" : 1  }, 300)
						// });
					 }
				 }
				
				setTimeout("live_ranking()", 20000);
				rank_wait = 40000;
			 }
			
			
		 });
	 }
	
	function popup_expbar(){
		var data;
		var url="http://localhost/user/getExperience/";
		
		$.post(url,{ce:0,chk:1 }, function(data){
			if(data == 90999999999){
				setTimeout("popup_expbar()", xp_wait);
				xp_wait *= 1.2
				return false;
			 }	
				
			// XP has changed
			if (data.indexOf(",") == -1) {
				// User has not levelled
				
				var ajax_response_main = data.split(\'~\');
				new_xp = ajax_response_main[0];
				previous_xp_to_level = ajax_response_main[1];
				user_level = ajax_response_main[2];
				
				console.log("User Level is "+user_level);
				console.log("Previous XP to Level is "+previous_xp_to_level);
				console.log("XP_TO_LEVEL is "+xp_to_level);
				
				// flash ranking number yellow
				$("#ranking_number").css("color", \'#FEEB4E\');		//yellow
				$("#ranking_number").animate( { "opacity" : 0.8  }, 500, function() {
					$("#ranking_number").css("color","#81cdfe");
					$("#ranking_number").animate( { "opacity" : 1  }, 200)
				 });
				
				if (user_level == 1) {
					new_xp_percent = (new_xp / xp_to_level) * 100;
				 } else {
					console.log("New Total XP is "+new_xp);
					console.log("Previous XP to Level is "+previous_xp_to_level);
					new_xp_percent = (new_xp - previous_xp_to_level) / (xp_to_level - previous_xp_to_level) * 100;
				 }
				
			 } else {
				// User level has changed; Unpack data
													
				var ajax_response = data.split(\',\');
				// [0] -- New XP
				new_xp = ajax_response[0]; 
				// [1] -- New level
				new_level = ajax_response[1];
				$("#user_level").html(\'L\'+new_level);
				$("#left_pan_level").html(\'L\'+new_level);
				
				// [2] -- New XP to level
				new_xp_to_level = ajax_response[2];
				
				previous_xp_to_level = xp_to_level;
				
				calc_new_xp_percent = new_xp - parseInt(previous_xp_to_level);
				new_xp_percent = calc_new_xp_percent / (new_xp_to_level - previous_xp_to_level) * 100;
				
				//console.log("XP TO LEVEL is "+xp_to_level);
				//console.log("NEW XP TO LEVEL IS "+new_xp_to_level);
				//console.log(calc_new_xp_percent);
							
				//console.log("PREVIOUS XP TO LEVEL IS "+previous_xp_to_level);
				
				xp_to_level = new_xp_to_level;
				
				// Level has a "live feed like flash"
				$("#left_pan_level").css("background", \'#B9FE4E\');
				$("#left_pan_level").animate( { "opacity" : 0.4  }, 500, function() {
					$("#left_pan_level").css("background","white");
					$("#left_pan_level").animate( { "opacity" : 1  }, 300)
				 });
			 }
					 
				
			//console.log("New XP is " + new_xp);
			//console.log("New Percentage is " + new_xp_percent);
			
			$("#xpbar").progressbar({
				value: new_xp_percent 
			 });
			
			$("#xpbar_status").html(new_xp_percent.toFixed(2) +\'%\');
			
			// Status bar with XP pops up too
			$("#xpbar_status").show();
			setTimeout(\'$("#xpbar_status").fadeOut();\', 2000);
			
			
			// Static XP marker
			$("#total_xp").html(new_xp+\'<span style="font-size:8px; position:relative; bottom:5px;"> XP</span>\');
			$("#user_pic").css("background", \'#4EFEEB\');
			$("#user__pic").animate( { "opacity" : 0.4  }, 400, function() {
				$("#user_pic").css("background","#4ebaff");
				$("#user_pic").animate( { "opacity" : 1  }, 300)
			 });
			
			setTimeout("popup_expbar()", 7000);	
			xp_wait = 8000;
		 });
	 }
	
	function upd_log_time() {
		  var url="http://localhost/index.php";
		  $.post(url,{page:"user",choice:"set_login_time",ce:0 },function(res){//alert(res);
		   })
		  setTimeout("upd_log_time()", 10000);
    	 }
    	
	function get_next_page(url, start, limit, div_id) {
		if (!document.getElementById(div_id)) {
			div_id = "content";
		 }
		$("#"+div_id).load(url, {\'qstart\':start, \'limit\':limit, \'ce\':0,\'pg\':1,chk:1 }, function(res){
			//css_even_odd();
		 });
	 }
	
	function show_fancybox(res){
		$.fancybox(res,{centerOnScroll:true,hideOnOverlayClick:false });
		//$.fancybox(res,{margin:600,hideOnOverlayClick:false });
	 }
	
	$(function(){
		$(".leftpan_img").click(function(){
			$("#leftpan").toggle();
			if($("#leftpan").is(":hidden"))
			    $(".leftpan_img").css(\'background\',"url(http://localhost/templates/images/m_next_btn.png) no-repeat");
			else
			    $(".leftpan_img").css(\'background\',"url(http://localhost/templates/images/m_previous_btn.png) no-repeat");
		 });
		$(".rightpan_img").click(function(){
			$("#rightpan").toggle();
			if($("#rightpan").is(":hidden"))
			    $(".rightpan_img").css(\'background\',"url(http://localhost/templates/images/m_previous_btn.png) no-repeat");
			else
			    $(".rightpan_img").css(\'background\',"url(http://localhost/templates/images/m_next_btn.png) no-repeat");

		 });

	 });
	
	function get_random_meme(){
		//$(window).scrollBy(0,5);
		//$(window).scroll(function(e){
		//	$(\'#xpbar\').css({
		//		position:\'fixed\',
		//		top:\'0px!important!\',
		//	 });
		// }
		
		var url = "http://localhost/meme/meme_list/cat/rand";
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
	
	function submit() {
		$(\'#searches\').submit();
	 }
	
	function follow_user(status) {		
		';  if ($_SESSION['profile_id']):  echo '
		var profile_id = ';  echo $_SESSION['profile_id'];  echo '
		';  endif;  echo '
		var url = "http://localhost/user/follow_user";
		
		$.post(url, {ce:0, id:profile_id, status:status }, function(res){
			if (status == \'follow\') {
				$("#follow_me").html(\'<a href="javascript:void(0);" id="follow_btn" onclick="follow_user(\\\'unfollow\\\');">Unfollow</a>\');
				
				follow_count += 1;				
			 } else if (status == \'unfollow\') {
				$("#follow_me").html(\'<a href="javascript:void(0);" id="follow_btn" onclick="follow_user(\\\'follow\\\');">Follow</a>\');
				
				follow_count -= 1;
			 }
			
			$(\'#follower_count\').html(follow_count+\' followers\');
		 });
	 }
	
</script>
<script type="text/javascript">
	    function fb_logout(){
	       url="http://localhost/";
	       $.post(url,{page:"user",choice:"check_fb_session",ce:0 },function(res){
		if(res==\'-1\'){
		       window.location.href = url+"user/logout";
		 } else {
				// First try logging out normal user
				window.location.href = url+"user/logout";
				
				// Then try FB logout
				if (idu) {
		       		FB.logout(function(response) {
						window.location.href = url+"user/logout";
		       		 });
		       	 }
		 }

	        })
		 }
		
		
	
</script>
'; ?>

</head>

<body>
<div id="fb-root"></div>
      <?php echo '
      <script>
        window.fbAsyncInit = function() {
          FB.init({
            appId      : \'219049284838691\',
            status     : true, 
            cookie     : true,
            xfbml      : true,
            oauth      : true,
           });
          
          FB.Event.subscribe(\'auth.login\', function (response) {
          	window.location = "http://localhost/user/facebook_info";
    	   });
         };
        
        
        (function(d){
           var js, id = \'facebook-jssdk\'; if (d.getElementById(id)) {return; }
           js = d.createElement(\'script\'); js.id = id; js.async = true;
           js.src = "//connect.facebook.net/en_US/all.js";
           d.getElementsByTagName(\'head\')[0].appendChild(js);
          }(document))
      </script>       
'; ?>

<!-- The Header and Logo shown at all times -->
	<div id="top_header" class="nohighlight"></div>

	<div id= "logoc" class="nohighlight">
		<a href="http://localhost/"><img src="http://localhost/templates/images/wmemejalogo.png" id="logo" style="width:180px;"></a>
	</div>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/left_pan.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<?php if (! $_SESSION['id_user']): ?>
	<!-- NLU looks @ home page -->
	<?php if (! $_SESSION['profile']): ?>
	<img src="http://localhost/templates/images/background.png"style="position:absolute;"/>
		<div id="nlu_container">
				<div id="nlu_feed">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php if (! $_REQUEST['page']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 
				</div>
		</div>		
		<div id ="nlu_login">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/login_form.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
		<div id ="nlu_login_register">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/login_form_register.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
		</div>
	<?php elseif ($_SESSION['profile'] == 'invalid'): ?>
		<div id="nlu_contained">
			<div id="profile_page">		
				<div id="profile_name"><center>Flerp? We couldn't find this user!</center></div>
			</div>		
			<div id="live_feed" class="nohighlight">
				<div id="random_meme" style="left:259px; z-index:4;">
					<a href="javascript:void(0);" onclick="get_random_meme();" class="special-btn red">Random</a>
				</div>	
				<div id="feed_cont">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
			<div id="login_top">
				<div class="fb-login-button" scope="
				email,
				publish_stream
				,user_education_history
									">
			Login with Facebook
				</div>
			</div>
		</div>	
	<?php else: ?>
		<div id="nlu_contained">	
			<div id="profile_page">	
				<div id="profile_pic">
					<?php if ($_SESSION['profile_picture']): ?>
						<img src="<?php echo $_SESSION['profile_picture']; ?>
"class="profile_pic"/>
					<?php else: ?>
						<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif; ?>"class="profile_pic"/>
					<?php endif; ?>
				</div>
				<div id="user_info">
					<div id="profile_name"><a href="/?id=<?php echo $_SESSION['profile_dupe_username']; ?>
"><?php echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></div>
					<div id="follower_count"><?php if (! $_SESSION['profile_follower_count'] == '0'):  echo $_SESSION['profile_follower_count'];  else: ?>0<?php endif; ?> followers</div>
				</div>
				<div id="view_meme">
					<?php if ($_SESSION['profile_meme_image']): ?>
						<div id="profile_meme">
							<?php echo $_SESSION['profile_meme_title']; ?>

						</div>
						<div id="profile_meme_image">
							<img src="http://localhost/image/orig/meme/<?php echo $_SESSION['profile_meme_image']; ?>
" title="<?php echo $_SESSION['profile_meme_title']; ?>
" />
						</div>
						<?php if ($_SESSION['profile_meme_tagged']): ?>
							<div id="profile_tagged">
								Tagged: 
								<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
									<span>
										<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['x']['id']; ?>
/picture"/>
										<?php echo $this->_tpl_vars['x']['name']; ?>

									</span>
								<?php endforeach; endif; unset($_from); ?>
							</div>
						<?php endif; ?>
					<?php endif; ?>
				</div>
				<div id="my_pics">
					<div class="tabs">
					   <div class="tab">
						   <input type="radio" id="tab-1" name="tab-group-1" checked>
						   <label for="tab-1"><?php echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
's Memes</label>
						   <div class="content">
								<div id="my_meme_list">
									<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#0}';}?>

								</div>
						   </div>
					   </div>
					   <div class="tab">
						   <input type="radio" id="tab-2" name="tab-group-1">
						   <label for="tab-2">Tagged Memes</label>
						   <div class="content">
								<div id="my_tagged">
									<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#1}';}?>

								</div>
						   </div>
					   </div>
					</div>
				</div>
			</div>
			
			<div id="live_feed" class="nohighlight">
				<center><div id="random_meme">
					<a href="javascript:void(0);" onclick="get_random_meme();" class="special-btn red">Random</a>
				</div></center>
				<div id="feed_cont">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
			<div id="login_top">
				<div class="fb-login-button" scope="
			email,
			publish_stream
			,user_education_history
							">
		Login with Facebook
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php else: ?>
		<div id="user_pic" class="nohighlight">
			<a href="/?id=<?php echo $_SESSION['dupe_username']; ?>
">
				<?php if ($_SESSION['fb_pic_normal']): ?>
					<img src="<?php echo $_SESSION['fb_pic_normal']; ?>
" style="width:30px;height:30px">
				<?php else: ?>
					<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>" style="width:30px;height:30px"/>
				<?php endif; ?>
			</a>
			<div id="ranking_number"><?php if ($_SESSION['exp_rank']):  echo $_SESSION['exp_rank'];  else: ?>N/A<?php endif; ?></div>
		</div>
		
		<?php if ($_SESSION['one_less_user']): ?>
			
			<div id="trailing_user_pic" class="nohighlight">
				<span id="trailing_user_profile_pic"><a href="/?id=<?php echo $_SESSION['one_less_dupe_username']; ?>
">
					<?php if ($_SESSION['one_less_pic']): ?>
						<img src="<?php echo $_SESSION['one_less_pic']; ?>
" style="width:30px;height:30px">
					<?php else: ?>
						<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['one_less_avatar']):  echo $_SESSION['one_less_avatar'];  else:  if ($_SESSION['one_less_gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>" style="width:30px;height:30px"/>
					<?php endif; ?></a>
				</span>
				<div id="trailing_ranking_number"><?php if ($_SESSION['one_less_rank']):  echo $_SESSION['one_less_rank'];  else: ?>N/A<?php endif; ?>
				</div>
			</div>
		<?php else: ?>
			
		<?php endif; ?>	

	<?php if ($_REQUEST['choice'] != 'addMeme'): ?>

		<div id="xpbar_info" class="nohighlight">
			<div id="xpbar"></div>	
			<div id="user_level"></div>
			<div id="xpbar_status"></div>
		</div>
		
		<div id="contained">
			<?php if (! $_SESSION['profile']): ?>
				<!-- view home page -->
				<div id="profile_page">
					<div id="profile_pic">
					<?php if ($_SESSION['fb_pic_normal']): ?>
						<img src="<?php echo $_SESSION['fb_pic_normal']; ?>
"class="profile_pic"/>
					<?php else: ?>
						<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>"class="profile_pic"/>
					<?php endif; ?>
					</div>
					<div id="user_info">
						<div id="profile_name"><a href="/?id=<?php echo $_SESSION['dupe_username']; ?>
"><?php echo ((is_array($_tmp=$_SESSION['username'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></div>
						<div id="follower_count"><?php if (! $_SESSION['profile_follower_count'] == '0'):  echo $_SESSION['profile_follower_count'];  else: ?>0<?php endif; ?> followers</div>
					</div>
						
					<div id="my_pics">
						<div class="tabs">
						   <div class="tab">
							   <input type="radio" id="tab-1" name="tab-group-1" checked>
							   <label for="tab-1">My Memes</label>
							   <div class="content">
									<div id="my_meme_list">
										<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#2}';}?>

									</div>
							   </div>
						   </div>
						   <div class="tab">
							   <input type="radio" id="tab-2" name="tab-group-1">
							   <label for="tab-2">Tagged Memes</label>
							   <div class="content">
									<div id="my_tagged">
										<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#3}';}?>

									</div>
							   </div>
						   </div>
							<div class="tab">
							   <input type="radio" id="tab-3" name="tab-group-1">
							   <label for="tab-3">Favorites</label>
							   <div class="content">
									<div id="my_favorites" >
										<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#4}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#4}';}?>

									</div>
							   </div>
						   </div>
						</div>
					</div>		
				</div>
			<?php elseif ($_SESSION['profile'] == 'invalid'): ?>
				<div id="profile_page">
					<div id="profile_name"><center>Flerp? We couldn't find this user!</center></div>
				</div>
			<?php else: ?> 
				<div id="profile_page">	
					<div id="profile_pic">
						<?php if ($_SESSION['profile_picture']): ?>
							<img src="<?php echo $_SESSION['profile_picture']; ?>
"class="profile_pic"/>
						<?php else: ?>
							<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>"class="profile_pic"/>
						<?php endif; ?>
					</div>
				<div id="user_info">
					<div id="profile_name"><a href="/?id=<?php echo $_SESSION['profile_dupe_username']; ?>
"><?php echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></div>
					<div id="follower_count"><?php if (! $_SESSION['profile_follower_count'] == '0'):  echo $_SESSION['profile_follower_count'];  else: ?>0<?php endif; ?> followers</div>
					<?php if ($_SESSION['following'] == 'y'): ?>
						<span id="follow_me"><a href="javascript:void(0);" id="follow_btn" onclick="follow_user('unfollow');">Unfollow</a></span>
					<?php elseif ($_SESSION['following'] == 'n'): ?>
						<span id="follow_me"><a href="javascript:void(0);" id="follow_btn" onclick="follow_user('follow');">follow</a></span>
					<?php endif; ?>
				</div>	
				<div id="view_meme">
					<?php if ($_SESSION['profile_meme_image']): ?>
							<div id="profile_meme">
								<?php echo $_SESSION['profile_meme_title']; ?>

							</div>
							<div id="profile_meme_image">
								<img src="http://localhost/image/orig/meme/<?php echo $_SESSION['profile_meme_image']; ?>
" title="<?php echo $_SESSION['profile_meme_title']; ?>
" />
							</div>
							<?php if ($_SESSION['profile_meme_tagged']): ?>
								<div id="profile_tagged">
									Tagged: 
									<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
										<span>
											<img src="https://graph.facebook.com/<?php echo $this->_tpl_vars['x']['id']; ?>
/picture"/>
											<?php echo $this->_tpl_vars['x']['name']; ?>

										</span>
									<?php endforeach; endif; unset($_from); ?>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div id="my_pics">
						<div class="tabs">
						   <div class="tab">
							   <input type="radio" id="tab-1" name="tab-group-1" checked>
							   <label for="tab-1"><?php echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
's Memes</label>
							   <div class="content">
									<div id="my_meme_list">
										<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#5}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#5}';}?>

									</div>
							   </div>
						   </div>
						   <div class="tab">
							   <input type="radio" id="tab-2" name="tab-group-1">
							   <label for="tab-2">Tagged Memes</label>
							   <div class="content">
									<div id="my_tagged">
										<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:49df79673400ace4f30a693476e0865d#6}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:49df79673400ace4f30a693476e0865d#6}';}?>

									</div>
							   </div>
						   </div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			
			<div id="live_feed" class="nohighlight">
				<center><div id="random_meme">
					<a href="javascript:void(0);" onclick="get_random_meme();" class="special-btn red">Random</a>
				</div></center>
				<div id="feed_cont">
					<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
				</div>
			</div>
			
		</div>

	<?php else: ?>
		<div id="editorcontent" class="nohighlight">
			<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			<?php if (! $_SESSION['id_user'] && ! $_REQUEST['page']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 
		</div>		
	<?php endif; ?>
<?php endif; ?>
</body>
</html>