<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:59:01
         compiled from admin/user/profile.tpl.html */ ?>

<!-- Template: admin/user/profile.tpl.html Start 19/09/2011 23:59:01 --> 
 <?php $this->assign('x', $this->_tpl_vars['sm']['userdata']); ?>
<div class="box box-75 altbox">
    <div class="boxin">
        <div class="header">
        	<h3>Profile</h3>
        </div>
	<form class="basic" action="http://memeja.com/flexyadmin/user/update_profile" method="post" name="profile_form" id="profile_form">       
     <div class="inner-form">
	 <div id="show_err"><?php if ($this->_tpl_vars['sm']['fail_msg']):  echo $this->_tpl_vars['sm']['fail_msg'];  endif; ?></div>
            <dl>
                <dt class="t1"><label for="some1">Email id:</label></dt>
                
                <dd>
                     <input type="text" id="email" name="email" class="txt" value="<?php echo $this->_tpl_vars['x']['email']; ?>
" />
                </dd>
                <dt class="t1"><label for="some1">Username:</label></dt>
                
                <dd>
                     <input type="text" id="uname" name="uname" class="txt" value="<?php echo $this->_tpl_vars['x']['username']; ?>
" onblur="check_uname('a');"/>
                </dd>
                <dt class="t1"><label for="some1">Old Password:</label></dt>
                
                <dd>
                    <input type="password" id="opass" name="opass" class="txt"/>
                </dd>
                <dt class="t1"><label for="some1">New Password:</label></dt>
                
                <dd>
                     <input type="password" id="npass" name="npass" class="txt"/>
                </dd>
                <dt class="t1"><label for="some1">Confirm Password:</label></dt>
                
                <dd>
                    <input type="password" id="cpass" name="cpass" class="txt"/>
                </dd>
                <dt></dt>
                <dd>
                    <input class="button" type="button" value="Update" onclick="return validate();"/>
                    <input class="button" type="reset"/>
                </dd>
            </dl>          
        </div>
        <input type="hidden" id="oldpass" name="oldpass" value="<?php echo $this->_tpl_vars['x']['password']; ?>
"/>
        </form>
	</div>
</div>
<?php echo '
<script type="text/javascript">
	function validate() {
	var validator=$("#profile_form").validate({ 
	rules: {
			uname:{
				required:true
			 },
			email:{
				required:true,
				email:true
			 },
			npass:{
				minlength:6
			 },
			cpass:{
				minlength:6,
				equalTo:\'#npass\'
			 }
	 },
	messages: {
			uname:{
				required:flexymsg.required
			 },
			email:{
				required:flexymsg.required,
				email:flexymsg.email
			 },
			npass:{
				minlength:flexymsg.minlength
			 },
			cpass:{
				minlength:flexymsg.minlength,
				equalTo:flexymsg.equalTo
			 }
		 }
	 });
	var x=validator.form();
	
		var npass=$(\'#npass\').val();
		//alert(npass);
		var cpass=$(\'#cpass\').val();
		var pass=$(\'#opass\').val();
		var oldpass=$(\'#oldpass\').val();
		if(pass){
			if(npass){
				if(npass!=cpass){
					$(\'#show_err\').html("Confirm Password does not match.");
					return false;
				 }
			 }else{
				$(\'#show_err\').html("Provide New Password.");
					return false;			
			 }
		 }else{
			if(npass){
				document.getElementById(\'npass\').value="";
				document.getElementById(\'cpass\').value="";
				$(\'#show_err\').html("Enter Password First.");
				return false;
			 }
		 }
		x=check_uname(\'c\');
		if(x) {
			$(\'#profile_form\').submit();
		 }

	 }
	function check_uname(x) {
		var uname=$(\'#uname\').val();//alert(uname);
		var test=\'';  echo $this->_tpl_vars['x']['username'];  echo '\';//alert(test);
		if(uname==test){
			$("#show_err").html(\'\');
			return true;
		 }else{
			var url="http://memeja.com/flexyadmin/index.php";
			$.post(url,{"page":"user","choice":"check_username",uname:uname,ce:0 },function(res){
				if(res==1){
					if(x==\'c\'){
						$(\'#profile_form\').submit();
					 }	
					$(\'#show_err\').html("");
					return true;
				 }else{
					$(\'#show_err\').html("This Username already exist.");
					return false;
				 }
				
			 });
		 }
	 }
</script>
'; ?>


=======
<?php /* Smarty version 2.6.7, created on 2011-09-19 23:59:01
         compiled from admin/user/profile.tpl.html */ ?>

<!-- Template: admin/user/profile.tpl.html Start 19/09/2011 23:59:01 --> 
 <?php $this->assign('x', $this->_tpl_vars['sm']['userdata']); ?>
<div class="box box-75 altbox">
    <div class="boxin">
        <div class="header">
        	<h3>Profile</h3>
        </div>
	<form class="basic" action="http://memeja.com/flexyadmin/user/update_profile" method="post" name="profile_form" id="profile_form">       
     <div class="inner-form">
	 <div id="show_err"><?php if ($this->_tpl_vars['sm']['fail_msg']):  echo $this->_tpl_vars['sm']['fail_msg'];  endif; ?></div>
            <dl>
                <dt class="t1"><label for="some1">Email id:</label></dt>
                
                <dd>
                     <input type="text" id="email" name="email" class="txt" value="<?php echo $this->_tpl_vars['x']['email']; ?>
" />
                </dd>
                <dt class="t1"><label for="some1">Username:</label></dt>
                
                <dd>
                     <input type="text" id="uname" name="uname" class="txt" value="<?php echo $this->_tpl_vars['x']['username']; ?>
" onblur="check_uname('a');"/>
                </dd>
                <dt class="t1"><label for="some1">Old Password:</label></dt>
                
                <dd>
                    <input type="password" id="opass" name="opass" class="txt"/>
                </dd>
                <dt class="t1"><label for="some1">New Password:</label></dt>
                
                <dd>
                     <input type="password" id="npass" name="npass" class="txt"/>
                </dd>
                <dt class="t1"><label for="some1">Confirm Password:</label></dt>
                
                <dd>
                    <input type="password" id="cpass" name="cpass" class="txt"/>
                </dd>
                <dt></dt>
                <dd>
                    <input class="button" type="button" value="Update" onclick="return validate();"/>
                    <input class="button" type="reset"/>
                </dd>
            </dl>          
        </div>
        <input type="hidden" id="oldpass" name="oldpass" value="<?php echo $this->_tpl_vars['x']['password']; ?>
"/>
        </form>
	</div>
</div>
<?php echo '
<script type="text/javascript">
	function validate() {
	var validator=$("#profile_form").validate({ 
	rules: {
			uname:{
				required:true
			 },
			email:{
				required:true,
				email:true
			 },
			npass:{
				minlength:6
			 },
			cpass:{
				minlength:6,
				equalTo:\'#npass\'
			 }
	 },
	messages: {
			uname:{
				required:flexymsg.required
			 },
			email:{
				required:flexymsg.required,
				email:flexymsg.email
			 },
			npass:{
				minlength:flexymsg.minlength
			 },
			cpass:{
				minlength:flexymsg.minlength,
				equalTo:flexymsg.equalTo
			 }
		 }
	 });
	var x=validator.form();
	
		var npass=$(\'#npass\').val();
		//alert(npass);
		var cpass=$(\'#cpass\').val();
		var pass=$(\'#opass\').val();
		var oldpass=$(\'#oldpass\').val();
		if(pass){
			if(npass){
				if(npass!=cpass){
					$(\'#show_err\').html("Confirm Password does not match.");
					return false;
				 }
			 }else{
				$(\'#show_err\').html("Provide New Password.");
					return false;			
			 }
		 }else{
			if(npass){
				document.getElementById(\'npass\').value="";
				document.getElementById(\'cpass\').value="";
				$(\'#show_err\').html("Enter Password First.");
				return false;
			 }
		 }
		x=check_uname(\'c\');
		if(x) {
			$(\'#profile_form\').submit();
		 }

	 }
	function check_uname(x) {
		var uname=$(\'#uname\').val();//alert(uname);
		var test=\'';  echo $this->_tpl_vars['x']['username'];  echo '\';//alert(test);
		if(uname==test){
			$("#show_err").html(\'\');
			return true;
		 }else{
			var url="http://memeja.com/flexyadmin/index.php";
			$.post(url,{"page":"user","choice":"check_username",uname:uname,ce:0 },function(res){
				if(res==1){
					if(x==\'c\'){
						$(\'#profile_form\').submit();
					 }	
					$(\'#show_err\').html("");
					return true;
				 }else{
					$(\'#show_err\').html("This Username already exist.");
					return false;
				 }
				
			 });
		 }
	 }
</script>
'; ?>


>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
<!-- Template: admin/user/profile.tpl.html End --> 