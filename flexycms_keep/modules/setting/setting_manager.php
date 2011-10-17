<?php
class setting_manager extends mod_manager {
	function setting_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'setting');
		$this->obj_setting = new setting;
		$this->setting_bl = new setting_bl;
 	}
	function get_module_name() { 
		return 'setting';
	}
	function get_manager_name() {
		return 'setting';
	}
}	
?>