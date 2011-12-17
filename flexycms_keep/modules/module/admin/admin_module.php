<<<<<<< HEAD
<?php
class admin_module extends module_manager {
	function admin_manager(& $smarty, & $_output, & $_input) {
		if($_SESSION['id_admin']){
			$this->module_manager($smarty, $_output, $_input, 'module');
			$this->obj_module = new module;
			$this->module_bl = new module_bl;
		}
	}
	function get_module_title() {
			return 'module';
	}
	function get_manager_title() {
			return 'module';
	}
	
	################################ module management ###############################		
	function _form_module() {
		if ($handle = opendir(APP_ROOT."flexycms/modules")) {
	    		while (false !== ($file = readdir($handle))) {
					if($file != "." && $file != ".." && $file != "user"){
						$arr[$file]=$file;
					}
	    		}
	    		closedir($handle);
		}
		if ($handle = opendir(APP_ROOT."templates/".$_SESSION['multi_language']."/common")) {
	    		while (false !== ($file = readdir($handle))) {
					if($file != "." && $file != ".." && $file != "user"){
						$arr_tpl[$file]=$file;
					}
	    		}
	    		closedir($handle);
		}
		$this->_output['file'] = $arr;
		$this->_output['templates'] =$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/common");
		$this->_output['tpl'] = 'admin/module/form_module';
	}
	function _chk_module(){
		if(file_exists(APP_ROOT."flexycms/modules/".$this->_input['module_name'])) {
			print  1;
		}else{
			print 0;
		}
	}
	function _create_module() {
		//print_r($_REQUEST);exit;
		if(file_exists(APP_ROOT."flexycms/modules/".$this->_input['module_name'])) {
			$_SESSION['raise_message']['global'] = "This module already exists";
			redirect('/module/form_module');
		}
		############ creating module_manager ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'];
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/".$this->_input['module_name']."_manager.php";
		$txt="manager.txt";
		$this->create($dir,$file,$txt);
		
		############ creating admin manager ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'].'/admin';
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/admin/".'admin_'.$this->_input['module_name'].".php";
		$txt="admin_manager.txt";
		$this->create($dir,$file,$txt);
		
		############ creating bl class ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'].'/business';
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/business/".$this->_input['module_name']."_bl.class.php";
		$txt="blclass.txt";
		$this->create($dir,$file,$txt);

		############creating data class ##########################
		$file=APP_ROOT."flexycms/classes/data/".$this->_input['module_name'].".php";
		$txt="data.txt";
		$this->create('',$file,$txt);
		
		################## creating templates###################
		
		$dir=APP_ROOT."templates/".$_SESSION['multi_language']."/".$this->_input['module_name'];
		$file=APP_ROOT."templates/".$_SESSION['multi_language']."/".$this->_input['module_name']."/home.tpl.html";
		$txt="home.txt";
		$this->create($dir,$file,$txt,'tpl');
		
		$dir=APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$this->_input['module_name'];
		$file=APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$this->_input['module_name']."/home.tpl.html";
		$txt="home.txt";
		$this->create($dir,$file,$txt,'tpl');
		
		$_SESSION['raise_message']['global'] = $this->_input['module_name']." Module is created";
		redirect('/module/form_module');
	}
	
	function create($dirpath,$filepath,$txt,$type='') {
		if($dirpath) {
			@mkdir($dirpath);
		}	
		$fp=@fopen($filepath,'w');
		$data=file_get_contents(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/module/module_txt/".$txt);
		$fdata=str_replace('[module]',$this->_input['module_name'],$data);
		
		if(!$type) {
			$fdata="<?\n".$fdata."\n?>";
		}
		fwrite($fp,$fdata);
		fclose($fp);
	}
	
	
	function _get_directory_files($flpath) { //full path
		$dh = @opendir($flpath);
		while($file = @readdir($dh) ){
			$ext_file = explode('.',$file);
			if($file != "." && $file != ".." && $ext_file[count($ext_file)-1] != 'LCK'){
				if(is_dir($flpath.'/'.$file))
					continue;
				$dir_files[]=$file;
			}	
		}
		return $dir_files;
	}
	function _details(){
		$data=$this->_input;
		if($data['type']=="admin"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/admin/".$data['fname'];
		}elseif($data['type']=="bl"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/business/".$data['fname'];
		}elseif($data['type']=="mgr"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/".$data['fname'];
		}elseif($data['type']=="data"){
			$file=APP_ROOT."flexycms/classes/data/".$data['fname'];
		}elseif($data['type']=="tpl"){
			$file=APP_ROOT."templates/".$_SESSION['multi_language']."/".$data['fname'];
		}
		if(@fopen($file,'r') && !is_dir($file)){
			$this->_output['file_content']=htmlspecialchars(file_get_contents($file));
		}else{
			$this->_output['fmsg']="File does not exist";
		}
		$this->_output['file']=$file;
		$this->_output['mod_name']=$data['mod_name'];
		$this->_output['tpl']='admin/module/edit_detail';
	}
	function _update_files(){
		$contents=stripslashes($this->_input['efile']);
		$fp=fopen($this->_input['fpath'],'w');
		fwrite($fp,$contents);
		fclose($fp);
		//$this->_output['tpl']='admin/edit_detail';
	}
	function _delete(){
		$mod_name=$this->_input['mname'];
		$this->_delete_dir(APP_ROOT."flexycms/modules/".$mod_name);
		@unlink(APP_ROOT."flexycms/classes/data/".$mod_name.".php");
		$this->_delete_dir(APP_ROOT."templates/".$_SESSION['multi_language']."/".$mod_name);
		$this->_delete_dir(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$mod_name);
		$_SESSION['raise_message']['global'] = "$mod_name module is deleted";
		redirect('module/form_module');
	}
	function _delete_dir($path) {
		$files = glob("$path/*");
		foreach($files as $file) {
			if(is_dir($file) && !is_link($file)) {
				$this->_delete_dir($file);
			}else {
				@unlink($file);
			}
		}
		@rmdir($path);
	}
/*	
	function _add_template(){
		$this->_output=$this->_input;
		$this->_output['tpl']='admin/module/add_templates';
	}
	
	function _create_templates(){
		if($this->_input['type']=='admin'){
			if(file_exists(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html")){
				$_SESSION['raise_message']['global'] = "A template having same name already exists";
			}else{
				$fp=fopen(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html",'w');
				fwrite($fp,$this->_input['efile']);
				fclose($fp);
			}
		}else{
			if(file_exists(APP_ROOT."templates/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html")){
				$_SESSION['raise_message']['global'] = "A template having same name already exists";
			}else{
				$fp=fopen(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html",'w');
				fwrite($fp,$this->_input['efile']);
				fclose($fp);
			}
		}
		redirect('/index.php/page-user-choice-form_module');
	}*/
	
	function _traverse_hierarchy($path)
	{
		$return_array = array();
		$dir = @opendir($path);
		if($dir){
			while(($file = @readdir($dir)) !== false)
			{
				if($file[0] == '.') continue;
				$fullpath = $path . '/' . $file;
				if(is_dir($fullpath))
					$return_array = array_merge($return_array, $this->_traverse_hierarchy($fullpath));
				else {
					$ext_file = explode('.',$file);
					if($ext_file[count($ext_file)-1] != 'LCK'){
						$art=explode('templates/'.$_SESSION['multi_language'].'/',$fullpath);
						$ar=explode('/',$art[1]);
						//$return_array[$art[1]] =$ar[count($ar)-1] ;
						$return_array[] =$art[1] ;
					}
				}
			}
		}
		return $return_array;
	}
	
	
	function _getfiles(){
		$mod_name=$this->_input['mod_name'];
		$files['admin']="admin_".$mod_name.".php";
		$files['bl']=$mod_name."_bl.class.php";
		$files['mgr']=$mod_name."_manager.php";
		$files['data']=$mod_name.".php";
		$templates['admin']=$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$mod_name);
		$templates['genral']=$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/".$mod_name);
		$this->_output['files']=$files;
		$this->_output['templates']=$templates;
		//$this->_output['templates']=$templates;
		$this->_output['mod_name']=$mod_name;
		$this->_output['tpl']='admin/module/files';
	}
	


	
//Added By Parwesh And Tanmaya For Import Module Functionality


	#################################################
	################ IMPORTING MODULES ##############
	#################################################
	function _importmodule(){
		$folder = $_FILES;
		$foldername = $folder['imp_file']['name']?$folder['imp_file']['name']:'';
		$path = $this->_input['imp_path']?$this->_input['imp_path']:'';
		
		//Check For Import Module Exist Or Not 
		if($this->check_module_exist($foldername,$path)){
			$_SESSION['raise_message']['global'] = "This module is already exist in this project folder.";
			redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
		}
		
		if($foldername !='' || $path!=''){
			$dir = $foldername?str_replace('.zip','',$foldername,$c):str_replace('.zip','',substr(strrchr($path,'/'),1),$c);
			$dest = APP_ROOT;
			$out = $dest.'abcd'.$dir.'/';
			if($c>0){
				$pathtosave = $dest.$dir.'.zip';
				if($foldername){
					@copy($folder['imp_file']['tmp_name'],$pathtosave);	
				}else{					
					$fp = fopen ($pathtosave, 'w+');
					$ch = curl_init($path);
					curl_setopt($ch, CURLOPT_TIMEOUT, 50);
					curl_setopt($ch, CURLOPT_FILE, $fp);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_exec($ch);
					curl_close($ch);
					fclose($fp);
				}								
				passthru("unzip -ou $pathtosave -d $dest");
				
				@rename($dest.$dir,$dest.'abcd'.$dir);
				$con = @rename($dest.'abcd'.$dir.'/'.$dir,$dest.'abcd'.$dir.'/modulecontent');
				unlink($pathtosave);
			}else{
				$_SESSION['raise_message']['global'] = "Please provide only zip file";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
			}
			if(is_dir($out) && scandir($out)){
				$this->copy_directory($out,$dir);
				$this->Removedirectory($out);				
				$_SESSION['raise_message']['global'] = "$dir module integrated successfully.";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module');				
			}else{				
				$_SESSION['raise_message']['global'] = "System does not find module,upload with absolute path.";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
			}
		}else {
			$_SESSION['raise_message']['global'] = "Please give value to one of these fields";
			redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
		}
	}
	#################################################
	########## Check For Module Already Exist #######
	#################################################
	function check_module_exist($fname='',$path=''){
		$zfile = $fname ? substr($fname,0,-4):substr(substr(strrchr($path,'/'),1),0,-4);
		if(file_exists(APP_ROOT."flexycms/modules/".$zfile)) {
			return 1;
		}else{
			return 0;
		}
	}
	#################################################
	########## Creating dir,subdir,files ############
	#################################################
    function copy_directory($abspath,$root,$filters=array()){
		$dir=array_diff(scandir($abspath),array_merge(array(".",".."),$filters));
		foreach($dir as $d){
			//If block only creates folders and subfolders of module whereas else block copy files to respective folders and subfolders.
			if(is_dir($abspath.$d)){
				//Create Folder For Manager Class
				$module_fol = strstr($abspath.$d,'/modulecontent');
				if($module_fol != ''){
					$module_dir_path = APP_ROOT.'flexycms/modules'.str_replace('modulecontent',$root,$module_fol,$c).'/';
					@mkdir($module_dir_path, 0755);
				}
				
				//Create Folder For Templates
				$tmp_fol = strstr($abspath.$d,"/templates");
				if($tmp_fol != ''){					
					$tmp_dir_path = APP_ROOT.'templates/default'.str_replace('/templates','',$tmp_fol).'/';
					@mkdir($tmp_dir_path, 0755);
				}				
				$this->copy_directory($abspath.$d.'/',$root,$filters);
			}else{
				//Copy File Of Data Class	
				$data_class = strstr($abspath.$d,"data");
				if($data_class != ''){
					$data_dir =  APP_ROOT.'flexycms/classes/'.$data_class;
					@copy($abspath.$d,$data_dir);
				}
				
				//Copy File Of Module Class
				$module_class_file = strstr($abspath.$d,'modulecontent');
				if($module_class_file !=''){
					$module_class_dir = APP_ROOT.'flexycms/modules/'.str_replace('modulecontent',$root,$module_class_file,$c);
					@copy($abspath.$d,$module_class_dir);
				}
				
				//Copy Files Of Templates Class 				
				$tmp_class = strstr($abspath.$d,"/templates/");
				if($tmp_class != ''){					
					$tmp_dir_path = APP_ROOT.'templates/default'.str_replace('/templates','',$tmp_class);
					@copy($abspath.$d,$tmp_dir_path);
				}
				
				//Copy File Of Common Class If Exist Like paypal module paypal_class_ipn.php class
				$common_file = strstr($abspath.$d,"/common");
				if($common_file != ''){
					$common_dir_path = APP_ROOT.'flexycms/classes'.$common_file;
					@copy($abspath.$d,$common_dir_path);
				}
				
				//Run .sql file
				if(strstr($abspath.$d,".sql")!=''){					
					$this->sql_dump($abspath.$d);
				}
			}
		}
    }    
	#################################################
	################ DUMPING SQL FILES ##############
	#################################################
	function sql_dump($fname){
		$handle = @fopen($fname, "r");
		if ($handle) {
			$buffer='';
			while (!feof($handle)) {
				$str = fgets($handle, 4096);       
				if(!(substr($str,0,2) == '--'))
					$buffer.= $str;       
			}
			$buffer = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $buffer);
			$buffer = str_replace("flexy__",TABLE_PREFIX,$buffer);
		}
		fclose($handle);
		$sql = explode(";",$buffer);
		foreach($sql as $k => $v)
			mysql_query($v);
	}
	
    #################################################
	########## REMOVING DIRECTORY AND FILES #########
	#################################################
	function Removedirectory($dir){
		if (is_dir($dir)){
			$objects = scandir($dir);
			foreach ($objects as $object){
				if ($object != "." && $object != ".."){
					if (filetype($dir."/".$object) == "dir") 
						$this->Removedirectory($dir."/".$object); 
					else 
						unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
 	} 
//End Of Import Module Functionality
}
=======
<?php
class admin_module extends module_manager {
	function admin_manager(& $smarty, & $_output, & $_input) {
		if($_SESSION['id_admin']){
			$this->module_manager($smarty, $_output, $_input, 'module');
			$this->obj_module = new module;
			$this->module_bl = new module_bl;
		}
	}
	function get_module_title() {
			return 'module';
	}
	function get_manager_title() {
			return 'module';
	}
	
	################################ module management ###############################		
	function _form_module() {
		if ($handle = opendir(APP_ROOT."flexycms/modules")) {
	    		while (false !== ($file = readdir($handle))) {
					if($file != "." && $file != ".." && $file != "user"){
						$arr[$file]=$file;
					}
	    		}
	    		closedir($handle);
		}
		if ($handle = opendir(APP_ROOT."templates/".$_SESSION['multi_language']."/common")) {
	    		while (false !== ($file = readdir($handle))) {
					if($file != "." && $file != ".." && $file != "user"){
						$arr_tpl[$file]=$file;
					}
	    		}
	    		closedir($handle);
		}
		$this->_output['file'] = $arr;
		$this->_output['templates'] =$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/common");
		$this->_output['tpl'] = 'admin/module/form_module';
	}
	function _chk_module(){
		if(file_exists(APP_ROOT."flexycms/modules/".$this->_input['module_name'])) {
			print  1;
		}else{
			print 0;
		}
	}
	function _create_module() {
		//print_r($_REQUEST);exit;
		if(file_exists(APP_ROOT."flexycms/modules/".$this->_input['module_name'])) {
			$_SESSION['raise_message']['global'] = "This module already exists";
			redirect('/module/form_module');
		}
		############ creating module_manager ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'];
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/".$this->_input['module_name']."_manager.php";
		$txt="manager.txt";
		$this->create($dir,$file,$txt);
		
		############ creating admin manager ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'].'/admin';
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/admin/".'admin_'.$this->_input['module_name'].".php";
		$txt="admin_manager.txt";
		$this->create($dir,$file,$txt);
		
		############ creating bl class ##########################
		$dir=APP_ROOT."flexycms/modules/".$this->_input['module_name'].'/business';
		$file=APP_ROOT."flexycms/modules/".$this->_input['module_name']."/business/".$this->_input['module_name']."_bl.class.php";
		$txt="blclass.txt";
		$this->create($dir,$file,$txt);

		############creating data class ##########################
		$file=APP_ROOT."flexycms/classes/data/".$this->_input['module_name'].".php";
		$txt="data.txt";
		$this->create('',$file,$txt);
		
		################## creating templates###################
		
		$dir=APP_ROOT."templates/".$_SESSION['multi_language']."/".$this->_input['module_name'];
		$file=APP_ROOT."templates/".$_SESSION['multi_language']."/".$this->_input['module_name']."/home.tpl.html";
		$txt="home.txt";
		$this->create($dir,$file,$txt,'tpl');
		
		$dir=APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$this->_input['module_name'];
		$file=APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$this->_input['module_name']."/home.tpl.html";
		$txt="home.txt";
		$this->create($dir,$file,$txt,'tpl');
		
		$_SESSION['raise_message']['global'] = $this->_input['module_name']." Module is created";
		redirect('/module/form_module');
	}
	
	function create($dirpath,$filepath,$txt,$type='') {
		if($dirpath) {
			@mkdir($dirpath);
		}	
		$fp=@fopen($filepath,'w');
		$data=file_get_contents(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/module/module_txt/".$txt);
		$fdata=str_replace('[module]',$this->_input['module_name'],$data);
		
		if(!$type) {
			$fdata="<?\n".$fdata."\n?>";
		}
		fwrite($fp,$fdata);
		fclose($fp);
	}
	
	
	function _get_directory_files($flpath) { //full path
		$dh = @opendir($flpath);
		while($file = @readdir($dh) ){
			$ext_file = explode('.',$file);
			if($file != "." && $file != ".." && $ext_file[count($ext_file)-1] != 'LCK'){
				if(is_dir($flpath.'/'.$file))
					continue;
				$dir_files[]=$file;
			}	
		}
		return $dir_files;
	}
	function _details(){
		$data=$this->_input;
		if($data['type']=="admin"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/admin/".$data['fname'];
		}elseif($data['type']=="bl"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/business/".$data['fname'];
		}elseif($data['type']=="mgr"){
			$file=APP_ROOT."flexycms/modules/".$data['mod_name']."/".$data['fname'];
		}elseif($data['type']=="data"){
			$file=APP_ROOT."flexycms/classes/data/".$data['fname'];
		}elseif($data['type']=="tpl"){
			$file=APP_ROOT."templates/".$_SESSION['multi_language']."/".$data['fname'];
		}
		if(@fopen($file,'r') && !is_dir($file)){
			$this->_output['file_content']=htmlspecialchars(file_get_contents($file));
		}else{
			$this->_output['fmsg']="File does not exist";
		}
		$this->_output['file']=$file;
		$this->_output['mod_name']=$data['mod_name'];
		$this->_output['tpl']='admin/module/edit_detail';
	}
	function _update_files(){
		$contents=stripslashes($this->_input['efile']);
		$fp=fopen($this->_input['fpath'],'w');
		fwrite($fp,$contents);
		fclose($fp);
		//$this->_output['tpl']='admin/edit_detail';
	}
	function _delete(){
		$mod_name=$this->_input['mname'];
		$this->_delete_dir(APP_ROOT."flexycms/modules/".$mod_name);
		@unlink(APP_ROOT."flexycms/classes/data/".$mod_name.".php");
		$this->_delete_dir(APP_ROOT."templates/".$_SESSION['multi_language']."/".$mod_name);
		$this->_delete_dir(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$mod_name);
		$_SESSION['raise_message']['global'] = "$mod_name module is deleted";
		redirect('module/form_module');
	}
	function _delete_dir($path) {
		$files = glob("$path/*");
		foreach($files as $file) {
			if(is_dir($file) && !is_link($file)) {
				$this->_delete_dir($file);
			}else {
				@unlink($file);
			}
		}
		@rmdir($path);
	}
/*	
	function _add_template(){
		$this->_output=$this->_input;
		$this->_output['tpl']='admin/module/add_templates';
	}
	
	function _create_templates(){
		if($this->_input['type']=='admin'){
			if(file_exists(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html")){
				$_SESSION['raise_message']['global'] = "A template having same name already exists";
			}else{
				$fp=fopen(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html",'w');
				fwrite($fp,$this->_input['efile']);
				fclose($fp);
			}
		}else{
			if(file_exists(APP_ROOT."templates/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html")){
				$_SESSION['raise_message']['global'] = "A template having same name already exists";
			}else{
				$fp=fopen(APP_ROOT."templates/admin/".$this->_input['mod_name']."/".$this->_input['tpl_name'].".tpl.html",'w');
				fwrite($fp,$this->_input['efile']);
				fclose($fp);
			}
		}
		redirect('/index.php/page-user-choice-form_module');
	}*/
	
	function _traverse_hierarchy($path)
	{
		$return_array = array();
		$dir = @opendir($path);
		if($dir){
			while(($file = @readdir($dir)) !== false)
			{
				if($file[0] == '.') continue;
				$fullpath = $path . '/' . $file;
				if(is_dir($fullpath))
					$return_array = array_merge($return_array, $this->_traverse_hierarchy($fullpath));
				else {
					$ext_file = explode('.',$file);
					if($ext_file[count($ext_file)-1] != 'LCK'){
						$art=explode('templates/'.$_SESSION['multi_language'].'/',$fullpath);
						$ar=explode('/',$art[1]);
						//$return_array[$art[1]] =$ar[count($ar)-1] ;
						$return_array[] =$art[1] ;
					}
				}
			}
		}
		return $return_array;
	}
	
	
	function _getfiles(){
		$mod_name=$this->_input['mod_name'];
		$files['admin']="admin_".$mod_name.".php";
		$files['bl']=$mod_name."_bl.class.php";
		$files['mgr']=$mod_name."_manager.php";
		$files['data']=$mod_name.".php";
		$templates['admin']=$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/admin/".$mod_name);
		$templates['genral']=$this->_traverse_hierarchy(APP_ROOT."templates/".$_SESSION['multi_language']."/".$mod_name);
		$this->_output['files']=$files;
		$this->_output['templates']=$templates;
		//$this->_output['templates']=$templates;
		$this->_output['mod_name']=$mod_name;
		$this->_output['tpl']='admin/module/files';
	}
	


	
//Added By Parwesh And Tanmaya For Import Module Functionality


	#################################################
	################ IMPORTING MODULES ##############
	#################################################
	function _importmodule(){
		$folder = $_FILES;
		$foldername = $folder['imp_file']['name']?$folder['imp_file']['name']:'';
		$path = $this->_input['imp_path']?$this->_input['imp_path']:'';
		
		//Check For Import Module Exist Or Not 
		if($this->check_module_exist($foldername,$path)){
			$_SESSION['raise_message']['global'] = "This module is already exist in this project folder.";
			redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
		}
		
		if($foldername !='' || $path!=''){
			$dir = $foldername?str_replace('.zip','',$foldername,$c):str_replace('.zip','',substr(strrchr($path,'/'),1),$c);
			$dest = APP_ROOT;
			$out = $dest.'abcd'.$dir.'/';
			if($c>0){
				$pathtosave = $dest.$dir.'.zip';
				if($foldername){
					@copy($folder['imp_file']['tmp_name'],$pathtosave);	
				}else{					
					$fp = fopen ($pathtosave, 'w+');
					$ch = curl_init($path);
					curl_setopt($ch, CURLOPT_TIMEOUT, 50);
					curl_setopt($ch, CURLOPT_FILE, $fp);
					curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
					curl_exec($ch);
					curl_close($ch);
					fclose($fp);
				}								
				passthru("unzip -ou $pathtosave -d $dest");
				
				@rename($dest.$dir,$dest.'abcd'.$dir);
				$con = @rename($dest.'abcd'.$dir.'/'.$dir,$dest.'abcd'.$dir.'/modulecontent');
				unlink($pathtosave);
			}else{
				$_SESSION['raise_message']['global'] = "Please provide only zip file";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
			}
			if(is_dir($out) && scandir($out)){
				$this->copy_directory($out,$dir);
				$this->Removedirectory($out);				
				$_SESSION['raise_message']['global'] = "$dir module integrated successfully.";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module');				
			}else{				
				$_SESSION['raise_message']['global'] = "System does not find module,upload with absolute path.";
				redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
			}
		}else {
			$_SESSION['raise_message']['global'] = "Please give value to one of these fields";
			redirect(LBL_ADMIN_SITE_URL.'index.php/module/form_module/status-imp');
		}
	}
	#################################################
	########## Check For Module Already Exist #######
	#################################################
	function check_module_exist($fname='',$path=''){
		$zfile = $fname ? substr($fname,0,-4):substr(substr(strrchr($path,'/'),1),0,-4);
		if(file_exists(APP_ROOT."flexycms/modules/".$zfile)) {
			return 1;
		}else{
			return 0;
		}
	}
	#################################################
	########## Creating dir,subdir,files ############
	#################################################
    function copy_directory($abspath,$root,$filters=array()){
		$dir=array_diff(scandir($abspath),array_merge(array(".",".."),$filters));
		foreach($dir as $d){
			//If block only creates folders and subfolders of module whereas else block copy files to respective folders and subfolders.
			if(is_dir($abspath.$d)){
				//Create Folder For Manager Class
				$module_fol = strstr($abspath.$d,'/modulecontent');
				if($module_fol != ''){
					$module_dir_path = APP_ROOT.'flexycms/modules'.str_replace('modulecontent',$root,$module_fol,$c).'/';
					@mkdir($module_dir_path, 0755);
				}
				
				//Create Folder For Templates
				$tmp_fol = strstr($abspath.$d,"/templates");
				if($tmp_fol != ''){					
					$tmp_dir_path = APP_ROOT.'templates/default'.str_replace('/templates','',$tmp_fol).'/';
					@mkdir($tmp_dir_path, 0755);
				}				
				$this->copy_directory($abspath.$d.'/',$root,$filters);
			}else{
				//Copy File Of Data Class	
				$data_class = strstr($abspath.$d,"data");
				if($data_class != ''){
					$data_dir =  APP_ROOT.'flexycms/classes/'.$data_class;
					@copy($abspath.$d,$data_dir);
				}
				
				//Copy File Of Module Class
				$module_class_file = strstr($abspath.$d,'modulecontent');
				if($module_class_file !=''){
					$module_class_dir = APP_ROOT.'flexycms/modules/'.str_replace('modulecontent',$root,$module_class_file,$c);
					@copy($abspath.$d,$module_class_dir);
				}
				
				//Copy Files Of Templates Class 				
				$tmp_class = strstr($abspath.$d,"/templates/");
				if($tmp_class != ''){					
					$tmp_dir_path = APP_ROOT.'templates/default'.str_replace('/templates','',$tmp_class);
					@copy($abspath.$d,$tmp_dir_path);
				}
				
				//Copy File Of Common Class If Exist Like paypal module paypal_class_ipn.php class
				$common_file = strstr($abspath.$d,"/common");
				if($common_file != ''){
					$common_dir_path = APP_ROOT.'flexycms/classes'.$common_file;
					@copy($abspath.$d,$common_dir_path);
				}
				
				//Run .sql file
				if(strstr($abspath.$d,".sql")!=''){					
					$this->sql_dump($abspath.$d);
				}
			}
		}
    }    
	#################################################
	################ DUMPING SQL FILES ##############
	#################################################
	function sql_dump($fname){
		$handle = @fopen($fname, "r");
		if ($handle) {
			$buffer='';
			while (!feof($handle)) {
				$str = fgets($handle, 4096);       
				if(!(substr($str,0,2) == '--'))
					$buffer.= $str;       
			}
			$buffer = preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $buffer);
			$buffer = str_replace("flexy__",TABLE_PREFIX,$buffer);
		}
		fclose($handle);
		$sql = explode(";",$buffer);
		foreach($sql as $k => $v)
			mysql_query($v);
	}
	
    #################################################
	########## REMOVING DIRECTORY AND FILES #########
	#################################################
	function Removedirectory($dir){
		if (is_dir($dir)){
			$objects = scandir($dir);
			foreach ($objects as $object){
				if ($object != "." && $object != ".."){
					if (filetype($dir."/".$object) == "dir") 
						$this->Removedirectory($dir."/".$object); 
					else 
						unlink($dir."/".$object);
				}
			}
			reset($objects);
			rmdir($dir);
		}
 	} 
//End Of Import Module Functionality
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
