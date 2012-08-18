<?php /* Smarty version 2.6.7, created on 2012-08-18 03:53:14
         compiled from common/common.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'common/common.tpl.html', 306, false),array('function', 'get_mod', 'common/common.tpl.html', 369, false),)), $this); ?>
<?php $this->_cache_serials['/Applications/XAMPP/xamppfiles/htdocs/flexycms/../var/localhost/templates_c/default/^%%4F^4F7^4F7F9384%%common.tpl.html.inc'] = '15452cff19a2cef8b8696f887e391bb2'; ?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Memeja, Social Networking with Memes</title>
<meta name="description" content="Memeja helps you share experiences through memes. Connect with the lives of everyone you care about as you share those memorable moments that create a lasting impression."
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>
<link rel="shortcut icon" href="http://localhost/templates/images/memeja_icon.ico" >
<?php $this->assign('appid', $this->_tpl_vars['util']->get_values_from_config('FACEBOOK'));  $this->assign('chc', $_REQUEST['choice']); ?>
<script type="text/javascript" src="http://localhost/libsext/jquery/jquery.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<?php echo '


<!-- Include support librarys first -->
		<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/swfobject/2.2/swfobject.js"></script>
		<script type="text/javascript">
            // For version detection, set to min. required Flash Player version, or 0 (or 0.0.0), for no version detection. 
            var swfVersionStr = "11.2.0";
            // To use express install, set to playerProductInstall.swf, otherwise the empty string. 
            var xiSwfUrlStr = "playerProductInstall.swf";
            var flashvars = { };
			flashvars.appId = "219049284838691";
            var params = { };
            params.quality = "high";
            params.bgcolor = "#ffffff";
            params.allowscriptaccess = "sameDomain";
            params.allowfullscreen = "true";
            var attributes = { };
            attributes.id = "macromeme";
            attributes.name = "macromeme";
            attributes.align = "middle";
            swfobject.embedSWF(
                "macromeme.swf", "flashContent", 
                "100%", "100%", 
                swfVersionStr, xiSwfUrlStr, 
                flashvars, params, attributes);
            // JavaScript enabled so display the flashContent div in case it is not replaced with a swf object.
            swfobject.createCSS("#flashContent", "display:block;text-align:left");
        </script>

<script type="text/javascript">
var chc = "';  echo $this->_tpl_vars['chc'];  echo '";
	var idu = "';  echo $_SESSION['id_user'];  echo '";
	
	var follow_count = parseInt(';  echo $_SESSION['profile_follower_count'];  echo ');	
	// Variables for XP updating
	var curr_xp = ';  if ($_SESSION['exp_point']):  echo $_SESSION['exp_point'];  else: ?>0<?php endif;  echo ',
		xp_to_level = ';  if ($_SESSION['xp_to_level']):  echo $_SESSION['xp_to_level'];  else: ?>0<?php endif;  echo ',
		previous_xp_to_level = ';  if ($_SESSION['previous_xp_to_level']):  echo $_SESSION['previous_xp_to_level'];  else: ?>0<?php endif;  echo ',
		user_level = ';  if ($_SESSION['level']):  echo $_SESSION['level'];  else: ?>0<?php endif;  echo ';

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
		$(".meme_expanded_a").mouseleave(function(){
    		$(this).hide();
    		$(\'.hide_me\').hide();
		 });
		$document.getElementsByClassName(".profile_gallery_meme").mouseover(function(){
    		$(".meme_expanded_a").hide();
    		$(".hide_me").hide();
		 });
		$(\'.meme_gallery\').fancybox({
				padding: 0,
				
				fitToView: false,
				
				prevEffect : \'fade\',
				nextEffect : \'none\',

				closeBtn  : false,
				arrows    : true,
				nextClick : true,
				
				keys: {
					next: [13, 32, 34, 39], // enter, space, page down, down arrow
					prev: [8, 33, 37], // backspace, page up, up arrow
					close: [27] // escape key
				 },
				
				helpers : { 
					thumbs : {
						width  : 50,
						height : 50
					 },
					overlay : {
						opacity : 0.82
					 }
				 },
				afterShow : function (){
					/*
					console.log(this.element.dataset);
					var meme_type = $().attr(\'data-fancybox-group\');
					if (meme_type){
						console.log(meme_type);
					 }
					
					var description = "<div class=\'links\'>"+$("#description > div").eq(this.index).html()+"</div>"
					console.log(description);
					$(\'#fancybox-overlay\').html(description);
                                        */
				 }
			 });
	
		var selected_meme = \'';  echo $_SESSION['profile_meme_image'];  echo '\';
		if (selected_meme){
			$("#selected_image").fancybox({
				// update comment box feature for direct loading 
				padding: 0, 
				fitToView: false,
				afterShow : function (){
					var description = "<div class=\'links\'>"+$("#current_description > div").html()+"</div>"
					
					console.log(description);
					
					$(\'#fancybox-overlay\').html(description);
				 }
			 }).trigger(\'click\');
		 }
		if (idu) {
			/*
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
			 });*/
			
			$("#user_menu").hoverIntent(function(){
				$(".nav_menu").slideDown(\'medium\');
			 }, function() {
				$(".nav_menu").slideUp(\'medium\');
			 });
			$("#callToAction").hoverIntent(function(){
				$(".create_menu").slideDown(\'medium\');
			 }, function() {
				$(".create_menu").slideUp(\'medium\');
			 });
		 }

		var scrn_height = window.screen.availHeight;
            $("#mid_cont").height(scrn_height/2 + scrn_height/9);

	    if(idu!="" && chc!=\'addMeme\'){
			//setInterval("getall_notification()",7000); for notifications
			
	    /* For popup bar */
			//setTimeout("popup_expbar()", 7000); 	
			setTimeout("live_ranking()", 20000);
	     }	    
	 });
</script>
'; ?>

</head>
<body>
<div id="wrap">
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
			//console.log(response);
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

<?php echo '';  if (! $_SESSION['id_user']):  echo '<!--The Landing Page-->';  if (! $_SESSION['profile']):  echo '<div id="front_message">';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '';  if (! $_REQUEST['page']):  echo '';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '';  endif;  echo '</div><!-- NLU can\'t find User-->';  elseif ($_SESSION['profile'] == 'invalid'):  echo '<!--The fixed header on the top--><div id="top_header" class="nohighlight"><div id="cloud_head"><div id="clouds_1" class="clouds"></div><div id="clouds_2" class="clouds"></div><div id="clouds_3" class="clouds"></div><div id="clouds_4" class="clouds"></div><div id="clouds_5" class="clouds"></div><div id="clouds_6" class="clouds"></div><div id="clouds_7" class="clouds"></div><div id="clouds_8" class="large_clouds"></div><div id="clouds_9" class="clouds"></div><div id="clouds_9" class="clouds_hide"></div><div id="clouds_10" class="clouds_hide"></div><div id="clouds_11" class="clouds_hide"></div></div><div id="header_container"><div id= "logoc" class="nohighlight"><a href="http://localhost/"><img src="http://localhost/templates/images/intro_logo.gif"style="width:228px;height:70px;"/></a></div><div id="login_top"><div class="fb-login-button" size="large" scope="email,publish_stream,user_education_history';  echo '';  echo '">Connect with Facebook</div></div></div></div><!--Error message: User Not Found--><div id="nlu_contained"><div id="nlu_profile"><div id="profile_page"><div id="nlu_profile_name"><center>Flerp? We couldn\'t find this user!</center></div></div></div></div><!-- NLU Redirected from Facebook onto a Meme -->';  else:  echo '<!--The fixed header on the top--><div id="top_header" class="nohighlight"><div id="cloud_head"><div id="clouds_1" class="clouds"></div><div id="clouds_2" class="clouds"></div><div id="clouds_3" class="clouds"></div><div id="clouds_4" class="clouds"></div><div id="clouds_5" class="clouds"></div><div id="clouds_6" class="clouds"></div><div id="clouds_7" class="clouds"></div><div id="clouds_8" class="large_clouds"></div><div id="clouds_9" class="clouds"></div><div id="clouds_9" class="clouds_hide"></div><div id="clouds_10" class="clouds_hide"></div><div id="clouds_11" class="clouds_hide"></div></div><div id="header_container"><div id= "logoc" class="nohighlight"><a href="http://localhost/"><img src="http://localhost/templates/images/intro_logo.gif"style="width:228px;height:70px;"/></a></div><div id="login_top"><div class="fb-login-button" size="large" scope="email,publish_stream,user_education_history';  echo '';  echo '">Connect with Facebook</div></div></div></div><div id="nlu_profile"><div id="profile_page"><div id="left_info"><div id="profile_pic">';  if ($_SESSION['profile_picture']):  echo '<img src="';  echo $_SESSION['profile_picture'];  echo '"class="profile_pic"/>';  else:  echo '<img src="http://localhost/image/thumb/avatar/';  if ($_SESSION['avatar']):  echo '';  echo $_SESSION['avatar'];  echo '';  else:  echo '';  if ($_SESSION['gender'] == 'M'):  echo 'memeja_male.png';  else:  echo 'memeja_female.png';  endif;  echo '';  endif;  echo '"class="profile_pic"/>';  endif;  echo '</div><div id="user_info"><div id="profile_name"><a href="/?id=';  echo $_SESSION['profile_dupe_username'];  echo '">';  echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '</a></div><div id="profile_follow_cont"><div id="follower_count">';  if (! $_SESSION['profile_follower_count'] == '0'):  echo '';  echo $_SESSION['profile_follower_count'];  echo '';  else:  echo '0';  endif;  echo '&nbsp followers</div>';  if ($_SESSION['following'] == 'y'):  echo '<span id="follow_me"><a href="javascript:void(0);" id="follow_btn" class="large orangellow button" onclick="follow_user(\'unfollow\');">Follow &nbsp --</a></span>';  elseif ($_SESSION['following'] == 'n'):  echo '<span id="follow_me"><a href="javascript:void(0);" id="follow_btn"class="large orangellow button" onclick="follow_user(\'follow\');">Follow &nbsp ++</a></span>';  endif;  echo '</div><div id="my_memes"><a id="created" class="a-btn"href="javascript:void(0);" onclick="switch_list(\'created\');"><span></span><span>Created</span><span>My Works!</span></a><a id="likes" class="a-btn"href="javascript:void(0);" onclick="switch_list(\'likes\');"><span></span><span>Liked</span><span>My Favs!</span></a><a id="tagged" class="a-btn" href="javascript:void(0);" onclick="switch_list(\'tagged\');"><span></span><span>Tagged</span><span>About Me!</span></a></div></div></div><div id="view_meme">';  if ($_SESSION['profile_meme_image']):  echo '<div id="profile_meme_image"></div><div id="current_description" style="display: none;"><div>';  if ($_SESSION['profile_meme_tagged']):  echo '<span class="fancybox_tagged">Tagged:';  $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
 echo '<span><img src="https://graph.facebook.com/';  echo $this->_tpl_vars['x']['id'];  echo '/picture"/>';  echo $this->_tpl_vars['x']['name'];  echo '</span>';  endforeach; endif; unset($_from);  echo '</span>';  endif;  echo '</div></div>';  if ($_SESSION['profile_meme_tagged']):  echo '<span id="profile_tagged">Tagged:';  $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
 echo '<span><img src="https://graph.facebook.com/';  echo $this->_tpl_vars['x']['id'];  echo '/picture"/>';  echo $this->_tpl_vars['x']['name'];  echo '</span>';  endforeach; endif; unset($_from);  echo '</span>';  endif;  echo '<div id="my_meme_container"><div id="my_meme_list">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#0}';} echo '</div><div id="my_meme_tagged" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#1}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#1}';} echo '</div><div id="my_meme_liked" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#2}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#2}';} echo '</div><div id="profile_meme_expanded"><div id="profile_meme_title" class="hide_me">';  echo ((is_array($_tmp=$_SESSION['profile_meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '</div><img src="http://localhost/image/orig/meme/';  echo $_SESSION['profile_meme_image'];  echo '" class="meme_expanded_a"/></div></div>';  else:  echo '<!--Need to move to appropriate styling--><div id="my_meme_container"><div id="my_meme_list">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#3}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#3}';} echo '</div><div id="my_meme_tagged" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#4}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#4}';} echo '</div><div id="my_meme_liked" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#5}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#5}';} echo '</div></div>';  endif;  echo '</div></div></div>';  endif;  echo '<!-- User Logged in -->';  else:  echo '<div id="top_header" class="nohighlight"><div id="cloud_head"><div id="clouds_1" class="clouds"></div><div id="clouds_2" class="clouds"></div><div id="clouds_3" class="clouds"></div><div id="clouds_4" class="clouds"></div><div id="clouds_5" class="clouds"></div><div id="clouds_6" class="clouds"></div><div id="clouds_7" class="clouds"></div><div id="clouds_8" class="large_clouds"></div><div id="clouds_9" class="clouds"></div><div id="clouds_9" class="clouds_hide"></div><div id="clouds_10" class="clouds_hide"></div><div id="clouds_11" class="clouds_hide"></div></div><div id="header_container"><div id= "logoc" class="nohighlight"><a href="http://localhost/"><img src="http://localhost/templates/images/intro_logo.gif"style="width:228px;height:70px;"/></a></div><form id ="searches"><input type="text" class="self-describing" name="mtitle" id="mtitle" title="Search by title." style="width:300px;"/></form><div id="header_nav"><table><tr><td><div id="home_link" class="header_nav"><a href="/">Home</a></div></td><td><div id="random_meme" class="header_nav"><a href="javascript:void(0);" onclick="get_random_meme();">Random</a></div></td><td><div id="feedback" class="header_nav"><a href="javascript:void(0);" onclick="javascript:toggleDiv(\'content1\',\'icon1\');">Feedback?</a><div id="content1" class="item" style="display:none; z-index:500;"><form action="send-contact-message.php" method="post"><p><input type="hidden" name="name" id="name" size="25" value="';  echo $_SESSION['username'];  echo '"></p><p>Comments:<br><textarea name="message" rows="5" cols="25"></textarea></p><p><button type="submit">Submit</button></p></form></div></div></td></tr></table></div><div id="callToAction"><div id="outer_sun"></div><div id="inner_sun_1"></div><div id="inner_sun_2"></div><a id="create"href="javascript:void(0);" class="orangellow button">Create</a><div class="create_menu" id="hover_menu"><div class="create_menu_contents"><ul class="create_menu_list"><li><a href="/macromeme.html"><img src="http://localhost/templates/images/macromeme.jpg"/></a></li><li><a href="/meme/addMeme"><img src="http://localhost/templates/images/rage_comic.png"/></a></li></ul></div></div></div><div id="user_menu"><div id="user_pic" class="nohighlight"><a href="/?id=';  echo $_SESSION['dupe_username'];  echo '">';  if ($_SESSION['fb_pic_normal']):  echo '<img src="';  echo $_SESSION['fb_pic_normal'];  echo '" class="user_pic">';  else:  echo '<img src="http://localhost/image/thumb/avatar/';  if ($_SESSION['avatar']):  echo '';  echo $_SESSION['avatar'];  echo '';  else:  echo '';  if ($_SESSION['gender'] == 'M'):  echo 'memeja_male.png';  else:  echo 'memeja_female.png';  endif;  echo '';  endif;  echo '" class="user_pic"/>';  endif;  echo '</a></div><div id="rank_circle"><div id="ranking_number">';  if ($_SESSION['exp_rank']):  echo '<a href="/?id=';  echo $_SESSION['dupe_username'];  echo '">';  echo $_SESSION['exp_rank'];  echo '</a>';  else:  echo '?';  endif;  echo '</div></div><div id = "user_name" class="nohighlight"><a href ="/?id=';  echo $_SESSION['dupe_username'];  echo '">';  echo ((is_array($_tmp=$_SESSION['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '</a></div><div class="nav_menu" id="hover_menu"><div class="hover_menu_contents"><ul class="nav_menu_list"><li><a href="javascript:void(0);" onclick="fb_logout();">Logout</a></li></ul></div></div><div id="triangle_down"></div></div></div></div>';  if ($_REQUEST['choice'] == 'macromeme'):  echo '<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><div id="flashContent"><p>To view this page ensure that Adobe Flash Player version11.2.0 or greater is installed.</p><script type="text/javascript">var pageHost = ((document.location.protocol == "https:") ? "https://" : "http://");document.write("<a href=\'http://www.adobe.com/go/getflashplayer\'><img src=\'"+ pageHost + "www.adobe.com/images/shared/download_buttons/get_flash_player.gif\' alt=\'Get Adobe Flash player\' /></a>" );</script></div>';  endif;  echo '';  if ($_REQUEST['choice'] != 'addMeme' && $_REQUEST['choice'] != 'macromeme'):  echo '<div id="contained"><!-- Logged in User on the Home Page -->';  if (! $_SESSION['profile']):  echo '<div id="live_feed" class="nohighlight">';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '</div><!-- Logged in User on invalid profile -->';  elseif ($_SESSION['profile'] == 'invalid'):  echo '<div id="nlu_contained"><div id="nlu_profile"><div id="profile_page"><div id="nlu_profile_name"><center>Flerp? We couldn\'t find this user!</center></div></div></div></div><!-- Logged in User on a Profile -->';  else:  echo '<div id="profile_page"><div id="left_info"><div id="profile_pic">';  if ($_SESSION['profile_picture']):  echo '<img src="';  echo $_SESSION['profile_picture'];  echo '"class="profile_pic"/>';  else:  echo '<img src="http://localhost/image/thumb/avatar/';  if ($_SESSION['avatar']):  echo '';  echo $_SESSION['avatar'];  echo '';  else:  echo '';  if ($_SESSION['gender'] == 'M'):  echo 'memeja_male.png';  else:  echo 'memeja_female.png';  endif;  echo '';  endif;  echo '"class="profile_pic"/>';  endif;  echo '</div><div id="user_info"><div id="profile_name"><a href="/?id=';  echo $_SESSION['profile_dupe_username'];  echo '">';  echo ((is_array($_tmp=$_SESSION['profile'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '</a></div><div id="profile_follow_cont"><div id="follower_count">';  if (! $_SESSION['profile_follower_count'] == '0'):  echo '';  echo $_SESSION['profile_follower_count'];  echo '';  else:  echo '0';  endif;  echo '&nbsp followers</div>';  if ($_SESSION['following'] == 'y'):  echo '<span id="follow_me"><a href="javascript:void(0);" id="follow_btn" class="large orangellow button" onclick="follow_user(\'unfollow\');">Follow &nbsp --</a></span>';  elseif ($_SESSION['following'] == 'n'):  echo '<span id="follow_me"><a href="javascript:void(0);" id="follow_btn"class="large orangellow button" onclick="follow_user(\'follow\');">Follow &nbsp ++</a></span>';  endif;  echo '</div><div id="my_memes"><a id="created" class="a-btn"href="javascript:void(0);" onclick="switch_list(\'created\');"><span></span><span>Created</span><span>My Works!</span></a><a id="likes" class="a-btn"href="javascript:void(0);" onclick="switch_list(\'likes\');"><span></span><span>Liked</span><span>My Favs!</span></a><a id="tagged" class="a-btn" href="javascript:void(0);" onclick="switch_list(\'tagged\');"><span></span><span>Tagged</span><span>About Me!</span></a></div></div></div><div id="view_meme">';  if ($_SESSION['profile_meme_image']):  echo '<div id="profile_meme_image"></div><div id="current_description" style="display: none;"><div>';  if ($_SESSION['profile_meme_tagged']):  echo '<span class="fancybox_tagged">Tagged:';  $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
 echo '<span><img src="https://graph.facebook.com/';  echo $this->_tpl_vars['x']['id'];  echo '/picture"/>';  echo $this->_tpl_vars['x']['name'];  echo '</span>';  endforeach; endif; unset($_from);  echo '</span>';  endif;  echo '</div></div>';  if ($_SESSION['profile_meme_tagged']):  echo '<span id="profile_tagged">Tagged:';  $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$_SESSION['profile_meme_tagged']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
 echo '<span><img src="https://graph.facebook.com/';  echo $this->_tpl_vars['x']['id'];  echo '/picture"/>';  echo $this->_tpl_vars['x']['name'];  echo '</span>';  endforeach; endif; unset($_from);  echo '</span>';  endif;  echo '<div id="my_meme_container"><div id="my_meme_list">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#6}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#6}';} echo '</div><div id="my_meme_tagged" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#7}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#7}';} echo '</div><div id="my_meme_liked" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#8}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#8}';} echo '</div><div id="profile_meme_expanded"><div id="profile_meme_title" class="hide_me">';  echo ((is_array($_tmp=$_SESSION['profile_meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '</div><img src="http://localhost/image/orig/meme/';  echo $_SESSION['profile_meme_image'];  echo '" class="meme_expanded_a"/></div></div>';  else:  echo '<div id="my_meme_container"><div id="my_meme_list">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#9}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_meme_list','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#9}';} echo '</div><div id="my_meme_tagged" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#10}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'tagged_memes','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#10}';} echo '</div><div id="my_meme_liked" style="display:none;">';  if ($this->caching && !$this->_cache_including) { echo '{nocache:15452cff19a2cef8b8696f887e391bb2#11}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'manage','mgr' => 'manage','choice' => 'my_favorites','gmod' => 1), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:15452cff19a2cef8b8696f887e391bb2#11}';} echo '</div></div>';  endif;  echo '</div></div></div>';  endif;  echo '';  else:  echo '<div id="editorcontent" class="nohighlight">';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '';  if (! $_SESSION['id_user'] && ! $_REQUEST['page']):  echo '';  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/home.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  echo '';  endif;  echo '</div>';  endif;  echo '';  endif;  echo ''; ?>

</div>
</body>

<?php echo '

<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox.pack.js?v=2.0.5"></script>
<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-thumbs.js?v=2.0.5"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://localhost/libsext/hotkeys/jquery.hotkeys.js"></script>

<script type="text/javascript" src="http://localhost/libsext/hoverintent/jquery.hoverIntent.js"></script>
<script type="text/javascript" src="http://localhost/js/jquery-1.7.1.min.js"></script>
<script type="text/javascript">	
   function switch_list(param){
      if (param == \'tagged\'){
         $(\'#my_meme_tagged\').show();
         $(\'#my_meme_list, #my_meme_liked, #profile_meme_expanded_o\').hide();
       } else if (param == \'likes\'){
         $(\'#my_meme_tagged, #my_meme_list, #profile_meme_expanded_o\').hide();
         $(\'#my_meme_liked\').show();
       } else if (param == \'created\'){
         $(\'#my_meme_tagged, #my_meme_liked, #profile_meme_expanded_o\').hide();
         $(\'#my_meme_list\').show();
       }

    }
	function toggleDiv(id1,id2) {
		var tag = document.getElementById(id1).style;
		if(tag.display == "none") {
			tag.display = "block";
		 } else {
			tag.display = "none";
		 }
	 }
	function log_in_reminder(){
		 var url="http://localhost/user/log_in_reminder";
		 
		$.post(url,{ce:0 }, function(res){
			$.fancybox(res);
    	 });
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
					
					/*$("#trailing_user_profile_pic").html(\'<a href="/?id=\'+trailing_dupe+\'"><img src="\'+trailing_pic+\'" style="width:30px;height:30px"/></a>\');
					
					$("#trailing_ranking_number").css("color", \'#FEEB4E\');
					$("#trailing_ranking_number").animate( { "opacity" : 0.4  }, 1000, function() {
						$("#trailing_ranking_number").css("color","#C0E791");
						$("#trailing_ranking_number").animate( { "opacity" : 1  }, 300)
					 });
					*/
					//$("#trailing_exp").html(ajax_response_exp[1]+\'<span style="font-size:8px; position:relative; bottom:3px;"> XP</span>\');	
						
				// Rank? Yes. Improvement? Yes.
				 } else if (ajax_response_exp[0].trim() == "BA") {
					new_rank = ajax_response_exp[1];
					/*trailing_pic = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					trailing_dupe = ajax_response_exp[5];*/
					
					$("#ranking_number").html(new_rank);
					
					// Green flash

					$("#ranking_number").css("color", \'#B9FE4E\');
					$("#ranking_number").animate( { "opacity" : 0.4  }, 900, function() {
						$("#ranking_number").css("color","#81CDFE");
						$("#ranking_number").animate( { "opacity" : 1  }, 500)
					 });
					
					$("#user_name").css("background", \'#B9FE4E\');
					$("#user_name").animate( { "opacity" : 0.4  }, 700, function() {
						$("#user_name").css("background",\'\');
						$("#user_name").animate( { "opacity" : 1  }, 500)
					 });

                                        /*
					if (trailing_user) {
					
						$("#trailing_ranking_number").html(trailing_rank);
						$("#trailing_user_profile_pic").html(\'<a href="/?id=\'+trailing_dupe+\'"><img src="\'+trailing_pic+\'" style="width:30px;height:30px"/></a>\');	
							
						//$("#trailing_user").html(trailing_user);
						
						//$("#trailing_user_pic").css("background", \'#FE4EB9\');
						//$("#trailing_user_pic").animate( { "opacity" : 0.4  }, 700, function() {
						//	$("#trailing_user_pic").css("background","#aad450");
						//	$("#trailing_user_pic").animate( { "opacity" : 1  }, 300)
						// });
					
					 }*/					
				
				// Rank? Yes. Improve? No.
				 } else {
					new_rank = ajax_response_exp[1];
                                        /*
					trailing_xp = ajax_response_exp[2];
					trailing_user = ajax_response_exp[3];
					trailing_rank = ajax_response_exp[4];
					trailing_dupe = ajax_response_exp[5];*/
					
					$("#ranking_number").html(new_rank);
							
					// Red flash

					$("#ranking_number").css("color", \'#FE4EB9\');
					$("#ranking_number").animate( { "opacity" : 0.4  }, 900, function() {
						$("#ranking_number").css("color","#81cdfe");
						$("#ranking_number").animate( { "opacity" : 1  }, 500)
					 });
					
					$("#user_name").css("background", \'#FE4E61\');
					$("#user_name").animate( { "opacity" : 0.4  }, 700, function() {
						$("#user_name").css("background",\'\');
						$("#user_name").animate( { "opacity" : 1  }, 500)
					 });

                                        /*
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
					 }*/
				 }
				
				setTimeout("live_ranking()", 20000);
				rank_wait = 40000;
			 }
		 });
	 }

	function get_random_meme(){		
		var url = "http://localhost/meme/meme_list/cat/rand";
		$.fancybox.showLoading();
		$.post(url,{ce:0 },function(res){
			$("#randpgexist").val(1);
			$.fancybox.open(res,{
				fitToView: false,
				/*	FB comment integration.
					afterShow : function(){
					var random_description = "<div class=\'links\'>"+$("#random_description > div").html()+"</div>"
					
					console.log(random_description);
					
					$(\'#fancybox-overlay\').html(random_description);
				 },*/
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
	
	function show_fancybox(res){
		$.fancybox(res,{centerOnScroll:true,hideOnOverlayClick:false });
	 }
	
	function follow_user(status) {		
		';  if ($_SESSION['profile_id']):  echo '
		var profile_id = ';  echo $_SESSION['profile_id'];  echo '
		';  endif;  echo '
		var url = "http://localhost/user/follow_user";
		
		$.post(url, {ce:0, id:profile_id, status:status }, function(res){
			if (status == \'follow\') {
				$("#follow_me").html(\'<a href="javascript:void(0);" id="follow_btn" class="large orangellow button" onclick="follow_user(\\\'unfollow\\\');">Follow &nbsp --</a>\');
				follow_count += 1;				
			 } else if (status == \'unfollow\') {
				$("#follow_me").html(\'<a href="javascript:void(0);" id="follow_btn" class="large orangellow button "onclick="follow_user(\\\'follow\\\');">Follow &nbsp ++</a>\');
				
				follow_count -= 1;
			 }
			
			$(\'#follower_count\').html(follow_count+\' followers\');
		 });
	 }

/*
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
	*/
	
	function fb_logout(response){
		url="http://localhost/";		
		FB.getLoginStatus(function(response){
			if (!response.authResponse){
				window.location.href = url+"user/logout";
				return;
			 }	
			FB.logout(fb_logout);
		 });
	 }
	
</script>
'; ?>

</html>