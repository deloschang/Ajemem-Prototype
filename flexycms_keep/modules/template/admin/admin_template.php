<?php
class admin_template extends template_manager {
	function admin_template(& $smarty, & $_output, & $_input) {
		$this->template_manager($smarty, $_output, $_input, 'template');
		$this->obj_template = new template;
		$this->template_bl = new template_bl;
	}
	function get_module_name() {
		return 'template';
	}
	function get_manager_name() {
		return 'template';
	}

	function _show(){
		$arr=$this->_traverse_templates(APP_ROOT."templates/default");
		//print"<pre>";
		//print_r($arr);
		$this->_output['file'] = $arr;
		$this->_output['tpl'] = 'admin/template/tpl_list';
	}
	
	function _gettpl(){
		$data=$this->_input;
		$data['fpath']=str_replace(".tpl.html","",$data['fpath']);
		$fpath=APP_ROOT."templates/".$data['fpath'].".tpl.html";
		if(@fopen($fpath,'r')){
			$this->_output['file_content']=htmlspecialchars(file_get_contents($fpath));
		}else{
			$this->_output['fmsg']="File does not exist";
		}
		$this->_output['fpath']=$data['fpath'].".tpl.html";
		$this->_output['tpl']='admin/template/edit_tpl';
	}
	function _update_tpl(){
		$contents=stripslashes($this->_input['efile']);
		$fp=fopen(APP_ROOT."templates/".$this->_input['fpath'],'w');
		fwrite($fp,$contents);
		fclose($fp);
	}

	function _traverse_templates($path){
		$return_array = array();
		$dir = opendir($path);
		while(($file = readdir($dir)) !== false){
			if($file[0] == '.') continue;
			$fullpath = $path . '/' . $file;
			if(is_dir($fullpath))
				$return_array = array_merge($return_array, $this->_traverse_templates($fullpath));
			else {
				$ext_file = explode('.',$file);
				if($ext_file[count($ext_file)-1] != 'LCK'){
					if(strpos($ext_file[0],'listing')===0 || strpos($ext_file[0],'form')===0){
						$art=explode('templates/',$fullpath);
						$ar=explode('/',$art[1]);
						//$return_array[$art[1]] =$ar[count($ar)-1] ;
						$return_array[] =$art[1] ;
					}
				}
			}
		}
		return $return_array;
	}

}		
?>
