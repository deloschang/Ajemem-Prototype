<<<<<<< HEAD
<<<<<<< HEAD
<?php /* Smarty version 2.6.7, created on 2012-06-18 00:03:12
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 18/06/2012 00:03:12 --> 
=======
<?php /* Smarty version 2.6.7, created on 2012-06-20 06:29:57
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 20/06/2012 06:29:57 --> 
>>>>>>> 49b95a2eb0a67232f413e9eeb08d2a22801ffc11
=======
<?php /* Smarty version 2.6.7, created on 2012-06-21 00:22:50
         compiled from user/forgot_pwd.tpl.html */ ?>

<!-- Template: user/forgot_pwd.tpl.html Start 21/06/2012 00:22:50 --> 
>>>>>>> 11d759705a6f8b6e8784e45a4afbdeb4d894e999
 
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