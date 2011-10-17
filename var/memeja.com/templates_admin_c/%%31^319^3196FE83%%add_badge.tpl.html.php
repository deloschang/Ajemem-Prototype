<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:30
         compiled from admin/achievements/add_badge.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/achievements/add_badge.tpl.html', 163, false),)), $this); ?>

<!-- Template: admin/achievements/add_badge.tpl.html Start 19/09/2011 23:57:30 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div id="regdiv">
<?php echo '
<script type="text/javascript">
    var  validator1;var flag="";
	function validate_badge(id){//alert(id)
	validator1 = $(\'#form1\').validate(
	    {
		rules:{
		    \'form[title_badge]\':{
			    required:true
		     },
		    \'form[desc_badge]\':{
			    required:true
		     },
		    \'hid_image\':{
			    required:true,
			    accept: "png|jpe?g"
		     },
		    \'form[badge_type_number]\':{
			    required:true,
			    number:true
		     },
		    \'form[glory_badge_point]\':{
			    required:true,
			    number:true
		     }
		 },messages:{
		    \'form[title_badge]\':{
			    required:flexymsg.required
		     },
		    \'form[desc_badge]\':{
			     required:flexymsg.required
		     },
		    \'hid_image\':{
			    required:flexymsg.required,
			    accept :"Only jpeg, jpg or png images"
		     },
		    \'form[badge_type_number]\':{
			    required:flexymsg.required,
			    number:flexymsg.number
		     },
		    \'form[glory_badge_point]\':{
			    required:flexymsg.required,
			    number:flexymsg.number
		     }
		 }
	     });var x = validator1.form();
	    if(x){
		var y=validate_badge_number(id);
		 }
	  } 	
		function validate_badge_number(id){
				var flag1=""; 
				var badge_type=$(\'#badge_type\').val();
				var badge_type_number=$("#badge_type_number").val();
				var image=$("#image1").val();
				//alert(badge_type);
				//alert(badge_type_number);
				//alert(image);
				var url = "http://memeja.com/flexyadmin/achievements/validate_badge_no";
				$.post(url,{"badge_type":badge_type,"badge_type_number":badge_type_number,\'image\':image,\'id_badge\':id,ce:0 },function(res){
					//alert("hiiiiii");
					//alert(res.length);
					if(res.length ==0)
						document.form1.submit();
					else{ 
						alert("change either badge_type or badge_type_number");
					 }
				 },\'json\');
		 }
	  
	var mid;
	function show_image(mid){
		id=mid;
		mid=mid;
		if(mid==1)
			var im=$(\'#image\'+mid).val();
		else
			var im=$(\'#hid_image\'+1).val();
		//alert(im);
		if(im){
		    //var y=check_ext();
		    //if(y){
			ch=\'preview\';
			var url="http://memeja.com/flexyadmin/achievements/"+ch+"/ce/0/mid/"+mid;
			$.ajaxFileUpload({
				url : url,
				secureuri:false,
				fileElementId:\'image\'+mid,
				dataType: \'json\',
				complete: function (data, status){
					z = data.responseText;
					z1=z.split(\':\');
					var img="<dt class=\'tl\'><label>Selected Image</label></dt><dd class=\'tl\'><img src=\'http://memeja.com/preview/thumb/"+z1[0]+"\'></dd>";
					$(\'#prev_img1\').val(z1[0]);
					$(\'#hid_image\').val(z1[0]);
					$(\'#r\'+id).html(img);
				 }
			 });
		    // }
		 }			
	 }
</script>
'; ?>

<div class="box box-50 altbox">
    <div class="boxin">
    <div class="header"><h3><center><?php if ($this->_tpl_vars['sm']['res']):  if ($this->_tpl_vars['sm']['opt']): ?>Edit glory badge<?php else: ?> Edit badge<?php endif;  else: ?>Add a badge<?php endif; ?></center> </h3></div>
	<form name="form1" id="form1" method="post" action="<?php if ($this->_tpl_vars['sm']['res']): ?>http://memeja.com/flexyadmin/achievements/update_badge/id/<?php echo $this->_tpl_vars['sm']['res']['id_badge']; ?>
/opt/<?php if ($this->_tpl_vars['sm']['opt']):  echo $this->_tpl_vars['sm']['opt'];  endif;  else: ?>http://memeja.com/flexyadmin/achievements/insert_badge/opt/<?php if ($this->_tpl_vars['sm']['opt']):  echo $this->_tpl_vars['sm']['opt'];  endif;  endif; ?>" >
		<table style="border:1px;border-color:cyan">
		    <tr>
			<td>Title</td>
			<td><input type="text" name="form[title_badge]" value="<?php echo $this->_tpl_vars['sm']['res']['title_badge']; ?>
"/></td>
		    </tr>
		    <tr>
			<td style="vertical-align: middle;">Description</td>
			<td><textarea name="form[desc_badge]" rows=5 cols=40 value="<?php echo $this->_tpl_vars['sm']['res']['desc_badge']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['desc_badge']; ?>
</textarea></td>
		    </tr>
		    <tr>
			<?php if ($this->_tpl_vars['sm']['res']): ?>	
			<td>Uploaded image</td>
			<td>
			    <div id="divTxt">
			    <input type="hidden" name="hid_image" id="hid_image" value=<?php echo $this->_tpl_vars['sm']['res']['image_badge']; ?>
 />
			    <p id='row1'>
			    <input type="file" name="image" id="image1" class="imageclass" onchange="show_image(1);" /> 
			    <input type="hidden" name="prev_img" id="prev_img1" value="" class="imageclass1"/>
			    <div id="r1"><img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['sm']['res']['id_badge']; ?>
_<?php echo $this->_tpl_vars['sm']['res']['image_badge']; ?>
" height="70px" width="70px" /></div>
			    </p>
			    </div>
			</td>
			<?php else: ?>
			<td>Upload image</td>
			<td>
			    <div id="divTxt">
			    <input type="hidden" name="hid_image" id="hid_image" value=<?php echo $this->_tpl_vars['sm']['res']['image_badge']; ?>
 />
			    <p id='row1'>
			    <input type="file" name="image" id="image1" class="imageclass" onchange="show_image(1);" /> 
			    <input type="hidden" name="prev_img" id="prev_img1" value="" class="imageclass1"/>
			    <span id="r1"></span>
			    </p>
			    </div>
			</td>
			<?php endif; ?>
		    </tr>
		    <tr>
			<?php if ($this->_tpl_vars['sm']['opt']): ?>	
			<td>Glory badge point</td>
			<td>
			    <input type="text" size="5" id="glory_badge_point"name="form[glory_badge_point]" value="<?php echo $this->_tpl_vars['sm']['res']['glory_badge_point']; ?>
" />
			</td>

			<?php else: ?>
			<td>Badge for</td>
			<td>
			    <table>
				<tr>
				    <td>
					<select name="form[badge_type]" id="badge_type">
						<option>--select--</option>
						<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sm']['btype'],'selected' => $this->_tpl_vars['sm']['sbtype']), $this);?>

					</select>
				    </td>
				</tr>
				<tr>
				    <td>Enter a number
				    <input type="text" size="5" id="badge_type_number"name="form[badge_type_number]" value="<?php echo $this->_tpl_vars['sm']['res']['badge_type_number']; ?>
" />
				    </td>
				</tr>
			    </table>
			</td>
			<?php endif; ?>	
		    </tr><br/>
		    <tr>
			<td></td>
			<td style="text-align: center;"><input type="button" name="sub"  id="btn" value="<?php if ($this->_tpl_vars['sm']['res']):  if ($this->_tpl_vars['sm']['err']): ?>Submit<?php else: ?>Update<?php endif;  else: ?>Submit<?php endif; ?>" onClick="validate_badge(<?php echo $this->_tpl_vars['sm']['res']['id_badge']; ?>
);" class="btn"/></td>
		    </tr>
		</table>
	</form>
    </div>
</div>

<!-- Template: admin/achievements/add_badge.tpl.html End --> 