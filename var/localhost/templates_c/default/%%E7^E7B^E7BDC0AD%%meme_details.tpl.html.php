<?php /* Smarty version 2.6.7, created on 2011-12-14 07:13:23
         compiled from meme/meme_details.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'meme/meme_details.tpl.html', 16, false),)), $this); ?>
<?php $this->assign('cat', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php $this->assign('x', $this->_tpl_vars['sm']['det_meme']); ?>
<div style="width:640px;;height:auto;">
    <div>
	<span><b>Category:</b></span>
	<span><?php echo $this->_tpl_vars['cat'][$this->_tpl_vars['x']['category']]; ?>
</span>
    </div>
    <div >
	<img src="http://localhost/image/orig/<?php if ($this->_tpl_vars['sm']['fg'] == 1): ?>duel<?php else: ?>meme<?php endif; ?>/<?php echo $this->_tpl_vars['sm']['det_meme']['image']; ?>
" title="Meme" />
    </div>
    <div>
	Posted by :<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['lname']; ?>
 
    </div>
    <div>
	On :<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y @ %H:%I %p") : smarty_modifier_date_format($_tmp, "%m-%d-%Y @ %H:%I %p")); ?>
 
    </div>
</div>