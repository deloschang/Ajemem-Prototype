<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-12 02:02:19
         compiled from meme/addmeme.tpl.html */ ?>

<!-- Template: meme/addmeme.tpl.html Start 12/06/2012 02:02:19 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-11 03:39:50
         compiled from meme/addmeme.tpl.html */ ?>

<!-- Template: meme/addmeme.tpl.html Start 11/06/2012 03:39:50 --> 
>>>>>>> test2
 <!-- 
     Commented by Muaz :D
	 Presenting the Memeja Editor
-->
<<<<<<< HEAD

<div id="showmodal" class="showmodal"><em><strong><center>ENTERING MEMEJA DOJO</center></strong></em></div>
=======
<div id="showmodal" class="showmodal"><em><strong><center>ENTER MEMEJA DOJO</center></strong></em></div>
>>>>>>> test2

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
<?php $this->assign('category', $this->_tpl_vars['util']->get_values_from_config('CATEGORY'));  echo '
<script type="text/javascript">

	var mycanvas, cntx;
	var count = 0;
        	
	function title_focus() {
        b_titlefocus = true;
     }
<<<<<<< HEAD

=======
>>>>>>> test2
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
<<<<<<< HEAD
        if($(obj.title).val()==\'\') {
=======
        if($(obj.title).val()==\'\')
		{
>>>>>>> test2
            alert("Enter The Title");
            $(obj.title).focus();
            return false;
         }
<<<<<<< HEAD
		
		if($(obj.title).val().length>80) {
            alert("Enter a shorter title");
            return false;
         }
		
=======
		if($(obj.title).val().length>80)
		{
            alert("Enter a shorter title");
            return false;
         }
>>>>>>> test2
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
        
<<<<<<< HEAD
			if(!$("#tag").val())
			{
				/* Godzilla: Uncomment and comment out var conf=true once the tagging system is implemented. 
					Allows users to submit memes without choosing if they have to tag a friend or not. 
				*/
				
				//var conf=confirm("Are you sure you don\'t want to tag your friends?");
				var conf=true;
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
=======
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
>>>>>>> test2
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
<<<<<<< HEAD
        
			<div id="canvas">
				<?php $_smarty_tpl_vars = $this->_tpl_vars;
=======
        <div id="memetitle" class="nohighlight">
            <span><b>Title:</b></span>
            <span>
                <input type="text" name="meme[title]" id="title" size="50" onfocus="title_focus()" onblur="title_blur()"/>
            </span>
        </div><br/>
        <div id="edtr"class="nohighlight">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
>>>>>>> test2
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/meme_editor.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<<<<<<< HEAD
			</div>			
		
		<div id="shares">
			<div id="tagline">Tag Your Friends!</div>
			 <select id="tag" multiple="multiple" style="display: none;" name="tagged_user[]"></select>
		</div>
		
=======

	    <table>
			<tr>
                <td valign='top'><b>Tag your friends:</b></td>
                <td><select multiple="multiple" style="display: none;" id="tag" name="tagged_user[]"></select></td>
            </tr>
		</table>
		
        <div id="submitter" ><input type="button" value="Submit" onclick="validate_me();"/></div>
        <script language = "Javascript">
		
		</script>
		
		<div style="position:fixed;bottom:35px; left:800px"><input type="checkbox" name="memejimark" value="" onclick="insertMark();"/> Watermark</div>
		</div>
>>>>>>> test2
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