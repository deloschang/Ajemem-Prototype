<?php /* Smarty version 2.6.7, created on 2011-11-02 08:34:59
         compiled from user/avatar.tpl.html */ ?>

<!-- Template: user/avatar.tpl.html Start 02/11/2011 08:34:59 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="edit_photo">
<a href="javascript:void(0);" onclick="editPhoto();">
    <img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['avatar']):  echo $_SESSION['avatar'];  else:  if ($_SESSION['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>" /></a>
</div>
<div>
 <a href="javascript:void(0);" onclick="editPhoto('<?php echo $_SESSION['id_user']; ?>
');">Change Photo</a>
</div>
<?php echo '
<script type="text/javascript">
    function editPhoto(id){
	var url="http://localhost/index.php";
	    $.fancybox.showActivity();
	    $.post(url,{"page":"user","choice":"edit_avatar","id":id,ce:0 },function(response){
		    $.fancybox(response);
	     });
     }
</script>
'; ?>


<!-- Template: user/avatar.tpl.html End --> 