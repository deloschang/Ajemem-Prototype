<?php /* Smarty version 2.6.7, created on 2011-10-17 20:01:31
         compiled from caption/rand_add_caption.tpl.html */ ?>

<!-- Template: caption/rand_add_caption.tpl.html Start 17/10/2011 20:01:31 --> 
 <?php echo '
    <script type="text/javascript">
	var flag_post =0;
	$(document).ready(function(){
	     $("#rand_last_caption_id_page").val("';  if ($this->_tpl_vars['sm']['last_id']):  echo $this->_tpl_vars['sm']['last_id'];  else: ?>-1<?php endif;  echo '");
	     $("#rand_last_caption_id").val("';  if ($this->_tpl_vars['sm']['lst_cap']):  echo $this->_tpl_vars['sm']['lst_cap'];  else: ?>-1<?php endif;  echo '");
	     $("#rand_chk").val("';  echo $this->_tpl_vars['sm']['last_id'];  echo '");
	    setInterval("rand_get_all_time()",7000);
	    $("#rand_caption").keyup(function (){
		($("#rand_caption").val()!=\'\')?$("#rand_msg").html(""):$("#rand_msg").html("Please add a caption");
	     });
	 });
	function rand_caption_post(id){
		var fg = rand_checkcaption(id);
		if(fg){
		   var caption = $("#rand_caption"+id).val();
		   var url = "http://localhost/caption/insert_caption";
		   $("#rand_caption"+id).val(\'\');
		   $("#rand_loading"+id).show();
		   $.post(url,{id_meme:id,ce:0,caption:caption,flag:\'rand\' },function(res){
		       flag_post=1;
		       $("#rand_capt"+id).html(parseInt($("#rand_capt"+id).html())+1);
		       $("#rand_loading"+id).hide();
		       $("#rand_all_captions"+id).prepend(res);
		    });
		 }else{
		    return false;
		 }
	 }
	function rand_checkcaption(id){
	    var flag = ($("#rand_caption"+id).val())?true:false;
	    if(!flag)
		$("#rand_msg"+id).html("Please add a caption");
	    return flag;
	 }
	function rand_close_me(id){
	    $("#randadd_caption"+id).slideToggle();
	 }
	function rand_get_all_time(){
			   var id_cap = $("#rand_last_caption_id_page").val();
			   var id_meme = "';  echo $this->_tpl_vars['sm']['id'];  echo '";
			   var last_cap = $("#rand_last_caption_id").val();
			   var url = "http://localhost/caption/get_all_time";
			   $.post(url,{id_meme:id_meme,ce:0,id_cap:id_cap,last_cap:last_cap },function(data){
			       if(data[0]){
				   if(!flag_post)
				       $("#rand_all_captions").prepend(data[0]);
					if(id_cap=="-1")
					    $("#rand_last_caption_id_page").val(data[3]);
					$("#rand_last_caption_id").val(data[2]);
				     }
				    if(data[1]){ 
					var temp = data[1];
					for(var i=0;i<temp.length;i++){
					    $("#rand_sp"+temp[i][\'id_caption\']).html(temp[i][\'timesago\']);
					    $("#rand_hnr"+temp[i][\'id_caption\']).html(temp[i][\'tot_honour\']);
					    $("#rand_dishnr"+temp[i][\'id_caption\']).html(temp[i][\'tot_dishonour\']);
					 }
				     }
				 },"json");
	 }
	function rand_set_hnrdishnr(obj,id_cap){
		var url = "http://localhost/caption/update_hnr_dishnr";
		var id_meme = "';  echo $this->_tpl_vars['sm']['id'];  echo '";
		var id_cap = id_cap; 
		var flag = $(obj).val();
		$.post(url,{id:id_meme,flag:flag,id_cap:id_cap,ce:0 },function(res){
		    if(res[0]!=0){
			if(res[1]==1)
			    $("#rand_hnr"+id_cap).html(res[0]);
			else
			    $("#rand_dishnr"+id_cap).html(res[0]);
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

<div align="center">
        <br />
	<input type="hidden" id="rand_last_caption_id_page" />
	<input type="hidden" id="rand_last_caption_id" />
	<input type="hidden" id="rand_chk" />
	<div style="width: 80%;height: auto;" >
	    <span style="font-weight: lighter;font-size: 8pt;">POST A CAPTION</span>
	    <div style="float:right;margin-right: 7px;cursor:pointer;" onClick="rand_close_me('<?php echo $this->_tpl_vars['sm']['id']; ?>
');">
		<img src="http://localhost/spad/site_image/delete.png" title="Close"/>
	    </div>
	    <span style="float:left;" id="rand_msg<?php echo $this->_tpl_vars['sm']['id']; ?>
"></span>
	    <textarea  name="caption" id="rand_caption<?php echo $this->_tpl_vars['sm']['id']; ?>
"></textarea><br/>
		<input  class="iden"  type="button" value="Post" onclick="rand_caption_post('<?php echo $this->_tpl_vars['sm']['id']; ?>
');"/>
	</div><br/>
	<div id="rand_loading<?php echo $this->_tpl_vars['sm']['id']; ?>
" style="position:relative;top:-120px;display:none;"><img src="http://localhost/templates/images/loadingAnimation.gif" /></div>
    <div id="rand_all_captions<?php echo $this->_tpl_vars['sm']['id']; ?>
">
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "caption/rand_loadmore_caption.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
    </div>
    <div id="rand_loading_img" style="display:none;">
	<img src="http://localhost/templates/images/loading.gif" />
    </div>	
</div>

<!-- Template: caption/rand_add_caption.tpl.html End --> 