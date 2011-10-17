<?php
// Added By Parwesh
//include_once(AFIXI_CORE."common.php");
include_once (AFIXI_CORE."common5.php");
class business{
function setupresults($results_params){
	$sort_order=common::set_sort_pref($results_params['MODULE'].$_REQUEST['choice'],$results_params['DEF_FIELD'],$results_params['type']);
	$this->next_prev = new NextPrevious(APP_ROOT_URL.$results_params['URI'],$results_params['SQL'],$results_params['MODULE'].$_REQUEST['choice']);
	if (isset($results_params['show'])) {
		$this->next_prev->show = $results_params['show'];
	}
	if (isset($results_params['limit'])) {
		$this->next_prev->dcount = $results_params['limit'];
	}
	if (isset($results_params['linktag'])) {
		$this->next_prev->linktag = $results_params['linktag'];
	}
	if (isset($_REQUEST["page_norec"])) {
		$this->next_prev->dcount = $_REQUEST["page_norec"];
//		$_SESSION[$results_params['sess_id']] = $this->next_prev->dcount;
	}
//	if (isset($_SESSION[$results_params['sess_id']])) {
//		$_REQUEST["page_norec"] = $this->next_prev->dcount = $_SESSION[$results_params['sess_id']];
//	}
	if (isset($_REQUEST["page_goto"])) {
		$this->next_prev->start =  ($_REQUEST["page_goto"]-1)*$this->next_prev->dcount;
	}
	if($results_params['AJAX_FUNC']){
		$this->next_prev->ajax_next_prev=$results_params['AJAX_FUNC'];
		$this->next_prev->ajax_func = $results_params['AJAX_FUNC'];
		$this->ajax_func = $results_params['AJAX_FUNC'];
	}
	$this->results_under = $results_params['RESULTS_UNDER'];
	$this->cache_prepend = $results_params['CACHE_PREPEND'];
	$this->debug = $results_params['DEBUG'];
}

function page_listing(&$parent, $tpl='default/list'){
	$m = $parent->get_module_name();
	$sb = $parent->_output['sort_by'] ? $parent->_output['sort_by'] : key($parent->_output['field']);
	//print "<pre>";
	//print $sb;exit;
	$so = $parent->_output['sort_order'] ? $parent->_output['sort_order'] : 'ASC';
	$results_params = Array ('URI'=>$parent->_output['uri'], 'SQL'=>$parent->_output['sql'], 'MODULE' => $m, 'TPL' => $tpl, 'CACHE_PREPEND' => 'sef|message|list|', 'RESULTS_UNDER' => 'list', 'DEBUG' => 1, 'type' => $so, 'DEF_FIELD'=>$sb, "sess_id"=>"user_paginate_test");
	if (isset($parent->_output['ajax'])) {
		$results_params["AJAX_FUNC"] =APP_ROOT_URL.$parent->_output['uri'];
	}
	if (isset($parent->_output['limit'])) {
		$results_params["limit"] = $parent->_output['limit'];
	}
	if (isset($parent->_output['type']) && $parent->_output['type']=='no') {
		$results_params["limit"] = 999999;
	}
	if (isset($parent->_output['show'])) {
		$results_params["show"] = $parent->_output['show'];
	}
	if (isset($parent->_output['linktag'])) {
		$results_params["linktag"] = $parent->_output['linktag'];
	}
	$this->setupresults($results_params);
	$parent->_output['tpl']=$tpl;
	if (!$parent->cache_alive()) {
		$mbl = $m."_bl";
		$parent->_output=array_merge($parent->_output,$parent->$mbl->get_output());
	}
}

function createform(&$parent) {
	$parent->_output['tpl']=$tpl='default/form';
}

function get_cache_id(){
	return $this->cache_prepend.$this->next_prev->get_cacheid();
}

function get_output(){
	global $stats;
	$return_out = Array();
	$return_out[$this->results_under] = $this->next_prev->getlimitrows();
	$return_out['next_prev'] = $this->next_prev;
	$return_out['stats'] = $stats;
	$return_out['debug'] = $this->debug;
	$return_out['ajax_func'] = $this->ajax_func  ;
	return $return_out;
}

	function gettype(){
		$sql = "SELECT id_type,v_type_name FROM ".TABLE_PREFIX."type";
		$rs  = getrows($sql,$err);
		foreach($rs as $k => $v){
			$type[$v[id_type]]= $v[v_type_name];
		}
		return $type;
	}

	function gettags(){
		static $tags;
		if($tags) return $tags;
		$sql = "SELECT id_tags,v_tag_name FROM ".TABLE_PREFIX."tags";
		$rs  = getrows($sql,$err);
		foreach($rs as $k => $v){
				$tags[$v['id_tags']]= $v[v_tag_name];
			}
			return $tags;
		}


	function copy_to_media($cur_src_dir,$source_file,$remove_file=''){
		/*$servers_info  = $GLOBALS['conf']['SYNC_MEDIA'];
		if(!$servers_info) return TRUE;
		$content_root = $GLOBALS['conf']['SITE_IMAGES_ROOT_PATH'];
		//echo " The src dir is $cur_src_dir This is the Content root is  $content_root <BR>";
		$destination_file =str_replace($content_root,'',$source_file );
		if($remove_file)
			$remove_file = str_replace($content_root,'',$remove_file );
		$content_root = str_replace($content_root,'',$cur_src_dir );
		//echo " the new content root is $content_root <BR>";
		foreach ($servers_info as $temp ){
		list($cur_server['address'],$cur_server['uname'],$cur_server['pass'],$cur_server['content_root'],$cur_server['site_root']) = split('###',$temp);
				$err = " Transfering file to media server $cur_server[address] ";
				//echo " Connecting to $cur_server[address] <BR> ";
				$conn_id = @ftp_connect($cur_server['address']);
				if(!$conn_id){
					$err.= "Could not connect to $cur_server[address] ";
					return FALSE;
				}
				$login_result = @ftp_login($conn_id, $cur_server['uname'],$cur_server['pass']);
				//echo " Logging with $cur_server[uname]  and $cur_server[pass]  <BR> ";
				if (!$login_result) {
					$err.= "Could not login to $cur_server[address] using username $cur_server[uname]";
					return FALSE;
				}
				if($remove_file){
					//echo " Going to remove file $remove_file at ".$cur_server['site_root'] ."  <BR> ";
					@ftp_delete($conn_id,$cur_server['site_root'].$remove_file);
				}
				if($source_file){
					//echo " Going to copy  file $source_file to $destination_file at ".$cur_server['site_root']."<BR> ";
					$upload = ftp_put($conn_id, $cur_server['site_root'].$destination_file, $source_file, FTP_BINARY);
					//echo $cur_server['site_root'].$destination_file."$upload hahahah ";
				}
			    // check upload status
				if (!$upload) {
					//echo " Could not copy $source_file to ".$cur_server['site_root'].$destination_file." <HR>	";
					$err.= " Could not copy $source_file to  $destination_file ";
					return FALSE;
				}
				ftp_close($conn_id);
		}
			return TRUE;		*/
	}

	function get_mapping_info_cats(){

// GETTING THE MAPPING INFO
	$js_info['id_type'] = get_rows_as_assoc("SELECT id_type, v_type_name FROM "
											.TABLE_PREFIX."type", 'id_type', 'v_type_name',$err);
	$sql = 'SELECT id_section,v_section_name,id_category,v_cat_name,id_type
		    FROM '.TABLE_PREFIX.'section';
	//echo $sql;
	$rs=getrows($sql,$err);
	//Mapping the category and section
	foreach ($rs as $cur )
	{
		$js_info['id_category'][$cur['id_category']] = $cur['v_cat_name'];
		$js_info['id_section'][$cur['id_section']] = $cur['v_section_name'];
		$js_map_info['id_category'][$cur['id_category']][] =$cur['id_section'];
		$js_map_info['id_section'][$cur['id_section']][] = $cur['id_type'];

	}

	foreach ($js_map_info['id_section'] as $k=>$v ){
	     $v1=array_unique($v);
		$js_map_info['id_section'][$k]  = join(',',$v1);
	}
	foreach ($js_map_info['id_category'] as $k=>$v ){
	     $v =array_unique($v);
		$js_map_info['id_category'][$k]  = join(',',$v);
	}


	return  array('info'=> $js_info , 'mapinfo'=>$js_map_info);

}

function get_tag_names($tags,$csv){
	$list = split(",",$csv);
	foreach ($list as $k ){
		$ret .= ($tags[$k].'&nbsp;');
	}
	return $ret;

}

function get_bit_values($choices, $total_value){
	foreach ($choices as $k=>$v ){
		if($total_value & $k){
			//echo " Checking $total_value with $k <BR>";
			$ret[$k]  = $v;
		}
	}
	$ret = $ret ? $ret : array();
//print_r($choices);print_r($ret);exit;
	return $ret;
}

function get_roles_arr($choices, $total_value){
	$total_value = str_pad(decbin($total_value),20,'0',STR_PAD_LEFT);
	foreach ($choices as $k=>$v ){
		//echo " Checking $total_value with $k <BR>";
		$curk = str_pad(decbin($k),20,'0',STR_PAD_LEFT);
		if(($total_value | $curk) == $total_value){
			$ret[$k]  = $v;
			//echo " MATCHED !!! $total_value With $curk <BR>";
		}
	}
	$ret = $ret ? $ret : array();
	return $ret;
}


function delete_media($file_name,$type=''){
	$servers_info  = $GLOBALS['conf']['SYNC_MEDIA'];
	if(is_array($servers_info)){
		foreach ($servers_info as $temp ){
			list($cur_server['address'],$cur_server['uname'],$cur_server['pass'],$cur_server['content_root']) = split('###',$temp);
			$err = " Transfering file to media server $cur_server[address] ";
			$conn_id = @ftp_connect($cur_server['address']);
			if(!$conn_id){
				$err.= "Could not connect to $cur_server[address] ";
				return $err;
			}
			$login_result = @ftp_login($conn_id, $cur_server['uname'],$cur_server['pass']);
			if (!$login_result) {
				$err.= "Could not login to $cur_server[address] using username $cur_server[uname]";
				return $err;
			}
			// uploading original content file
			$cur_src_dir = '';
			if($type == 'orig'){
				$cur_src_dir = 'orig/';
			}elseif($type == 'thumb'){	// uploading thumbnail
				$cur_src_dir = 'thumbnails/';
			}
			$file = basename($file_name);
			$destination_file = $cur_server['content_root'].$cur_src_dir.$file;
			@ftp_delete($conn_id,$destination_file);
			ftp_close($conn_id);
		}
	}
	return TRUE;
}
function sync_media($file_name,$type=''){

	$servers_info  = $GLOBALS['conf']['SYNC_MEDIA'];
	if(is_array($servers_info)){
		foreach ($servers_info as $temp ){
			list($cur_server['address'],$cur_server['uname'],$cur_server['pass'],$cur_server['content_root']) = split('###',$temp);
			$err = " Transfering file to media server $cur_server[address] ";
			$conn_id = @ftp_connect($cur_server['address']);
			if(!$conn_id){
				$err.= "Could not connect to $cur_server[address] ";
				return $err;
			}
			$login_result = @ftp_login($conn_id, $cur_server['uname'],$cur_server['pass']);
			if (!$login_result) {
				$err.= "Could not login to $cur_server[address] using username $cur_server[uname]";
				return $err;
			}
			// uploading original content file
			$cur_src_dir = '';
			if($type == 'orig'){
				$cur_src_dir = 'orig/';
			}elseif($type == 'thumb'){	// uploading thumbnail
				$cur_src_dir = 'thumbnails/';
			}
			$source_file = $file_name;//$orig_dir.$file_name;
			$file = basename($file_name);
			$destination_file = $cur_server['content_root'].$cur_src_dir.$file;
			if(file_exists ($source_file)){
				$upload = ftp_put($conn_id, $destination_file, $source_file, FTP_BINARY);
				if (!$upload) {
					$err.= "Could not copy $source_file to  $destination_file ";
					return $err;
				}
			}else{
				$err = "Error uploading file to server. Source file doesn't exist";
				return $err;
			}
			ftp_close($conn_id);

		}
	}
	return TRUE;
}


function get_url_components($url){
	$url_in_process = $url;
	$proto_pattern = "/(http:\/\/)|(ftp:\/\/)/i";
	preg_match($proto_pattern,$url_in_process, $matches);
	$ret['proto'] = $matches[1];
	$url_in_process = str_replace($ret['proto'], "", $url);

	$host_pattern = "/(.*?)\//i";
	preg_match($host_pattern,$url_in_process , $matches);
	$ret['host'] = $matches[1];
	$url_in_process = str_replace($ret['host'].'/', "", $url_in_process);
	$ret['REQUEST_URI'] = $url_in_process;

	$qs_pattern = "/.*?\?(.*)/i";
	preg_match($qs_pattern,$url_in_process , $matches);
	$ret['QUERY_STRING'] = $matches[1];
	$url_in_process = str_replace('?'.$ret['QUERY_STRING'], "", $url_in_process);
	$ret['SCRIPT_URL'] = $url_in_process;
	$ret['SCRIPT_URL_COMPS'] = explode("/",$url_in_process);
	array_pop($ret['SCRIPT_URL_COMPS']);
	return $ret;
}


function get_file_from_url($url,$target_file_name){
	$url = trim($url);
	$url = str_replace(' ','%20',$url);
	//echo " Trying to get file from $url <BR>";
	if(!$handle = @fopen($url,"rb")){
		return FALSE;
	}
	//echo " Connected and reading $url <BR>";
	preg_match("/[^\.\/]+\.[^\.\/]+$/",$url,$matches);
	$fileName=$matches[0];//GETTING THE FILE NAME
	$contents = "";
	do {
		$data = fread($handle, 8192);
		if (strlen($data) == 0) break;
		$contents .= $data;
	}while (true);
	//echo " Collected file from $url .. Size is ".strlen($contents)."<BR>";

	$handle = fopen($target_file_name,"w+");
	//echo " Copying contents to  $target_file_name  <BR>";
	fwrite($handle , $contents, strlen($contents));
	$remote['name']['v_file_name'] = $fileName;
	$remote['tmp_name']['v_file_name'] = $target_file_name;
	$remote['size']['v_file_name'] = filesize($target_file_name);
	fclose($handle);
	return $remote;
}


	function cmp_numeric_basename($a,$b){
		if(is_array($a)){
			$aname = basename(current($a)) ;
			$bname = basename(current($b)) ;
		}else{
			$aname = $a ;
			$bname = $b ;
		}
		if( ((int)$aname == (int)$bname) && ( (int)$bname == 0 ) ){
			return $aname   > $bname ;
		}else{
			return (int) $aname   > (int) $bname ;
		}
	}

}