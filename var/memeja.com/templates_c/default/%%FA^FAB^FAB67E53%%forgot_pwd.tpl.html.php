<?php /* Smarty version 2.6.7, created on 2012-04-07 12:27:13
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 07/04/2012 12:27:13 --> 
 <div id="fgtpwdtable">
<div id="new_user">
<h1>Forgot Password?</h1>
<div style="height:102px"><p>
<form action="http://memeja.com/user/get_forgot_pwd" method="post" name="forgotform" id="forgotform" onsubmit="return validate();">
    <table align="center" width="100%" class="userinfo">
        <tr>
            <td class="tl">Email Address :</td>
        </tr>
        <tr>
          <td><input type="text" name="email" id="email"/></td>
        </tr>	
        <tr>
            <td colspan="2" class="tl"><input type="submit" value="Submit" class="inputbtn"/></td>
        </tr>
    </table>
</form>
</p></div>
</div>
</div>
<?php echo '
<script type="text/javascript">
function validate(){

	var validator=$("#forgotform").validate({
	   rules: {
	   		"email":{
				required:true,
				email:true
			 }
		 },
		messages: {
			"email":{
				required:flexymsg.required,
				email:flexymsg.email
			 }
		 }
	 });
	var x=validator.form();
	return x;
 }
</script>
'; ?>


<!-- Template: user/forgot_pwd.tpl.html End --> 