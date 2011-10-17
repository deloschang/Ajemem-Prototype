<?php
class admin_paypal extends paypal_manager {
	function admin_manager(& $smarty, & $_output, & $_input) {
		if($_SESSION['i_isadmin']){
			$this->message_manager($smarty, $_output, $_input, 'paypal');
			$this->obj_paypal = new paypal;
			$this->paypal_bl = new paypal_bl;
		}
	}
	function get_module_name() {
			return 'paypal';
	}
	function get_manager_name() {
			return 'paypal';
	}
};
?>
