<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:58:23
         compiled from admin/manage/allot_points.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/manage/allot_points.tpl.html', 18, false),)), $this); ?>

<!-- Template: admin/manage/allot_points.tpl.html Start 19/09/2011 23:58:23 --> 
 <?php $this->assign('allot_points', $this->_tpl_vars['util']->get_values_from_config('ALLOT_POINTS')); ?>
<div class="box box-75 altbox" id="dt" >
    <div class="boxin" >
    <div class="header" id ="to_replace">
        <h3>Allot Point</h3>
	    </div>
        <div class="content">
	    <form name="addpoints"  id="add_points"  action=" "method="post">
		<table cellspacing="0">
		    <tbody>
			<tr>
			    <td> Point Type:</td>
			    <td>
				<select id="point_type" name="point_type" <?php if ($this->_tpl_vars['sm']['res']): ?>disabled="disabled"<?php endif; ?>>
				    <option value="">--select--</option>
				    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['allot_points'],'selected' => $this->_tpl_vars['sm']['res']['point_type']), $this);?>

				</select>
			    </td>
			</tr>
			<tr>
			    <td>Points:</td>
			    <td>
				<input type="text" name="points" id="point" value="<?php echo $this->_tpl_vars['sm']['res']['points']; ?>
" />
			    </td>
			</tr>
			<tr>
			    <td colspan="2" align="right">
				<input type="button" name="send" value="<?php if ($this->_tpl_vars['sm']['res']): ?>Update<?php else: ?>Allot<?php endif; ?>" <?php if ($this->_tpl_vars['sm']['res']): ?>onclick="update_point('<?php echo $this->_tpl_vars['sm']['res']['id_allot']; ?>
');"<?php else: ?>onclick="add();"<?php endif; ?>/>
			    </td>
			</tr>

		    </tbody>
		</table>
	    </form>
        </div>
    </div>
</div>

<?php echo '
    <script type="text/javascript">
	function add(){
	    var formval = $(\'#add_points\').serialize();
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    var c=valid_point();
	    if(c){
		$.post(url,{"page":"manage","choice":"insert_points","ce":0 },function(res){
		    if(res == 0){
			 alert("Point type already exist\\n Please edit or select another point type");
			 $("#point_type").val("");
			 $(\'#point\').val("");
			 return false;
		     }else{
			$("#manage_show_points").html(res);
			$.fancybox.close();
		     }
		 });
	     }
	 }
	function update_point(id){
	    var formval = $(\'#add_points\').serialize();
	    var c=valid_point();
	    if(c){
		var url="http://memeja.com/flexyadmin/index.php?"+formval;
		$.post(url,{"page":"manage","choice":"update_point","id":id,ce:0 }, function(res){
		    $("#manage_show_points").html(res);
		 });
		$.fancybox.close();
	     }
	  }
    function valid_point(){
	var validator=$("#add_points").validate({
	    rules: {
		"point_type":{
		  required:true  
		 },
		"points": {
		    required: true,
		    number:true,
		    minlength: 1
		 }
	     },
	    messages: {
		"point_type":{
		  required:"<br>Please select point type " 
		 },
		"points":{
		    required: "<br>Enter  valid number",
		    number:"<br> Only Number",
		    minlength: "<br>At least one number"
		 }
	     }
	 });
	var x=validator.form();
	if(!x){
	    return false;
	 }else{
		return true;
	     }
	 }
  
     </script>

'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:58:23
         compiled from admin/manage/allot_points.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_options', 'admin/manage/allot_points.tpl.html', 18, false),)), $this); ?>

<!-- Template: admin/manage/allot_points.tpl.html Start 19/09/2011 23:58:23 --> 
 <?php $this->assign('allot_points', $this->_tpl_vars['util']->get_values_from_config('ALLOT_POINTS')); ?>
<div class="box box-75 altbox" id="dt" >
    <div class="boxin" >
    <div class="header" id ="to_replace">
        <h3>Allot Point</h3>
	    </div>
        <div class="content">
	    <form name="addpoints"  id="add_points"  action=" "method="post">
		<table cellspacing="0">
		    <tbody>
			<tr>
			    <td> Point Type:</td>
			    <td>
				<select id="point_type" name="point_type" <?php if ($this->_tpl_vars['sm']['res']): ?>disabled="disabled"<?php endif; ?>>
				    <option value="">--select--</option>
				    <?php echo smarty_function_html_options(array('options' => $this->_tpl_vars['allot_points'],'selected' => $this->_tpl_vars['sm']['res']['point_type']), $this);?>

				</select>
			    </td>
			</tr>
			<tr>
			    <td>Points:</td>
			    <td>
				<input type="text" name="points" id="point" value="<?php echo $this->_tpl_vars['sm']['res']['points']; ?>
" />
			    </td>
			</tr>
			<tr>
			    <td colspan="2" align="right">
				<input type="button" name="send" value="<?php if ($this->_tpl_vars['sm']['res']): ?>Update<?php else: ?>Allot<?php endif; ?>" <?php if ($this->_tpl_vars['sm']['res']): ?>onclick="update_point('<?php echo $this->_tpl_vars['sm']['res']['id_allot']; ?>
');"<?php else: ?>onclick="add();"<?php endif; ?>/>
			    </td>
			</tr>

		    </tbody>
		</table>
	    </form>
        </div>
    </div>
</div>

<?php echo '
    <script type="text/javascript">
	function add(){
	    var formval = $(\'#add_points\').serialize();
	    var url="http://memeja.com/flexyadmin/index.php?"+formval;
	    var c=valid_point();
	    if(c){
		$.post(url,{"page":"manage","choice":"insert_points","ce":0 },function(res){
		    if(res == 0){
			 alert("Point type already exist\\n Please edit or select another point type");
			 $("#point_type").val("");
			 $(\'#point\').val("");
			 return false;
		     }else{
			$("#manage_show_points").html(res);
			$.fancybox.close();
		     }
		 });
	     }
	 }
	function update_point(id){
	    var formval = $(\'#add_points\').serialize();
	    var c=valid_point();
	    if(c){
		var url="http://memeja.com/flexyadmin/index.php?"+formval;
		$.post(url,{"page":"manage","choice":"update_point","id":id,ce:0 }, function(res){
		    $("#manage_show_points").html(res);
		 });
		$.fancybox.close();
	     }
	  }
    function valid_point(){
	var validator=$("#add_points").validate({
	    rules: {
		"point_type":{
		  required:true  
		 },
		"points": {
		    required: true,
		    number:true,
		    minlength: 1
		 }
	     },
	    messages: {
		"point_type":{
		  required:"<br>Please select point type " 
		 },
		"points":{
		    required: "<br>Enter  valid number",
		    number:"<br> Only Number",
		    minlength: "<br>At least one number"
		 }
	     }
	 });
	var x=validator.form();
	if(!x){
	    return false;
	 }else{
		return true;
	     }
	 }
  
     </script>

'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/manage/allot_points.tpl.html End --> 