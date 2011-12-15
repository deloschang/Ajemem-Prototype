<?php /* Smarty version 2.6.7, created on 2011-11-02 08:18:59
         compiled from meme/addmeme.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'meme/addmeme.tpl.html', 120, false),)), $this); ?>

<!-- Template: meme/addmeme.tpl.html Start 02/11/2011 08:18:59 --> 
 <div id="showmodal" class="showmodal">Loading the Memeja Editor.</div>
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
    function validate_me(){
        obj=document.getElementById(\'ques_ans\');
        if($(obj.title).val()==\'\'){
            alert("Enter The Title");
            $(obj.title).focus();
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
		if(!$("#tag").val()){
			var conf=confirm("Are you sure you do not want to tag any of your friends?");
			if(conf){
				submit_memeje();
			 }else{
				return false;
			 }
		 }else{
			submit_memeje();
		 }
         }
     }

</script>
'; ?>

<?php if ($this->_tpl_vars['sm']['idq']): ?>
<center><b>Answering to the Question.</b></center><br/>
<?php endif; ?>

<input type="hidden" name="iduser" id="iduser" value="<?php echo $_SESSION['id_user']; ?>
"/>
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
                <input type="text" name="meme[title]" id="title" size="50"/>
            </span>
        </div><br/>
        <div id="edtr">
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "meme/meme_editor.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

            <div class='right_pos_abs'>
                <table>
                    <tr>
                        <td valign='top'><b>Visibility:</b></td>
                        <td>
                            <select id="see_fr" name="meme[can_all_view]">
                                <option value="">--Select--</option>
                                <option value="1">All</option>
                                <option value="0">Friends</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'><b>Who comments:</b></td>
                        <td>
                            <select id="friends" name="meme[can_all_comment]">
                                <option value="">--Select--</option>
                                <option value="1">All</option>
                                <option value="0">Friends</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td valign='top'><b>Meme Category:</b></td>
                        <td>
                            <select id="meme_cat" name="meme[category]">
                                <option value=''>--Select--</option>
				       <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['category']), $this);?>

                            </select>
                        </td>
                    </tr>
					<tr>
                        <td valign='top'><b>Tag your friends:</b></td>
                        <td><select multiple="multiple" style="display: none;" id="tag" name="tagged_user[]"></select></td>
                    </tr>
                    <tr>
                        <td colspan='2' align='center'><input type="button" value="Submit" onclick="validate_me();"/> &nbsp; <input type="button" value="Cancel" id="cancel" onclick="cancel_meme();"/></td>
                    </tr>
                </table>
            </div>

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