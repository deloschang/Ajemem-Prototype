<?php /* Smarty version 2.6.7, created on 2012-06-12 04:48:02
         compiled from meme/meme_list.tpl.html */ ?>
<?php $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('LIVEFEED_COLOR')); ?>
<?php echo '
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript">
    var reply_color = "';  echo $this->_tpl_vars['x']['reply'];  echo '";
    var honour_color = "';  echo $this->_tpl_vars['x']['agree'];  echo '";
    var dishonour_color = "';  echo $this->_tpl_vars['x']['disagree'];  echo '";
    var addcaption_color = "';  echo $this->_tpl_vars['x']['add_caption'];  echo '";
    
	var logged_in="';  echo $_SESSION['id_user'];  echo '";
	
	var is_search="';  echo $this->_tpl_vars['sm']['is_search'];  echo '";
	
	var page_row = ';  echo $this->_tpl_vars['sm']['page_row'];  echo ';
    
    var first_id, after_5sec=0, backup_rand_id_memes=\'\', backup_last_id_meme=\'\';
	
	var global_page_no = 1;
	var backup_page_no;
	
	var see_user_old = 0;
	var live_meme_wait = 15000;
	
	var meme_timer;
	var meme_timer_new;
	
    $(document).ready(function(){	
    
			$(\'.meme_gallery\').fancybox({
				padding: 0,
				
				fitToView: false,
			
				openEffect : \'elastic\',
				openSpeed  : 150,
				
				prevEffect : \'fade\',
				nextEffect : \'none\',
				closeEffect : \'elastic\',
				closeSpeed : 100,

				closeBtn  : false,
				arrows    : true,
				nextClick : true,
				
				keys: {
					next: [13, 32, 34, 39], // enter, space, page down, down arrow
					prev: [8, 33, 37], // backspace, page up, up arrow
					close: [27] // escape key
				 },
				
				helpers : { 
					thumbs : {
						width  : 50,
						height : 50
					 },
					overlay : {
						opacity : 0.8
					 }
				 }
			 });
			
		if (!logged_in){
				
			var message_one = \'';  echo $this->_tpl_vars['sm']['msg_arr'][0];  echo '\';
			var link_one = \'';  echo $this->_tpl_vars['sm']['link_arr'][0];  echo '\';
			
			var message_two = \'';  echo $this->_tpl_vars['sm']['msg_arr'][1];  echo '\';
			var link_two = \'';  echo $this->_tpl_vars['sm']['link_arr'][1];  echo '\';
			
			var message_three = \'';  echo $this->_tpl_vars['sm']['msg_arr'][2];  echo '\';
			var link_three = \'';  echo $this->_tpl_vars['sm']['link_arr'][2];  echo '\';
			
			var icon_arr = new Array();
			icon_arr = ';  echo $this->_tpl_vars['sm']['icon_arr'];  echo ';
			
			var title_arr = new Array();
			title_arr = ';  echo $this->_tpl_vars['sm']['title_arr'];  echo ';

		
			$(\'#nlu_message_one\').append(\'<a class="meme_gallery" data-fancybox-group="thumb" href="http://localhost/image/orig/meme/\'+link_one+\'" title="\'+message_one+\'"><img src="http://localhost/image/orig/meme/\'+link_one+\'" style="cursor:pointer;width: 210px; height: 170px; "/></a>\');
			
			$(\'#blurb_one\').html(\'<a class="meme_gallery" data-fancybox-group="thumb" href="http://localhost/image/orig/meme/\'+link_one+\'" title="\'+message_one+\'">\'+message_one+\'</a>\');
			
			$(\'#nlu_message_two\').append(\'<a class="meme_gallery" data-fancybox-group="thumb" href="http://localhost/image/orig/meme/\'+link_two+\'" title="\'+message_two+\'"><img src="http://localhost/image/orig/meme/\'+link_two+\'" style="cursor:pointer; width: 210px; height: 170px; "/></a>\');
			
			$(\'#blurb_two\').html(\'<a class="meme_gallery" data-fancybox-group="thumb" href="http://localhost/image/orig/meme/\'+link_two+\'" title="\'+message_two+\'">\'+message_two+\'</a>\');
			
			$.each(icon_arr, function(index, value){
				//temporary remover 
				if (index < 55){
					$(\'#icon_container\').append(\'<div class="front_icon" id="icon_\'+index+\'"><a class="meme_gallery" data-fancybox-group="thumb" href="http://localhost/image/orig/meme/\'+value+\'" title="\'+title_arr[index]+\'"><img src="http://localhost/image/orig/meme/\'+value+\'" style="cursor:pointer; width: 40px; height: 40px; "/></a></div>\');
				 }
			 });
		 }		

			$("#last_id_meme").val("';  echo $this->_tpl_vars['sm']['last_id_meme'];  echo '");
			
			var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
			
			
			$("#rand_id_memes").val("';  echo $this->_tpl_vars['sm']['id_memes'];  echo '");
			
			$("#last_id_meme_cur_page").val("';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '");
		
			if (logged_in){
				get_all_flag_details(1);
				setInterval("get_all_flag_details()",6000);
			 }
			
			var srch_uname = "';  echo $_REQUEST['muname'];  echo '";
			var srch_title = "';  echo $_REQUEST['mtitle'];  echo '";
			
			for(var i = 1; i < page_row + 1; i++) {
				$(\'#pagingcount\').append(\'<span id="page\'+i+\'"><a href="javascript:void(0);" onclick="paging_func(\'+i+\');">\'+i+\'</a></span> \');
			 }
			
			$(\'#pagenext\').html(\'<a href="javascript:void(0);" onclick="paging_func(-2);">  Next</a>\');
			
			$("#page"+1).css({\'font-weight\' : \'bolder\' });
			backup_page_no = 1;
			
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
     });
    
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
    function blink_according_to(first,then,hrc){
	for(j in hrc){
	    val = hrc[j][\'caption\'];
	    $("#hrc"+j).html(val);
	 }
	for(i in first){
	    if(then[i][\'tot_reply\']!=first[i][\'tot_reply\']){
		if($("#is_replied"+first[i][\'id_meme\']).val()==\'\'){
		    $("#repl"+first[i][\'id_meme\']).html(then[i][\'tot_reply\']);
		    common_fun(first[i][\'id_meme\'],reply_color);
		 }
		    $("#is_replied"+first[i][\'id_meme\']).val("");
	     }

	    if(then[i][\'tot_caption\']!=first[i][\'tot_caption\']){
		    $("#capt"+first[i][\'id_meme\']).html(then[i][\'tot_caption\']);
		    common_fun(first[i][\'id_meme\'],addcaption_color);
	     }

	    if(then[i][\'tot_honour\']!=first[i][\'tot_honour\']){
		if($("#is_agreed"+first[i][\'id_meme\']).val()==\'\'){
		    $("#aggr"+first[i][\'id_meme\']).html(then[i][\'tot_honour\']);
		    common_fun(first[i][\'id_meme\'],honour_color);
		 }
		    $("#is_agreed"+first[i][\'id_meme\']).val("");
	     }

	    if(then[i][\'tot_dishonour\']!=first[i][\'tot_dishonour\']){
		if($("#is_disagreed"+first[i][\'id_meme\']).val()==\'\'){
		    $("#disaggr"+first[i][\'id_meme\']).html(then[i][\'tot_dishonour\']);
		    common_fun(first[i][\'id_meme\'],dishonour_color);
		 }
		    $("#is_disagreed"+first[i][\'id_meme\']).val("");
	     }
	    
	 }
	first_id = after_5sec;
     }

/* Fade out color after agree/disagree */
    function common_fun(id,color_code){
		$("#meme"+id).effect("highlight", {color:color_code }, 1500);
     }

/* Expand replies after reply button is pressed on the meme */
    function get_all_replies(id){
		var url = "http://localhost/meme/get_all_replies";
		$.post(url,{id:id,ce:0 }, function(res){
			$("#send_reply"+id).html(res);
			
			/* If caption is up, swap */
			if(!$("#add_caption"+id).is(":hidden"))
				$(\'#add_caption\'+id).slideToggle(\'slow\');
			$(\'#send_reply\'+id).slideToggle(\'slow\');
		 });
     }
    
    function get_captions(id){
	var url = "http://localhost/caption/add_caption";
	$.post(url,{id:id,ce:0 }, function(res){
	        $("#add_caption"+id).html(res);
	    if(!$("#send_reply"+id).is(":hidden"))
		$(\'#send_reply\'+id).slideToggle(\'slow\');
		$(\'#add_caption\'+id).slideToggle(\'slow\');
	 });
     }
    
    function chk_forclear(id){
	if($(\'#rpl_con\'+id).val() == "Reply with answer.")
	    $(\'#rpl_con\'+id).val(\'\');
     }

	function strip(html)
	{
	   var tmp = document.createElement("DIV");
	   tmp.innerHTML = html;
	   return tmp.textContent||tmp.innerText;
	 }

    function post_reply(id){
		if($("#rpl_con"+id).val()=="" || $("#rpl_con"+id).val()=="Reply with answer."){
	    	 $("#rpl_con"+id).val("If an empty reply is posted but no one is around to see it, did it ever exist?");
	    	 return false;
		 }
	    
		if($("#rpl_con"+id).val().length < 10){
			$("#validateCharacter"+id).html(\'Herp Derp\');
			return false;
		 }
		
	   if (logged_in) { 
			/* $("#send_reply"+id).hide("slow",function(){ }); */
			var url = "http://localhost/meme/answer_to_meme";
			var reply = strip(($("#rpl_con"+id).val()).trim());
			
			$.post(url,{answer:reply,id:id,ce:0 },function(res){
			    $("#rpl_con"+id).val(\'\'); 
			    $("#is_replied"+id).val(\'1\'); 
			    $("#repl"+id).html(res);
			    common_fun(id,reply_color);
			 });
		
			var url = "http://localhost/meme/get_all_replies";
			$.post(url,{id:id,ce:0 }, function(res){
				$("#send_reply"+id).html(res);
			 });
		
    	 } else {
    		alert("Sorry! Please log in to reply.");
    	 }
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
		var url="http://localhost/meme/meme_details/ce/0/id/"+id_meme;
		$.post(url,{meme:meme_details,ce:0,id:id_meme });
     }
	
    function flagging(id_meme){
	var flaged_bfr=0;
	var url = "http://localhost/meme/flagging_meme";
	$.ajax({
	    type: "POST",
	    url: url,
	    async:false,
	    data: {ce:0,chk:\'1\',id:id_meme } ,
	    dataType: "json",
	    success: function(msg) {
		flaged_bfr = (parseInt(msg))?1:0;
	     }
	 });
	if(flaged_bfr){
		alert("You have already flagged the meme.");
		return false;
	     }else{
		var fg = confirm("Are you sure ?\\nIf you flag , it may lead your account to be frozened or deleted");
		if(fg)
		    $.post(url, {ce:0,id:id_meme },function(data){
			alert("You have successfully flagged the meme.");
		     }); 
	     }
     }
	
	function diff_feed(ext, ajax){
		var url = "http://localhost/meme/meme_list";
		$.post(url,{cat:\'main_feed\',ce:0,ext:ext }, function(res){
			if(res != "")
				$(\'#all_memes\').html(res);
		 });
	 }
	
	
    $(document).ready(function(){
    	// Search function
		//$("#muname").autocomplete(\'http://localhost/index.php?page=meme&choice=auto_comp&ce=0\',{
		//    delay: 500
		// });
		$("#mtitle").autocomplete(\'http://localhost/index.php?page=meme&choice=auto_comp&flg=1&ce=0\',{
		    delay: 500
		 });

		// jQuery CSS change for Live and Network feed
		//$(\'#tab div\').mouseover(function(){
		//	if($(this).hasClass(\'selected\'));
		//	else
		//		$(this).removeClass(\'unselected\').addClass(\'hover\');
		// }).mouseout(function(){
		//	if($(this).hasClass(\'selected\'));
		//	else
		//	$(this).removeClass(\'hover\').addClass(\'unselected\');
		// });
     });
</script>
'; ?>

<input type="hidden" name="last_id_meme_cur_page" id="last_id_meme_cur_page" value=''/>

<input type="hidden" name="rand_id_memes" id="rand_id_memes" value=''/>
<input type="hidden" name="chk_me" id="chk_me" value=''/>
<input type="hidden" name="last_id_meme" id="last_id_meme" value=''/>

<?php if ($_SESSION['id_user'] || $_SESSION['profile']): ?>
<div>
	<div class="fltlft <?php if ($_REQUEST['ext'] == '1'): ?>unselected<?php else: ?>selected<?php endif; ?>">
		<a href="javascript:void(0);" onclick="diff_feed(0);">WORLD FEED</a>
	</div>
	<div class="fltlft <?php if ($_REQUEST['ext'] == '1'): ?>selected<?php else: ?>unselected<?php endif; ?>">
		<a href="javascript:void(0);" onclick="diff_feed(1);">FRIENDS FEED</a>
	</div>
</div>

<!-- Muaz remove this later when styling -->
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

<?php if (! $this->_tpl_vars['sm']['is_search']): ?>
<div style="text-align:center">
	<span id="pageprev"></span>
	<span id="pagingcount" ></span>
	<span id="pagenext"></span>
</div>
<?php endif; ?>

<div id="loadingmeme_img" style="margin-left: 41%; display:none;">
    <img src="http://localhost/templates/images/loading.gif" />
</div>

<?php endif; ?>

<?php if (! $_SESSION['id_user'] && ! $_SESSION['profile']): ?>

	<div id="icon_container"></div>
	<div class="module_text" id="front_card">Your stories belong here.</div>
	<div class="module_text" id="first_half">Whether it's...</div>
	<div id="module_container">
		<div id="message_container">
			<div id="nlu_message_one"><span class="blurb" id="blurb_one"></span></div>
			<div id="nlu_message_two"><span class="blurb" id="blurb_two"></span></div>
			<div id="nlu_message_three"><span class="blurb" id="blurb_three"><a href="javascript:void(0);" onclick="get_random_meme();">Surprise Me!</a></span><a href="javascript:void(0);"><img src="http://localhost/image/questions.jpg" onclick="get_random_meme();" style="cursor:pointer; width: 210px; height: 170px; "/></a></div>
		</div>
		<div class="module_text" id="second_half">...Memeja helps you share experiences with the people you care about.</div>
	</div>
<?php endif; ?>