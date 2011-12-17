<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-30 15:50:30
         compiled from admin/user/user_details.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/user/user_details.tpl.html', 44, false),)), $this); ?>

<!-- Template: admin/user/user_details.tpl.html Start 30/09/2011 15:50:30 --> 
 <div class="box box-85 altbox">
	<div class="boxin">
		<div class="header" width>
			<h3>
			<?php if ($this->_tpl_vars['sm']['pg_header']): ?>
				<?php echo $this->_tpl_vars['sm']['pg_header']; ?>
(<?php echo $this->_tpl_vars['sm']['count']; ?>
)
			<?php else: ?>
				User Lists
			<?php endif; ?>
				<!--- <a class="button" href="javascript:void(0);" onclick="add_user();">Add User</a>-->
			</h3>
		</div>
		<div class="content">
			<table cellspacing="0">
			<thead>
			    <tr>
				<td class="tb first">Avatar</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/fname',0,0,'user_user_listing')">NAME</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/email',0,0,'user_user_listing')">Email</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/add_date',0,0,'user_user_listing')">Signup date</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/user_status',0,0,'user_user_listing')">Status</a>
				</td>
				<td class="last" colspan="3">Action</td>
			    </tr>
			</thead>
			<?php if ($this->_tpl_vars['sm']['list']): ?>
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
				<td><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['avatar']):  echo $this->_tpl_vars['x']['avatar'];  else:  if ($this->_tpl_vars['x']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>"/></a></td>
				<td><?php echo $this->_tpl_vars['x']['fname']; ?>
 <?php echo $this->_tpl_vars['x']['lname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['x']['email']; ?>
</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
				<td><?php if ($this->_tpl_vars['x']['user_status'] == 1): ?>Active<?php else: ?>Inactive<?php endif; ?></td>
				<td><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="Delete" title="Delete" onclick="deleteUser('<?php echo $this->_tpl_vars['x']['id_user']; ?>
');" style="cursor:pointer;"/></td>
				<td><img src="http://memeja.com/templates/css_theme/img/led-ico/eye.png" alt="Details" title=" See Details" onclick="detailUser('<?php echo $this->_tpl_vars['x']['id_user']; ?>
');" style="cursor:pointer;"/></td>
			    </tr>
			<?php endfor; endif; ?>
			</tbody>
			<?php else: ?>
				<tbody><tr><td colspan="6"><center><b>No records found</b></center></td></tr></tbody>
			<?php endif; ?>
			</table>
		</div>
	</div>
	<?php if ($this->_tpl_vars['sm']['list']): ?>
		<?php if ($this->_tpl_vars['sm']['type'] == 'advance'): ?>
			<div class="pagination_adv">
				<?php echo $this->_tpl_vars['sm']['next_prev']->generateadv(); ?>

			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'box'): ?>
			<div class="pagination_box">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'normal'): ?>
			<div class="pagination">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'nextprev'): ?>
			<div class="pagination">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->onlynextprev(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'extra'): ?>
			<div class="pagination_box">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generateextra(); ?>
</div>
			</div>
		<?php else: ?>
			<?php if ($this->_tpl_vars['sm']['type'] != 'no'): ?>
				<div>
					<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php echo '
	<script type="text/javascript">
	var qstart = "';  echo $this->_tpl_vars['sm']['next_prev']->start;  echo '";
	var count=0;
	function deleteUser(id_user) {
			var choice=confirm(\'Do you want to delete?\');
			if(choice){
				var url="http://memeja.com/flexyadmin/index.php";
				$.post(url,{page:\'user\',choice:"delete_user",ce:0,id_user:id_user }, function(res){alert(res);return;
					window.location.href=res;
				 });
			 }
	 }
	function detailUser(id_user){
	    var url="http://memeja.com/flexyadmin/user/detail_user/id_user/"+id_user;
		$.fancybox.showActivity();
		$.post(url,{ce:0,qstart:qstart },function(res){
			$.fancybox(res);
		 });
	   
	 }
	function add_user(){
		var url="http://memeja.com/flexyadmin/user/add_user";
		$.fancybox.showActivity();
		$.post(url,{ce:0 },function(res){
			$.fancybox(res);
		 });
	   
	 }


	</script>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-30 15:50:30
         compiled from admin/user/user_details.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/user/user_details.tpl.html', 44, false),)), $this); ?>

<!-- Template: admin/user/user_details.tpl.html Start 30/09/2011 15:50:30 --> 
 <div class="box box-85 altbox">
	<div class="boxin">
		<div class="header" width>
			<h3>
			<?php if ($this->_tpl_vars['sm']['pg_header']): ?>
				<?php echo $this->_tpl_vars['sm']['pg_header']; ?>
(<?php echo $this->_tpl_vars['sm']['count']; ?>
)
			<?php else: ?>
				User Lists
			<?php endif; ?>
				<!--- <a class="button" href="javascript:void(0);" onclick="add_user();">Add User</a>-->
			</h3>
		</div>
		<div class="content">
			<table cellspacing="0">
			<thead>
			    <tr>
				<td class="tb first">Avatar</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/fname',0,0,'user_user_listing')">NAME</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/email',0,0,'user_user_listing')">Email</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/add_date',0,0,'user_user_listing')">Signup date</a>
				</td>
				<td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin//user/user_listing/sort_by/user_status',0,0,'user_user_listing')">Status</a>
				</td>
				<td class="last" colspan="3">Action</td>
			    </tr>
			</thead>
			<?php if ($this->_tpl_vars['sm']['list']): ?>
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
				<td><img src="http://memeja.com/image/thumb/avatar/<?php if ($this->_tpl_vars['x']['avatar']):  echo $this->_tpl_vars['x']['avatar'];  else:  if ($this->_tpl_vars['x']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>"/></a></td>
				<td><?php echo $this->_tpl_vars['x']['fname']; ?>
 <?php echo $this->_tpl_vars['x']['lname']; ?>
</td>
				<td><?php echo $this->_tpl_vars['x']['email']; ?>
</td>
				<td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
</td>
				<td><?php if ($this->_tpl_vars['x']['user_status'] == 1): ?>Active<?php else: ?>Inactive<?php endif; ?></td>
				<td><img src="http://memeja.com/templates/css_theme/img/led-ico/delete.png" alt="Delete" title="Delete" onclick="deleteUser('<?php echo $this->_tpl_vars['x']['id_user']; ?>
');" style="cursor:pointer;"/></td>
				<td><img src="http://memeja.com/templates/css_theme/img/led-ico/eye.png" alt="Details" title=" See Details" onclick="detailUser('<?php echo $this->_tpl_vars['x']['id_user']; ?>
');" style="cursor:pointer;"/></td>
			    </tr>
			<?php endfor; endif; ?>
			</tbody>
			<?php else: ?>
				<tbody><tr><td colspan="6"><center><b>No records found</b></center></td></tr></tbody>
			<?php endif; ?>
			</table>
		</div>
	</div>
	<?php if ($this->_tpl_vars['sm']['list']): ?>
		<?php if ($this->_tpl_vars['sm']['type'] == 'advance'): ?>
			<div class="pagination_adv">
				<?php echo $this->_tpl_vars['sm']['next_prev']->generateadv(); ?>

			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'box'): ?>
			<div class="pagination_box">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'normal'): ?>
			<div class="pagination">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'nextprev'): ?>
			<div class="pagination">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->onlynextprev(); ?>
</div>
			</div>
		<?php elseif ($this->_tpl_vars['sm']['type'] == 'extra'): ?>
			<div class="pagination_box">
				<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generateextra(); ?>
</div>
			</div>
		<?php else: ?>
			<?php if ($this->_tpl_vars['sm']['type'] != 'no'): ?>
				<div>
					<div align="center"><?php echo $this->_tpl_vars['sm']['next_prev']->generate(); ?>
</div>
				</div>
			<?php endif; ?>
		<?php endif; ?>
	<?php endif; ?>
</div>
<?php echo '
	<script type="text/javascript">
	var qstart = "';  echo $this->_tpl_vars['sm']['next_prev']->start;  echo '";
	var count=0;
	function deleteUser(id_user) {
			var choice=confirm(\'Do you want to delete?\');
			if(choice){
				var url="http://memeja.com/flexyadmin/index.php";
				$.post(url,{page:\'user\',choice:"delete_user",ce:0,id_user:id_user }, function(res){alert(res);return;
					window.location.href=res;
				 });
			 }
	 }
	function detailUser(id_user){
	    var url="http://memeja.com/flexyadmin/user/detail_user/id_user/"+id_user;
		$.fancybox.showActivity();
		$.post(url,{ce:0,qstart:qstart },function(res){
			$.fancybox(res);
		 });
	   
	 }
	function add_user(){
		var url="http://memeja.com/flexyadmin/user/add_user";
		$.fancybox.showActivity();
		$.post(url,{ce:0 },function(res){
			$.fancybox(res);
		 });
	   
	 }


	</script>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/user/user_details.tpl.html End --> 