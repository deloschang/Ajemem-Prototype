<?php /* Smarty version 2.6.7, created on 2012-01-01 02:00:10
         compiled from meme/respective_replies.tpl.html */ ?>

<!-- Template: meme/respective_replies.tpl.html Start 01/01/2012 02:00:10 --> 
 <?php $this->_foreach['rep'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['reparr']), 'iteration' => 0);
if ($this->_foreach['rep']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['rep']['iteration']++;
?>

<div>
<a href="javascript:void(0)" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['id_user']; ?>
');">
<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['fb_pic_square']): ?>
<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['fb_pic_square']; ?>
" style="width:50px;height:50px">
<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['avatar']): ?>
<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['avatar']; ?>
" style="width:50px;height:50px"/>
<?php else: ?>
<img src="http://localhost/image/thumb/avatar/<?php if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png" style="width:50px;height:50px"/><?php endif; ?>
<?php endif; ?></a>

<span style="position:relative; bottom:38px; left:4px;"> 
<a href="javascript:void(0)" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['id_user']; ?>
');" style="font-size:15px; font-weight:bold;"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['username']; ?>
</a><span style="font-size:12px; color:#ACACA5;"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['i']['id_user']]['level']; ?>
</span></span>
</div>
<div id="user_reply" style="position:relative; left:58px; bottom:37px; padding-right:15px; font-family:Verdana;"><?php echo $this->_tpl_vars['i']['reply']; ?>
</div>

<?php endforeach; endif; unset($_from); ?>

<?php echo '
<script>
	$(document).ready(function(){
		// min chars for username
		var min_chars = 10;
			
		var validateCharacter = $(\'#validateCharacter\');
		var text_input = $(\'#';  if (! $this->_tpl_vars['sm']['flag']): ?>rpl_con<?php else: ?>rand_rpl_con<?php endif;  echo $this->_tpl_vars['sm']['id_meme'];  echo '\');
				
		text_input.keyup(function() {
			var text_input_words = text_input.val();
			var text_length = text_input_words.length;
			var remaining = min_chars - text_length
		
		// No username
			if (!text_input_words) {
				validateCharacter.html(\'10 min characters remaining...\');
							
			 } else {
		
				if (this.value != this.lastValue && text_length < min_chars) {
						validateCharacter.html(remaining+" min characters remaining...");
					 } else {
						validateCharacter.html(\'\');
					 }
				 }
		 });
	 });


	// \'Enter hotkey\' functionality 
	$(\'#';  if (! $this->_tpl_vars['sm']['flag']): ?>rpl_con<?php else: ?>rand_rpl_con<?php endif;  echo $this->_tpl_vars['sm']['id_meme'];  echo '\').keypress(function(e){
		  if(e.which == 13){
		  		';  if (! $this->_tpl_vars['sm']['flag']): ?>post_reply<?php else: ?>rand_post_reply<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');<?php echo '
		    }
		   });
</script>
'; ?>


<textarea id="<?php if (! $this->_tpl_vars['sm']['flag']): ?>rpl_con<?php else: ?>rand_rpl_con<?php endif;  echo $this->_tpl_vars['sm']['id_meme']; ?>
" style="width:90%;" onclick="<?php if (! $this->_tpl_vars['sm']['flag']): ?>chk_forclear<?php else: ?>rand_chk_forclear<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" ></textarea><br/>

<a href="javascript:void(0);" onclick="return <?php if (! $this->_tpl_vars['sm']['flag']): ?>post_reply<?php else: ?>rand_post_reply<?php endif; ?>('<?php echo $this->_tpl_vars['sm']['id_meme']; ?>
');" style="cursor: pointer;"><img src="http://localhost/templates/images/reply.gif "style="width:15px;height:15px"/><span style="font-size:13px;">Reply</span></a>

<span id="validateCharacter" style="color:#e6e6dc"></span>

<!-- Template: meme/respective_replies.tpl.html End --> 