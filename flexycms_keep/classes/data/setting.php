<?php
//include_once("/var/www/html/flexycms/flexycms_core/classes/common/validation.php");
/*
Modified for humor cms ..
1. Removed fk functions as they are not being used
2. Modified get function to work only for one id
3. Added error cheincg in get , insert , update and delete
4. Changed the table heading to return #LBL_fieldname#
*/

class setting{
	// null args constructor g
	function setting(){
	}

	// Insert into database Return inserted id  if success , error message if failed
	function insert($arr){
		global $link;
		$sql = "INSERT INTO ".TABLE_PREFIX."config";
		$fld_str_key = "";
		$fld_str_value = "";
		foreach($arr as $key => $value){
			$fld_str_key .= $key.",";
		}
		$fld_str_key = trim($fld_str_key,',');
		//$fld_str_key = substr($fld_str_key,',',strlen($fld_str_key)-1);
		foreach ($arr as $key => $value) {
			if(!isset($value) || $value == ""){
				$fld_str_value .= "NULL,";
			} else {
				$fld_str_value .= "'".$value."',";
			}
		}
		$fld_str_value = trim($fld_str_value,',');
		//$fld_str_value = substr($fld_str_value,',',strlen($fld_str_value)-1);
		$sql = $sql." (".$fld_str_key.") VALUES(".$fld_str_value.")";
		//print $sql;exit;
		//$err = execute($sql,$err);
		//$id_user = mysql_insert_id();
		//return $id_user;
		$link->query($sql);
		$id = mysqli_insert_id($link);
		return $id;
	}

	function edit_config($data,$id_config){
		$sql = "UPDATE ".TABLE_PREFIX."config SET ";
		foreach($data as $k => $v) {
			$sql.= $k."='".$v."',";
		}
		$sql = trim($sql,',');
		$sql.=" WHERE id_config = {$id_config}";
		execute($sql,$err);
	}

	function insert_msg($data) {
		$field_key = '';
		$field_value = '';
		foreach($data as $k => $v) {
			if($v) {
				if($k == 'key_name') {
					$v = strtoupper($v);
				}
				$field_key .= $k.",";
				$field_value .= $v."','";
			}
		}
		$sql = "INSERT INTO ".TABLE_PREFIX."message (".trim($field_key,',').")
			VALUES ('".trim($field_value,",'")."')";
		return $sql;
	}

	function edit_msg($data,$id_msg){
		$sql = "UPDATE ".TABLE_PREFIX."message SET ";
		foreach($data as $k => $v) {
			if($k == 'key_name') {
				$v = strtoupper($v);
			}
			$sql.= $k."='".$v."',";
		}
		$sql = trim($sql,',');
		$sql.=" WHERE id_message = {$id_msg}";
		return $sql;
	}

	function delete_msg($key_name){
		$sql="DELETE FROM ".TABLE_PREFIX."message WHERE key_name = '".$key_name."'";
		return $sql;
	}

}
?>
