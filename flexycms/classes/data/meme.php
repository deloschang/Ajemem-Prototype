<?php
class meme{
	function meme(){

	}
	function insert_all($tbl,$arr,$flag='',$dt_fld='add_date',$debug=''){
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
	function delete_premadeImages($table,$id,$fld){
	    $sql="DELETE FROM ".TABLE_PREFIX.$table." WHERE ".$fld." IN(".$id.")";
	    $id=execute($sql,$err);
	    return $id;
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
	execute($sql, $err);
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
//	print $sql_upd;exit;
	execute($sql_upd,$err);
	$res = $err?$err:1;
	return $res;
    }
}
