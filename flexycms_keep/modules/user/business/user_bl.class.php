<?php
class user_bl extends business
{
	function get_search_sql($search_condition=""){
		if(!$search_condition){
			$sql = "SELECT * FROM ".TABLE_PREFIX."user" ;
		}else{
			$sql = "SELECT * FROM ".TABLE_PREFIX."user WHERE ".$search_condition ;
		}
		return $sql;
	}
#############################################################
########################getForgotPwd()#######################
#############################################################
	function getForgotPwd($email,$cond="") {
		$sql="SELECT * FROM ".TABLE_PREFIX."user
			WHERE email = '".$email."' ".$cond." LIMIT 1";
		$arr = getrows($sql,$err);
		return $arr;
	}
############################################################
#############
############################################################
	function getuserprofile() {
		$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_user='".$_SESSION['id_user']."' LIMIT 1";
		$res=getrows($sql,$err);
		return $res;
	}
############################################################
############# FAILURE ATTEMP FOR LOGIN #####################
############################################################
	function failure_attemp(){
		$sql="SELECT COUNT(id_block) AS cnt FROM ".TABLE_PREFIX."blockedip WHERE ip='".$_SERVER['REMOTE_ADDR']."'";
		return mysql_fetch_assoc(mysql_query($sql));
	}
	function get_frnds_sql(){
		$sql="SELECT * FROM ".TABLE_PREFIX."user WHERE id_admin!=1 AND id_user IN (SELECT id_friends FROM ".TABLE_PREFIX."user WHERE id_user=".$_SESSION['id_user'].")";
		return $sql;
	}
};
