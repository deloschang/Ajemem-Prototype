<?php /* Smarty version 2.6.7, created on 2012-04-26 19:14:39
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 215, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 269, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 26/04/2012 19:14:38 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']): ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script type="text/javascript">	
	var id = "';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '";	//lowest id
	var new_ids = "';  echo $this->_tpl_vars['sm']['id_memes'];  echo '";

	var single_id_array = new_ids.split(\',\');
	var id_array_len = single_id_array.length;

	if (!top_meme_id) {
		var top_meme_id = single_id_array[0];
	 }

	if (!feed_count) {
		var feed_count = 0;
	 }

	if(id != \'\'){
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
		// prevents stacking w/ pagination
		clearTimeout(meme_timer);
		clearTimeout(meme_timer_new);
		
		meme_timer = window.setTimeout("live_feed(0)", 1000);
		
		if (global_page_no == 1 && is_search != 1) {
			meme_timer_new = window.setTimeout("live_meme()", 10000);
		 }
	 });

	function common_fun_extended(id,color_code){
	    $("#meme"+id).effect("highlight", {color:color_code }, 2600);
     }
    
	
    function hover_user(id_user){
    	var right_pan_url = "http://localhost/user/see_user";
    	
		if (id_user != see_user_old) {
			$.post(right_pan_url,{id_user:id_user,ce:0 }, function(res){
				$("#right_pan").html(res);
				see_user_old = id_user;
			 });
		 }
     }

	function live_meme () {
		//console.log("List "+new_ids);
		//console.log(top_meme_id+"| feedcount: "+feed_count);

		var live_meme_data;
		var url="http://localhost/meme/live_meme/";
		
		top_meme_id = single_id_array[0] 
		
		$.post(url,{ce:0,chk:1,top_meme_id:top_meme_id }, function(live_meme_data){
			if (live_meme_data.trim() == "no meme" || live_meme_data.trim() == "no meme found in SQL" || live_meme_data.trim() == "No new meme updates") {
				meme_timer_new = setTimeout("live_meme()", live_meme_wait);
				live_meme_wait *= 1.5;
				
				console.log(\'no new meme\');
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

					$(\'.live_feed\'+feed_count_orig).before(\'<div class="live_feed\'+feed_count+\'" style="display: none; padding-top:20px;"></div>\');
				 });
			 }
			
			meme_timer_new = window.setTimeout("live_meme", 10000);
			live_meme_wait = 15000;
		 });		
	 }
	
	function live_feed (i) {		
		console.log("Currently on..."+single_id_array[i]);
			
		// Grab meme id then honor
		var meme_id = single_id_array[i]
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

		var url="http://localhost/meme/live_feed/";
		
		$.post(url,{ce:0,chk:1,meme_id:meme_id,meme_tot_honor:meme_tot_honor,meme_tot_dishonor:meme_tot_dishonor,meme_tot_reply:meme_tot_reply }, function(live_feed_data_tot){
			//console.log(\'Meme_id\'+meme_id);
			//console.log(\'Serv Response\'+live_feed_data_tot);
			if (live_feed_data_tot.trim() == "no change" || live_feed_data_tot.trim() == "no meme" || live_feed_data_tot.trim() == "no response"){

				console.log("(no update)");

			 } else {

				var live_feed_data = live_feed_data_tot.split(\',\');

				if (live_feed_data[1] == \'honor\') {
					// Live feed tot_honor has changed...
					new_honor = live_feed_data[0].trim();

					// Update actual number
					$("#aggr"+meme_id).html(new_honor);

					// Flash green
					common_fun_extended(meme_id, honour_color);

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
			
			if (i < id_array_len - 1) {
				updated_i = i + 1
				meme_timer = window.setTimeout("live_feed(updated_i)", 2700);
			 } else {
				meme_timer = window.setTimeout("live_feed(0)", 2700);
			 }
		 });
		
		
	 }


</script>
'; ?>

<div class="live_feed0" style="display: none; padding-top:20px;"></div>
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
			<img src="http://localhost/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" style="cursor:pointer;width: 95px; height: 85px; 
						<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['x']['id_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>
					
		" align="left"/>
				<span id="user_avatar_thumb" style="vertical-align: top; padding-left: 10px; float: left;" 
				<?php if ($_SESSION['id_user']): ?>
					onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"
				<?php endif; ?>>
				
				<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']): ?>
					<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']; ?>
" class="avatar_thumb_fb" >
				<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']): ?>
					<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']; ?>
" class="avatar_thumb_regular"/>
				<?php else: ?>
				<?php if ($_SESSION['gender'] == 'M'): ?>
					<img src="http://localhost/image/thumb/avatar/memeja_male.png" class="avatar_thumb_regular"/><?php else: ?><img src="http://localhost/image/thumb/avatar/memeja_female.png" class="avatar_thumb_regular"/><?php endif; ?>
				<?php endif; ?>			
			</span>
			<span id="meme_title"><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</span></a>

	<!-- end of gallery class-->

			<div style="position:relative; left:20px; bottom:4px; font-size:17px; color:#ACACA5;">  by
                            <!--
			<span id="user<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
" style="font-size:17px;"><a href="javascript:void(0);" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');" onmouseout ="$('#right_pan').removeAttr('mouseover');"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
 </a></span>
                            -->
			<span id="user<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
" style="font-size:17px;"><a href="javascript:void(0);" 
			<?php if ($_SESSION['id_user']): ?>
				onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"
			<?php endif; ?>
			><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
 </a></span>

<!--
onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"
-->			
			
			<span style="font-size:13px; color:#ACACA5;"> L<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['level']; ?>
</span></div>
		
<!-- Caption shows below image 
			<div style="font-size: 12px; color:blue"><span id="hrc<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']): ?>"<?php echo $this->_tpl_vars['sm']['hrc'][$this->_tpl_vars['x']['id_meme']]['caption']; ?>
"<?php else:  endif; ?></span></div><br/>-->

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
<!--	<div class="meme_gen_info" style="position:relative; left: 13px; bottom:2px; font-size:13px; color:#ACACA5;">born 24 min ago</div>-->

<br/>
<!-- Reply-->

<div class="meme_reproductive_system">
			    <?php if ($this->_tpl_vars['x']['can_all_comment'] || in_array ( $_SESSION['id_user'] , $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['friends'] ) || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
			    <label id="repl<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_reply'] != 0):  echo $this->_tpl_vars['x']['tot_reply'];  endif; ?></label>&nbsp;<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');"><img src="http://localhost/templates/images/reply.gif" style="width:17px;height:17px"/><span style="font-size:15px;">Reply</span></a>&emsp;
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
');"><span style="font-size:15px;">Honor</span></a>&emsp;

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
');"><span style="font-size:15px;">Dishonor</span></a>
			    

			    </div>

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
<!--
<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
<a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="http://www.reddit.com/static/spreddit6.gif" alt="submit to reddit" border="0" /> </a>
</span><br/>
<span class="fb_btn"><fb:like href="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
</span><br/>
<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://localhost/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span>
<?php endif; ?>
-->
	    </div>
	    <div id="send_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:75%; margin:-20px 0 30px 120px; display: none;"></div>
<!--
	    <div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div> -->
	    <input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
</div>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
<!-- Template: meme/loadmorememe.tpl.html End --> 