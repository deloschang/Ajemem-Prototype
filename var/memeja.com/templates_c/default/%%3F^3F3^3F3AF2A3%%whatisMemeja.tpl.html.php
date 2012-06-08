<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-10-14 10:50:01
         compiled from achievements/whatisMemeja.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'achievements/whatisMemeja.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['/home/bobeveal/public_html/memeja.com/flexycms/../var/memeja.com/templates_c/default/%%3F^3F3^3F3AF2A3%%whatisMemeja.tpl.html.inc'] = 'c47ccad8dae3c89b3f2d91814f6c1771'; ?>
<!-- Template: achievements/whatisMemeja.tpl.html Start 14/10/2011 10:50:01 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div style="font-size:20px;width:300px;">How to get achivement</div>
<div style="width:300px;">
<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c47ccad8dae3c89b3f2d91814f6c1771#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'cms','mgr' => 'cms','choice' => 'show','code' => 'howtogetachievement'), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c47ccad8dae3c89b3f2d91814f6c1771#0}';}?>

</div></br>
<div style="font-size:16px;width:300px;">Example</div>
<div>
<?php if ($this->_tpl_vars['sm']['res']): ?>
	<table> 
		<tr>
		<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
			<td>
				<img src="http://www.memeja.com/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
"  style="height:80px; width:80px" title="<?php echo $this->_tpl_vars['x']['desc_badge']; ?>
" />
				<?php if (( $this->_sections['cur']['iteration'] % 3 ) == 0): ?>
					
			</td>
		</tr>
		<tr>
				<?php endif; ?>
		<?php endfor; endif; ?>
		</tr>
	</table>
<?php endif; ?>
</div>

=======
<?php /* Smarty version 2.6.7, created on 2011-10-14 10:50:01
         compiled from achievements/whatisMemeja.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'get_mod', 'achievements/whatisMemeja.tpl.html', 6, false),)), $this); ?>
<?php $this->_cache_serials['/home/bobeveal/public_html/memeja.com/flexycms/../var/memeja.com/templates_c/default/%%3F^3F3^3F3AF2A3%%whatisMemeja.tpl.html.inc'] = 'c47ccad8dae3c89b3f2d91814f6c1771'; ?>
<!-- Template: achievements/whatisMemeja.tpl.html Start 14/10/2011 10:50:01 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div style="font-size:20px;width:300px;">How to get achivement</div>
<div style="width:300px;">
<?php if ($this->caching && !$this->_cache_including) { echo '{nocache:c47ccad8dae3c89b3f2d91814f6c1771#0}';}echo $this->_plugins['function']['get_mod'][0][0]->get_mod(array('mod' => 'cms','mgr' => 'cms','choice' => 'show','code' => 'howtogetachievement'), $this);if ($this->caching && !$this->_cache_including) { echo '{/nocache:c47ccad8dae3c89b3f2d91814f6c1771#0}';}?>

</div></br>
<div style="font-size:16px;width:300px;">Example</div>
<div>
<?php if ($this->_tpl_vars['sm']['res']): ?>
	<table> 
		<tr>
		<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
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
		<?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
			<td>
				<img src="http://www.memeja.com/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
"  style="height:80px; width:80px" title="<?php echo $this->_tpl_vars['x']['desc_badge']; ?>
" />
				<?php if (( $this->_sections['cur']['iteration'] % 3 ) == 0): ?>
					
			</td>
		</tr>
		<tr>
				<?php endif; ?>
		<?php endfor; endif; ?>
		</tr>
	</table>
<?php endif; ?>
</div>

>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
<!-- Template: achievements/whatisMemeja.tpl.html End --> 