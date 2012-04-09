<?php /* Smarty version 2.6.7, created on 2012-04-09 21:40:12
         compiled from user/register.tpl.html */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'html_radios', 'user/register.tpl.html', 276, false),array('function', 'html_select_date', 'user/register.tpl.html', 290, false),)), $this); ?>

<!-- Template: user/register.tpl.html Start 09/04/2012 21:40:12 --> 
 <?php echo '
	<script type="text/javascript" src="colorBckg.js"></script>
	<script type="text/javascript">

		$.validator.addMethod("username", function(value) {
			return /^[a-z0-9]([a-z0-9_.]+)?$/i.test(value);
			 },\'<br>Please enter a valid username\'
		);
		function validateCheck() {
		if ($("#toc").click) 
		{
			$("#register").attr(\'disabled\', \'\');
		 } else 
		{
			$("#register").attr(\'disabled\', \'disabled\');
		 }
	 }
		function checkvalidate() {
			var validator=$("#signupform").validate({
			   	rules: {
					"user[first_name]": {
						required:true,
						maxlength: 50
					 },
					"user[last_name]":{
						required: true,
						maxlength: 50						
					 },
					"user[username]":{
						required: true,
						maxlength: 20,
						username: true
					 },
					"user[email]":{
						required: true,
						email: true
					 },
					"user[password]":{
						required: true,
						minlength: 6,
						maxlength: 20
					 },
					"cpwd":{
						required: true,
						equalTo:\'#pwd\'
					 },
					"gender":{
						required: true
					 },
					"dob_Month":{
						required: true
					 },
					"dob_Year":{
						required: true
					 },
					"dob_Day":{
						required: true
					 }
				 },
				messages: {
					"user[first_name]": {
						required:flexymsg.required,
						maxlength:flexymsg.mixlength
					 },
					"user[last_name]":{
						required: flexymsg.required,
						maxlength:flexymsg.mixlength
					 },
					"user[username]" :{
						required: flexymsg.required,
						maxlength:flexymsg.mixlength
					 },
					"user[email]" :{
						required: flexymsg.required,
						email: flexymsg.email
					 },
					"user[password]":{
						required:flexymsg.required,
						minlength:flexymsg.minlength,
						maxlength:flexymsg.mixlength
					 },
					"cpwd":{
						required: flexymsg.required,
						equalTo: flexymsg.equalTo
					 },
					"gender" :{
						required: flexymsg.required
					 },
					"dob_Month" :{
						required: flexymsg.required_dob
					 },
					"dob_Year" :{
						required: flexymsg.required_dob
					 },
					"dob_Day" :{
						required: flexymsg.required_dob
					   }					
				 }
			 });
			var x=validator.form();
			return x;
		 }
		function check_date(e) {
			
		 }
		function show_username_exist() {
			var username=document.getElementById(\'username\').value;
			var pass = document.getElementById(\'pwd\').value;
			var url="http://localhost/index.php";
		/**
			if(username.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer username</font></center>");
			else if(pass.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer password</font></center>");
			else if(username.length < 6 && pass.length >= 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer username</font></center>");
			else if(username.length >= 6 && pass.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer password</font></center>");
			//if(username.length < 6 || pass.length < 6)
			//	$("#register").attr(\'disabled\', \'disabled\');
			if(username.length >= 6 && pass.length >= 6 && ("#toc").click) {
				$("#register").attr(\'disabled\', \'\');
				$(\'#add_user_msg\').html(\'\');
			 }
			else
				$("#register").attr(\'disabled\', \'disabled\');
			*/
		$.post(url,{"page":"user","choice":"check_username",ce:0,"username":username },function(res){
			
				if(res!=0 && username!=""){
					$(\'#add_user_msg\').html("<center><font color=red>This Username Already Exist.</font></center>");
					$(\'#username\').val("");
					return false;
				  }else{
					//$(\'#add_user_msg\').html(\'\');
					return true;
				  }
			 });
		 }
		function checkpassword() {
			
			var text=document.getElementById(\'pwd\').value;
			var i,s,color,width;
			var n_o_small_char=0;
			var n_o_cap_char=0;
			var n_o_spe_char=0;
			var n_o_dig=0;
			var point=0;
		/**
			if(username.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer username</font></center>");
			else if(text.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer password</font></center>");
			else if(username.length < 6 && text.length >= 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer username</font></center>");
			else if(username.length >= 6 && text.length < 6)
				$(\'#add_user_msg\').html("<center><font color=red>Must enter a longer password</font></center>");
			//if(username.length < 6 || text.length < 6)
			//	$("#register").attr(\'disabled\', \'disabled\');
			if(username.length >= 6 && text.length >= 6 && ("#toc").click) {
				$("#register").attr(\'disabled\', \'\');
				$(\'#add_user_msg\').html(\'\');
			 }
			else
				$("#register").attr(\'disabled\', \'disabled\');
			*/
			
			
			for(i=0;i<text.length;i++){
				if(97<=text.charCodeAt(i) && text.charCodeAt(i)<=122) {
					point++;
					n_o_small_char=n_o_small_char+1;
				 }else if(65<=text.charCodeAt(i) && text.charCodeAt(i)<=90){
					point=point+2;
					n_o_cap_char++;
				 }else if(48<=text.charCodeAt(i) && text.charCodeAt(i)<=57){
					point=point+2;
					n_o_dig++;
				 }else if(text.charCodeAt(i)!=32){
					n_o_spe_char++;
					point=point+3;
				 }
			 }	
			
			if(n_o_small_char>0 && n_o_cap_char>0 && n_o_spe_char>0 && n_o_dig>0){
				point=point+4;
			 }
			if(n_o_spe_char>2){
				point=point+3;
			 }
			
			if(point<10){
				if(!point){
					s="";
					width=0;
				 }else{
					s="poor";
					color="#FFFFCC";
					width=30;
				 }
			 }else if(10<=point && point<=15){
				s="good";
				color="#CCFFFF";
				width=60;
			 }else if(point>=15){
				s="best";
				width=100;
				color="#00FF00";
			 }
			document.getElementById(\'status\').innerHTML=s;
			//document.getElementById(\'pnts\').innerHTML=point;
			document.getElementById(\'subpassprogressbar\').style.backgroundColor=color;
			document.getElementById(\'subpassprogressbar\').style.width=width+\'%\';
		 }
	</script> 
'; ?>

<div id="error" align="center" style="display:none"></div>
<form id="signupform" name="signupform" action="http://localhost/user/<?php if ($this->_tpl_vars['sm']['flag']): ?>update_profile<?php else: ?>insert<?php endif; ?>" method="post" onSubmit="return checkvalidate();">
    <table align="center" class="form_tbl">
        <tr>
            <th colspan="2"><?php if (! $this->_tpl_vars['sm']['res']['username']): ?>You're Almost There!<?php else: ?>Edit Profile &nbsp;&nbsp;&nbsp;&nbsp;<a href="http://localhost/user/change_password">Change Password</a><?php endif; ?></th>
        </tr> 
        <tr>
            <td align="right">First Name :</td>
            <td align="left"><input type="text" name="user[first_name]" id="fname" value="<?php echo $this->_tpl_vars['sm']['res']['first_name']; ?>
" />
            <span id="err"><?php echo $this->_tpl_vars['sm']['err']['first_name']; ?>
</span>
            </td>
        </tr>
        <tr>
            <td align="right">Last Name :</td>
            <td align="left"><input type="text" name="user[last_name]" id="lname" value="<?php echo $this->_tpl_vars['sm']['res']['last_name']; ?>
" />
            <span id="err1"><?php echo $this->_tpl_vars['sm']['err']['last_name']; ?>
</span>
            </td>
        </tr>
        <tr>
            <td align="right">Username:</td>
            <td align="left"><input type="text" name="user[username]" id="username" value="<?php echo $this->_tpl_vars['sm']['res']['username']; ?>
" <?php if ($this->_tpl_vars['sm']['flag']): ?>readonly="readonly"<?php endif; ?> <?php if (! $this->_tpl_vars['sm']['flag']): ?>onblur="return show_username_exist();"<?php endif; ?> />
			<span id="add_user_msg"><b></b></span>
            <span id="err2"><?php if ($this->_tpl_vars['sm']['d_name']):  echo $this->_tpl_vars['sm']['d_name'];  else:  echo $this->_tpl_vars['sm']['err']['username'];  endif; ?></span>
            </td>
        </tr>
        <tr>
            <td align="right">Email : </td>
            <td align="left"><input type="text" name="user[email]" id="email" value="<?php echo $this->_tpl_vars['sm']['res']['email']; ?>
" />
            <span id="err3"><?php echo $this->_tpl_vars['sm']['err']['email']; ?>
</span>
            </td>
        </tr>
        <?php if (! $this->_tpl_vars['sm']['flag']): ?>
        <tr>
            <td align="right">Password : </td>
            <td align="left"><input type="password" name="user[password]" id="pwd" value="<?php echo $this->_tpl_vars['sm']['res']['password']; ?>
" onkeyup="checkpassword();"/>
            <span id="err4"><?php echo $this->_tpl_vars['sm']['err']['password']; ?>
</span>
            </td>
        </tr>
        <tr>
        	<td colspan="3">
                <div id="passprogressbar">
                    <div id="subpassprogressbar">
                        <span id="status">&nbsp;</span>
                    </div>
                 </div>
            </td>
        </tr>
        <tr>
            <td align="right">Confirm Password : </td>
            <td align="left"><input type="password" name="cpwd" id="cpwd" value="<?php echo $this->_tpl_vars['sm']['conf_pwd']; ?>
" />
            <span id="err9"><?php echo $this->_tpl_vars['sm']['err']['conf_pwd']; ?>
</span>
            </td>
        </tr>
         <?php endif; ?>
        <tr>
            <td align="right">Gender : </td>
            <td align="left">
            	<?php echo smarty_function_html_radios(array('name' => 'gender','options' => $this->_tpl_vars['sm']['gender'],'selected' => $this->_tpl_vars['sm']['res']['gender']), $this);?>
<br />
                <label for="gender" class="error" style="display:none">Please choose one option.</label>
				 <span id="err5"><?php echo $this->_tpl_vars['sm']['err']['gender']; ?>
</span>
            </td>
        </tr>
       
        <tr>
            <td align="right">Date of Birth : </td>
            <td align="left">
            <?php if ($this->_tpl_vars['sm']['res']['dob']): ?>
				<?php $this->assign('date', $this->_tpl_vars['sm']['res']['dob']); ?>
            <?php else: ?>
				<?php $this->assign('date', "--"); ?>
			<?php endif; ?>
                <?php echo smarty_function_html_select_date(array('prefix' => 'dob_','start_year' => "-110",'end_year' => "+1",'year_empty' => 'Year','month_empty' => 'Month','day_empty' => 'Date','reverse_years' => true,'time' => $this->_tpl_vars['date'],'month_extra' => 'onchange="check_date();"','day_extra' => 'id="dt"'), $this);?>

				 <span id="err8"><?php echo $this->_tpl_vars['sm']['err']['dob']; ?>
</span>
            </td>
        </tr>
		<tr>
			<td align="right"><a href="http://localhost/templates/default/user/termsandconditions.html" target="_blank">Terms and Conditions</a>
			<input type="checkbox" name="toc" id="toc" value="0" onclick="validateCheck();"/></td>
		</tr>
        <tr>
        	<td>&nbsp;</td>
            <td><input type="submit" id = "register" disabled = '' 	value="<?php if ($this->_tpl_vars['sm']['flag']): ?>Update<?php else: ?>Register<?php endif; ?>" class="btn" /></td>
        </tr>
    </table>
</form>

<!-- Template: user/register.tpl.html End --> 