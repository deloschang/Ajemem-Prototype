<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-17 02:05:35
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 17/06/2012 02:05:35 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-17 21:14:35
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 17/06/2012 21:14:35 --> 
>>>>>>> 5f5a5b11223944e343ba093934bf774fc644046f
 
<form action="http://localhost/user/get_forgot_pwd" method="post" name="forgotform" id="forgotform" onsubmit="return validate();">
    <input type="text" name="email" id="email" class="self-describing" title="Email Address" style="height:15px;"/>
    <input type="submit" value="Save me!" class="inputbtn" style="float:right; height:26px; font-size:11px; line-height:15px; padding:3px; margin:0 15px 0 0;"/>

</form>
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