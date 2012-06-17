<?php /* Smarty version 2.6.7, created on 2011-09-19 23:45:20
         compiled from admin/setting/dev_listing.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'explode', 'admin/setting/dev_listing.tpl.html', 63, false),array('modifier', 'cat', 'admin/setting/dev_listing.tpl.html', 65, false),array('function', 'html_radios', 'admin/setting/dev_listing.tpl.html', 67, false),array('function', 'html_checkboxes', 'admin/setting/dev_listing.tpl.html', 70, false),array('function', 'html_options', 'admin/setting/dev_listing.tpl.html', 73, false),)), $this); ?>

<!-- Template: admin/setting/dev_listing.tpl.html Start 19/09/2011 23:45:20 --> 
 <script type="text/javascript" src="http://memeja.com/libsext/js/reorder.js"></script>
<script type="text/javascript" src="http://memeja.com/libsext/js/table_dnd.js"></script>

<?php echo '
<style type="text/css">
.class1{
	background:#3366FF;
 }
.showDragHandle{	
	background:#FF0000;
	cursor:move;
 }
.altbox .content table tr.even td {background: #fff; }

</style>
'; ?>

<?php if ($this->_tpl_vars['sm']['res']): ?>
    <div class="box box-75 altbox"> 
        <div class="boxin">
            <div class="header">
            	<h3>Config Settings</h3><input id="collapse" type="button" class="button" value="Expand All"/>
                <?php ob_start(); ?>
                    <a class="button" href="javascript:void(0);" onclick="addNew('http://memeja.com/flexyadmin/setting/add/ce/0');">Add new</a>
                    <span id="chk_unchk"><a class="button" href="javascript:void(0);" onclick="checkAll(1);">Check All</a></span>
                    <!--<a class="button" href="javascript:void(0);" onclick="checkAll(0);">Uncheck All</a>-->
                    <a class="button" href="javascript:void(0);" onclick="deleteKey('http://memeja.com/flexyadmin/setting/delete_config/ce/0');">Delete</a>
                 <?php $this->_smarty_vars['capture']['links'] = ob_get_contents(); ob_end_clean(); ?>
                 <?php echo $this->_smarty_vars['capture']['links']; ?>

            </div>
            <div style="margin-bottom:10px;">
                <?php unset($this->_sections['setting']);
$this->_sections['setting']['name'] = 'setting';
$this->_sections['setting']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['setting']['show'] = true;
$this->_sections['setting']['max'] = $this->_sections['setting']['loop'];
$this->_sections['setting']['step'] = 1;
$this->_sections['setting']['start'] = $this->_sections['setting']['step'] > 0 ? 0 : $this->_sections['setting']['loop']-1;
if ($this->_sections['setting']['show']) {
    $this->_sections['setting']['total'] = $this->_sections['setting']['loop'];
    if ($this->_sections['setting']['total'] == 0)
        $this->_sections['setting']['show'] = false;
} else
    $this->_sections['setting']['total'] = 0;
if ($this->_sections['setting']['show']):

            for ($this->_sections['setting']['index'] = $this->_sections['setting']['start'], $this->_sections['setting']['iteration'] = 1;
                 $this->_sections['setting']['iteration'] <= $this->_sections['setting']['total'];
                 $this->_sections['setting']['index'] += $this->_sections['setting']['step'], $this->_sections['setting']['iteration']++):
$this->_sections['setting']['rownum'] = $this->_sections['setting']['iteration'];
$this->_sections['setting']['index_prev'] = $this->_sections['setting']['index'] - $this->_sections['setting']['step'];
$this->_sections['setting']['index_next'] = $this->_sections['setting']['index'] + $this->_sections['setting']['step'];
$this->_sections['setting']['first']      = ($this->_sections['setting']['iteration'] == 1);
$this->_sections['setting']['last']       = ($this->_sections['setting']['iteration'] == $this->_sections['setting']['total']);
?>
                <?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['setting']['index']]); ?>
                <?php if ($this->_tpl_vars['sm']['res'][$this->_sections['setting']['index_prev']]['name'] != $this->_tpl_vars['x']['name']): ?>
                   <div class="div_head">
			<div class="fl"><b class="sign" style="font-size:16px; margin-left:5px">+</b></div>
			<div class="fl"><b>&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['x']['name']; ?>
</b></div>			
		</div>
                   <div class="content table_margin" style="display:none">
		<!--<form action="http://memeja.com/flexyadmin/page-setting-choice-update_config" name="setting_<?php echo $this->_tpl_vars['x']['name']; ?>
" method="post">-->			
    <?php echo '
        <script type="text/javascript">
        $(document).ready(function(){
            var curl=\'http://memeja.com/flexyadmin/setting/reorder?tab=\';
            '; ?>

            new callreorder("tab<?php echo $this->_tpl_vars['x']['name']; ?>
","dragHandle",curl,"showDragHandle","class1");
            <?php echo '
         });
        </script>
    '; ?>

			<div class="fr" style="margin-top:10px;margin-right:5px">
				<a href="javascript:void(0);" onclick="addNew('http://memeja.com/flexyadmin/setting/add/id_config/<?php echo $this->_tpl_vars['x']['id_config']; ?>
/ce/0');">Add new</a>
			</div>
                        <form action="javascript:void(0);" id="setting_<?php echo $this->_tpl_vars['x']['name']; ?>
" name="setting_<?php echo $this->_tpl_vars['x']['name']; ?>
" method="post" onsubmit="updateConfig('http://memeja.com/flexyadmin/setting/update_config','<?php echo $this->_tpl_vars['x']['name']; ?>
')">
                        <input type="hidden" name="sectype" value="<?php echo $this->_tpl_vars['x']['name']; ?>
" />
                            <table align="center" id="tab<?php echo $this->_tpl_vars['x']['name']; ?>
">
                                <?php endif; ?>
                                <tr class="nodrag" id=<?php echo $this->_tpl_vars['x']['id_config']; ?>
>
                                    <td class="dragHandle"></td>
                                    <td width="100px" class="ttop"><input type="checkbox" value="<?php echo $this->_tpl_vars['x']['id_config']; ?>
" class="chkbox" id="id_chk<?php echo $this->_tpl_vars['x']['id_config']; ?>
" />&nbsp;<a href="javascript:void(0);" onclick="edit_config_key('<?php echo $this->_tpl_vars['x']['id_config']; ?>
');"><?php echo $this->_tpl_vars['x']['ckey']; ?>
</a></td>
                                    <td  class="ttop"> 	<!--input type="hidden" name="<?php echo $this->_tpl_vars['x']['name']; ?>
[<?php echo $this->_tpl_vars['x']['ckey']; ?>
][<?php echo $this->_tpl_vars['x']['id_config']; ?>
]" value="<?php echo $this->_tpl_vars['x']['id_config']; ?>
"/> -->
                                    <?php $this->assign('f_key', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['x']['f_key']) : explode($_tmp, $this->_tpl_vars['x']['f_key']))); ?>
                                    <?php $this->assign('f_value', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['x']['f_value']) : explode($_tmp, $this->_tpl_vars['x']['f_value']))); ?>
                                    <?php $this->assign('name_field', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['x']['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, '[') : smarty_modifier_cat($_tmp, '[')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['x']['id_config']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['x']['id_config'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ']') : smarty_modifier_cat($_tmp, ']')))) ? $this->_run_mod_handler('cat', true, $_tmp, '[') : smarty_modifier_cat($_tmp, '[')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['x']['id_config']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['x']['id_config'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ']') : smarty_modifier_cat($_tmp, ']'))); ?>
                                    <?php if ($this->_tpl_vars['x']['f_type'] == 'radio'): ?>
                                    <?php echo smarty_function_html_radios(array('name' => $this->_tpl_vars['name_field'],'values' => $this->_tpl_vars['f_key'],'output' => $this->_tpl_vars['f_value'],'selected' => $this->_tpl_vars['x']['value']), $this);?>

                                    <?php elseif ($this->_tpl_vars['x']['f_type'] == 'checkbox'): ?>
                                    <?php $this->assign('x_value', ((is_array($_tmp=",")) ? $this->_run_mod_handler('explode', true, $_tmp, $this->_tpl_vars['x']['value']) : explode($_tmp, $this->_tpl_vars['x']['value']))); ?>
                                    <?php echo smarty_function_html_checkboxes(array('name' => $this->_tpl_vars['name_field'],'values' => $this->_tpl_vars['f_key'],'output' => $this->_tpl_vars['f_value'],'selected' => $this->_tpl_vars['x_value']), $this);?>

                                    <?php elseif ($this->_tpl_vars['x']['f_type'] == 'dropdown'): ?>							
                                    <select name="<?php echo $this->_tpl_vars['name_field']; ?>
">
                                    <?php echo smarty_function_html_options(array('values' => $this->_tpl_vars['f_key'],'output' => $this->_tpl_vars['f_value'],'selected' => $this->_tpl_vars['x']['value']), $this);?>

                                    </select>
                                    <?php else: ?>
                                    <input type="text" name="<?php echo $this->_tpl_vars['name_field']; ?>
" value="<?php echo $this->_tpl_vars['x']['value']; ?>
" />
                                    <?php endif; ?>
                                    </td>
                                    <td><textarea name="<?php echo $this->_tpl_vars['x']['name']; ?>
[<?php echo $this->_tpl_vars['x']['id_config']; ?>
][comment]" style="background:none; width:300px"><?php echo $this->_tpl_vars['x']['comment']; ?>
</textarea></td>
                                </tr>
                                <?php if ($this->_tpl_vars['sm']['res'][$this->_sections['setting']['index_next']]['name'] != $this->_tpl_vars['x']['name']): ?>
                                    <tr>
                                        <td colspan="3" class="tr">
                                        <input class="button" type="submit" value="Update" name="submit" />
                                        </td>
                                    </tr>
                           </table>
                       </form>
                   </div>
                <?php endif; ?>   	
                <?php endfor; endif; ?>
            </div>    
            <div class="header">
             <?php echo $this->_smarty_vars['capture']['links']; ?>

            </div>
        </div>
    </div>
<?php else: ?>
	<center><b>No records found</b></center>
<?php endif;  echo '
<script type="text/javascript">
	function addNew(url){
		$.fancybox.showActivity();
		$.post(url,function(response){
			//$.fancybox(response,{centerOnScroll:true,hideOnOverlayClick:false });
			show_fancybox(response);
		 });
	 }
	function updateConfig(url,id){
		var fval=$("#setting_"+id).serialize();
		url+="/ce/0?"+fval; 
		$.post(url,function(response){
			showmsg(\'\',"Successfully Updated");//showmsg(\'divid\',\'error message\');
			if(id=="ADMIN_THEME")
				window.location.href=response;
		 });
	 }
	function checkAll(c){
		$(\'.chkbox\').each(function(){
			if(c){
				$(this).attr(\'checked\',\'checked\');
				$("#chk_unchk").html(\'<a class="button" href="javascript:void(0);" onclick="checkAll(0);">Uncheck All</a>\');
			 }else{
				$(this).removeAttr(\'checked\');
				$("#chk_unchk").html(\'<a class="button" href="javascript:void(0);" onclick="checkAll(1);">Check All</a>\');
			 }
		 });
		var txt=$(\'#collapse\').attr(\'value\');
		if(txt==\'Expand All\'){
			$(\'.table_margin\').slideDown(1000);
			$(\'#collapse\').attr(\'value\',\'Collapse All\');
			$(\'.sign\').html(\'-\');	
		 }else if(txt==\'Collapse All\' && !c){
			$(\'.table_margin\').slideUp(1000);
			$(\'#collapse\').attr(\'value\',\'Expand All\');
			$(\'.sign\').html(\'+\');		
		 }
	 }
	function deleteKey(url){
		var keys=\'\';
		$(\'.chkbox\').each(function(){
			if($(this).is(\':checked\'))
				keys +=$(this).val()+",";
		 });
		if(!keys){
			alert("Please choose records to delete.");
			return false;
		 }else{
			var c=confirm("Are you sure to delete checked records ?");
			if(!c)
				return false;
		 }
		$.post(url,{\'keys\':keys }, function(res){
			window.location.href=res;
		 });
	 }

	function edit_config_key(id_config) {
		var url = "http://memeja.com/flexyadmin/index.php";
		$.fancybox.showActivity();
		$.post(url,{"page":"setting","choice":"edit",ce:0,id_config:id_config },function(res){
			//$.fancybox(res);
			show_fancybox(res);
		 });
	 }
	$(\'.div_head\').click(function(){
		var txt=$(\'.sign\',this).html();
		if(txt==\'-\'){
			$(this).next(\'.table_margin\').slideUp(\'slow\');
			$(\'.sign\',this).html(\'+\');
			$(\'#collapse\').attr(\'value\',\'Expand All\');
		 }else if(txt==\'+\'){
			$(this).next(\'.table_margin\').slideDown(\'slow\');
			$(\'.sign\',this).html(\'-\');
			$(\'#collapse\').attr(\'value\',\'Collapse All\');
		 }
	 });

	$(\'#collapse\').click(function(){
		var txt=$(\'#collapse\').attr(\'value\');
		if(txt==\'Collapse All\'){
			$(\'.table_margin\').slideUp(1000);
			$(\'#collapse\').attr(\'value\',\'Expand All\');
			$(\'.sign\').html(\'+\');

		  }else if(txt==\'Expand All\'){
			$(\'.table_margin\').slideDown(1000);
			$(\'#collapse\').attr(\'value\',\'Collapse All\');
			$(\'.sign\').html(\'-\');	
		  }
	 });

</script> 
'; ?>


<!-- Template: admin/setting/dev_listing.tpl.html End --> 