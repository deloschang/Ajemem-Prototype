<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-11 00:30:18
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 11/06/2012 00:30:18 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-11 02:16:57
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 11/06/2012 02:16:57 --> 
>>>>>>> 5bf977c9a1fccb50ac9b1a4eadb4749659f5d673
=======
<?php /* Smarty version 2.6.7, created on 2012-06-11 04:51:51
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 11/06/2012 04:51:51 --> 
>>>>>>> test2
=======
<?php /* Smarty version 2.6.7, created on 2012-06-12 03:05:08
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 12/06/2012 03:05:08 --> 
>>>>>>> a5133832599c541bdf2df7acaece67cc8cdc0116
=======
<?php /* Smarty version 2.6.7, created on 2012-06-12 20:00:15
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 12/06/2012 20:00:15 --> 
>>>>>>> 7b5f054f749573e2c4b326012bfdeddbaf8f1b61
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 07:52:47
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 13/06/2012 07:52:47 --> 
>>>>>>> ac4211d0e074165145718401fe01962755d00891
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 09:27:35
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 13/06/2012 09:27:35 --> 
>>>>>>> 5c7946b7a5a01a5faefe62be6a80d7f56cefbb03
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 23:58:28
         compiled from common/messages.tpl.html */ ?>

<!-- Template: common/messages.tpl.html Start 13/06/2012 23:58:28 --> 
>>>>>>> 3e35044fbd7c15464e5a989ca87f488cee86e77e
 <!-- messages set by all modules shown here -->
<?php if ($_SESSION['raise_message'][$this->_tpl_vars['module']]): ?>
    <div class="alert" align="center"><?php echo $_SESSION['raise_message'][$this->_tpl_vars['module']]; ?>
</div>
<?php endif;  if ($this->_tpl_vars['sm']['message']):  unset($this->_sections['cur_msg']);
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
<?php endif;  endif; ?>

<!-- Template: common/messages.tpl.html End --> 