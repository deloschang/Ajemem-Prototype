<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-01-14 07:08:49
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 227, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 270, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 14/01/2012 07:08:49 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']):  $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
=======
<?php /* Smarty version 2.6.7, created on 2012-04-01 08:49:20
         compiled from meme/loadmorememe.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'capitalize', 'meme/loadmorememe.tpl.html', 232, false),array('modifier', 'date_format', 'meme/loadmorememe.tpl.html', 285, false),)), $this); ?>

<!-- Template: meme/loadmorememe.tpl.html Start 01/04/2012 08:49:20 --> 
 <?php if ($this->_tpl_vars['sm']['res_meme']): ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
>>>>>>> test2
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
        //see_user(0);
     }
    function unhover_user(id_user) {
<<<<<<< HEAD
        see_user(0);
     }
    
    function see_user(id_user){    	
    	var right_pan_url = "http://memeja.com/user/see_user";
=======
		setInterval("see_user(0)", 7000);
     }
    
    function see_user(id_user){    	
    	var right_pan_url = "http://www.memeja.com/user/see_user";
>>>>>>> test2
    	
    	$.post(right_pan_url,{id_user:id_user,ce:0 }, function(res){
			$("#right_pan").html(res);
    	 });
     }

	function live_meme () {
		console.log("List "+new_ids);
		console.log(top_meme_id+"| feedcount: "+feed_count);

		var live_meme_data;
<<<<<<< HEAD
		var url="http://memeja.com/meme/live_meme/ce/0/chk/1/top_meme_id/"+top_meme_id;
=======
		var url="http://www.memeja.com/meme/live_meme/ce/0/chk/1/top_meme_id/"+top_meme_id;
>>>>>>> test2

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

<<<<<<< HEAD
			var load_url = "http://memeja.com/meme/live_feed_render";
=======
			var load_url = "http://www.memeja.com/meme/live_feed_render";
>>>>>>> test2
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


			//end



		 }
	 }

	function live_feed (new_ids) {
		//console.log(new_ids);

		var feed_id_array = new_ids.split(\',\');		// needs to check for new memes
		var id_array_len = feed_id_array.length;

		for (var i=0; i < id_array_len; i++) {

			// Grab the id_meme\'s honor

<<<<<<< HEAD
			console.log("Currently on..."+feed_id_array[i]);
=======
			//console.log("Currently on..."+feed_id_array[i]);
>>>>>>> test2
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
<<<<<<< HEAD
			var url="http://memeja.com/meme/live_feed/ce/0/chk/1/meme_id/"+meme_id+"/meme_tot_honor/"+meme_tot_honor+"/meme_tot_dishonor/"+meme_tot_dishonor+"/meme_tot_reply/"+meme_tot_reply;
=======
			var url="http://www.memeja.com/meme/live_feed/ce/0/chk/1/meme_id/"+meme_id+"/meme_tot_honor/"+meme_tot_honor+"/meme_tot_dishonor/"+meme_tot_dishonor+"/meme_tot_reply/"+meme_tot_reply;
>>>>>>> test2

			var httpRequest = new XMLHttpRequest();
			httpRequest.open(\'POST\', url, false);

			httpRequest.send(); // this blocks as request is synchronous

			if (httpRequest.status == 200) {
				live_feed_data_tot = httpRequest.responseText;
			 }

			if (live_feed_data_tot.trim() == "no change" || live_feed_data_tot.trim() == "no meme" || live_feed_data_tot.trim() == "no response"){

<<<<<<< HEAD
				console.log("(no update) Request data is "+live_feed_data_tot.trim());
=======
				//console.log("(no update) Request data is "+live_feed_data_tot.trim());
>>>>>>> test2

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

<<<<<<< HEAD
=======
<?php $this->assign('memesOnPage', 5); ?>

>>>>>>> test2
<div class="live_feed0" style="display: none; padding-top:20px;"></div>
<?php $this->_foreach['cur_meme'] = array('total' => count($_from = (array)$this->_tpl_vars['sm']['res_meme']), 'iteration' => 0);
if ($this->_foreach['cur_meme']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['x']):
        $this->_foreach['cur_meme']['iteration']++;
?>
<<<<<<< HEAD
=======
<?php if (($this->_foreach['cur_meme']['iteration']-1) < $this->_tpl_vars['memesOnPage']): ?>


>>>>>>> test2
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
<<<<<<< HEAD
');" href="http://memeja.com/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			<img src="http://memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
=======
');" href="http://www.memeja.com/image/orig/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
">
			<img src="http://www.memeja.com/image/thumb/meme/<?php echo $this->_tpl_vars['x']['image']; ?>
>>>>>>> test2
" style="cursor:pointer;width: 95px; height: 85px; 
						<?php if ($_SESSION['id_user']): ?>
				<?php if ($this->_tpl_vars['x']['id_user'] == $_SESSION['id_user']): ?>
					border-style:outset; border-width:2px; border-color:#6699FF;
				<?php endif; ?>
			<?php endif; ?>
					
		" align="left"/>
                        <!--
				<span id="user_avatar_thumb" style="vertical-align: top; padding-left: 10px; float: left;" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');" onmouseout ="$('#right_pan').removeAttr('mouseover');">
                        -->
				<span id="user_avatar_thumb" style="vertical-align: top; padding-left: 10px; float: left;" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
<<<<<<< HEAD
');" onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');">
=======
');"onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');">

				<!--
				onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"
				-->

>>>>>>> test2
				<?php if ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']): ?>
					<img src="<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['fb_pic_square']; ?>
" class="avatar_thumb_fb" >
				<?php elseif ($this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']): ?>
<<<<<<< HEAD
					<img src="http://memeja.com/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']; ?>
" class="avatar_thumb_regular"/>
				<?php else: ?>
				<?php if ($_SESSION['gender'] == 'M'): ?>memeja_male.png<?php else: ?>memeja_female.png<?php endif; ?>
=======
					<img src="http://www.memeja.com/image/thumb/avatar/<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['avatar']; ?>
" class="avatar_thumb_regular"/>
				<?php else: ?>
				<?php if ($_SESSION['gender'] == 'M'): ?> <?php else: ?> <?php endif; ?>
>>>>>>> test2
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
" style="font-size:17px;"><a href="javascript:void(0);" onmouseover="hover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');" onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"><?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['username']; ?>
 </a></span>
<<<<<<< HEAD
=======

<!--
onmouseout ="unhover_user('<?php echo $this->_tpl_vars['sm']['uinfo'][$this->_tpl_vars['x']['id_user']]['id_user']; ?>
');"
-->			

>>>>>>> test2
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
<<<<<<< HEAD
');"><img src="http://memeja.com/templates/images/reply.gif" style="width:17px;height:17px"/><span style="font-size:15px;">Reply</span></a>&emsp;
=======
');"><img src="http://www.memeja.com/templates/images/reply.gif" style="width:17px;height:17px"/><span style="font-size:15px;">Reply</span></a>&emsp;
>>>>>>> test2
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
			    <span> 
			    &emsp;
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 1): ?>
<<<<<<< HEAD
					<img src="http://memeja.com/image/orig/premade_images/14_46_EWBTE.png" title="Good job! The 2nd Honor!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 2): ?>
					<img src="http://memeja.com/image/orig/premade_images/27_59_ExcitedTroll.png" title="Excited Troll is excited! 2 Honors!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 3): ?>
					<img src="http://memeja.com/image/orig/premade_images/13_45_LOL.png" title="L0L! 3 Honors!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 4): ?>
					<img src="http://memeja.com/image/orig/premade_images/3_35_NotBad.png" title="Obama says this meme is NOT BAD!" style="width:17px; height:17px"/>
=======
					<img src="http://www.memeja.com/image/orig/premade_images/EWBTE.png" title="Good job! The 2nd Honor!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 2): ?>
					<img src="http://www.memeja.com/image/orig/premade_images/ExcitedTroll.png" title="Excited Troll is excited! 2 Honors!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 3): ?>
					<img src="http://www.memeja.com/image/orig/premade_images/LOL.png" title="L0L! 3 Honors!" style="width:17px; height:17px"/>
				<?php endif; ?>
				<?php if ($this->_tpl_vars['x']['tot_honour'] > 4): ?>
					<img src="http://www.memeja.com/image/orig/premade_images/Obama Not Bad.png" title="Obama says this meme is NOT BAD!" style="width:17px; height:17px"/>
>>>>>>> test2
				<?php endif; ?>
				</span>

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
<<<<<<< HEAD
			    <span class="fb_btn"><fb:like href="http://memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
			</span><br/>
			<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
=======
			    <span class="fb_btn"><fb:like href="http://www.memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
			</span><br/>
			<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
>>>>>>> test2
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span> 

-->
<<<<<<< HEAD
=======
<!--
<?php if ($_SESSION['id_user'] == $this->_tpl_vars['x']['id_user']): ?>
<a href="http://www.reddit.com/submit" onclick="window.location = 'http://www.reddit.com/submit?url=' + encodeURIComponent(window.location); return false"> <img src="http://www.reddit.com/static/spreddit6.gif" alt="submit to reddit" border="0" /> </a>
</span><br/>
<span class="fb_btn"><fb:like href="http://www.memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" send="false" width="450" show_faces="true" font="arial" layout="button_count"></fb:like></span>
</span><br/>
<span ><a href="http://twitter.com/share" class="twitter-share-button" data-url="http://www.memeja.com/meme/meme_details/id/<?php echo $this->_tpl_vars['x']['id_meme']; ?>
" data-text="<?php echo ((is_array($_tmp=$this->_tpl_vars['x']['title'])) ? $this->_run_mod_handler('capitalize', true, $_tmp) : smarty_modifier_capitalize($_tmp)); ?>
" data-count="none" data-via="memeje"  >Tweet</a></span>
<?php endif; ?>
-->
>>>>>>> test2
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
<<<<<<< HEAD
<?php endforeach; endif; unset($_from);  endif; ?>
=======
<?php endif; ?>
<?php endforeach; endif; unset($_from); ?>
<?php endif; ?>
>>>>>>> test2
<!-- Template: meme/loadmorememe.tpl.html End --> 