<?php /* Smarty version 2.6.7, created on 2011-12-14 20:06:40
         compiled from caption/response_caption.tpl.html */ ?>
<div>
    <div style="position:relative;left:62px;float:left;">
	<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['user_info']['avatar']; ?>
" style="width:40px;height:40px;"/><br/>
	<div style="font-size: 16px;color: blue;float:left;"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['caption']; ?>
</span></font></div>
    </div>
    <div class="sam_div" align="left" style="width: 80%; padding-bottom: 10px;background-color: gainsboro;">
	 <div class="fltlft" style='margin-left: 50px; width:220px;'>Posted by:<?php echo $this->_tpl_vars['sm']['user_info']['fname']; ?>
&nbsp;<?php echo $this->_tpl_vars['sm']['user_info']['lname']; ?>
</div>
	 <div class="fltrht">
			<input   class="iden" id="hnr_btn<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
" type="button" value="Honour"  onclick="set_hnrdishnr(this,'<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
')"/>&nbsp;<span id="hnr<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['tot_honour']; ?>
</span>&nbsp;
			<input   class="iden" id="dishnr_btn<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
"type="button" value="Dishonour"  onclick="set_hnrdishnr(this,'<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
')"/>&nbsp;<span id="dishnr<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['tot_dishonour']; ?>
</span>&nbsp;
		    </div>
		    <div class="clear"></div>
		    <div align="right">Posted about <span id="sp<?php echo $this->_tpl_vars['sm']['res']['id_caption']; ?>
"><?php echo $this->_tpl_vars['sm']['res']['timesago']; ?>
</span> ago</div>
    </div>
</div>
<br/>
<?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	$("#capt"+"';  echo $this->_tpl_vars['sm']['id_meme'];  echo '").html("';  echo $this->_tpl_vars['sm']['totcap'];  echo '");
     });
</script>
'; ?>