<?php /* Smarty version 2.6.7, created on 2011-12-17 17:37:30
         compiled from achievements/badge_list_all.tpl.html */ ?>
<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>

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
    <div>
	<fieldset style=" background-color:#CAD8F3;width: 550px;margin-left: 250px;border:10px solid gainsboro;" >
	<legend><b><?php echo $this->_tpl_vars['x']['title_badge']; ?>
:</b></legend>
		<table border="0">
		    <tr>
			<td><img src="http://localhost/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
" style="cursor:pointer;"  title="<?php echo $this->_tpl_vars['x']['title_badge']; ?>
:<?php echo $this->_tpl_vars['x']['desc_badge']; ?>
" /></td>
			<td><?php echo $this->_tpl_vars['x']['desc_badge']; ?>
</td>
		    </tr>
	    </table>
	</fieldset>
    </div>
<?php endfor; else: ?>
    <div>
	 No Badges Found.
    </div>
<?php endif; ?>