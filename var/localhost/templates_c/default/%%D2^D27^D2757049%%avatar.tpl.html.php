<?php /* Smarty version 2.6.7, created on 2011-12-30 07:08:40
         compiled from user/avatar.tpl.html */ ?>

<!-- Template: user/avatar.tpl.html Start 30/12/2011 07:08:40 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="edit_photo">
<a href="javascript:void(0);" onclick="editPhoto();">

	<?php if ($_SESSION['fb_pic_normal']): ?>
	<img src="<?php echo $_SESSION['fb_pic_normal']; ?>
">
	<?php else: ?>
    <img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif;  endif; ?>"/>
    <?php endif; ?>
    
    </a>
</div>
<div>
 <a href="javascript:void(0);" onclick="editPhoto('<?php echo $_SESSION['id_user']; ?>
');">Change Photo</a>
</div>
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