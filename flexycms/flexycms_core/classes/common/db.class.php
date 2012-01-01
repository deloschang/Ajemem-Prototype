<?php
class db_class{
	var $table_name;
/*	
* $records :- array of the data to be inserted.
* $fields  :- extra fields to be inserted rather than values from form fields.It is optional.
* $multi :- is a flag variable to ensure multiple records to be inserted or single record. Default= single record.
*/	
	function insert($records,$fields="",$multi=""){
		global $link;
		$records = $multi ? $records:array($records);
		$tablename = $this->table_name;
		$insert_ids = array();
		foreach($records as $record){
			$sql = "INSERT INTO ".TABLE_PREFIX.$tablename;
			$fld_str_key = "";
			$fld_str_value = "";
			$fields=$fields?$fields:array('create_date'=>'NOW()','ip'=>"'".$_SERVER['REMOTE_ADDR']."'");
			$exfields = implode(",",array_keys($fields));
			$exvalues = implode(",",array_values($fields));
			foreach($record as $key => $value){
				$fld_str_key .= $key.","; 
				if(!isset($value) || $value == ""){
					$fld_str_value .= "NULL,";
				} else {
					$fld_str_value .= "'".$value."',";
				}
			}
			$fld_str_key = trim(substr($fld_str_key,0,strlen($fld_str_key)-1),",");
			$fld_str_value = trim($fld_str_value,",");
			$sql = $sql." (".$fld_str_key.",".$exfields.") VALUES(".$fld_str_value.",".$exvalues.")";
			execute($sql,$err);
			if($err) 
				return $err ;
			$insert_ids[] = mysqli_insert_id($link);
		}
		$this->insert_ids = $insert_ids;
		return true;
	}
	
	function update($records,$where="",$multi=""){
		$records = $multi ? $records:array($records);
		$where = $where?$where:"1";
		foreach($records as $record){
			$sql="UPDATE ".TABLE_PREFIX.$this->table_name." SET ";
			foreach ($record as $key => $value) {
				$sql .= $key."='".$value."',";
			}
			$sql=trim($sql,',');
			
			$sql .= " WHERE ".$where;			
			execute($sql,$err);
			if($err) 
				return $err;
		}
		return true;
	} 
	
	function delete($tbl,$cond=""){
		$tbl = is_array($tbl)?$tbl:array($tbl);
		$cond = $cond?is_array($cond)?$cond:array($cond):array("1");
		foreach($tbl as $k=>$v){
			$sql = "DELETE FROM ".TABLE_PREFIX.$v." WHERE ".$cond[$k];
			execute($sql,$err);
			if($err) 
				return $err;
		}
		return true;
	}
}
