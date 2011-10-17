<?php /* Smarty version 2.6.7, created on 2011-10-14 23:37:10
         compiled from manage/my_meme_details.tpl.html */ ?>

<!-- Template: manage/my_meme_details.tpl.html Start 14/10/2011 23:37:10 --> 
 <?php echo '
<style type="text/css">
.meme{
	background: gainsboro;
	width:60%;
	height:auto;
 }
</style>
<script type="text/javascript">
    $(document).ready(function(){
	$("#last_idmeme_page").val("';  echo $this->_tpl_vars['sm']['last_res_id_meme'];  echo '");
	$(window).scroll(function(){
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		      if($("#last_idmeme_page").val()!=""){
			      if($("#chk_me").val()==\'\'){
				  $("#chk_me").val(1);
				  loadmorememe($("#last_idmeme_page").val());
			       }
		       }
		 }
	  });
     });
    function loadmorememe(last_id){
	$("#loadingmeme_img").show();
	var flg="';  echo $this->_tpl_vars['sm']['flg'];  echo '";
	if(flg==1){
		var url = "http://memeja.com/manage/my_favorites";
	 }else if(flg==2){
		var url = "http://memeja.com/manage/tagged_meme";
	 }else{
		var url = "http://memeja.com/manage/my_favorites";
	 }
	$.post(url,{ce:0,last_id:last_id }, function(res){
	    $("#loadingmeme_img").hide();
	    if(res!="")
		$("#all_my_memes").append(res);
	 });
     }
    function get_all_replies(id){
	var url = "http://memeja.com/meme/get_all_replies";
	$.post(url,{id:id,ce:0 }, function(res){
		$("#send_reply"+id).html(res);
		if(!$("#add_caption"+id).is(":hidden"))
		    $(\'#add_caption\'+id).slideToggle(\'slow\');
		$(\'#send_reply\'+id).slideToggle(\'slow\');
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
	var url = "http://memeja.com/meme/answer_to_meme";
	$.post(url,{answer:$("#rpl_con"+id).val(),id:id,ce:0 },function(res){
	    $("#rpl_con"+id).val(\'\');
	    $("#is_replied"+id).val(\'1\');
	    $("#repl"+id).html(res);
	 });
     }
    function set_tot_adaggr(id,con){
	var url = "http://memeja.com/meme/set_adaggr";
	$.post(url,{id_meme:id,ce:0,con:con },function(res){
	    if(res[0]!=0){
		    if(res[1]==1){
			$("#aggr"+id).html(res[0]);
			$("#is_agreed"+id).val(\'1\');
		     }else{
			$("#disaggr"+id).html(res[0]);
			$("#is_disagreed"+id).val(\'1\');
		     }
	     }else
		   alert("You have already voted.");
	 },"json");
     }
    function show_details(id_meme){
	$.fancybox.showActivity();
	var url="http://memeja.com/meme/meme_details/ce/0/id/"+id_meme;
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
    function get_captions(id){
	var url = "http://memeja.com/caption/add_caption";
	$.post(url,{id:id,ce:0 }, function(res){
	        $("#add_caption"+id).html(res);
	    if(!$("#send_reply"+id).is(":hidden"))
		$(\'#send_reply\'+id).slideToggle(\'slow\');
	    $(\'#add_caption\'+id).slideToggle(\'slow\');
		
	 });
     }
    function flagging(id_meme){
	var flaged_bfr=0;
	var url = "http://memeja.com/meme/flagging_meme";
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
</script>
'; ?>

<input type="hidden"  id="chk_me" value=''/>
<input type="hidden" id="last_idmeme_page" value="<?php echo $this->_tpl_vars['sm']['last_res_id_meme']; ?>
"/>
<div id="all_my_memes">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "manage/loadmore_my_meme.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="loadingmeme_img" style="display:none;">
    <img src="http://memeja.com/templates/images/loading.gif" />
</div>

<!-- Template: manage/my_meme_details.tpl.html End --> 