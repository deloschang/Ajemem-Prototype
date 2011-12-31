<?php /* Smarty version 2.6.7, created on 2011-12-31 22:01:14
         compiled from user/change_avatar.tpl.html */ ?>

<!-- Template: user/change_avatar.tpl.html Start 31/12/2011 22:01:14 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<?php echo '
<script type="text/javascript">
    function preview(){
		var url = "http://localhost/user/preview/ce/0";
		$.ajaxFileUpload({
			url:url,
			secureuri:false,
			fileElementId:\'img\',     
			dataType: \'json\',
			complete: function (data, status){
				console.log("COMPLETE");
				var img_name=data.responseText;
				var picture = "<img src = \'http://localhost/';  echo $this->_tpl_vars['img_path']['preview_thumb'];  echo '"+img_name+"\' height = \'';  echo $this->_tpl_vars['img_path']['thumb_height'];  echo 'px\' width = \'';  echo $this->_tpl_vars['img_path']['thumb_width'];  echo 'px\' />";
				$(\'#getimage\').html(picture);
				$(\'#img_name_span\').html($(\'#server_img\').val(img_name));
				$(\'#get_img_err\').hide();
			 }
		 });
	 }
    
    function image_upload(){
    var url = "http://localhost/";
	    if($(\'#server_img\').val()){
		var formval = $(\'#img_form\').serialize();
		url +="user/image_upload/ce/0/?"+formval;
		$.post(url,function(res){
		    if(res){
			$(\'#edit_photo\').html("<a href=\'javascript:void(0);\' onclick=\'editPhoto();\'><img src=\'http://localhost/';  echo $this->_tpl_vars['img_path']['avtar_thumb'];  echo '"+res+"\'></a>");
			url = "http://localhost/";
			$.fancybox.close();
			var msg = "<font color=\'red\'>Updated successfully</font>";
			var id="upd_msg";
			//showmsg(id,msg);
		     }else{
			alert("There was some error in uploading your profile photo.Please try after some time");
			return false;
		     }	    
		 });
	     }else{
		$(\'#get_img_err\').show();
	     }
	 }
</script>
'; ?>

    <div style="margin-left:100px;">
    	<span class="login_text">Change your avatar</span>
    </div>
    
    <form method = 'post' action="javascript:void(0);" enctype = 'multipart/form-data' name="img_form" id="img_form">
	<div class="">
	    <table border="0" class="">
		<tr>
		    <td><input type = "file" name="img_name" id="img" onchange="preview();"/></td>
		    <td>
			<span id="img_name_span"> <input type="hidden" name="server_img" value="" id="server_img"/></span><br>
		    </td>
		</tr>
		<tr>
		    <span id="getimage" style="width:100px;height:100px"></span><br/>
		</tr>
		<tr>
		    <td colspan="2" align="center">
			<span id="get_img_err" style="display:none"><font color="red">Please upload your picture</font></span><br/>
		    </td>
		</tr>
	    </table>
	</div>
	
	    <div style="">
		<input type="button" name="upload_img" value="Upload" class="" onclick="return image_upload();" />
	    </div>
	
    </form>



<!-- Template: user/change_avatar.tpl.html End --> 