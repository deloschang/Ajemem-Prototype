<?php /* Smarty version 2.6.7, created on 2011-09-19 23:43:23
         compiled from admin/setting/dev_add.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/setting/dev_add.tpl.html', 19, false),)), $this); ?>

<!-- Template: admin/setting/dev_add.tpl.html Start 19/09/2011 23:43:23 --> 
 <div class="box box-50 altbox">
    <div class="boxin">
        <div class="header"> 
            <h3><?php if ($this->_tpl_vars['sm']['res']['id_config']): ?>Edit<?php else: ?>Add<?php endif; ?> Config<?php if ($this->_tpl_vars['sm']['add_section']): ?> For <?php echo $this->_tpl_vars['sm']['section']['name'];  endif; ?></h3>
        </div>
        <form id="addconfigform" name="addconfigform" action="javascript:void(0);" onSubmit="return validate_add();" method="post" class="basic">
		<input type="hidden" name="id_config" id="id_config" value="<?php echo $this->_tpl_vars['sm']['res']['id_config']; ?>
" />
            <div class="inner-form" align="left">
            <dl>
                <dt><label for="some1">Section :</label></dt>
                <dd id="dd">                                          
			<?php if ($this->_tpl_vars['sm']['add_section']): ?>
				<input type="hidden" class="text" name="sec[name]" id="id_section" value="<?php echo $this->_tpl_vars['sm']['section']['name']; ?>
" /><?php echo $this->_tpl_vars['sm']['section']['name']; ?>

			<?php else: ?>
				<select class="txt" name="sec[name]" id="id_section" onchange="setNew(this);" >  
					<option value="">--Section--</option>
					<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sm']['section'],'selected' => $this->_tpl_vars['sm']['res']['name']), $this);?>

					<option value="n">New</option>
				</select> 
			<?php endif; ?>
                </dd>
                <dt><label for="sec[ckey]">Section Key :</label></dt><!-- .ttop for vertical-align: top -->
                <dd><input class="txt" type="text" id="id_key" name="sec[ckey]" value="<?php echo $this->_tpl_vars['sm']['res']['ckey']; ?>
" />
                <lable id="id_err" style="display:none" class="error">Please enter another key value</label>
                </dd>
		<dt><label for="sec[f_type]">Field Type :</label></dt>
                <dd>
			<select class="txt" name="sec[f_type]" id="f_type" onchange="fieldValue(this);">
				<?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['sm']['f_type'],'selected' => $this->_tpl_vars['sm']['res']['f_type']), $this);?>

                    	</select>
		</dd>
		<div id="div_f_key" <?php if (! $this->_tpl_vars['sm']['res']['id_config'] || $this->_tpl_vars['sm']['res']['f_type'] == 'text'): ?>style="display:none"<?php endif; ?>>
			<dt></dt>
			<dd><font size=-1 color="red">[Use "," as separator in field key e.g, 0,1]</font></dd>
			<dt><label for="sec[f_key]">Field Key :</label></dt>
			<dd><input class="txt" type="text" id="f_key" name="sec[f_key]" value="<?php echo $this->_tpl_vars['sm']['res']['f_key']; ?>
" /></dd>
			<dt></dt>
			<dd><font size=-1 color="red">[Use "," as separator in field value e.g, false,true]</font></dd>
			<dt><label for="sec[f_value]">Field Value :</label></dt>
			<dd><input class="txt" type="text" id="f_value" name="sec[f_value]" value="<?php echo $this->_tpl_vars['sm']['res']['f_value']; ?>
" /></dd>
			<dt></dt>
			<dd><font size=-1 color="red">[Section value must be one or more(for check box must be in comma separated) of the value of Field Key]</font></dd>
		</div>
                <dt><label for="sec[value]">Section Value :</label></dt>
                <dd><input class="txt" type="text" id="id_value" name="sec[value]" value="<?php echo $this->_tpl_vars['sm']['res']['value']; ?>
" /></dd>
		<dt><label for="sec[comment]">Comment :</label></dt>
                <dd><textarea name="sec[comment]" id="id_comment"><?php echo $this->_tpl_vars['sm']['res']['comment']; ?>
</textarea></dd>
                <dt></dt>	<dd><input type="checkbox" class="txt" id="id_edit" name="sec[is_editable]" <?php if ($this->_tpl_vars['sm']['res']['is_editable'] == 1): ?>checked="true"<?php endif; ?> />Allow admin to edit</dd>
                <dt></dt>
                <dd><input class="button altbutton" type="submit" value=<?php if (! $this->_tpl_vars['sm']['res']['id_config']): ?>"Add"<?php else: ?>Edit<?php endif; ?> /></dd>
                
            </dl>
            </div>
        </form>
    </div>
</div>
<?php echo '
<script type="text/javascript">
	function setNew(obj){
		if(obj.value==\'n\'){
			$(\'#id_section\').attr(\'name\',\'secname\')
			$(\'#id_section\').after(\'<input class="txt" type="text" id="id_sectxt" name="sec[name]" >\');
		 }else{
			if($(\'#dd\').find(\'input\').length){
				$(\'#id_section\').attr(\'name\',\'sec[name]\');
				$(\'#id_sectxt\').remove();
				$(\'#dd\').find(\'label\').remove();
			 }
		 }
	 }

	function fieldValue(obj){
		//alert(obj.value);return;
		if(obj.value!=\'text\'){
			$(\'#div_f_key\').show();
		 }else{
			$(\'#div_f_key\').hide();
		 }
	 }

	function validate_add(url){
		var validator=$("#addconfigform").validate({
			rules: {
				"sec[name]":{
					required:true
				 },
				"sec[ckey]":{
					required:true
				 },
				"sec[f_key]":{
					required:function(element) {
						v2=$("#f_type").val();
						return (v2!="text");
		  			  }
				 },
				"sec[f_value]":{
					required:function(element) {
						v2=$("#f_type").val();
						return (v2!="text");
		  			  }
				 },		
				"sec[value]":{
					required:true
				 }
			 }
			 });
		var x=validator.form();
		if(x){ 
			//document.addconfigform.reset();return ;
			var name=\'\';
			if($(\'#dd\').find(\'input\').length){
				if($(\'#dd\').find("input[id=\'id_sectxt\']").length)
					name = $(\'#id_sectxt\').val();
				else
					name = name=$(\'#id_section\').val();
			 }else
				name=$(\'#id_section\').val();

			var ckey=$(\'#id_key\').val();
			var field_type=$(\'#f_type\').val();
			var field_key = \'\';
			var field_value = \'\';
			if($(\'#f_key\').val()) {
				field_key=$(\'#f_key\').val();
			 }
			if($(\'#f_key\').val()) {
				field_value=$(\'#f_value\').val();
			 }
			var sec_value=$(\'#id_value\').val();
			var comment=$(\'#id_comment\').val();
			if($(\'#id_edit\').is(\':checked\')){
				var edit=1;
			 }else{
				var edit=0;
			 }
			var id=\'\';
			var url=\'http://memeja.com/flexyadmin/setting/set_config/ce/0\';
			if($(\'#id_config\').val()) {
				id = $(\'#id_config\').val();
				url=\'http://memeja.com/flexyadmin/setting/edit_config/ce/0\';
			 }
			$.post(url,{"id_config":id, "sec[name]":name, "sec[ckey]":ckey,"sec[f_type]":field_type,"sec[f_key]":field_key,"sec[f_value]":field_value,"sec[value]":sec_value,"sec[comment]":comment,"sec[is_editable]":edit }, function(res){
				//alert(res);return;
				if(res==\'no\'){
					$("#id_err").show();
					$(\'#id_key\').val(\'\');
					$(\'#id_key\').focus();
				 }else{
					window.location.href=res;
					//$("#addconfigform").reset();
				 }
			 });
		 }else{
			return false;
		 }
	 }
</script>
'; ?>


<!-- Template: admin/setting/dev_add.tpl.html End --> 