<?php /* Smarty version 2.6.7, created on 2012-01-01 02:37:51
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 01/01/2012 02:37:51 --> 
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
</script>
'; ?>

<!-- css in mainpg.css -->
<div id="logintable">
<div id="new_user">
<h1>New Users</h1>
<div style="height:25px"><p>Please create a Memeja account</p></div>
<div class="create_account"><a href="http://localhost/user/register">Create An Account</a></div>
</div>

<div id="register_user">
<h1>Registered Users</h1>
<p>If you have an account with us, please log in.</p>
<form id="loginform" name="loginform" action="http://localhost/user/set_login" method="post" onsubmit="return validate_login()">
<table class="userinfo" width="100%">
	<tr>
	  <td colspan="2">Username :</td>
	  </tr>
	<tr>
    	<td colspan="2">
    	  <input type="text" name="username" id="uname" class="fields" />
  	  </td>
        </tr>
    <tr>
      <td colspan="2">Password :</td>
      </tr>
    <tr>
	<td colspan="2">
	<input type="password" name="password" id="pass" class="fields" />
	</td>
    </tr>
    <!--<tr>
	<td class="tl" colspan="2"><input type="checkbox" name="rem" id="rem" value="1"/>Remember Me</td>
    </tr>
    <tr>
     	<td colspan="2"><div id="load_captcha"></div></td>
    </tr>
    <tr>
     	<td colspan="2"></td>
    </tr>-->
    <tr>
    	<td valign="middle"><a href="http://localhost/user/forgot_pwd">Forgot Your Password?</a></td>
        <td valign="middle" class="tr"><input type="submit" value="Login" class="inputbtn"/></td>
    </tr>
    <tr>
        <td colspan="2">
        
	    <div class="fb-login-button" scope="
	    	email,
	    	publish_stream
	    	,user_education_history
	    			    	">
        Login with Facebook
      </div>
      
	</td>
    </tr>
</table>
</form>
</div>
</div>
<div class="clear"></div>

<!-- Template: user/login_form.tpl.html End --> 