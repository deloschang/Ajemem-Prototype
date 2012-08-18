<?php /* Smarty version 2.6.7, created on 2012-08-18 04:40:25
         compiled from meme/meme_list.tpl.html */ ?>
<?php $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('LIVEFEED_COLOR')); ?>
<?php echo '
<!--
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>-->
<script type="text/javascript">
    var reply_color = "';  echo $this->_tpl_vars['x']['reply'];  echo '",
		honour_color = "';  echo $this->_tpl_vars['x']['agree'];  echo '",
		dishonour_color = "';  echo $this->_tpl_vars['x']['disagree'];  echo '",
		addcaption_color = "';  echo $this->_tpl_vars['x']['add_caption'];  echo '",
		logged_in="';  echo $_SESSION['id_user'];  echo '",
		
		is_search="';  echo $this->_tpl_vars['sm']['is_search'];  echo '",
		page_row = ';  echo $this->_tpl_vars['sm']['page_row'];  echo ',
    
		first_id, after_5sec=0, backup_rand_id_memes=\'\', backup_last_id_meme=\'\',
	
		global_page_no = 1,
		backup_page_no,
	
		see_user_old = 0, live_meme_wait = 15000,
	
		meme_timer, meme_timer_new;
	
    $(document).ready(function(){	
			$("#last_id_meme").val("';  echo $this->_tpl_vars['sm']['last_id_meme'];  echo '");
			
			var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
			
			$("#rand_id_memes").val("';  echo $this->_tpl_vars['sm']['id_memes'];  echo '");
			
			$("#last_id_meme_cur_page").val("';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '");
			
			var srch_uname = "';  echo $_REQUEST['muname'];  echo '";
			var srch_title = "';  echo $_REQUEST['mtitle'];  echo '";
			
			/*
			for(var i = 1; i < page_row + 1; i++) {
				$(\'#pagingcount\').append(\'<span id="page\'+i+\'"><a href="javascript:void(0);" style="z-index:999999"; onclick="paging_func(\'+i+\');">\'+i+\'</a></span> \');
			 }
			
			$(\'#pagenext\').html(\'<a href="javascript:void(0);" onclick="paging_func(-2);">  Next</a>\');
			
			$("#page"+1).css({\'font-weight\' : \'bolder\' });
			backup_page_no = 1;
			*/
			
		// Self-describing for search
	    var describedClass = \'self-described\';
		$(\'.self-describing\').focus(function(){
			if (this.value==this.title) this.value="";
			$(this).css("color","black");
		 }).blur(function(){
			if (!this.value || this.value==this.title){
				this.value=this.title;
				$(this).css("color","grey");
			 }
		 }).blur();	

		$(window).scroll(function(){
			if ($(window).scrollTop() == $(document).height() - $(window).height()){
				var srch_uname = "';  echo $_REQUEST['muname'];  echo '";
				var srch_title = "';  echo $_REQUEST['mtitle'];  echo '";

				if ($("#last_id_meme_cur_page").val() != "") {
					if ($("#chk_me").val()!=1) {
						backup_last_id_meme = $("#last_id_meme_cur_page").val();
						loadmorememe(cat,backup_last_id_meme,srch_uname,srch_title);
						$("#last_id_meme_cur_page").val("");
					 }
				 }
			 }
	 	 });
		
		function loadmorememe(cat,last_id,srch_uname,srch_title){
			$("#loadingmeme_img").show();
			var ext = "';  echo $_REQUEST['ext'];  echo '";
			var url = "http://localhost/meme/meme_list";
			
			var cat =\'main_feed\';
			$.post(url,{cat:cat,ce:0,last_id:last_id,muname:srch_uname,mtitle:srch_title,ext:ext }, function(res){
				$("#loadingmeme_img").hide();
				if(res!=""){
					$("#all_memes").append(res);
				 }
			 });
		 }
		
     });
    
	/*
	function paging_func(page_no){		
		global_page_no = page_no;
		if ($("#last_id_meme_cur_page").val() != "") {
			if ($("#chk_me").val()!=1) {
				last_id = $("#last_id_meme_cur_page").val();

				var ext = "';  echo $_REQUEST['ext'];  echo '";
				var url = "http://localhost/meme/meme_list";
				
				$("#loadingmeme_img").show();
				$.post(url,{cat:\'main_feed\',page_no:page_no,ce:0,last_id:last_id,ext:ext }, function(res){
					if(res != "")
						$("#all_memes").html(res);
						$("#loadingmeme_img").hide();
				 });
				
				$("#last_id_meme_cur_page").val("");
				
				clearTimeout(meme_timer);
				clearTimeout(meme_timer_new);
			 }
		 }	
		
		if (page_no == -2) {
			page_no = backup_page_no + 1
		 }
		
		if (page_no == -1) {
			page_no = backup_page_no - 1
		 }
		
		if (page_no != 1){
			if (page_no > 4){
				$("#pagingcount").html(\'\');
				
				if (page_no + 4 < page_row){
					for(var i = page_no - 3; i < page_no + 4; i++) {
						$(\'#pagingcount\').append(\'<span id="page\'+i+\'"><a href="javascript:void(0);" onclick="paging_func(\'+i+\');">\'+i+\'</a></span> \');
					 }
				 } else {
					for(var i = page_no - 3; i < page_row + 1; i++) {
						$(\'#pagingcount\').append(\'<span id="page\'+i+\'"><a href="javascript:void(0);" onclick="paging_func(\'+i+\');">\'+i+\'</a></span> \');
					 }
				 }
			 }
			
			if (page_no < 5 && backup_page_no > 4){
				$("#pagingcount").html(\'\');
				for(var i = 1; i < 8; i++) {
					$(\'#pagingcount\').append(\'<span id="page\'+i+\'"><a href="javascript:void(0);" onclick="paging_func(\'+i+\');">\'+i+\'</a></span> \');
				 }
			 }
			
			$(\'#pageprev\').html(\'<a href="javascript:void(0);" onclick="paging_func(-1);">Prev</a>  \');
		 } else {
			$(\'#pageprev\').html(\'\');
		 }
		
		if (page_no == page_row){
			$(\'#pagenext\').html(\'\');
		 }
		
		if (backup_page_no == page_row){
			$(\'#pagenext\').html(\'<a href="javascript:void(0);" onclick="paging_func(-2);">  Next</a>\');
		 }
		
		$("#page"+backup_page_no).css({\'font-weight\' : \'normal\' });
		$("#page"+page_no).css({\'font-weight\' : \'bolder\' });
		
		backup_page_no = page_no;
	 }
	*/
    
    function get_all_flag_details(timer){
		var last_id_page ;
		var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
		var ext = "';  echo $_REQUEST['ext'];  echo '"
		var last_id = $("#last_id_meme").val();
		last_id_page = $("#last_id_meme_cur_page").val();
		var page_ids = $("#rand_id_memes").val(); 
		var url = "http://localhost/meme/get_all_flag_details";
		$.post(url, {ce:0,last_id:last_id_page,cat:cat,lid:last_id,page_ids:page_ids,ext:ext }, function (res){
		    if(res){
			if(timer==1){
			     first_id = res[0];
			 }else{
				after_5sec = res[0];
				hrc = res[1];
				$("#last_id_meme").val(res[3]);
				if(res[2]!=\'Nothing\'){
				   if($("#msgexist").val()=="1"){
				       $("#all_memes").html(res[2]);
				    }else
				       $("#all_memes").prepend(res[2]);
				   $("#rand_id_memes").val(res[4]);
				 }
				blink_according_to(first_id,after_5sec,hrc);
		         }
		     }
		 },"json");
	 }

/* Fade out color after agree/disagree */
    function common_fun(id,color_code){
		$("#meme"+id).effect("highlight", {color:color_code }, 1500);
     }

/* Expand replies after reply button is pressed on the meme */
    function get_all_replies(id){
		$(\'#send_reply\'+id).slideToggle(\'slow\');
     }

	function strip(html)
	{
	   var tmp = document.createElement("DIV");
	   tmp.innerHTML = html;
	   return tmp.textContent||tmp.innerText;
	 }


/* JS call after Agree/Disagree button is pressed */
    function set_tot_adaggr(id,con,id_user){
	var url = "http://localhost/meme/set_adaggr";
	
	/* Added by Delos to check if user is logged in */
	if (logged_in) {
		$.post(url,{id_meme:id,ce:0,con:con,id_user_creator:id_user },function(res){

	    	/* If user has not voted */
	    	if(res[0]!=0){
			    if(res[1]==1){
					$("#aggr"+id).html(res[0]);		/* Updates H/D count */
					$("#is_agreed"+id).val(\'1\');
					common_fun(id,honour_color);
					
					/* After voting, Highlight Agree + Grey out Disagree */					
					$("#agr_link"+id).css({"color" : "green", "cursor" : "default" });
					$("#disagr_link"+id).css({"color" : "gray", "cursor" : "default" });

			     } else {
					$("#disaggr"+id).html(res[0]);
					$("#is_disagreed"+id).val(\'1\');
					common_fun(id,dishonour_color);
					
					/* After voting, Highlight Disagree + Grey out Agree */
					$("#disagr_link"+id).css({"color" : "red", "cursor" : "default" });
					$("#agr_link"+id).css({"color" : "gray", "cursor" : "default" });
			     }
	    	 }  else {
	    		/* res[0] = 0 and user has already voted */
	    			// Commented out because of highlighting feature
	    		/* alert("You already voted!"); */ 
	    	 }
		 },"json");
    	 } else {
    	alert("Please log in to vote");
     }
     }
    
    function show_details(id_meme){
		//var url="http://localhost/meme/meme_details/ce/0/id/"+id_meme;
		//$.post(url,{meme:meme_details,ce:0,id:id_meme });
     }
	
	function diff_feed(ext){
		var url = "http://localhost/meme/meme_list";
			$.post(url,{cat:\'main_feed\',ce:0,ext:ext }, function(res){
				if(res != ""){
					if (ext == 0){
						$(\'#all_memes\').html(res);
					 } else {
						$(\'#friend_memes\').html(res);
					 }
				 }
				if (ext == 1){
					$(\'#page_boop\').hide();
				 } else {
					$(\'#page_boop\').show();
				 }
			 });
	 }
	
	
    $(document).ready(function(){
    	// Search function
		//$("#muname").autocomplete(\'http://localhost/index.php?page=meme&choice=auto_comp&ce=0\',{
		//    delay: 500
		// });
		    document.getElementById(\'video_link\').onclick = function() {
		    link = document.getElementById(\'video_link\');
		    divTest = document.getElementById(\'video\');
		    if (divTest.style.display === "none") {
		        divTest.style.display = \'block\';
		        link.style.display = \'none\';
		     }
		    else {
		        divTest.style.display = "none";

		     }
		 }
		$("#mtitle").autocomplete(\'http://localhost/index.php?page=meme&choice=auto_comp&flg=1&ce=0\',{
		    delay: 500
		 });
     });
</script>
'; ?>

<input type="hidden" name="last_id_meme_cur_page" id="last_id_meme_cur_page" value=''/>

<input type="hidden" name="rand_id_memes" id="rand_id_memes" value=''/>
<input type="hidden" name="chk_me" id="chk_me" value=''/>
<input type="hidden" name="last_id_meme" id="last_id_meme" value=''/>

<?php if ($_SESSION['id_user'] || $_SESSION['profile']): ?>
<div>
		<!--<div id="world_feed" class="feed_buttons">
			<center>
			<a href="javascript:void(0);" onclick="diff_feed(0);">World Feed</a>
			</center>
		</div>
		
		<?php if ($_SESSION['id_user']): ?>
			<div id="friends_feed" class="feed_buttons">
				<center>
				<a href="javascript:void(0);" onclick="diff_feed(1);">Friends Feed</a>
				</center>
			</div>
		<?php endif; ?>-->
</div>



<br><br><br><br><br>

<div id="all_memes">	
    <?php if ($this->_tpl_vars['sm']['res_meme']): ?> 
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/loadmorememe.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
	<input type="hidden" id="msgexist" value="1">
		OMG, you've reached the edge of Memeja!
    <?php endif; ?>
</div>

<div id="loadingmeme_img" style="margin-left: 41%; display:none;">
    <img src="http://localhost/templates/images/loading.gif" />
</div>

<?php endif; ?>

<?php if (! $_SESSION['id_user'] && ! $_SESSION['profile']): ?>

		<div id="cloud_container">
				<div id="cloud_1" class="large_cloud"></div>
				<div id="cloud_2" class="large_cloud"></div>
				<div id="cloud_3" class="large_cloud"></div>
				<div id="cloud_4" class="large_cloud"></div>
				<div id="cloud_5" class="cloud"></div>
				<div id="cloud_6" class="cloud"></div>
				<div id="cloud_7" class="cloud"></div>
				<div id="cloud_8" class="cloud"></div>
				<div id="cloud_9" class="cloud"></div>
				<div id="cloud_11" class="cloud"></div>
				<div id="cloud_12" class="cloud"></div>
				<div id="cloud_13" class="cloud"></div>
				<div id="cloud_14" class="cloud"></div>
				<div id="cloud_15" class="cloud"></div>
				<div id="cloud_16" class="cloud"></div>
				<div id="cloud_17" class="cloud"></div>	
		</div>

		<div id="video_container">
			<div id="intro_logo">
				<a href="http://localhost/" title="Memeja!"><img src="http://localhost/templates/images/intro_logo.gif"style="width:228px;height:70px;"/></a>
			</div>
			<div id="headline">Share Experiences With the People You Care About</div>
			<a id="video_link" class="play_btn" href="#">
									<span></span>
									<span><div id="play_triangle"></div></span>
									<span>Why Memeja?</span>
			</a>
								
			<div id="video" style="display:none;">
				<iframe src="http://player.vimeo.com/video/47618336?title=0&amp;byline=0&amp;portrait=0&amp;autoplay=1" width="500" height="281" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
			</div>
		</div>
		<div id="cta_button">
			<div id="outer_sun"></div>
			<div id="inner_sun_1"></div>
			<div id="inner_sun_2"></div>
			<div id="cta_login"class="fb-login-button" size="large" scope="
		    	email,
		    	publish_stream
		    	,user_education_history
		    				    	">
	        Connect with Facebook
			</div>
			<div id="cta_message">We Promise to NEVER Post Without Your Permission</div>
		</div>
		<div id="bottom_bar">
			<table><tr>
			<td><div id="about"><a href="/about.html">About </a></div></td>
			<td><div id="about"><a href="http://blog.memeja.com">Blog </a></div></td>
			<td><div id="privacy_policy"><a href="/privacypolicy.html">Privacy  </a></div></td>
			</tr></table>
		</div>
	<?php endif; ?>