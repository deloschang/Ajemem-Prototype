<?php
function get_search_sql($tbname,$search_condition=""){

	if(!$search_condition){
		$sql = "SELECT * FROM ".TABLE_PREFIX.$tbname ;
	}else{
		$sql = "SELECT * FROM ".TABLE_PREFIX.$tbname." WHERE ".$search_condition ;
	}
	return $sql;

}
function get_year($range=''){
	$dt=date ("Y");
	$range=$dt-$range;
	for($i=$dt;$i>=$range;$i--){
		$date[$i]=$dt;
		$dt--;
	}
	return $date;
}
	

################   Date Check Function ################
function date_check1($str){
		$todaydate=date('Y-m-d');
		$tddate=explode('-',$todaydate);
		$dtchk=explode('-',$str);
		if($dtchk[0] > $tddate[0])
			return 1;
			else if ($dtchk[0] == $tddate[0] && $dtchk[1] > $tddate[1])
				return 1;
				else if($dtchk[1] == $tddate[1] && $dtchk[2] > $tddate[2])
					return 1;
					else if($dtchk[2] == $tddate[2])
						return 1;
						else
							return 0;				
}
//////////////FUNCTION CELCIUS TO FARENHIET////////////////
function CelToFar($cel){
    $Far = $cel *9 /5 +32;
     return $Far;
}
////////////FUNCTION KILOMETERS TO MILES PER HOUR ///////////
 function kmToMPH($km){
     //global $MPH;
     $MPH=$km/1.6;
     return $MPH;
}//end function kmToMPH
/////////////////////////FUNCTION hex2binaary //////////////////////////
function hex2binary($str) {
      $str = str_replace(" ", "", $str);
      $text_array = explode("\r\n", chunk_split($str, 2));

      for ($n = 0; $n < count($text_array) - 1; $n++) {
        $binary .= substr("0000".base_convert($text_array[$n], 16, 2), -8);
      }//end for loop
      $newstring = chunk_split($binary, 8, " ");
      return $newstring;
}//end function
//////////////FUNCTION EACHBIT TO LOOK AT EACH BIT TO SEE IF 1 ///////////////
function EachBit($val){

   $String = hex2binary($val);
   $length = strlen($String);

   $start = 0;
   for($i = 0; $i < $length; $i++){
        $output = substr($String, $start, 1);
            if ($output == 1){
                $bitplace = $i;
            }//end if
        $start++;
   } //end for loop
   return $bitplace;
}/////////end function EachBit
######################################
###PageSession()#####################
######################################
function PageSession(){
	if(time() > $_SESSION['timeout']){
		// User's session has expired.  Go back to the login screen.
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['raise_message']['global'] = "Your session has expired.  Please log back in.";
		redirect(APP_ROOT_URL."index.php/page-user-choice-login");
		exit;
	}// end if
			  ///if the session var timeout is still alive, reset the timer
	if(isset($_SESSION['timeout'])) {
		$_SESSION['timeout'] = (time() + (SESSION_TIMEOUT * 60)); //session_timout is set on login2
	}//end if
}//end function
##################### INSERT FUNCTION###########################################
##################### PASSING PARAMETERS AS TABLE NAME AND AN ###################
##################### INDEX ARRAY WHERE KEY IS THE DB FIELD #####################
##################### NAME AND VALUE AS U WANT TO INSERT INTO DB ################
 
function insert($tbname,$arr){
	$sql = "INSERT INTO ".TABLE_PREFIX.$tbname;
	$fld_str_key = "";
	$fld_str_value = "";
	foreach($arr as $key => $value){
		$fld_str_key .= $key.","; 
	}
	$fld_str_key = substr($fld_str_key,',',strlen($fld_str_key)-1);
	foreach ($arr as $key => $value) {
		if(!isset($value) || $value == ""){
			$fld_str_value .= "NULL,";
		} else {
			$fld_str_value .= "'".$value."',";
		}
	}
	$fld_str_value = substr($fld_str_value,',',strlen($fld_str_value)-1);
	$sql = $sql." (".$fld_str_key.") VALUES(".$fld_str_value.")";
	$err = execute($sql,$err);
	$id = mysql_insert_id();
	return $id;
}
/////////////////////////FUNCTION PID03SWITCH //////////////////////////
function PID03switch($place){
  switch($place){
      case 0:
         return "Open loop - has not yet satisfied conditions to go closed loop";
      break;
      case 1:
         return "Closed loop - using oxygen sensor(s) as feedback for fuel control";
      break;
      case 2:
         return "Open loop due to driving conditions (e.g., power enrichment, deceleration enleanment)";
      break;
      case 3:
         return "Open loop - due to detected system fault";
      break;
      case 4:
         return "Closed loop, but fault with at least one oxygen sensor - may be using single oxygen snsor for fuel control";
      break;
      default:
         return "Error in PID03switch";
   } //end switch
} ///////end function PID03switch /////////////

######################################
###Reorder Key()######################
######################################
function reorder_key($a){
   if (is_array($a)){
      $out = array();
      foreach ($a as $v) $out[] = $v;
   } else $out = $a;
   return $out;
}

######################################
###Get Curl()#####################
######################################

function get_curl($url){
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$feed = curl_exec($ch);
	curl_close($ch);
	return $feed;
}
function convertodate($string,$format,$newformat) {
	if ($string=="") {
		return '';
	} else {
		$fmtarray = explode("-", $format);
		$newfmtarray = explode("-", $newformat);
		$mydate = explode("-", $string);
		$returndate[array_search($fmtarray[0], $newfmtarray)] = $mydate[0];
		$returndate[array_search($fmtarray[1], $newfmtarray)] = $mydate[1];
		$returndate[array_search($fmtarray[2], $newfmtarray)] = $mydate[2];
		ksort($returndate);
		$newdate = implode("-",$returndate);
		return $newdate;
	}
}
