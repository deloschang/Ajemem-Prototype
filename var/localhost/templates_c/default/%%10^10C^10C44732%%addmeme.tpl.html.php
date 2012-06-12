<?php /* Smarty version 2.6.7, created on 2012-06-12 05:25:16
         compiled from meme/addmeme.tpl.html */ ?>

<!-- Template: meme/addmeme.tpl.html Start 12/06/2012 05:25:16 --> 
 <!-- 
     Commented by Muaz :D
	 Presenting the Memeja Editor
-->

<div id="showmodal" class="showmodal"><em><strong><center>ENTERING MEMEJA DOJO</center></strong></em></div>

<script type="text/javascript">
    var last_comic="http://localhost/spad/workspace/<?php echo $_SESSION['id_user']; ?>
_img.png";
    var LBL_SITE_URL="http://localhost/";
</script>
<script type="text/javascript" src="http://localhost/spad/jquery.mousehold.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type="text/javascript" src="http://localhost/spad/scratchpad.js"></script>
<script type="text/javascript" src="http://localhost/spad/jquery.jqDock.min.js"></script>
<script type="text/javascript" src="http://localhost/spad/color/colorpicker.js"></script>


<link rel="stylesheet" type="text/css" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/themes/ui-lightness/jquery-ui.css" />
<link type="text/css" href="http://localhost/spad/css/colorpicker.css" rel="stylesheet" />
<link rel="stylesheet" href="http://localhost/spad/css/spad.css" type="text/css"/>
<script type="text/javascript" src="http://localhost/templates/flexyjs/js/jquery.multiautocomplete.js"></script>
<link rel="stylesheet" type="text/css" href="http://localhost/templates/css_theme/multiautocomplete.css"/>
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY')); ?>
<?php echo '
<script type="text/javascript">

	var mycanvas, cntx;
	var count = 0;
        	
	function title_focus() {
        b_titlefocus = true;
     }
	
    function title_blur() { b_titlefocus = false;  }
    
    function cancel_meme(){
	window.location="http://localhost/user/user_home";
     }
    function get_premade_images(obj){
        var cat=obj.value;
        if(cat==\'\')
            return false;
        var url = "http://localhost/meme/get_premade_images";
        $.post(url,{id_category:cat,ce:0 }, function(res){
            $("#premade_img").html(res);
         });
     }
	function insertMark()
	{
		//var jg = new jsGraphics("memejimark");    // Use the "Canvas" div for drawing 
		//jg.setColor("white");
		//var ctx = document.getElementById("memejimark").canvas.getContext("2d");
				
		var wm=$("#memejimark");
        var paddings=2.5;
		var x=mycanvas.width-wm.width()-paddings;
        var y=mycanvas.height-wm.height()-paddings;
		count++;
		if(count % 2 == 1)
			cntx.drawImage(wm[0],x,y,wm.width(),wm.height());
		else
		{
			var ctx = document.getElementById(\'removewater\');
			cntx.drawImage(ctx,x,y,wm.width(),wm.height())
		 }
	 }

    function validate_me(){
        obj=document.getElementById(\'ques_ans\');
        if($(obj.title).val()==\'\') {
            alert("Enter The Title");
            $(obj.title).focus();
            return false;
         }
		
		if($(obj.title).val().length>80) {
            alert("Enter a shorter title");
            return false;
         }

        if($(obj.see_fr).val()==""){
            alert("Choose Who Can See?");
            $(obj.see_fr).focus();
            return false;
         }
        if($(obj.friends).val()==""){
            alert("Choose Who Can Comment?");
            $(obj.friends).focus();
            return false;
         }
        if($(obj.meme_cat).val()==\'\'){
            alert("Choose One Category");
            $("#meme_cat").focus();
            return false;
         } else {
        
		if(!$("#tag").val())
		{
			/*  Uncomment and comment out var conf=true once the tagging system is implemented. 
				Allows users to submit memes without choosing if they have to tag a friend or not. 
			*/
			
			var conf=confirm("Are you sure you don\'t want to tag your friends?");
			//var conf=true;
			if(conf)
			{
				$(window).unbind();
				submit_memeje();
			 }
			else
			{
				return false;
			 }
		 }
		else{
			$(window).unbind();
			submit_memeje();
		 }
         }
     }
	$(window).bind(\'beforeunload\', function() {
            return \'Oh NO! Your meme has not been submitted!\';
     }); 

</script>
'; ?>

<?php if ($this->_tpl_vars['sm']['idq']): ?>
<center><b>Answering to the Question</b></center><br/>
<?php endif; ?>
<input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION['id_user']; ?>
"/>
<img src="http://localhost/spad/Memeja Watermark2.png" id="removewater" style="display:none">

<form method="post" action="http://localhost/meme/meme_insert" enctype="multipart/form-data" name="ques_ans" id="ques_ans">
        <?php if ($this->_tpl_vars['sm']['idq']): ?>
        <input type="hidden" name="meme[id_question]" id="id_question" value="<?php echo $this->_tpl_vars['sm']['idq']; ?>
"/>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['sm']['duel']): ?>
        <input type="hidden" name="meme[duel]" id="duel" value="<?php echo $this->_tpl_vars['sm']['duel']; ?>
"/>
        <?php endif; ?>
        
			<div id="canvas">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/meme_editor.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
			</div>			
		
		<div id="shares">
			<div id="tagline">Tag Your Friends!</div>
			 <select id="tag" multiple="multiple" style="display: none;" name="tagged_user[]"></select>
		</div>
		
        <input type="hidden" id="edited_img" name="meme[image]" value="<?php echo time(); ?>
_draw.png"/>
		

</form>
<?php echo '
	<script type="text/javascript">
 		$(document).ready(function(){
			var url = "http://localhost/index.php?page=user&choice=getfriends4tag&flg=1&ce=0";			
			$("#tag").autocomplete({json_url:url,height:6 });
			
		 });

	</script>
'; ?>

<!-- Template: meme/addmeme.tpl.html End --> 