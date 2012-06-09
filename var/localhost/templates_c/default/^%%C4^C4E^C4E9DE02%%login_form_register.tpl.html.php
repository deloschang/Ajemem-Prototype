<?php /* Smarty version 2.6.7, created on 2012-06-07 01:13:20
         compiled from user/login_form_register.tpl.html */ ?>

<!-- Template: user/login_form_register.tpl.html Start 07/06/2012 01:13:20 --> 
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
	
	function basic_login(){
		$(\'#signup_alt_form\').show();
	 }
	
	function lol_promise(){
		$(\'#lol_promise\').slideToggle(400);
	 }
</script>
'; ?>

<div id="signup">
<div id="signup_text">New? Join Memeja</div>
        
		<center>
	   <div class="fb-login-button" scope="
	    	email,
	    	publish_stream
	    	,user_education_history
	    			    	">
        Login with Facebook
      </div>
	   </center>

<div id="explanation_header" style="padding-top:20px">Why connect?</div>
<div id="signup_explanation">

<div> (1) Because Facebook helps us link <strong>you + your stories</strong> with your friends</div>
<div style="padding-top:5px;"> (2) Because we <strong>promise</strong> <span id="promise"><a href="javascript:void(0);" onclick="lol_promise();">(not plomise!)</a></span> we'll never post without your permission.</div>

</div>


<div id="lol_promise" style="display:none">
	<img src="http://localhost/image/white_mascot.png" id="lol_promise_mascot"/><span id="lol_promise_text">We promise.</span>
	
	<div>
	<img src="http://localhost/image/troll_mascot.png" id="lol_plomise_mascot"/><span id="lol_plomise_text"><strike>We plomise. Twust us</strike></span>
	</div>
</div>

<!-- Under Construction 
<div id="signup_alt" style="padding-top:10px"><a href="javascript:void(0);" onclick="basic_login();">I don't have a Facebook account.</a></div>
-->

<div id="signup_alt_form" style="display:none"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "user/register.tpl.html", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></div>
</div>

<div class="clear"></div>

<!-- Template: user/login_form_register.tpl.html End --> 