<?php /* Smarty version 2.6.7, created on 2011-12-18 22:26:55
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 35, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 48, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 18/12/2011 22:26:55 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']): ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript">
	var id = "';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '";
	var new_ids = "';  echo $this->_tpl_vars['sm']['id_memes'];  echo '";
	if(id!=\'\'){
	    $("#last_id_meme_cur_page").val(id);
	    var id_memes = $("#rand_id_memes").val();
	    $("#rand_id_memes").val(id_memes+","+new_ids);
	 }
	else{
	    $("#last_id_meme_cur_page").val(\'\');
	    $("#chk_me").val("1");
	 }
	$(".fb_btn").each(function (){
	    FB.XFBML.parse($(this).get(0));
	 });
</script>
'; ?>

<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res_meme']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
<div >
	    <div  id="meme<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme">

		<div style="height: 90px;">

<!-- Image specs for live feed meme -->
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;width: 80px;height: 80px;" align="left" title="Meme" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"/> 

			<div style="vertical-align: top; font-size: 15px"><b><a href ="javascript:void(0)" OnClick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
'); return false;"><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</a></b><span style="font-size:12px"> by <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span></div>
	<!-- Note: Create a Javascript fall-back page if JS not enabled -->

<!-- Caption shows below image -->
			<div style="font-size: 12px;color:blue;"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']): ?>"<?php echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']; ?>
"<?php else:  endif; ?></span></div><br/>

<!-- Comment out Category
			    Category:<b><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['category']]; ?>
</b><br/> -->

<!-- Meme Author (Commented out)
			    by <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['lname'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
 <br/> -->

<!-- Date (Commented out)
			    On: <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
<br/><br/>  -->

<!-- Reply-->
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			    <label id="repl<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_reply']; ?>
</label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;
			    <?php endif; ?> 

<!-- Honor -->
			    <label id="aggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_honour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A');">Honor</a>&emsp;

<!-- Dishonor -->
			    <label id="disaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_dishonour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','D');">Dishonor</a>

<!-- Add Caption -->
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			    &nbsp;<label id="capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_caption']; ?>
 </label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>
			    <?php endif; ?>

<!-- Flag -->
			    <?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>
				 &nbsp;<a href="javascript:void(0)" onclick="flagging('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
')">Flag</a>
			    <?php endif; ?>

			</div>

<!-- Twitter function commented out
			    <span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
			</span><br/>
			<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span> 

-->
	    </div>
	    <div id="send_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>
	    <div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>
	    <input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
</div><br/>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>

<!-- Template: meme/loadmorememe.tpl.html End --> 