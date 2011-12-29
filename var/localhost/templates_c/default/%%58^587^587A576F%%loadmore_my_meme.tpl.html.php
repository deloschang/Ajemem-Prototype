<?php /* Smarty version 2.6.7, created on 2011-12-28 08:48:07
         compiled from manage/loadmore_my_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'manage/loadmore_my_meme.tpl.html', 18, false),array('modifier', 'date_format', 'manage/loadmore_my_meme.tpl.html', 19, false),)), $this); ?>
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
	    <?php if ($this->_tpl_vars['sm']['res']): ?>
		<?php unset($this->_sections['cur']);
$this->_sections['cur']['name'] = 'cur';
$this->_sections['cur']['loop'] = is_array($_loop=$this->_tpl_vars['sm']['res']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['cur']['show'] = true;
$this->_sections['cur']['max'] = $this->_sections['cur']['loop'];
$this->_sections['cur']['step'] = 1;
$this->_sections['cur']['start'] = $this->_sections['cur']['step'] > 0 ? 0 : $this->_sections['cur']['loop']-1;
if ($this->_sections['cur']['show']) {
    $this->_sections['cur']['total'] = $this->_sections['cur']['loop'];
    if ($this->_sections['cur']['total'] == 0)
        $this->_sections['cur']['show'] = false;
} else
    $this->_sections['cur']['total'] = 0;
if ($this->_sections['cur']['show']):

            for ($this->_sections['cur']['index'] = $this->_sections['cur']['start'], $this->_sections['cur']['iteration'] = 1;
                 $this->_sections['cur']['iteration'] <= $this->_sections['cur']['total'];
                 $this->_sections['cur']['index'] += $this->_sections['cur']['step'], $this->_sections['cur']['iteration']++):
$this->_sections['cur']['rownum'] = $this->_sections['cur']['iteration'];
$this->_sections['cur']['index_prev'] = $this->_sections['cur']['index'] - $this->_sections['cur']['step'];
$this->_sections['cur']['index_next'] = $this->_sections['cur']['index'] + $this->_sections['cur']['step'];
$this->_sections['cur']['first']      = ($this->_sections['cur']['iteration'] == 1);
$this->_sections['cur']['last']       = ($this->_sections['cur']['iteration'] == $this->_sections['cur']['total']);
?>
		<?php $this->assign('x', $this->_tpl_vars['sm']['res'][$this->_sections['cur']['index']]); ?>
		<div >
			<div  id="meme<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme">
				<div style="height: 110px;">
				    <div onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');">
					<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;width:100px;height:100px;" align="left" title="Meme" />
				    </div>
					<div style="vertical-align: top;">
						Posted by:<?php if ($this->_tpl_vars['sm']['flg']):  echo $this->_tpl_vars['sm']['usr_info'][$this->_tpl_vars['x']['id_user']]['fname']; ?>
 <?php echo $this->_tpl_vars['sm']['usr_info'][$this->_tpl_vars['x']['id_user']]['lname'];  else:  echo $_SESSION['fname']; ?>
 <?php echo $_SESSION['lname'];  endif; ?> 
					</div>
					Category:<b><?php echo $this->_tpl_vars['category'][$this->_tpl_vars['x']['category']]; ?>
</b><br/>
					Title:<b><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b><br/> 
					On : <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%H:%I %p") : smarty_modifier_date_format($_tmp, "%H:%I %p")); ?>

				</div>
				<div style="font-size: 16px;color:blue;"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']):  echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption'];  else:  endif; ?></span></div>	

				<span>
					<?php if ($this->_tpl_vars['x']['can_all_comment'] || @ in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
					<label id="repl<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_reply']; ?>
</label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;
					<?php endif; ?>
					<label id="aggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_honour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A');">Honour</a>&emsp;
					<label id="disaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_dishonour']; ?>
</label>&nbsp;<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','D');">Dishonour</a>
					<?php if ($this->_tpl_vars['x']['can_all_comment'] || @ in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
					&nbsp;<label id="capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_caption']; ?>
 </label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>
					<?php endif; ?>
					&nbsp;
					<?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>
					 &nbsp;<a href="javascript:void(0)" onclick="flagging('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
')">Flag</a>
					<?php endif; ?><br>
					<span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span><br>
					<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span>
				</span>
			</div>
			<div id="send_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:30%;display: none;"></div>
			<div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>
			<input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
			<input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
			<input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
		</div>
		<br/>
		<?php endfor; endif; ?>
	    <?php endif; ?>
<?php echo '
<script type="text/javascript">
	$(".fb_btn").each(function (){
	    FB.XFBML.parse($(this).get(0));
    	 });
	$("#last_idmeme_page").val("';  echo $this->_tpl_vars['sm']['last_res_id_meme'];  echo '");
	$("#chk_me").val("");
</script>
<style type="text/css">
    a{text-decoration:none; }
</style>
'; ?>
