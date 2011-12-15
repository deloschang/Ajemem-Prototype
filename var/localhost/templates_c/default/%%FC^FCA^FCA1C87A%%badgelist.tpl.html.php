<?php /* Smarty version 2.6.7, created on 2011-11-02 08:34:59
         compiled from achievements/badgelist.tpl.html */ ?>

<!-- Template: achievements/badgelist.tpl.html Start 02/11/2011 08:34:59 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<fieldset style=" background-color:#CAD8F3;width: 200px;margin-left:0px" >
<legend><b>My Badges:</b></legend>
    <table>
	<tr>
	    <td>
		<?php if ($this->_tpl_vars['sm']['res']): ?>
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
		    <img src="http://localhost/<?php echo $this->_tpl_vars['img_path']['badge_thumb'];  echo $this->_tpl_vars['x']['id_badge']; ?>
_<?php echo $this->_tpl_vars['x']['image_badge']; ?>
" style="width: 50px;height: 50px;cursor:pointer;"  title="<?php echo $this->_tpl_vars['x']['title_badge']; ?>
:<?php echo $this->_tpl_vars['x']['desc_badge']; ?>
" />
			<?php if (( ( $this->_sections['cur']['iteration'] % 3 ) == 0 )): ?>
			    </td>
			</tr><tr><td>
			<?php endif; ?>
		    <?php if ($this->_sections['cur']['iteration'] == 3): ?>
			       <?php break; ?> 
			    <?php endif; ?>
		    <?php endfor; endif; ?>
		<?php else: ?>
		    No Badges found
		<?php endif; ?>
	    </td>
	</tr>
	<?php if ($this->_tpl_vars['sm']['res']): ?>
		 <tr><td align="right"><a href="http://localhost/achievements/badge_list/">View all</a></td></tr>
	    <?php endif; ?>
    </table>
</fieldset>

<!-- Template: achievements/badgelist.tpl.html End --> 