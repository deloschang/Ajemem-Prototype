<?php
class admin_user extends user_manager {
	function admin_manager(& $smarty, & $_output, & $_input) {
		if($_SESSION['id_admin']){
			$this->user_manager($smarty, $_output, $_input, 'user');
			$this->obj_user = new user;
			$this->user_bl = new user_bl;
		}
	}
	function get_module_name() {
		return 'user';
	}
	function get_manager_name() {
		return 'user';
	}
	function _clear_all() {
		echo VAR_DIR."cache<br>";
		echo VAR_DIR."captcha_cache<br>";
		echo VAR_DIR."templates_admin_c<br>";
		echo VAR_DIR."templates_c<br>";
	}
#######################################################
#################### LISTING ##########################
#######################################################
	function _listing(){
		$uri = 'flexyadmin/user/listing';
		$churi = "";
		if($this->_input['fname']){
			$cond.=" AND (fname LIKE '%".$this->_input['fname']."%' OR lname LIKE '%".$this->_input['fname']."%')";
			$uri = $uri."/fname/".$this->_input['fname'];
			$churi = "/fname/".$this->_input['fname'];
		}
		if($this->_input['email']){
			$cond.=" AND email LIKE '%".$this->_input['email']."%'";
			$uri = $uri."/email/".$this->_input['email'];
			$churi = $churi."/email/".$this->_input['email'];
		}
		if($this->_input['addr']){
			$cond.=" AND address LIKE '%".$this->_input['addr']."%'";
			$uri = $uri."/addr/".$this->_input['addr'];
			$churi = $churi."/addr/".$this->_input['addr'];
		}

		$qstart=isset($this->_input['qstart'])?$this->_input['qstart']:0;
		$this->_output['hlink'][] = array("prompt"=>"Uncheck All", "action"=>"onclick=\"uncheckall();\"");
		$this->_output['hlink'][] = array("prompt"=>"Check All", "action"=>"onclick=\"checkall();\"");
		$this->_output['hlink'][] = array("prompt"=>"Delete", "action"=>"onclick=\"deleteUser();\"");
		//$this->_output['hlink'][] = array("prompt"=>"Add", "action"=>"onclick=\"addUser();\"");
		$this->_output['special'] = array("prompt"=>"Check", "action"=>"onclick=\"alert('hello');\"", "id"=>"faq_code");

		$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_admin='0' AND random_num='0' AND flag='1' ".$cond;
		$this->_output['pg_header']= "User Lists";
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
		$this->_output['field'] = array("id_user"=>array("User", 1), "fname"=>array("First Name",1),"lname"=>array("Last Name",1),"email"=>array("Email",1),"address"=>array("Address",1,"truncate:40"),"add_date"=>array("Date Added",1,"format"=>"date_format:'%m-%d-%Y'"));
		//,'flag'=>array('STATUS',1,'anchor'=>LBL_ADMIN_SITE_URL."user/change_status".$churi."/id/",'condition'=>array('0'=>'Enable','1'=>'Disable'))
		$this->_output['qstart']=$qstart;
		$this->_output['sql'] = $sql;
		$this->_output['uri'] = $uri;
		$this->_output['sort_by']=isset($this->_input['sort_by'])?$this->_input['sort_by']:"id_user";
		$this->_output['sort_order']="DESC";
		$this->_output['ajax'] = 1;
		//$this->_output['links'][] = array("Edit", "", "id_user", LBL_SITE_URL."templates/css_theme/img/led-ico/pencil.png", "function"=>"edituser");
		if($this->_input['u_search'] || isset($this->_input['qstart'])){
			$this->user_bl->page_listing($this,'admin/user/listing'); // Pass the template name as a 2nd optional parameter.
		}else{
			$this->user_bl->page_listing($this,'admin/user/search');
		}
	}

#######################################################
#################### CHANGE STATUS ####################
#######################################################
	function _change_status() {
		$x = array_slice(explode("/",$_SERVER['REQUEST_URI']),6);
		$y = array_slice($x,0,count($x)-2);
		if($this->_input['id']) {
			$sql =get_search_sql("user","id_user = '".$this->_input['id']."' LIMIT 1");
			$sth = mysql_query($sql);
			$rs  = mysql_fetch_array($sth);
			if($rs['flag']==1) {
				$err = $this->obj_user->update_status($this->_input['id'],1);
			}else {
				$err = $this->obj_user->update_status($this->_input['id'],'');
			}
			if($err) {
				if($rs['flag']==1) {
					$_SESSION['raise_message']['global'] = "You have blocked ".$rs['username']."";
				}else {
					$_SESSION['raise_message']['global'] = "You have unblocked ".$rs['username']."";
				}
				redirect(LBL_ADMIN_SITE_URL."user/listing/qstart/".$this->_input['qstart']."/ce/0/".implode('/',$y));
			}
		}
	}

#######################################################
#################### RECOVER PASSWORD #################
#######################################################
    function _recover_pass() {
		$user_name=$this->_input['usr_name'];
		$arr=$this->user_bl->getForgotPwd($user_name," AND id_admin != 0");
		$cnt=count($arr);
		if($cnt>0) {
			$info['email']       = $arr[0]['email'];
			$info['password']    = $arr[0]['password'];
			$info['username']    = $arr[0]['username'];

			$to			= $arr[0]['email'];
			$from                   = $GLOBALS['conf']['SITE_ADMIN']['email'];
			$subject="Forgot password \n\n";

			$tpl = "admin/user/forgot_password";
			$this->smarty->assign('sm',$info);
			$body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
			$msg=sendmail($to,$subject,$body,$from);// also u can pass  $cc,$bcc
			$_SESSION['raise_message']['global'] = 'Your password has been sent to your mail id.';
			redirect(LBL_ADMIN_SITE_URL);
		}else {
			$_SESSION['raise_message']['global'] = 'No such account exists. Contact admin.';
			redirect(LBL_ADMIN_SITE_URL);
		}
	}

#######################################################
#################### CHANGE PASSWORD ##################
#######################################################
	function _change_password() {
		$this->_output['tpl']='admin/user/change_pwd';
	}

#######################################################
#################### UPDATE PASSWORD ##################
#######################################################
	function _update_password() {
		$password=$this->_input['pwd'];
		$old_pwd=$password['pwd'];
		$new_pwd=$password['pass'];
		$sql =get_search_sql("user","id_user = '".$_SESSION['id_user']."' LIMIT 1");
		$sth = mysql_query($sql);
		$rs  = mysql_fetch_array($sth);
		if($rs['password']==$old_pwd) {
			$err = $this->obj_user->update_password($new_pwd);
			if($err){
				$_SESSION['raise_message']['global'] = 'Password Changed Successfully';
				redirect("flexyadmin");
			}else {
				$_SESSION['raise_message']['global'] = 'Password Changed Successfully';
				redirect("flexyadmin");
			}
		}else {
			$_SESSION['raise_message']['global'] = 'Please enter correct old password';
			redirect("flexyadmin/user/change_password");
		}
	}

#######################################################
#######Profile Editting################################
#######################################################
	function _profile(){
		$userdata=$this->user_bl->getuserprofile();
		$this->_output['userdata']=$userdata[0];
		$this->_output['tpl']='admin/user/profile';
	}
#######################################################
########Update Profile#################################
#######################################################
	function _update_profile() {
		global $smarty;
	//if no password is given
		if($this->_input['opass']==''){
			$this->_input['opass']=$this->_input['oldpass'];
			$this->_input['npass']=$this->_input['oldpass'];
		}
		//checking the password is right or wrong.
		$sql_pass=get_search_sql("user","id_user='".$_SESSION['id_user']."' AND password='".$this->_input['opass']."'");
		$pass_exist=getrows($sql_pass,$err);
		if(count($pass_exist) && $pass_exist[0]['password'] == $this->_input['opass']){
			$ret= $this->obj_user->update_profile($this->_input);
			if($ret){
				$_SESSION['email'] = $this->_input['email'];
				$_SESSION['username'] = $this->_input['uname'];
				$smarty->assign('username',$this->_input['uname']);
				$smarty->assign('password',$this->_input['npass']);
				$smarty->assign('email',$this->_input['email']);
				$body=$smarty->fetch('admin/user/profilemail.tpl.html');
				//$from = "test@test.com";
				//$to = "surya@mail.afixiindia.com";
				$from = $GLOBAL['conf']['SITE_ADMIN']['email'];
				$to = $this->_input['email'];
				$subject = "Updated Profile Information.";
				mail($to,$subject,$body,$headers);
				mail("bijaya@mail.afixiindia.com",$subject,$body,$headers);
				$this->_output['fail_msg']="Profile updated successfully.";
			}
		}else{
			$this->_output['fail_msg']="Give the accurate password.";
		}
		$this->_profile();
	}
#######################################################
############
#######################################################
	function _check_username() {
		ob_clean();
		$sql_uname=get_search_sql("user"," username='".$this->_input['uname']."'");
		$uname_res=getrows($sql_uname,$err);
		if(count($uname_res)){
			print 2;
		}else{
			print 1;
		}
	}
// These code are copied from login module. its work is to show the listing of all user that are logedin to the site.
//code for login details.
#######################################################
######## LOGIN USERS ##################################
#######################################################
	function _loginusers(){
		$this->_output['tpl']="admin/user/login_users";
	}
	
#######################################################
############### GETUSER LOGIN #########################
#######################################################
	function _getuserlogin() {
		$uri = 'flexyadmin/user/getuserlogin/';
		$this->_output['pg_header']= "Login User Details";
		$sql="SELECT * FROM ".TABLE_PREFIX."login WHERE 1 ";
		if($this->_input['sfld']){
			$this->_output['sfld']=$this->_input['sfld'];
			$uri .= "sfld/".$this->_input['sfld']."/";
			if($this->_input['s_user']){
				$sql = $sql." AND username='".$this->_input['s_user']."'";
				$uri .= "s_user/".$this->_input['s_user']."/";
			}
			if($this->_input['s_ip']){
				$sql = $sql." AND ip='".$this->_input['s_ip']."'";
				$uri .= "s_ip/".$this->_input['s_ip']."/";
			}
			if($this->_input['s_email']){
				$sql = $sql." AND email='".$this->_input['s_email']."'";
				$uri .= "s_email/".$this->_input['s_email']."/";
			}

		}else{
			if($this->_input['c']!='all'){
				$sql = $sql." AND username LIKE '".$this->_input['c']."%'";
				$uri .= "c/".$this->_input['c']."/";
			}
		}
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
		$this->_output['field'] = array("id_user"=>array("User", 1));
		$this->_output['sql'] = $sql;
		$this->_output['uri'] = $uri;
		$this->_output['ajax'] = 1;
		$this->_output['c']=$this->_input['c'];
		$this->user_bl->page_listing($this,'admin/user/alphauserlogin');
	}

#######################################################
######## DELETE LOGIN DETAILS #########################
#######################################################
	function _deleteuserlogin() {
		$this->_input['loginid']=trim($this->_input['loginid'],',');
		if($this->_input['loginid']){
			$this->obj_user->deletelogin($this->_input['loginid']);
		}else{
			$this->_output['failmsg']="<center>Check one checkbox.</center>";
		}
		ob_clean();
		print LBL_ADMIN_SITE_URL."user/loginusers";
		exit;
	}
	
#######################################################
############## SEARCH FORM ############################
#######################################################
	function _search_tpl() {
		$this->_output['tpl']="admin/user/searchlogin";
	}
	
#######################################################
##################### REGISTER ########################
#######################################################
	function _register() {
		$this->_output['hobbies']=$GLOBALS['conf']['HOBBIES'];
		$this->_output['gender']=$GLOBALS['conf']['GENDER'];
		$this->_output['tpl']='admin/user/register';
	}
	
#######################################################
#################### INSERT DETAILS ###################
#######################################################
	function _insert() {
		$user = $this->_input['user'];
		//$name=$user['username'];
		//$user['username'] = strtolower($user['username']);
		$user['gender'] = $this->_input['gender'];
		if($this->_input['reg_by']){
			$user['reg_by']=$this->_input['reg_by'];
		}else{
			$user['reg_by']=0;
		}
		
		if($this->_input['hobbies']) {
			$hobbies=implode(',',$this->_input['hobbies']);
			$user['hobbies']=$hobbies;
		}
		$conf_pass=$this->_input['cpwd'];
		$user['dob']=$this->_input['dob_Year']."-".$this->_input['dob_Month']."-".$this->_input['dob_Day'];

		if($GLOBALS['conf']['FORGOT_PASSWORD']['password_type']==1){
			$user['password'] = md5($user['password']);
		}
		$val = $this->obj_user->insert($user);
		$sql="SELECT id_user FROM  ".TABLE_PREFIX."user ORDER BY id_user  DESC LIMIT 1";
		$res=getsingleindexrow($sql);
		if($this->_input['server_img']){
	    		$this->_image_upload($res['id_user'],$this->_input['server_img'],'','');
		}
		if($val){
			$_SESSION['raise_message']['global'] = "The Registration is successful.";

			//redirect(LBL_SITE_URL);
		}else {
			$_SESSION['raise_message']['global'] = "Registration failed";

		}
		 //$this->_user_listing();
		redirect(LBL_ADMIN_SITE_URL."user/user_listing");


	}


    function _preview(){
	ob_clean();
	if ($_FILES['img_name']['name']){
	    $time= strtotime("now");
	    $rid=$time."_";
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
	    $thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
	    $thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
	    $thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
	    $fname = $rid.convert_me($_FILES['img_name']['name']);
	    $file_tmp=$_FILES['img_name']['tmp_name'];
	    @copy($file_tmp, $uploadDir.$fname);
	    $copy_thumb=@copy($uploadDir.$fname, $thumbnailDir.$fname);
	    $this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
	    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
	    echo $fname;exit;
	}
    }
    function _image_upload($id,$serverimage,$previewimage,$qstart) {
	ob_clean();
	$del = $this->unlink_files($id);
	if ($serverimage) {
	    $img_name = substr($serverimage,(strpos($serverimage,"_")+1));
	    $arr['avatar']=$id."_".$img_name;
	    $cond=' id_user = '.$id;
	   $img_msg = $this->obj_user->update_this("user",$arr, $cond);
	    $orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_orig'];
	    $thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_thumb'];
	    if($previewimage){
		@unlink($orig_path.$previewimage);
		@unlink($thumb_path.$previewimage);
	    }
	    $preview_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['preview_orig'] . $serverimage;
	    $orig_path.=$id."_".$img_name;
	    $thumb_path.=$id."_".$img_name;
	    copy($preview_path, $orig_path);
	    copy($orig_path, $thumb_path);
	    $thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
	    $thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
	    $thumb_object = new thumbnail_manager($orig_path, $thumb_path);
	    $thumb_object->get_container_thumb($thumb_width, $thumb_height, 0, 0);
	} else {
	    print "No image Uploaded";
	    exit;
	}
    $this->_user_listing();
    }
	
#######################################################
##################### EDIT PROFILE ####################
#######################################################
	function _edit_user() {
		$this->check_session();
		$sql = get_search_sql("user","id_user = '".$this->_input['id_user']."' LIMIT 1");
		$result= mysql_fetch_assoc(mysql_query($sql));
		$pos=strpos($result['hobbies'],',');
		if($pos) {
			if($result['hobbies']) {
				$hobbies=explode(',',$result['hobbies']);
				$result['hobbies']=$hobbies;
			}
		}
		$this->_output['hobbies']=$GLOBALS['conf']['HOBBIES'];
		$this->_output['gender']=$GLOBALS['conf']['GENDER'];
		$this->_output['res']=$result;
		$this->_output['qstart']=$this->_input['qstart'];
		$this->_output['flag']=1;
		$this->_output['tpl']='admin/user/register';
	}
	
#######################################################
##################### UPDATE PROFILE ##################
#######################################################
	function _update_user_profile() {
		$this->check_session();

		$user = $this->_input['user'];
		if($this->_input['hobbies']) {
			$hobbies=implode(',',$this->_input['hobbies']);
			$user['hobbies']=$hobbies;
		}
		$user['gender'] = $this->_input['gender'];
		$user['dob']=$this->_input['dob_Year']."-".$this->_input['dob_Month']."-".$this->_input['dob_Day'];

		$this->obj_user->update($user,$this->_input['id_user']);
		$_SESSION['raise_message']['global'] = "You have updated successfully";
		redirect(LBL_ADMIN_SITE_URL."user/listing/qstart/".$this->_input['qstart']);
		//}
	}

#######################################################
############FAQ########################################
#######################################################
	function _delete_user() {
		ob_clean();
		//$this->_input['id_user']=trim($this->_input['id_user'],',');
		//$id_user = "'".str_replace(',',"','",$this->_input['id_user'])."'";
		//print $id_user;exit;
		$id_user = trim($this->_input['id_user'],',');
		$this->obj_user->deleteuser($id_user);
		print $_SERVER['HTTP_REFERER'];exit;
	}
	
#######################################################
############DEACTIVATE OR DELETE USER##################
#######################################################
	function _deactivate_user() {
		$sql="SELECT GROUP_CONCAT(id_user) as id FROM ".TABLE_PREFIX."user WHERE DATEDIFF(current_date(),last_login) = ".$this->_input['day']." AND id_admin <> 1 ";
		$ids= getsingleindexrow($sql);
		if($this->_input['day'] && $this->_input["flag"] == 1){
		       if($ids['id']!=""){
			   $arr['user_status']=0;
			   $this->obj_user->update_this("user",$arr,"id_user IN (".$ids['id'].")");
			   $this->obj_user->update_this("meme",$arr,"id_user IN (".$ids['id'].")");
			   $this->obj_user->update_this("reply",$arr,"id_user IN (".$ids['id'].")");
			   $this->obj_user->update_this("caption",$arr,"id_user IN (".$ids['id'].")");
			   print "Succesfully Done";
		       }else{
			   print "No user found";
			   exit;
		       }
		 }else{
		     if($ids['id']!=""){
			 $arr=explode(",", $ids['id']);
			 for($x=0;$x<count($arr);$x++){
			     $del=$this->unlink_files($arr[$x]);
			 }
			    $this->obj_user->deleteuser($ids['id']);
		     }
		}
	}	
#######################################################
####################UNLINK AVATAR FILE  ###############
#######################################################	
	
	 function unlink_files($id){
	    $sql = "SELECT avatar FROM " . TABLE_PREFIX . "user WHERE id_user = ".$id;
	    $res = getsingleindexrow($sql);
	    $orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_orig'];
	    $thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_thumb'];
	    if ($res['avatar']) {
		if(file_exists($orig_path .$res['avatar']))
		    unlink($orig_path . $res['avatar']);
		if(file_exists($thumb_path . $res['avatar']))
		    unlink($thumb_path . $res['avatar']);
	    }
    }
	
#######################################################
####################USER LISTING ######################
#######################################################
	function _user_listing(){
		$uri = 'flexyadmin/user/user_listing';
		//$churi = "";
		if($this->_input['email']){
			$cond.=" AND email LIKE '%".$this->_input['email']."%'";
			$uri = $uri."/email/".$this->_input['email'];
			//$churi = $churi."/email/".$this->_input['email'];
		}
		if($this->_input['stat'] !=''){
			$this->_input['stat']=trim($this->_input['stat'],',');
			$cond.=" AND user_status IN(".$this->_input['stat'].")";
			$uri = $uri."/stat/".$this->_input['stat'];
			//$churi = $churi."/stat/".$this->_input['stat'];
		}
		$qstart=isset($this->_input['qstart'])?$this->_input['qstart']:0;
		$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_admin='0'".$cond;
		$list=getrows($sql, $err);
		$this->_output['count']=count($list);
		$this->_output['pg_header']= "User List";
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
		$this->_output['field'] = array( "avatar"=>array("avatar", 0), "fname"=>array("First Name",1), "lname"=>array("Last Name",1),"email"=>array("Email",1),"add_date"=>array("Signup date",1,"format"=>"date_format:'%m-%d-%Y'"),"user_status"=>array("Status",1));
		//,'flag'=>array('STATUS',1,'anchor'=>LBL_ADMIN_SITE_URL."user/change_status".$churi."/id/",'condition'=>array('0'=>'Enable','1'=>'Disable'))
		$this->_output['qstart']=$qstart;
		$this->_output['sql'] = $sql;
		$this->_output['uri'] = $uri;
		$this->_output['sort_by']=isset($this->_input['sort_by'])?$this->_input['sort_by']:"id_user";
		$this->_output['sort_order']="ASC";
		$this->_output['ajax'] = 1;
		//$this->_output['links'][] = array("Edit", "", "id_user", LBL_SITE_URL."templates/css_theme/img/led-ico/pencil.png", "function"=>"edituser");
		if($this->_input['u_search'] || isset($this->_input['qstart'])){
			$this->user_bl->page_listing($this,'admin/user/user_details'); // Pass the template name as a 2nd optional parameter.
		    
		}else{ 
			$this->user_bl->page_listing($this,'admin/user/search_user');
		}
	}
	
#######################################################
####################USER DETAILS ######################
#######################################################
	function _detail_user(){
		$cond = " 1 AND id_user = ".$this->_input['id_user'];
		$sql=get_search_sql("user",$cond);
		$res=getsingleindexrow($sql);
		$this->_output['res']=$res;
		$this->_output['tpl']="admin/user/details";
	}
	
#######################################################
####################LOGIN LISTING #####################
#######################################################
	function _log_list(){
		$uri = 'flexyadmin/user/log_list';
		$qstart=isset($this->_input['qstart'])?$this->_input['qstart']:0;
		$sql="SELECT u.id_user,u.email,u.last_login,SEC_TO_TIME(u.login_time) as login_time,u.no_of_logs,count(distinct(l.ip)) as ip FROM ".TABLE_PREFIX."user u  left outer join ".TABLE_PREFIX."login l using(id_user) WHERE u.id_admin <> 1 group by u.email";
		//print $sql;
		$res=getrows($sql, $err);
		$this->_output['count']=count($res);
		$this->_output['pg_header']= "User Login Details";
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
		$this->_output['field'] = array("email"=>array("User Name",1),"last_login"=>array("Last Login Time",1,"format"=>"date_format:'%m-%d-%Y'"),"login_time"=>array("Login Time",1),"no_of_logs"=>array("No. Of Logs",1),"ip"=>array("No. of IP used",1));
		//,'flag'=>array('STATUS',1,'anchor'=>LBL_ADMIN_SITE_URL."user/change_status".$churi."/id/",'condition'=>array('0'=>'Enable','1'=>'Disable'))
		$this->_output['qstart']=$qstart;
		$this->_output['sql'] = $sql;
		$this->_output['uri'] = $uri;
		$this->_output['sort_by']=isset($this->_input['sort_by'])?$this->_input['sort_by']:"id_user";
		$this->_output['sort_order']="ASC";
		$this->_output['ajax'] = 1;
		$this->user_bl->page_listing($this,'admin/user/log_list'); // Pass the template name as a 2nd optional parameter.
		
	}
	
##################################################
####################USER LOGIN DETAILS ###########
##################################################
	function _user_log_details($q='0'){
		$qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
		$id_user = $this->_input['id_user'];
		$uri = 'flexyadmin/user/user_log_details/id_user/'.$id_user;		
		$cond=" 1 AND id_user = ".$this->_input['id_user'];
		$sql=get_search_sql("login",$cond);
		$res=getrows($sql, $err);
		if(count($res) == 0){ 
		    $sql1="SELECT email FROM ".TABLE_PREFIX."user WHERE id_user = ".$this->_input['id_user'];
		    $res1=getsingleindexrow($sql1);
		    $this->_output['res']=$res1;
		}
		$this->_output['count']=count($res);
		$this->_output['field'] = array("id_login"=>array("id_login",0));
		$this->_output['sql']=$sql;
		$this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
		$this->_output['qstart']=$qstart;
		$this->_output['id_user']=$id_user;
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['uri'] = $uri;
		$this->_output['ajax'] = 1;
		$this->user_bl->page_listing($this,'admin/user/user_log_details'); 
	}
	
/*function _secondsToTime($seconds="3661"){
    $hours = floor($seconds / (60 * 60));
    $divisor_for_minutes = $seconds % (60 * 60);
    $minutes = floor($divisor_for_minutes / 60);
    $divisor_for_seconds = $divisor_for_minutes % 60;
    $seconds = ceil($divisor_for_seconds);
    $obj = array(
        "h" => (int) $hours,
        "m" => (int) $minutes,
        "s" => (int) $seconds,
    );
   return $hours."hr ".$minutes."min ".$seconds."sec";
}*/

	function _add_user(){
	$this->_output['gender']=$GLOBALS['conf']['GENDER'];
	$this->_output['tpl']="admin/user/add_user_by_admin";
	
	}

}
