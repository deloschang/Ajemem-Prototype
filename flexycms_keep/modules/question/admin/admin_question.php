<?php
class admin_question extends question_manager {

	function admin_question(& $smarty, & $_output, & $_input) {
		$this->question_manager($smarty, $_output, $_input, 'question');
		$this->obj_question = new question;
		$this->question_bl = new question_bl;
	}
	function get_module_name() {
		return 'question';
	}
	function get_manager_name() {
		return 'question';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	function _add(){
		$this->_output['tpl']="admin/question/add";
	}
	function _list($q="0"){
		$qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
		$uri = 'flexyadmin/index.php/question/list';
		$sql = get_search_sql("question", "1 ORDER BY id_question DESC ");
		$this->_output['field'] = array("id_question" => array("id_question", 1));
		$this->_output['uri'] = $uri;
		$this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
		$this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
		$this->_output['sql'] = $sql;
		$this->_output['type'] = 'box';
		$this->_output['sort_by'] = "id_question";
		$this->_output['order_by'] = "Desc";
		$this->_output['ajax'] = '1';
		$this->_output['qstart'] = $qstart;
		$this->question_bl->page_listing($this, "admin/question/list");
	}
	function _insertque(){
		ob_clean();
		$arr=$this->_input['arr'];
		$arr['start_date']=convertodate($this->_input['arr']['start_date'], "mm-dd-yy", "yy-mm-dd");
		$arr['end_date']=convertodate($this->_input['arr']['end_date'], "mm-dd-yy", "yy-mm-dd");
		$tbl="question";
		$arr['ip']=$_SERVER['REMOTE_ADDR'];
		$img_name = substr($this->_input['server_img'],(strpos($this->_input['server_img'],"_")+1));
		$arr['image']=$img_name;
		$id=$this->obj_question->insert_all($tbl, $arr,1);
		if($this->_input['server_img']){
			$this->_image_upload($id,$this->_input['server_img'],'','');
		}
		$this->_list();
	}
	function _edit_que(){
		$search_condition=" id_question=".$this->_input['id'];
		$sql=$this->question_bl->get_search_sql("question","$search_condition","*");
		$res=getsingleindexrow($sql);
		$this->_output['qstart']=$this->_input['qstart'];
		$this->_output['res']=$res;
		$this->_output['tpl']="admin/question/add";
	}
	function _update(){
		$arr=$this->_input['arr'];
		$arr['start_date']=convertodate($this->_input['arr']['start_date'], "mm-dd-yy", "yy-mm-dd");
		$arr['end_date']=convertodate($this->_input['arr']['end_date'], "mm-dd-yy", "yy-mm-dd");
		$arr['ip']=$_SERVER['REMOTE_ADDR'];
		if($this->_input['previousimage']){
			$arr['image']=$this->_input['previousimage'];
		}
		$cond="id_question = ".$arr['id_question'];
		$id=$arr['id_question'];
		if(!$this->_input['server_img']){
			$this->obj_question->update_this("question", $arr, $cond, $flag);
		}else{ 
			$this->obj_question->update_this("question", $arr, $cond);
			$this->_image_upload($id,$this->_input['server_img'],$id."_".$this->_input['previmage'],$this->_input['qstart']);
		}
		$this->_list($this->_input['qstart']);
	}
	function _del_que(){
		$this->_output['count']=$this->_input['count'];
		$this->_input['id']=trim($this->_input['id'], ',');
		$cond="id_question in (".$this->_input['id'].")";
		$this->obj_question->delete("question", $cond);
		if ($this->_input['qstart']) {
			$qstart = $this->_input['qstart'];
		}else{
			$qstart = 0;
		}
		if ($this->_input['count'] == 1 && $qstart > 0) {
			$qstart = $qstart - $this->_input['limit'];
		}else if ($this->_input['count'] > 1 && $qstart > 1) {
			$qstart = $qstart;
		}else{
			$qstart = 0;
		}
		$this->_input['qstart'] = $qstart;
		$this->_list($this->_input['qstart']);
	}

	function _preview(){
		
		if ($_FILES['img_name']['name']){
			$time= strtotime("now");
			$rid=$time."_";
			$uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
			$thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
			$thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
			$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
			$fname = $rid.convert_me($_FILES['img_name']['name']);
			$file_tmp=$_FILES['img_name']['tmp_name'];
			@copy($file_tmp, $uploadDir.$fname);
			$copy_thumb=@copy($uploadDir.$fname, $thumbnailDir.$fname);
			$this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
			$this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
			ob_clean();
			echo $fname;exit;
		}
	}
	function _image_upload($id,$serverimage,$previewimage,$qstart) {
		ob_clean();
		$del = $this->unlink_files();
		if ($serverimage) {
			$img_name = substr($serverimage,(strpos($serverimage,"_")+1));
			$arr['image']=$img_name;
			$arr['img_name']=$id."_".$img_name;
			$cond="id_question = ".$id;
			$img_msg = $this->obj_question->update_this("question",$arr, $cond);
			$orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['ques_orig'];
			$thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['ques_thumb'];
			if($previewimage){
				@unlink($orig_path.$previewimage);
				@unlink($thumb_path.$previewimage);
			}
			$preview_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['preview_orig'] . $serverimage;
			$orig_path.=$id."_".$img_name;
			$thumb_path.=$id."_".$img_name;
			copy($preview_path, $orig_path);
			copy($orig_path, $thumb_path);
			$thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
			$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
			$thumb_object = new thumbnail_manager($orig_path, $thumb_path);
			$thumb_object->get_container_thumb($thumb_width, $thumb_height, 0, 0);
		} else {
			print "No image Uploaded";
			exit;
		}
		$this->_list(qstart);
	}
	function unlink_files(){
		for($i=0;$i<2;$i++){
			if($i==0){
				$file_arr=glob(APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig']."*");
			}else{
				$file_arr=glob(APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb']."*");
			}
			if(!is_array($file_arr)){
				$file_arr=array();
			}
			$yes_time_stamp=strtotime("-1 day");
			foreach($file_arr as $val){
				$file_time_stamp=filemtime($val);
				if($file_time_stamp <= $yes_time_stamp){
					@unlink($val);
				}
			}
		}
		return;
	}
	function _startcheckdate(){
		$this->_input['start']=convertodate($this->_input['start'], "mm-dd-yy", "yy-mm-dd");
		$this->_input['end']=convertodate($this->_input['end'], "mm-dd-yy", "yy-mm-dd");

		if($this->_input['id']){
			$sql=get_search_sql("question"," id_question <>".$this->_input['id']." AND ((UNIX_TIMESTAMP('".$this->_input['start']."') between UNIX_TIMESTAMP(start_date) and UNIX_TIMESTAMP(end_date)) OR (UNIX_TIMESTAMP('".$this->_input['end']."') between UNIX_TIMESTAMP(start_date) and UNIX_TIMESTAMP(end_date))  OR (UNIX_TIMESTAMP('".$this->_input['start']."')< UNIX_TIMESTAMP(start_date) and   UNIX_TIMESTAMP('".$this->_input['end']."')> UNIX_TIMESTAMP(end_date)) ) ");
		}else{
			$sql=get_search_sql("question","(UNIX_TIMESTAMP('".$this->_input['start']."') between UNIX_TIMESTAMP(start_date) and UNIX_TIMESTAMP(end_date)) OR (UNIX_TIMESTAMP('".$this->_input['end']."') between UNIX_TIMESTAMP(start_date) and UNIX_TIMESTAMP(end_date))  OR (UNIX_TIMESTAMP('".$this->_input['start']."')< UNIX_TIMESTAMP(start_date) and   UNIX_TIMESTAMP('".$this->_input['end']."')> UNIX_TIMESTAMP(end_date)) ");
		}
		$check1=getrows($sql,$err);
		ob_clean();
		if($check1){
			print "0";
		}else{
			print "1";
		}
	}
}

