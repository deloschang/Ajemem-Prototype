<?php /* Smarty version 2.6.7, created on 2011-12-28 11:40:01
         compiled from common/common.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'common/common.tpl.html', 628, false),)), $this); ?>
<?php $this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/^%%4F^4F7^4F7F9384%%common.tpl.html.inc'] = 'd621e3948051d88e4a233e782c574c1c'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memeja: 2 Me's; 1 Meme</title>
<?php $this->assign('appid', $this->_tpl_vars['util']->get_values_from_config('FACEBOOK')); ?>
<?php $this->assign('chc', $_REQUEST['choice']); ?>

<script type="text/javascript" src="http://localhost/libsext/jquery/jquery.js"></script>
<script type="text/javascript" src="http://localhost/libsext/jquery/jquery-1.4.2.min.js"></script>



<!-- JQuery Library for New Fancybox -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7/jquery.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.mousewheel-3.0.6.pack.js"></script>


	<!-- Add fancyBox -->
<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox.css?v=2.0.4" type="text/css" media="screen" />
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox.pack.js?v=2.0.4"></script>

	<!-- Optionally add button and/or thumbnail helpers -->
<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox-buttons.css?v=2.0.4" type="text/css" media="screen" />

<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-buttons.js?v=2.0.4"></script>


<link rel="stylesheet" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox-thumbs.css?v=2.0.4" type="text/css" media="screen" />
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-thumbs.js?v=2.0.4"></script>


<!-- Removed bc of conflicts with Fancybox
<script type="text/javascript" src="http://localhost/libsext/js/jquery.validate.js"></script>
-->

<script type="text/javascript" src="http://localhost/templates/flexyjs/flexymessage.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ui.datepicker.js"></script>

<script type="text/javascript" src="http://localhost/libsext/js/ajaxfileupload.js"></script>


<!--Popup (use later for badges?)-->
<script type="text/javascript" src="http://localhost/templates/flexyjs/jquery.bubblepopup.v2.3.1.min.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/jquery.bubblepopup.v2.3.1.css"/>

<!-- Hover Intent -->
<script type="text/javascript" src="http://localhost/libsext/hoverintent/jquery.hoverIntent.js"></script>

<!-- XP Bar CSS + JS-->
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/jquery-ui-1.8.16.custom.css"/>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery-ui-1.8.16.custom.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.core.js"></script>
<script type="text/javascript" src="http://localhost/libsext/xpbar/jquery.effects.highlight.js"></script>

<script type="text/javascript" src="js/jquery-1.6.2.min.js"></script>
<!--end-->

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
				xp_percent = ((curr_xp - previous_xp_to_level) / (xp_to_level - previous_xp_to_level)) * 100;
			<?php else: ?>xp_percent = 0<?php endif;  echo '
		 }
	
	$(document).ready(function(){			
		console.log("User level is "+user_level);
		console.log("Total XP is "+curr_xp);
		console.log("XP needed to level is "+xp_to_level);
		console.log("XP Percent displayed is "+xp_percent);
		
		console.log("Previous XP To level is "+previous_xp_to_level);
		
		
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

		var scrn_height = window.screen.availHeight;
            $("#mid_cont").height(scrn_height/2 + scrn_height/9);

	    /* For notification */
	    $(".inner").hide();
	    $(\'#slidebottom div\').click(function() {
			get_details_notification();
			$(this).next().slideToggle();
	     });

	    if(idu!="" && chc!=\'addMeme\'){
			setInterval("getall_notification()",7000);

	    /* For popup bar */
			setInterval("popup_expbar()", 2000); 	// Pati orig set timer to 6000
			setInterval("live_ranking()", 11000);
	     }

	    /* TOS Fancybox Popup on First Login */
	    var first_login="';  echo $_SESSION['toc'];  echo '";
	    if(first_login==\'0\'){
		    $.get(\'http://localhost/user/first_login_msg/ce/0\', function(res) {
				$.fancybox(res,{
			    	closeBtn:false,
			    	closeClick:false,
			    	helpers : {
						overlay : {
							opacity : 0.8
						 }
					 }
				 });
		     });
	     }

	    if (idu) {
		    /* For updating total login time */
		    upd_log_time();
	    	/* End */
	     }
	    
	 });
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
		var url="http://localhost/user/live_ranking/ce/0/chk/1";
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);
		
		httpRequest.send();
		
		if (httpRequest.status == 200) {
			ranking_data = httpRequest.responseText;
		 }
		
		console.log(ranking_data);
		
		
		if (ranking_data.trim() == "no update" || ranking_data.trim() == "no rank"){
			//console.log(\'no update yet\');
			return false;
		 } else {
			
			
			var ajax_response_exp = ranking_data.split(\',\');
			
			// Rank? No. 1- User? No. 1- XP? Yes.
			if (ajax_response_exp[0].trim() == "AAB"){
				console.log("Trailing User XP changed");
				
				$("#trailing_exp").html(\'(\'+ajax_response_exp[1]+\' XP)\');

				$("#trailing_exp").css("background", \'#AAF2DC\');
				$("#trailing_exp").animate( { "opacity" : 0.4  }, 700, function() {
					$("#trailing_exp").css("background","white");
					$("#trailing_exp").animate( { "opacity" : 1  }, 300)
				 });
			
			// Rank? No 1- User? Yes.
			 } else if (ajax_response_exp[0].trim() == "AB") {
				console.log("Trailing User changed");
				$("#trailing_user").html(ajax_response_exp[2]);
				$("#trailing_exp").html(\'(\'+ajax_response_exp[1]+\' XP)\');	
				
				$("#trailing_all").css("background", \'#FFE303\');	
				$("#trailing_all").animate( { "opacity" : 0.4  }, 700, function() {
					$("#trailing_all").css("background","white");
					$("#trailing_all").animate( { "opacity" : 1  }, 300)
				 });
					
			// Rank? Yes. Improvement? Yes.
			 } else if (ajax_response_exp[0].trim() == "BA") {
				console.log("Improvement in Rank");
				new_rank = ajax_response_exp[1];
				trailing_xp = ajax_response_exp[2];
				trailing_user = ajax_response_exp[3];
				trailing_rank = ajax_response_exp[4];
				
				$("#ranking_number").html(\'Rank #\'+parseInt(new_rank));
				
				// Green flash
				$("#ranking_number").css("background", \'#33CC00\');
				$("#ranking_number").animate( { "opacity" : 0.4  }, 700, function() {
					$("#ranking_number").css("background","white");
					$("#ranking_number").animate( { "opacity" : 1  }, 300)
				 });
				
				if (trailing_user) {
				
					$("#trailing_ranking_number").html(\' Rank #\'+parseInt(trailing_rank));
					$("#trailing_exp").html(\'(\'+trailing_xp+\' XP)\');	
						
					$("#trailing_user").html(trailing_user);
					$("#trailing_all").css("background", \'#FFE303\');	
					$("#trailing_all").animate( { "opacity" : 0.4  }, 700, function() {
						$("#trailing_all").css("background","white");
						$("#trailing_all").animate( { "opacity" : 1  }, 300)
					 });
				
				 }
				
			
			// Rank? Yes. Improve? No.
			 } else {
				console.log("Loss in rank");

				new_rank = ajax_response_exp[1];
				trailing_xp = ajax_response_exp[2];
				trailing_user = ajax_response_exp[3];
				trailing_rank = ajax_response_exp[4];
				
				$("#ranking_number").html(\'Rank #\'+parseInt(new_rank));
						
				// Red flash
				$("#ranking_number").css("background", \'#FF0000\');
				$("#ranking_number").animate( { "opacity" : 0.4  }, 700, function() {
					$("#ranking_number").css("background","white");
					$("#ranking_number").animate( { "opacity" : 1  }, 300)
				 });
				
				if (trailing_user) {
					$("#trailing_ranking_number").html(\' Rank #\'+parseInt(trailing_rank));
					$("#trailing_exp").html(\'(\'+trailing_xp+\' XP)\');	
							
					$("#trailing_user").html(trailing_user);
					$("#trailing_all").css("background", \'#FFE303\');	
					$("#trailing_all").animate( { "opacity" : 0.4  }, 700, function() {
						$("#trailing_all").css("background","white");
						$("#trailing_all").animate( { "opacity" : 1  }, 300)
					 });
				 }
			 }
		 }
	 }
	
	function popup_expbar(){

		var data;
		var url="http://localhost/user/getExperience/ce/0/chk/1";
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
		if (httpRequest.status == 200) {
			data = httpRequest.responseText;
		 }
		
		if(data == 90999999999){
			return false;
		 }	
		
		// XP has changed
		if (data.indexOf(",") == -1) {
			// User has not levelled
			console.log("user has not levelled");
			
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
			console.log("user has levelled");
												
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
			
			console.log("XP TO LEVEL is "+xp_to_level);
			console.log("NEW XP TO LEVEL IS "+new_xp_to_level);
			console.log(calc_new_xp_percent);
						
			console.log("PREVIOUS XP TO LEVEL IS "+previous_xp_to_level);
			
			xp_to_level = new_xp_to_level;
			
			// Level has a "live feed like flash"
			$("#left_pan_level").css("background", \'#FFFF73\');
	    	$("#left_pan_level").animate( { "opacity" : 0.4  }, 700, function() {
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
		$("#total_xp").html(\'(\'+new_xp+\' XP)\');
		$("#total_xp").css("background", \'#AAF2DC\');
    	$("#total_xp").animate( { "opacity" : 0.4  }, 700, function() {
			$("#total_xp").css("background","white");
			$("#total_xp").animate( { "opacity" : 1  }, 300)
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
	
	function chkvalid(){
	    //For validation form before submitting paypal button
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
<style type="text/css">

body {
	margin-left:75px;
	margin-right:75px;
	margin-top:1.5em;
 }

#xpbar {
	position: fixed;
	top: 0px;
	left: 74px;
	right: 75px;
	z-index: 99998;
 }

#user_level{
	position: fixed;
	
	font-size: 10px;
	font: Verdana;
	color: white;
	
	cursor: default;
	
	top: 2px;
	left: 9%;
	z-index: 999999;

 }

#xpbar_status {
	position: fixed;
	
	font-size: 10px;
	font: Verdana;
	color: white;
	
	display: none;
	cursor: default;
	
	top: 2px;
	left: 45%;
	z-index: 99999;
 }

/* Exp Bar Tab */
.expbar{
	position:fixed;
	bottom:15px;
	left:7px;
	border-radius:5px;
 }
.exp_fix1{
	position:fixed!important;
	top:485px!important;
 }
.notify {
	cursor: pointer;
	position:fixed;
	bottom:15px;
	left:100px;
	border-radius:5px;
 }
.not_txt{
	cursor: pointer;
	background-color: red;
	position:fixed;
	left: 155px;
	bottom: 20px;
	width:13px;
	height:16px;
	-moz-border-radius:5px;
	-webkit-border-radius:5px;
	border-radius:5px;
	display:none;
 }
.leftpan_img{
	 background:url(http://localhost/templates/images/m_previous_btn.png) no-repeat;
	 width:11px;
	 height:71px;
         position:absolute;
         position:fixed;
	 left:5px;
         top:400px;
	 z-index: 5;
 }
.rightpan_img{
	background:url(http://localhost/templates/images/m_next_btn.png) no-repeat;
	 width:11px;
	 height:71px;
         position:absolute;
         position:fixed;
         right:5px;
         top:400px;
	 z-index: 5;
 }

/* Notification pop-up */
.inner{
	outline:1px solid #000;
	background-color:wheat;

 }

/* Location of Notification pop-up */
.slide .inner {
	position: fixed;
	left: 102px;
	bottom: 33px;
	z-index:9999999;
 }

</style>
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


  <input type="hidden" id="tst" value="2">
    <div id="page1">
		<div id="mymodal"></div>
	    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/header.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

	    	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/menu.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<?php if ($_SESSION['id_user'] && $_REQUEST['choice'] != 'addMeme'): ?>
	    	<div class="leftpan_img"></div>
	    	<div class="rightpan_img"></div>
		<?php endif; ?>

		<!-- Left/Center/Right Content -->
		<table border="2" width="100%" id="mid_cont">
		    <tr>
			<?php if ($_REQUEST['choice'] != 'addMeme'): ?>
			<td width="15%" id="leftpan" valign="top">
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
			</td>
			<?php endif; ?>

			<td align="left" valign="top">
			    <div><font color="#FF0000"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/messages.tpl.html", 'smarty_include_vars' => array('module' => 'global')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></font></div>
			    <div id="container">
				<?php if ($_SESSION['id_user'] && $_REQUEST['choice'] != 'answer_to_ques' && $_REQUEST['choice'] != 'addMeme' && $_REQUEST['choice'] != 'meme_details'): ?>
				    <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:d621e3948051d88e4a233e782c574c1c#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'question','mgr' => 'question','choice' => 'get_this_week_question'), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:d621e3948051d88e4a233e782c574c1c#0}';}?>
<br>
				<?php endif; ?>

		<!-- Content in middle of page (Live Feed/Editor) -->
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

		<!-- Login form if user not logged in -->
			<!-- switched from user/login_form -->
				<?php if (! $_SESSION['id_user'] && ! $_REQUEST['page']):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?> 
			    </div>
			</td>

			<?php if ($_REQUEST['choice'] != 'addMeme'): ?>
			<td width="15%" id="rightpan" align="center" valign="top" >
			    <?php if ($_SESSION['id_user']): ?>	
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/right_pan.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			    <?php else: ?>
			    
			    	<!-- Only shows Search meme w/o login -->
				    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/right_pan.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			    <?php endif; ?>
			</td>
			<?php endif; ?>
		    </tr>
		</table>

		<?php if ($_SESSION['id_user']): ?>

		<!-- For Experience button -->
<!--	        <div class='expbar' id='expbar' style="z-index:99999;border:3px  solid #cccccc;background-color:#f2f2f2;">Experience Bar</div>-->
		<!-- End -->
		
		<!-- For Notification button -->
		<div id="slidebottom" class="slide">
		      <div class='notify' style="z-index:99999; border:3px  solid #cccccc; background-color:#f2f2f2; float:left;">
			Notification
			<label class="not_txt"><font style="color:white;margin-left: 3px;font-weight:bold;"><span id="not_cnt"></span></font></label>
		      </div>
		      <div class="inner"></div>
		</div>

		<?php endif; ?>
		<div class="clear"></div>
		<div class="push"></div>
		<input type="hidden" id="user_ids" value=""/>
		<input type="hidden" id="id_badges" />
	</div>
	<div id="footer">&copy; Copyrights. All Rights Reserved. 2011</div>
</body>
</html>
