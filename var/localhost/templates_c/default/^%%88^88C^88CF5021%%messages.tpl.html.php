<?php /* Smarty version 2.6.7, created on 2012-04-10 23:02:46
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 10/04/2012 23:02:46 --> 
 <!-- messages set by all modules shown here -->
<?php if ($_SESSION['raise_message'][$this->_tpl_vars['module']]): ?>
    <div class="alert" align="center"><?php echo $_SESSION['raise_message'][$this->_tpl_vars['module']]; ?>
</div>
<?php endif; ?>
<?php if ($this->_tpl_vars['sm']['message']): ?>
<?php unset($this->_sections['cur_msg']);
$this->_sections['cur_msg']['name'] = 'cur_msg';
$this->_sections['cur_msg']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['message']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur_msg']['show'] = true;
$this->_sections['cur_msg']['max'] = $this->_sections['cur_msg']['loop'];
$this->_sections['cur_msg']['step'] = 1;
$this->_sections['cur_msg']['start'] = $this->_sections['cur_msg']['step'] > 0 ? 0 : $this->_sections['cur_msg']['loop']-1;
if ($this->_sections['cur_msg']['show']) {
    $this->_sections['cur_msg']['total'] = $this->_sections['cur_msg']['loop'];
    if ($this->_sections['cur_msg']['total'] == 0)
        $this->_sections['cur_msg']['show'] = false;
} else
    $this->_sections['cur_msg']['total'] = 0;
if ($this->_sections['cur_msg']['show']):

            for ($this->_sections['cur_msg']['index'] = $this->_sections['cur_msg']['start'], $this->_sections['cur_msg']['iteration'] = 1;
                 $this->_sections['cur_msg']['iteration'] <= $this->_sections['cur_msg']['total'];
                 $this->_sections['cur_msg']['index'] += $this->_sections['cur_msg']['step'], $this->_sections['cur_msg']['iteration']++):
$this->_sections['cur_msg']['rownum'] = $this->_sections['cur_msg']['iteration'];
$this->_sections['cur_msg']['index_prev'] = $this->_sections['cur_msg']['index'] - $this->_sections['cur_msg']['step'];
$this->_sections['cur_msg']['index_next'] = $this->_sections['cur_msg']['index'] + $this->_sections['cur_msg']['step'];
$this->_sections['cur_msg']['first']      = ($this->_sections['cur_msg']['iteration'] == 1);
$this->_sections['cur_msg']['last']       = ($this->_sections['cur_msg']['iteration'] == $this->_sections['cur_msg']['total']);
?>
     <div class="alert" align="center"><?php echo $this->_tpl_vars['sm']['message'][$this->_sections['cur_msg']['index']]; ?>
</div>
<?php endfor; else: ?>
     <div class="alert" align="center"><?php echo $this->_tpl_vars['sm']['message']; ?>
</div>
<?php endif; ?>
<?php endif; ?>

<!-- Template: common/messages.tpl.html End --> 