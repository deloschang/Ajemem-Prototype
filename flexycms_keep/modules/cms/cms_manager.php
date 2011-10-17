<?php
class cms_manager extends mod_manager {
	function cms_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'cms');
		$this->obj_cms = new cms;
		$this->cms_bl = new cms_bl;
 	}
	function get_module_name() { 
		return 'cms';
	}
	function get_manager_name() {
		return 'cms';
	}
	function _default() {
		return $this->_show();
	}

######################################################
######### _show() : ##################################
######################################################
	function _show(){
	    global $link;
		$code=$this->_input['code']?$this->_input['code']:$this->arg['code'];
		if(file_exists(APP_ROOT.'templates/static/'.$code.'html')){
			print "found";
		}else{
			//$val=$GLOBALS['conf']['LANGUAGE'];
			$sql = "SELECT * FROM ".TABLE_PREFIX."content WHERE cmscode = '".strip_tags($code)."'  LIMIT 1";
			$res = mysqli_fetch_assoc(mysqli_query($link,$sql));
			$this->_output['data'] = $res;
			//print_r($res);exit;
			$this->_output['tpl']='static/show_content';
		}
	}
	function _about(){
	    $code = $this->_input['code'] ;
	    $this->_output['chk_cms'] = $code;
	    $sql = "SELECT * FROM ".TABLE_PREFIX."content WHERE cmscode = '".strip_tags($code)."' LIMIT 1";
	    $this->_output['data'] = getsingleindexrow($sql);
	    
	    $this->_output['tpl']="cms/about";
	}
}
