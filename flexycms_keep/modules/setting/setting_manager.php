<<<<<<< HEAD
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
=======
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
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>