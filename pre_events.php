<?php
class pre_events{
	
	function run($module,$mgr,$choice,$input,$output){
		$fn_name = "{$module}_{$mgr}_{$choice}";
		$this->_input = $input;
		$this->_output = $output;
		$fn_array = get_class_methods("pre_events");
		if(in_array($fn_name,$fn_array) || in_array(strtolower($fn_name),$fn_array)){
			$this->$fn_name();
		}
		return $this->_output;
	}
	function ieditor_ieditor_default(){
		if($this->_input['crop']){
			$this->_output['setwidth'] = '';
			$this->_output['setheight'] = '';
		}else{
			$this->_output['setwidth'] = '64';
			$this->_output['setheight'] = '64';
		}
	}
}
