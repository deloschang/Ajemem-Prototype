<?php /* Smarty version 2.6.7, created on 2011-12-23 11:25:29
         compiled from caption/loadmore_caption.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'caption/loadmore_caption.tpl.html', 21, false),)), $this); ?>
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
	<div>
	    <div style="margin-left:62px; float:left;">

				<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['avatar']; ?>
" style="width:45px;height:45px;" align="left"/><br/>
		
	    </div>

	    <div class="sam_div" align="left" style="padding-left:60px; width: 100%; padding-bottom: 10px; background-color: white;"> 

		
		<div class="caption_name" style="font-size:13px; float:left; width:10px;"><b>&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
&nbsp;<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['user_info'][$this->_tpl_vars['i']['id_user']]['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></div>
		<div align="right">Posted <span id="sp<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['timesago']; ?>
</span> ago</div>

		<br/>

				<div style="font-size:12px; color:blue; float:left;"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
">&emsp;"<?php echo $this->_tpl_vars['i']['caption']; ?>
"</span></font></div>
		
		<br/>

		<div class="fltrht">

				<span id="hnr<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['tot_honour']; ?>
</span>

		<input   class="iden" id="hnr_btn<?php echo $this->_tpl_vars['i']['id_caption']; ?>
" type="button" value="Honor"  onclick="set_hnrdishnr(this,'<?php echo $this->_tpl_vars['i']['id_caption']; ?>
')"/>&nbsp;&nbsp;

				<span id="dishnr<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"><?php echo $this->_tpl_vars['i']['tot_dishonour']; ?>
</span>

		<input   class="iden" id="dishnr_btn<?php echo $this->_tpl_vars['i']['id_caption']; ?>
"type="button" value="Dishonor"  onclick="set_hnrdishnr(this,'<?php echo $this->_tpl_vars['i']['id_caption']; ?>
')"/>&nbsp;
		</div>

				<br/><br/><hr/>


	    </div>
	</div>
	 <br/>
	<?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>