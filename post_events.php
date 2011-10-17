<?php
class post_events{
	
	function humorcms_content_content(){
		$this->content_content_content();
	}

	function content_content_content(){
		if($this->_output['url_plug']){
			header("Location: ".APP_ROOT_URL."index.php?page=plug&url=".urlencode($this->_output['url_plug'])."&iid=".$this->_input['iid']);
			exit;
		}
	}
	
	function ieditor_ieditor_default(){
	//print "d";exit;
		if($this->_input['iid']){
			list($width, $height, $type, $attr) = getimagesize($_REQUEST['file']);
			$this->_output['widthi'] = $width;
			$this->_output['heighti'] =  $height;
		}else{
			$this->_output['setwidth'] = '';
			$this->_output['setheight'] = '';
		}
	}
	

	function ieditor_ieditor_edit(){
		$othumb = $this->_input['lpath'];
		$rthumb = $this->_input['lpath'].".edit";
		rename($rthumb,$othumb);
		if($this->_input['editmain']){
			list($width, $height, $type, $attr) = getimagesize($_REQUEST['file']);
			$cwidth = $GLOBALS['sconf']['THUMBNAIL']['container_width'];
			$cheight = $GLOBALS['sconf']['THUMBNAIL']['container_height'];
			include_once(APP_ROOT."flexycms/modules/humorcms/content_manager.php");
			$obj = new content_manager;
			$result = $obj->get_cinfo($this->_input['editmain']);
			$lpath = $GLOBALS['sconf']['CONTENT_IMAGES']['content_images'].$result[0]['v_file_name'];
			$file = APP_ROOT_URL.$GLOBALS['sconf']['CONTENT_IMAGES']['orig_url'].$result[0]['v_file_name'];	
			$url = APP_ROOT_URL."flexycms/modules/ieditor/?width=".$width."&height=".$height."&cwidth=".$cwidth."&cheight=".$cheight."&lpath=".urlencode($lpath)."&file=".urlencode($file);	
			header("Location: $url");
			exit;
		}else{
			$url = APP_ROOT_URL. 'flexycms/myadmin/index.php/page-content-mgr-content-content_choice-add_new';
			header("Location: $url");
			exit;
		}
	}
	
	
	function humorcms_content_insert(){
		if($this->_input['ieditor_edit']){
			$obj = new content_manager();
			$result = $obj->get_cinfo($this->_input['add_new']['id_content']);
			$lpath = $GLOBALS['sconf']['THUMBNAIL']['thumbnail_root'].$result[0]['v_thumbnail'];
			$file = APP_ROOT_URL.$GLOBALS['sconf']['CONTENT_IMAGES']['orig_url'].$result[0]['v_thumbnail'];
			$url = APP_ROOT_URL. "flexycms/modules/ieditor/?iid={$this->_input['add_new']['id_content']}&lpath=".urlencode($lpath)."&file=".urlencode($file);
			header("Location: $url");
			exit;
		}
	}
	
	function humorcms_content_update(){
		$this->humorcms_content_insert();
	}
	function run($module,$mgr,$choice,$input,$output){
		$fn_name = "{$module}_{$mgr}_{$choice}";
		$this->_input = $input;
		$this->_output = $output;
		$fn_array = get_class_methods("post_events");
		if(in_array($fn_name,$fn_array) || in_array(strtolower($fn_name),$fn_array)){
			$this->$fn_name();
		}
		
		return $this->_output;
	}
}
