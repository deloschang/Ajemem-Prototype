<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
=======
>>>>>>> test2
<?php /* Smarty version 2.6.7, created on 2011-12-22 13:18:28
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 22/12/2011 13:18:28 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-04-01 08:49:20
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 01/04/2012 08:49:20 --> 
>>>>>>> test2
<<<<<<< HEAD
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

<<<<<<< HEAD
<div id="logintable">
<!--<div id="new_user">
<h1>New Users</h1>
<div style="height:182px"><p>Text to be put here...</p></div>
<div class="create_account"><a href="http://memeja.com/user/register">Create An Account</a></div>
</div>
-->
<div id="register_user">
<h1>Registered Users</h1>
<p>If you have an account with us, please log in.</p>
<form id="loginform" name="loginform" action="http://memeja.com/user/set_login" method="post" onsubmit="return validate_login()">
=======
<!-- css in mainpg.css -->
<div id="logintable">
<div id="new_user">
<h1>New Users</h1>
<div style="height:25px"><p>Please create a Memeja account</p></div>
<div class="create_account"><a href="http://www.memeja.com/user/register">Create An Account</a></div>
</div>

<div id="register_user">
<h1>Registered Users</h1>
<p>If you have an account with us, please log in.</p>
<form id="loginform" name="loginform" action="http://www.memeja.com/user/set_login" method="post" onsubmit="return validate_login()">
>>>>>>> test2
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
<<<<<<< HEAD
    	<td valign="middle"><a href="http://memeja.com/user/forgot_pwd">Forgot Your Password?</a></td>
=======
    	<td valign="middle"><a href="http://www.memeja.com/user/forgot_pwd">Forgot Your Password?</a></td>
>>>>>>> test2
        <td valign="middle" class="tr"><input type="submit" value="Login" class="inputbtn"/></td>
    </tr>
    <tr>
        <td colspan="2">
<<<<<<< HEAD
	    <fb:login-button perms="email,user_checkins,publish_stream">
		Login with Facebook
	    </fb:login-button>
=======
        
	    <div class="fb-login-button" scope="
	    	email,
	    	publish_stream
	    	,user_education_history
	    			    	">
        Login with Facebook
      </div>
      
>>>>>>> test2
	</td>
    </tr>
</table>
</form>
</div>
</div>
<div class="clear"></div>
<<<<<<< HEAD
<div id="fb-root"></div>
<?php echo '
<script type="text/javascript">
    FB.Event.subscribe(\'auth.login\', function (response) {
          window.location = "http://memeja.com/user/facebook_info";
     });

</script>
'; ?>

=======
>>>>>>> test2

=======
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2011-12-22 13:18:28
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 22/12/2011 13:18:28 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-04-01 08:49:20
         compiled from user/login_form.tpl.html */ ?>

<!-- Template: user/login_form.tpl.html Start 01/04/2012 08:49:20 --> 
>>>>>>> test2
=======
>>>>>>> test2
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

<<<<<<< HEAD
<div id="logintable">
<!--<div id="new_user">
<h1>New Users</h1>
<div style="height:182px"><p>Text to be put here...</p></div>
<div class="create_account"><a href="http://memeja.com/user/register">Create An Account</a></div>
</div>
-->
<div id="register_user">
<h1>Registered Users</h1>
<p>If you have an account with us, please log in.</p>
<form id="loginform" name="loginform" action="http://memeja.com/user/set_login" method="post" onsubmit="return validate_login()">
=======
<!-- css in mainpg.css -->
<div id="logintable">
<div id="new_user">
<h1>New Users</h1>
<div style="height:25px"><p>Please create a Memeja account</p></div>
<div class="create_account"><a href="http://www.memeja.com/user/register">Create An Account</a></div>
</div>

<div id="register_user">
<h1>Registered Users</h1>
<p>If you have an account with us, please log in.</p>
<form id="loginform" name="loginform" action="http://www.memeja.com/user/set_login" method="post" onsubmit="return validate_login()">
>>>>>>> test2
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
<<<<<<< HEAD
    	<td valign="middle"><a href="http://memeja.com/user/forgot_pwd">Forgot Your Password?</a></td>
=======
    	<td valign="middle"><a href="http://www.memeja.com/user/forgot_pwd">Forgot Your Password?</a></td>
>>>>>>> test2
        <td valign="middle" class="tr"><input type="submit" value="Login" class="inputbtn"/></td>
    </tr>
    <tr>
        <td colspan="2">
<<<<<<< HEAD
	    <fb:login-button perms="email,user_checkins,publish_stream">
		Login with Facebook
	    </fb:login-button>
=======
        
	    <div class="fb-login-button" scope="
	    	email,
	    	publish_stream
	    	,user_education_history
	    			    	">
        Login with Facebook
      </div>
      
>>>>>>> test2
	</td>
    </tr>
</table>
</form>
</div>
</div>
<div class="clear"></div>
<<<<<<< HEAD
<div id="fb-root"></div>
<?php echo '
<script type="text/javascript">
    FB.Event.subscribe(\'auth.login\', function (response) {
          window.location = "http://memeja.com/user/facebook_info";
     });

</script>
'; ?>

=======
>>>>>>> test2

>>>>>>> 83283487b2e009dffc8cc50bd2aec9418c3eaafa
<!-- Template: user/login_form.tpl.html End --> 