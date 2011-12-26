<?php /* Smarty version 2.6.7, created on 2011-12-26 12:26:45
         compiled from meme/meme_editor.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'meme/meme_editor.tpl.html', 147, false),)), $this); ?>

<!-- Template: meme/meme_editor.tpl.html Start 26/12/2011 12:26:45 --> 
 <?php $this->assign('premade_category', $this->_tpl_vars['util']->get_values_from_config('PREMADE_CATEGORY')); ?>
<?php echo '
<!--[if IE]><script type="text/javascript" src="http://mohan.afixiindia.com/memeje/spad/excanvas.js"></script><![endif]-->
<script type="text/javascript">

/* Tool Functions in scratchpad.js */

var debug=0;
function loadcanvas() {
	if (debug==1) {
		var debugDiv = $(\'<div>\').attr({\'id\':\'debug\' }).css({ \'overflow\':\'scroll\',\'position\':\'fixed\',\'width\':\'300px\',\'height\':\'400px\',\'border\':\'1px solid #ccc\',\'top\':\'350px\',\'right\':\'0px\' });
		debugDiv.appendTo("body");;
	 }

	/* Highlights tool once clicked */
	$(\'#hilight\').find(\'img\').click(function(){
		$(\'#hilight\').find(\'img\').removeClass(\'active\');
		$(this).addClass(\'active\');
		if(!($(\'#text\').hasClass(\'active\')))
			$(\'.text_div\').css(\'display\',\'none\');
	 });
	$(\'#line_size\').click(function(){
		if($(\'#vs\').is(\':hidden\'))
			$(\'#vs\').slideDown(\'slow\');
		else
			$(\'#vs\').slideUp(\'slow\');
		return false;
	 });
	$( "#vs" ).slider({
		orientation: "vertical",
		range: "min",
		min: 1,
		max: 25,
		value: 1
	 });
	$(\'#sp\').scratchpad({ \'width\':636, \'height\':478  });
	$(\'input[type="button"]\').click(function(){
		$(\'input[type="button"]\').removeClass("selected");
		$(this).addClass("selected");
	 });
	setOptions(document.getElementById("img_dpw"));
 }
function showdebug(s){
	if (debug==1) {
		$(\'#debug\').prepend("<br>"+s);
	 }
 }
function showText(){
	$(".text_div").show();
 }
function show_image(){
	var im=$(\'#updimage\').val();
	if(im){
		var y=1;
		if(y){
			var url="http://localhost/meme/upload_image/ce/0";
			$.ajaxFileUpload({
				url : url,
				secureuri:false,
				fileElementId:\'updimage\',
				dataType: \'json\',
				complete: function (data, status){
					z = "preview/orig/"+data.responseText;
					image_upload_draggable("http://localhost/"+z);
					return false;
				 }
			 });
		 }
	 } else {
	    alert("Please choose an image");
	 }
 }
function upload_from_url(){
	$(\'#prev_image\').html("Loading Image...");
	imgurl = document.getElementById("imgurl").value;
	var url="http://localhost/meme/upload_image";
	$.post(url,{"url":imgurl,"ce":0 },function(res){
		z = "preview/orig/"+res;
		image_upload_draggable("http://localhost/"+z);
		return false;
	 });
 }
function image_upload_draggable(url) {
	$(\'#prev_image\').html("<img src=\'"+url+"\' id=\'newimg\' onclick=\'create_Imagebox(this.src)\'>");
 }
function setOptions(obj){
	var wid= 0;
	var url = "http://localhost/meme/get_premade_images";
	var dir = obj.value;
	var opts = { align: \'top\', size: 80  };
	$.post(url,{"id_category":dir,"ce":0 },function(res){
		$("#loadimg").html(res);
		$(\'#loadimg\').jqDock(opts);
		$(\'#loadimg\').find(\'.idrag\').each(function(){
			wid+=$(this).width();
		 });
		wid += 20;
		$(\'#loadimg\').css({
			width:wid+\'px\',
			height : \'140px\'
		 });
		$("#showmodal").remove();
	 });
 }
$(document).ready(function(){
	loadcanvas();
	var main_ofst = $(\'#main\').offset();
	$(window).scroll(function(e){
		var scrollTop = $(window).scrollTop();
		if(scrollTop > 155){
			var y = $(\'#main\').offset();
			var x = $(\'.right_pos_abs\').offset();
			$(\'.right_pos_abs\').css({
			    position:\'fixed\',
			    left : x.left+\'px\'
			 });
			$(\'#main\').css({
			    position:\'fixed\',
			    left : y.left+\'px\'
			 });
		 }else{
			$(\'.right_pos_abs\').css({
			    position:\'absolute\',
			    left :\'820px\'
			 });
			$(\'#main\').css({
			    position:\'absolute\',
			    left :\'-80px\'
			 });
		 }
	 });
	$("#page").show();
 });
</script>
'; ?>

<img src="http://localhost/spad/watermark.png" id="memejimark" style="display:none">
<div id="page" style="display:none;">
	<canvas id="dummy1" style="display:none;"></canvas>
	<div id="sp" style="position:relative;"><canvas id="mycid" style="border:1px solid red"></canvas></div>
    <div style="position:absolute; top:0px; left:0px;">
        <table width='100%' class="smil_tabl_fixed" border="0">
            <tr>
                <td align='left'>
                    <select id="img_dpw" onChange="setOptions(this);">
                        <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['premade_category']), $this);?>

                    </select>
                </td>
                <td align='right'>
                    <input type="file" name="updimage" id="updimage" size="10" />
                    <input type="button" onClick="show_image();" value="Upload" style="width:60px;" /><br />
                    URL: <input type="text" name="imgurl" id="imgurl" size="20" />
                    <input type="button" onClick="upload_from_url();" value="Go" style="width:40px;" />
                </td>
                <td width="120px"><div id="prev_image" class="prev_image"></div></td>
            </tr>
        </table>
        <div class='main_smiley_loading'>
            <div class="smileys_in_small_size">
                <div id="loadimg" ></div>
            </div>
        </div>
    </div>
    <div id="main">
        <div id="vs" style="height:100px; margin-left:65px; margin-top:-1px; display:none;"></div>
        <button id="line_size" class="memeje_button" onclick="return false;">Size-1</button>
        <input type="hidden" id="fontsize" class="ls" value="1" style="width:25px" >
        <img src="http://localhost/spad/site_image/color_wheel.png" width="16" height="16" alt="Pick Color" title="Pick Color" id="color" /><br />
        Alpha<input type='text' class="alpha" value="1" style="width:20px;"><br />
        <span id="hilight">
            <img src="http://localhost/spad/site_image/erase.png" width="14" height="11" class="erase" title="Erase" alt="Erase" />
            <img src="http://localhost/spad/site_image/line.png" width="9" height="15" class="size" title="Pencil" id="line" alt="Pencil" /><br />
            <img src="http://localhost/spad/site_image/square.png" width="17" height="13" class="size" id="square" title="Square"  alt="Square" />
            <img src="http://localhost/spad/site_image/fsquare.png" width="14" height="14" class="size" id="fsquare" title="Fill Square" alt="Fill Square" /><br />
            <img src="http://localhost/spad/site_image/circle.png" width="14" height="14" class="size" id="circle" title="Circle" alt="Circle" />
            <img src="http://localhost/spad/site_image/fcircle.png" width="13" height="13" class="size" id="fcircle" title="Fill Circle" alt="Fill Circle" /><br />
            <img src="http://localhost/spad/site_image/spray.png" width="13" height="13" class="size" id="spray" title="Spray" alt="Spray" />
            <img src="http://localhost/spad/site_image/dline.png" width="16" height="18" class="size" id="DLine" title="Draw line" alt="Draw line" /><br />
            <img src="http://localhost/spad/site_image/text.png" class="size" id="text" title="Text" onclick="create_Textbox();" /><br>
            <span class="text_div" style="display:none">
                <select name="font" id="font" style="font-size:10px">
                    <option>Arial</option>
                    <option>Calibri</option>
                    <option>Geneva</option>
                    <option>Myriad-Pro</option>
                    <option>Sans-serif</option>
                    <option>Tahoma</option>
                    <option>Verdana</option>
                </select>
                <input type='text' id="imgtext" size="15" value="Some Text">
            </span>
        </span>
        <img src="http://localhost/spad/site_image/undo.png" width="19" height="16" class="undo" id="undo" title="Undo" alt="Undo" />
        <img src="http://localhost/spad/site_image/redo.png" width="19" height="16" class="redo" id="redo" title="Redo" alt="Redo" /><br />
        <button title="clear" class="memeje_button" onclick="return clear_canvas();">Clear</button>
        <img src="http://localhost/spad/site_image/increase_panel.png" class="addpanel" title="Increase Height" alt="Add Panel" width="16" height="16" />
        <img src="http://localhost/spad/site_image/decrease_panel.png" class="removepanel" title="Decrease Height" alt="Remove Panel" width="16" height="16" />
        <a href="http://localhost/spad/workspace/<?php echo $_SESSION['id_user']; ?>
_img.png" target="new" title="View Image In a new Window">Image</a><br />
        <img src="http://localhost/spad/site_image/save.png" class="save" id="save" title="File"><br />
        <button title="Save In Disk" class="memeje_button" onclick="return saveindisk(0);">Disk</button>
	</div>
</div>

<!-- Template: meme/meme_editor.tpl.html End --> 