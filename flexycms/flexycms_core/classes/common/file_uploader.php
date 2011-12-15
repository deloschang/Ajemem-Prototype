<?php

/*

presumes that $_FILES is to be used . 
the following are the contents of $_FILES

$_FILES['frm_name_used']['name']['file_control_name'] 
$_FILES['frm_name_used']['tmp_name']['file_control_name'] 
$_FILES['frm_name_used']['type']['file_control_name'] 
$_FILES['frm_name_used']['error']['file_control_name'] 
$_FILES['frm_name_used']['type']['file_control_name'] 
$_FILES['frm_name_used']['size']['file_control_name'] 

Validations performed : 
a) Allowed extensions : default NONE
b) Allowed types : default : NONE
c) Allowed files size : default : NONE

Arguments needed frm_name_used and file_control_name

Actions taken .. 
Failure  :
If the file fails the validation checks return an array containg messages, reasons of the failure

Success :
1) Renames the file per style specified. 
2) Moves the file to the required distination / destinations.
3) Names thumbs per style specified.
4) Creates thumbs in directories specified.

*/


class file_uploader{

var $pref_array = Array();// hold the default preferences Initialised in the constructor 

var $fname;
function file_uploader($pref_array=""){
	$this->pref_array['validate_type'] = '';
	$this->pref_array['validate_ext'] = '';
	$this->pref_array['validate_size'] = '-1';
	$this->pref_array['upload_name'] = '';
	$this->pref_array['upload_dir'] = APP_ROOT."/uploads/";
	$this->pref_array['resize_dir'] = '';
	$this->pref_array['re_size'] = '';
	$this->pref_array['thumb_name'] = '';
	$this->pref_array['thumb_dirs_size_arr'] = '';
	
	
	if(is_array($pref_array))
		 $this->pref_array = array_merge($this->pref_array, $pref_array);
		 
	//print_r($pref_array); exit;
}

function get_file_name($frm_name, $file_control_name){
		$name = $_FILES[$frm_name]['name'][$file_control_name];
		$fileextn = substr(strrchr($name, "."), 1);
		switch ($this->pref_array['upload_name'])
				{
				case 'PREPEND':
					$upload_file_name = $this->pref_array['PREPEND'].preg_replace("/ /","_",$name);				
					break;
				case 'NAME_SAME_EXT':
					$upload_file_name = $this->pref_array['NAME_SAME_EXT'].'.'.$fileextn;
					break;
				case 'NAME_NO_EXT':
					$upload_file_name = $this->pref_array['NAME_NO_EXT'];
					break;
				default :
					$upload_file_name = $name;
				}
		return $upload_file_name;
}

function upload($frm_name, $file_control_name,$replace_file=''){ 
		$name = $_FILES[$frm_name]['name'][$file_control_name];
		//print $name;exit;
		$fileextn = substr(strrchr($name, "."), 1);
		$tmp_name = $_FILES[$frm_name]['tmp_name'][$file_control_name];
		$type = $_FILES[$frm_name]['type'][$file_control_name];
		$size = $_FILES[$frm_name]['size'][$file_control_name];
		$error = $_FILES[$frm_name]['error'][$file_control_name];
		// Validation 
		if($error){ 
			$ret_err[] = $error;
		}
		if($this->pref_array['validate_size'] > -1 && ($size > $this->pref_array['validate_size'])){ 
			$ret_err[]  = 'The file size $size exceeds the allowed size '.$this->pref_array['validate_size'];
		}
		if(!empty($this->pref_array['validate_ext'])){ 
			$valid_extensions =explode(',',$this->pref_array['validate_ext']);
			if(!in_array($fileextn,array_values($valid_extensiona))){
				$ret_err[]  = " File extension $fileextn not found in allowed extension : ".$this->pref_array['validate_ext'];
			}
		}
		if(!empty($this->pref_array['validate_type'])){ 
			$major_type = substr(strrchr($type, "/"), 1);
			$major_types_allowed =explode(',',$this->pref_array['validate_type']);
			if(!in_array($major_type,array_values($major_types_allowed))){
				$ret_err[]  = " File type  $major_type not found in allowed types  : ".$this->pref_array['validate_type'];
			}
		}
		if($ret_err){
			return $ret_err;

		}
		// Validation successful 
		
		// Rename the target file 
		switch ($this->pref_array['upload_name'])
		{
		case 'PREPEND':
			$upload_file_name = $this->pref_array['PREPEND']."_".preg_replace("/ /","_",$name);
			break;
		case 'NAME_SAME_EXT':
			$upload_file_name = $this->pref_array['NAME_SAME_EXT'].'.'.$fileextn;
			break;
		case 'NAME_NO_EXT':
			$upload_file_name = $this->pref_array['NAME_NO_EXT'];
			break;
		default :
			$upload_file_name = $name;
		}
		//echo "the file ".$upload_file_name;exit;
		// Upload the file 
		
		if($replace_file)
			@unlink($this->pref_array['upload_dir'].$replace_file);
		 	copy($tmp_name,$this->pref_array['upload_dir'].$upload_file_name) ;
			$this->fname = $upload_file_name;
			//print $this->fname; print "aa"; exit;
		// resize if needed
		
		if(!empty($this->pref_array['resize_dir'])){
			if($replace_file)@unlink($this->pref_array['resize_dir'].$replace_file);
			$resized_file = $this->pref_array['resize_dir'].$upload_file_name;
			copy($tmp_name,$resized_file) ;
			$cmd="mogrify -geometry '".$this->pref_array['resize'].">' ". $resized_file;
			exec($cmd);
			chmod("$resized_file",0644);

		}
		
		// Create thumbs if needed 
		
		if($this->pref_array['thumb_name']){
			switch ($this->pref_array['thumb_name'])
			{
			case 'TH_PREPEND':
				$thumb_file_name = $this->pref_array['TH_PREPEND'].preg_replace("/ /","_",$name);
				break;
			case 'TH_NAME_SAME_EXT':
				$thumb_file_name = $this->pref_array['TH_NAME_SAME_EXT'].'.'.$fileextn;
				break;
			case 'TH_NAME_NO_EXT':
				$thumb_file_name = $this->pref_array['TH_NAME_NO_EXT'];
				break;
			default :
				$thumb_file_name = $name;
			}

		}else{
			$thumb_file_name = $upload_file_name;
		}
		if(is_array($this->pref_array['thumb_dirs_size_arr'])){
			foreach($this->pref_array['thumb_dirs_size_arr'] as $k){
				$uploadthumbFile = $k['dir'].$thumb_file_name;
				if($replace_file)@unlink($k['dir'].$replace_file);
				copy($tmp_name, $uploadthumbFile);
				$cmd="mogrify -geometry '".$k['size'].">' $uploadthumbFile";
				exec($cmd);
				chmod($uploadthumbFile,0644);
			}
		}

		// end thumb creation
	
}
};
