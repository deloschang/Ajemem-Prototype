<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:58:48
         compiled from admin/question/add.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/question/add.tpl.html', 46, false),)), $this); ?>

<!-- Template: admin/question/add.tpl.html Start 19/09/2011 23:58:48 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-50 altbox">
    <div class="boxin">
    <div class="header"><h3><center><?php if ($this->_tpl_vars['sm']['res']): ?>Edit Question <?php else: ?>Add Question<?php endif; ?></center> </h3></div>
	<form id="que_add" name="que_add" action="" method="post">
	    <table style="border:2px">
		<tr>
		    <td align="left">Title</td>
		    <input type="hidden" id="id_question" name="arr[id_question]" value="<?php echo $this->_tpl_vars['sm']['res']['id_question']; ?>
" />
		    <td><input type="text" id="title" name="arr[title]" value="<?php echo $this->_tpl_vars['sm']['res']['title']; ?>
"/></td>
		</tr>
		<tr>
		    <td style="vertical-align: middle;">Question</td>
		    <td><textarea rows="5" cols="40"  id="question" name="arr[question]"><?php echo $this->_tpl_vars['sm']['res']['question']; ?>
</textarea></td>
		</tr>
		<tr>
		    <td>Image:</td>
		    <td><input type = "file" name="img_name" id="img" onchange="preview();"/>
		    <!--<span id="img_name_span"> <input type="hidden" name="server_img" value="" id="server_img"/></span><br>-->
		    </td>
		</tr>
		<tr>
		<span id="img_name_span"> <input type="hidden" name="server_img" value="" id="server_img"/></span>
		</tr>
	    <?php if ($this->_tpl_vars['sm']['res']['img_name']): ?>
		<tr>
		    <td></td>
		    <td><table><tr>
			<td style='vertical-align: middle;'><div id="cimg">Current image :</div></td>
			<td><div id="cimg1">
			<img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['ques_thumb']; ?>
/<?php echo $this->_tpl_vars['sm']['res']['img_name']; ?>
" height="70px" width="70px" />
			<input type="hidden" name="previmage" id="previmage" value="<?php echo $this->_tpl_vars['sm']['res']['img_name']; ?>
" />
			<input type="hidden" name="previousimage" id="previousimage" value="<?php echo $this->_tpl_vars['sm']['res']['image']; ?>
" />
			</div>
			</td></tr></table>
		    </td>
		</tr>
	    <?php endif; ?>
		<tr id="getimage">
		    
		</tr>
		<tr>
		    <td><nobr>Quiz Starts </nobr> </td>
		    <td>&nbsp;&nbsp;&nbsp;From:<input type="text" class="hasDatepick" id="fdate" name="arr[start_date]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
" autocomplete="off"   />
		    <input type="hidden" id="c_date" value=<?php if ($this->_tpl_vars['sm']['res']): ?>"<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
"<?php endif; ?> />
		    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:
		    <input type="text" class="hasDatepick" id="tdate" name="arr[end_date]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
" autocomplete="off" /></td>
		</tr><br/>
		<tr>
		    <td colspan="2" style="text-align: center">
		    <input  type="button" id="btm" name="btm" value="<?php if ($this->_tpl_vars['sm']['res']): ?>Update<?php else: ?>Add<?php endif; ?>" <?php if ($this->_tpl_vars['sm']['res']): ?>onclick="return update_question();" <?php else: ?>onclick="return add_question();<?php endif; ?>"/>
		    <?php if (! $this->_tpl_vars['sm']['res']): ?><input type="reset" value="Reset" /><?php endif; ?>
		    </td>
		</tr>
	    </table>
	</form>
    </div>
</div>
    <?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	if(start !="" && end != ""){
	    to_date();
	 }
	$(\'#fdate,#tdate\').datepicker({
	    dateFormat: "mm-dd-yy",changeMonth:\'true\',changeYear:\'true\',yearRange:\'-15:10\',
	    beforeShow: customRange
	 });
     });
    function to_date(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var c_date=$("#c_date").val();
	var s_date=new Array();
	s_date=start.split("-");
	var e_date=new Array();
	e_date=end.split("-");
	var cu_date=new Array();
	cu_date=c_date.split("-");
	b0 = new Date(cu_date[2],cu_date[1],cu_date[0]);
	b1 = new Date(s_date[2],s_date[1],s_date[0]);
	b2 = new Date(e_date[2],e_date[1],e_date[0]);
	if(b0 > b1 ){
	    $("#fdate").attr("disabled","disabled");
	 }
	if(b0 > b2){
	    $("#tdate").attr("disabled","disabled");
	 }
     }
    var qstart=\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\'
    var btn=$("#submit").val();
    var question=$("#question").val();
    function add_question(){
	var formval = $(\'#que_add\').serialize();
	var c=valid_question();
	if(c){
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    $.post(url,{"page":"question","choice":"insertque",ce:0 }, function(res){
		$("#ques").html(res);
	     });
	    $.fancybox.close();
	 }
     }
    function update_question(){
	$("#fdate").removeAttr("disabled");
	$("#tdate").removeAttr("disabled");
	var formval = $(\'#que_add\').serialize();
	var c=valid_question();
	if(c){
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    $.post(url,{"page":"question","choice":"update","qstart":qstart,ce:0 }, function(res){
		$("#ques").html(res);
	     });
	    $.fancybox.close();
	 }
     }
    function valid_question(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var validator=$("#que_add").validate({
	    rules: {
		"arr[title]": {
		    required: true,
		    minlength: 4
		 },
		    "arr[question]":{
		    required:true,
		    minlength: 20
		 },
		    "arr[start_date]":{
		    required:true
		 },
		    "arr[end_date]":{
		    required:true
		 }
	     },
	    messages: {
		"arr[title]":{
		    required: "<br>This field is required",
		    minlength: "<br>At least three character"
		 },
		    "arr[question]":{
		    required:"<br>This field is required",
		    minlength: "<br>At least 20 charcters"
		 },
		    "arr[start_date]":{
		    required:"<br>Start date is required"
		 },
		    "arr[end_date]":{
		    required:"<br>End date required"
		 }
	     }
	 });
	var x=validator.form();
	if(!x){
	    return false;
	 }else{
	    if((check_date()==\'1\')){
		return true;
	     }else{
		alert("Date exists \\n Please select another date");
		return false;
	     }
	 }
     }
    function preview(){
	var url = "http://memeja.com/flexyadmin/question/preview/ce/0";
	$.ajaxFileUpload({
	url:url,
	secureuri:false,
	fileElementId:\'img\',
	dataType: \'json\',
	complete: function (data, status){
	    var img_name=data.responseText;
	    var picture = "<td></td><td><table><tr><td style=\'vertical-align: middle;\'>Selected Image:</td>&nbsp;&nbsp;<td><img src = \'http://memeja.com/';  echo $this->_tpl_vars['img_path']['preview_thumb'];  echo '"+img_name+"\' height = \'';  echo $this->_tpl_vars['img_path']['thumb_height'];  echo 'px\' width = \'';  echo $this->_tpl_vars['img_path']['thumb_width'];  echo 'px\' /></td></tr></table></td>";
	    $(\'#getimage\').html(picture);
	    $(\'#img_name_span\').html($(\'#server_img\').val(img_name));
	    $(\'#get_img_err\').hide();
	    $(\'#cimg\').hide();
	    $(\'#cimg1\').hide();
	 }
	 });
     }
    function image_upload(){
	var url = "http://memeja.com/flexyadmin/";
	if($(\'#server_img\').val()){
	    var formval = $(\'#que_add\').serialize();
	    url += "question/image_upload/ce/0/?"+formval;
	    $.post(url,function(res){
		if(res){
		    $(\'#edit_photo\').html("<a href=\'javascript:void(0);\' onclick=\'editPhoto();\'><img src=\'http://memeja.com/';  echo $this->_tpl_vars['img_path']['avtar_thumb'];  echo '"+res+"\'></a>");
		    url = "http://memeja.com/";
		    $.fancybox.close();
		    var msg = "<font color=\'red\'>Updated successfully</font>";
		    var id="upd_msg";
		    //showmsg(id,msg);
		 }else{
		    alert("There was some error in uploading your profile photo.Please try after some time");
		    return false;
		 }
	     });
	 }else{
	    $(\'#get_img_err\').show();
	 }
     }
    function customRange(input) {
	return {
	    minDate: (input.id == \'tdate\' ? $(\'#fdate\').datepicker(\'getDate\') : null),
	    maxDate: (input.id == \'fdate\' ? $(\'#tdate\').datepicker(\'getDate\') : null )
	 };
     }
    function check_date(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var btm=$("#btm").val();
	var id_question=$("#id_question").val();
	if(btm=="Update"){
	    var url="http://memeja.com/flexyadmin/index.php?page=question&choice=startcheckdate&start="+start+"&end="+end+"&ce=0"+"&id="+id_question;
	 }else{
	    var url="http://memeja.com/flexyadmin/index.php?page=question&choice=startcheckdate&start="+start+"&end="+end+"&ce=0";
	 }
	var httpRequest = new XMLHttpRequest();
	httpRequest.open(\'POST\', url, false);
	httpRequest.send(); // this blocks as request is synchronous
	if (httpRequest.status == 200) {
	// use response here e.g. access
	    var z=$.trim(httpRequest.responseText);
	    return z;
	 }
	 }
    </script>
    '; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:58:48
         compiled from admin/question/add.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'admin/question/add.tpl.html', 46, false),)), $this); ?>

<!-- Template: admin/question/add.tpl.html Start 19/09/2011 23:58:48 --> 
 <?php $this->assign('img_path', $this->_tpl_vars['util']->get_values_from_config('IMAGE')); ?>
<div class="box box-50 altbox">
    <div class="boxin">
    <div class="header"><h3><center><?php if ($this->_tpl_vars['sm']['res']): ?>Edit Question <?php else: ?>Add Question<?php endif; ?></center> </h3></div>
	<form id="que_add" name="que_add" action="" method="post">
	    <table style="border:2px">
		<tr>
		    <td align="left">Title</td>
		    <input type="hidden" id="id_question" name="arr[id_question]" value="<?php echo $this->_tpl_vars['sm']['res']['id_question']; ?>
" />
		    <td><input type="text" id="title" name="arr[title]" value="<?php echo $this->_tpl_vars['sm']['res']['title']; ?>
"/></td>
		</tr>
		<tr>
		    <td style="vertical-align: middle;">Question</td>
		    <td><textarea rows="5" cols="40"  id="question" name="arr[question]"><?php echo $this->_tpl_vars['sm']['res']['question']; ?>
</textarea></td>
		</tr>
		<tr>
		    <td>Image:</td>
		    <td><input type = "file" name="img_name" id="img" onchange="preview();"/>
		    <!--<span id="img_name_span"> <input type="hidden" name="server_img" value="" id="server_img"/></span><br>-->
		    </td>
		</tr>
		<tr>
		<span id="img_name_span"> <input type="hidden" name="server_img" value="" id="server_img"/></span>
		</tr>
	    <?php if ($this->_tpl_vars['sm']['res']['img_name']): ?>
		<tr>
		    <td></td>
		    <td><table><tr>
			<td style='vertical-align: middle;'><div id="cimg">Current image :</div></td>
			<td><div id="cimg1">
			<img src="http://memeja.com/<?php echo $this->_tpl_vars['img_path']['ques_thumb']; ?>
/<?php echo $this->_tpl_vars['sm']['res']['img_name']; ?>
" height="70px" width="70px" />
			<input type="hidden" name="previmage" id="previmage" value="<?php echo $this->_tpl_vars['sm']['res']['img_name']; ?>
" />
			<input type="hidden" name="previousimage" id="previousimage" value="<?php echo $this->_tpl_vars['sm']['res']['image']; ?>
" />
			</div>
			</td></tr></table>
		    </td>
		</tr>
	    <?php endif; ?>
		<tr id="getimage">
		    
		</tr>
		<tr>
		    <td><nobr>Quiz Starts </nobr> </td>
		    <td>&nbsp;&nbsp;&nbsp;From:<input type="text" class="hasDatepick" id="fdate" name="arr[start_date]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['start_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
" autocomplete="off"   />
		    <input type="hidden" id="c_date" value=<?php if ($this->_tpl_vars['sm']['res']): ?>"<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
"<?php endif; ?> />
		    <br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;To:
		    <input type="text" class="hasDatepick" id="tdate" name="arr[end_date]" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['sm']['res']['end_date'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%m-%d-%Y') : smarty_modifier_date_format($_tmp, '%m-%d-%Y')); ?>
" autocomplete="off" /></td>
		</tr><br/>
		<tr>
		    <td colspan="2" style="text-align: center">
		    <input  type="button" id="btm" name="btm" value="<?php if ($this->_tpl_vars['sm']['res']): ?>Update<?php else: ?>Add<?php endif; ?>" <?php if ($this->_tpl_vars['sm']['res']): ?>onclick="return update_question();" <?php else: ?>onclick="return add_question();<?php endif; ?>"/>
		    <?php if (! $this->_tpl_vars['sm']['res']): ?><input type="reset" value="Reset" /><?php endif; ?>
		    </td>
		</tr>
	    </table>
	</form>
    </div>
</div>
    <?php echo '
<script type="text/javascript">
    $(document).ready(function(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	if(start !="" && end != ""){
	    to_date();
	 }
	$(\'#fdate,#tdate\').datepicker({
	    dateFormat: "mm-dd-yy",changeMonth:\'true\',changeYear:\'true\',yearRange:\'-15:10\',
	    beforeShow: customRange
	 });
     });
    function to_date(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var c_date=$("#c_date").val();
	var s_date=new Array();
	s_date=start.split("-");
	var e_date=new Array();
	e_date=end.split("-");
	var cu_date=new Array();
	cu_date=c_date.split("-");
	b0 = new Date(cu_date[2],cu_date[1],cu_date[0]);
	b1 = new Date(s_date[2],s_date[1],s_date[0]);
	b2 = new Date(e_date[2],e_date[1],e_date[0]);
	if(b0 > b1 ){
	    $("#fdate").attr("disabled","disabled");
	 }
	if(b0 > b2){
	    $("#tdate").attr("disabled","disabled");
	 }
     }
    var qstart=\'';  echo $this->_tpl_vars['sm']['qstart'];  echo '\'
    var btn=$("#submit").val();
    var question=$("#question").val();
    function add_question(){
	var formval = $(\'#que_add\').serialize();
	var c=valid_question();
	if(c){
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    $.post(url,{"page":"question","choice":"insertque",ce:0 }, function(res){
		$("#ques").html(res);
	     });
	    $.fancybox.close();
	 }
     }
    function update_question(){
	$("#fdate").removeAttr("disabled");
	$("#tdate").removeAttr("disabled");
	var formval = $(\'#que_add\').serialize();
	var c=valid_question();
	if(c){
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    $.post(url,{"page":"question","choice":"update","qstart":qstart,ce:0 }, function(res){
		$("#ques").html(res);
	     });
	    $.fancybox.close();
	 }
     }
    function valid_question(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var validator=$("#que_add").validate({
	    rules: {
		"arr[title]": {
		    required: true,
		    minlength: 4
		 },
		    "arr[question]":{
		    required:true,
		    minlength: 20
		 },
		    "arr[start_date]":{
		    required:true
		 },
		    "arr[end_date]":{
		    required:true
		 }
	     },
	    messages: {
		"arr[title]":{
		    required: "<br>This field is required",
		    minlength: "<br>At least three character"
		 },
		    "arr[question]":{
		    required:"<br>This field is required",
		    minlength: "<br>At least 20 charcters"
		 },
		    "arr[start_date]":{
		    required:"<br>Start date is required"
		 },
		    "arr[end_date]":{
		    required:"<br>End date required"
		 }
	     }
	 });
	var x=validator.form();
	if(!x){
	    return false;
	 }else{
	    if((check_date()==\'1\')){
		return true;
	     }else{
		alert("Date exists \\n Please select another date");
		return false;
	     }
	 }
     }
    function preview(){
	var url = "http://memeja.com/flexyadmin/question/preview/ce/0";
	$.ajaxFileUpload({
	url:url,
	secureuri:false,
	fileElementId:\'img\',
	dataType: \'json\',
	complete: function (data, status){
	    var img_name=data.responseText;
	    var picture = "<td></td><td><table><tr><td style=\'vertical-align: middle;\'>Selected Image:</td>&nbsp;&nbsp;<td><img src = \'http://memeja.com/';  echo $this->_tpl_vars['img_path']['preview_thumb'];  echo '"+img_name+"\' height = \'';  echo $this->_tpl_vars['img_path']['thumb_height'];  echo 'px\' width = \'';  echo $this->_tpl_vars['img_path']['thumb_width'];  echo 'px\' /></td></tr></table></td>";
	    $(\'#getimage\').html(picture);
	    $(\'#img_name_span\').html($(\'#server_img\').val(img_name));
	    $(\'#get_img_err\').hide();
	    $(\'#cimg\').hide();
	    $(\'#cimg1\').hide();
	 }
	 });
     }
    function image_upload(){
	var url = "http://memeja.com/flexyadmin/";
	if($(\'#server_img\').val()){
	    var formval = $(\'#que_add\').serialize();
	    url += "question/image_upload/ce/0/?"+formval;
	    $.post(url,function(res){
		if(res){
		    $(\'#edit_photo\').html("<a href=\'javascript:void(0);\' onclick=\'editPhoto();\'><img src=\'http://memeja.com/';  echo $this->_tpl_vars['img_path']['avtar_thumb'];  echo '"+res+"\'></a>");
		    url = "http://memeja.com/";
		    $.fancybox.close();
		    var msg = "<font color=\'red\'>Updated successfully</font>";
		    var id="upd_msg";
		    //showmsg(id,msg);
		 }else{
		    alert("There was some error in uploading your profile photo.Please try after some time");
		    return false;
		 }
	     });
	 }else{
	    $(\'#get_img_err\').show();
	 }
     }
    function customRange(input) {
	return {
	    minDate: (input.id == \'tdate\' ? $(\'#fdate\').datepicker(\'getDate\') : null),
	    maxDate: (input.id == \'fdate\' ? $(\'#tdate\').datepicker(\'getDate\') : null )
	 };
     }
    function check_date(){
	var start=$("#fdate").val();
	var end=$("#tdate").val();
	var btm=$("#btm").val();
	var id_question=$("#id_question").val();
	if(btm=="Update"){
	    var url="http://memeja.com/flexyadmin/index.php?page=question&choice=startcheckdate&start="+start+"&end="+end+"&ce=0"+"&id="+id_question;
	 }else{
	    var url="http://memeja.com/flexyadmin/index.php?page=question&choice=startcheckdate&start="+start+"&end="+end+"&ce=0";
	 }
	var httpRequest = new XMLHttpRequest();
	httpRequest.open(\'POST\', url, false);
	httpRequest.send(); // this blocks as request is synchronous
	if (httpRequest.status == 200) {
	// use response here e.g. access
	    var z=$.trim(httpRequest.responseText);
	    return z;
	 }
	 }
    </script>
    '; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/question/add.tpl.html End --> 