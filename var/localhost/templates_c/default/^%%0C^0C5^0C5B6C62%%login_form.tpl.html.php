<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-07 01:13:20
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 07/06/2012 01:13:20 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-05-06 00:04:49
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 06/05/2012 00:04:49 --> 
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
=======
<?php /* Smarty version 2.6.7, created on 2012-06-10 05:59:54
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 10/06/2012 05:59:54 --> 
>>>>>>> f658ecc96a2b9cf52cbd029071419d2a2f05c434
 <?php echo '
<script type="text/javascript">
    function validate_login(){
		validator=$("#loginform").validate({
		   	rules: {
			   username: {
					required:true
				 },
				password:{
					required: true,
					minlength: 6
				 }
			 },
			messages: {
				username:{
					required:flexymsg.required

				 },
				password:{
					required:flexymsg.required,
					minlength:flexymsg.minlength
				 }
			 }
		 });
		x=validator.form();
		return x;
	 }
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> f658ecc96a2b9cf52cbd029071419d2a2f05c434
	
	function forgot_pwd(){
		$(\'#forgot_pwd\').slideToggle(800);
	 }
	
<<<<<<< HEAD
=======
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
=======
>>>>>>> f658ecc96a2b9cf52cbd029071419d2a2f05c434
</script>
'; ?>

<!-- css in mainpg.css -->
<div id="logintable">

<!--
	<div id="new_user">
		<h1>New Users</h1>
		<div style="height:25px"><p>Please create a Memeja account</p></div>
		<div class="create_account"><a href="http://localhost/user/register">Create An Account</a></div>
	</div>
-->

<div id="register_user">

<!--<h1>Registered Users</h1>-->

<form id="loginform" name="loginform" action="http://localhost/user/set_login" method="post" onsubmit="return validate_login()">
<table class="userinfo" width="100%">
	<tr>
    	<td colspan="2">
    	  <input type="text" name="username" id="uname" class="self-describing" title="Username or email"/>
  	  </td>
        </tr>
    <tr>
		<td colspan="1">
		<input type="password" name="password" id="pass" class="self-describing" title="Password"/>
		</td>
		<td valign="middle" class="tr"><input type="submit" value="Sign In" class="inputbtn"/></td>
    </tr>
    <tr>
		<!--
		<td class="tl" colspan="2"><input type="checkbox" name="rem" id="rem" value="1"/>Remember Me </td>-->
		<td>
<<<<<<< HEAD
<<<<<<< HEAD
		<a href="javascript:void(0);" onclick="forgot_pwd();">Forgot Password?</a></td>
=======
		<a href="http://localhost/user/forgot_pwd">Forgot Password?</a></td>
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
=======
		<a href="javascript:void(0);" onclick="forgot_pwd();">Forgot Password?</a></td>
>>>>>>> f658ecc96a2b9cf52cbd029071419d2a2f05c434
    </tr>
	<!--
    <tr>
     	<td colspan="2"><div id="load_captcha"></div></td>
    </tr>
    <tr>
     	<td colspan="2"></td>
    </tr>-->
</table>
</form>
</div>
</div>
<<<<<<< HEAD
<<<<<<< HEAD
	<div id="forgot_pwd" style="display:none">
=======
	<div id="forgot_pwd">
>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
=======
	<div id="forgot_pwd" style="display:none">
>>>>>>> f658ecc96a2b9cf52cbd029071419d2a2f05c434
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/forgot_pwd.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<div class="clear"></div>

<!-- Template: user/login_form.tpl.html End --> 