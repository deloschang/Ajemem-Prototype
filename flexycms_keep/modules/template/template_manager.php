<?
class template_manager extends mod_manager {
	function template_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'template');
		$this->obj_template = new template;
		$this->template_bl = new template_bl;
 	}
	function get_module_name() { 
		return 'template';
	}
	function get_manager_name() {
		return 'template';
	}
	function _default() {
	
	}
}	
?>