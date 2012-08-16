<?php
if($_REQUEST['choice']=='facebook_info' or $_REQUEST['choice']=='logout' or $_REQUEST['choice']=='check_fb_session' or $_REQUEST['choice']=='test' or $_REQUEST['choice'] == 'getfriends4tag'){
	require_once(APP_ROOT."flexycms/classes/common/facebook-library/facebook.php");
}
class user_manager extends mod_manager {
	function user_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'user');
		$this->obj_user = new user;
		$this->user_bl = new user_bl;
 	}
	function get_module_name() {
		return 'user';
	}
	function get_manager_name() {
		return 'user';
	}
	//Added By Parwesh For Error Handling
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);//$call(&$this);
		} else {
			print "<h1>User Manager Error</h1>";
		}
	}
	function _default() {
		return $this->_login_form();
	}
	function _phpinfo(){
		phpinfo();
	}
	function _unzip(){
		$file = $this->_input['file'];
		if (file_exists($file)) {
			$ext = array_pop(explode(".", $file));
			if (strtolower($ext) == "zip") {
				if (!$this->_input['r'])
					echo "<font color='red'><b>Please add -r-1 in the URL to unzip the $file</b>.</font>";
				$file = $this->_input['r'] ?  $file : " -l ".$file;
				print "<pre>";
				passthru("unzip $file");
			} else {
				echo "<font color='red'><b>$file</b> is not a valid zip file. Try another.</font>";
			}
		} else {
			echo "<font color='red'>The <b>$file</b> not found in the server.</font>";
			print "<br><br><b>List of All zip files</b><pre>";
			passthru("ls -ll *.zip");
		}
	}
	function _untar(){
		$file = $this->_input['file'];
		if (file_exists($file)) {
			$ext = array_pop(explode(".", $file));
			if (strtolower($ext) == "tar") {
				if (!$this->_input['r'])
					echo "<font color='red'><b>Please add -r-1 in the URL to untar the $file</b>.</font>";
				$file = $this->_input['r'] ?  " -zxf ".$file : " -ztf ".$file;
				print "<pre>";
				passthru("tar $file");
			} else {
				echo "<font color='red'><b>$file</b> is not a valid tar file. Try another.</font>";
			}
		} else {
			echo "<font color='red'>The <b>$file</b> not found in the server.</font>";
			print "<br><br><b>List of All tar files</b><pre>";
			passthru("ls -ll *.tar");
		}
	}
##################################################
##################### LOGIN FORM #################
##################################################
	function _login_form(){
		setcookie('refer', $this->_input['refer'], time()+60*60*24*365, "/".SUB_DIR);
		$login = 1;
		if(isset($_COOKIE['username']) && isset($_COOKIE['password'])){
			$login = $this->get_checkcookie();
		} elseif($_SESSION['id_user'] && !$_SESSION['id_admin']) {
			//redirect(LBL_SITE_URL."meme/meme_list/cat/main_feed");
			//blocked
		}

	}

##################################################
##################### REGISTER ###################
##################################################
	function _register() {
		$this->_output['hobbies']=$GLOBALS['conf']['HOBBIES'];
		$this->_output['gender']=$GLOBALS['conf']['GENDER'];
		$this->_output['tpl']='user/register';
	}

##################################################
##################### CHECK LOGIN ################
##################################################
	function check_login($uname){
		global $link;
		
		// Check via email
		$sql = get_search_sql("user","email = '".$uname."' LIMIT 1");
		$query = mysqli_query($link,$sql);
		$res  = mysqli_fetch_assoc($query);
		if($res) {
			return $res;
		} else {
		
			// Check via username
			$sql = get_search_sql("user","username = '".$uname."' LIMIT 1");
			$query = mysqli_query($link,$sql);
			$res  = mysqli_fetch_assoc($query);
			
			if ($res) {
				return $res;
			} else {
				return 0;
			}
		}
	}

##################################################
##################### SET LOGIN ##################
##################################################
    function _set_login($name="",$pass=""){	
        if($name && $pass) {
            $uname = strtolower($name);
            $pwd = $pass;
        } else {
            $uname = strtolower($this->_input['username']);
            $pwd = $this->_input['password'];
        }
		/*if($uname == 'afixi' &&  $pwd == "memeja"){
			$_SESSION['id_user'] = 99;
			$_SESSION['username'] = "developer";
			$_SESSION['id_developer'] = 99;
			$_SESSION['id_admin'] = 99;
			$_SESSION['raise_message']['global'] = "Successfully logged in";
			redirect(LBL_ADMIN_SITE_URL);
		}*/
        // $rem = $this->_input['rem'];
        // $admin_url =  $this->_input['admin_st'];
		
        // if (empty($uname)||empty($pwd)){
            // $_SESSION['raise_message']['global']=  "<center>". "Please enter a username  & password";
            // if($admin_url) {
                // redirect(LBL_ADMIN_SITE_URL);
            // }
            // else {
                // redirect(LBL_SITE_URL);
            // }
        // }

        // $logincount=$_SESSION['login_count'];
        $result= $this->check_login($uname);
        if($result !=0){
            //if(($uname==$result['email'] || $uname==$result['username']) && $pwd==$result['password'])
            if((strcasecmp($uname,$result['email'])==0 || strcasecmp($uname,$result['username'])==0) && $pwd==$result['password']){
                //if($result['random_num']=='0') {
                    if($result['flag']==1) {
                        if($result['user_status']==1){
                            //$arr['id_user']=$result['id_user'];
                            //$arr['email']=$result['email'];
                            //$arr['ip']=$_SERVER['REMOTE_ADDR'];
                            //$id=$this->obj_user->insert_all("login",$arr,1,'date_login');

                            //$user_arr['no_of_logs'] = "no_of_logs+1";
                            //$sql_login=$this->obj_user->update_this("user",$user_arr," id_user=".$result['id_user'],1);

                            $info = array('autologin' => 1,'id_user' => $result['id_user'],
                                'username' => $result['username'],
                                'email' => $result['email'],
                                'password' => $result['password']);
						
                            $dconf=array_flip($GLOBALS['conf']['USER_TYPE']);

                            $_SESSION['fname']=$result['fname'];
                            $_SESSION['lname']=$result['lname'];
                            $_SESSION['email'] = $result['email'];
                            $_SESSION['username'] = $result['username'];
							$_SESSION['dupe_username'] = $result['dupe_username'];
						
                            if ($result['fb_pic_normal']) {
                                $_SESSION['fb_pic_normal'] = $result['fb_pic_normal'];
                            } else {
                                $_SESSION['avatar'] = $result['avatar'] ? $result['avatar']:($result['gender']=='M'?'memeja_male.png':'memeja_female.png');
                            }
						
                            //$_SESSION['friends']=$result['memeje_friends'];
                            $_SESSION['gender']=$result['gender'];
                            $_SESSION['id_user'] = $result['id_user'];
							$_SESSION['uid'] = $result['uid'];
						
                            // User Level
                            $_SESSION['exp_point'] = $result['exp_point'];
                            $_SESSION['level'] = $result['level'];
                            $previous_level = $result['level'] - 1;
						
                            // Find XP to Next Level
                            $sql_xp = "SELECT * FROM ".TABLE_PREFIX."level WHERE level=".$_SESSION['level'];
                            $sql_previous_xp = "SELECT * FROM ".TABLE_PREFIX."level WHERE level=".$previous_level;
						
                            $results_xp = getsingleindexrow($sql_xp);
                            $results_previous_xp = getsingleindexrow($sql_previous_xp);
	   					
                            $_SESSION['xp_to_level'] = (int)$results_xp['xp_to_level'];
                            $_SESSION['previous_xp_to_level'] = (int)$results_previous_xp['xp_to_level'];
						
                            // Experience Points Rank
                            $sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=".$_SESSION['id_user'];
                            $res_ach=getsingleindexrow($sql_ach);
						
                            $_SESSION['exp_rank']=$res_ach['POSITION'];
                            $one_less_rank = $_SESSION['exp_rank'] + 1;
						
                            $sql_one_less="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE POSITION=".$one_less_rank;
                            $res_one_less=getsingleindexrow($sql_one_less);
						
                            $_SESSION['one_less_rank'] = $one_less_rank;
                            //$_SESSION['one_less_exp'] = $res_one_less['exp_point'];
                            $_SESSION['one_less_user'] = $res_one_less['username'];
							$_SESSION['one_less_dupe_username'] = $res_updated_other['dupe_username'];
							$_SESSION['one_less_pic'] = $res_one_less['fb_pic_normal'];
							$_SESSION['one_less_avatar'] = $res_one_less['avatar'];
							$_SESSION['one_less_gender'] = $res_one_less['gender'];

						
                            // End
							
                            ////$_SESSION['login_count']=0;
							
                            //$page['id_user']=$result['id_user'];
                            //$id_page=$this->obj_user->insert_all("page",$page);
							
                            ////$_SESSION['id_page']='';//$id_page;
							
                            //if($_SESSION['id_admin']){
                            //    redirect(LBL_ADMIN_SITE_URL);
                            //}else{
							
							//setcookie('username', $uname, time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('xp_to_level', $_SESSION['xp_to_level'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('previous_xp_to_level', $_SESSION['previous_xp_to_level'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('exp_rank', $_SESSION['exp_rank'], time()+60*60*24*365, "/".SUB_DIR);
							
							// setcookie('one_less_rank', $_SESSION['one_less_rank'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('one_less_user', $_SESSION['one_less_user'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('one_less_dupe_username', $_SESSION['one_less_dupe_username'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('one_less_pic', $_SESSION['one_less_pic'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('one_less_avatar', $_SESSION['one_less_avatar'], time()+60*60*24*365, "/".SUB_DIR);
							// setcookie('one_less_gender', $_SESSION['one_less_gender'], time()+60*60*24*365, "/".SUB_DIR);
								
								
                            redirect(LBL_SITE_URL);
								
                            //}
                        }
                        else
                        {
                            $_SESSION['raise_message']['global'] = "You are blocked.<br>Please contact admin.";
							echo('blocked');
                            //redirect(LBL_SITE_URL);
                        }

                    }
                    else {
                        $_SESSION['raise_message']['global'] = "You are blocked.<br>Please contact admin.";
						echo('blocked');
                        //redirect(LBL_SITE_URL);
                    }
                // } else {
                    // $_SESSION['raise_message']['global'] = "Please confirm your email.";
					// echo('email');
                    //redirect(LBL_SITE_URL);
                //}
            }
            else {
                $_SESSION['raise_message']['global'] = "Incorrect username and password. Please try again.";
                if($admin_url) {
                    redirect(LBL_ADMIN_SITE_URL);
                }
                else {
                    redirect(LBL_SITE_URL);
                }
            }
        }
        else {
            $_SESSION['raise_message']['global'] = "Login error - Incorrect user and password. Please try again.";
            if($admin_url) {
                redirect(LBL_ADMIN_SITE_URL);
            }
            else {
                redirect(LBL_SITE_URL);
            }
        }
    }
##################################################
##################### REMEMBER ME ################
##################################################
	function set_auto_login($info){
		$random = rand(2,10);
		$substring = substr($info['password'], 0, $random);
		$substring_encoded = base64_encode($substring);
		$v_user_password = md5($info['id_user'].$info['username'].$info['password']);
		setcookie('email', $info['email'], time()+60*60*24*365, "/".SUB_DIR);
		setcookie('username',$info['username'], time()+60*60*24*365, "/".SUB_DIR);
		setcookie('password', $v_user_password, time()+60*60*24*365, "/".SUB_DIR);
		setcookie('id_user', $info['id_user'], time()+60*60*24*365, "/".SUB_DIR);
	}

##################################################
##################### CHECK COOKIES ##############
##################################################
	function get_checkcookie(){
		$err1 = 1;
		$result = $this->get_user_detail($_COOKIE['username']);
		$count=count($result);
		if($count){
			$checkpass=md5($result[0]['id_user'].$result[0]['username'].$result[0]['password']);
			$substring = base64_encode($_COOKIE['v_sub_str']);
			$v_user_password = str_replace($substring,'',$_COOKIE['password']);
			if ($checkpass == $v_user_password) {
					$_SESSION['id_user'] = $result[0]['id_user'];
					$_SESSION['email'] = $result[0]['email'];
					$_SESSION['username'] = $result[0]['username'];
					if($result[0]['id_admin'] == $result[0]['id_user']) {
						$_SESSION['admin']=isset($this->_input['admin'])?$this->_input['admin']:1;
						if($_SESSION['admin']==1){
								$_SESSION['id_admin'] = $result[0]['id_user'];
						}
					}
					$err1 = 0;
					if($_SESSION['id_admin']){
						redirect(LBL_ADMIN_SITE_URL."user");
					}else {
						redirect(LBL_SITE_URL."user/user_home");
					}
			}
		}
		return $err1;
	}
##################################################
##################### EDIT PROFILE ###############
##################################################
	function _edit() {
		$this->check_session();
		$sql = get_search_sql("user","id_user = '".$_SESSION['id_user']."' LIMIT 1");
		$result= getrows($sql,$err);
		$pos=strpos($result[0]['hobbies'],',');
		if($pos) {
			if($result[0]['hobbies']) {
				$hobbies=explode(',',$result[0]['hobbies']);
				$result[0]['hobbies']=$hobbies;
			}
		}
		$this->_output['hobbies']=$GLOBALS['conf']['HOBBIES'];
		$this->_output['gender']=$GLOBALS['conf']['GENDER'];
		$this->_output['res']=$result[0];
		$this->_output['flag']=1;
		$this->_output['tpl']='user/register';
	}
##################################################
##################### UPDATE PROFILE #############
##################################################
	function _update_profile() {
		$this->check_session();
		$user = $this->_input['user'];
		if($this->_input['hobbies']) {
			$hobbies=implode(',',$this->_input['hobbies']);
			$user['hobbies']=$hobbies;
		}
		$user['gender'] = $this->_input['gender'];
		$user['dob']=$this->_input['dob_Year']."-".$this->_input['dob_Month']."-".$this->_input['dob_Day'];
		$err = $this->obj_user->validate($user,'');
		if($err){
			$this->_output['err'] = $err;
			$user['hobbies'] = $this->_input['hobbies'];
			$this->_output['res'] = $user;
			$this->_output['flag']=1;
			$this->_output['hobbies']=$GLOBALS['conf']['HOBBIES'];
			$this->_output['tpl'] = "user/register";
		}else{
			$this->obj_user->update($user,$_SESSION['id_user']);
			$_SESSION['raise_message']['global'] = "You have updated successfully";
			redirect(LBL_SITE_URL);
		}
	}

##################################################
##################### USER DETAIL ################
##################################################
	function get_user_detail($name){
		$sql = get_search_sql("user","username = '".$name."' LIMIT 1");
		return getrows($sql,$err);
	}

##################################################
##################### USER HOME ##################
##################################################
	function _user_home() {
		$this->check_session();
		$page['home_page'] = "home_page+1";
		//$this->obj_user->update_this("page",$page," id_page=".$_SESSION['id_page'],1);
		$this->_output['tpl']='user/user_home';
	}

##################################################
#################### CHANGE PASSWORD #############
##################################################
	function _change_password() {
		$this->check_session();
		$this->_output['tpl']='user/change_pwd';
	}

##################################################
#################### UPDATE PASSWORD #############
##################################################
	function _update_password() {
		$this->check_session();
		$password=$this->_input['pwd'];
		$old_pwd=$password['pwd'];
		$new_pwd=$password['pass'];
		$sql =get_search_sql("user","id_user = '".$_SESSION['id_user']."' LIMIT 1");
		$sth = mysql_query($sql);
		$rs  = mysql_fetch_assoc($sth);
		if($GLOBALS['conf']['FORGOT_PASSWORD']['password_type']==1) {
			$new_pwd = md5($old_pwd);
		}
		if($rs['password']==$old_pwd) {
			if($GLOBALS['conf']['FORGOT_PASSWORD']['password_type']){
				$new_pwd = md5($new_pwd);
			}
			$err = $this->obj_user->update_password($new_pwd);
			if($err){
				$_SESSION['raise_message']['global'] = 'Password Changed Successfully';
				redirect(LBL_SITE_URL."user/user_home");
			}else {
				$_SESSION['raise_message']['global'] = 'Password Changed Successfully';
				redirect(LBL_SITE_URL."user/user_home");
			}
		}else {
			$_SESSION['raise_message']['global'] = 'Please enter correct old password';
			redirect(LBL_SITE_URL."user/change_password");
		}
	}

###########################################################
####################### DUPLICATE USERNAME ################
###########################################################
	function _check_username() {
		$sql =get_search_sql("user","username='".$this->_input['username']."'");
		$result=getrows($sql,$err);
		if(count($result)>=1){
			print "1";
		}
	}

##################################################
#################### INSERT DETAILS ##############
##################################################
    function _insert() {
        $confirm_code = md5(uniqid(rand(), true));
        $user = $this->_input['user'];
        $name = $user['username'];
        $user['username'] = strtolower($user['username']);
        $user['gender'] = $this->_input['gender'];
        if ($this->_input['hobbies']) {
            $hobbies = implode(',', $this->_input['hobbies']);
            $user['hobbies'] = $hobbies;
        }
        $conf_pass = $this->_input['cpwd'];
        $user['dob'] = $this->_input['dob_Year'] . "-" . $this->_input['dob_Month'] . "-" . $this->_input['dob_Day'];
        $sql = get_search_sql("user", "username='" . $name . "'");
        $result = getrows($sql, $err);
        if (count($result) > 0) {
            $this->_output['hobbies'] = $GLOBALS['conf']['HOBBIES'];
            $this->_output['gender'] = $GLOBALS['conf']['GENDER'];
            $user['hobbies'] = $this->_input['hobbies'];
            $this->_output['res'] = $user;
            $this->_output['d_name'] = "This username already exist.";
            $this->_output['conf_pwd'] = $conf_pass;
            $this->_output['tpl'] = "user/register";
        } else {
            $user['random_num'] = $confirm_code;
            // DSC
            // $user['random_num']='0';
            $err = $this->obj_user->validate($user, $conf_pass);
            if ($err) {
                $this->_output['err'] = $err;
                $this->_output['hobbies'] = $GLOBALS['conf']['HOBBIES'];
                $this->_output['gender'] = $GLOBALS['conf']['GENDER'];
                $user['hobbies'] = $this->_input['hobbies'];
                $this->_output['res'] = $user;
                $this->_output['conf_pwd'] = $conf_pass;
                $this->_output['tpl'] = "user/register";
            } else {

                if ($GLOBALS['conf']['FORGOT_PASSWORD']['password_type'] == 1) {
                    $user['password'] = md5($user['password']);
                }
                $val = $this->obj_user->insert($user);
                if ($val) {
                    $_SESSION['raise_message']['global'] = "You have successfully registered. Check your email to activate your account!";

                    $id = $val;
                    $activate_link = LBL_SITE_URL . "user/check_user/confirm/" . $confirm_code;

                    //$from = $GLOBALS['conf']['SITE_ADMIN']['email'];
                    //$to = $user['email'];
                    //$subject = "Account Activation";
                    //$info['activate_link'] = $activate_link;
                    //$info['first_name']=$user['first_name'];
                    //$tpl= "user/account_activate";
                    //$this->smarty->assign('sm',$info);
                    //$body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
                    //$msg=sendmail($to,$subject,$body,$from);// also u can pass  $cc,$bcc

                    $from = $GLOBALS['conf']['SITE_ADMIN']['email'];
                    $_output['http_host'] = $_SERVER['HTTP_HOST'];
                    $headers = "MIME-Version: 1.0\r\n";
                    $headers .= "From: $from\r\n";
                    $headers .= "Content-type: text/html";
                    $_output['MAIL'][0]['header'] = $headers;
                    $_output['MAIL'][0]['to'] = $user['email'];
                    $_output['MAIL'][0]['subject'] = "Account Activation";
                    $_output['activate_link'] = $activate_link;
                    $_output['first_name'] = $user['first_name'];

                    $_output['MAIL'][0]['tpl'] = "user/account_activate";
                    $_output['MAIL'][0]['sm'] = $_output;
                    $this->smarty->assign('sm', $_output['MAIL'][0]['sm']);
                    $mail_message = $this->smarty->fetch($this->smarty->add_theme_to_template($_output['MAIL'][0]['tpl']));
					logToFile("DAKIYA DAAK LAAYA - Sending e-mail to :".$_output['MAIL'][0]['to']."; LBL_SITE_URL :".LBL_SITE_URL);
					$_SESSION['raise_message']['global'] = 'Your confirmation has been sent to your mail id';
                    $r = sendmail($_output['MAIL'][0]['to'], $_output['MAIL'][0]['subject'], $mail_message, $GLOBALS['conf']['SITE_ADMIN']['email']);



                    redirect(LBL_SITE_URL);
					$_SESSION['raise_message']['global'] = 'Your confirmation has really been sent to your mail id';
                } else {
                    $_SESSION['raise_message']['global'] = "Registration failed";
                    redirect(LBL_SITE_URL);
                }
            }
        }
    }

##################################################
################## CONFIRM USER  #################
##################################################
	function _confirm_user(){
		$this->obj_user->i_random = $this->_input['r'];
		$res = $this->obj_user->get_user_records(array(0=>'i_random'));
		$this->obj_user->id_user = $res['id_user'];
		$id_user = $this->obj_user->id_user;
		$row = getrows($this->user_bl->get_search_sql('id_user = '.$id_user),$err);
		if($this->obj_user->id_user){
			$this->obj_user->i_random = 0;
			$this->_input['name'] = $row[0]['name'];
			$this->_input['u_password'] = $row[0]['u_password'];
			$this->obj_user->update_random($id_user,$this->obj_user->i_random);
			$_SESSION['raise_message']['global'] = "Thank you for your authentication.Your Account Has been confirmed.";
			redirect("user/check_login/name-".$this->_input['name']."/u_password/".$this->_input['u_password']);
		}else{
			$_SESSION['raise_message']['global'] = 'Your Account Has Already Been Confirmed';
		}
		redirect(LBL_SITE_URL);
	}

##################################################
################## CHECK_USER()###################
##################################################
    function _check_user(){
      $link = mysql_connect(DB_HOST,DB_USER,DB_PASS,DB_DB) or die("Could not connect to db: ".mysql_error());
      mysql_select_db (DB_DB) or die("Could not select database : ".mysql_error());
      $sql = get_search_sql("user","random_num='".$this->_input['confirm']."' LIMIT 1");

      $query = mysql_query($sql);
      if($query == FALSE) {
          die("Could not send a mysql query to db. Error: ".mysql_error());
      }
      $res  = mysql_fetch_assoc($query);
      if($res == FALSE) {
          logToFile("Could not fetch a result row as an associative array. Error: ".mysql_error());
      }

      if($res){
          $sql_update="UPDATE ".TABLE_PREFIX."user SET random_num='0', user_status='1', toc='1', flag='1' WHERE id_user='".$res['id_user']."'";
          execute($sql_update,$err);
          $name = $res['username'];
          $pass = $res['password'];
          $this->_set_login($name,$pass);

          $_SESSION['toc'] = '1';
          $_SESSION['username'] = $name;
          ##### Redirect user out #####
          // Insert static landing page here? //
          redirect(LBL_SITE_URL);
      }
      else{
          $_SESSION['raise_message']['global']=  "You have already confirmed.<br/>You can login now.";
          redirect(LBL_SITE_URL);
      }
    }
##################################################
#################### FORGOT PASSWORD #############
##################################################
	function _forgot_pwd() {
		$this->_output['tpl']='user/forgot_pwd';
	}

##################################################
#################### RECOVER PASSWORD ############
##################################################
	function _get_forgot_pwd() {
		$email = $this->_input['email'];
		if($email) {
			$arr=$this->user_bl->getForgotPwd($email);
			if($arr) {
				$info['email'] = $arr[0]['email'];
				$info['password']  = $arr[0]['password'];
				$info['username']  = $arr[0]['username'];
				$to  = $arr[0]['email'];

				$from = $GLOBALS['conf']['SITE_ADMIN']['email'];
				$subject="Forgot password \n\n";

				$tpl = "user/forgot_password";

				//changed for encrypted password
				if($GLOBALS['conf']['FORGOT_PASSWORD']['password_type']){
					$info['link'] = LBL_SITE_URL.'user/setpwd/email/'.$arr[0]['email'];
					$info['p_type'] = $GLOBALS['conf']['FORGOT_PASSWORD']['password_type'];
				}//end

				$this->smarty->assign('sm',$info);
				$body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));

				$msg=sendmail($to,$subject,$body,$from);// also u can pass  $cc,$bcc
				$_SESSION['raise_message']['global'] = 'Your password has been sent to your mail id';
				redirect(LBL_SITE_URL);
			}else {
				$_SESSION['raise_message']['global'] = "No such account exists. Contact admin.";
				redirect(LBL_SITE_URL);
			}
		}else {
			$_SESSION['raise_message']['global'] = "Please enter your Username";
			redirect(LBL_SITE_URL.'user/forgot_pwd');
		}
	}

	function _setpwd(){
		$this->_output['email'] = $this->_input['email'];
		$this->_output['tpl'] = 'user/set_pwd';
	}

	function _insert_pwd(){// It will be change with change password function
		$pass = $this->_input['pwd']['npass'];
		$en_pass = md5($this->_input['pwd']['npass']);
		$res = $this->obj_user->reset_pwd($en_pass,$this->_input['email']);
		if($res){
			$_SESSION['raise_message']['global'] = 'Password Changed Sucessfully';
			redirect(LBL_SITE_URL);
		}else{
			$_SESSION['raise_message']['global'] = 'Failure in changing password';
			redirect(LBL_SITE_URL.'user/setpwd');
		}
	}
##################################################
################## LOGOUT  #######################
##################################################
function _logout(){
		// Called for both FB and normal user logout
		$site = $_SESSION['site_used'];
		setcookie('username', '', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('password','', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('email', '', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('id_user','', time()-60*60*24*365,"/".SUB_DIR);
		//setcookie('login_cnt','', time()-60*60*24*365,"/");
		$_COOKIE['username'] = "";
		$_COOKIE['password'] = "";
		$_COOKIE['email'] ="";
		$_COOKIE['id_user']="";

		//$_COOKIE['login_cnt'] = "";
		$_SESSION = array('');
		unset($_SESSION);
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['username'] = "";
		$_SESSION['email'] = "";
		$_SESSION['id_user'] = "";
		$_SESSION['raise_message']['global'] = "You have successfully logged out!";

		$_COOKIE['fbs_'.$app_id]="";
		if($this->_input['a']) {
			$_SESSION['id_admin'] = "";
			$_SESSION['admin'] = "";
			redirect(LBL_ADMIN_SITE_URL);
		} else {
			redirect(LBL_SITE_URL);
		}
	}


##################################################
################## REJECT USER  ##################
##################################################
	function _reject_user(){
		$id = $this->_input['id'];
		$str = $this->_input['str'];
		$cond = 'id_user = '.$id.' AND MD5(CONCAT(name,d_registration)) = "'.$str.'"';
		$row = getrows($this->user_bl->get_search_sql($cond),$err);
		if(count($row) == 0){
			$_SESSION['raise_message']['global'] = 'No such user exist';
			redirect(LBL_SITE_URL);
		}
		$sql = "DELETE FROM ".TABLE_PREFIX."user
				WHERE ".$cond;
		execute($sql,$err);
		$from					= $GLOBALS['conf']['SITE_ADMIN']['email'];
		$to						= $row[0]['v_email'];
		$subject				= $GLOBALS['conf']['SITE_ADMIN']['registration_subject'];
		$info	= $row[0]['name'];

		$info['u_password']	= $row[0]['u_password'];
		$info['confirm_link']= LBL_SITE_URL;

		$to = $to;
		$subject = $subject;
		$tpl = "user/user_reg_reject";

		$this->smarty->assign('sm',$info);
		$body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));

		$msg=sendmail($to,$subject,$body,$from);// also u can pass  $cc,$bcc
		$_SESSION['raise_message']['global']="<center>The user account has been Rejected.Confirmation mail has been send to the user.</center>";
		redirect(LBL_SITE_URL);
	}
##################################################
################## BLOCK USER  ###################
##################################################

	function _block_user(){
		$type = $this->_input['t'];
		$id_user = $this->_input['uid'];
		$sql = "SELECT id_forum FROM ".TABLE_PREFIX."user
				WHERE id_user = ".$id_user." LIMIT 1";
		$res = getrows($sql,$err);
		$id_forum = $res[0]['id_forum'];
		$mystring = 'xyz,'.$_SESSION['wfids'].',';
		if(strrpos($mystring,'23,')){
			$sql = "UPDATE ".TABLE_PREFIX."user
						SET i_random = ";
			if($type == 'b'){
				$sql .= "-1";
			}elseif($type == 'ub'){
				$sql .= "0";
			}
			$sql .= " WHERE id_user = ".$id_user;
			$err = execute($sql,$err);
			if($err){
				if($type == 'b'){
					$_SESSION['raise_message']['global'] = 'User blocked successfully';
				}elseif($type == 'ub'){
					$_SESSION['raise_message']['global'] = 'User unblocked successfully';
				}
				redirect(LBL_SITE_URL.'forum/search');
			}
		}else{
			$_SESSION['raise_message']['global'] = 'You are not authorised';
			redirect(LBL_SITE_URL);
		}
	}

##################################################
################## CLEAR  ########################
##################################################
	function _clear() {
		exec("rm var/cache/*.* -f");
		exec("rm var/templates_admin_c/*.* -f");
		exec("rm var/templates_c/*.* -f");
	}

##################################################
################## LIST USER #####################
##################################################
	function _listuser(){
		if($_SESSION['access'] & $GLOBALS['conf']['ACCESS_RIGHT']['add_user']){
			$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE 1";
			$uri='user/listuser';
			if($this->_input['fname']){
				$sql.=" AND fname LIKE '".$this->_input['fname']."%'";
				$uri.='-fname-'.$this->_input['fname'];
			}
			if($this->_input['u_status'] >= "0"){
				$sql.=" AND u_status=".$this->_input['u_status'];
				$uri.='-u_status-'.$this->_input['u_status'];
			}
			$results_params = Array ('URI' => $uri, 'SQL' => $sql, 'MODULE' => 'user', 'TPL' => 'user/list_user', 'CACHE_PREPEND' => 'sef|message|list|', 'RESULTS_UNDER' => 'res', 'DEBUG' => 1,'DEF_FIELD'=>'fname' );
		$this->user_bl->setupresults($results_params);
		$this->_output['cache_id'] =$this->user_bl->get_cache_id();
		$this->_output['tpl'] = "user/list_user";
		$this->_output['u_status']=$GLOBALS['conf']['U_STATUS'];
		$this->_output['su_status']=$this->_input['u_status'];
		$this->_output['fname']=$this->_input['fname'];

		if (!$this->cache_alive()) {
			$this->_output = array_merge($this->_output,$this->user_bl->get_output());
			$this->_output['TITLE'] = "User List";
			$this->_output['use_session'] = "1";
			$this->_output['choice'] = 'list_user';
		}
		return true;
//			$this->_output['res']=getrows($sql,$err);
//			$this->_output['tpl']='user/list_user';
		}else{
 			$_SESSION['raise_message']['global']="You are not authorised person";
		}
	}

##################################################
################## ADD USER  #####################
##################################################
	function _adduser($input=''){
		if($_SESSION['access'] & $GLOBALS['conf']['ACCESS_RIGHT']['add_user']){
			$status=array_pop($GLOBALS['conf']['U_STATUS']);
			$this->_output=$input;
			$this->_output['shortname']='';
			$this->_output['status']=$GLOBALS['conf']['U_STATUS'];
			$this->_output['add']='ADD';
			$this->_output['smt']='Submit';
			if($this->_input['cid']){
				$this->_output['cid'] =	$this->_input['cid'];
				$this->_output['u_status']=$GLOBALS['conf']['USER_STATUS']['client'];
			}
			$this->_output['choice'] ='insertuser';
			$this->_output['tpl']='user/add_user';
		}else{
 			$_SESSION['raise_message']['global']="You are not authorised person";
			redirect('user/listuser');
		}
	}

##################################################
################## INSERT USER  ##################
##################################################
	function _insertuser(){
	//print_r($this->_input);exit;
		$dpl_cond=" shortname = '".$this->_input['shortname']."'";
		$dplusr=get_search_sql('user',$dpl_cond);
		$dplres=getrows($dplusr,$err);
		if(mysql_affected_rows()){
			print "Alias name exists,Re-enter";
			$this->_adduser($this->_input);

		}else{
		$this->obj_user->loadfromarr($this->_input);
		$res = $this->obj_user->insert();
		redirect('user/listuser');
		}
	}

##################################################
################## EDIT USER  ####################
##################################################
	function _edituser(){
		if($_SESSION['access'] & $GLOBALS['conf']['ACCESS_RIGHT']['add_user']){
			$cond = "id_user = ".$this->_input['id'];
			$sql=get_search_sql('user',$cond);
			$res=mysql_fetch_assoc(mysql_query($sql));
			$this->_output=$res;
			$this->_output['acc']=$GLOBALS['conf']['ACCESS_RIGHT'];
			$status=array_pop($GLOBALS['conf']['U_STATUS']);
			$this->_output['status']=$GLOBALS['conf']['U_STATUS'];
			$this->_output['add']='EDIT';
			$this->_output['smt']='Update';

			if($this->_input['cid']){
				$this->_output['cid'] =	$this->_input['cid'];
				$this->_output['u_status']=$GLOBALS['conf']['USER_STATUS']['client'];
			}
			$this->_output['choice'] ='updateuser';
			$this->_output["HTTP_REFERER"] = $_SERVER['HTTP_REFERER'];
			$this->_output['tpl']='user/add_user';
		 }else{
 			$_SESSION['raise_message']['global']="You are not authorised person";
		 }
	}

##################################################
################## UPDATE USER  ##################
##################################################
	function _updateuser(){
		$cond =$this->_input['id_user'];
		$this->obj_user->loadfromarr($this->_input);
		$this->obj_user->update('',$cond);
		$_SESSION['raise_message']['global']="Successfully Updated";

//////////////  Update the assignee name in project table    ////////////////
		$psql="UPDATE ".TABLE_PREFIX."project SET assignee_name = REPLACE(assignee_name,'".$this->_input['oldname']."','".$this->_input['shortname']."')";
		mysql_query($psql);
		////////   END   ////////

//////////////  Update the Assignee User,Reviewers,Assigner in Task table    ////////////////
		$tsql="UPDATE ".TABLE_PREFIX."task SET
			assign_users = REPLACE(assign_users,'".$this->_input['oldname']."','".$this->_input['shortname']."'),
			assigner = REPLACE(assigner,'".$this->_input['oldname']."','".$this->_input['shortname']."'),
			reviewers = REPLACE(reviewers,'".$this->_input['oldname']."','".$this->_input['shortname']."')";
		mysql_query($tsql);
		////////   END   ////////
		//redirect('page-user-choice-listuser');
		header('Location: '.$this->_input["HTTP_REFERER"]);
		exit;
	}

##################################################
################## DELETE USER  ##################
##################################################
	function _deleteuser(){
		if($_SESSION['access'] & $GLOBALS['conf']['ACCESS_RIGHT']['add_user']){
			$this->obj_user->delete($this->_input['id']);
			$_SESSION['raise_message']['global']="Successfully Deleted";
			redirect('user/listuser');
		}else{
			$_SESSION['raise_message']['global']="You are not authorised person";
		}
	}

##################################################
###################check_session #################
##################################################
	function check_session() {
		if(!$_SESSION['id_user']) {
			$_SESSION['raise_message']['global'] = "Please login to access this site.";
			redirect(LBL_SITE_URL);
		}
	}

#####################################################
#Checking for repeative failure having same username#
#####################################################
	function chk_prev_uname($uname){
		$ipcount=$_SESSION['ip_count'];
		if(isset($_SESSION['ip_uname'])){
		    if($_SESSION['ip_uname']==$uname){
			    $ipcount++;
			    $_SESSION['ip_count']=$ipcount;
		    }else{
			    $_SESSION['ip_count']=0;
		    }
		}else{
		    $_SESSION['ip_uname']=$uname;
		}
	}

######################################################
########Set language session #########################
######################################################
	function _setlang() {
		$_SESSION['lang']=$this->_input['lang']?$this->_input['lang']:'';
		//print $_SERVER['HTTP_REFERER']."dddddddddddd";exit;
		redirect($_SERVER['HTTP_REFERER']);
	}

#######################################################
##############getResult ###############################
#######################################################
	function getResult($tbl,$cond){
		$sql="SELECT * FROM ".TABLE_PREFIX.$tbl." WHERE ".$cond;
		return mysql_fetch_assoc(mysql_query($sql));
	}

#######################################################
##############Set the Session Variatbles ##############
#######################################################
	function _setsession() {
		$sn = $this->_input['name'];
		$sv = $this->_input['value'];
		$_SESSION[$sn] = $sv;
	}

#######################################################
#############Unset the Session Variatbles ############
#######################################################
	function _unsetsession() {
		$sn = $this->_input['name'];
		unset($_SESSION[$sn]);
		$this->_printsession();
	}
#######################################################
#############Print the Session Variatbles ############
#######################################################
	function _printsession() {
		print "<pre>";
		print_r($_SESSION);
	}
#######################################################
#############Change the Profile Picture################
#######################################################
	function _edit_avatar(){
	    $this->_output['tpl']="user/change_avatar";
	}
	
	function _preview(){
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
		    $copy_thumb=copy($uploadDir.$fname, $thumbnailDir.$fname);
		    $this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
		    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		    ob_clean();
		    echo $fname;
		    exit;
	    }
	}

	/*
	* image_upload
	* @return type
	*/
	function _image_upload() {
	ob_clean();
	$del = $this->unlink_files();
	if ($this->_input['server_img']) {
	    $img_name = substr($this->_input['server_img'],(strpos($this->_input['server_img'],"_")+1));
	    $sql = "SELECT avatar FROM " . TABLE_PREFIX . "user WHERE id_user = " .$_SESSION['id_user']." LIMIT 1";
	    $res = getsingleindexrow($sql);
	    $orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_orig'];
	    $thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['avtar_thumb'];
	    if ($res['avatar']) {
		if(file_exists($orig_path .$res['avatar']))
		    unlink($orig_path . $res['avatar']);
		if(file_exists($thumb_path . $res['avatar']))
		    unlink($thumb_path . $res['avatar']);
	    }
	   // $img_msg = $this->obj_user->update_this("user",$arr,"id_user=".$_SESSION['id_user']);
	    $img_msg = $this->obj_user->update_image_name($img_name);
	    if ($img_msg) {
		$preview_path = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'].$this->_input['server_img'];
		$orig_path.=$_SESSION['id_user']."_".$img_name;
		$thumb_path.=$_SESSION['id_user']."_".$img_name;
		copy($preview_path,$orig_path);
		copy($orig_path, $thumb_path);
		$thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
		$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
		$thumb_object = new thumbnail_manager($orig_path, $thumb_path);
		$thumb_object->get_container_thumb($thumb_width, $thumb_height, 0, 0);
		echo $_SESSION['id_user']."_".$img_name;
		$_SESSION['avatar']=$_SESSION['id_user']."_".$img_name;
		exit;
	    }
	} else {
	    print "No image Uploaded";
	    exit;
	}
	}
	/*
	* unlink_files
	*/
	function unlink_files(){
		for($i=0;$i<2;$i++){
		   if($i==0){
			   $file_arr=glob(APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig']."*");
		   }else{
			   $file_arr=glob(APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb']."*");
		   }
		   if(!is_array($file_arr)){
			   $file_arr=array();
		   }
		   $yes_time_stamp=strtotime("-1 day");
		   foreach($file_arr as $val){
		       $file_time_stamp=filemtime($val);
		       if($file_time_stamp <= $yes_time_stamp){
			       @unlink($val);
			       //print $val." :: ".date('d-m-Y',$file_time_stamp)."<br>";
		       }
		   }
		}
		return;
	}
	
	##################################################################
	##### LOG IN MESSAGE DISPLAY ################3
	################ ADDED BY DELOS #########################420
	function _log_in_reminder(){
		$this->_output['tpl']="user/login_form";
	}

	
	##################################################################
	##### RIGHT PAN USER DISPLAY ################3
	################ ADDED BY DELOS #########################420
	
	function _see_user(){
		global $link;
		
		$data = $this->_input;
		
		$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_user=".$data['id_user']." LIMIT 1";
	    $res=mysqli_fetch_assoc(mysqli_query($link,$sql));
	    
	    $sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=".$data['id_user'];
	    $res_ach=getsingleindexrow($sql_ach);
	    
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'] - 7;
	    $comm = " id_user=".$data['id_user'];
	    $cond = (!$this->_input['last_id'])?$comm:$comm." AND id_meme <".$this->_input['last_id'];
	    $cond.=" ORDER BY id_meme DESC LIMIT ".$limit;
	    $sql=get_search_sql("meme",$cond,"*");
	    $res_meme = mysqli_query($link,$sql);
	    
	    if($res_meme){
		while($rec = mysqli_fetch_assoc($res_meme)){
		    $id_memes.=$rec['id_meme'].",";
		    $arr[] = $rec;
		}
		}
	    
	    if(!$res){
	    	// Could not find user in MySQL database
			return false;
	    } 
	    
	    $limit_favorite = $GLOBALS['conf']['PAGINATE']['rec_per_page'] - 7;
	    $comm_favorite = "FIND_IN_SET(".$data['id_user'].",honour_id_user) ";
	    $cond_favorite  = (!$this->_input['last_id'])?$comm_favorite :$comm_favorite ." AND id_meme <".$this->_input['last_id'];
	    $cond_favorite .=" ORDER BY id_meme DESC LIMIT ".$limit_favorite ;
	    $sql_favorite =get_search_sql("meme",$cond_favorite ,"*");
	    $res_favorite  = mysqli_query($link,$sql_favorite );
	    if($res_favorite ){
		while($rec_favorite  = mysqli_fetch_assoc($res_favorite )){
		    $id_memes_favorite .=$rec_favorite ['id_meme'].",";
		    $arr_favorite[] = $rec_favorite;
		}
		}

#	    $id = ($id_meme!='')?$id_meme:$data['id'];

#	    $sql = $this->meme_bl->get_search_sql("reply"," id_meme=".$id);

#	    $replies = getrows($sql, $err);

#	    $user_info = $this->get_userinfo();

		$this->_output['res']=$arr;
		
		$this->_output['res_favorite'] = $arr_favorite;

	    $this->_output['id_user'] = $data['id_user'];
	    
	    $this->_output['username'] = $res['username'];
	    
	    $this->_output['level'] = $res['level'];
	    
	    $this->_output['exp_point'] = $res['exp_point'];
	    
	    $this->_output['fb_pic_normal'] = $res['fb_pic_normal'];
	    
	    $this->_output['avatar'] = $res['avatar'];
	    
	    $this->_output['gender'] = $res['gender'];
	    
	    $this->_output['exp_rank'] = $res_ach['POSITION'];

#	    $this->_output['meme_title'] =  $data['meme_title'];

#	    $this->_output['meme_picture'] = $data['meme_picture'];

#	    $this->_output['meme_user'] = $data['meme_user'];
	    
#	    $this->_output['feed_count'] = $data['feed_count'];
	   
#	    $this->_output['uinfo'] = $user_info;

#	    if($id_meme!=''){

#			$arr[0] = $replies;

#			$arr[1] = $user_info;

#			return $arr;

#	    }else{

		$this->_output['tpl']="manage/right_pan_user";

		
	}
	
	function _hover_user(){
		$this->_output['tpl']="user/right_pan";
	}
	
	##################################################################
	##### LIVE RANKING SYSTEM ################
	################ ADDED BY DELOS #########################
	
	function _live_ranking(){
		
		if (!$_SESSION['id_user']){
			exit("2");
		}
		
		$sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=".$_SESSION['id_user'];
	    $res=getsingleindexrow($sql_ach);
	    
	    $less_one_user_rank = $res['POSITION'] + 1;
	    
	    // experimental start
	    $sql_other="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE POSITION=".$less_one_user_rank;
	    $res_other = getsingleindexrow($sql_other);
	    
	    if(!$res){
	    	// Could not find user's exp rank
			exit("no rank");
		}
		
		// Has Rank Changed? No		
		if($_SESSION['exp_rank'] == $res['POSITION']){
			
			// Has trailing user changed? No
			if ($_SESSION['one_less_user'] == $res_other['username']) {
			
				// Has trailing user XP changed? No
				if ($_SESSION['one_less_exp'] == $res_other['exp_point']) {
					exit("no update");
				
				// Has trailing user XP changed? Yes
				} else {
					//$_SESSION['one_less_exp'] = $res_other['exp_point'];
					exit("AAB".",".$res_other['exp_point']);
				}
			
			// Has trailing user changed? Yes
			} else {
				$_SESSION['one_less_user'] = $res_other['username'];
				$_SESSION['one_less_dupe_username'] = $res_other['dupe_username'];
				//$_SESSION['one_less_exp'] = $res_other['exp_point'];
				$_SESSION['one_less_pic'] = $res_other['fb_pic_square'] ? $res_updated_other['fb_pic_square'] : 'image/thumb/avatar/memeja_male.png'; 
				$_SESSION['one_less_avatar'] = $res_other['avatar'];
				$_SESSION['one_less_gender'] = $res_other['gender'];
				exit("AB".",".$_SESSION['one_less_pic'].",".$res_other['dupe_username']);
			}
		
		// Has Rank Changed? Yes	
	    } else {
	    
	    	// Find New trailing user row
	    	$less_one_user_updated_rank = $res['POSITION'] + 1;
	    
			$sql_updated_other="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE POSITION=".$less_one_user_updated_rank;
			$res_updated_other = getsingleindexrow($sql_updated_other);
			
	    	//$_SESSION['one_less_exp'] = $res_updated_other['exp_point'];
	    	$_SESSION['one_less_user'] = $res_updated_other['username'];
			$_SESSION['one_less_dupe_username'] = $res_updated_other['dupe_username'];
	    	$_SESSION['one_less_rank'] = $less_one_user_updated_rank;
			
			$_SESSION['one_less_pic'] = $res_updated_other['fb_pic_square'] ? $res_updated_other['fb_pic_square'] : 'image/thumb/avatar/memeja_male.png';
			$_SESSION['one_less_avatar'] = $res_updated_other['avatar'];
			$_SESSION['one_less_gender'] = $res_updated_other['gender'];
			
	    
	    	// Which direction has rank changed? Rank improved (lower)
	    	if ($_SESSION['exp_rank'] > $res['POSITION']) {
	    		$_SESSION['exp_rank'] = $res['POSITION'];
	    		
	    		exit("BA".','.$res['POSITION'].",".$_SESSION['one_less_pic'].",".$res_updated_other['username'].",".$less_one_user_updated_rank.','.$res_updated_other['dupe_username']);
	    	
	    	// Which direction has rank changed? Rank deproved (higher)
	    	} else {
	    		$_SESSION['exp_rank'] = $res['POSITION'];
	    		exit("BB".','.$res['POSITION'].",".$_SESSION['one_less_pic'].",".$res_updated_other['username'].",".$less_one_user_updated_rank.','.$res_updated_other['dupe_username']);
	    	}
	    	
	    }
	
	}
	
	function _getExperience(){
	    global $link;
	    
	    if(!$_SESSION['id_user']){
	    	// No users
			exit("2");
	    }
	    	    
	    $sql="SELECT exp_point FROM ".TABLE_PREFIX."user WHERE id_user=".$_SESSION['id_user']." LIMIT 1";
	    $res=mysqli_fetch_assoc(mysqli_query($link,$sql));
	    
	    if(!$res){
	    	// Could not find exp_point in MySQL database for user
			exit("2");
	    }
	    
	    
	    if(($_SESSION['exp_point'] == $res['exp_point']) && $this->_input['chk']=='1'){
			// Exp points have not changed
			exit("90999999999");		
			// Note: set high so that data cannot reach this XP and trigger incorrect update
	    } else {
	    	// XP points have changed
	 
	    	// Update the session with New XP points
		    $_SESSION['exp_point'] = $res['exp_point'];
		    		    
		    // Check if user has levelled up...
		    if ($_SESSION['exp_point'] < $_SESSION['xp_to_level']) {
		    	
		    	// Previous XPs needed if user JUST levelled up (var is stuck)
		    	$response_data = $_SESSION['exp_point']."~".$_SESSION['previous_xp_to_level']."~".$_SESSION['level'];
		    	// send back the new XP points
				//exit($_SESSION['exp_point']);
				
				exit($response_data);
			} else {
			// If user has leveled up,
				
				// Update client-side level
				$_SESSION['level'] = $_SESSION['level'] + 1;
				
				// Update server-side level
				$info['level']  = 'level+1';
				$this->obj_user->update_this("user",$info," id_user=".$_SESSION['id_user'],1);
				
				
				// Update the client xp_to_level
				$sql_xp = "SELECT * FROM ".TABLE_PREFIX."level WHERE level=".$_SESSION['level'];
				$results_xp = getsingleindexrow($sql_xp);
				
				// Move levels up by 1 (switch previous level to update session)
				$_SESSION['previous_xp_to_level'] = $_SESSION['xp_to_level'];
				$_SESSION['xp_to_level'] = $results_xp['xp_to_level'];
				
				// Pack new XP, new level, new xp_to_level in data
				$response_data = $_SESSION['exp_point'].",".$_SESSION['level'].",".$_SESSION['xp_to_level'];
				exit($response_data);
				
				
				
				//exit();
			}	
				
		    
		    ############## Old Deprecated Pati Code #############
		    //$percent = round((($res['exp_point'] / $tot_points) * 100), 2);
		    
		    //$_SESSION['xp_percent'] = $percent;
		    
		    //$this->_output['points'] = $percent;
		    //$this->_output['tpl'] = "user/experience_bar";
	    }
	}
	
    function _getFriends(){
	    $sql=$this->user_bl->get_frnds_sql();
	    $this->_output['frnds']=getrows($sql,$err);
	}
	
	function _set_login_time(){
	    if($_SESSION['id_user']){
		$this->obj_user->update_user_login_time($user);
	    }
	}
		
    function _create_username() {
        global $link;

        if (isset($this->_input['username'])) {
            // Setup query to see if username is already taken
            $myusername = mysql_real_escape_string(stripslashes($this->_input['username']));

            $check_table = "SELECT COUNT(*) FROM " . TABLE_PREFIX . "user WHERE username='" . $myusername . "'";
            //var_dump($check_table);
            $result = mysqli_query($link, $check_table) or die(mysqli_error());

            $row = mysqli_fetch_assoc($result);

            //var_dump($row['COUNT(*)']);

            if ($row['COUNT(*)'] != 0) {
                echo 'This user already exists';
            } else {
                ##### Updating database with new username #####
                //var_dump($myusername);
                $sql = "UPDATE " . TABLE_PREFIX . "user SET username= '" . $myusername . "' WHERE id_user=" . $_SESSION['id_user'];
                $result = mysqli_query($link, $sql);
                //var_dump($result);
                ##### Update TOC session to 1, username selected ######
                $sql = "UPDATE " . TABLE_PREFIX . "user SET toc=1 WHERE id_user=" . $_SESSION['id_user'];
                mysqli_query($link, $sql);
                $_SESSION['toc'] = '1';
                $_SESSION['username'] = $myusername;

                ##### Redirect user out #####
                // Insert static landing page here? //
                redirect(LBL_SITE_URL);
            }
        }
    }

    #### Deprecated with Submit and other functions
	function _first_login_msg(){
	    global $link;
	    if($this->_input['pass']=='pass'){
			$sql="UPDATE ".TABLE_PREFIX."user SET toc=1 WHERE id_user=".$_SESSION['id_user'];
			mysqli_query($link,$sql);
			$_SESSION['toc']='1';
	    }
	    if($_SESSION['toc']=='0'){
			$this->_output['tpl']="user/first_login_msg";
	    }
	}

	function _check_fb_session(){
		$arr=$this->decrypt_fb_data();
		$facebook = $arr[0];
		$data = $arr[1];
		$fb_login_sts=$facebook->api_client->users_getLoggedInUser();
		if($fb_login_sts=='-1'){
			$_SESSION['fb_login']='';
		}
		print $fb_login_sts;exit;
	}
	
	function decrypt_fb_data(){
		//$api_key=$GLOBALS['conf']['FACEBOOK']['api_key'];
		$application_secret = $GLOBALS['conf']['FACEBOOK']['secret_key'];
		$app_id = $GLOBALS['conf']['FACEBOOK']['app_id'];
		
		// Start of newest FB changes
		
		if(isset($_COOKIE['fbsr_' . $app_id])){
			list($encoded_sig, $payload) = explode('.', $_COOKIE['fbsr_' . $app_id], 2);
   
        	$sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
        	$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
  
        	if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
				echo('algo');
				exit;
            	return null;
         	}
         	
         	$expected_sig = hash_hmac('sha256', $payload,
         	$application_secret, $raw = true);
         	
          	if ($sig !== $expected_sig) {
            	return null;
          	}
          	
        	$token_url = "https://graph.facebook.com/oauth/access_token?"
         . "client_id=" . $app_id . "&client_secret=" . $application_secret. "&redirect_uri=" . "&code=" . $data['code'];
   
   			//var_dump($token_url);
   			// e.g.  "https://graph.facebook.com/oauth/access_token?client_id=219049284838691&client_secret=0b378365e966491e3e3b1d12bbc65afa&redirect_uri=&code=2.AQA__rw8Zipnc4k6.3600.1324440000.1-641286114|_u5nb7xpTi24QbgwPu6UWpUCJ8I" 
   			
          	$response = @file_get_contents($token_url);
          	$params = null;
          	
          	parse_str($response, $params);
          	
          	//var_dump($response);
          	// e.g. access_token=AAADHOWLPpSMBALRAuPIE7
//	184M0A80ARK8yRZBPIkvjaeCTk1JvrAZAUSRSIrQvyuBrIkZCrl9WJ8Qb
//	fttPeuOgD2dcgZDZD&expires=4659

			//var_dump($params);
			// e.g. ["access_token"] => "AAAADHOW..."

          	$data['access_token'] = $params['access_token']; 
          	
          	// formerly was $data['session_key']
          	$data['session_key'] = $data['code'];
          	$session_key = $data['code'];
          	
          	//var_dump($data['uid']); => evals to null
          	
			$arr[0] = new Facebook(array(
  				'appId'  => $app_id,
  				'secret' => $application_secret,
			));
			
			$facebook = $arr[0];
			
			$arr[1] = $data;
			return $arr;
			
          	//return $data;
     	} else {
     		// FB cookie doesn't exist
          	return null;
     	}
     }
		// End of newest FB changes
	
//$arr = explode('&',trim(stripslashes($_COOKIE['fbs_'.$app_id]),'"'));
//		foreach($arr as $k => $v){
//			$key = substr($v,0,strpos($v,'='));
//			$val = substr($v,strpos($v,'=')+1);
//			$data[$key] = $val;
//		}
		
		// FB changed 'session_key' to 'code'
		//$session_key = $data['session_key'];
		
		
//		$arr[0] = new Facebook($api_key,$secret,$session_key);
//		$arr[1] = $data;
//		return $arr;
//	}
	
	function _facebook_info(){
	    global $link;

	    $arr = $this->decrypt_fb_data();
		
		if($arr){
			$facebook = $arr[0]; // instance of class FB 
		
	    $data = $arr[1];	// decrypted data with access token + session_key

		//var_dump($facebook);		Does FB instance exist?
		
		// See if there is a user from a cookie
		$user_id = $facebook->getUser();
		
		//var_dump($user_id); 		Can you grab user's ID?
		
		// Retrieve user information from FB in JSON
		// e.g. callable var_dump $me['name']
		$user_details = $facebook->api('/me');
		
		### 	SAMPLE DETAILS ###
		#	Array ( 
		#	[id] => 641286114 
		#	[name] => Delos Faith Chang 
		#	[first_name] => Delos 
		#	[middle_name] => Faith 
		#	[last_name] => Chang 
		#	[link] => http://www.facebook.com/delos.chang 
		#	[username] => delos.chang 
		#	[hometown] => Array ( [id] => 111948785483165 [name] => Cupertino, California ) 
		#	[location] => Array ( [id] => 104049022964484 [name] => Hanover, New Hampshire ) 
		#	[gender] => male 
		#	[email] => lol.i.laugh@gmail.com 
		#	[timezone] => -8 
		#	[locale] => en_US 
		#	[verified] => 1 
		#	[updated_time] => 2011-12-04T14:42:09+0000 
		#	)
		### 
		
		// Without user ID, something went wrong
	    if(!$user_details['id']){
			redirect(LBL_SITE_URL);
	    } 

		// Check if user exists in DB (first-time user?)
	    $sql = "SELECT * FROM ".TABLE_PREFIX."user WHERE uid=".$user_details['id']." LIMIT 1";
	    $qry = mysqli_query($link, $sql);
	    $results = mysqli_fetch_assoc($qry);
	    
	    $_SESSION['fb_login'] = 1;
	    if($results){
	    	// Not a first-time user. 
	    	
	    	$this->_set_login($results['email'], $results['password']);
	    } else {
			
			#### Does not load properly into name_friends ####
			## Tried LONGTEXT and LONGBLOB for column structure ##
			//$in_user['name_friends'] = implode(",", $name_list);
			
			#### Below example works ####
			//$in_user['name_friends'] = 'Stacy';	
						
			// Enable permission 'user_education_history' in login_form to access.
			// $education = $user_details['education'];
			
			// $school_name_list = array();
			// $school_id_list = array();
			// foreach ($education as $education_array) {
				
				// $school_name_list[] = $education_array['school']['name'];
				// $school_id_list[] = $education_array['school']['id'];
			
			// }
			// $in_user['school_id'] = implode(",", $school_id_list);	
			// $in_user['school_name'] = implode(",", $school_name_list);	
			
			// Unique FB ID & USERNAME
			$in_user['uid'] = $user_details['id'];
			
			// Profile Pictures in diff sizes
			$profile_link = 'http://graph.facebook.com/'.$user_details['id'].'/picture?type=';	
			$in_user['fb_pic_normal']  = $profile_link.'normal';
			$in_user['fb_pic_square'] = $profile_link.'square';

			$pwd=rand(1000,99999);
		
			// **** 
			$in_user['id_user']  = $user_details[''];
			
			$in_user['fname']  = $user_details['first_name'];
			$in_user['mname']  = $user_details['middle_name'];
			$in_user['lname']  = $user_details['last_name'];
			$in_user['username']  = $in_user['mname'] ? $in_user['fname'].' '.$in_user['mname'].' '.$in_user['lname'] : $in_user['fname'].' '.$in_user['lname'];
			
			// check to see duplicates, if so, give unique id
			
			$page_sql="SELECT COUNT(*) FROM ".TABLE_PREFIX."meme WHERE username=".$in_user['username'];
			$page_res=mysqli_query($link,$page_sql);
			
			if ($page_res) {
				$page_row = $page_res->fetch_row();
				
				$page_tag = $page_row[0] + 1;
				$in_user['dupe_username'] = $in_user['mname'] ? $in_user['fname'].'-'.$in_user['mname'].'-'.$in_user['lname'].'-'.$page_tag : $in_user['fname'].'-'.$in_user['lname'].'-'.$page_tag;
			} else {
				$in_user['dupe_username'] = $in_user['mname'] ? $in_user['fname'].'-'.$in_user['mname'].'-'.$in_user['lname'] : $in_user['fname'].'-'.$in_user['lname'];
			}
			
			$in_user['email']  = $user_details['email'];
			$in_user['password']  = $pwd;

			#$in_user['id_admin']  = 0;
			
			$gender = ($user_details['gender']=='male')?'M':(($user_details['gender']=='female')?'F':'');
			$in_user['gender']  = $gender;
			
			// Enable permission 'user_birthday' in login_form to access.
				// ** Phase two ** 
				//$in_user['dob']  = $user_details['birthday'];
			
			//$in_user['avatar']  = $user_details[''];
			
			// Hometown and Location
			//$in_user['hometown'] = $user_details['hometown']['id'];
			//$in_user['location'] = $user_details['location']['id'];
			
			#$in_user['ques_week_won']  = $user_details[''];
			#$in_user['duels_won']  = $user_details[''];
			#$in_user['exp_point']  = $user_details[''];
			#$in_user['no_badges']  = $user_details[''];
			#$in_user['login_status']  = $user_details[''];
			#$in_user['no_of_logs']  = $user_details[''];
			#$in_user['last_login']  = $user_details[''];
			#$in_user['update_login']  = $user_details[''];
			#$in_user['login_time']  = $user_details[''];
			
			$in_user['random_num']  = 1;	//sets email -- 0 for not confirmed yet
			$in_user['flag']  = 1;
			$in_user['user_status']  = 1;
			
			#$in_user['memeje_friends'] = $user_details[''];
			#$in_user['toc']  = $user_details[''];
			#$in_user['add_date']  = $user_details[''];
			$in_user['ip']  = $_SERVER['REMOTE_ADDR'];

			// First-time user continues
				// initiates from user.php
		    $this->obj_user->insert_all('user', $in_user, 1,$dt_fld='add_date');

			// The message
			$message = "New user in database".$in_user['username'];

			// In case any of our lines are larger than 70 characters, we should use wordwrap()
			$message = wordwrap($message, 70);

			// Send
			//mail('deloschang@memeja.com', 'New User ', $message);
			
		    $this->_set_login($in_user['email'], $pwd);
		}
		}
	}
		
	function _invited(){
		print "<pre>";
		print_r($_REQUEST);
		$this->obj_user->update_diff_data('invited_to','user','id_user='.$_SESSION['id_user'],$_REQUEST['ids']);
		$url=LBL_SITE_URL.$_REQUEST['p']."/".$_REQUEST['c'];
		if($_REQUEST['cat']!=''){
			$url.="/cat/".$_REQUEST['cat'];
		}
		redirect($url);
	}


############################################
############# MEMEJE FRIEND REQUEST#################
############################################
	function _frnd_request(){
		$sql="select id_admin from ".TABLE_PREFIX."user where id_user = ".$_SESSION['id_user'];
		$res=getsingleindexrow($sql);
		if($res['id_admin']!=1){
		    $sql="SELECT count(*) as total FROM ".TABLE_PREFIX."frnd_request WHERE requested_to = ".$_SESSION['id_user']." AND is_read = 0";
		    $res=getsingleindexrow($sql);
		    if($res['total'] != ''){
			$this->_output['res']=$res['total'];
		    }else{
			 $this->_output['res']=0;
		    }
		}
		$this->_output['tpl']="user/friend_req";
	}
	
	
	function _friend_req_list(){
		check_session();
		global $link;
		$cond1 =" requested_to = ".$_SESSION['id_user'];
		$arr1['is_read']=1;
		//$this->obj_user->update_this('frnd_request',$arr1,$cond1);
		$sql_req="SELECT GROUP_CONCAT(requested_by) as req FROM ".TABLE_PREFIX."frnd_request WHERE requested_to = ".$_SESSION['id_user']." and  req_status = 0";
		$query=mysqli_query($link,$sql_req);
		$res_req=mysqli_fetch_assoc($query);
		if($res_req['req']){
			$sql= "SELECT * from ".TABLE_PREFIX."user  WHERE id_user in (".$res_req['req'].")";
			$res=getrows($sql, $err);
		}
		 
		$this->_output['res']=$res;
		$this->_output['tpl']='user/friend_req_list';
	}

	// function _get_memeje_frnds(){
		// check_session();
		// $id_user=$_SESSION['id_user'];
		// $sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_admin !=1 AND id_user !=".$id_user." AND id_user NOT IN (SELECT requested_to FROM ".TABLE_PREFIX."frnd_request WHERE requested_by = ".$id_user." AND req_status !=2 UNION SELECT requested_by FROM ".TABLE_PREFIX."frnd_request WHERE requested_to =".$id_user." AND req_status !=2)";
		// $res=getrows($sql,$err);
		// $sql = "SELECT memeje_friends FROM ".TABLE_PREFIX."user WHERE id_user=".$id_user;
		// $arr= getsingleindexrow($sql);
		// $has_frnds_cnt = ($arr['memeje_friends']!='')?count(explode(',',$arr['memeje_friends'])):0;
		// $this->_output['frnds_cnt']=$has_frnds_cnt;
		// $this->_output['frnds']=$res;
		// $this->_output['tpl']="user/memeje_friends";
	// }
	
	function _add_memeje_frnds(){
	    $ids=array();
	    $data = $_REQUEST;
	    $ids=explode(",",$this->_input['ids']);
	    $arr['requested_by'] =$notify['id_user']= $_SESSION['id_user'];
	    $arr['ip'] =$notify['ip']= $_SERVER['REMOTE_ADDR'];
		$notify['notification_type'] = '5';
	    foreach ($ids as $key => $value) {
			$arr['requested_to']=$notify['notified_user'] = $value;
			$id = $this->obj_user->insert_all("frnd_request",$arr,1);
			$notify_id = $this->obj_user->insert_all("notification",$notify,1);
			//print $id;
	    }
	    
	    if($id)
			$this->_mail_notification($this->_input['ids'],"send_frnd_request");
	}
	
	function _mail_notification($ids,$param){
		global $link;
		if (is_array($ids)){
		    $ids=implode(",", $ids);
		}
		switch($param){
		    case "send_frnd_request":
				$subject=$_SESSION['fname']." send you a friend request";
				$tpl="user/mail_send_frnd_request";
			break;
			
		    case "conf_frnd_request":
				$subject=$_SESSION['fname']." accept your friend request";
				$tpl="user/mail_conf_frnd_request";
			break;
		}
		$sql="SELECT email,fname FROM memeje__user where id_user IN ($ids)";
		$query=mysqli_query($link,$sql);
		while($rec=mysqli_fetch_assoc($query)){
		    $info['name']=$rec['fname'];
		    $to=$rec['email'];
		   /// $subject=$_SESSION['fname']." send you a friend request";
		    $from = $GLOBALS['conf']['SITE_ADMIN']['email'];
		    //$tpl = "user/$tmpl";
		    $this->smarty->assign('sm',$info);
		    $body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
		    print($body);exit;
		    $msg=sendmail($to,$subject,$body,$from);
		    
		    if ($msg){
				$msg[]="Mail Sent Sucessfully TO ".$value;
		    }
		}
	}
	
	// function _conf_frnd_request(){
	    // $arr_fd_req['req_status']='1';
	    // $id=$notify['notified_user'] =$this->_input['id'];
	    // $id_user=$notify['id_user']=$_SESSION['id_user'];
		// $notify['notification_type'] = '1';
		// $notify1['is_removed']='1';
	    // $frnd_request=$this->obj_user->update_this("frnd_request",$arr_fd_req,"requested_by =$id AND requested_to =$id_user");
	    // $update_fd_own=$this->obj_user->update_diff_data('memeje_friends','user','id_user='.$id_user,$id);
			// unset($_SESSION['friends']);
			// $_SESSION['friends']=$update_fd_own;		

	    // $update_fd_ops=$this->obj_user->update_diff_data('memeje_friends','user','id_user='.$id,$id_user);
		// $notify_id = $this->obj_user->insert_all("notification",$notify,1);
		// $notify_upd=$this->obj_user->update_this("notification",$notify1,"id_user =$id AND  notified_user=$id_user AND notification_type=5");
	    // $this->_mail_notification($id,"conf_frnd_request");
	// }
	
	function _rej_frnd_request(){
		$arr['req_status']=2;
		$notify['is_removed'] =1;
		$id=$this->_input['id'];
		$id_user=$_SESSION['id_user'];
		$this->obj_user->update_this("frnd_request",$arr,"requested_by =$id AND requested_to =$id_user");
		$this->obj_user->update_this("notification",$notify,"id_user =$id AND  notified_user=$id_user AND notification_type=5 AND is_removed !=1");
	}
	function _get_sent_users(){
	    if($_SESSION['id_user']){
		//$sql=$this->user_bl->get_search_sql("user","id_user=".$_SESSION['id_user'],"invited_to");
		$sql="SELECT invited_to FROM ".TABLE_PREFIX."user WHERE id_user=".$_SESSION['id_user']." LIMIT 0,1";
		$res=getsingleindexrow($sql);
		ob_clean();
		print $res['invited_to'];
	    }else{
		exit;
	    }
	}
	function _show_profile_info(){
	    $sql=get_search_sql("user","id_user =".$this->_input['id_user'] );
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="user/profile_info";
	}
	###############################################################
	####################  FRIEND LIST #############################
	###############################################################
	// function _friend_list(){
	    // check_session();
	    // $sql=get_search_sql("user","FIND_IN_SET(id_user,(select memeje_friends from memeje__user where id_user='".$_SESSION['id_user']."'))","*");
	    // $sql= "SELECT avatar,id_user,gender,concat(fname,' ',lname) as name FROM ".TABLE_PREFIX."user WHERE FIND_IN_SET(id_user,(select memeje_friends from memeje__user where id_user='".$_SESSION['id_user']."'))";
	    // $res=getrows($sql, $err);
	    // $this->_output['count']=count($res);
	    // $this->_output['res']=$res;
	    // $this->_output['tpl']="user/friend_list";
	// }
	// function _all_friends($q='0'){
	    // $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    // $uri = 'user/all_friends';
	    // $sql= "SELECT avatar,id_user,gender,concat(fname,' ',lname) as name,memeje_friends FROM ".TABLE_PREFIX."user WHERE FIND_IN_SET(id_user,(select memeje_friends from memeje__user where id_user='".$_SESSION['id_user']."'))";
	    // $this->_output['field'] = array("id_user" => array("id_user", 1));
	    // $this->_output['uri'] = $uri;
	    // $this->_output['limit'] = $GLOBALS['conf']['PAGINATE']['rec_per_page'];
	    // $this->_output['show'] = $GLOBALS['conf']['PAGINATE']['show_page'];
	    // $this->_output['sql'] = $sql;
	    // $this->_output['type'] = 'box';
	    // $this->_output['sort_by'] ="name";
	    // $this->_output['sort_order'] = "ASC";
	    // $this->_output['ajax'] = '1';
	    // $this->_output['qstart'] = $qstart;
	     // $_REQUEST['choice'] ='all_friends';
	    // $this->user_bl->page_listing($this, "user/all_friends");
	// }
	// function _remove_frnd(){
	    // check_session();
	    // $id=$this->obj_user->remove_frnd($this->_input['ssnfrnds'],$this->_input['rmvdfrnds'],$this->_input['id_user']);
	    // if ($this->_input['qstart']) {
		 // $qstart = $this->_input['qstart'];
	    // } else {
		// $qstart = 0;
	    // }
	    // if ($this->_input['count'] == 1 && $qstart > 0) {
		// $qstart = $qstart - $this->_input['limit'];
	    // } else if ($this->_input['count'] > 1 && $qstart > 1) {
		// $qstart = $qstart;
	    // }else {
		// $qstart = 0;
	    // }
	    // $this->_input['qstart'] = $qstart;
	    // $this->_all_friends($this->_input['qstart']);
	// }
	
	function  _getfriends4tag(){
	    global $link;
		
		$arr = $this->decrypt_fb_data();		
		$facebook = $arr[0];
		
		$friends_list = $facebook->api('me/friends');	
		$collection = $friends_list['data'];
		
		foreach($collection as $page) {
			$name = $page['name'];
			$id = $page['id'];
			
			$img = "<img src='https://graph.facebook.com/$id/picture'/>";
			$arr[] = array("name"=>$name,"value"=>$id,"pf_img"=>$img);
		}
		
	    print json_encode($arr);
		exit;
	}	 
	
	function _follow_user(){
		$data = $this->_input;
		
		$info['following'] = $data['id'];
		$info['id_user'] = $_SESSION['id_user'];
				
		if ($data['status'] == 'follow'){			
			$this->obj_user->insert_all("friends",$info);
		} elseif ($data['status'] == 'unfollow'){
			$sql = "DELETE FROM memeje__friends WHERE id_user = ".$info['id_user']." AND following = ".$info['following'];

			execute($sql,$err);
		}
	}
	
	function _remove_tag(){
		$data = $this ->_input;
		$info['id_meme'] = $data['id'];
		$info['facebook_id'] = $data['facebook_id'];
		
		$sql = "DELETE FROM memeje__tags WHERE id_meme = ".$info['id_meme']." AND tagged = ".$info['facebook_id'];
		
		execute($sql,$err);
	}
}
