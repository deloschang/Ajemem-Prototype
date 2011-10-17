<?php
class admin_leaderboard extends leaderboard_manager {

	function admin_leaderboard(& $smarty, & $_output, & $_input) {
		$this->achievements_manager($smarty, $_output, $_input, 'leaderboard');
		$this->obj_leaderboard = new leaderboard;
		$this->leaderboard_bl = new leaderboard_bl;
	}
	function get_module_name() {
		return 'leaderboard';
	}
	function get_manager_name() {
		return 'leaderboard';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
}