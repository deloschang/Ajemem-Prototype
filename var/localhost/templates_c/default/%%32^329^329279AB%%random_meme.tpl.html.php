<?php /* Smarty version 2.6.7, created on 2012-07-14 19:51:21
         compiled from meme/random_meme.tpl.html */ ?>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script type="text/javascript">
	var x=0;
    
    function rand_set_tot_adaggr(id,con){
		var url = "http://localhost/meme/set_adaggr";
		
		$.post(url,{id_meme:id,ce:0,con:con },function(res){
			if(res[0]!=0){
				if(res[1]==1){
					$("#randaggr"+id).html(res[0]);
					$("#is_agreed"+id).val(\'1\');
					
					$("#rand_meme_agr_id"+id).effect("highlight", {color:"green" }, 1500);
					
					/* After voting, Highlight Agree + Grey out Disagree */					
						$("#randagr_link"+id).css({"color" : "green", "cursor" : "default" });
						$("#randdisagr_link"+id).css({"color" : "gray", "cursor" : "default" });
				 }else{
					$("#randdisaggr"+id).html(res[0]);
					$("#is_disagreed"+id).val(\'1\');
					
					$("#rand_meme_disagr_id"+id).effect("highlight", {color:"red" }, 1500);
					
					/* After voting, Highlight Disagree + Grey out Agree */
						$("#randdisagr_link"+id).css({"color" : "red", "cursor" : "default" });
						$("#randagr_link"+id).css({"color" : "gray", "cursor" : "default" });
				 }
			 }else
			   //alert("You have already voted.");
			   console.log(\'You have already voted.\');
		 },"json");
     }
	
    function get_all_rand_replies(id){
		var url = "http://localhost/meme/get_all_replies";
		$.post(url,{id:id,ce:0,flag:1 }, function(res){
			$("#randsend_reply"+id).html(res);
			
			/* If caption is up, swap */
			if(!$("#randadd_caption"+id).is(":hidden"))
				$(\'#randadd_caption\'+id).slideToggle(\'slow\');
			$(\'#randsend_reply\'+id).slideToggle(\'slow\');
		 });
     }
        
    function rand_chk_forclear(id){
	if($(\'#rand_rpl_con\'+id).val() == "Reply with answer.")
	    $(\'#rand_rpl_con\'+id).val(\'\');
     }

    function rand_post_reply(id){
		if($("#rand_rpl_con"+id).val()=="" || $("#rand_rpl_con"+id).val()=="Reply with answer."){
			 $("#rand_rpl_con"+id).val("If an empty reply is posted but no one is around to see it, did it ever exist?");
			 return false;
		 }
		
		if($("#rand_rpl_con"+id).val().length < 10){
			$("#validateCharacter"+id).html(\'Herp Derp\');
			return false;
		 }
		
		var url = "http://localhost/meme/answer_to_meme";
		$.post(url,{answer:$("#rand_rpl_con"+id).val(),id:id,ce:0 },function(res){
			$("#rand_rpl_con"+id).val(\'\');
			$("#randrepl"+id).html(res);
			$("#rand_meme_reply_id"+id).effect("highlight", {color:"yellow" }, 1500);
		 });
		
		var url = "http://localhost/meme/get_all_replies";
		$.post(url,{id:id,ce:0 }, function(res){
			$("#randsend_reply"+id).html(res);
		 });
     }
	
    function get_rand_cats(){
		var cats = \'\';
		$(".rand_category").each(function(){
			   if($(this).is(":checked")){
				   cats+=$(this).val()+\',\';
			    }
		 });
		return cats;
     }
    
    // Called when clicking random
    function show_my_details(id_meme){
		var url = "http://localhost/meme/meme_list";
			 $(\'#comc_img\').hide();
			 $("#lding_rand").show();
			 
			 var rnd_cat = get_rand_cats();
			 var rnd_ids=$("#rand_ids").val();
			 
		$.post(url, {last_id:id_meme,ce:0,cat:\'rand\',rand_fg:\'1\',rnd_ids:rnd_ids,rnd_cat:rnd_cat }, function(res){
				if(res){
					$("#rand_meme").html(res);
				 } else {
					$.post(url, {last_id:id_meme,ce:0,cat:\'rand\',rand_fg:\'2\',rnd_cat:rnd_cat }, function(data){
						$("#rand_meme").html(data);
						$("#rand_ids").val("");
					 });
				 }
				$.fancybox.update();
		 });
     }
    
    function load_rand_meme(){
		var url = "http://localhost/meme/meme_list";
		$(\'#comc_img\').hide();
		$("#lding_rand").show();
		
		var rnd_cat = get_rand_cats();
		$("#rand_ids").val(\'\');
		$.post(url, {ce:0,cat:\'rand\',rnd_cat:rnd_cat,last_id:1 }, function(res){
			$("#rand_meme").html(res);
		 });
     }
    
    function get_rand_captions(id){
		var url = "http://localhost/caption/add_caption";
		$.post(url,{id:id,ce:0,flag:\'rand\' }, function(res){
			if(!$("#randsend_reply"+id).is(":hidden"))
			$(\'#randsend_reply\'+id).slideToggle(\'slow\');
			$("#randadd_caption"+id).html(res);
			$(\'#randadd_caption\'+id).slideToggle(\'slow\');
			
		 });
     }
	
    function rand_flagging(id_meme){
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
		 } else {
			var fg = confirm("Are you sure ?\\nIf you flag , it may lead your account to be frozened or deleted");
			if(fg)
				$.post(url, {ce:0,id:id_meme },function(data){
				alert("You have successfully flagged the meme.");
				 }); 
		 }
     }
</script>
'; ?>


<center>
    <label id="random_title" style="font-size: 16px;font-weight:bold;"></label>
    <div>by <span id="random_username"></span></div>
</center>

<!-- Commenting out categories 
<center>
    <label style="font-size: 16px;font-weight:bold;">Check off the categories.</label>
<div>
	    <?php if (count($_from = (array)$this->_tpl_vars['category'])):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
		<input type="checkbox" value="<?php echo $this->_tpl_vars['key']; ?>
" class="rand_category" onClick="load_rand_meme();"/><span class="cat_text"><?php echo $this->_tpl_vars['item']; ?>
</span>
	    <?php endforeach; endif; unset($_from); ?>
</div><br/>
</center>
-->

<div>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/loadmore_rand_meme.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
</div>
<input type="hidden" id="rand_ids" />