<?php
class admin_duels extends duels_manager{

	function admin_duels(& $smarty, & $_output, & $_input) {
		$this->duels_manager($smarty, $_output, $_input, 'duels');
		$this->obj_duels = new duels;
		$this->duels_bl = new duels_bl;
	}
	function get_module_name() {
		return 'duels';
	}
	function get_duels_name() {
		return 'duels';
	}
	function duels_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
}
