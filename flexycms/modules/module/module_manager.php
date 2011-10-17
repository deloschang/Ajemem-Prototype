<?php
class module_manager extends mod_manager {
	function module_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'module');
		$this->obj_module = new module;
		$this->module_bl = new module_bl;
 	}
	function get_module_name() { 
		return 'module';
	}
	function get_manager_name() {
		return 'module';
	}
	function _default() {
	}

}
?>