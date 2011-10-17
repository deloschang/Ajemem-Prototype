<?php /* Smarty version 2.6.7, created on 2011-09-08 09:15:54
         compiled from admin/cms/add.tpl.html */ ?>

<!-- Template: admin/cms/add.tpl.html Start 08/09/2011 09:15:54 --> 
 <?php $this->assign('ltype', $this->_tpl_vars['util']->get_values_from_config('LANGUAGE'));  echo '
<script type="text/javascript" language="javascript">
$(document).ready(function() {
	var oFCKeditor = new FCKeditor(\'descriptionen\')
	oFCKeditor.BasePath =\'/libsext/fckeditor/\';
	oFCKeditor.Width = \'90%\';
	oFCKeditor.Height = \'350px\';
	oFCKeditor.Config["SkinPath"]=  oFCKeditor.BasePath + \'editor/skins/office2003/\';
	oFCKeditor.ReplaceTextarea();
	var sel="';  echo $this->_tpl_vars['sm']['cms']['language'];  echo '";
	if(!sel)
		sel="';  echo $this->_tpl_vars['ltype']['English'];  echo '";
	$(\'#tab\'+sel).addClass(\'active\');
//alert("';  echo $this->_tpl_vars['sm']['cms']['language'];  echo '");
  });
function close_win(){
	var url = "http://memeja.com/flexyadmin/cms/list";
	window.location.href=url;
 }

function getcontent(id,act){
	$(\'#disp_msg\').html(\'\');
	$(\'#tab\'+id).addClass(\'active\');
	$(\'#plang\').val(id);
	get_permalink(id);
	$(\'#prev_val\').val($(\'#olddiv\').val());
	$("#tab"+$(\'#prev_val\').val()).removeClass(\'active\');
	if(!act){
		var hid=$(\'#olddiv\').val();
		$("#cms_"+hid).hide();
		if($(\'#chkval\'+id).val()){
			$("#cms_"+$(\'#prev_val\').val()).hide();
			$("#cms_"+id).show(1000);
			$(\'#olddiv\').val(id);
			return ;
		 }
		var url="http://memeja.com/flexyadmin/";
		var oEditor = FCKeditorAPI.GetInstance(\'description\'+id);
		if(typeof(oEditor)!=\'undefined\')
			delete FCKeditorAPI.__Instances[\'description\'+id];
		$.post(url,{"page":"cms","choice":"add",ce:0,"chk":1,"language":id },function(res){
			$("#cms_"+$(\'#prev_val\').val()).hide();
			$("#cms_"+id).html(res).show(1000);
			$(\'#olddiv\').val(id)	;
			var oFCKeditor = new FCKeditor(\'description\'+id)
			oFCKeditor.BasePath =\'/libsext/fckeditor/\';
			oFCKeditor.Width = \'90%\';
			oFCKeditor.Height = \'350px\';
			oFCKeditor.Config["SkinPath"]=  oFCKeditor.BasePath + \'editor/skins/office2003/\'
			oFCKeditor.ReplaceTextarea();
			$(\'#chkval\'+id).val(\'downloaded\');
		 });
	 }else{
		//code goes for post method
		var hid=$(\'#olddiv\').val();
		var code=$(\'#code\').val();
		$("#cms_"+id).hide();
		if($(\'#chkval\'+id).val()){
			$("#cms_"+$(\'#prev_val\').val()).hide();
			$("#cms_"+id).show(1000);
			$(\'#olddiv\').val(id);
			return ;
		 }
		var oEditor = FCKeditorAPI.GetInstance(\'description\'+id);
		if(typeof(oEditor)!=\'undefined\')
			delete FCKeditorAPI.__Instances[\'description\'+id];
		var url="http://memeja.com/flexyadmin/";
		$.post(url,{"page":"cms","choice":"edit",ce:0,"chk":1,"language":id,"code":code },function(res){
			$("#cms_"+$(\'#prev_val\').val()).hide();
			$("#cms_"+id).html(res).show(1000);
			$(\'#olddiv\').val(id);
			var oFCKeditor = new FCKeditor(\'description\'+id)
			oFCKeditor.BasePath =\'/libsext/fckeditor/\';
			oFCKeditor.Width = \'90%\';
			oFCKeditor.Height = \'350px\';
			oFCKeditor.Config["SkinPath"]=  oFCKeditor.BasePath + \'editor/skins/office2003/\'
			oFCKeditor.ReplaceTextarea();
			$(\'#chkval\'+id).val(\'downloaded\');
		 });
	 }
 }
function get_permalink(){
	var ln= $(\'#plang\').val();
	var tname = $(\'#tname\').val();
	if(tname) {
		var url = \'http://memeja.com/flexyadmin/\';
		$.post(url,{"page":"cms","choice":"get_plink",tname:tname,ce:0 },function(res){
			res = \'http://memeja.com/cms/show/code/\'+res;
			$(\'#permalink\').val(res);
		 });
	 }
 }

//Check for duplicate name
function chk_dup(){
	var ln= $(\'#plang\').val();
	var tname = $(\'#tname\').val();
	if(tname) {
		var url = \'http://memeja.com/flexyadmin/\';
		$.post(url,{"page":"cms","choice":"check_duplicate",tname:tname,ce:0 },function(res){
			if(res==\'1\'){
				$(\'#name_msg\').html(\'Duplicate name.Please enter another\');
			 }
		 });
	 }
 }
function clear_div(){
	$(\'#name_msg\').html(\'\');
 }
</script>
'; ?>

        <div class="box box-100 altbox">
            <div class="boxin">
                <div class="header">
                    <h3><?php if ($this->_tpl_vars['sm']['cms']['id_content']): ?>Edit<?php else: ?>Add<?php endif; ?> Contents</h3>
                </div>
                <input type="hidden" id="prev_val" />
                <input type="hidden" id="code" value="<?php echo $this->_tpl_vars['sm']['code']; ?>
" />
                <input type="hidden" name="plang" id="plang" value="<?php echo $this->_tpl_vars['ltype']['English']; ?>
" />
                <form class="fields">
                <fieldset>
                	<label for="name">Name:</label>
                <input class="txt" type="text" id="tname" name="cms[tname]" size="30" value="<?php echo $this->_tpl_vars['sm']['cms']['name']; ?>
" onblur="get_permalink();chk_dup();" <?php if ($this->_tpl_vars['sm']['cms']['name']): ?>disabled="disabled"<?php endif; ?> onfocus="clear_div();"/>
                	<div id="name_msg" class="error"></div>
                	<label for="permalink">Permalink:</label>
                	<input class="txt" type="text" id="permalink" name="cms[permalink]" size="90" value="<?php if ($this->_tpl_vars['sm']['cms']['cmscode']): ?>http://memeja.com/cms/show/code/<?php echo $this->_tpl_vars['sm']['cms']['cmscode'];  endif; ?>" readonly="readonly"  />

                </fieldset>
                </form>



            </div>
        </div>
<div id="disp_msg" class="error"></div>
        <div class="box box-100 altbox">
            <div class="boxin">
                <div class="header" id="language_type">
                <h3>&nbsp;</h3>
                    <ul class="tabs">
                        <?php if (count($_from = (array)$this->_tpl_vars['sm']['language'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if (! $this->_tpl_vars['sm']['langres'][$this->_tpl_vars['key']]): ?>
                                <li><a href="javascript:void(0)" id="tab<?php echo $this->_tpl_vars['item']; ?>
" onclick="getcontent('<?php echo $this->_tpl_vars['item']; ?>
','');"><?php echo $this->_tpl_vars['key']; ?>
</a></li>
                            <?php else: ?>
                                <li><a href="javascript:void(0)" id="tab<?php echo $this->_tpl_vars['item']; ?>
" onclick="getcontent('<?php echo $this->_tpl_vars['item']; ?>
','<?php echo $this->_tpl_vars['sm']['langres'][$this->_tpl_vars['key']]; ?>
');"><?php echo $this->_tpl_vars['key']; ?>
</a></li>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </ul>
                </div>

<input type="hidden" name="olddiv" value="<?php echo $this->_tpl_vars['sm']['language']['English']; ?>
" id="olddiv" />
<?php $this->_foreach['langname'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['language']), 'iteration' => 0);
if ($this->_foreach['langname']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['langname']['iteration']++;
 $this->assign('itrn', $this->_foreach['langname']['iteration']); ?>
	<div id="cms_<?php echo $this->_tpl_vars['item']; ?>
" <?php if (! ($this->_foreach['langname']['iteration'] <= 1)): ?> style="display:none" <?php endif; ?>>
    <?php if (($this->_foreach['langname']['iteration'] <= 1)):  $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin/cms/add_form.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
  endif; ?></div>
<?php endforeach; endif; unset($_from); ?>
          </div>
        </div>

<!-- Template: admin/cms/add.tpl.html End --> 