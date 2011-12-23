<?php /* Smarty version 2.6.7, created on 2011-12-23 11:25:31
         compiled from caption/rand_loadmore_caption.tpl.html */ ?>
<?php echo '
<script type="text/javascript">
	$("#chk").val("';  if ($this->_tpl_vars['sm']['last_id']):  echo $this->_tpl_vars['sm']['last_id'];  else: ?>1<?php endif;  echo '");
</script>
'; ?>

<?php if ($this->_tpl_vars['sm']['captions']): ?>
	<?php $this->_foreach['cap'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['captions']), 'iteration' => 0);
if ($this->_foreach['cap']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
        $this->_foreach['cap']['iteration']++;
?>
	    <div style="position:relative;left:62px;float:left;">
		<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']; ?>
" style="width:40px;height:40px;"/><br/>
		<div style="font-size: 16px;color: blue;float:left;"><span id="rand_hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['i']['caption']; ?>
</span></font></div>
	    </div>
	    <div class="sam_div" align="left" style="width: 80%; padding-bottom: 10px;background-color: gainsboro;">
		<div class="fltlft" style='margin-left: 50px; width:220px;'>Posted by:<?php echo $this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['fname']; ?>
&nbsp;<?php echo $this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['lname']; ?>
</div>
		<div class="fltrht">
		    <input   class="iden" id="rand_hnr_btn<?php echo $this->_tpl_vars['i']['id_caption']; ?>
" type="button" value="Honour"  onclick="rand_set_hnrdishnr(this,'<?php echo $this->_tpl_vars['i']['id_caption']; ?>
')"/>&nbsp;<span id="rand_hnr<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['tot_honour']; ?>
</span>&nbsp;
		    <input   class="iden" id="rand_dishnr_btn<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"type="button" value="Dishonour"  onclick="rand_set_hnrdishnr(this,'<?php echo $this->_tpl_vars['i']['id_caption']; ?>
')"/>&nbsp;<span id="rand_dishnr<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['tot_dishonour']; ?>
</span>&nbsp;
		</div>
		<div class="clear"></div>
		<div align="right">Posted about <span id="rand_sp<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['timesago']; ?>
</span> ago</div>
	    </div>
	    <br/>
	<?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>