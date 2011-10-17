<?php /* Smarty version 2.6.7, created on 2011-10-15 16:53:33
         compiled from meme/meme_list.tpl.html */ ?>
<?php $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('LIVEFEED_COLOR'));  echo '
<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
<script type="text/javascript">
    var reply_color = "';  echo $this->_tpl_vars['x']['reply'];  echo '";
    var honour_color = "';  echo $this->_tpl_vars['x']['agree'];  echo '";
    var dishonour_color = "';  echo $this->_tpl_vars['x']['disagree'];  echo '";
    var addcaption_color = "';  echo $this->_tpl_vars['x']['add_caption'];  echo '";
    var first_id,after_5sec=0,backup_rand_id_memes=\'\',backup_last_id_meme=\'\';
    $(document).ready(function(){
	$("#last_id_meme").val("';  echo $this->_tpl_vars['sm']['last_id_meme'];  echo '");
	var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
	$("#rand_id_memes").val("';  echo $this->_tpl_vars['sm']['id_memes'];  echo '");
	$("#last_id_meme_cur_page").val("';  echo $this->_tpl_vars['sm']['last_idmeme'];  echo '");
	    get_all_flag_details(1);
	    setInterval("get_all_flag_details()",4000);
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
			var srch_uname = "';  echo $_REQUEST['muname'];  echo '";
			var srch_title = "';  echo $_REQUEST['mtitle'];  echo '";
		      if($("#last_id_meme_cur_page").val()!=""){
			  if($("#chk_me").val()!=1){
			      backup_last_id_meme = $("#last_id_meme_cur_page").val();
			      loadmorememe(cat,backup_last_id_meme,srch_uname,srch_title);
			      $("#last_id_meme_cur_page").val("");
			   }
		       }
		 }
	  });
     });
    function loadmorememe(cat,last_id,srch_uname,srch_title){
	$("#loadingmeme_img").show();
	var ext = "';  echo $_REQUEST['ext'];  echo '";
	var url = "http://www.memeja.com/meme/meme_list";
	$.post(url,{cat:cat,ce:0,last_id:last_id,muname:srch_uname,mtitle:srch_title,ext:ext }, function(res){
	    $("#loadingmeme_img").hide();
	    if(res!="")
		$("#all_memes").append(res);
	 });
     }
    function get_all_flag_details(timer){
		var last_id_page ;
		var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
		var ext = "';  echo $_REQUEST['ext'];  echo '"
		var last_id = $("#last_id_meme").val();
		last_id_page = $("#last_id_meme_cur_page").val();
		var page_ids = $("#rand_id_memes").val(); 
		var url = "http://www.memeja.com/meme/get_all_flag_details";
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
    function common_fun(id,color_code){
	    $("#meme"+id).css("background",color_code);
	    $("#meme"+id).fadeOut(1200,function(){
		$("#meme"+id).css("background","gainsboro");
		$("#meme"+id).fadeIn(0);
	     });
     }
    function get_all_replies(id){
	var url = "http://www.memeja.com/meme/get_all_replies";
	$.post(url,{id:id,ce:0 }, function(res){
	    $("#send_reply"+id).html(res);
	    if(!$("#add_caption"+id).is(":hidden"))
		$(\'#add_caption\'+id).slideToggle(\'slow\');
	    $(\'#send_reply\'+id).slideToggle(\'slow\');
	 });
     }
    function get_captions(id){
	var url = "http://www.memeja.com/caption/add_caption";
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

    function post_reply(id){
	if($("#rpl_con"+id).val()=="" || $("#rpl_con"+id).val()=="Reply with answer."){
	     $("#rpl_con"+id).val("Reply with answer.");
	     return false;
	 }
	$("#send_reply"+id).hide("slow",function(){ });
	var url = "http://www.memeja.com/meme/answer_to_meme";
	$.post(url,{answer:$("#rpl_con"+id).val(),id:id,ce:0 },function(res){
	    $("#rpl_con"+id).val(\'\');
	    $("#is_replied"+id).val(\'1\');
	    $("#repl"+id).html(res);
	    common_fun(id,reply_color);
	 });
     }
    function set_tot_adaggr(id,con){
	var url = "http://www.memeja.com/meme/set_adaggr";
	$.post(url,{id_meme:id,ce:0,con:con },function(res){
	    if(res[0]!=0){
		    if(res[1]==1){
			$("#aggr"+id).html(res[0]);
			$("#is_agreed"+id).val(\'1\');
			common_fun(id,honour_color);
		     }else{
			$("#disaggr"+id).html(res[0]);
			$("#is_disagreed"+id).val(\'1\');
			common_fun(id,dishonour_color);
		     }
	     }else
		   alert("You have already voted.");
	 },"json");
     }
    function show_details(id_meme){
	$.fancybox.showActivity();
	var url="http://www.memeja.com/meme/meme_details/ce/0/id/"+id_meme;
	var httpRequest = new XMLHttpRequest();
	httpRequest.open(\'POST\', url, false);

	httpRequest.send(); // this blocks as request is synchronous
	if (httpRequest.status == 200) {
		res=httpRequest.responseText;
		$.fancybox(res,{
		    centerOnScroll:true,
		    onComplete : function (){
			$.fancybox.resize();
		     }
		 });
	 }
     }
    function flagging(id_meme){
	var flaged_bfr=0;
	var url = "http://www.memeja.com/meme/flagging_meme";
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
    $(document).ready(function(){
		$("#muname").autocomplete(\'http://www.memeja.com/index.php?page=meme&choice=auto_comp&ce=0\',{
		    delay: 500
		 });
		$("#mtitle").autocomplete(\'http://www.memeja.com/index.php?page=meme&choice=auto_comp&flg=1&ce=0\',{
		    delay: 500
		 });

		// For tab system
		$(\'#tab div\').mouseover(function(){
			if($(this).hasClass(\'selected\'));
			else
				$(this).removeClass(\'unselected\').addClass(\'hover\');
		 }).mouseout(function(){
			if($(this).hasClass(\'selected\'));
			else
			$(this).removeClass(\'hover\').addClass(\'unselected\');
		 });
		// End
     });
</script>
<style type="text/css">
    a{
	text-decoration: none;
	cursor: pointer;
     }
    .meme{
	background: white;  /* background for meme color */
	width:60%;
	height:auto;
     }
    .dec{
	font-size: 12px;
	font-weight: bold;
     }
</style>
<style type="text/css">
	#tab div	{
		margin-right:2px;
		font-weight:bold;
	 }
	.fltlft	{
		float:left;
	 }
	.unselected	{
		background-color:#AAD8F3;
		width:auto;
		height:23px;
		text-align:center;
		padding-top:7px;
	 }
	.hover	{
		background-color:#CAD8F3;
		height:23px;
		width:auto;
		text-align:center;
		padding-top:7px;
	 }
	.selected	{
		background-color:#4D79A6;
		width:auto;
		height:23px;
		text-align:center;
		padding-top:7px;
	 }
	a{
		text-decoration:none;
	 }
	.borderyes	{
		border:#000000 solid 1px;
	 }
</style>
'; ?>

<center>
<fieldset style="width:40%;align:center;">
    <legend><b><h3>Search meme</h3></b></legend>
    <form>
	    <table>
		<tr>
		    <td class="dec">Username:</td>
		    <td><input type="text" name="muname" id="muname" value="<?php echo $_REQUEST['muname']; ?>
"/></td>
		</tr>
		<tr>
		    <td class="dec">Title:</td>
		    <td><input type="text" name="mtitle" id="mtitle" value="<?php echo $_REQUEST['mtitle']; ?>
"/></td>
		</tr>
	    </table>
	<input type="submit" value="Search"/>
    </form>
</fieldset><br/><br/>
</center>
<input type="hidden" name="last_id_meme_cur_page" id="last_id_meme_cur_page" value=''/>
<input type="hidden" name="rand_id_memes" id="rand_id_memes" value=''/>
<input type="hidden" name="chk_me" id="chk_me" value=''/>
<input type="hidden" name="last_id_meme" id="last_id_meme" value=''/>
<div class="fltlft" id="tab">
	<div class="fltlft <?php if ($_REQUEST['ext'] == '1'): ?>unselected<?php else: ?>selected<?php endif; ?>">
		<a href="http://www.memeja.com/meme/meme_list/cat/<?php echo $this->_tpl_vars['sm']['cat']; ?>
" >MAIN LIVE FEED</a>
	</div>
	<div class="fltlft <?php if ($_REQUEST['ext'] == '1'): ?>selected<?php else: ?>unselected<?php endif; ?>">
		<a href="http://www.memeja.com/meme/meme_list/cat/<?php echo $this->_tpl_vars['sm']['cat']; ?>
/ext/1" >NETWORK FEED</a>
	</div>
</div>
<br><br><br>
<div id="all_memes">
    <?php if ($this->_tpl_vars['sm']['res_meme']): ?>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/loadmorememe.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    <?php else: ?>
	<input type="hidden" id="msgexist" value="1">
	No meme found.
    <?php endif; ?>
</div>
<div id="loadingmeme_img" style="display:none;">
    <img src="http://www.memeja.com/templates/images/loading.gif" />
</div>