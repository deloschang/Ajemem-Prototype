<?php /* Smarty version 2.6.7, created on 2011-09-19 23:33:46
         compiled from admin/user/log_list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/user/log_list.tpl.html', 43, false),)), $this); ?>

<!-- Template: admin/user/log_list.tpl.html Start 19/09/2011 23:33:46 --> 
 <div class="box box-85 altbox">
	<div class="boxin">
		<div class="header" width>
			<h3>
			<?php if ($this->_tpl_vars['sm']['pg_header']): ?>
				<?php echo $this->_tpl_vars['sm']['pg_header']; ?>
(<?php echo $this->_tpl_vars['sm']['count']; ?>
)
			<?php else: ?>
				Log Lists
			<?php endif; ?>
			</h3>
		</div>
		<div class="content">
			<table cellspacing="0">
			<thead>
				<tr>
				    <td class="tc  first">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin/user/log_list/sort_by/email',0,0,'user_log_list')">User Name</a>
				    </td>
				    <td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin/user/log_list/sort_by/last_login',0,0,'user_log_list')">Last Login Time</a>
				    </td>
				    <td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin/user/log_list/sort_by/login_time',0,0,'user_log_list')">Login Time(H:M:S)</a>
				    </td>
				    <td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin/user/log_list/sort_by/no_of_logs',0,0,'user_log_list')">No. of Login</a>
				    </td>
				     <td class="tc ">
					<a href="javascript:get_next_page('http://memeja.com/flexyadmin/user/log_list/sort_by/ip',0,0,'user_log_list')">No. of IP used</a>
				    </td>

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
			    <td><?php echo $this->_tpl_vars['x']['email']; ?>
</td>
			    <td><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['last_login'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y %H:%M:%S") : smarty_modifier_date_format($_tmp, "%m-%d-%Y %H:%M:%S")); ?>
</td>
			    <td><?php echo $this->_tpl_vars['x']['login_time']; ?>
</td>
			    <td><a href="javascript:void(0);"   onclick="details('<?php echo $this->_tpl_vars['x']['id_user']; ?>
');"title="Click to show login details" ><?php echo $this->_tpl_vars['x']['no_of_logs']; ?>
</a></td>
			    <td><?php echo $this->_tpl_vars['x']['ip']; ?>
</td>
			</tr>				
			<?php endfor; endif; ?>
			</tbody>
			<?php else: ?>
				<tbody><tr><td><center><b>No records found</b></center></td></tr></tbody>
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
		function details(id_user){
		    var url="http://memeja.com/flexyadmin/user/user_log_details";
		    $.fancybox.showActivity();
		    $.post(url,{id_user:id_user,ce:0 },function(res){
			$.fancybox(res);
		     });
		 }
	</script>
'; ?>


<!-- Template: admin/user/log_list.tpl.html End --> 