<?php /* Smarty version 2.6.7, created on 2012-06-04 07:13:00
         compiled from meme/all_top_memelist.tpl.html */ ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  $this->assign('x', $this->_tpl_vars['util']->get_values_from_config('LIVEFEED_COLOR'));  echo '
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
	$(window).scroll(function(){
		if($("#randpgexist").val()=="1"){
			return false;
		 }
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		      if($("#rand_id_memes").val()!=""){
			  if($("#chk_me_oth").val()!=1){
			     backup_rand_id_memes = $("#rand_id_memes").val();
			     loadmorememe(cat,backup_rand_id_memes);
			     $("#rand_id_memes").val("");
			   }
		       }
		 }
	  });
        get_all_top_memes();
     });
    function check_criteria(){
	var cats = get_cats();
	var bst =  $("#bst_of").val();
	var srt = $("#srt").val();

        console.log("TARZAN - bst=["+bst+"], srt=["+srt+"], cats=["+cats+"]");

	if(!cats && !bst){
	    alert("Choose atleast one criteria(Category or Best of).");
	    return false;
	 }else if(!srt){
	    alert("Choose sorting order.");
	    return false;
	 }else{
	    return cats;
	 }
     }
    function get_all_top_memes(){
        var bst = "0";
        var srt = "2";
        var cat = "top";
        var cats = "";
        $("#all_memes").html(\'\');
        $("#all_memes").show();
        $("#lding").show();
        var url = "http://localhost/meme/meme_list";
        $.post(url,{cats:cats,bst:bst,ce:0,cat:cat,srch:1,srt:srt },function(res){
            $("#lding").hide();
            if(res)
                $("#all_memes").html(res);
            else
                $("#all_memes").html("No meme found.");
         });
     }
    function get_top_memes(){
	    var gt = check_criteria();
	     if(gt===false){
		return false;
	      }else{
		cats = gt;
	      }
	     $("#all_memes").html(\'\');
	     $("#all_memes").show();
	     $("#lding").show();
	     var cat = "';  echo $this->_tpl_vars['sm']['cat'];  echo '";
	     var bst = $("#bst_of").val()?$("#bst_of").val():\'\';
	     var srt = $("#srt").val();
	     var url = "http://localhost/meme/meme_list";

        console.log("TARZAN2 - bst=["+bst+"], srt=["+srt+"], cats=["+cats+"], cat=["+cat+"]");

        $.post(url,{cats:cats,bst:bst,ce:0,cat:cat,srch:1,srt:srt },function(res){
		 $("#lding").hide();
		 if(res)
		    $("#all_memes").html(res);
		 else
		    $("#all_memes").html("No meme found.");
	      });
	 }
    function loadmorememe(cat,last_id){
        /***
	var gt = check_criteria();
	    if(gt===false){
		return false;
	     }else{
		cats = gt;
	     }
	var bst = $("#bst_of").val()?$("#bst_of").val():\'\';
	var srt = $("#srt").val()?$("#srt").val():"";
         ***/

        var bst = "0";
        var srt = "2";
        var cat = "top";
        var cats = "";

        $("#loadingmeme_img").show();
	var url = "http://localhost/meme/meme_list";
	$.post(url,{cat:cat,ce:0,last_id:last_id,cats:cats,bst:bst,srt:srt }, function(res){
	    $("#loadingmeme_img").hide();
	    if(res!="")
		$("#all_memes").append(res);
	 });
     }
    function get_cats(){
	var cats = \'\';
	$(".category").each(function(){
		   if($(this).is(":checked")){
		       cats+=$(this).val()+\',\';
		    }
	 });
	return cats;
     }
    function get_all_replies(id){
	var url = "http://localhost/meme/get_all_replies";
	$.post(url,{id:id,ce:0 }, function(res){
	    $("#send_reply"+id).html(res);
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

    function post_reply(id){
	if($("#rpl_con"+id).val()=="" || $("#rpl_con"+id).val()=="Reply with answer."){
	     $("#rpl_con"+id).val("Reply with answer.");
	     return false;
	 }
	$("#send_reply"+id).hide("slow",function(){ });
	var url = "http://localhost/meme/answer_to_meme";
	$.post(url,{answer:$("#rpl_con"+id).val(),id:id,ce:0 },function(res){
	    $("#rpl_con"+id).val(\'\');
	    $("#is_replied"+id).val(\'1\');
	    $("#repl"+id).html(res);
	 });
     }
    function set_tot_adaggr(id,con){
	var url = "http://localhost/meme/set_adaggr";
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
	var url="http://localhost/meme/meme_details/ce/0/id/"+id_meme;
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
</script>
<style type="text/css">
    a{
	text-decoration: none;
	cursor: pointer;
     }
    .meme{
	background: gainsboro;
	width:60%;
	height:auto;
     }
    fieldset{
	width: 50%;
     }
    .cat_text{
	font-size: 16px;
     }
</style>
'; ?>

<input type="hidden" id="randpgexist" value="0">
<input type="hidden" name="rand_id_memes" id="rand_id_memes" value=''/>
<input type="hidden" name="chk_me_oth" id="chk_me_oth" value=''/>
<input type="hidden" name="last_id_meme" id="last_id_meme" value=''/>
        <!--
<div align="center">
    <fieldset>
	<legend class="cat_text">Search</legend>
		<table>
			<tr>
			    <td colspan="2" align="center">
			    <?php if (count($_from = (array)$this->_tpl_vars['category'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
				<input type="checkbox" value="<?php echo $this->_tpl_vars['key']; ?>
" class="category"/><span class="cat_text"><?php echo $this->_tpl_vars['item']; ?>
</span>
			    <?php endforeach; endif; unset($_from); ?>
			    </td>
			</tr>
			<?php if ($this->_tpl_vars['sm']['cat'] == 'top'): ?>
			<tr>
			    <td>
			       <span class="cat_text">Best of :</span>
			    </td>
			    <td>	
			       <select name="bst" id="bst_of">
				   <option value="">--Select--</option>
				   <option value="0">All times</option>
				   <option value="1">Day</option>
				   <option value="30">Month</option>
				   <option value="7">Week</option>	
				   <option value="365">Year</option>	
			       </select>
			    </td>
			</tr>
			<tr>
			   <td>
			    	<span class="cat_text">Sort By :</span>
			   </td>
			   <td>
				<select name="srt" id="srt">
				   <option value="">--Select--</option>
				   <option value="1">Positive Net Honour</option>
				   <option value="2">Most Viewed</option>
				</select>
			   </td>
			</tr>
			<?php endif; ?>
		   	<tr>
				<td colspan="2" align="center"><input type="button" value="Search" onClick="get_top_memes();"/></td>
			</tr>
            <tr>
                <td colspan="2" align="center"><input type="button" value="Top Memes" onClick="get_all_top_memes();"/></td>
            </tr>
        </table>
    </fieldset>
</div><br/>
   --->
<div id="all_memes" style="display:none;">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/loadmore_top_meme.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<div id="loadingmeme_img" style="display:none;">
    <img src="http://localhost/templates/images/loading.gif" />   
</div>