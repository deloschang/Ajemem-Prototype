<?php /* Smarty version 2.6.7, created on 2012-04-05 10:44:13
         compiled from meme/addmeme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'meme/addmeme.tpl.html', 218, false),)), $this); ?>

<!-- Template: meme/addmeme.tpl.html Start 05/04/2012 10:44:13 --> 
 <!-- 
     Commented by Muaz :D
	 Presenting the Memeja Editor
-->
<?php $this->assign('macromeme_category', $this->_tpl_vars['util']->get_values_from_config('MACROMEME_CATEGORY')); ?>
<div id="showmodal" class="showmodal"><em><strong><center>ENTER MEMEJA DOJO</center></strong></em></div>

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

        var macroMemeOptions = {
            \'option_macromeme\' : \'Select Macromeme\',
            \'forever_alone\' : \'Forever Alone\',
            \'futurama_fry\' : \'Futurama Fry\',
            \'good_guy_greg\' : \'Good Guy Greg\',
            \'i_dont_always\' : \'I Dont Always\',
            \'insanity_wolf\' : \'Insanity Wolf\'
         };
    function selectMacromeme()
    {
        console.log("Inside selectMacromeme...");
     }
    function showMacromemeEditor()
    {
		var macromeme_checked = document.getElementById(\'macromeme_checkbox\').checked;
		hideShow("macromeme_select");
        hideShow("img_dpw");
		if(macromeme_checked == true)
			confirm("WARNING: Your current meme creation will be lost. Is that okay?");
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

    function hideShow(id)
    {
        var es;
        if ( document.getElementById
            && (es = document.getElementById(id))
            && (es = es.style))
        {
            es.display = (\'none\' == es.display)? \'\' : \'none\';
         }
     }

    function validate_me(){
        obj=document.getElementById(\'ques_ans\');
        if($(obj.title).val()==\'\')
		{
            alert("Enter The Title");
            $(obj.title).focus();
            return false;
         }
		if($(obj.title).val().length>80)
		{
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
         }else{
        
		if(!$("#tag").val())
		{
			/* Godzilla: Uncomment var conf=true once the tagging system is implemented. 
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
    <div align="center">
        <?php if ($this->_tpl_vars['sm']['idq']): ?>
        <input type="hidden" name="meme[id_question]" id="id_question" value="<?php echo $this->_tpl_vars['sm']['idq']; ?>
"/>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['sm']['duel']): ?>
        <input type="hidden" name="meme[duel]" id="duel" value="<?php echo $this->_tpl_vars['sm']['duel']; ?>
"/>
        <?php endif; ?>
        <div>
            <span><b>Title:</b></span>
            <span>
                <input type="text" name="meme[title]" id="title" size="50" onfocus="title_focus()" onblur="title_blur()"/>
            </span>
        </div></br>
        <div id="edtr">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/meme_editor.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            <div class="right_pos_abs">
                <table><!--
				    <tr>
                        <td valign='top'><b>Tag your friends:</b></td>
                        <td><select multiple="multiple" style="display: none;" id="tag" name="tagged_user[]"></select></td>
                    </tr>
                    <tr>
                        <td valign='baseline'><b>Visibility:</b>
                            <select id="see_fr" name="meme[can_all_view]">
                                <option value="1" selected = "selected">Everyone</option>
                                <option value="0">Friends Only</option>
                            </select>
                            <!--
                        </td>
					</tr>
					<tr>
                        <td valign='baseline' ><b>Who Comments:</b>-->
                        <!--
                            <select id="friends" name="meme[can_all_comment]" >
                                <option value="1" selected = "selected">Everyone</option>
                                <option value="0">Friends Only</option>
                            </select>
                            -->
                            <!--
                        </td>
                    </tr>
					<!-- Commented out since we are contemplating having categories
                    <tr>
                        <td valign='top'><b>Meme Category:</b></td>
                        <td>
                            <select id="meme_cat" name="meme[category]">
                                <option value=''>--Select--</option>
				       <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['category']), $this);?>

                            </select>
                        </td>
                    </tr>
					-->
					<tr>
                        <td align='center'>&nbsp; <!--<input type="button" value="Cancel" id="cancel" onclick="cancel_meme();"/> -->
						</td>
                    </tr>
                </table>
            </div>


       <!-- <div style="position:fixed;bottom:35px; left:400px"><input type="checkbox" id="macromeme_checkbox" name="macromeme_checkbox" value="" onclick="showMacromemeEditor();"/> Click Here to Make a Macromeme!</div>
        -->
		<div style="position:fixed;bottom:35px;left:500px">
            <select id="macromeme_select" style="display:none" onChange="setOptions(this);">
                <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['macromeme_category']), $this);?>

            </select>
        </div>


          <div style="position:fixed;bottom:35px;left:700px"><input type="button" value="Submit" onclick="validate_me();"/></div>
        <script language = "Javascript">
		
		</script>
		
		<div style="position:fixed;bottom:35px; left:800px"><input type="checkbox" name="memejimark" value="" onclick="insertMark();"/> Watermark</div>
		<!--<div style="position:fixed;bottom:35px; left:200px"><input type="button" value="Click to Make Macromemes!" onClick="validate_me();"/> -->
		<!-- onClick="validate_me();" -->
		</div>
        <input type="hidden" id="edited_img" name="meme[image]" value="<?php echo time(); ?>
_draw.png"/>
</form>
<?php echo '
	<script typ="text/javascript">
 		$(document).ready(function(){
		var url = "http://localhost/index.php?page=user&choice=getfriends4tag&flg=1&ce=0";
			$("#tag").autocomplete({json_url:url,height:6 });
		 });

	</script>
'; ?>

<!-- Template: meme/addmeme.tpl.html End --> 