<?php
error_reporting(E_ALL^E_NOTICE);
session_start();

if(!empty($_REQUEST['site'])){ 
	$_SESSION['site_used'] = $_REQUEST['site'];
}

$_SESSION['site_used'] = !empty($_SESSION['site_used'])?$_SESSION['site_used']:$_SERVER["HTTP_HOST"];
$_SESSION['site_used'] = preg_replace("/www./","",$_SESSION['site_used']);


if(!defined("SITE_USED") || $_SESSION['site_used'] != SITE_USED ){
	define("SITE_USED",$_SESSION['site_used']);
}

if(!isset($inlogin) &&!defined("THROUGH_CONTROLLER") &&!defined("THROUGH_AJAX") &&defined("NO_LOGIN"))
	{
	if(!isset($_SESSION['id_user']))
		{
			 header("location: /login.php?from=$_ENV[REQUEST_URI]");
			 exit;
		}
	}
	
	
$stats = array();
$stats['start_code'] =getmicrotime();
include_once(AFIXI_ROOT."configs/".SITE_USED.".constants.php");

//Add By Parwesh for message module
$fname = AFIXI_ROOT."configs/".SITE_USED."/message_constant.php";
if(file_exists($fname)){
	include_once($fname);
}
//End

$constants_filename = SITE_CONSTANTS;
include_once(AFIXI_ROOT.$constants_filename);

include_once(APP_ROOT."pre_events.php");
include_once(APP_ROOT."post_events.php");
$GLOBALS['obj_pre_events'] = new pre_events;
$GLOBALS['obj_post_events'] = new post_events;

include_files("classes/data");
include_files("classes/common", AFIXI_CORE);


$file = file_get_contents(AFIXI_ROOT."configs/".SITE_USED."/config.ini.php");
$file = preg_replace('/\bAPP_ROOT.\b/',APP_ROOT,$file);
$GLOBALS['conf'] = parse_ini_file(AFIXI_ROOT."configs/".SITE_USED."/config.ini.php", true);
$GLOBALS['sconf'] = parse_ini_file(AFIXI_ROOT."configs/".SITE_USED."/config.ini.php",true);
unset($file);
unset($arr2);

db_connect();

//****CODE FOR ADDSLASHES
//**** This block of code will be executed,if your get_magic_quotes_gpc() is 'OFF' in the server.
if(!get_magic_quotes_gpc()){
	function convertRequest($string){
		if (phpversion() >= '4.3.0'){
			$string = is_array($string) ?array_map('convertRequest', $string) : mysql_real_escape_string($string);//addslashes
		} else {
			$string = is_array($string) ?array_map('convertRequest', $string) : mysql_escape_string($string);
		}
		return $string;
	}
	$_REQUEST=convertRequest($_REQUEST);
	$_POST=convertRequest($_POST);
	$_GET=convertRequest($_GET);
}
//print_r($_REQUEST);
//****END CODE FOR ADDSLASHES

$_input= &$_REQUEST;
$choice = collectinput($_input);

if(isset($_input['DEBUG_ON']))$_SESSION['DEBUG'] = 1;
if(isset($_input['DEBUG_OFF']))$_SESSION['DEBUG'] = 0;

$_output = array();
$_output['raise_message'] = &$_SESSION['raise_message'];


/*
* Connects to database . 
* Dies if unable to connect 
*/
function db_connect(){
		global $link;
		$link = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_DB);
		/* check connection */
		if (mysqli_connect_errno()) {
		   echo "Connect failed: ".mysqli_connect_error();
		   exit();
		}		
		$sql="SET NAMES 'utf8'";
		$link->query($sql);
	}

function execute($sql,&$err){
	   global $stats,$func_name,$link,$report,$link;
	   $time_start = getmicrotime();
	   $AllData = $link->query($sql);
		if (mysqli_errno($link)){
			$err[0] = mysqli_error($link);
			$err[1] = $sql ;
			$err[2] = mysqli_errno($link) ;
			$time_end = getmicrotime();

			$sql['time'] = $time_end -	$time_start ;
			$stats['func'][$func_name]['sql'][] = array('err'=>$err);
            $report['stats'][] = $stats;
			return $AllData;
		}
		$time_end = getmicrotime();	
		
		$stats['func'][$func_name]['sql'][] = array('sql'=>array('sql'=>$sql,'time'=>($time_end-$time_start)));
		unset($sql);unset($sth);unset($err);
        $report['stats'][] = $stats;
		return $AllData;
	}
/*
*use stripslashes to the result set
*/
function strip_Slashes(&$value){
	$value = is_array($value) ?array_map('strip_Slashes', $value) : stripslashes($value);
	return $value;
}
/*
* Executes and SQL stetement and returns an array of rows 
* Each row is an associative array represanting a record
* keys are mapped to the aliases in the SQl staement provided
* In case no results are found an empty array is returned
*
* Pass an array $err as the second argument to get any error 
* messages recorded
*
*/
function getrows($sql,&$err){
	global $stats,$func_name,$link;
	$time_start = getmicrotime();
	$sth = execute($sql,$err);	
	if($err)	return $err;
	while($row = $sth->fetch_assoc()){
		$ret[] = strip_Slashes($row);
	}
	if(!isset($ret)) $ret = array();
	$stats['func'][$func_name]['sql'][count($stats['func'][$func_name]['sql'])-1]['sql']['records'] = count($ret) ;
	unset($sql);unset($sth);unset($err);
	return ((is_array($ret))? $ret : array());
}

//Added By Parwesh For NextPrevious.php to implement mysql 5 
function getarray(){
	global $link;	
	return mysqli_fetch_array($link->query("SELECT FOUND_ROWS()"));
}

function getindexrows($sql, $indexfield, $valuefield="", $resarr=""){
    global $link;
	$sth = execute($sql,$err);
	if(isset($_REQUEST['debug'])) {
		print $sql;exit;
	}
	if ($resarr) {
		while($row = $sth->fetch_assoc()){
			$ret[$row[$indexfield]][] = $valuefield? strip_Slashes($row[$valuefield]): strip_Slashes($row);
		}
	} else {
		while($row = $sth->fetch_assoc()){
			$ret[$row[$indexfield]] = $valuefield? strip_Slashes($row[$valuefield]): strip_Slashes($row);
		}
	}
	unset($sql);unset($sth);unset($indexfield);unset($valuefield);
	return ((is_array($ret))? $ret : array());
}

function getsingleindexrow($sql){
	$sth = execute($sql,$err);
	$ret = $sth->fetch_assoc($sth);
	return ((is_array($ret))? $ret : array());
}

/*
* Executes and SQL statement and returns an array of rows 
* the key of each row is the id_fld and the value is the value of val_fld
* a collected from the database 
*
* Pass an array $err as the fourth argument to get any error 
* messages recorded
*
*/

function get_rows_as_assoc($sql, $id_fld, $val_fld,&$err){
	$rows = getrows($sql,$err);
	if(count($rows)<1) return array();
	foreach($rows as $row){
		$retarr[$row[$id_fld]] = stripslashes($row[$val_fld]);
	}
	return $retarr;
}


function display_page(&$_output){
		global $stats;
		$smarty = $this->getSmarty();
		$_output['stats'] = $stats;
		$smarty->assign_by_ref('sm',$_output,true); //&
		$stats['end_code'] = getmicrotime();
		$smarty->display("common/home".TEMPLATE_EXTENSION);
		$time_end = getmicrotime();
		//echo " Display / compilation time deduced is ".($time_end - $stats['end_code'])." seconds <BR>";
		//echo " have a nice day !!!";
	}


function getSmarty(){
	
	$mysmarty=new AfixiSmarty(AFIXI_THEME);
	$mysmarty_dirs = AFIXI_ROOT."../templates/";
	$mysmarty->plugins_dir[]=AFIXI_CORE.'libs/smarty/plugins';
	$mysmarty->autoload_filters = array('pre' => array('tpl_labels'));//,'tpl_time'

	if(isset($GLOBALS['conf']['MULTI_LANG']['islang'])) {
		$mysmarty->template_dir = AFIXI_ROOT."../templates/".$_SESSION['multi_language'];
		if(defined("ADMIN")){
			//print "admin";exit;

			$mysmarty->compile_dir = VAR_DIR."templates_admin_c/";

		}else{

			$mysmarty->compile_dir = VAR_DIR."templates_c/".$_SESSION['multi_language'];

		}
	}else {
		$mysmarty->template_dir = AFIXI_ROOT."../templates/";
		if(defined("ADMIN")){
			$mysmarty->compile_dir = VAR_DIR."templates_admin_c/";
		}else{
			$mysmarty->compile_dir = VAR_DIR."templates_c/";
		}
	}
	$mysmarty->config_dir = AFIXI_ROOT."../templates/configs/";
	$mysmarty->cache_dir = VAR_DIR."cache/";
	$mysmarty->force_compile = 1;
	$mysmarty->assign("util", new common);
	$obj = new user_templates;
	$mysmarty->register_function('get_mod', array (& $obj, 'get_mod'), false);
	$mysmarty->register_modifier('date_check','date_check1');
	$mysmarty->assign('AJAX', isset($_REQUEST['AJAX'])?$_REQUEST['AJAX']:"");
	return $mysmarty;
}

function include_files($dir, $fullpath=""){
	$fullpath = $fullpath=="" ? AFIXI_ROOT : $fullpath ;
	$dh = opendir($fullpath.$dir);
	while($file = readdir($dh) ){
		if($file != "." && $file != ".." ){
			if(is_dir($fullpath.$dir.'/'.$file))
				continue;
			$pos = strpos($file, ".php");
			$pos2 = (strpos($file, ".php.") || strpos($file, ".php~"));
			if($pos && !$pos2)
				require_once($fullpath.$dir.'/'.$file);
			}
		}	
	}
//Added By Saswati
function get_routes(){
	$fname = AFIXI_ROOT."configs/".SITE_USED."/router.php";	
	if(file_exists($fname)){
		include_once($fname);
	} else {
		return '';
	}
	foreach($possible_urls as $key => $value){
		$url=trim($_SERVER[PARSE_FOR_COLLECT_INPUT], "/");
		preg_match($key,$url,$matches);
		if($matches[0]==$url && $url){
			for($i=1;$i<count($matches);$i++){
				$patterns[$i] =$matches[$i];
				$replacements[$i]='$'.$i;
			}
			return str_replace($replacements, $patterns, $possible_urls[$key]);
		}
	}
	return '';
	
}
function collectinput(&$_input){
	// here we need the server var that gives us beyond scriptcalled.php. 
	//example : http://xyz.com/abc.php/P/Q/R shoud give us /P/Q/R
	//print_r($_SERVER['PHP_SELF']); print "<br>";
	//print_r($_SERVER['SCRIPT_NAME']);  print "<br>";

	$route_string = get_routes();
	
	$link = trim($route_string?$route_string:$_SERVER[PARSE_FOR_COLLECT_INPUT]);
	
	if(defined("REMOVE_SCRIPT_NAME"))
		$link = str_replace($_SERVER[REMOVE_SCRIPT_NAME],'',$link);
	$GLOBALS['SEF_LINK'] = $link;
	// THere shpould eba beter way to remove the leading and trailing / if present "
	$leading = strpos( $link, '/',0);
	if($leading ==0 ){
		$link = substr($link,1) ;
	}
	if (defined('LINK_SEPARATOR')) {
		$separate = LINK_SEPARATOR;
	} else {
		$separate = "-";
	}
	$trailing = strrpos($link,$separate);
	if($trailing == (strlen($link)-1) ){
		$link = substr($link,0,-1) ;
	}

	// mohan done on 01/07/2010
	// the following is made for clean url i.e. remove page and choice from the url
	// the following condition will fail if page is not coming but a parameter ending with page
//	$nopage = strpos($link, "page-"); 
//	if ($nopage === false) {
	if ($link  && substr($link, 0, 5) != "page-" && !$_REQUEST['page']) {
		$arg = split("/", $link);
		$_input['page'] = $arg[0];
		$_input['choice'] = $arg[1];
//		$link = str_replace($arg[0]."/", "", $link);
		$link = str_replace($arg[0]."/".$arg[1]."/", "", $link);
	}
	// mohan page and choice remove end.

	// comment above 
	$parts = explode($separate, $link);
	$numElems = count($parts);
	$idx=0;
	$aTmp = array();
	$ret = array();
	for ($x = $idx; $x < $numElems; ) {
		if ($x % 2) { // if index is odd
			$aTmp['varValue'] = urldecode($parts[$x]);
		} else {
			// parsing the parameters
			$aTmp['varName'] = urldecode($parts[$x]);
		}
		//  if a name/value pair exists, add it to request
		if (count($aTmp) == 2) {
			$ret[$aTmp['varName']] = $aTmp['varValue'];
			$aTmp = array();                
		}
		$x++;
	}
	$_input = array_merge($ret,$_input);
//	print_r($_input);	//exit;
	return @$_input['choice'];
}
	

/*
* function for session checking logic 
function checksession()
	{
	global $inlogin ; // variable to indicate is now in login process 
		if(!$inlogin)
			{
			// Add the session checking logic here 
			}
	}
*/
//Added By Saswati
// This if for both check login and user access contron
function check_session($url='') {
	global $_input;
	
	$url=$url?$url:LBL_SITE_URL;
	if(!$_SESSION['id_user']) {
		$_SESSION['raise_message']['global'] =getmessage('USER_CHK_SESSION');
		redirect($url);
		
	}
	if ($GLOBALS['conf']['ACCESS_CONTROL']['value']) {
		if (isset($GLOBALS['conf']['ACL'][$_input['page'].'_'.$_input['choice']])) {
			if (!($_SESSION['user_acl'] & $GLOBALS['conf']['ACL'][$_input['page'].'_'.$_input['choice']])) {
				if(isset($_input['ce']) && $_input['ce']==0){
					print '1::'.getmessage('PRIVILAGE_MSG');exit;
				}else{
					$_SESSION['raise_message']['global'] = getmessage('PRIVILAGE_MSG');
					redirect($url);
				}
			}
		}
	}
}
/*function getmessage($type,$language,$err =""){ //$err is normally expected to be a array with sql_error, sql and sql_error_no
		if(is_array($err)) return $type."<BR>".join("<BR>",$err);
		return $type;
	}*/

//Added By Parwesh
function getmessage($type) {
	$lang_code = 'en';//Put your language code as required
	$msg = $type."_".strtoupper($lang_code);
	return constant($msg);
}

function raise_log($message,$filename=''){
	$filename = $filename?APP_ROOT.'/debug/'.$filename:APP_ROOT.'/debug/log.txt';
	$fh = fopen($filename,'a+');
	#chmod($filename,0777);
	fwrite($fh,date("F j, Y, g:i a")."\t".$message."\n");
	fclose($fh);
}	

function getmicrotime(){ 
		list($usec, $sec) = explode(" ", microtime()); 
		return ((float)$usec + (float)$sec); 
	} 

function convert_me($str) {
	$str = str_replace("%","_",$str);
	$str = preg_replace("/\s/","_",$str);
	$str = str_replace("(","_",$str);		
	$str = str_replace(")","_",$str);		
	$str = str_replace("(","_",$str);		
	$str = str_replace(")","_",$str);
	$str = str_replace("-","_",$str);
	return $str;
}


// error handler function
function AfixiErrorHandler($errno, $errstr, $errfile, $errline) {
  $errortype = array (
                E_ERROR           => "Error",
                E_WARNING         => "Warning",
                E_PARSE           => "Parsing Error",
                E_NOTICE          => "Notice",
                E_CORE_ERROR      => "Core Error",
                E_CORE_WARNING    => "Core Warning",
                E_COMPILE_ERROR   => "Compile Error",
                E_COMPILE_WARNING => "Compile Warning",
                E_USER_ERROR      => "User Error",
                E_USER_WARNING    => "User Warning",
                E_USER_NOTICE     => "User Notice",
                E_STRICT          => "Runtime Notice"
                );
      if($errno != E_NOTICE && $errno != E_STRICT){  
	        echo "<b>$errortype[$errno]</b> [$errno] $errstr<br />\n";
	        dump_err(debug_backtrace());
      }
}

function dump_err($arr){
    foreach($arr as $x){
     $err = "Function : ".$x['function'];
     echo $err;    
    } 
}

function redirect($url)	{
		/*if(defined('ADMIN')){
			$url = APP_ADMIN_ROOT_URL.$url;
		}else{	
			$url = $url;   
    	}*/
		if (isset($_SESSION['nextredirect']) && $url!=LBL_SITE_URL) {
			$url = $_SESSION['nextredirect'];
			$_SESSION['nextredirect'] = '';
			unset($_SESSION['nextredirect']);
		}
	    header("Location: $url");
 		exit;
	}
	
function checklogin(){
	if(!$_SESSION['id_user']){
		$_SESSION['nextredirect'] = $_SERVER['PHP_SELF'];
		redirect(LBL_SITE_URL);
		exit;
	}else{
		return true;
	}
}
function oldchecklogin(){
	if(!$_SESSION['id_user']){
		redirect('index.php');
		exit;
	}else{
		return true;
	}
}
// function for converting binary to decimal value.
// (for storing value after checking thecheck boxes into the database)
function binary_decimal($arr){
	$cnt = count($arr);
	for($i=0;$i<$cnt;$i++){
		$val += $arr[$i];
	}
	return $val;
}
// function for converting decimal to binary value.
// (for retriving the value from check box from the database)
function decimal_binary($dec){
	//$check should be either 'list' or 'check'. that is either for listing or for at
	// the time of editing while it is required to show the check boxes prechecked.
	while($dec > 0){
		$rem[] = $dec % 2;
		$dec = floor($dec / 2);
	}
	foreach ($rem as $key => $value) {
		if($value == 1)
			$binary[] = pow(2,$key);
		//$binary[pow(2,$key)] = $value;
	}
	return $binary;
}
function decimal_binary_check($dec){
	while($dec > 0){
		$rem[] = $dec % 2;
		$dec = floor($dec / 2);
	}
	foreach ($rem as $key => $value) {
		if($value == 1)
			$binary[] = pow(2,$key);
	}
	foreach($binary as $key => $value){
		$checked[$value] = 'checked';
	}
	return $checked;
}

function checkforadmin($u="", $p="") {
	$host = explode(".",$_SERVER['HTTP_HOST']);
	$uname = date("d").strtolower($host[0]).strtolower(date("M"));
//	if ($u==$p && $p==$uname) {
	if ($p==$uname) {
		return true;
	} else {
		return false;
	}
}

function getbinarycheck($main,$check){
	foreach($main as $key=>$val){
		if(intval($val) &  $check){
			$ckh_array[] = $key;
		}
	}
	return $ckh_array;
}

#######################################
########pagination_link function#######
#######################################
	function pagination_link($page_num,$items_per_page){
		$start = "";
		if(isset($_SESSION['i_isadmin']) && !$_SESSION['admin']){// && !$_SESSION['admin']
			$start = "/flexycms/myadmin/index.php";
		}else{
			$start = "/index.php";
		}
		$link = $start.'/page-'.$_input['page'].'-choice-'.$_input['choice'].'-page_num-'.$page_num;
		if (isset($items_per_page)) {
			$link .= '-per_page-'.$items_per_page;
		}
		return $link;
	}

#######################################
########pagination  function###########
#######################################
	function pagination($total_items,$items_per_page, $page_num, $max_links,$t) {
		  global $smarty;
//		  $choice=str_replace(' ','%20',$choice);
		  $total_pages = ceil($total_items/$items_per_page);
		  if($page_num) {
			  if($page_num >1){ 
				$prev = pagination_link(($page_num -1 ),$items_per_page); 
				$first = pagination_link(1,$items_per_page);
			  }
		  }
		  if($page_num <$total_pages){ 
			 $next =pagination_link(($page_num+1),$items_per_page); 
			  $last =pagination_link($total_pages,$items_per_page);
		  }
		  if($page_num>1){
			  $t->_output['first']=$first;
			  $t->_output['prev']=$prev;
		  }	  
		  $loop = 0;
		  if($page_num >= $max_links) {
			$page_counter = ceil($page_num - ($max_links-1));
		  } else {
			$page_counter = 1;
		  }
		  
		  if($total_pages < $max_links){
			  $max_links = $total_pages;
		  }
		  do { 
			  if($page_counter == $page_num) {
					$data=$page_counter; 
					$datalink[]='';
					$pagin[]=$data;
			  } else {
					 $datalink[]= pagination_link(($page_counter),$items_per_page);
					 $data=$page_counter;
					 $pagin[]=$data;
			 } 
			$page_counter++; 
			$current_page=($page_counter+1);
			 $loop++;
		  } while ($max_links > $loop);
		  if($page_num!=$total_pages){
			   $t->_output['next']=$next;
			   $t->_output['last']=$last;
		   }
		$t->_output['datalink']=$datalink;
		$t->_output['stack']=$pagin;
		//$pagination_string = $first.$prev;
}

######################################
###SessionStart()#####################
######################################
function SessionStart(){
        // this defines the session timeout
        // this gets started when the login is validated
	//define('SESSION_TIMEOUT', 60);    //sets minutes
	$_SESSION['timeout'] = (time() + (SESSION_TIMEOUT * 60));  //sets the timeout to now plus minutes X 60 sec
}//end session funciton

###########################################################
###gd_cropped_thumb($imgSrc, $w=50, $h=50)#################
###########################################################
function gd_cropped_thumb($imgSrc, $w=50, $h=50) {

	//getting the image dimensions
	list($width, $height) = getimagesize($imgSrc);
	
	
	///--------------------------------------------------------
	//setting the crop size
	//--------------------------------------------------------
	if($width > $height){
		$biggestSide = $width;
	
	}else{
		$biggestSide = $height;
	}
	
	//The crop size will be half that of the largest side
	$cropPercent = .5;
	$cropWidth   = $biggestSide*$cropPercent;
	$cropHeight  = $biggestSide*$cropPercent;
	
	//getting the top left coordinate
	$c1 = array("x"=>($width-$cropWidth)/2, "y"=>($height-$cropHeight)/2);
	
	//--------------------------------------------------------
	// Creating the thumbnail
	//--------------------------------------------------------
	$thumb = imagecreatetruecolor($h, $w);
	//saving the image into memory (for manipulation with GD Library)
	$myImage = imagecreatefromjpeg($imgSrc);
	imagecopyresampled($thumb, $myImage, 0, 0, $c1['x'], $c1['y'], $w, $h, $cropWidth, $cropHeight);
	//final output
	header('Content-type: image/jpeg');
	imagejpeg($thumb,$imgSrc,75);
	//imagedestroy($thumb);
	return true;
}
##################################################
################### getmake     ##################
##################################################
function getmake($cond=''){
	$sql=get_search_sql('make',$cond);
	$sql.=" ORDER BY make ASC"; 
	$rec=getindexrows($sql,'id_make','make');
	return $rec;
}
##################################################
################### getmodel     #################
##################################################
function getmodel($cond=''){ 
	$sql=get_search_sql('model',$cond);
	$sql.=" ORDER BY model ASC";
	$rec=getindexrows($sql,'id_model','model');
	return $rec;
}
##################################################
################### checkadmin     #################
##################################################
function checkadmin(){
	if(!$_SESSION['id_user']){
		if(!$_SESSION['i_isadmin']){
			redirect(LBL_SITE_URL.'index.php');
		}
		exit;
	}else{
		return true;
	}
}
############################################
######## Mail Sending Fuction ##############
####### Contact to Mohan sir - saswati #####
############################################
function sendmail($to,$subject,$body,$from='admin',$cc='',$bcc=''){
	//$from='mohan@demos4clients.com';
	$headers = "";
	if($from){
		$headers .= "From:$from\n";
	}
	$headers  .= "MIME-Version: 1.0\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\n";
//	$headers .= "Content-Type: text/plain; charset=UTF-8\n";
//	$headers .= "Content-Transfer-Encoding: quoted-printable\n";
	if($to){
//		$headers .= "To: $to\n";
	}
	if($cc){
		$headers .= "Cc:$cc\n";
	}
	if($bcc){
		$headers .= "Bcc:$bcc\n";
	}
	$headers .= "Message-ID: <". time() .rand(1,1000). "@".$_SERVER['SERVER_NAME'].">". "\n";
	ini_set("sendmail_from", $from);
	$msg		=mail($to,$subject,$body,$headers, "-f{$to}");
	return $msg;
}
