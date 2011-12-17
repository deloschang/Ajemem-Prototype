<<<<<<< HEAD
<?php
class paypal {
	function paypal(){

	}
	function insert_all($tbl,$arr,$flag='',$dt_fld='add_date',$debug=''){//print("i here db");exit;
		$fld_str_key = "";
		//print"<pre>";print_r($arr);exit;
		$fld_str_value = "";
		foreach($arr as $key => $value){
			$fld_str_key .= $key.",";
		}
		$fld_str_key = trim($fld_str_key,',');
		
		if($flag==1){
			$dt_fld='add_date';
			$fld_str_key.=",".$dt_fld;//,add_date,ip";
		}
		//print $fld_str_key;
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
		//print_r($fld_str_key);exit;
		$sql = 'CALL insert_proc("'.TABLE_PREFIX.$tbl.'","'.$fld_str_key.'","'.addslashes($fld_str_value).'",@id)';

/* writing to paypal_veri.txt */ 
		$handle = fopen(APP_ROOT."paypal_veri.txt", "a+");
		fwrite($handle,"\n\n".$sql);
		fclose($handle);
/* End */
		if($debug==1){
		    print $sql;exit;
		}
		//print $sql;exit;
		execute($sql, $err);
		$arr = getsingleindexrow("SELECT @id AS id");//print_r($arr);exit;
	    	return $arr['id'];
	}
	function update_this($tab,$arr,$cond,$flag=''){
		$parm="";
		if($flag){
		    foreach ($arr as $key => $value) {
			$parm.=$key."=".trim($value).",";
		    }
		}else{
		    foreach ($arr as $key => $value) {
			$parm.=$key."='".trim($value)."',";
		    }
		}
		$sql = 'CALL update_proc("'.TABLE_PREFIX.$tab.'","'.trim($parm,',').'","'.$cond.'")';
/* writing to paypal_veri.txt */ 
		$handle = fopen(APP_ROOT."paypal_veri.txt", "a+");
		fwrite($handle,"\n\n".$sql);
		fclose($handle);
/* End */
		execute($sql, $err);
    	}
}
?>
=======
<?php
class paypal {
	function paypal(){

	}
	function insert_all($tbl,$arr,$flag='',$dt_fld='add_date',$debug=''){//print("i here db");exit;
		$fld_str_key = "";
		//print"<pre>";print_r($arr);exit;
		$fld_str_value = "";
		foreach($arr as $key => $value){
			$fld_str_key .= $key.",";
		}
		$fld_str_key = trim($fld_str_key,',');
		
		if($flag==1){
			$dt_fld='add_date';
			$fld_str_key.=",".$dt_fld;//,add_date,ip";
		}
		//print $fld_str_key;
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
		//print_r($fld_str_key);exit;
		$sql = 'CALL insert_proc("'.TABLE_PREFIX.$tbl.'","'.$fld_str_key.'","'.addslashes($fld_str_value).'",@id)';

/* writing to paypal_veri.txt */ 
		$handle = fopen(APP_ROOT."paypal_veri.txt", "a+");
		fwrite($handle,"\n\n".$sql);
		fclose($handle);
/* End */
		if($debug==1){
		    print $sql;exit;
		}
		//print $sql;exit;
		execute($sql, $err);
		$arr = getsingleindexrow("SELECT @id AS id");//print_r($arr);exit;
	    	return $arr['id'];
	}
	function update_this($tab,$arr,$cond,$flag=''){
		$parm="";
		if($flag){
		    foreach ($arr as $key => $value) {
			$parm.=$key."=".trim($value).",";
		    }
		}else{
		    foreach ($arr as $key => $value) {
			$parm.=$key."='".trim($value)."',";
		    }
		}
		$sql = 'CALL update_proc("'.TABLE_PREFIX.$tab.'","'.trim($parm,',').'","'.$cond.'")';
/* writing to paypal_veri.txt */ 
		$handle = fopen(APP_ROOT."paypal_veri.txt", "a+");
		fwrite($handle,"\n\n".$sql);
		fclose($handle);
/* End */
		execute($sql, $err);
    	}
}
?>
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
