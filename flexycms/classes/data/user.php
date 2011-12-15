<?php
//include_once("/var/www/html/flexycms/flexycms_core/classes/common/validation.php");
/*
Modified for humor cms ..
1. Removed fk functions as they are not being used
2. Modified get function to work only for one id
3. Added error cheincg in get , insert , update and delete
4. Changed the table heading to return #LBL_fieldname#
*/
class user{
	// null args constructor g
	function user(){
	}
	function insert_all($tbl,$arr,$flag='',$dt_fld='add_date',$debug=''){
		global $link;
		$sql = "INSERT INTO ".TABLE_PREFIX.$tbl;
		$fld_str_key = "";
		$fld_str_value = "";
		foreach($arr as $key => $value){
			$fld_str_key .= $key.",";
		}
		$fld_str_key = trim($fld_str_key,',');
		if($flag==1){
			$fld_str_key .= ",".$dt_fld;//,add_date,ip";
		}
		foreach ($arr as $key => $value) {
			if(!isset($value) || $value == ""){
				$fld_str_value .= "NULL,";
			} else {
				$fld_str_value .= "'".trim($value)."',";
			}
		}
		$fld_str_value = trim($fld_str_value,',');
		if($flag==1){
			$fld_str_value .= ",NOW()";//,'".$_SERVER['REMOTE_ADDR']."'";
		}
		$sql = $sql." (".$fld_str_key.") VALUES(".$fld_str_value.")";
		//print $sql;
		if($debug==1){
		    print $sql;exit;
		}
		$link->query($sql);
		$id = mysqli_insert_id($link);
		return $id;
	}
	// Insert into database Return inserted id  if success , error message if failed
	function insert($arr){
		global $link;
		$sql = "INSERT INTO ".TABLE_PREFIX."user";
		$fld_str_key = "";
		$fld_str_value = "";
		foreach($arr as $key => $value){
			$fld_str_key .= $key.",";
		}
		$fld_str_key = rtrim($fld_str_key,',');
		$fld_str_key .= ",add_date,ip";
		foreach ($arr as $key => $value) {
			if(!isset($value) || $value == ""){
				$fld_str_value .= "NULL,";
			} else {
				$fld_str_value .= "'".$value."',";
			}
		}
		$fld_str_value = rtrim($fld_str_value,',');
		$fld_str_value .= ",NOW(),'".$_SERVER['REMOTE_ADDR']."'";
		$sql = $sql." (".$fld_str_key.") VALUES(".$fld_str_value.")";
		//print $sql;exit;
		$err = execute($sql,$err);
		$id_user = mysqli_insert_id($link);
		return $id_user;
	}

	function update_password($arr) {
		$sql = "UPDATE ".TABLE_PREFIX."user
				SET
				password = '".$arr."'
			    WHERE id_user='".$_SESSION['id_user']."'";
		execute($sql,$err);
		return mysql_affected_rows();
	 }

	function update_status($id,$flag) {
		if($flag==1) {
			$flag=0;
		}else {
			$flag=1;
		}
		$sql = "UPDATE ".TABLE_PREFIX."user
				SET
				flag = '".$flag."'
			    WHERE  id_user='".$id."'";
		execute($sql,$err);
		return mysql_affected_rows();
	 }

	function update($user,$id) {
		$sql="UPDATE ".TABLE_PREFIX."user SET ";
		foreach ($user as $key => $value) {
			$sql.=$key."='".$value."',";
		}
		$sql=trim($sql,',');
		$sql.=" WHERE id_user=".$id;
		execute($sql,$err);
		if($err) return $err;
		return TRUE;
	}
	// Update the  database

	/* delete from database. ids is null. Delete this one , id is a scalar <br>delete for id , id is an array delete all with those site ids.*/

	function delete($ids=""){
		if(!$ids) $ids=$this->id_user;
		$del_order = "DELETE FROM ".TABLE_PREFIX."order
					WHERE id_user IN ($ids)";
		execute($del_order,$del_err);
		if(is_Array($ids)){
			$ids = implode(",", $ids);
			$sql = "DELETE FROM ".TABLE_PREFIX."user
					WHERE id_user IN ($ids)";
		}else{
			$sql = "DELETE FROM ".TABLE_PREFIX."user
					WHERE id_user = $ids AND id_parent = ".$_SESSION['id_user'];
		}
		if(!is_array($err)){
			execute($sql,$del_err);
			if($del_err) return $del_err;
			return TRUE;
		}
		if($err) return $err;
		return TRUE;
	}

	function validate($arr,$conf_pwd){
		$validdata = array();
		$validdata[]= array("first_name", "isEmpty",$arr['first_name'],"Please enter the first name",);
		$validdata[]= array("last_name", "isEmpty",$arr['last_name'],"Please enter the last name",);
		$validdata[]= array("email", "isEmpty",$arr['email'],"Please enter your email",);
		$validdata[]= array("email", "checkValidemail",$arr['email'],"Please enter valid email",);
		if(!$_SESSION['id_user']){
			$validdata[]= array("username", "isEmpty",$arr['username'],"Please enter the username",);
			$validdata[]= array("password", "isEmpty",$arr['password'],"Please enter the password",);
			$validdata[]= array("conf_pwd", "isEmpty",$conf_pwd,"Please enter the confirm password",);
			if($conf_pwd)
				$validdata[]= array("conf_pwd", "isEqual",$arr['password'],"Please enter same password",$conf_pwd);
			$validdata[]= array("gender", "isEmpty",$arr['gender'],"Please select your gender",);
		}
		$validdata[]= array("hobbies", "isEmpty",$arr['hobbies'],"Please enter the hobbies",);
		$validdata[]= array("address", "isEmpty",$arr['address'],"Please enter the address",);
		$validdata[]= array("dob", "isEmpty",$arr['dob'],"Please select the date of birth",);
		return validator::validate($validdata);
	}


	function printHtml(){
		$ret.=" <TABLE border='1'> ";
		$heading = "<TR>";
		$body="<TR>";
		$vars = $this->getFields();
		foreach($vars as $k=>$v ){
			$heading.="<TD>##LBL_".strtoupper($v)."##</TD>\n";
			$body.="<TD>  {\$x.$v} </TD>\n";
		}
		$section_start = '{section name="cur" loop="`$sm.TABLE_list`"}'."\n".' {assign var="x" value="`$sm.TABLE_list[cur]`"}';
		$section_end ="{/section}";
		return $ret.$heading."</TR>\n".$section_start.$body."<TR>\n $section_end </TABLE>";

	}

	function getlabels(){
		foreach($this->getFields() as $k){
				$body.='define(\'LBL_'.strtoupper($k)."', '".strtoupper($k)."' );\n";
		}
		return $body;
	}
###################################################
#############LOGIN DETAIL INSERT###################
###################################################
	function insert_login($arr,$status) {
		//getting the previous value of counter.
		$sql="SELECT failure_attempt,ip FROM ".TABLE_PREFIX."login WHERE ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY id_login DESC LIMIT 1";
		$res=getrows($sql,$err);
		$fail=(count($res)>0)?$res[0]['failure_attempt']+1:1;

		//entering the status of ip blocking to blockedip table.
		if(($status==6 && $GLOBALS['conf']['IPINFO']['applyblock'])||($status==5 && $GLOBALS['conf']['IPINFO']['applyblock'])){
			$failure=$this->getipfailurevalue();
			$reason=($status==6)?"Both Credentials are wrong":"Password is Wrong";
			//blocking the ip if failure is more than the spacified value in the conf.
			$ipcount=$GLOBALS['conf']['BLOCK_IP']['count'];
			//$ipstatus=($failure>=($ipcount-1))?$GLOBALS['conf']['IPINFO']['statusblock']:$GLOBALS['conf']['IPINFO']['statusactive'];
			//$block_time=($failure>=($ipcount-1))?date("Y-m-d H:i:s",strtotime('now')):'';
			$ipstatus=($failure>=$ipcount)?$GLOBALS['conf']['IPINFO']['statusblock']:$GLOBALS['conf']['IPINFO']['statusactive'];
			$block_time=($failure>=$ipcount)?date("Y-m-d H:i:s",strtotime('now')):'';
			$block_arr = explode(":",$GLOBALS['conf']['IPINFO']['blocktimeinterval']);
			$block_upto=($failure>=$ipcount)?date("Y-m-d H:i:s",strtotime("+ ".$block_arr[0]." Hours ".$block_arr[1]." Minutes ".$block_arr[2]." Seconds")):'';
			$sql="INSERT INTO ".TABLE_PREFIX."blockedip(id_block,ip,username,ipfailure,ipstatus,time_fail,reason,time_upto) VALUES('','".$_SERVER['REMOTE_ADDR']."','".$arr['username']."','".$failure."','".$ipstatus."','".$block_time."','".$reason."','".$block_upto."')";
			execute($sql,$err);
		}else if($status==1 || $status==4){
			$fail=0;
		}
		//inserting to database.
		$sql="INSERT INTO ".TABLE_PREFIX."login(id_login,id_user,ip,date_login,username,email,status,failure_attempt)
				 values(
				 	'',
					'".$arr['id_user']."',
					'".$_SERVER['REMOTE_ADDR']."',
					now(),
					'".$arr['username']."',
					'".$arr['email']."',
					'".$status."',
					'".$fail."'
				 )";
		execute($sql,$err);
		$ret=mysql_insert_id();
		return $ret;
	}
#########################################################
#######Getting ipfailure value###########################
#########################################################
	function getipfailurevalue() {
		$sql="SELECT ip,ipfailure FROM ".TABLE_PREFIX."blockedip WHERE ip='".$_SERVER['REMOTE_ADDR']."' ORDER BY id_block DESC LIMIT 1";
		$res=mysql_fetch_assoc(mysql_query($sql));
		$fail=(count($res)>0)?$res['ipfailure']+1:0;
		return $fail;
	}
#########################################################
#######  update_login         ###########################
#########################################################
	function update_login($arr,$insert_id) {
		$sql="UPDATE ".TABLE_PREFIX."login SET id_user='".$arr['id_user']."',email='".$arr['email']."',date_login=now() WHERE id_login=".$insert_id;
		//print $sql;exit;
	}

###################################################
#############LOGIN DETAIL INSERT###################
###################################################
	function block_ip() {
		$sql="UPDATE ".TABLE_PREFIX."user
				SET flag=0 WHERE ip=".$_SERVER['REMOTE_ADDR'];
		execute($sql,$err);
	}
#####################################################
######Inserting the ip & username of blocked ip######
#####################################################
	function insert_block_ip($user) {
		$sql="INSERT INTO ".TABLE_PREFIX."blockedip VALUES('','".$_SERVER['REMOTE_ADDR']."','".$user."')";
		execute($sql,$err);
	}

###################################################################
#########Updating the Profile Information##########################
###################################################################
	function update_profile($arr){
		$sql="UPDATE ".TABLE_PREFIX."user SET username='".$arr['uname']."',password='".$arr['npass']."',email='".$arr['email']."' WHERE id_user='".$_SESSION['id_user']."'";
		//print $sql;exit;
		$ret=execute($sql,$err);
		return $ret;
	}
##############################################################
############
#############################################################
	function unblock_ip() {
		$sql="DELETE FROM ".TABLE_PREFIX."blockedip WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
		execute($sql,$err);
	}

##############################################################
############changed for encripted password####################
#############################################################
	function reset_pwd($en_pass,$email){
		$sql = "UPDATE ".TABLE_PREFIX."user SET password='".$en_pass."' WHERE email='".$email."'";
		$udel=execute($sql,$err);
		return $udel;
	}
############################################
#### DELETE LOGIN INFORMATION ##############
############################################
	function deletelogin($loginid="") {
		$sql="DELETE FROM ".TABLE_PREFIX."login WHERE id_login IN (".$loginid.")";
		execute($sql,$err);
	}
#############################################################
##############Deleting user##################################
#############################################################
	function deleteuser($id) {
		$sql="DELETE FROM ".TABLE_PREFIX."user WHERE id_user IN (".$id.") LIMIT 1";
		execute($sql,$err);
		$sql_from_frnds = "UPDATE ".TABLE_PREFIX."user SET memeje_friends=TRIM(BOTH ',' FROM REPLACE(CONCAT(',',memeje_friends,','),',".$id.",',',')) WHERE find_in_set('".$id."',memeje_friends)";
		print $sql_from_frnds;exit;
		execute($sql_from_frnds,$err);
	}
	function update_this($tab,$arr,$cond,$flag=''){
		global $link;
		$parm="";
		if($flag){
		    foreach ($arr as $key => $value) {
			$parm.=$key."=".trim($value).",";
		    }
		}else{
		    foreach ($arr as $key => $value) {
			$parm.=$key."='".addslashes(trim($value))."',";
		    }
		}
		$sql = 'CALL update_proc("'.TABLE_PREFIX.$tab.'","'.trim($parm,',').'","'.$cond.'")';
		mysqli_query($link,$sql);
	}
    function update_image_name($img_name) {
	$sql = "UPDATE  ".TABLE_PREFIX."user SET avatar='" . $_SESSION['id_user']."_".$img_name . "' WHERE id_user=" . $_SESSION['id_user'];
	$err = execute($sql, $err);
	if ($err)
	    return $err;
    }
    function update_user_login($tbl,$email){
	$sql = "UPDATE  ".TABLE_PREFIX."user SET last_login=now(),update_login=now(),no_of_logs=no_of_logs+1 WHERE email='".$email."'";
	//print $sql;
	$err = execute($sql, $err);
	if ($err)
	    return $err;
    }
    function update_user_login_time($tbl){
	$sql = "UPDATE  ".TABLE_PREFIX."user SET login_time=login_time+TIME_TO_SEC(TIMEDIFF(now(),update_login)) WHERE id_user=".$_SESSION['id_user']." AND id_admin!=1";
//SELECT now(),TIME_TO_SEC(TIMEDIFF(now(),update_login))as login_time ,update_login from memeje__user where id_user=6
	$sql1 = "UPDATE  ".TABLE_PREFIX."user SET update_login=now() WHERE id_user=". $_SESSION['id_user']." AND id_admin!=1";
	//$err1 = execute($sql1, $err);
	$login_time = execute($sql, $err);
	if ($login_time){
	    $err1 = execute($sql1, $err);
		    print "  :errr :".$err;
		return $err1;
	}
    }
    function update_diff_data($fld,$tbl,$cond,$ids){
	global $link;
	if(is_array($ids) && $ids!=''){
		$to_b_add=$ids;
	}else if($ids!=''){
		$ids=trim($ids,',');
		$to_b_add=@explode(",",$ids);
	}else{
		return;
	}
	$sql = "SELECT ".$fld." FROM ".TABLE_PREFIX.$tbl." WHERE ".$cond." LIMIT 1";
	$res = mysqli_fetch_assoc(mysqli_query($link,$sql));
	if($res[$fld]!=''){
		$val_arr=@explode(",",$res[$fld]);
		$ext_val_arr=array_diff($to_b_add,$val_arr);
		$ext_val=@implode(",",$ext_val_arr);
		$final_val=$ext_val!=''?$res[$fld].','.$ext_val:$res[$fld];
	}else{
		$final_val=@implode(",",$to_b_add);
	}
	$sql_upd="UPDATE ".TABLE_PREFIX.$tbl." SET ".$fld."='".$final_val."' WHERE ".$cond." LIMIT 1";
	//print $sql_upd;exit;
	execute($sql_upd,$err);
	return $final_val;
    }
    function remove_frnd($ssn_frnds,$usr_friends,$id_user){
	$sql="DELETE FROM ".TABLE_PREFIX."frnd_request WHERE requested_by IN ($id_user,".$_SESSION['id_user'].") AND requested_to IN($id_user,".$_SESSION['id_user'].")";
	execute($sql, $err);
	$sql_notify="DELETE FROM ".TABLE_PREFIX."notification WHERE id_user IN ($id_user,".$_SESSION['id_user'].") AND notified_user IN($id_user,".$_SESSION['id_user'].")";
	execute($sql_notify, $err);
	$sn_arr['memeje_friends'] = trim($ssn_frnds,",")?trim($ssn_frnds,","):"";
	unset($_SESSION['friends']);
	$_SESSION['friends']=$sn_arr['memeje_friends'];
	$this->update_this("user", $sn_arr, "id_user=".$_SESSION['id_user']);
	$usr_arr['memeje_friends'] = trim($usr_friends,",")?trim($usr_friends,","):"";
	$this->update_this("user", $usr_arr, "id_user=".$id_user);
	
	/*print $sn_frnds."--".$usr_frnds;exit;
	$ids=explode(",",$id);
	print_r($ids);exit;
	global $link;
	$sql = "SELECT memeje_friends FROM ".TABLE_PREFIX."$tbl WHERE id_user='".$_SESSION['id_user']."' LIMIT 1";
	$res = mysqli_fetch_assoc(mysqli_query($link,$sql));
	$val_arr=@explode(",",$res[memeje_friends]);
	$ext_val_arr=array_diff($val_arr,$ids);
	$final_val=@implode(",",$ext_val_arr);
	$sql1 = "SELECT memeje_friends FROM ".TABLE_PREFIX."$tbl WHERE id_user=$id LIMIT 1";
	$res1 = mysqli_fetch_assoc(mysqli_query($link,$sql1));
	$val_arr1=@explode(",",$res1[memeje_friends]);
	$ext_val_arr1=array_diff($val_arr1,@explode(",",$_SESSION['id_user']));
	
	$final_val1=@implode(",",$ext_val_arr1);
	$sql_upd1="UPDATE ".TABLE_PREFIX.$tbl." SET memeje_friends='".$final_val1."' WHERE id_user=$id LIMIT 1";
	execute($sql_upd1,$err);
	$sql_upd="UPDATE ".TABLE_PREFIX.$tbl." SET memeje_friends='".$final_val."' WHERE id_user='".$_SESSION['id_user']."' LIMIT 1";
	execute($sql_upd,$err);
	$res = $err?$err:1;
	return $res;*/
    }
}