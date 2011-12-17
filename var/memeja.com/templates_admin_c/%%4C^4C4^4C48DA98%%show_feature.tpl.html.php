<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:38
         compiled from admin/manage/show_feature.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/manage/show_feature.tpl.html', 69, false),)), $this); ?>

<!-- Template: admin/manage/show_feature.tpl.html Start 19/09/2011 23:57:38 --> 
 <?php echo '
<script type="text/javascript">
function edit(id){
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/edit_feature",{\'id\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
 }
function add_feature(){
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"manage","choice":"add_feature",ce:0 },function(res){
		 $.fancybox(res);
	 });
 }
function activation(id){
	//alert(id);
	var activation=\'\';
	var v=document.getElementById(id).title;
	if(v==\'Check to active\'){
		document.getElementById(id).title=\'Oncheck to inactive\';
		activation=1;
	 }
	else{
		document.getElementById(id).title=\'Check to active\';
		activation=0;
	 }
	$.post("http://memeja.com/flexyadmin/manage/edit_flag",{\'activation\':activation,\'id\':id,ce:0 },function(res){
		//alert(res);
	 });
 }
function see_detail(id){
	//alert(id);
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/see_detail",{\'id_feature\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
	
 }
</script>
'; ?>


<div class="box box-75 altbox" id="dt">
    <div class="boxin" style="width:900px">
    <div class="header">
        <h3>Feature(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_feature();">Add feature</a> 
	    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
			<th>Title</th>
			<th>Description</th>
			<th>No of suggestion</th>
			<th>Activation</th>
			<th>Add date</th>
			<th colspan="2">Action</th>
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
						<td><?php echo $this->_tpl_vars['x']['title']; ?>
</td>
						<td><?php echo $this->_tpl_vars['x']['description']; ?>
</td>
						<td><a href='javascript:void(0)' title="click to see detail of suggestion" onClick="see_detail('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
');"><?php echo $this->_tpl_vars['x']['no_of_suggestion']; ?>
</a></td>
						<td><input type="checkbox" id=<?php echo $this->_tpl_vars['x']['id_feature']; ?>
   onClick="activation(this.id)" <?php if ($this->_tpl_vars['x']['activation']): ?> title='Check to inactive' checked=checked <?php else: ?> title='Check to active' <?php endif; ?>  ></td>
						<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
						<td>
							<a href="javascript:void(0);" onClick="edit('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
')"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>
						</td>
						<td>
							<a href="http://memeja.com/flexyadmin/manage/delete_feature/id/<?php echo $this->_tpl_vars['x']['id_feature']; ?>
" onclick="javascript: return confirm('Do you want to Delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
						</td>
					</tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="7">
                         No Features Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:38
         compiled from admin/manage/show_feature.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/manage/show_feature.tpl.html', 69, false),)), $this); ?>

<!-- Template: admin/manage/show_feature.tpl.html Start 19/09/2011 23:57:38 --> 
 <?php echo '
<script type="text/javascript">
function edit(id){
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/edit_feature",{\'id\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
 }
function add_feature(){
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"manage","choice":"add_feature",ce:0 },function(res){
		 $.fancybox(res);
	 });
 }
function activation(id){
	//alert(id);
	var activation=\'\';
	var v=document.getElementById(id).title;
	if(v==\'Check to active\'){
		document.getElementById(id).title=\'Oncheck to inactive\';
		activation=1;
	 }
	else{
		document.getElementById(id).title=\'Check to active\';
		activation=0;
	 }
	$.post("http://memeja.com/flexyadmin/manage/edit_flag",{\'activation\':activation,\'id\':id,ce:0 },function(res){
		//alert(res);
	 });
 }
function see_detail(id){
	//alert(id);
	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/manage/see_detail",{\'id_feature\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
	
 }
</script>
'; ?>


<div class="box box-75 altbox" id="dt">
    <div class="boxin" style="width:900px">
    <div class="header">
        <h3>Feature(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_feature();">Add feature</a> 
	    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
			<th>Title</th>
			<th>Description</th>
			<th>No of suggestion</th>
			<th>Activation</th>
			<th>Add date</th>
			<th colspan="2">Action</th>
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
						<td><?php echo $this->_tpl_vars['x']['title']; ?>
</td>
						<td><?php echo $this->_tpl_vars['x']['description']; ?>
</td>
						<td><a href='javascript:void(0)' title="click to see detail of suggestion" onClick="see_detail('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
');"><?php echo $this->_tpl_vars['x']['no_of_suggestion']; ?>
</a></td>
						<td><input type="checkbox" id=<?php echo $this->_tpl_vars['x']['id_feature']; ?>
   onClick="activation(this.id)" <?php if ($this->_tpl_vars['x']['activation']): ?> title='Check to inactive' checked=checked <?php else: ?> title='Check to active' <?php endif; ?>  ></td>
						<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
						<td>
							<a href="javascript:void(0);" onClick="edit('<?php echo $this->_tpl_vars['x']['id_feature']; ?>
')"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>
						</td>
						<td>
							<a href="http://memeja.com/flexyadmin/manage/delete_feature/id/<?php echo $this->_tpl_vars['x']['id_feature']; ?>
" onclick="javascript: return confirm('Do you want to Delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
						</td>
					</tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="7">
                         No Features Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/manage/show_feature.tpl.html End --> 