<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:28
         compiled from admin/achievements/show_badge.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/achievements/show_badge.tpl.html', 56, false),)), $this); ?>

<!-- Template: admin/achievements/show_badge.tpl.html Start 19/09/2011 23:57:28 --> 
 <?php echo '
<script type="text/javascript">
function edit(id){
//alert(a);
//alert(b);
//alert(c);

	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/achievements/edit_badge",{\'id\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
 }
function add_badge(opt){
	//alert(opt);
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"achievements","choice":"add_badge","opt":opt,ce:0 },function(res){
		 $.fancybox(res);
	 });
 }
</script>
'; ?>

<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-100 altbox" style="width:1000px" id="dt">
    <div class="boxin">
    <div class="header">
        <h3><?php if ($this->_tpl_vars['sm']['opt']): ?>Glory icon badge<?php else: ?>Badge list<?php endif; ?>(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_badge('<?php echo $this->_tpl_vars['sm']['opt']; ?>
');">Add badge</a> 
    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
                    <th>Image</th>
		    <th>Title</th>
                    <th>Description</th>
                    <th>Add date</th>
		    <?php if ($this->_tpl_vars['sm']['opt']): ?>
		    <th>Glory badge point</th>
		    <?php else: ?>
		    <th>Badge type</th>
		    <th>Badge type number</th>
		    <!--<th>From</th>
		    <th>To</th>-->
		    <?php endif; ?>
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
			<td><img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
"/></td>
			<td><?php echo $this->_tpl_vars['x']['title_badge']; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['desc_badge']; ?>
</td>
			<td width="100px"><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
			<!--<td><?php echo $this->_tpl_vars['x']['start']; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['end']; ?>
</td>-->
			<?php if ($this->_tpl_vars['sm']['opt']): ?>
			<td><?php echo $this->_tpl_vars['x']['glory_badge_point']; ?>
</td>
			<?php else: ?>
			<td><?php echo $this->_tpl_vars['sm']['btype'][$this->_tpl_vars['x']['badge_type']]; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['badge_type_number']; ?>
</td>
			<?php endif; ?>
			<td><nobr>
                        <a href="javascript:void(0);" onClick="edit('<?php echo $this->_tpl_vars['x']['id_badge']; ?>
')"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>
                        &nbsp;&nbsp;<a href="http://memeja.com/flexyadmin/achievements/delete_badge/id/<?php echo $this->_tpl_vars['x']['id_badge']; ?>
" onclick="javascript: return confirm('Do you want to delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
		</nobr></td>
		    </tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="7">
                         No Badges Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:57:28
         compiled from admin/achievements/show_badge.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/achievements/show_badge.tpl.html', 56, false),)), $this); ?>

<!-- Template: admin/achievements/show_badge.tpl.html Start 19/09/2011 23:57:28 --> 
 <?php echo '
<script type="text/javascript">
function edit(id){
//alert(a);
//alert(b);
//alert(c);

	$.fancybox.showActivity();
	$.post("http://memeja.com/flexyadmin/achievements/edit_badge",{\'id\':id,ce:0 },function(res){
		$.fancybox(res);
	 });
 }
function add_badge(opt){
	//alert(opt);
        var url = "http://memeja.com/flexyadmin/index.php";
	$.fancybox.showActivity();
	$.post(url,{"page":"achievements","choice":"add_badge","opt":opt,ce:0 },function(res){
		 $.fancybox(res);
	 });
 }
</script>
'; ?>

<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-100 altbox" style="width:1000px" id="dt">
    <div class="boxin">
    <div class="header">
        <h3><?php if ($this->_tpl_vars['sm']['opt']): ?>Glory icon badge<?php else: ?>Badge list<?php endif; ?>(<?php echo $this->_tpl_vars['sm']['count1']; ?>
)</h3>
        <a class="button" href="javascript:void(0);" onclick="add_badge('<?php echo $this->_tpl_vars['sm']['opt']; ?>
');">Add badge</a> 
    </div>
        <div class="content">
            <table cellspacing="0">
                <thead>
                    <th>Image</th>
		    <th>Title</th>
                    <th>Description</th>
                    <th>Add date</th>
		    <?php if ($this->_tpl_vars['sm']['opt']): ?>
		    <th>Glory badge point</th>
		    <?php else: ?>
		    <th>Badge type</th>
		    <th>Badge type number</th>
		    <!--<th>From</th>
		    <th>To</th>-->
		    <?php endif; ?>
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
			<td><img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
"/></td>
			<td><?php echo $this->_tpl_vars['x']['title_badge']; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['desc_badge']; ?>
</td>
			<td width="100px"><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
			<!--<td><?php echo $this->_tpl_vars['x']['start']; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['end']; ?>
</td>-->
			<?php if ($this->_tpl_vars['sm']['opt']): ?>
			<td><?php echo $this->_tpl_vars['x']['glory_badge_point']; ?>
</td>
			<?php else: ?>
			<td><?php echo $this->_tpl_vars['sm']['btype'][$this->_tpl_vars['x']['badge_type']]; ?>
</td>
			<td><?php echo $this->_tpl_vars['x']['badge_type_number']; ?>
</td>
			<?php endif; ?>
			<td><nobr>
                        <a href="javascript:void(0);" onClick="edit('<?php echo $this->_tpl_vars['x']['id_badge']; ?>
')"><img src="http://memeja.com/templates/css_theme/img/led-ico/pencil.png" alt="edit" title="Edit"/></a>
                        &nbsp;&nbsp;<a href="http://memeja.com/flexyadmin/achievements/delete_badge/id/<?php echo $this->_tpl_vars['x']['id_badge']; ?>
" onclick="javascript: return confirm('Do you want to delete?');"><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="delete" title="Delete"/></a>
		</nobr></td>
		    </tr>
                    <?php endfor; else: ?>
                    <tr>
                         <td colspan="7">
                         No Badges Found.
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/achievements/show_badge.tpl.html End --> 