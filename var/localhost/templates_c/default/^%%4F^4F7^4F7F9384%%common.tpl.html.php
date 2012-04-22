<?php /* Smarty version 2.6.7, created on 2012-04-22 23:19:47
         compiled from common/common.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memeja: You Know What I Meme?</title>
<link rel="shortcut icon" href="http://localhost/templates/images/memeja_icon.ico" >
<?php $this->assign('appid', $this->_tpl_vars['util']->get_values_from_config('FACEBOOK')); ?>
<?php $this->assign('chc', $_REQUEST['choice']); ?>

<script type="text/javascript" src="http://localhost/libsext/jquery/jquery.js"></script>

<!-- JQuery Library for New Fancybox -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox.css?v=2.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox.pack.js?v=2.0.5"></script>

<!-- Optionally add button and/or thumbnail helpers -->
<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox-buttons.css?v=2.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-buttons.js?v=2.0.5"></script>
<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox-thumbs.css?v=2.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-thumbs.js?v=2.0.5"></script>

<script type="text/javascript" src="http://localhost/templates/flexyjs/flexymessage.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ui.datepicker.js"></script>

<script type="text/javascript" src="http://localhost/libsext/js/ajaxfileupload.js"></script>

<script type="text/javascript" src="http://localhost/libsext/hotkeys/jquery.hotkeys.js"></script>

<!-- Hover Intent -->
<script type="text/javascript" src="http://localhost/libsext/hoverintent/jquery.hoverIntent.js"></script>

<!-- XP Bar CSS + JS-->
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/jquery-ui-1.8.16.custom.css"/>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.core.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.highlight.js"></script>

<script type="text/javascript" src="js/jquery-1.7.1.min.js"></script>

<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>
<?php echo '

<script type="text/javascript">
	var chc ="';  echo $this->_tpl_vars['chc'];  echo '";
	var idu="';  echo $_SESSION['id_user'];  echo '";
	
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
			$("#xpbar_status").html(\'(\'+ xp_percent.toFixed(2) +\'%) \'+ (curr_xp - previous_xp_to_level) +\' / \'+ (xp_to_level - previous_xp_to_level));
			
			// Mouseover shows XP and %
			$("#xpbar, #xpbar_status").hoverIntent({
				interval: 200,
				timeout:1000
			 });
			
			$("#xpbar, #xpbar_status").hoverIntent(function(){
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
				
				// Rank? No. 1- User? No. 1- XP? Yes.
				if (ajax_response_exp[0].trim() == "AAB"){
					
					$("#trailing_exp").html(ajax_response_exp[1]+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');

					$("#other_user_ranking_info").css("background", \'#AAF2DC\');
					$("#other_user_ranking_info").animate( { "opacity" : 0.4  }, 700, function() {
						$("#other_user_ranking_info").css("background","#aad450");
						$("#other_user_ranking_info").animate( { "opacity" : 1  }, 300)
					 });
				
				// Rank? No 1- User? Yes.
				 } else if (ajax_response_exp[0].trim() == "AB") {
					$("#trailing_user").html(ajax_response_exp[2]);
					$("#trailing_exp").html(ajax_response_exp[1]+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
						
				// Rank? Yes. Improvement? Yes.
				 } else if (ajax_response_exp[0].trim() == "BA") {
					new_rank = ajax_response_exp[1];
					trailing_xp = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					
					$("#ranking_number").html(new_rank);
					
					// Green flash
					$("#user_ranking_info").css("background", \'#B9FE4E\');
					$("#user_ranking_info").animate( { "opacity" : 0.4  }, 700, function() {
						$("#user_ranking_info").css("background","#4ebaff");
						$("#user_ranking_info").animate( { "opacity" : 1  }, 300)
					 });
					
					if (trailing_user) {
					
						$("#trailing_ranking_number").html(trailing_rank);
						$("#trailing_exp").html(trailing_xp+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
							
						$("#trailing_user").html(trailing_user);
						
						$("#other_user_ranking_info").css("background", \'#FE4EB9\');
						$("#other_user_ranking_info").animate( { "opacity" : 0.4  }, 700, function() {
							$("#other_user_ranking_info").css("background","#aad450");
							$("#other_user_ranking_info").animate( { "opacity" : 1  }, 300)
						 });
					
					 }
					
				
				// Rank? Yes. Improve? No.
				 } else {
					new_rank = ajax_response_exp[1];
					trailing_xp = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					
					$("#ranking_number").html(new_rank);
							
					// Red flash
					$("#user_ranking_info").css("background", \'#FE4EB9\');
					$("#user_ranking_info").animate( { "opacity" : 0.4  }, 700, function() {
						$("#user_ranking_info").css("background","#4ebaff");
						$("#user_ranking_info").animate( { "opacity" : 1  }, 300)
					 });
					
					if (trailing_user) {
						$("#trailing_ranking_number").html(trailing_rank);
						$("#trailing_exp").html(trailing_xp+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
								
						$("#trailing_user").html(trailing_user);
						
						$("#other_user_ranking_info").css("background", \'#B9FE4E\');
						$("#other_user_ranking_info").animate( { "opacity" : 0.4  }, 700, function() {
							$("#other_user_ranking_info").css("background","#aad450");
							$("#other_user_ranking_info").animate( { "opacity" : 1  }, 300)
						 });
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
			
			$("#xpbar_status").html(\'(\'+ new_xp_percent.toFixed(2) +\'%) \'+ (new_xp - previous_xp_to_level) +\' / \'+ (xp_to_level - previous_xp_to_level));
			
			// Status bar with XP pops up too
			$("#xpbar_status").show();
			setTimeout(\'$("#xpbar_status").fadeOut();\', 2000);
			
			
			// Static XP marker
			$("#total_xp").html(new_xp+\'<span style="font-size:8px; position:relative; bottom:5px;"> XP</span>\');
			$("#user_ranking_info").css("background", \'#4EFEEB\');
			$("#user_ranking_info").animate( { "opacity" : 0.4  }, 400, function() {
				$("#user_ranking_info").css("background","#4ebaff");
				$("#user_ranking_info").animate( { "opacity" : 1  }, 300)
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
          	console.log("FB.event.subscribe auth login fired");
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


<?php if (! $_SESSION['id_user']): ?>
<div id="nlu_masthead">
	<!-- Memeja logo -->
	<div id ="nlu_logoc">
		<a href="http://localhost/"><img src="http://localhost/templates/images/rmemejalogo.png" width="350px" id="logo"></a>
	</div>
	<div id ="nlu_message" class="triangle-right left">
		We bring people together through shared experiences
	</div>
</div>

<div class="clear"></div>

<div>
	<div id ="nlu_featured">
		<div> Hey you! Everybody's got a story to share. Whether it's...</div>
		<div id="nlu_message_one"><span class="blurb" id="blurb_one"></span></div>
		<div id="nlu_message_two"><span class="blurb" id="blurb_two"></span></div>
		<div id="nlu_message_three"><span class="blurb" id="blurb_three"></span></div>
		<div>...your story will fit in at Memeja</div>
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
	<div id="nlu_feed">
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
</div>

<?php endif; ?>


<?php if ($_SESSION['id_user']): ?>

<?php if ($_REQUEST['choice'] != 'addMeme'): ?>
<!-- Masthead is the Header which contains the Logo and the Navigation Buttons-->
<!--Not on the create page-->
<div id="masthead" class="nohighlight">
		
		<!-- Memeja Logo -->
		<div id= "logoc">
		<a href="http://localhost/"><img src="http://localhost/templates/images/rmemejalogo.png" width="280px;" id="logo"></a>
		</div>

		<!-- Memeja Top Bar -->
	   <div id ="headerbtns"> 
	   
	    <!-- Login/Logout Buttons -->
			<?php if (! $_SESSION['id_user']): ?>
				<img src="http://localhost/templates/images/joinmemeja.png" id="joinmemeja" onclick="$('#fblogin').slideToggle();" style="margin:-2px;">
			<?php else: ?>
				<img src="http://localhost/templates/images/logout.png" id="logout" onclick="fb_logout();" style="margin:-2px;">
			<?php endif; ?>
			
	    <!-- Image Editor Button -->
			<a href="http://localhost/meme/addMeme"><img src="http://localhost/templates/images/create.png" id="create"style="margin:-2px;"></a>
		
	    <!-- Random Generator Button -->
				<a href="javascript:void(0);" onclick="get_random_meme();"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
		
	    <!-- About Us Button -->
			<a href="http://localhost/achievements/whatisMemeja"><img src="http://localhost/templates/images/help.png"style="margin:-2px;"></a>
			
		<!-- Search Feature -->	
			<a href="javascript:void(0);"><img src="http://localhost/templates/images/searchend.png" style="margin:-2px;" onclick="submit();"></a>
			
				<form id ="searches">
					<input type="text" class="self-describing" name="mtitle" id="mtitle" title="Search by title."/>
				</form>
		</div>
</div>
<?php else: ?>
<!-- Header buttons on the Create Page-->
<div id="mastheadcreate"class="nohighlight">
		
		<!-- Memeja Logo -->
		<div id= "logoc">
		<a href="http://localhost/"><img src="http://localhost/templates/images/rmemejalogo.png" width="280px" id="logo"></a>
		</div>

		<!-- Memeja Top Bar -->
	   <div id ="headerbtns"> 
	   
	    <!-- Login/Logout Buttons -->
			<?php if (! $_SESSION['id_user']): ?>
				<img src="http://localhost/templates/images/joinmemeja.png" id="joinmemeja" onclick="$('#fblogin').slideToggle();" style="margin:-2px;">
			<?php else: ?>
				<img src="http://localhost/templates/images/logout.png" id="logout" onclick="fb_logout();" style="margin:-2px;">
			<?php endif; ?>
			
	    <!-- Image Editor Button -->
			<a href="http://localhost/meme/addMeme"><img src="http://localhost/templates/images/create.png" id="create"style="margin:-2px;"></a>
		
	    <!-- Random Generator Button -->
				<a href="javascript:void(0);" onclick="get_random_meme();"><img src="http://localhost/templates/images/random.png"style="margin:-2px;"></a>
		
	    <!-- About Us Button -->
			<a href="http://localhost/achievements/whatisMemeja"><img src="http://localhost/templates/images/help.png"style="margin:-2px;"></a>
			
		<!-- Search Feature -->	
			<a href="javascript:void(0);"><img src="http://localhost/templates/images/searchend.png" style="margin:-2px;" onclick="submit();"></a>
			
				<form id ="searches">
					<input type="text" class="self-describing" name="mtitle" id="mtitle" title="Search by title."/>
				</form>
		</div>
</div>
<?php endif; ?>


		<!-- FB LOGIN Button -->
		<div id="fblogin" style="display:none;"width="50px;">
			<div class="fb-login-button" scope="email, publish_stream ,user_education_history ">
						  Login with Facebook
			</div>
		</div>		
		
	<?php if ($_SESSION['id_user']): ?>
	<?php if ($_REQUEST['choice'] != 'addMeme'): ?>
	<div id="follower">
		<div id="xpbar"></div>
	</div>	
	<div id="user_level"></div>
	<div id="xpbar_status"></div>
        <?php endif; ?>
		<?php endif; ?>

	
<div class="clear"></div>

<div id="contained">

<!-- Sidebar_A is Your Profile Information(Logged in) / Login Form(Not Logged in) -->		

				<div id="sidebar_a"class="nohighlight">
					<?php if ($_SESSION['id_user']): ?>	
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/left_pan.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php else: ?> 
						<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/login_form.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
					<?php endif; ?>
				</div>
			
			    <div>
					<font color="#FF0000"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/messages.tpl.html", 'smarty_include_vars' => array('module' => 'global')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></font>
				</div>
<!-- This is the main container which contains the Live Feed/Image Editor -->	
	<?php if ($_REQUEST['choice'] != 'addMeme'): ?>			
			    <div id="content">
		<!-- Content in middle of page (Live Feed/Editor) -->
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
	<?php else: ?>
			    <div id="editorcontent">
		<!-- Content in middle of page (Live Feed/Editor) -->
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
	
	<!-- Sidebar_B is for Ads/Search_Bar/Displays the Other Profile Info -->				
			<?php if ($_REQUEST['choice'] != 'addMeme'): ?>
			<div id="sidebar_b"class="nohighlight">
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/right_pan.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>
			<?php endif; ?>
<div class="clear"></div>
</div>		

<?php endif; ?>


<!-- Keeping the Footer at the Bottom -->	
<div class="clear"></div>
	<div id="footer"class="nohighlight"><center>Copyrights. All Rights Reserved. 2012</center></div>
</body>
</html>