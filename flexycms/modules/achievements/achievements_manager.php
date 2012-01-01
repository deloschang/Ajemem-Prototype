<?php
class achievements_manager extends mod_manager {
	function achievements_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'achievements');
		$this->obj_achievements = new achievements;
		$this->achievements_bl = new achievements_bl;
 	}
	function get_module_name() {
		return 'achievements';
	}
	function get_manager_name() {
		return 'achievements';
	}
	function _default() {

	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	function _detect_os(){
		print $_SERVER['HTTP_USER_AGENT'];
		$OSList = array
		(
		// Match user agent string with operating systems
			'Windows 3.11' => 'Win16',
			'Windows 95' => '(Windows 95)|(Win95)|(Windows_95)',
			'Windows 98' => '(Windows 98)|(Win98)',
			'Windows 2000' => '(Windows NT 5.0)|(Windows 2000)',
			'Windows XP' => '(Windows NT 5.1)|(Windows XP)',
			'Windows Server 2003' => '(Windows NT 5.2)',
			'Windows Vista' => '(Windows NT 6.0)',
			'Windows 7' => '(Windows NT 7.0)',
			'Windows NT 4.0' => '(Windows NT 4.0)|(WinNT4.0)|(WinNT)|(Windows NT)',
			'Windows ME' => 'Windows ME',
			'Open BSD' => 'OpenBSD',
			'Sun OS' => 'SunOS',
			'Linux' => '(Linux)|(X11)',
			'Mac OS' => '(Mac_PowerPC)|(Macintosh)',
			'QNX' => 'QNX',
			'BeOS' => 'BeOS',
			'OS/2' => 'OS/2',
			'Search Bot'=>'(nuhk)|(Googlebot)|(Yammybot)|(Openbot)|(Slurp)|(MSNBot)|(Ask Jeeves/Teoma)|(ia_archiver)'
		);
		// Loop through the array of user agents and matching operating systems
		foreach($OSList as $CurrOS=>$Match){
			// Find a match
			if (eregi($Match, $_SERVER['HTTP_USER_AGENT'])){
				// We found the correct match
				break;
			}
		}
		echo "You are using ".$CurrOS;

	}
############################################
#############DEFAULT BADGE LISTING##########
############################################
	function _badge_list(){
	    $sql=$this->achievements_bl->get_search_sql("badge","FIND_IN_SET(id_badge,(select id_badges from memeje__user where id_user='".$_SESSION['id_user']."'))","*");
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	     if($this->arg['gmod']==1){
		 $this->_output['tpl']="achievements/badgelist";
	    } else{
		$this->_output['tpl']="achievements/badge_list_all";
	    }
	    
	}


	function _whatisMemeja(){
		$sql=$this->achievements_bl->get_search_sql("badge","1");
		$res=getrows($sql,$err);
		if($res){
			$this->_output['res']=$res;
		}
		$this->_output['tpl']="achievements/whatisMemeja";
	}
}
