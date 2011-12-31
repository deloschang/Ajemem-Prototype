<?php /* Smarty version 2.6.7, created on 2011-12-31 01:35:27
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 223, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 256, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 31/12/2011 01:35:26 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']): ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript">
	var id = "';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '";
	var new_ids = "';  echo $this->_tpl_vars['sm']['id_memes'];  echo '";
	
	var single_id_array = new_ids.split(\',\');
	
	if (!top_meme_id) {
		var top_meme_id = single_id_array[0];
	 }
	
	if (!feed_count) {
		var feed_count = 0;
	 }
	
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
		setInterval("live_feed(new_ids)", 10000);	// influences flash time
		setInterval("live_meme()", 5000);
	 });
	
	function common_fun_extended(id,color_code){
	    $("#meme"+id).effect("highlight", {color:color_code }, 2600);
     }
    
    function hover_user(id_user){
    	see_user(id_user);
     }
    
    function see_user(id_user){    	
    	var right_pan_url = "http://localhost/user/see_user";
    	
    	$.post(right_pan_url,{id_user:id_user,ce:0 }, function(res){
			$("#right_pan").html(res);
    	 });
     }
	
	function live_meme () {
		console.log("List "+new_ids);
		console.log(top_meme_id+"| feedcount: "+feed_count);
		
		var live_meme_data;
		var url="http://localhost/meme/live_meme/ce/0/chk/1/top_meme_id/"+top_meme_id;
	
		var httpRequest = new XMLHttpRequest();
		httpRequest.open(\'POST\', url, false);

		httpRequest.send(); // this blocks as request is synchronous
	
		if (httpRequest.status == 200) {
			live_meme_data = httpRequest.responseText;
		 }
		
		if (live_meme_data.trim() == "no meme" || live_meme_data.trim() == "no meme found in SQL" || live_meme_data.trim() == "No new meme updates") {
			console.log(\'no new meme found\');
			return false; 
		 }
		
		var live_meme_response = live_meme_data.split(\',\');
				
		if (live_meme_response[0].trim() == "New Meme") {
			console.log("Data is "+live_meme_response[1]+","+live_meme_response[2]+","+live_meme_response[3]+","+live_meme_response[4]);
			
			meme_id = live_meme_response[1];
			meme_title = live_meme_response[2];
			meme_picture = live_meme_response[3];
			meme_user = live_meme_response[4];
			
			var load_url = "http://localhost/meme/live_feed_render";
			$.post(load_url,{meme_id:meme_id,meme_title:meme_title,meme_picture:meme_picture,meme_user:meme_user,ce:0 }, function(res){
				$(".live_feed"+feed_count).html(res);
			
				$(\'.live_feed\'+feed_count).slideToggle(900);
				top_meme_id = meme_id;
				new_ids += \',\'+meme_id;
				
				console.log(\'New meme toggled. Current feed_count is \'+feed_count);
				
				feed_count_orig = feed_count;
				feed_count += 1; 
				
				$(\'.live_feed\'+feed_count_orig).before(\'<div class="live_feed\'+feed_count+\'" style="display: none;"></div>\');
			 });
			
			
			//end
			
			
			
		 }
	 }
	
	function live_feed (new_ids) {
		//console.log(new_ids);
		
		var feed_id_array = new_ids.split(\',\');		// needs to check for new memes
		var id_array_len = feed_id_array.length;
		
		for (var i=0; i < id_array_len; i++) {
		
			// Grab the id_meme\'s honor
		
			console.log("Currently on..."+feed_id_array[i]);
			var meme_id = feed_id_array[i]
			var meme_tot_honor = $("#aggr"+meme_id).html();	
			
			if (!meme_tot_honor) {
				meme_tot_honor = 0;
			 }
			
			var meme_tot_dishonor = $("#disaggr"+meme_id).html();
			
			if (!meme_tot_dishonor) {
				meme_tot_dishonor = 0;
			 }
			
			var meme_tot_reply = $("#repl"+meme_id).html();
			
			if (!meme_tot_reply) {
				meme_tot_reply = 0;
			 }
			
			//console.log("Tot reply for meme is  "+meme_tot_reply);
			
			// Begin AJAX call to server
			var live_feed_data;
			var url="http://localhost/meme/live_feed/ce/0/chk/1/meme_id/"+meme_id+"/meme_tot_honor/"+meme_tot_honor+"/meme_tot_dishonor/"+meme_tot_dishonor+"/meme_tot_reply/"+meme_tot_reply;
		
			var httpRequest = new XMLHttpRequest();
			httpRequest.open(\'POST\', url, false);

			httpRequest.send(); // this blocks as request is synchronous
		
			if (httpRequest.status == 200) {
				live_feed_data_tot = httpRequest.responseText;
			 }
		
			if (live_feed_data_tot.trim() == "no change" || live_feed_data_tot.trim() == "no meme" || live_feed_data_tot.trim() == "no response"){
			
				console.log("(no update) Request data is "+live_feed_data_tot.trim());
				
			 } else {
			
				var live_feed_data = live_feed_data_tot.split(\',\');
		
				if (live_feed_data[1] == \'honor\') {
					// Live feed tot_honor has changed...
					new_honor = live_feed_data[0].trim();
		
					// Update actual number
					$("#aggr"+meme_id).html(new_honor);
		
					// Flash green
					common_fun_extended(meme_id, honour_color);
				
		
					// 
					console.log("Request data is "+live_feed_data_tot.trim());
				 } else if (live_feed_data[1] == \'dishonor\') {
					// Live feed tot_dishonor has changed...
					new_dishonor = live_feed_data[0].trim();
		
					// Update actual number
					$("#disaggr"+meme_id).html(new_dishonor);
		
					// Flash red
					common_fun_extended(meme_id, dishonour_color);
		
					// 
					console.log("Request data is "+live_feed_data_tot.trim());
				
				 } else if (live_feed_data[1] == \'reply\') {
					// Live feed tot_dishonor has changed...
					new_reply = live_feed_data[0].trim();
		
					// Update actual number
					$("#repl"+meme_id).html(new_reply);
		
					// Flash yellow
					common_fun_extended(meme_id, reply_color);
		
					// 
					console.log("Request data is "+live_feed_data_tot.trim());
				
				 }
			 }
		 }
	 }
	
	
</script>
'; ?>

<div class="live_feed0" style="display: none;"></div>
<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res_meme']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
<div>
	
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
			
			<span style="font-size:12px">  by <b><span id="user<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
"><a href="javascript:void(0);" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
 </a></span></span>
			<span style="font-size:8px"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['level']; ?>
</span></b>
	<!-- Note: Create a Javascript fall-back page if JS not enabled -->

<!-- Caption shows below image 
			<div style="font-size: 12px; color:blue"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']): ?>"<?php echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']; ?>
"<?php else:  endif; ?></span></div><br/>-->
			<div></div><br/>

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

<!-- Add Caption 
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			    &nbsp;<label id="capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_caption'] != 0):  echo $this->_tpl_vars['x']['tot_caption'];  endif; ?></label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>
			    <?php endif; ?>
	

<!-- Flag 
			    <?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>
				 &nbsp;<a href="javascript:void(0)" onclick="flagging('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
')">Flag</a>
			    <?php endif; ?>
-->
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
<!--
	    <div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div> -->
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