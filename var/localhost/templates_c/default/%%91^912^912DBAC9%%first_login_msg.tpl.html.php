<?php /* Smarty version 2.6.7, created on 2011-12-28 03:53:49
         compiled from user/first_login_msg.tpl.html */ ?>

<!-- Template: user/first_login_msg.tpl.html Start 28/12/2011 03:53:49 --> 
 <?php echo '
<script type="text/javascript">
	function checkbox_validate() {
		//console.log($(\'#submittext\').val());
		if ($(\'#submittext\').val() == 1 && ($("#toc").is(":checked"))  ) {
			$("#submit").attr("disabled", false);
		 } else {
			$("#submit").attr("disabled", true);
		 }
	 }
	$(document).ready(function(){
		// min chars for username
		var min_chars = 5;
		
		// Result texts
		var characters_error = \'<font color="red">\' + \'Minimum amount of chars is 5 </font>\';
	
		var validateUsername = $(\'#validateUsername\');
		
		$("#submit").attr("disabled", true);
				
		$(\'#myusername\').keyup(function() {
			var username = $(\'#myusername\').val();
			var username_length = username.length
			
			// No username
			if (!username) {
				$("#submit").attr("disabled", true);
				validateUsername.html(\'<font color="red">\' + \'Please specify a username</font>\');	
				$(\'#submittext\').val(0);
			
			// Less than min char. length
			 } else if (username_length < min_chars) {
				$("#submit").attr("disabled", true);
				validateUsername.html(characters_error);
				$(\'#submittext\').val(0);
					
			 } else {
			
				if (this.value != this.lastValue){
					if (this.timer) clearTimeout(this.timer);
					validateUsername.html(\'Checking availability..\').fadeIn("slow");
								
					this.timer = setTimeout(function () {
					//console.log("ajax going to fire");
		
					var url = "/flexycms/modules/additions/user_validate.php";
					$.post(url, { username: username  }, function(res) {
						//console.log(res);
						if (res == \'continue\') {
							validateUsername.html(\'<font color="green"><strong>\' + username + \' is available!</font></strong>\');
							$(\'#submittext\').val(1);
							//console.log($(\'#submittext\').val());
							
							// Checkbox control passed
							if ( $("#toc").is(":checked")) {
								$("#submit").attr("disabled", false);
								//console.log($("#submittext").val());
							 } else {
								checkbox_validate();
							 }
							
						 } else if (res == \'already_exists\') {	
							$("#submit").attr("disabled", true);
							validateUsername.html(\'<font color="red">\' + username + \' is not available!</font>\');
							$(\'#submittext\').val(0);
								
						 } else if (res == \'specific_character_error\') {
							$("#submit").attr("disabled", true);
							validateUsername.html(\'<font color="red">\' + "Your username can only contain alphanumerics and dash and underscore (-_) </font>");
							$(\'#submittext\').val(0);
							
						 }
					 });
				 }, 200);
				
				
				this.lastValue = this.value;
			 }
			 }
		 });
	 });
	
	$("#submit").click(function(){
		$("#status").html(\'<font color="blue">\' +"Form submitting.....</font>");	
	 });
	
	
</script>
'; ?>

<h2>Almost there! Please create a Username</h2>

<form name="form1" method="post" action="http://localhost/user/create_username">
	<fieldset>
		<legend> Register </legend>
		<div>
			<label for="username">Username, valid: a-z.-_</label>
			<input type="text" name="username" value="" id="myusername" maxlength="17"/>
			<span id="validateUsername"></span>
		</div>

		<label for="toc">
		<input type="checkbox" name="toc" id="toc" value="0" onclick="checkbox_validate();"/>
		I agree to the Terms and Conditions
		</label>

	</fieldset>
<input type="submit" id="submit" name="Submit" value="Sign Up">
<div id="status"></div>
<input type="hidden" id="submittext" value="0"/>
</form>



<!-- Template: user/first_login_msg.tpl.html End --> 