<?php /* Smarty version 2.6.7, created on 2011-10-15 16:54:12
         compiled from caption/add_caption.tpl.html */ ?>

<!-- Template: caption/add_caption.tpl.html Start 15/10/2011 16:54:12 --> 
 <?php echo '
    <script type="text/javascript">
	var flag_post =0;
	$(document).ready(function(){
	     $("#last_caption_id_page").val("';  if ($this->_tpl_vars['sm']['last_id']):  echo $this->_tpl_vars['sm']['last_id'];  else: ?>-1<?php endif;  echo '");
	     $("#last_caption_id").val("';  if ($this->_tpl_vars['sm']['lst_cap']):  echo $this->_tpl_vars['sm']['lst_cap'];  else: ?>-1<?php endif;  echo '");
	     $("#chk").val("';  echo $this->_tpl_vars['sm']['last_id'];  echo '");
	    setInterval("get_all_time()",7000);
	    $("#caption").keyup(function (){
		($("#caption").val()!=\'\')?$("#msg").html(""):$("#msg").html("Please add a caption");
	     });
	    /*$(window).scroll(function(){
	    var last_id_cap = $("#last_caption_id_page").val();
	    var id_meme = "';  echo $this->_tpl_vars['sm']['id'];  echo '";
		if  ($(window).scrollTop() == $(document).height() - $(window).height()){
		    if($("#last_caption_id_page").val()!="-1"){
			 if($("#chk").val()!=1){
			    loadmore(id_meme,last_id_cap);
			    $("#chk").val("");
			  }
		     }
		 }
	     });	*/    
	 });
	function caption_post(id){
		var fg = checkcaption(id);
		if(fg){
		   var caption = $("#caption"+id).val();
		   var url = "http://www.memeja.com/caption/insert_caption";
		   $("#caption"+id).val(\'\');
		   $("#loading"+id).show();
		   $.post(url,{id_meme:id,ce:0,caption:caption },function(res){
		       flag_post=1;
		       $("#loading"+id).hide();
		       $("#all_captions"+id).prepend(res);
		    });
		 }else{
		    return false;
		 }
	 }
	function checkcaption(id){
	    var flag = ($("#caption"+id).val())?true:false;
	    if(!flag)
		$("#msg"+id).html("Please add a caption");
	    return flag;
	 }
	 function loadmore(id_meme,id_last_cap){
	    var url = "http://www.memeja.com/caption/add_caption";
		   $("#loading_img").show();
		   $.post(url,{id_meme:id_meme,ce:0,id_cap:id_last_cap },function(res){
		       $("#loading_img").hide();
		       if(res!=\'\'){
			   $("#all_captions").append(res);
		        }
		    });
	 }
	function close_me(id){
	    $("#add_caption"+id).slideToggle();
	 }
	function get_all_time(){
			   var id_cap = $("#last_caption_id_page").val();
			   var id_meme = "';  echo $this->_tpl_vars['sm']['id'];  echo '";
			   var last_cap = $("#last_caption_id").val();
			   //alert(id_cap+"--"+id_meme+"--"+last_cap);
			   var url = "http://www.memeja.com/caption/get_all_time";
			   $.post(url,{id_meme:id_meme,ce:0,id_cap:id_cap,last_cap:last_cap },function(data){
				   if(data[0]){
				       if(!flag_post)
					    $("#all_captions").prepend(data[0]);
					if(id_cap=="-1")
					    $("#last_caption_id_page").val(data[3]);
					$("#last_caption_id").val(data[2]);
				    }
				   if(data[1]){ 
				       var temp = data[1];
				       for(var i=0;i<temp.length;i++){//alert(temp[i][\'tot_dishonour\']);
					   $("#sp"+temp[i][\'id_caption\']).html(temp[i][\'timesago\']);
					   $("#hnr"+temp[i][\'id_caption\']).html(temp[i][\'tot_honour\']);
					   $("#dishnr"+temp[i][\'id_caption\']).html(temp[i][\'tot_dishonour\']);
					 }
				    }
			    },"json");
	 }
	
	function set_hnrdishnr(obj,id_cap){
		var url = "http://www.memeja.com/caption/update_hnr_dishnr";
		var id_meme = "';  echo $this->_tpl_vars['sm']['id'];  echo '";
		var id_cap = id_cap; 
		var flag = $(obj).val();
		$.post(url,{id:id_meme,flag:flag,id_cap:id_cap,ce:0 },function(res){
		    if(res[0]!=0){
			if(res[1]==1)
			    $("#hnr"+id_cap).html(res[0]);
			else
			    $("#dishnr"+id_cap).html(res[0]);
		     }else
			alert("You have already voted.");
		 },"json");
	 }
    </script>
    <style type="text/css">
	.iden{
	   background: black;
	   color: white;
	   border:none;
	   cursor: pointer; 
	 }
	input {
	    cursor: pointer;
	 }
	textarea{
	    height: 50px;
	    width: 90%;
	 }
    </style>
'; ?>

<div align="center" >
    <br />
    <input type="hidden" id="last_caption_id_page" />
    <input type="hidden" id="last_caption_id" />
    <input type="hidden" id="chk" />
    <div style="width: 80%;height: auto;" >
	<span style="font-weight: lighter;font-size: 8pt;">POST A CAPTION</span>
	<div style="float:right;margin-right: 25px;cursor:pointer;" onClick="close_me('<?php echo $this->_tpl_vars['sm']['id']; ?>
');">
	    <img src="http://www.memeja.com/spad/site_image/delete.png" title="Close"/>
	</div>
	<span style="float:left;" id="msg<?php echo $this->_tpl_vars['sm']['id']; ?>
"></span>
	<textarea  name="caption" id="caption<?php echo $this->_tpl_vars['sm']['id']; ?>
"></textarea>
	<br/>
	<input  class="iden"  type="button" value="Post" onclick="caption_post('<?php echo $this->_tpl_vars['sm']['id']; ?>
');"/>
    </div>
    <br/>
    <div id="loading<?php echo $this->_tpl_vars['sm']['id']; ?>
" style="position:relative;top:-120px;display:none;">
	<img src="http://www.memeja.com/templates/images/loadingAnimation.gif" />
    </div>
    <div id="all_captions<?php echo $this->_tpl_vars['sm']['id']; ?>
">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "caption/loadmore_caption.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <div id="loading_img" style="display:none;">
	<img src="http://www.memeja.com/templates/images/loading.gif" />
    </div>	
</div>

<!-- Template: caption/add_caption.tpl.html End --> 