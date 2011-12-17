<<<<<<< HEAD
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
=======
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
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>