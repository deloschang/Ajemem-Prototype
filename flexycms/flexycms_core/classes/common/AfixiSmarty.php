<?php
require_once (SMARTY_DIR."Smarty.class.php");
class AfixiSmarty extends Smarty {
	var $def_theme = "default";
	var $theme = "";
	function AfixiSmarty($theme = "") {
         $this->set_theme($theme);
	}
	
	function display($template, $cache_id = "", $compile_id = "") {
		return parent :: display($this->add_theme_to_template($template), $cache_id, $compile_id);
	}
	
	function set_theme($theme = "") {
		$this->theme = empty ($theme) ? $this->def_theme : $theme;
		$_SESSION['AFIXI_THEME'] = $this->theme;
	}
	
	function get_theme() {
		return $this->theme ? $this->theme : $this->def_theme;
	}
    
    // returns $tpl with $tpl.tpl.html
    function add_theme_to_template($tpl){
    	$theme_dir = is_file(AFIXI_ROOT."../templates/".$this->theme.'/'.$tpl.TEMPLATE_EXTENSION)?$this->theme : 'default';
    	// D: $theme_dir => default
    	// D: TEMPLATE_EXTENSION => .tpl.html
		// print $theme_dir.'//'.$tpl.TEMPLATE_EXTENSION;exit;
    	return $tpl.TEMPLATE_EXTENSION;     	  	 
    }
    
    function is_cached($tpl,$cache_id){
     	return parent::is_cached($this->add_theme_to_template($tpl),$cache_id);
    }
}
