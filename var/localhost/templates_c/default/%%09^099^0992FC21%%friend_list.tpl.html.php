<?php /* Smarty version 2.6.7, created on 2011-12-30 00:48:48
         compiled from user/friend_list.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'user/friend_list.tpl.html', 18, false),array('modifier', 'truncate', 'user/friend_list.tpl.html', 18, false),)), $this); ?>

<!-- Template: user/friend_list.tpl.html Start 30/12/2011 00:48:48 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<fieldset>
  <legend>My friends(<?php echo $this->_tpl_vars['sm']['count']; ?>
)</legend>
<?php if ($this->_tpl_vars['sm']['res']): ?>
	<div id="result" style="width:210px;overflow: auto; height: 170px;padding: 10px;" >
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
	<div class="each_frnd">
		<table border='1' width='60'>
			<tr>
				<td width="30" height="30">
					<div class='pic_container'><img src="http://localhost/<?php echo $this->_tpl_vars['img_path']['avtar_thumb'];  if ($this->_tpl_vars['x']['avatar']):  echo $this->_tpl_vars['x']['avatar'];  else:  if ($this->_tpl_vars['x']['gender'] == 'M'): ?>memeje_male.jpg<?php else: ?>memeje_female.jpg<?php endif;  endif; ?>" height="50px" width="50px"/></div>
					
				</td>
				<tr>
					<td title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
"><font size='1'><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['x']['name'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)))) ? $this->_run_mod_handler('truncate', true, $_tmp, 9, "..", true) : smarty_modifier_truncate($_tmp, 9, "..", true)); ?>
</font></td>				
				</tr>
			</tr>
		</table>		   
	</div>
	<?php endfor; endif; ?>
	</div><br>
	<a href="http://localhost/user/all_friends/" style="float:right;">View all</a>
 <?php else: ?>
	You have no friends :(
 <?php endif; ?>
</fieldset>
<?php echo '
<style type="text/css">
.each_frnd{
	margin-left:2px;
	margin-right:2px;
	margin-top:2px;
	float:left;
 }
.pic_container	{
	position:relative;
	height:60px;
 }
.user_name	{
	vertical-align:top;
	text-transform:capitalize;
 }

</style>
'; ?>


<!-- Template: user/friend_list.tpl.html End --> 