<?php /* Smarty version 2.6.7, created on 2011-12-14 11:29:03
         compiled from meme/respective_replies.tpl.html */ ?>

<!-- Template: meme/respective_replies.tpl.html Start 14/12/2011 11:29:03 --> 
 <?php $this->_foreach['rep'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['reparr']), 'iteration' => 0);
if ($this->_foreach['rep']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['rep']['iteration']++;
?>
<br/><span>Replied by <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
 : <br><b><?php echo $this->_tpl_vars['i']['reply']; ?>
</b></span><br/>
<?php endforeach; endif; unset($_from); ?><br/>
<textarea id="<?php if (! $this->_tpl_vars['sm']['flag']): ?>rpl_con<?php else: ?>rand_rpl_con<?php endif;  echo $this->_tpl_vars['sm']['id_meme']; ?>
" style="width:90%;" onclick="<?php if (! $this->_tpl_vars['sm']['flag']): ?>chk_forclear<?php else: ?>rand_chk_forclear<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" ></textarea><br/>
<a  href="javascript:void(0);" onclick="return <?php if (! $this->_tpl_vars['sm']['flag']): ?>post_reply<?php else: ?>rand_post_reply<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" style="cursor: pointer;"><img src="http://localhost/templates/images/reply.gif" />Reply</a><br/>

<!-- Template: meme/respective_replies.tpl.html End --> 