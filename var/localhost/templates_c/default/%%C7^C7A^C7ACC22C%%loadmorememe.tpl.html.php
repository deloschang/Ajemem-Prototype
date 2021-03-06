<?php /* Smarty version 2.6.7, created on 2012-08-18 04:46:10
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 243, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 18/08/2012 04:46:10 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']):  $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
<script type="text/javascript">	
	var id = "';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '";	//lowest id
	console.log(\'id=\'+id);
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
	

	function common_fun_extended(id,color_code){
	    $("#meme"+id).effect("highlight", {color:color_code }, 2600);
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

					$(\'.live_feed\'+feed_count_orig).before(\'<div class="live_feed\'+feed_count+\'" style="display: none;"></div>\');
				 });
			 }
			
			meme_timer_new = window.setTimeout("live_meme", 10000);
			live_meme_wait = 15000;
		 });		
	 }

$(document).ready(function() {	
		// prevents stacking w/ pagination
		clearTimeout(meme_timer);
		clearTimeout(meme_timer_new);
		
		//meme_timer = window.setTimeout("live_feed(0)", 1000);
		
		/*if (global_page_no == 1 && is_search != 1) {
			//meme_timer_new = window.setTimeout("live_meme()", 10000);
		 }
		 });*/

	 });	

	// follow function for the live feed
	function follow_feed_user(status, whotofollow, follow_on_feed) {		
		';  if ($_SESSION['profile_id']):  echo '
			var profile_id = ';  echo $_SESSION['profile_id'];  echo ';
		';  endif;  echo '
		var profile_id = whotofollow;
                
		var url = "http://localhost/user/follow_user";

		$.post(url, {ce:0, id:profile_id, status:status }, function(res){
			if (status == \'follow\') {
				follow_on_feed += 1;
				$("#follow_me"+whotofollow).html(\'<a href="javascript:void(0);" id="follow_btn" class="large orangellow button" onclick="follow_feed_user(\\\'unfollow\\\',\'+whotofollow+\',\'+follow_on_feed+\');">Follow &nbsp --</a>\');
				//follow_count += 1;				
			 } else if (status == \'unfollow\') {
				follow_on_feed -= 1;
				$("#follow_me"+whotofollow).html(\'<a href="javascript:void(0);" id="follow_btn" class="large orangellow button "onclick="follow_feed_user(\\\'follow\\\',\'+whotofollow+\',\'+follow_on_feed+\');">Follow &nbsp ++</a>\');
				
				//follow_count -= 1;
			 }
			
			$(\'#follower_count\'+whotofollow).html(follow_on_feed+\' followers\');
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


<!-- part of live meme functionality, do not remove -->
<div class="live_feed0" style="display: none;"></div>
<!-- end -->

<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res_meme']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>

<?php echo '
 	<style type="text/css">
 		
 		';  if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )):  echo '
 		#big_heart';  echo $this->_tpl_vars['x']['id_meme'];  echo ':before, #big_heart';  echo $this->_tpl_vars['x']['id_meme'];  echo ':after { 
			background:red;
		 }
		';  endif;  echo '

 		#like_link_box';  echo $this->_tpl_vars['x']['id_meme'];  echo ' {
 			display:none;
 		 }
		#meme_image_cont';  echo $this->_tpl_vars['x']['id_meme'];  echo ':hover #like_link_box';  echo $this->_tpl_vars['x']['id_meme'];  echo ' {
			display:inline;
		 }
	</style>
'; ?>

	<div  id="meme<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme">
		
		<div id="meme_image_cont<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"class="meme_image_cont">

			<a class="meme_gallery" data-fancybox-group="thumb" id="memeimage<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			<!-- Actual Meme picture -->
			<img src="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" id="meme_pic" style=" 
			<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['x']['id_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>"/>
			<div id="pic_sun">
			<!--The User's Picture-->
				<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']): ?>
					<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']; ?>
" class="feed_profile_pic" >
				<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']): ?>
					<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']; ?>
" class="feed_profile_pic"/>
				<?php else: ?>
				<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['gender'] == 'M'): ?>
					<img src="http://localhost/image/thumb/avatar/memeja_male.png" class="feed_profile_pic"/><?php else: ?><img src="http://localhost/image/thumb/avatar/memeja_female.png" class="feed_profile_pic"/><?php endif; ?>
				<?php endif; ?>
			</div>
			</a>

			<div id="likes_comments">
				<table><tr>
					<td>
						<div id="number_likes">
							<div id="aggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" 
								<?php if ($_SESSION['id_user']): ?>
			    				<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
								style="color:green;"
								<?php endif; ?>
								<?php endif; ?>
								><?php if ($this->_tpl_vars['x']['tot_honour'] != 0):  echo $this->_tpl_vars['x']['tot_honour'];  endif; ?>
							</div>
						</div>
					</td>
					<td>
						<div id="like_heart">
						</div>
					</td>
					<!--<td>
						<div id="number_comments">
							<?php if ($this->_tpl_vars['x']['tot_reply'] != 0):  echo $this->_tpl_vars['x']['tot_reply'];  else: ?>0<?php endif; ?>
						</div>
					</td>
					<td>
						<div id="commentbox">
						</div>
					</td>-->
				</tr></table>
			</div>


			<div id="like_link_box<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"class="like_link_box">
				<table><tr>
				<td>
					<a href="/macromeme.html?meme=<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" id="remix_link">
						<div id="remix_btn<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="remix_btn" title="Remix It!">
						</div>
					</a>
				</td>
				<td>
					<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"
				    	<?php if ($_SESSION['id_user']): ?>
				    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
					    		style="cursor: default"
					    	<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
					    		style="cursor: default"
					    	<?php endif; ?>
					    <?php endif; ?>
						onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A','<?php echo $this->_tpl_vars['x']['id_user']; ?>
');">
						<div id ="big_heart<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"class="big_heart" title="Love It!">
						</div></a>
				</td>
			</tr></table>
			</div>

		</div>
		<div id="talkbubble">
			<div id ="meme_stats">

				<!-- The Meme Info section -->
				<a class="meme_gallery" data-fancybox-group="thumb" id="memeimage<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" href="http://localhost/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
"><div id="meme_title"><?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
</div></a>
					<a href="/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
">
					<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']): ?>
						<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']; ?>
" class="info_profile_pic" >
					<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']): ?>
						<img src="http://localhost/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']; ?>
" class="info_profile_pic"/>
					<?php else: ?>
					<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['gender'] == 'M'): ?>
						<img src="http://localhost/image/thumb/avatar/memeja_male.png" class="info_profile_pic"/><?php else: ?><img src="http://localhost/image/thumb/avatar/memeja_female.png" class="info_profile_pic"/><?php endif; ?>
					<?php endif; ?>
			<div id="meme_info">  by
				<span id="user<?php echo $this->_tpl_vars['x']['id_user']; ?>
" class="info_name"><a href="/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
</a></span>		
			</div>
				</a>

                        <div id="feed_follower_cont">
                                <div id="follower_count<?php echo $this->_tpl_vars['x']['id_user']; ?>
" class="follower_count"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['follower_num']; ?>
&nbsp followers</div>
                        <?php if ($this->_tpl_vars['x']['id_user'] != $_SESSION['id_user']): ?>
                                <?php if ($this->_tpl_vars['sm']['ufollow'][$this->_tpl_vars['x']['id_user']] == 1): ?>
                                <span id="follow_me<?php echo $this->_tpl_vars['x']['id_user']; ?>
"><a href="javascript:void(0);" id="follow_btn" class="large orangellow button" onclick="follow_feed_user('unfollow', <?php echo $this->_tpl_vars['x']['id_user']; ?>
,<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['follower_num']; ?>
);">Follow &nbsp --</a></span>
				<?php else: ?>
                                <span id="follow_me<?php echo $this->_tpl_vars['x']['id_user']; ?>
"><a href="javascript:void(0);" id="follow_btn"class="large orangellow button" onclick="follow_feed_user('follow',<?php echo $this->_tpl_vars['x']['id_user']; ?>
,<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['follower_num']; ?>
);">Follow &nbsp ++</a></span>
                                <?php endif; ?>
                        <?php endif; ?>
                        </div>
			<div id="share_btns">
				<table><tr>
					<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
					        <td><a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="http://www.reddit.com/static/spreddit6.gif" alt="submit to reddit" border="0" /></a></td>
                                        <?php endif; ?>

					<td><a href="http://twitter.com/share" class="twitter-share-button" data-url="memeja.com/?id=FirstName-LastName&meme=<?php echo $this->_tpl_vars['x']['image']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje">Tweet</a></td> 
					<td><div class="fb_btn"><fb:like href="memeja.com/?id=FirstName-LastName&meme=<?php echo $this->_tpl_vars['x']['image']; ?>
" send="false" width="70" show_faces="true" font="arial" layout="button_count"></fb:like> </div></td>
                                </tr>
                                </table>
			</div>
			</div>
		</div>
			<!-- Reply System -->
			<!--
				<div class="meme_reproductive_system">
					<?php if ($this->_tpl_vars['x']['can_all_comment'] || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>

					<a href="javascript:void(0);" onclick="get_all_replies('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" class="meme_reply"><img src="http://localhost/templates/images/replys.png" style="width:25px;height:25px;"/><div id="repl<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"class="meme_reply_label" style="display:none;"><?php if ($this->_tpl_vars['x']['tot_reply'] != 0):  echo $this->_tpl_vars['x']['tot_reply'];  else: ?>0<?php endif; ?></div></a>&emsp;

					<?php endif; ?>
				
					
					<!-- Honor 
					<a href="javascript:void(0);" id="agr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme_like" 
			    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="cursor: default"
				    	<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
				    		style="cursor: default"
				    	<?php endif; ?>
				    <?php endif; ?>
					onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','A','<?php echo $this->_tpl_vars['x']['id_user']; ?>
');"><img src="http://localhost/templates/images/like.png" 
					class="meme_button"/><div id="aggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme_like_label" 
					<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
						style="color:green"
						<?php endif; ?>
					<?php endif; ?>
					><?php if ($this->_tpl_vars['x']['tot_honour'] != 0):  echo $this->_tpl_vars['x']['tot_honour'];  endif; ?></div></a>

					<!-- Dishonor 
					<a href="javascript:void(0);" id="disagr_link<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme_dislike" 
			    				    	<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['honour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="cursor: default"
			    		<?php elseif (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
			    			style="cursor: default"
			    		<?php endif; ?>
			    	<?php endif; ?>
					onclick="set_tot_adaggr('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
','D','<?php echo $this->_tpl_vars['x']['id_user']; ?>
');"><img src="http://localhost/templates/images/dislike.png" class="meme_button"/><div id="disaggr<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" class="meme_dislike_label"
					<?php if ($_SESSION['id_user']): ?>
			    		<?php if (substr_count ( $this->_tpl_vars['x']['dishonour_id_user'] , $_SESSION['id_user'] )): ?>
						style="color:red"
						<?php endif; ?>
					<?php endif; ?>
					><?php if ($this->_tpl_vars['x']['tot_dishonour'] != 0):  echo $this->_tpl_vars['x']['tot_dishonour'];  endif; ?></div></a>

					</div>

					<!-- Add Caption 
									<?php if ($this->_tpl_vars['x']['can_all_comment'] || $_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
									&nbsp;<label id="capt<?php echo $this->_tpl_vars['x']['id_meme']; ?>
"><?php if ($this->_tpl_vars['x']['tot_caption'] != 0):  echo $this->_tpl_vars['x']['tot_caption'];  endif; ?></label> <a href="javascript:void(0)" onclick="get_captions('<?php echo $this->_tpl_vars['x']['id_meme']; ?>
');" >Add Caption</a>
									<?php endif; ?> -->

					<h2 class="expand_heading"></h2>

					<!--
					<div class="toggle_container">
					<table><tr>
					<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
					<td><a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="http://www.reddit.com/static/spreddit6.gif" alt="submit to reddit" border="0" /></a></td>
					<?php endif; ?>
					<td><a href="http://twitter.com/share" class="twitter-share-button" data-url="memeja.com/?id=FirstName-LastName&meme=<?php echo $this->_tpl_vars['x']['image']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje">Tweet</a></td> 
					<td><div class="fb_btn"><fb:like href="memeja.com/?id=FirstName-LastName&meme=<?php echo $this->_tpl_vars['x']['image']; ?>
" send="false" width="70" show_faces="true" font="arial" layout="button_count"></fb:like> </div></td>
					</tr></table>
					</div>-->

	    <div id="send_reply<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:75%; margin:-20px 0 30px 120px; display: none;">
			<!--
			<div class="fb-comments" data-href="http://memeja.com/?id=<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['dupe_username']; ?>
&meme=<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-num-posts="1" data-width="470"></div>
			-->
		</div>
		<!--<div id="add_caption<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" style="width:60%;display: none;"></div> -->
	    <input type="hidden" name="is_replied" id="is_replied<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_agreed" id="is_agreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
	    <input type="hidden" name="is_disagreed" id="is_disagreed<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" value=''/>
</div>
<?php endforeach; endif; unset($_from);  endif; ?>

<!-- Template: meme/loadmorememe.tpl.html End --> 