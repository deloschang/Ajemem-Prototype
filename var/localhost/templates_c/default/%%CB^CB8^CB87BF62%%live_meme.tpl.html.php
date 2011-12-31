<?php /* Smarty version 2.6.7, created on 2011-12-31 10:40:11
         compiled from meme/live_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/live_meme.tpl.html', 13, false),)), $this); ?>

<!-- Template: meme/live_meme.tpl.html Start 31/12/2011 10:40:11 --> 
 <div>
	    <div  id="meme<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" class="meme">

		<div style="height: 90px;">

<!--javascript:show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');-->
<!-- Image specs for live feed meme -->

<!-- Show details updates view count -->
			<a class="meme_gallery" data-fancybox-group="thumb" id="memeimage<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['sm']['meme_picture']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			<div style="vertical-align: top; font-size: 15px" style="padding-left:5px"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></div>
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_picture']; ?>
" style="cursor:pointer;width: 80px;height: 80px; 

						<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['sm']['meme_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>
					
		" align="left"/>

			<span style="vertical-align: top; padding-left:5px; font-size: 15px">
			<b>
			
			<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></span></a>
	<!-- end of gallery class-->
			
			<span style="font-size:12px">  by <b><span id="user<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['id_user']; ?>
"><a href="javascript:void(0);" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['id_user']; ?>
');"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['username']; ?>
 </a></span></span>
			<span style="font-size:8px"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['level']; ?>
</span></b>
	<!-- Note: Create a Javascript fall-back page if JS not enabled -->

<!-- Caption shows below image -->
			<div></div><br/>

<!-- Meme Author (Commented out) -->

<!-- Reply -->
			    <label id="repl<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;

<!-- Honor -->
			    <label id="aggr<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" 

			    	
			    onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
','A','<?php echo $this->_tpl_vars['sm']['meme_user']; ?>
');">Honor</a>&emsp;

<!-- Dishonor -->
			    <label id="disaggr<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" 
			    				    
			    onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
','D','<?php echo $this->_tpl_vars['sm']['meme_user']; ?>
');">Dishonor</a>

<!-- Add Caption 
			    <?php if (in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['sm']['meme_user']): ?>
			    &nbsp;<label id="capt<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');" >Add Caption</a>
			    <?php endif; ?>
	

<!-- Flag 
			    <?php if ($this->_tpl_vars['sm']['meme_user'] != $_SESSION['id_user']): ?>
				 &nbsp;<a href="javascript:void(0)" onclick="flagging('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
')">Flag</a>
			    <?php endif; ?>
-->
			</div>

<!-- Twitter function commented out-->

	    </div>
	    <div id="send_reply<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" style="width:60%;display: none;"></div>
<!--
	    <div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div> -->
	    <input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
	    <input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
	    <input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
</div><br/>

<!-- Template: meme/live_meme.tpl.html End --> 