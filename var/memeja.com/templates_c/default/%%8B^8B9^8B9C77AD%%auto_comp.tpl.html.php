<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-21 02:30:43
         compiled from meme/auto_comp.tpl.html */ ?>
    <?php $this->_foreach['f1'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res']), 'iteration' => 0);
if ($this->_foreach['f1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['f1']['iteration']++;
?>
    <?php $this->_foreach['f2'] = array('total' => count($_from = (array)$this->_tpl_vars['i']), 'iteration' => 0);
if ($this->_foreach['f2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['i1']):
        $this->_foreach['f2']['iteration']++;
?>
    <?php echo $this->_tpl_vars['i1']; ?>

    <?php endforeach; endif; unset($_from); ?>
=======
<?php /* Smarty version 2.6.7, created on 2011-09-21 02:30:43
         compiled from meme/auto_comp.tpl.html */ ?>
    <?php $this->_foreach['f1'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res']), 'iteration' => 0);
if ($this->_foreach['f1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['f1']['iteration']++;
?>
    <?php $this->_foreach['f2'] = array('total' => count($_from = (array)$this->_tpl_vars['i']), 'iteration' => 0);
if ($this->_foreach['f2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k1'] => $this->_tpl_vars['i1']):
        $this->_foreach['f2']['iteration']++;
?>
    <?php echo $this->_tpl_vars['i1']; ?>

    <?php endforeach; endif; unset($_from); ?>
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
    <?php endforeach; endif; unset($_from); ?>