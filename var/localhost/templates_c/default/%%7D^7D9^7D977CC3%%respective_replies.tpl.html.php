<?php /* Smarty version 2.6.7, created on 2011-12-28 10:55:31
         compiled from meme/respective_replies.tpl.html */ ?>

<!-- Template: meme/respective_replies.tpl.html Start 28/12/2011 10:55:31 --> 
 <?php $this->_foreach['rep'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['reparr']), 'iteration' => 0);
if ($this->_foreach['rep']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['rep']['iteration']++;
?>

<br/>

<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['fb_pic_square']): ?>
<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['fb_pic_square']; ?>
">
<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['avatar']): ?>
<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['avatar']; ?>
"/>
<?php else: ?>
<?php if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif; ?>
<?php endif; ?>
<span>Replied by <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['username']; ?>
 : <br><b><?php echo $this->_tpl_vars['i']['reply']; ?>
</b></span><br/>

<?php endforeach; endif; unset($_from); ?><br/>

<!-- D: written in to update reply feed in live -->
<div id="replyinsert<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
"></div>

<textarea id="<?php if (! $this->_tpl_vars['sm']['flag']): ?>rpl_con<?php else: ?>rand_rpl_con<?php endif;  echo $this->_tpl_vars['sm']['id_meme']; ?>
" style="width:90%;" onclick="<?php if (! $this->_tpl_vars['sm']['flag']): ?>chk_forclear<?php else: ?>rand_chk_forclear<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" ></textarea><br/>

<a  href="javascript:void(0);" onclick="return <?php if (! $this->_tpl_vars['sm']['flag']): ?>post_reply<?php else: ?>rand_post_reply<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" style="cursor: pointer;"><img src="http://localhost/templates/images/reply.gif" />Reply</a><br/>

<!-- Template: meme/respective_replies.tpl.html End --> 