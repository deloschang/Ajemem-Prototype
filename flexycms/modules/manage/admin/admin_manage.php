<?php
class admin_manage extends manage_manager {

	function admin_manage(& $smarty, & $_output, & $_input) {
		$this->manage_manager($smarty, $_output, $_input, 'manage');
		$this->obj_manage = new manage;
		$this->manage_bl = new manage_bl;
	}
	function get_module_name() {
		return 'manage';
	}
	function get_manager_name() {
		return 'manage';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
####################################################################################
##########################    BADGES DETAIL  #######################################
####################################################################################
	function _list(){		
		if($this->_input['opt']){
			$sql = get_search_sql("badge", "is_glory_badge='1' ORDER BY id_badge DESC ");
			$this->_output['opt']=$this->_input['opt'];
			$this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
			//print("see");exit;
		}
		else{
			//print("see");exit;
			$sql = get_search_sql("badge", "1 ORDER BY id_badge DESC ");
			$this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
		}
			$list=getrows($sql, $err);//print_r($list);
			$this->_output['list']=$list;
			$this->_output['count1']=count($list);
			$this->_output['tpl']="admin/manage/show";
		
	}
	function _add_badge(){
	    if($this->_input['opt']){
		    $this->_output['opt']=$this->_input['opt'];
	    }
	    $this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
	    $this->_output['choice']="insert";
	    $this->_output['tpl']="admin/manage/add";
	}
	function _insert(){
	    ob_clean();
		$opt=$this->_input['opt'];
	    $arr=$this->_input['form'];
	    $tbl="badge";
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $img_name = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
	    $arr['image_badge']=$img_name; 
		if($this->_input['opt']){
			$arr['is_glory_badge']=1;
		}
		//print "<pre>";print_r($arr);exit;
	    $id_badge=$this->obj_manage->insert_all($tbl,$arr,1);
	    if($this->_input['prev_img']){			
		$this->_image_upload($id_badge,$this->_input['prev_img'],'','');
	    }
		
	}
	function _edit(){	
	    $this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
	    $search_condition=" id_badge=".$this->_input['id'];
	    $sql = get_search_sql("badge", $search_condition);
	    $res=getsingleindexrow($sql);
		//print "<pre>";print_r($res);exit;
		if($res['is_glory_badge']==1){
			$this->_output['opt']='opt';
		}
	    $this->_output['sbtype']=$res['badge_type'];
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/manage/add";
	}
	function _update(){	
	    ob_clean();
	    $arr=$this->_input['form'];
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $cond="id_badge = ".$this->_input['id'];
	    $id=$this->_input['id'];
		//print "<pre>";print_r($arr);exit;
	    if(!$this->_input['prev_img']){
		//$arr['image_badge'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		$this->obj_manage->update_this("badge", $arr, $cond, $flag);
	    }else{
		$arr['image_badge'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		$this->obj_manage->update_this("badge", $arr, $cond);
		$this->_image_upload($id,$this->_input['prev_img'],"","");
	    }
	    if($this->_input['opt'] != '')
				redirect(LBL_ADMIN_SITE_URL."manage/list/opt/".$this->_input['opt']);
			else
				redirect(LBL_ADMIN_SITE_URL."manage/list");
	}
	function _delete(){
		$opt='';
		//$this->_output['count']=$this->_input['count'];
		$this->_input['id']=trim($this->_input['id'], ',');
		 $search_condition=" id_badge=".$this->_input['id'];
	    $sql = get_search_sql("badge", $search_condition);
	    $res=getsingleindexrow($sql);
		//print "<pre>";print_r($res);exit;
		if($res['is_glory_badge']==1){
			$opt='opt';
		}
	    $cond="id_badge in (".$this->_input['id'].")";
		//redirect(LBL_ADMIN_SITE_URL."manage/unlink_files ");
	    $this->obj_manage->delete("badge", $cond);
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['count'] == 1 && $qstart > 0) {
	    $qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['count'] > 1 && $qstart > 1) {
		$qstart = $qstart;
		}else {
	    $qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    $this->_list($this->_input['qstart']);
		if($opt!= '')
				redirect(LBL_ADMIN_SITE_URL."manage/list/opt/".$opt);
			else
				redirect(LBL_ADMIN_SITE_URL."manage/list");	
	}
	function _preview(){
	    ob_clean();
	    if ($_FILES['image']['name']){
		$time= strtotime("now");
		$rid=$time."_";
		$uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
		$thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
		$thumb_height =$GLOBALS['conf']['IMAGE']['thumb_height'];
		$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
		$fname = $rid.convert_me($_FILES['image']['name']);	
		$file_tmp=$_FILES['image']['tmp_name'];
		copy($file_tmp, $uploadDir.$fname);
		$copy_thumb= print copy($uploadDir.$fname, $thumbnailDir.$fname);
		$this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
		$this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		$_SESSION['pv_img'][$this->_input['mid']]=$fname;
		ob_clean();
		print $fname;exit;
		if($GLOBALS['conf']['product']['image_type']==2){
		    print $fname.":".$this->_input['mid'];
		}else{
		    print $fname;exit;
		}
	    }
	}	
	function _image_upload($id,$serverimage,$previewimage,$qstart,$flag="0") {
	    print $id;
	    ob_clean();
	    $del = $this->unlink_files();
	    if ($serverimage) {
		$img_name = substr($serverimage,(strpos($serverimage,"_")+1));//print $img_name;exit;
		//$img_msg = $this->obj_question->update_image_name($id,$id."_".$img_name);
		if($flag){
		    $orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['glorybadge_orig'];
		    $thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['glorybadge_thumb'];
		}else{ 
		    $orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['badge_orig'];
		    $thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['badge_thumb'];
		}
		if($previewimage){
		    unlink($orig_path.$previewimage);
		    unlink($thumb_path.$previewimage);
		}
		$preview_path = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'].$serverimage;
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
	    if($flag){
		$this->_glory_list();
	    }else{
			if($this->_input['opt'])
				redirect(LBL_ADMIN_SITE_URL."manage/list/opt/".$this->_input['opt']);
			else
				redirect(LBL_ADMIN_SITE_URL."manage/list");
	    }
	}	
	function _validate_badge_no(){
		$flag="";
		$badge_type=$this->_input['badge_type'];
		$badge_type_number=$this->_input['badge_type_number'];
		$image=$this->_input['image'];
		$sql=get_search_sql("badge","badge_type='".$badge_type."' and badge_type_number= ".$badge_type_number );
		//print $sql;
		$arr=getrows($sql, $err);
		//print "<pre>";print_r($arr);
		print json_encode($arr);

	}
    
 ########################################################################
 ########## DELETE THE FILE FROM THE PREVIEW FOLDER AFTER 1DAY  #########
 ########################################################################
    
	function _unlink_files(){
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
		       //print $val." :: ".date('d-m-Y',$file_time_stamp)."<br>";
		    }
		}
	    }
	    return;
	}
	function _check_range(){
	    $max=$this->_input['max'];
	    $min=$this->_input['min'];
	    $sql = get_search_sql("badge", $max." between start and end OR ". $min." between start and end OR ".$max." < start and ".$min." > end");
	    $list=getrows($sql, $err);
	    ob_clean();
	    if($list){
		print "0";
	    }else{
		print "1";
	    }
	}
######################################################################################################
############################   FEATURE AND SUGGESTION   ##############################################
######################################################################################################
	function _list_feature(){
	    $sql = get_search_sql("feature", "1 ORDER BY id_feature DESC ");
	    $list=getrows($sql, $err);
	    $this->_output['list']=$list;
	    $this->_output['count1']=count($list);
	    $this->_output['tpl']="admin/manage/show_feature";
	}
	function _add_feature(){
	    $this->_output['choice']="insert";
	    $this->_output['tpl']="admin/manage/add_feature";
	}
	function _insert_feature(){
	    ob_clean();
	    $arr=$this->_input['form'];;
	    $tbl="feature";
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    //$img_name = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
	    //$arr['image_badge']=$img_name;
	    //print"<pre>";print_r($arr);exit;
	    $id_feature=$this->obj_manage->insert_all($tbl,$arr,1);
	    redirect(LBL_ADMIN_SITE_URL."manage/list_feature");	
	}
	function _edit_feature(){	
	    $search_condition=" id_feature=".$this->_input['id'];
	    $sql = get_search_sql("feature", $search_condition);
	    $res=getsingleindexrow($sql);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/manage/add_feature";
	}
	function _update_feature(){	
	    ob_clean();
	    $arr=$this->_input['form'];
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $cond="id_feature = ".$this->_input['id'];
	    $id=$this->_input['id'];
	    $this->obj_manage->update_this("feature", $arr, $cond);
	    redirect(LBL_ADMIN_SITE_URL."manage/list_feature");	
	}
	function _delete_feature(){
	    $this->_input['id']=trim($this->_input['id'], ',');
	    $cond="id_feature in (".$this->_input['id'].")";
	    $this->obj_manage->delete("feature", $cond);
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['count'] == 1 && $qstart > 0) {
	    $qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['count'] > 1 && $qstart > 1) {
		$qstart = $qstart;
		}else {
	    $qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    $this->_list($this->_input['qstart']);
		redirect(LBL_ADMIN_SITE_URL."manage/list_feature");	
	}
	function _edit_flag(){
	    $arr['activation']=$this->_input['activation'];
	    $cond="id_feature = ".$this->_input['id'];
	    $this->obj_manage->update_this("feature", $arr, $cond);
	    redirect(LBL_ADMIN_SITE_URL."manage/list_feature");	
	}
	function _see_detail($q='0'){
	    $id_feature=$this->_input['id_feature'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'flexyadmin/manage/see_detail/id_feature/'.$id_feature;		
	    $cond=" and a.id_feature = ".$this->_input['id_feature'];
	    $sql="select b.fname as fname,b.lname as lname,a.suggestion as suggestion,a.add_date as add_date from memeje__suggestion a,memeje__user b  WHERE a.id_user =  b.id_user " .$cond;
	    $this->_output['field'] = array("id_feature" => array("id_feature", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_suggestion";
	    $this->_output['order_by'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $this->_output['id_feature']=$this->_input['id_feature'];
	    $_REQUEST['choice'] =see_detail;
	    $this->manage_bl->page_listing($this, "admin/manage/show_suggestion");
	}
	####################################################################################################
	########################################page########################################################
	####################################################################################################
	function _list_page($q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'flexyadmin/manage/list_page';
	    if ($this->_input['chk']) {
		$cond="";
		if($this->_input['user']!=''){
		    $cond .= " AND b.email LIKE '".$this->_input['user']."%'";
		    //$uri .= "/image/".$this->_input['image'];
			$sql="select  b.fname,b.lname,b.email, sum(a.home_page) as home_page,sum(a.maka_a_meme) as maka_a_meme,sum(a.feature) as feature,sum(a.funny) as funny,sum(a.love) as love,sum(a.trees) as trees,sum(a.everyday) as everyday,sum(a.random) as random,sum(a.top_memes) as top_memes,sum(a.add_caption) as add_caption,sum(a.leaderboard) as leaderboard,sum(a.what_is_memeja) as what_is_memeja,sum(a.aboutus) as aboutus, sum(a.home_page && a.maka_a_meme && a.funny && a.love && a.trees && a.feature && a.everyday && a.random && a.top_memes && a.add_caption && a.leaderboard && a.what_is_memeja && a.aboutus) as visitall  from memeje__page a,memeje__user b where a.id_user=b.id_user" .$cond. "group by a.id_user ";
		}else{
		    $sql="select  b.fname,b.lname,b.email, sum(a.home_page) as home_page,sum(a.maka_a_meme) as maka_a_meme,sum(a.feature) as feature,sum(a.funny) as funny,sum(a.love) as love,sum(a.trees) as trees,sum(a.everyday) as everyday,sum(a.random) as random,sum(a.top_memes) as top_memes,sum(a.add_caption) as add_caption,sum(a.leaderboard) as leaderboard,sum(a.what_is_memeja) as what_is_memeja,sum(a.aboutus) as aboutus, sum(a.home_page && a.maka_a_meme && a.funny && a.love && a.trees && a.feature && a.everyday && a.random && a.top_memes && a.add_caption && a.leaderboard && a.what_is_memeja && a.aboutus) as visitall  from memeje__page a,memeje__user b where a.id_user=b.id_user group by a.id_user ";
		}
	    } else{
		$sql="select   b.fname,b.lname,b.email, sum(a.home_page) as home_page,sum(a.maka_a_meme) as maka_a_meme,sum(a.feature) as feature,sum(a.funny) as funny,sum(a.love) as love,sum(a.trees) as trees,sum(a.everyday) as everyday,sum(a.random) as random,sum(a.top_memes) as top_memes,sum(a.add_caption) as add_caption,sum(a.leaderboard) as leaderboard,sum(a.what_is_memeja) as what_is_memeja,sum(a.aboutus) as aboutus, sum(a.home_page && a.maka_a_meme && a.funny && a.love && a.trees &&  a.feature && a.everyday && a.random && a.top_memes  && a.add_caption && a.leaderboard && a.what_is_memeja && a.aboutus) as visitall  from memeje__page a,memeje__user b where a.id_user=b.id_user group by a.id_user ";
	    }
	    $this->_output['field'] = array("id_page" => array("id_page", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_page";
	    $this->_output['order_by'] = "Desc";
	    $this->_output['ajax'] = '1';
		//$this->_output['visitall']=$list1;
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['choice'] =list_page;
	    if ($this->_input['chk']) {
		$this->manage_bl->page_listing($this, "admin/manage/show_page");
	    } else {
		$this->manage_bl->page_listing($this, "admin/manage/page_search");
	    }
		
	}	
##############################################################################################################
##############################################GloryIcon#######################################################
##############################################################################################################		
	function _list_glory(){
	    $this->_output['cat']=$GLOBALS['conf']['GLORY_CATEGORY'];
	    $sql = get_search_sql("gloryicon", "1 ORDER BY id_gloryicon DESC ");
	    $list=getrows($sql, $err);
	    //print"<pre>";print_r($list);exit;
	    $this->_output['list']=$list;
	    $this->_output['count1']=count($list);
	    $this->_output['tpl']="admin/manage/show_glory";
	}
	function _add_glory(){
	    $this->_output['cat']=$GLOBALS['conf']['GLORY_CATEGORY'];
	    $this->_output['choice']="insert";
	    $this->_output['tpl']="admin/manage/add_glory";

	}
	function _insert_glory(){
	    ob_clean();
	    $arr=$this->_input['form'];
	    $arr[start_on]=convertodate($arr[start_on], "mm-dd-yy", "yy-mm-dd");
	    $arr[end_on]=convertodate($arr[end_on], "mm-dd-yy", "yy-mm-dd");
	    $tbl="gloryicon";
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $img_name = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
	    $arr['icon']=$img_name;
	    $id_glory=$this->obj_manage->insert_all($tbl,$arr,1);
	    if($this->_input['prev_img']){			
		$this->_image_upload_glory($id_glory,$this->_input['prev_img'],'','');
	    }
	    redirect(LBL_ADMIN_SITE_URL."manage/list_glory");	
	}
	function _edit_glory(){	
	    $search_condition=" id_gloryicon=".$this->_input['id'];
	    $sql = get_search_sql("gloryicon", $search_condition);
	    $res=getsingleindexrow($sql);
	    $this->_output['cat']=$GLOBALS['conf']['GLORY_CATEGORY'];
	    $this->_output['scat']=$res['id_glory_category'];
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/manage/add_glory";
	}
	function _update_glory(){	
	    ob_clean();
	    $arr=$this->_input['form'];
	    $arr[start_on]=convertodate($arr[start_on], "mm-dd-yy", "yy-mm-dd");
	    $arr[end_on]=convertodate($arr[end_on], "mm-dd-yy", "yy-mm-dd");
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $cond="id_gloryicon = ".$this->_input['id'];
	    $id=$this->_input['id'];
	    if(!$this->_input['prev_img']){
	    //$arr['image_badge'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		 $this->obj_manage->update_this("gloryicon", $arr, $cond, $flag);
	    }else{
		$arr['icon'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		$this->obj_manage->update_this("gloryicon", $arr, $cond);
		$this->_image_upload_glory($id,$this->_input['prev_img'],"","");
	    }
	    redirect(LBL_ADMIN_SITE_URL."manage/list_glory");	
	}
	function _delete_glory(){
	    $this->_input['id']=trim($this->_input['id'], ',');
	    $cond="id_gloryicon in (".$this->_input['id'].")";
	    $this->obj_manage->delete("gloryicon", $cond);
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['count'] == 1 && $qstart > 0) {
		$qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['count'] > 1 && $qstart > 1) {
		$qstart = $qstart;
	    }else {
		$qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    $this->_list($this->_input['qstart']);
	    redirect(LBL_ADMIN_SITE_URL."manage/list_glory");	
	}
	function _preview_glory(){
	    ob_clean();
	    if ($_FILES['image']['name']){
		$time= strtotime("now");
		$rid=$time."_";
		$uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
		$thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
		$thumb_height =$GLOBALS['conf']['IMAGE']['thumb_height'];
		$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
		$fname = $rid.convert_me($_FILES['image']['name']);	
		$file_tmp=$_FILES['image']['tmp_name'];
		copy($file_tmp, $uploadDir.$fname);
		$copy_thumb= print copy($uploadDir.$fname, $thumbnailDir.$fname);
		$this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
		$this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		$_SESSION['pv_img'][$this->_input['mid']]=$fname;
		ob_clean();
		if($GLOBALS['conf']['product']['image_type']==2){
		    print $fname.":".$this->_input['mid'];
		}else{
		    print $fname;exit;
		}
	    }
	}
	
	function _image_upload_glory($id,$serverimage,$previewimage,$qstart) {
	    ob_clean();
	    $del = $this->unlink_files_glory();
	    if ($serverimage) {
		$img_name = substr($serverimage,(strpos($serverimage,"_")+1));
		//$img_msg = $this->obj_question->update_image_name($id,$id."_".$img_name);
		$orig_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['gloryicon_orig'];
		$thumb_path = APP_ROOT . $GLOBALS['conf']['IMAGE']['gloryicon_thumb'];
		if($previewimage){
		    unlink($orig_path.$previewimage);
		    unlink($thumb_path.$previewimage);
		}
		$preview_path = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'].$serverimage;
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
	    //$this->_list();
	    redirect(LBL_ADMIN_SITE_URL."manage/list_glory");	
	}
	function unlink_files_glory(){
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
			   //print $val." :: ".date('d-m-Y',$file_time_stamp)."<br>";
		    }
		}
	    }
	return;
	}

######################################
######################################
######################################   
	function _add_glory_badge(){
	    $this->_output['tpl']="admin/manage/add_glory_badge";
	}
	
######################################
############INSERT GLORY BADGE########
######################################   

	function _insert_glory_badge(){
	    ob_clean();
	    $tbl="glorygained";
	    $img_name = substr($this->_input['server_img'],(strpos($this->_input['server_img'],"_")+1));
	    $arr['glory_points']=$this->_input['glory_points'];
	    $arr['badges']=$img_name;
	    $id=$this->obj_manage->insert_all($tbl,$arr);
	    if($this->_input['server_img']){			
		$this->_image_upload($id,$this->_input['server_img'],'','',1);
	    }
	}

######################################
###########GLORY BADGE DETAILS########
######################################   
	
	function _glory_list(){
	    $uri = 'flexyadmin/manage/glory_list';
	    $qstart=isset($this->_input['qstart'])?$this->_input['qstart']:0;
	    $sql="SELECT * FROM ".TABLE_PREFIX."glorygained WHERE 1 ";
	    $this->_output['pg_header']= "Glory Points Details";
	    $this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] =$GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['type']	= "normal";  // extra, nextprev, advance, normal, box
	    $this->_output['field'] = array("glory_points"=>array("Glory Points",1),"badges"=>array("Badge",0));
	    //,'flag'=>array('STATUS',1,'anchor'=>LBL_ADMIN_SITE_URL."user/change_status".$churi."/id/",'condition'=>array('0'=>'Enable','1'=>'Disable'))
	    $this->_output['qstart']=$qstart;
	    $this->_output['sql'] = $sql;
	    $this->_output['uri'] = $uri;
	    $this->_output['sort_by']=isset($this->_input['sort_by'])?$this->_input['sort_by']:"glory_points";
	    $this->_output['sort_order']="ASC";
	    $this->_output['ajax'] = 1;
	    $this->manage_bl->page_listing($this,'admin/manage/glory_list');
	}
	
######################################
###########ALLOT POINT DETAILS########
######################################   

	function _show_points(){
	    $sql="SELECT * FROM ".TABLE_PREFIX."allotpoints WHERE 1";
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/manage/show_points";
	}
	
######################################
######################################
######################################   
	
	function _allot_points(){
	    $this->_output['tpl']="admin/manage/allot_points";
	
	}
	
######################################
###########ALLOT POINT INSERT#########
######################################   
	
	function _insert_points(){
	    $sql="SELECT * FROM ".TABLE_PREFIX."allotpoints WHERE point_type = '".$this->_input['point_type']."'";
	    $r=getrows($sql, $err);
	    if(count($r) != 0){
		print "0";
	    }else{
		$arr['point_type']=$this->_input['point_type'];
		$arr['points']=$this->_input['points'];
		$r=$this->obj_manage->insert_all("allotpoints", $arr);
		$this->_show_points();
	    }
	}
#####################ss###############
###########EDIT ALLOT POINT ##########
######################################
	
    function _edit_point(){
	    $cond=" id_allot=".$this->_input['id'];
	    $sql=get_search_sql("allotpoints", $cond);
	    $res=getsingleindexrow($sql);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/manage/allot_points";
    }
    
######################################
###########UPDATE ALLOT POINT ########
######################################  
    
    function _update_point(){
	$arr['points']=$this->_input['points'];
	$cond=" id_allot = ".$this->_input['id'];
	$this->obj_manage->update_this("allotpoints", $arr, $cond);
	$this->_show_points();
    }
    
######################################
###########DELETE ALLOT POINT ########
###################################### 
    
    function _del_point(){
	$cond="id_allot =".$this->_input['id'];
	$this->obj_manage->delete("allotpoints", $cond);
	$this->_show_points();
    }
}
