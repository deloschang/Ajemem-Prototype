<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-07 01:01:26
         compiled from user/avatar.tpl.html */ ?>

<!-- Template: user/avatar.tpl.html Start 07/06/2012 01:01:26 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-09 00:28:28
         compiled from user/avatar.tpl.html */ ?>

<!-- Template: user/avatar.tpl.html Start 09/06/2012 00:28:28 --> 
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="edit_photo">
<!-- orig onclick editPhoto; -->

	<?php if ($_SESSION['fb_pic_normal']): ?>
	<img src="<?php echo $_SESSION['fb_pic_normal']; ?>
" style="width:200px;height:auto; padding-top:5px;">
	<?php else: ?>
    <img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>" style="width:140px;height:auto;"/>
    <?php endif; ?>
    
</div>
<!--
<div>
 <a href="javascript:void(0);" onclick="editPhoto('<?php echo $_SESSION['id_user']; ?>
');">Change Photo</a>
</div>
-->
<?php echo '
<script type="text/javascript">
    function editPhoto(id){
		var url="http://localhost/index.php";
			$.post(url,{"page":"user","choice":"edit_avatar","id":id,ce:0 },function(res){
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
</script>
'; ?>


<!-- Template: user/avatar.tpl.html End --> 