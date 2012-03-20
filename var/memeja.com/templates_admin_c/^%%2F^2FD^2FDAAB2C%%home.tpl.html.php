<?php /* Smarty version 2.6.7, created on 2011-09-30 15:51:28
         compiled from admin/home.tpl.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Memeje Admin</title>
<?php $this->assign('css', $this->_tpl_vars['util']->get_values_from_config('ADMIN_THEME')); ?>
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/css/<?php echo $this->_tpl_vars['css']['css']; ?>
.css" />
<!--[if lte IE 7.0]><link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/ie.css" media="screen, projection, tv" /><![endif]-->
<!--[if IE 8.0]>
    <?php echo '
    <style type="text/css">
        form.fields fieldset {margin-top: -10px; }
    </style>
    '; ?>

<![endif]-->
<script type="text/javascript" src="http://memeja.com/libsext/jquery/jquery.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/js/jquery.validate.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/fancybox/jquery.fancybox-1.3.2.pack.js"></script>
<script type="text/javascript" src="http://memeja.com/templates/flexyjs/flexymessage.js"></script>

<script type="text/javascript" src="http://memeja.com/libsext/fckeditor/fckeditor.js"></script>
<!--<script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/jquery.multiautocomplete.js"></script>-->
<script type="text/javascript" src="http://memeja.com/libsext/js/jquery.autocomplete.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/js/overlib.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/js/ajaxfileupload.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/jquery/jquery-ui.js"></script>

<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/jquery-ui-1.7.3.css"/>
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/fancybox/jquery.fancybox-1.3.2.css"/>

<?php echo '
<!--[if gte IE 5.5]>
<![if lt IE 7]>
<style type="text/css">
div#fixme {
  /* IE5.5+/Win - this is more specific than the IE 5.0 version */
  left: expression( ( 0 + ( ignoreMe2 = document.documentElement.scrollLeft ? document.documentElement.scrollLeft : document.body.scrollLeft ) ) + \'px\' );
  top: expression( ( ( ignoreMe = document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop ) ) + \'px\' );
 }
</style>
<![endif]>
<![endif]-->

<!--for fancybox scroll
<style type="text/css">
	#fancybox-wrap {
		position: fixed;
	 }
</style>-->

'; ?>

<!--[if lte IE 6]><script type="text/javascript" src="js/ddpng.js"></script><script type="text/javascript">
        DD_belatedPNG.fix('#nav #h-wrap .h-ico');
        DD_belatedPNG.fix('.ico img');
        DD_belatedPNG.fix('.msg p');
        DD_belatedPNG.fix('table.calendar thead th.month a img');
        DD_belatedPNG.fix('table.calendar tbody img');
    </script><![endif]-->
<script type="text/javascript">
	var pagi_divid = "<?php echo $this->_tpl_vars['sm']['AJAX']; ?>
";
</script>
<?php echo '
<script type="text/javascript">
	$(document).ready(function() {
		fixheader();
		$(" #nav_list ul ").css({display: "none" }); // Opera Fix
		$(" #nav_list li").hover(
			function(){
				$(this).find(\'ul:first\').css({visibility: "visible",display: "none" }).fadeIn(350);
			 },
			function(){
				$(this).find(\'ul:first\').css({visibility: "hidden" });
			 }
		);

		var $searchq = $("#search-q").attr("value");
		$(\'#search-q.text\').css(\'color\', \'#999\');
		$(\'#search-q\').focus(function(){
			if ( $(this).attr(\'value\') == $searchq) {
				$(this).css(\'color\', \'#555\');
				$(this).attr(\'value\', \'\');
			 }
		 });
		$(\'#search-q\').blur(function(){
			if ( $(this).attr(\'value\') == \'\' ) {
				$(this).attr(\'value\', $searchq);
				$(this).css(\'color\', \'#999\');
			 }
		 });
		$(\'#h-wrap\').hover(function(){
				$(this).toggleClass(\'active\');
				$("#h-wrap ul").css(\'display\', \'block\');
			 }, function(){
				$(this).toggleClass(\'active\');
				$("#h-wrap ul").css(\'display\', \'none\');
		 });
		css_even_odd();
		$(\'form.fields fieldset:last-child\').addClass(\'last\');
		$(\'ul.simple li:even\').addClass(\'even\');
		$(\'.grid .line:even\').addClass(\'even\');
		$(\'.grid .line:first-child\').addClass(\'firstline\');
		$(\'.grid .line:last-child\').addClass(\'lastline\');
		$(\'#box1 .content#box1-grid\').hide();

		$(\'#box1 .header ul a\').click(function(){
			$(\'#box1 .header ul a\').removeClass(\'active\');
			$(this).addClass(\'active\');
			$(\'#box1 .content\').hide();
			$(\'#box1\').find(\'#\' + $(this).attr(\'rel\')).show();
			return false;
		 });
	 });
	function fixheader(){
		var viewportwidth;
		var viewportheight;
		if (typeof window.innerWidth != \'undefined\') {
			viewportwidth = window.innerWidth,
			viewportheight = window.innerHeight
		 } else if (typeof(document.documentElement) != \'undefined\' && typeof(document.documentElement.clientWidth)!=\'undefined\' && document.documentElement.clientWidth != 0) {
			viewportwidth = document.documentElement.clientWidth,
			viewportheight = document.documentElement.clientHeight
		 } else {
			viewportwidth = document.getElementsByTagName(\'body\')[0].clientWidth,
			viewportheight = document.getElementsByTagName(\'body\')[0].clientHeight
		 }
		$(\'#fixme\').css({width:viewportwidth+\'px\' });
	 }
	function get_next_page(url, start, limit, div_id) {
		if (!document.getElementById(div_id)) {
			div_id = "content";
		 }
		$("#"+div_id).load(url, {\'qstart\':start, \'limit\':limit, \'ce\':0,\'pg\':1,chk:1 }, function(res){
			css_even_odd();
		 });
	 }
	function css_even_odd() {
		$(\'tbody tr:even\').addClass(\'even\');
		$(\'table.grid tbody tr:last-child\').addClass(\'last\');
		$(\'tr th:first-child, tr td:first-child\').addClass(\'first\');
		$(\'tr th:last-child, tr td:last-child\').addClass(\'last\');
	 }

	//Show fancybox modal with content
	function show_fancybox(res){
		$.fancybox(res,{centerOnScroll:true,hideOnOverlayClick:false });
		//$.fancybox(res,{margin:600,hideOnOverlayClick:false });
	 }

	//show error message in case of multiple options for ajax update   -- ex:-config management
	function showmsg(id,msg){
		if(!id)
		var id="errmsg";
		$(\'#\'+id).html(msg).css({\'position\':\'fixed\',\'top\':\'120px\',\'left\':\'450px\',\'zIndex\':\'10055\' }).show(\'slow\');
		setTimeout("hidemsg(\'"+id+"\')",3000);
	 }
	function hidemsg(id){
		$(\'#\'+id).hide(\'slow\');
	 }
	//End show error message
</script>

'; ?>

</head>
<body>
<div id="errmsg" class="errmsg"></div>
<div id="mymodal" style="display:none"></div>
	<div id="fixme">
        <div id="header">
            <div class="inner-container clearfix">
                <div class="clear"></div>
                <span class="admin_title">Memeje Admin</span>
            	<div class="clearfix"></div>
                <h1 id="logo" class="fl">
                    <div class="menu-inner-container">
                        <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/menu.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
                    </div>
                </h1>

          <div id="userbox">
                    <div class="inner">
                        <strong><?php echo $_SESSION['username']; ?>
</strong>
                            <ul class="clearfix">
                                <li><a href="http://memeja.com/flexyadmin/user/profile">Modify Profile</a></li>
                            </ul>
                    </div>
<!-- <a id="logout" title="Logout" href="http://memeja.com/page-user-choice-logout-a-1">log out<span class="ir"></span></a>-->
                    <a id="logout" title="Logout" href="http://memeja.com/user/logout/a/1">log out<span class="ir"></span></a>           
		  </div>
          </div>
        </div>
    </div>
    <div class="clearfixme"></div>

    <div>
        <div class="inner-container">
		<div id="target" align="center"><font color="red"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "common/messages.tpl.html", 'smarty_include_vars' => array('module' => 'global')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></font></div>
		<?php if ($_REQUEST['page'] != ''): ?>
			<div id="content"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => $this->_tpl_vars['content'], 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
		<?php else: ?>
			<div style="min-height:300px"></div>
		<?php endif; ?>
		<div id="footer"><p>&copy; Copyrights 2011 ! All Rights Reserved, <a href="http://afixi.com" target="_blank">Afixi Technologies Pvt. Ltd.</a></p>

		</div>
        </div>
    </div>
</body>
</html>