<?php /* Smarty version 2.6.7, created on 2011-12-28 03:34:57
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 94, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 126, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 28/12/2011 03:34:57 --> 
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
	 } else {
	    $("#last_id_meme_cur_page").val(\'\');
	    $("#chk_me").val("1");
	 }
	
	$(".fb_btn").each(function (){
	    FB.XFBML.parse($(this).get(0));
	 });
	
	$(document).ready(function() {
		//console.log(new_ids);
		setInterval("live_feed(new_ids)", 3000);
	 });
	
	function live_feed (new_ids) {
		console.log(new_ids);
		
		// Explode new_ids list by \',\' for single ids
		var single_id_array = new_ids.split(\',\');
		var id_array_len = single_id_array.length;
		
		// Testing with single meme first
		for (var i=0; i < id_array_len; i++) {
		
		// Grab the id_meme\'s honor
		
		console.log("Currently on..."+single_id_array[i]);
		var meme_id = single_id_array[i]
		var meme_tot_honor = $("#aggr"+meme_id).html();	// Meme 138 with 7 honor
			//console.log(meme_tot_honor);
		
		
		// Begin AJAX call to server
		var live_feed_data;
		var url="http://localhost/meme/live_feed/ce/0/chk/1/meme_id/"+meme_id+"/meme_tot_honor/"+meme_tot_honor;
		
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
		
		if (httpRequest.status == 200) {
			live_feed_data = httpRequest.responseText;
		 }
		
		if (live_feed_data.trim() == "no honor change" || live_feed_data.trim() == "no meme" || live_feed_data.trim() == "no response"){
			console.log("(no update) Request data is "+live_feed_data.trim());
		 } else {
		
			// Live feed tot_honor has changed...
			new_honor = live_feed_data.trim();
		
			// Update actual number
			console.log(meme_id);
			$("#aggr"+meme_id).html(new_honor);
		
			// Flash green
			common_fun(meme_id, honour_color);
		
			// 
			console.log("Request data is "+live_feed_data.trim());
			 }
		 }
	 }
	
	
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

<!--javascript:show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');-->
<!-- Image specs for live feed meme -->

<!-- Show details updates view count -->
			<a class="meme_gallery" data-fancybox-group="thumb" id="memeimage<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" onclick="show_details('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
<!--			<div style="vertical-align: top; font-size: 15px" style="padding-left:5px"><b><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></div>-->
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;width: 80px;height: 80px; 
						<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['x']['id_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>
					
		" align="left"/>

			<span style="vertical-align: top; padding-left:5px; font-size: 15px">
			<b>
			
			<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</b></span></a>
	<!-- end of gallery class-->
			
			<span style="font-size:12px">  by <?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
 </span>
			<span style="font-size:8px"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['level']; ?>
</span>
	<!-- Note: Create a Javascript fall-back page if JS not enabled -->

<!-- Caption shows below image -->
			<div style="font-size: 12px; color:blue"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
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
"><?php if ($this->_tpl_vars['x']['tot_reply'] != 0):  echo $this->_tpl_vars['x']['tot_reply'];  endif; ?></label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"><img src="http://localhost/templates/images/reply.gif" />Reply</a>&emsp;
			    <?php endif; ?> 

<!-- Honor -->
			    <label id="aggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_honour'] != 0):  echo $this->_tpl_vars['x']['tot_honour'];  endif; ?></label>&nbsp;<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" 
			    
			    				    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="color: green; cursor: default"
				    	<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="color: gray; cursor: default"
				    	<?php endif; ?>
				    <?php endif; ?>
			    onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A','<?php echo $this->_tpl_vars['x']['id_user']; ?>
');">Honor</a>&emsp;

<!-- Dishonor -->
			    <label id="disaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_dishonour'] != 0):  echo $this->_tpl_vars['x']['tot_dishonour'];  endif; ?></label>&nbsp;<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" 
			    				    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="color: gray; cursor: default"
			    		<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="color: red; cursor: default"
			    		<?php endif; ?>
			    	<?php endif; ?>
			    
			    onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','D','<?php echo $this->_tpl_vars['x']['id_user']; ?>
');">Dishonor</a>

<!-- Add Caption -->
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			    &nbsp;<label id="capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_caption'] != 0):  echo $this->_tpl_vars['x']['tot_caption'];  endif; ?></label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
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