<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-13 02:49:55
=======
<?php /* Smarty version 2.6.7, created on 2012-06-13 07:52:52
>>>>>>> ac4211d0e074165145718401fe01962755d00891
         compiled from meme/live_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/live_meme.tpl.html', 14, false),array('modifier', 'date_format', 'meme/live_meme.tpl.html', 51, false),)), $this); ?>

<<<<<<< HEAD
<!-- Template: meme/live_meme.tpl.html Start 13/06/2012 02:49:55 --> 
=======
<!-- Template: meme/live_meme.tpl.html Start 13/06/2012 07:52:52 --> 
>>>>>>> ac4211d0e074165145718401fe01962755d00891
 <div>
	
	    <div  id="meme<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" class="meme">

		<div style="height: 90px;">

<!--javascript:show_details('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');-->
<!-- Image specs for live feed meme -->

<!-- Show details updates view count -->
			<a class="meme_gallery" data-fancybox-group="thumb" id="memeimage<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['sm']['meme_picture']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['sm']['meme_picture']; ?>
" style="cursor:pointer;width: 95px; height: 85px; 
						<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['sm']['meme_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>
					
		" align="left"/>
				<span id="user_avatar_thumb" style="vertical-align: top; padding-left: 10px; float: left;" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['id_user']; ?>
');">
				<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['fb_pic_square']): ?>
					<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['fb_pic_square']; ?>
" class="avatar_thumb_fb" >
				<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['avatar']): ?>
					<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['avatar']; ?>
" class="avatar_thumb_regular"/>
				<?php else: ?>
				memeja_male.png
				<?php endif; ?>			
			</span>
			<span id="meme_title"><?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span></a>
			
	<!-- end of gallery class-->
			
			<div style="position:relative; left:20px; bottom:4px; font-size:17px; color:#ACACA5;">  by 
			<span id="user<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['id_user']; ?>
" style="font-size:17px;"><a href="javascript:void(0);" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['id_user']; ?>
');"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['username']; ?>
 </a></span>
			<span style="font-size:13px; color:#ACACA5;"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['level']; ?>
</span></div>

<!-- Caption shows below image 
			<div style="font-size: 12px; color:blue"><span id="hrc<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['sm']['meme_id']]['caption']): ?>"<?php echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['sm']['meme_id']]['caption']; ?>
"<?php else:  endif; ?></span></div><br/>-->

<!-- Comment out Category
			    Category:<b><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['category']]; ?>
</b><br/> -->

<!-- Meme Author (Commented out)
			    by <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <br/> -->

<!-- Date (Commented out)
			    On: <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
<br/><br/>  -->
<!--	<div class="meme_gen_info" style="position:relative; left: 13px; bottom:2px; font-size:13px; color:#ACACA5;">born 24 min ago</div>-->

<br/>
<!-- Reply-->

<div class="meme_reproductive_system">
			    <label id="repl<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');"><img src="http://localhost/templates/images/reply.gif" style="width:17px;height:17px"/><span style="font-size:15px;">Reply</span></a>&emsp;

<!-- Honor -->
			    <label id="aggr<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
','A','<?php echo $this->_tpl_vars['sm']['meme_user']; ?>
');"><span style="font-size:15px;">Honor</span></a>&emsp;

<!-- Dishonor -->
			    <label id="disaggr<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"></label>&nbsp;<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" 
			    				    
			    onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
','D','<?php echo $this->_tpl_vars['sm']['meme_user']; ?>
');"><span style="font-size:15px;">Dishonor</span></a>
			    
			    </div>

<!-- Add Caption 
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['sm']['meme_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['sm']['meme_user']): ?>
			    &nbsp;<label id="capt<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
"><?php if ($this->_tpl_vars['x']['tot_caption'] != 0):  echo $this->_tpl_vars['x']['tot_caption'];  endif; ?></label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
');" >Add Caption</a>
			    <?php endif; ?>
	

<!-- Flag 
			    <?php if ($this->_tpl_vars['sm']['meme_user'] != $_SESSION['id_user']): ?>
				 &nbsp;<a href="javascript:void(0)" onclick="flagging('<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
')">Flag</a>
			    <?php endif; ?>
-->
			</div>

<!-- Twitter function commented out
			    <span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
			</span><br/>
			<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['meme_title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span> 

-->
	    </div>
	    <div id="send_reply<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" style="width:75%; margin:-20px 0 30px 120px; display: none;"></div>
<!--
	    <div id="add_caption<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" style="width:60%;display: none;"></div> -->
	    <input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
	    <input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
	    <input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['sm']['meme_id']; ?>
" value=''/>
</div>

<!-- Template: meme/live_meme.tpl.html End --> 