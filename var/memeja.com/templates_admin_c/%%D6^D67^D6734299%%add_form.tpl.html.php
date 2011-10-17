<?php /* Smarty version 2.6.7, created on 2011-09-08 09:15:54
         compiled from admin/cms/add_form.tpl.html */ ?>

<!-- Template: admin/cms/add_form.tpl.html Start 08/09/2011 09:15:54 --> 
 <form  id="cms<?php echo $this->_tpl_vars['sm']['sel_lang']; ?>
" class="fields"  method="post" enctype="multipart/form-data">
	<center> <?php echo $this->_tpl_vars['sm']['message']; ?>
</center>
	<?php if ($this->_tpl_vars['sm']['cms']['id_content']): ?>
		<input type="hidden" class="req_val" name="cms[id_content]" id="id_content" value="<?php echo $this->_tpl_vars['sm']['cms']['id_content']; ?>
" />
	<?php else: ?>
		<input type="hidden"  class="req_val" name="cms[id_content]" id="id_contenta<?php echo $this->_tpl_vars['sm']['sel_lang']; ?>
" value="" />
	<?php endif; ?>
	<input type="hidden"  class="req_val" id="chkval<?php echo $this->_tpl_vars['sm']['sel_lang']; ?>
" value="" />
	<input type="hidden"  class="req_val" name="cms[language]" id="language" value="<?php if ($this->_tpl_vars['sm']['sel_lang']): ?> <?php echo $this->_tpl_vars['sm']['sel_lang'];  else:  echo $this->_tpl_vars['ltype']['English'];  endif; ?>" />
	<fieldset>
	<label for="title_tag">Title:</label>
	<input class="txt req_val" type="text" id="title" name="cms[title]" size="30" value="<?php echo $this->_tpl_vars['sm']['cms']['title']; ?>
" />
	<label for="meta_desc">Meta Description:</label>
	<textarea  class="req_val" rows="3" cols="40" id="meta_description" name="cms[meta_description]"><?php echo $this->_tpl_vars['sm']['cms']['meta_description']; ?>
</textarea>
	<label for="meta_key">Meta Keywords:</label>
	<textarea  class="req_val" rows="3" cols="40" id="meta_keywords" name="cms[meta_keywords]"><?php echo $this->_tpl_vars['sm']['cms']['meta_keywords']; ?>
</textarea>
	<label for="description">Description:</label>
	<textarea name="cms_description" id="<?php if ($this->_tpl_vars['sm']['sel_lang']): ?>description<?php echo $this->_tpl_vars['sm']['sel_lang'];  else: ?>descriptionen<?php endif; ?>" cols="40" rows="5"><?php echo $this->_tpl_vars['sm']['cms']['description']; ?>
</textarea>
	<div class="sep">
		<input class="button" type="button" value="<?php if ($this->_tpl_vars['sm']['cms']['id_content']): ?>Update<?php else: ?>Insert<?php endif; ?>" onclick="insert('<?php echo $this->_tpl_vars['sm']['sel_lang']; ?>
','<?php echo $this->_tpl_vars['sm']['cms']['id_content']; ?>
',this);" />
		<input class="button" type="reset" value="Close" onClick="close_win();"/>
	</div>
	</fieldset>
</form>
<?php echo ' 
<script type="text/javascript">
function insert(fid,cid,obj){
	
	$(\'#disp_msg\').html(\'\');
	var nm=$(\'#tname\').val();
	if($.trim(nm)==\'\'){
		$(\'#name_msg\').html(\'Please enter a name here.\');//blank validation
		return;
	 }
	if($(\'#name_msg\').html()){//validation when a duplicate name is given
		return;
	 }
	$(\'#language\').val($(\'#olddiv\').val());
	var ch,url;
	if(cid){
		ch=\'update\';
	 }else{
		ch=\'insert\';
		$(\'#tname\').attr(\'disabled\',\'disabled\');//for disabling the name while clicking on any language tab
	 }
	var desc_val;

	var desc_val = FCKeditorAPI.GetInstance(\'description\'+fid).GetHTML();
	var keys=$(\'#cms\'+fid+\' .req_val\').serialize();
	var url=\'http://memeja.com/flexyadmin/index.php?\'+keys;
	$.post(url,{"page":"cms","choice":ch,ce:0,"name":nm,"description":desc_val },function(res){
		if(!cid){
			var a=document.getElementById("tab"+fid);
			a.onclick = function(){
				getcontent(fid,res);
			 }		
			$(\'#disp_msg\').html(\'Inserted Successfuly\');//for displaying msg
			$(obj).attr("value","Update");
			obj.onclick = function(){
				insert(fid,res,this);
			 }   //support all browsers
			$("#id_contenta"+fid).val(res);
			$("#chkval"+fid).val(\'downloaded\');
			
		 }else{
			$(\'#disp_msg\').html(\'Updated Successfuly\');//for displaying msg
		 }
	 });
 }
</script>
'; ?>


<!-- Template: admin/cms/add_form.tpl.html End --> 