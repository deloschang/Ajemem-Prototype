<?php /* Smarty version 2.6.7, created on 2011-12-24 01:30:27
         compiled from meme/loadmore_rand_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmore_rand_meme.tpl.html', 10, false),array('modifier', 'date_format', 'meme/loadmore_rand_meme.tpl.html', 12, false),)), $this); ?>
<?php if ($this->_tpl_vars['sm']['res_meme']['0']): ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php $this->assign('x', $this->_tpl_vars['sm']['res_meme']['0']); ?>
  <div  id="rand_meme" style="width:640px;height:auto;">
	    <div>
	    <!--
		    Posted by:<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['lname']; ?>
<br/>
		    Category:<b><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['category']]; ?>
</b><br/>
		    Title:<b><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b><br/> 
		-->
		    On : <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>

	    </div>
	    <div id="lding_rand" style="display: none;" align="center"><img src="http://localhost/templates/images/loadingAnimation.gif" /></div>
	    <div  onclick="show_my_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" id="comc_img"><br />
		    <img  src="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;"  title="Meme" />
	    </div>
	    <br />
	    <div id="randhrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="font-size: 16px;color:blue;"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']):  echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption'];  else:  endif; ?></div>
	    <br/>
	    <div>
		    <span>
			<?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			<label id="randrepl<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_reply']; ?>
</label>&nbsp;<a href="javascript:void(0);" onclick="get_all_rand_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;
			<?php endif; ?>
			
			
			<label id="randaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_honour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="randagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" 
						    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="color: green; cursor: default"
				    	<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="color: gray; cursor: default"
				    	<?php endif; ?>
				    <?php endif; ?>
			
			onclick="rand_set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A');">Honor</a>&emsp;
			
			<label id="randdisaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_dishonour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="randdisagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" 
						    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="color: gray; cursor: default"
			    		<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="color: red; cursor: default"
			    		<?php endif; ?>
			    	<?php endif; ?>
			
			onclick="rand_set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','D');">Dishonor</a>
			
			
			<?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			&nbsp;<label id="rand_capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_caption']; ?>
 </label> <a href="javascript:void(0)" onclick="get_rand_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>
			<?php endif; ?>
			&nbsp;
			<?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>
				 &nbsp;<a href="javascript:void(0)" onclick="rand_flagging('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
')">Flag</a>
			<?php endif; ?>
			<br/>
			<span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>

		    </span><br/>
		    <span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span>
	    </div>
	    <div id="randsend_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:30%;display: none;"></div>
	    <div id="randadd_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>
    </div>
<?php echo '
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function(){
	var ids = ($("#rand_ids").val())?$("#rand_ids").val()+",';  echo $this->_tpl_vars['x']['id_meme'];  echo '":"';  echo $this->_tpl_vars['x']['id_meme'];  echo '";
	$("#rand_ids").val(ids);
     });
    $(".fb_btn").each(function (){
	FB.XFBML.parse($(this).get(0));
     });
</script>
'; ?>

<?php elseif (! $this->_tpl_vars['sm']['rand_fg'] && ! $this->_tpl_vars['sm']['res_meme']['0']): ?>
No meme found.
<?php endif; ?>