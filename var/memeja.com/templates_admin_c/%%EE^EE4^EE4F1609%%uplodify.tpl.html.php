<?php /* Smarty version 2.6.7, created on 2011-09-19 23:46:06
         compiled from admin/meme/uplodify.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/meme/uplodify.tpl.html', 93, false),)), $this); ?>

<!-- Template: admin/meme/uplodify.tpl.html Start 19/09/2011 23:46:06 --> 
 <script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/uploadify/swfobject.js"></script>
<script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/uploadify/jquery.uploadify.v2.1.0.min.js"></script>
<script type="text/javascript" src="http://memeja.com/templates/flexyjs/js/jquery.application.js"></script>
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/css/style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="http://memeja.com/templates/css_theme/mainpg.css" media="screen" />
<?php echo '
<script type="text/javascript">
$(document).ready(function() {
	var count=0;
	var upload_id = \'\';
	$(\'#file_upload\').uploadify({
		\'buttonText\'  : \'Upload Image\',
		\'uploader\'    : \'http://memeja.com/templates/flexyjs/js/uploadify/uploadify.swf\',
		\'script\'      : \'http://memeja.com/flexyadmin/meme/upload_image/ce/0\',
		\'cancelImg\'   : \'http://memeja.com/templates/flexyjs/js/uploadify/cancel.png\',
		\'method\'      : \'POST\',
		\'fileExt\'     : \'*.jpg;*.jpeg;*.png;*.gif;*tif;*.tiff;*.bmp\',
		\'fileDesc\'    : \'Image Files\',
		\'multi\'       : true,
		\'onComplete\'  : function(event, ID, fileObj, response, data){ 
				$("#imgs_id").val($("#imgs_id").val()+response+\',\');
				//alert($("#imgs_id").val($("#imgs_id").val()+response+\',\'));return;
				$(\'#uploadbtn\').hide();
				$(\'#Clearbtn\').hide();
		 },
		\'onAllComplete\'  : function(event, ID, fileObj, response, data) {
				//alert($("#imgs_id").val());
				var url = "http://memeja.com/flexyadmin/meme/imgList/ce/0";
				$.post(url,{ids:$("#imgs_id").val() },function (data){
					$(\'#img_list\').html(data);
				 });
				$("#imgs_id").val("");
		 },
		\'onSelect\'  : function(event, ID, fileObj, response, data){
			    $(\'#img_list\').html("");
				//preview(ID);
				$(\'#uploadbtn\').show();
				$(\'#Clearbtn\').show();
				$.fancybox.resize();
		 },
		\'onCancel\': function () {
				count--;
				if(count==0){
					$(\'#uploadbtn\').hide();
					$(\'#Clearbtn\').hide();
				 }
		 }
	 });
 });
function preview(ID){//
	var url = "http://memeja.com/flexyadmin/meme/preview/ce/0/ID/"+ID;
	$.ajaxFileUpload({
	    url:url,
	    secureuri:false,
	    fileElementId:ID,     
	    dataType: \'json\',
	    complete: function (data, status){
		var img_name=data.responseText;
		alert(img_name);
		var picture = "<img src = \'http://memeja.com/';  echo $this->_tpl_vars['img_path']['preview_thumb'];  echo '"+img_name+"\' height = \'';  echo $this->_tpl_vars['img_path']['thumb_height'];  echo 'px\' width = \'';  echo $this->_tpl_vars['img_path']['thumb_width'];  echo 'px\' />";
		$(\'#getimage\').html(picture);
		$(\'#img_name_span\').html($(\'#server_img\').val(img_name));
		$(\'#get_img_err\').hide();
	     }
	 });
     }
	function check_folder_again(){
	var category = $(\'#category\').val();
		$(\'#file_upload\').uploadifySettings(
		    \'scriptData\', {
			\'category\':category
		     }
		);
	 }
	
	function clear_all(){
		$(\'#uploadbtn\').hide();
		$(\'#Clearbtn\').hide();
	 }
</script>

'; ?>

<div style="width:400px;">
    <input type="hidden" name="imgs_id" id="imgs_id"/>
		<div id="" style="color:rosybrown;font-size:16px">
	<h2><b>Upload Image</b></h2>
   </div>
    <label for="category"><b>Category:</b></label>
	    <select name="categery" id="category">
		<!--<option value="">--Select--</option>-->
		<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sm']['category']), $this);?>

	    </select><br><br></br>
    
	<input id="file_upload" name="file_upload" type="file" />

	<a  href="javascript:$('#file_upload').uploadifyUpload();" id="uploadbtn" style="display:none;" onclick="check_folder_again();">Upload</a>
	<a  href="javascript:$('#file_upload').uploadifyClearQueue();" id="Clearbtn" style="display:none;" onclick="clear_all();">|Clear Queue</a>
	<div id="img_list">
	
	</div>
</div>

<!-- Template: admin/meme/uplodify.tpl.html End --> 