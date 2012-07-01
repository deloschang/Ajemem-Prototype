<?php /* Smarty version 2.6.7, created on 2012-07-01 22:28:06
         compiled from meme/loadmore_rand_meme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmore_rand_meme.tpl.html', 11, false),array('modifier', 'date_format', 'meme/loadmore_rand_meme.tpl.html', 13, false),)), $this); ?>
<?php if ($this->_tpl_vars['sm']['res_meme']['0']):  $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  $this->assign('x', $this->_tpl_vars['sm']['res_meme']['0']); ?>

  <div  id="rand_meme" style="width:640px; height:auto;">
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
<!--		    On : <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%m-%d-%Y") : smarty_modifier_date_format($_tmp, "%m-%d-%Y")); ?>
 @ <?php echo ((is_array($_tmp=$this->_tpl_vars['x']['add_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%I:%M %p") : smarty_modifier_date_format($_tmp, "%I:%M %p")); ?>
-->
	    </div>
	    
	    <!--	    <div id="randhrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="font-size: 16px;color:blue;"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']):  echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption'];  else:  endif; ?></div>-->
<!--	    -->
<!--	    <br/>-->

	    <div>
			<?php if ($_SESSION['id_user']): ?>
		    <span>
			<?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			
			
			<!--
			<span id ="rand_meme_reply_id ($x.id_meme)">
			<label id="randrepl($x.id_meme)"> ($x.tot_reply)<label>&nbsp;<a href="javascript:void(0);" onclick="get_all_rand_replies('($x.id_meme)');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;</span>
			-->
			<?php endif; ?>
			
			<span id ="rand_meme_agr_id<?php echo $this->_tpl_vars['x']['id_meme']; ?>
">
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
','A');">Honor</a></span>&emsp;
			
			<span id ="rand_meme_disagr_id<?php echo $this->_tpl_vars['x']['id_meme']; ?>
">
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
','D');">Dishonor</a></span>
			<span style="margin-left:280px; color:green;">Pro-tip: Hotkeys => H | D | spacebar</span>
			
			<div id="randsend_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>
			
<!--			<?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>-->
<!--			&nbsp;<label id="rand_capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php echo $this->_tpl_vars['x']['tot_caption']; ?>
 </label> <a href="javascript:void(0)" onclick="get_rand_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>-->
<!--			<?php endif; ?>-->
<!--			&nbsp;-->
<!--			<?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>-->
<!--				 &nbsp;<a href="javascript:void(0)" onclick="rand_flagging('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
')">Flag</a>-->
<!--			<?php endif; ?>-->
<!--			<br/>-->
<!--			<span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>-->

		    </span>
			<br/>
			<?php endif; ?>
	</div>
	    
	    
	    
	    <div id="lding_rand" style="display: none;" align="center"><img src="http://localhost/templates/images/loadingAnimation.gif" /></div>
		
		<div id="random_description" style="display: none;">
			<div><div class="fb-comments" id="inner" data-href='http://memeja.com/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
&meme=<?php echo $this->_tpl_vars['x']['id_meme']; ?>
' data-num-posts="10" data-width="400"></div></div>
		</div>
	    
	    <div  onclick="show_my_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" id="comc_img"><br />
		    <img  src="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;"  title="<?php echo $this->_tpl_vars['x']['title']; ?>
" />
	    </div>
	    
	    <br />
		    
<!--		    <span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span>-->
<!--	    <div id="randadd_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div>-->
    </div>
<?php echo '
<!--<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>-->
<script type="text/javascript">
	var notyet = 0;
	var notagree = 0;
	var notdisagree = 0;
	
	var notreply = 0;
	
	function clearTimer() {
    	notyet = 0;   
	 }  
    
    $(document).ready(function(){
		var ids = ($("#rand_ids").val())?$("#rand_ids").val()+",';  echo $this->_tpl_vars['x']['id_meme'];  echo '":"';  echo $this->_tpl_vars['x']['id_meme'];  echo '";
		$("#rand_ids").val(ids);
		
		// Set Title of Meme
		$("#random_title").html("';  echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp));  echo '");
		$("#random_username").html(\'<a href="/?id=';  echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username'];  echo '">';  echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username'];  echo '</a>\');
		
		$(document).bind(\'keydown\', \'right\', function(){
			next_meme();
		 });
		
		$(document).bind(\'keydown\', \'space\', function(){
			next_meme();
		 });
			
		$(document).bind(\'keydown\', \'h\', function(){
			next_agree();
		 });
		
		$(document).bind(\'keydown\', \'d\', function(){
			next_disagree();
		 });
		
		$(document).bind(\'keydown\', \'r\', function(){
			next_reply();
		 });
		
     });
    
	function next_reply(){
		if (notreply == 1) {
			return;
		 }
		notreply = 1;
		get_all_rand_replies(\'';  echo $this->_tpl_vars['x']['id_meme'];  echo '\');
		setTimeout(\'clearTimer()\', 1000);
	 }
	
    function next_meme(){
		if (notyet == 1) {
		    return; 
		 }  
		notyet = 1;
		show_my_details(\'';  echo $this->_tpl_vars['x']['id_meme'];  echo '\');
		setTimeout(\'clearTimer()\', 1000);
     }
    
    function next_agree(){
		if (notagree == 1) {
		    return; 
		 }  
		notagree = 1;
		rand_set_tot_adaggr(\'';  echo $this->_tpl_vars['x']['id_meme'];  echo '\',\'A\');
		setTimeout(\'clearTimer()\', 1000);
     }
    
     function next_disagree(){
		if (notdisagree == 1) {
		    return; 
		 }  
		notdisagree = 1;
		rand_set_tot_adaggr(\'';  echo $this->_tpl_vars['x']['id_meme'];  echo '\',\'D\');
		setTimeout(\'clearTimer()\', 1000);
     }
</script>
'; ?>

<?php elseif (! $this->_tpl_vars['sm']['rand_fg'] && ! $this->_tpl_vars['sm']['res_meme']['0']): ?>
No meme found.
<?php endif; ?>