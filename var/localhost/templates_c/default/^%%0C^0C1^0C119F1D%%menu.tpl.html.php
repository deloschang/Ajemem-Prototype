<?php /* Smarty version 2.6.7, created on 2011-12-16 09:55:22
         compiled from common/menu.tpl.html */ ?>

<!-- Template: common/menu.tpl.html Start 16/12/2011 09:55:22 --> 
 <?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<div id="navigation">
    <div class="menu-header">
	<ul class="menu">
	    <!--<li <?php if ($_REQUEST['page'] == 'user' && $_REQUEST['choice'] == 'user_home'): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/user/user_home">Home</a>
	    </li>-->
	    <li <?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_list' && ( $_REQUEST['cat'] == 'main_feed' || $_REQUEST['cat'] == 'network_feed' )): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/meme/meme_list/cat/main_feed">Home</a>
	    </li>
	    <li <?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'addMeme'): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/meme/addMeme">Make-A-Meme</a>
	    </li>

	    <li <?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_list' && $_REQUEST['cat'] == 'top'): ?>class="current"<?php endif; ?>>
		<a href="http://localhost/meme/meme_list/cat/top">Top Memes</a>
	    </li>

<!-- CATEGORIES COMMENTED OUT
	    <?php if (count($_from = (array)$this->_tpl_vars['category'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<li <?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_list' && $_REQUEST['cat'] == $this->_tpl_vars['key']): ?>class="current"<?php endif; ?>>
		    <a href="http://localhost/meme/meme_list/cat/<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</a>
		</li>
	    <?php endforeach; endif; unset($_from); ?>
	     <li <?php if ($_REQUEST['page'] == 'meme' && $_REQUEST['choice'] == 'meme_list' && $_REQUEST['cat'] == 'rand'): ?>class="current"<?php endif; ?>>
!-->

		<a href="javascript:void(0);" onclick="get_random_meme();">Random Generator</a>
	    </li>

	   
        </ul>
    </div>
</div>
<div class="clear"></div>
<?php echo '
<style type="text/css">
.position_fixed {
    position:fixed;
    top:30px;
    right:5px;
 }

</style>
<script type="text/javascript">
    function get_random_meme(){
	var url = "http://localhost/meme/meme_list/cat/rand";
	$.fancybox.showActivity();
	$.post(url,{ce:0 },function(res){
	    $("#randpgexist").val(1);
	    $.fancybox(res,{
		    centerOnScroll:true,
		    onCleanup : function (){
			$("#randpgexist").val(0);
		     }
	     });
	    $.fancybox.resize();
	 });
     }
</script>
'; ?>


<!-- Template: common/menu.tpl.html End --> 