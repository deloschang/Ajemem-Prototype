<?php
class admin_cms extends cms_manager {
	function admin_manager(& $smarty, & $_output, & $_input) {
		if($_SESSION['id_admin']){
			$this->cms_manager($smarty, $_output, $_input, 'cms');
			$this->obj_cms = new cms;
			$this->cms_bl = new cms_bl;
		}
	}
	function get_module_title() {
			return 'cms';
	}
	function get_manager_title() {
			return 'cms';
	}
######################################################
######### _list() : ##################################
######################################################
	function _list(){
		$sql = "SELECT * FROM ".TABLE_PREFIX."content GROUP BY cmscode ORDER BY ctime DESC";
		$data = getrows($sql,$err);
		$this->_output['list'] = $data;
		$this->_output['check']=array('name'=>'Name','description'=>'Description');
		$this->_output['tpl'] = 'admin/cms/listing';
	}
######################################################
######### _add() : ##################################
######################################################
	function _add(){
		$this->_output['language']=$GLOBALS['conf']['LANGUAGE'];
		$this->_output['sel_lang']=isset($this->_input['language'])?$this->_input['language']:$this->_output['language']['English'];
		if(!$this->_input['chk']){
			$this->_output['tpl'] = 'admin/cms/add';
		}else{
			$this->_output['tpl'] = 'admin/cms/add_form';		
		}
	}
######################################################
######### _insert() : ##################################
######################################################
	function _insert(){
		ob_clean();
		//print_r($this->_input);//exit;
		if(!$this->_input['cms']['name']){
			$this->_input['cms']['name']=$this->_input['name'];
		}
		$this->_input['cms']['language']=trim($this->_input['cms']['language']);
		$this->_input['cms']['cmscode']=strtolower(str_replace('_','',convert_me($this->_input['cms']['name'])));
		$this->_input['cms']['description']=$this->_input['description'];
		$res = $this->check_content($this->_input['cms']['cmscode'],$this->_input['cms']['language']);	
		if($res) {
			$id = $this->obj_cms->insert($this->_input['cms']);
			print $id;exit;
		}else{
			$this->_input['cms']['cmscode'] = '';
			$this->_output['cms'] = $this->_input['cms'];
			$this->_output['language']=$GLOBALS['conf']['LANGUAGE'];
			$this->_output['sel_lang']=$this->_input['language'];
			$val=array_flip($this->_output['language']);
			$this->_output['message'] = "Content  title with ".$val[$this->_input['cms']['language']]." language  already exist";
			$this->_output['tpl'] = 'admin/cms/add';
		}
	}
######################################################
######### _edit() : ##################################
######################################################
	function _edit(){
		global $link;
		$cmscode = $this->_input['code'];
		$this->_output['language']=$GLOBALS['conf']['LANGUAGE'];
		$lang=isset($this->_input['language'])?$this->_input['language']:$this->_output['language']['English'];
		
		$cond=" AND trim(language)='".trim($lang)."'";
		$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE cmscode='".$cmscode."'";
		$contentsql =$sql.$cond." LIMIT 1";
		//$contentsql =$sql." LIMIT 1";
		$res=mysqli_fetch_assoc(mysqli_query($link,$contentsql));
		//code for tab
		$langres=getrows($sql,$err);
		$i=0;
		while($i<count($langres)){
			foreach($this->_output['language'] as $key=>$value){
				if(trim($langres[$i]['language'])==trim($value)){
					$flangres[$key]=$value;
				}else{
					continue;
				}
			}
			$i++;
		}
		$this->_output['langres']=$flangres;
		//end code for tab
		$this->_output['code']=$cmscode;
		$this->_output['sel_lang']=$lang;
		if($res){
			$this->_output['cms']=$res;
		}else{
			$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE cmscode='".$cmscode."' LIMIT 1";
			$res=getrows($sql,$err);
			$this->_output['cms']=$res[0];
		}
		if(!$this->_input['chk']){
			$this->_output['tpl'] = 'admin/cms/add';	
		}else{
			$this->_output['tpl'] = 'admin/cms/add_form';	
		}
	}
######################################################
######### _update() : ################################
######################################################
	function _update(){
		global $link;
		print_r($this->_input);
		$audit=$GLOBALS['conf']['AUDIT'];
		if($audit['status']){
			$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE id_content=".$this->_input['cms']['id_content']." LIMIT 1";
			//print $sql;exit;
			$old_res=mysqli_fetch_assoc(mysqli_query($link,$sql));
			$this->obj_cms->insert_archieve($old_res);
		}
		if(!$this->_input['cms']['name']){
			$this->_input['cms']['name']=$this->_input['name'];
		}
		$this->_input['cms']['description']=$this->_input['description'];
		$data = $this->_input['cms'];
		$data['cmscode']=strtolower(str_replace('_','',convert_me($data['name'])));
		$this->obj_cms->update($data);
		$_SESSION['language']=$data['language'];
		exit;
	}
######################################################
######### _delete() : ################################
######################################################
	function _delete(){
		global $link;
		$audit=$GLOBALS['conf']['AUDIT'];
		if($audit['status']){
			$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE cmscode='".$this->_input['code']."'";
			$sql=mysqli_query($link,$sql);
			while($old_res=mysqli_fetch_assoc($sql)){
				$this->obj_cms->insert_archieve($old_res);
			}
		}
		$this->obj_cms->delete($this->_input['code']);
		$_SESSION['raise_message']['global'] = "Content deleted successfully";
		redirect(LBL_ADMIN_SITE_URL.'index.php/cms/list');
	}
######################################################
######### check_content() : ##########################
######################################################
	function check_content($code,$lang,$id=''){
		global $link;
		$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE 
			  cmscode='".$code."' AND language='".$lang."'";
		if($id)
			$sql.= "AND id_content !=".$id;
		$res=mysqli_fetch_assoc(mysqli_query($link,$sql));
		if(!is_array($res))
			return 1;
		else
			return 0;
	}
######################################################
######### _search() : ##################################
######################################################
	function _search(){
		$item = trim($this->_input['searchq'],' ');
		$stype = $this->_input['stype'];
		$cond = 'WHERE';
		foreach($stype as $k=>$v){
			$cond .= " $v LIKE '%".$item."%' OR ";
		}
		$len = strlen($cond);
		$cond = substr($cond,0,$len-3);
		$sql = "SELECT * FROM ".TABLE_PREFIX."content  ".$cond." GROUP BY name ORDER BY ctime desc";
		$res = getrows($sql,$err);
		$this->_output['list'] = $res;
		$this->_output['search_item'] = $item;
		$this->_output['check']=array('name'=>'Name','description'=>'Description');
		$this->_output['sel']=$stype;
		$this->_output['tpl'] = 'admin/cms/listing';
	}
###################################################
######### GET PERMALINK FOR CONTENTS ##############
###################################################
	function _get_plink() {
		$title = isset($this->_input['tname'])?$this->_input['tname']:'';
		$final_title=strtolower(str_replace('_','',convert_me(trim($title))));
		print $final_title;
	}
###################################################
######### CHEECK FOR DUPLICATE ##############
###################################################
	function _check_duplicate() {
		global $link;
		$title = isset($this->_input['tname'])?$this->_input['tname']:'';
		$cmscode=strtolower(str_replace('_','',convert_me(trim($title))));
		$sql="SELECT * FROM ".TABLE_PREFIX."content WHERE 
		      cmscode='".$cmscode."'";
		$res=mysqli_fetch_assoc(mysqli_query($link,$sql));
		if($res)
			print 1;
		else
			print 0;
	}
##########################################
###########auto complete name ############
##########################################
	function _auto_name(){
	    global $link;
		$sql="SELECT DISTINCT name FROM ".TABLE_PREFIX."content";
		$sql.=" WHERE name LIKE '%".$this->_input['q']."%' ORDER BY name ASC";
		$res=mysqli_query($link,$sql);
		while($rec=mysqli_fetch_assoc($res)){
			$data[]=$rec['name'];
		}
		$this->_output['data']=isset($data)?$data:'';
		$this->_output['tpl']='admin/cms/auto_list';
	}
}
