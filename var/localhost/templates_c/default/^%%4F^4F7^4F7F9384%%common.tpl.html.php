<?php /* Smarty version 2.6.7, created on 2011-12-16 09:55:22
         compiled from common/common.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'common/common.tpl.html', 368, false),)), $this); ?>
<?php $this->_cache_serials['/opt/lampp/htdocs/flexycms/../var/localhost/templates_c/default/^%%4F^4F7^4F7F9384%%common.tpl.html.inc'] = '6de42172c69924962e22b14676939ec3'; ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memeja: 2 Me's; 1 Meme</title>
<?php $this->assign('appid', $this->_tpl_vars['util']->get_values_from_config('FACEBOOK')); ?>
<?php $this->assign('chc', $_REQUEST['choice']); ?>
<script type="text/javascript" src="http://localhost/libsext/jquery/jquery.js"></script>
<script type="text/javascript" src="http://localhost/libsext/jquery/jquery-1.4.2.min.js"></script>


<script type="text/javascript" src="http://localhost/libsext/fancybox/jquery.fancybox-1.3.2.pack.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.validate.js"></script>
<script type="text/javascript" src="http://localhost/templates/flexyjs/flexymessage.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ui.datepicker.js"></script>
<script type="text/javascript" src="http://localhost/templates/flexyjs/jquery.bubblepopup.v2.3.1.min.js"></script>
<script type="text/javascript" src="http://localhost/libsext/js/ajaxfileupload.js"></script>



<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/jquery.bubblepopup.v2.3.1.css"/>

<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/mainpg.css"/>
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/fancybox/jquery.fancybox-1.3.2.css"/>
<?php echo '
<script type="text/javascript">
	var chc ="';  echo $this->_tpl_vars['chc'];  echo '";
	var idu="';  echo $_SESSION['id_user'];  echo '";
	$(document).ready(function(){
	    var scrn_height = window.screen.availHeight;
            $("#mid_cont").height(scrn_height/2 + scrn_height/9);


	    /* For notification */
	    $(".inner").hide();
	    $(\'#slidebottom div\').click(function() {
		get_details_notification();
		$(this).next().slideToggle();
	     });

	    if(idu!="" && chc!=\'addMeme\'){
		setInterval("getall_notification()",3000);

	    /* end */
	    /* For popup bar */
		setInterval("popup_expbar()",6000);
	     }

	    /* TOS Fancybox Popup on First Login */
	    var first_login="';  echo $_SESSION['toc'];  echo '";
	    if(first_login==\'0\'){
		    $.get(\'http://localhost/user/first_login_msg/ce/0\', function(res) {
			$.fancybox(res,{
			    centerOnScroll:true,
			    hideOnOverlayClick:false,
			    onCleanup : function (){
				if($("#toc").is(":checked")){
				    $.get(\'http://localhost/user/first_login_msg/ce/0/upd/upd\', function(data) { });
				    return true;
				 }else{
				    alert("Please agree with our Terms Of Services");
				    return false;
				 }
			     }
			 });
		     });
	     }

	    if(idu){
	        $(\'.expbar\').CreateBubblePopup({
			position :\'top\',
			align	 : \'left\',
			tail	 : {align: \'left\' },
			innerHtml: \'<img src="http://localhost/templates/css_theme/images/loading.gif" style="border:0px; vertical-align:middle; display:inline;" >loading!\',
			innerHtmlStyle: {color:\'#FFFFFF\',\'text-align\':\'center\' },
			themeName: 	\'all-blue\',
			themePath: 	\'http://localhost/templates/css_theme/images/jquerybubblepopup-theme\',
			alwaysVisible: false,
			closingDelay: 2000,
			afterShown: function () {
				$("#tst").val(1);
			 },
	            	afterHidden: function () {
				$("#tst").val(2);
			 }
		 });

		 $(\'.expbar\').mouseover(function(){
		   	var button = $(this);
		   	$.get(\'http://localhost/user/getExperience/ce/0\', function(data) {
			    var seconds_to_wait = 1;
			    function pause(){
				    var timer = setTimeout(function(){
					    seconds_to_wait--;
					    if(seconds_to_wait > 0){
						    pause();
					     }else{
						  if(data!=2){
						    button.SetBubblePopupInnerHtml(data, false);
						   }
					     };
				     },1000);
			     };pause();
		    	 });
		  });
	     }
	    /* End */
	    /* For updating total login time */
	    upd_log_time();
	    /* End */

	 });
	function getall_notification(){
	    var url="http://localhost/manage/getall_notification";
	    $.post(url,{ce:0 },function(res){
		if(res[0]!="-1"){
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
	function popup_expbar(){

		var data;
		var url="http://localhost/user/getExperience/ce/0/chk/1";
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
		if (httpRequest.status == 200) {
			data=httpRequest.responseText;
		 }
		if(data==1){
			return false;
		 }

		$(\'.expbar\').CreateBubblePopup({
			position : \'top\',
			align	 : \'left\',
			tail	 : {align: \'left\' },
			innerHtml: \'<img src="http://localhost/templates/css_theme/images/loading.gif" style="border:0px; vertical-align:middle; display:inline;" >loading!\',
			innerHtmlStyle: {color:\'#CCCCCC\',\'text-align\':\'center\' },
			themeName: 	\'all-blue\',
			themePath: 	\'http://localhost/templates/css_theme/images/jquerybubblepopup-theme\',
			alwaysVisible: false,
			closingDelay: 500,
			afterShown: function () {
				$("#tst").val(1);
			 },
	            	afterHidden: function () {
				$("#tst").val(2);
			 }
		 });
		var button = $(\'.expbar\');

		var seconds_to_wait = 1;
		function pause(){
		    var timer = setTimeout(function(){
			    seconds_to_wait--;
			    if(seconds_to_wait > 0){
				    pause();
			     }else{
				if(data!=2)
				    button.SetBubblePopupInnerHtml(data, false);
			     };
		     },1000);
		 };pause();
		$(\'.expbar\').ShowBubblePopup();
		setTimeout("closeexpbar()",8000);
	 }
	/*$(window).scroll(function () { 
		var tst=$("#tst").val();
		if (tst==\'1\'){
		  window.scroll=false;
		 }
		else 
			var s=6;
	 });
	*/
	function closeexpbar(){
	    $(\'.expbar\').trigger("hidebubblepopup", [true]);
	 }
	function upd_log_time() {
		  var url="http://localhost/index.php";
		  $.post(url,{page:"user",choice:"set_login_time",ce:0 },function(res){//alert(res);
		   })
		  setTimeout("upd_log_time()",10000);
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
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
<script type="text/javascript">
	var app_id=\'';  echo $this->_tpl_vars['appid']['app_id'];  echo '\';
	    window.fbAsyncInit = function() {
		   FB.init({appId: app_id, status: true, cookie: true, xfbml: true });
	     }
	    function fb_logout(){
	       url="http://localhost/";
	       $.post(url,{page:"user",choice:"check_fb_session",ce:0 },function(res){
		if(res==\'-1\'){
		       window.location.href = url+"user/logout";
		 }else{
		       FB.logout(function(response) {
				window.location.href = url+"user/logout";
		        });
		 }

	        })
	 }

</script>
<style type="text/css">

body {
	margin-left:75px;
	margin-right:75px;
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
    <input type="hidden" id="tst" value="2">
    <div id="page1">
		<div id="fb-root"></div>
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
				    <?php if ($this->caching && !$this->_cache_including) { echo '{nocache:6de42172c69924962e22b14676939ec3#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'question','mgr' => 'question','choice' => 'get_this_week_question'), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:6de42172c69924962e22b14676939ec3#0}';}?>
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
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/meme_list.tpl.html", 'smarty_include_vars' => array()));
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
	        <div class='expbar' id='expbar' style="z-index:99999;border:3px  solid #cccccc;background-color:#f2f2f2;">Experience Bar</div>
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
