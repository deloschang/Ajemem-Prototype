<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-08 09:14:39
         compiled from admin/manage/show_glory.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/manage/show_glory.tpl.html', 63, false),)), $this); ?>

<!-- Template: admin/manage/show_glory.tpl.html Start 08/09/2011 09:14:39 --> 
 
<?php $this->assign('gen', $this->_tpl_vars['util']->get_values_from_config('GLORY_CATEGORY'));  echo '
<script type="text/javascript">
function edit_glory(id){
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/edit_glory",{\'id\':id,ce:0 },function(res){
		$.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				window.location="http://memeja.com/flexyadmin/manage/list_glory";
			 }
		     });
	 });
 }
function add_glory(){
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"manage","choice":"add_glory",ce:0 },function(res){
		  $.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				window.location="http://memeja.com/flexyadmin/manage/list_glory";
			 }
		     });
	 });
 }
</script>
'; ?>

<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-75 altbox" id="dt">
    <div class="boxin" style="width:900px">
    <div class="header">
        <h3>Glory list(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_glory();">Add glory</a> 
	    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
					<th>Icon</th>
                    <th>Catagory</th>
					<th>Point</th>
                    <th>Start date</th>
					<th>Start time</th>
					<th>End date</th>
					<th>End time</th>
                    <th>No of users available</th>
					<th>Add date</th>
					<th>Action</th>
                 </thead>
                <tbody>
                    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur']['show'] = true;
$this->_sections['cur']['max'] = $this->_sections['cur']['loop'];
$this->_sections['cur']['step'] = 1;
$this->_sections['cur']['start'] = $this->_sections['cur']['step'] > 0 ? 0 : $this->_sections['cur']['loop']-1;
if ($this->_sections['cur']['show']) {
    $this->_sections['cur']['total'] = $this->_sections['cur']['loop'];
    if ($this->_sections['cur']['total'] == 0)
        $this->_sections['cur']['show'] = false;
} else
    $this->_sections['cur']['total'] = 0;
if ($this->_sections['cur']['show']):

            for ($this->_sections['cur']['index'] = $this->_sections['cur']['start'], $this->_sections['cur']['iteration'] = 1;
                 $this->_sections['cur']['iteration'] <= $this->_sections['cur']['total'];
                 $this->_sections['cur']['index'] += $this->_sections['cur']['step'], $this->_sections['cur']['iteration']++):
$this->_sections['cur']['rownum'] = $this->_sections['cur']['iteration'];
$this->_sections['cur']['index_prev'] = $this->_sections['cur']['index'] - $this->_sections['cur']['step'];
$this->_sections['cur']['index_next'] = $this->_sections['cur']['index'] + $this->_sections['cur']['step'];
$this->_sections['cur']['first']      = ($this->_sections['cur']['iteration'] == 1);
$this->_sections['cur']['last']       = ($this->_sections['cur']['iteration'] == $this->_sections['cur']['total']);
?>
                    <?php $this->assign('x', $this->_tpl_vars['sm']['list'][$this->_sections['cur']['index']]); ?>
                    <tr>
                    <td><img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['gloryicon_thumb'];  echo $this->_tpl_vars['x']['id_gloryicon']; ?>
_<?php echo $this->_tpl_vars['x']['icon']; ?>
" height="70px" width="70px" /><br><?php echo $this->_tpl_vars['x']['icon']; ?>
</td>
					<?php $this->assign('glory', $this->_tpl_vars['x']['id_glory_category']); ?>
					<td><?php echo $this->_tpl_vars['sm']['cat'][$this->_tpl_vars['glory']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['point']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['start_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['start_time']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['end_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['end_time']; ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['avail_no_of_users']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
						
					<td><center>
                        <a href="javascript:void(0);" onClick="edit_glory('<?php echo $this->_tpl_vars['x']['id_gloryicon']; ?>
');"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>  
                    
						&nbsp;&nbsp;<a href="http://memeja.com/flexyadmin/manage/delete_glory/id/<?php echo $this->_tpl_vars['x']['id_gloryicon']; ?>
" onclick="javascript: return confirm('Do you want to delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
					</center>
					</td>
					</tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="9">
                         No Glories Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





=======
<?php /* Smarty version 2.6.7, created on 2011-09-08 09:14:39
         compiled from admin/manage/show_glory.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/manage/show_glory.tpl.html', 63, false),)), $this); ?>

<!-- Template: admin/manage/show_glory.tpl.html Start 08/09/2011 09:14:39 --> 
 
<?php $this->assign('gen', $this->_tpl_vars['util']->get_values_from_config('GLORY_CATEGORY'));  echo '
<script type="text/javascript">
function edit_glory(id){
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/edit_glory",{\'id\':id,ce:0 },function(res){
		$.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				window.location="http://memeja.com/flexyadmin/manage/list_glory";
			 }
		     });
	 });
 }
function add_glory(){
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"manage","choice":"add_glory",ce:0 },function(res){
		  $.fancybox(res,{
			centerOnScroll:true,
			hideOnOverlayClick:false,
			onCleanup : function (){
				window.location="http://memeja.com/flexyadmin/manage/list_glory";
			 }
		     });
	 });
 }
</script>
'; ?>

<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-75 altbox" id="dt">
    <div class="boxin" style="width:900px">
    <div class="header">
        <h3>Glory list(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_glory();">Add glory</a> 
	    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
					<th>Icon</th>
                    <th>Catagory</th>
					<th>Point</th>
                    <th>Start date</th>
					<th>Start time</th>
					<th>End date</th>
					<th>End time</th>
                    <th>No of users available</th>
					<th>Add date</th>
					<th>Action</th>
                 </thead>
                <tbody>
                    <?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['list']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur']['show'] = true;
$this->_sections['cur']['max'] = $this->_sections['cur']['loop'];
$this->_sections['cur']['step'] = 1;
$this->_sections['cur']['start'] = $this->_sections['cur']['step'] > 0 ? 0 : $this->_sections['cur']['loop']-1;
if ($this->_sections['cur']['show']) {
    $this->_sections['cur']['total'] = $this->_sections['cur']['loop'];
    if ($this->_sections['cur']['total'] == 0)
        $this->_sections['cur']['show'] = false;
} else
    $this->_sections['cur']['total'] = 0;
if ($this->_sections['cur']['show']):

            for ($this->_sections['cur']['index'] = $this->_sections['cur']['start'], $this->_sections['cur']['iteration'] = 1;
                 $this->_sections['cur']['iteration'] <= $this->_sections['cur']['total'];
                 $this->_sections['cur']['index'] += $this->_sections['cur']['step'], $this->_sections['cur']['iteration']++):
$this->_sections['cur']['rownum'] = $this->_sections['cur']['iteration'];
$this->_sections['cur']['index_prev'] = $this->_sections['cur']['index'] - $this->_sections['cur']['step'];
$this->_sections['cur']['index_next'] = $this->_sections['cur']['index'] + $this->_sections['cur']['step'];
$this->_sections['cur']['first']      = ($this->_sections['cur']['iteration'] == 1);
$this->_sections['cur']['last']       = ($this->_sections['cur']['iteration'] == $this->_sections['cur']['total']);
?>
                    <?php $this->assign('x', $this->_tpl_vars['sm']['list'][$this->_sections['cur']['index']]); ?>
                    <tr>
                    <td><img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['gloryicon_thumb'];  echo $this->_tpl_vars['x']['id_gloryicon']; ?>
_<?php echo $this->_tpl_vars['x']['icon']; ?>
" height="70px" width="70px" /><br><?php echo $this->_tpl_vars['x']['icon']; ?>
</td>
					<?php $this->assign('glory', $this->_tpl_vars['x']['id_glory_category']); ?>
					<td><?php echo $this->_tpl_vars['sm']['cat'][$this->_tpl_vars['glory']]; ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['point']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['start_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['start_time']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['end_on'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['end_time']; ?>
</td>
					<td><?php echo $this->_tpl_vars['x']['avail_no_of_users']; ?>
</td>
					<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d-%m-%Y") : smarty_modifier_date_format($_tmp, "%d-%m-%Y")); ?>
</td>
						
					<td><center>
                        <a href="javascript:void(0);" onClick="edit_glory('<?php echo $this->_tpl_vars['x']['id_gloryicon']; ?>
');"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>  
                    
						&nbsp;&nbsp;<a href="http://memeja.com/flexyadmin/manage/delete_glory/id/<?php echo $this->_tpl_vars['x']['id_gloryicon']; ?>
" onclick="javascript: return confirm('Do you want to delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
					</center>
					</td>
					</tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="9">
                         No Glories Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>





>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/manage/show_glory.tpl.html End --> 