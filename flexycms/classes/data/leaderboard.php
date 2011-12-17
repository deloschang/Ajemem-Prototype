<<<<<<< HEAD
<?php
class leaderboard{
	function leaderboard(){

	}
	function addFriend($tbl,$id){
		$sql="SELECT rec_fd_request FROM ".TABLE_PREFIX."user WHERE id_user='".$_SESSION['id_user']."'";
		$res=getsingleindexrow($sql);
		if($res['rec_fd_request']!=''){
		    $fd=$res['rec_fd_request'].','.$id;
		}else {
		    $fd=$id;
		}
		$sql="UPDATE ".TABLE_PREFIX."user SET rec_fd_request='".$fd."' WHERE id_user=".$_SESSION['id_user'];
		execute($sql,$err);
		$res = $err?$err:1;
		return $res;
	}
	function update_this($tab,$arr,$cond,$flag=''){
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
		//print $sql;exit;
		execute($sql, $err);
	}
	function insert_all($tbl,$arr,$flag='',$dt_fld="add_date",$debug=''){
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

		$sql = 'CALL insert_proc("'.TABLE_PREFIX.$tbl.'","'.$fld_str_key.'","'.addslashes($fld_str_value).'",@id)';
		if($debug==1){
		    print $sql;exit;
		}
		execute($sql, $err);
		$arr = getsingleindexrow("SELECT @id AS id");
		return $arr['id'];
	}
=======
<?php
class leaderboard{
	function leaderboard(){

	}
	function addFriend($tbl,$id){
		$sql="SELECT rec_fd_request FROM ".TABLE_PREFIX."user WHERE id_user='".$_SESSION['id_user']."'";
		$res=getsingleindexrow($sql);
		if($res['rec_fd_request']!=''){
		    $fd=$res['rec_fd_request'].','.$id;
		}else {
		    $fd=$id;
		}
		$sql="UPDATE ".TABLE_PREFIX."user SET rec_fd_request='".$fd."' WHERE id_user=".$_SESSION['id_user'];
		execute($sql,$err);
		$res = $err?$err:1;
		return $res;
	}
	function update_this($tab,$arr,$cond,$flag=''){
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
		//print $sql;exit;
		execute($sql, $err);
	}
	function insert_all($tbl,$arr,$flag='',$dt_fld="add_date",$debug=''){
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

		$sql = 'CALL insert_proc("'.TABLE_PREFIX.$tbl.'","'.$fld_str_key.'","'.addslashes($fld_str_value).'",@id)';
		if($debug==1){
		    print $sql;exit;
		}
		execute($sql, $err);
		$arr = getsingleindexrow("SELECT @id AS id");
		return $arr['id'];
	}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}