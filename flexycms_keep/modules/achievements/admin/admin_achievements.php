<?php
class admin_achievements extends achievements_manager{

	function admin_achievements(& $smarty, & $_output, & $_input) {
		$this->achievements_manager($smarty, $_output, $_input, 'achievements');
		$this->obj_achievements = new achievements;
		$this->achievements_bl = new achievements_bl;
	}
	function get_module_name() {
		return 'achievements';
	}
	function get_achievements_name() {
		return 'achievements';
	}
	function achievements_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
####################################################################################################
	########################################page########################################################
	####################################################################################################
	function _list_page($q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'flexyadmin/index.php/achievements/list_page';
	    if ($this->_input['chk']) {
		$cond="";
		if($this->_input['user']!=''){
		    $cond .= " AND b.email LIKE '".$this->_input['user']."%'";
		    //$uri .= "/image/".$this->_input['image'];
				$uri .="/user/".$this->_input['user'];
			$sql="select  b.fname,b.lname,b.email, sum(a.home_page) as home_page,sum(a.maka_a_meme) as maka_a_meme,sum(a.feature) as feature,sum(a.funny) as funny,sum(a.love) as love,sum(a.trees) as trees,sum(a.everyday) as everyday,sum(a.random) as random,sum(a.top_memes) as top_memes,sum(a.add_caption) as add_caption,sum(a.leaderboard) as leaderboard,sum(a.what_is_memeja) as what_is_memeja,sum(a.aboutus) as aboutus, sum(a.home_page && a.maka_a_meme && a.funny && a.love && a.trees && a.feature && a.everyday && a.random && a.top_memes && a.add_caption && a.leaderboard && a.what_is_memeja && a.aboutus) as visitall  from memeje__page a,memeje__user b where a.id_user=b.id_user" .$cond. "group by a.id_user ";
		    $uri .="/user/".$this->_input['user'];
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
		$this->achievements_bl->page_listing($this, "admin/achievements/show_page");
	    } else {
		$this->achievements_bl->page_listing($this, "admin/achievements/page_search");
	    }
		
	}
	function _activities(){
	    $activity=array(search=>search,reply=>reply,meme_post=>meme_post);
	    $this->_output['act_type']=$activity;
	    $this->_output['tpl']="admin/achievements/show_activities";
	    
	}
	
	
	
####################################################################################
##########################    BADGES DETAIL  #######################################
####################################################################################
	function _list_badge(){
		//print($this->_input['choice1']);exit;
		//print "ok";exit;
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
			$this->_output['tpl']="admin/achievements/show_badge";
		
	}
	function _add_badge(){
		//print($this->_input['opt']);exit;
		//print("i here");exit;
		if($this->_input['opt']){
			$this->_output['opt']=$this->_input['opt'];
		}
	    $this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
	    $this->_output['choice']="insert";
	    $this->_output['tpl']="admin/achievements/add_badge";
	}
	function _insert_badge(){
	    ob_clean();//print("i here");exit;
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
	    $id_badge=$this->obj_achievements->insert_all($tbl,$arr,1);//print $this->_input['prev_img'];exit;
	    if($this->_input['prev_img']){			
		$this->_image_upload($id_badge,$this->_input['prev_img'],'','');
	    }
		
	}
	function _edit_badge(){	
	    $this->_output['btype']=$GLOBALS['conf']['BADGE_TYPE'];
	    $search_condition=" id_badge=".$this->_input['id'];
	    $sql = get_search_sql("badge", $search_condition);
	    $res=getsingleindexrow($sql);
		//print "<pre>";print_r($res);exit;
		if($res['is_glory_badge']==1){
			$this->_output['opt']='opt';
		}
		//print "<pre>";
		//print_r($res);
	    $this->_output['sbtype']=$res['badge_type'];
	    $this->_output['res']=$res;//print "<pre>";print_r($res);exit;
	    $this->_output['tpl']="admin/achievements/add_badge";
	}
	function _update_badge(){
	    ob_clean();
	    $arr=$this->_input['form'];
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $cond="id_badge = ".$this->_input['id'];
	    $id=$this->_input['id'];
		//print "<pre>";print_r($arr);exit;
	    if(!$this->_input['prev_img']){
		//$arr['image_badge'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		$this->obj_achievements->update_this("badge", $arr, $cond, $flag);
	    }else{
		$arr['image_badge'] = substr($this->_input['prev_img'],(strpos($this->_input['prev_img'],"_")+1));
		$this->obj_achievements->update_this("badge", $arr, $cond);
		$this->_image_upload($id,$this->_input['prev_img'],"","");
	    }
	    if($this->_input['opt'] != '')
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge/opt/".$this->_input['opt']);
			else
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge");
	}
	function _delete_badge(){
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
	    $this->obj_achievements->delete("badge", $cond);//print "here 2";exit;
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['count'] == 1 && $qstart > 0) {//print "here 2";exit;
	    $qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['count'] > 1 && $qstart > 1) {
		$qstart = $qstart;
		}else {
	    $qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    //$this->_list_badge($this->_input['qstart']);
		if($opt!= ''){
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge/opt/".$opt);
		}
			else{
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge");
			}
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
	function _image_upload($id,$serverimage,$previewimage,$qstart,$flag="0") {//print("see");exit;
	    print $id;
	    ob_clean();//print $serverimage;exit;
	   // $del = $this->unlink_files();
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
	    //print("see1");exit;
			if($this->_input['opt'])
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge/opt/".$this->_input['opt']);
			else
				redirect(LBL_ADMIN_SITE_URL."achievements/list_badge");
	    
	}	
		function _validate_badge_no(){
			$flag="";
			$badge_type=$this->_input['badge_type'];
			$badge_type_number=$this->_input['badge_type_number'];
			$image=$this->_input['image'];
			$sql=get_search_sql("badge","badge_type='".$badge_type."' AND  badge_type_number='".$badge_type_number."' AND id_badge !='".$this->_input['id_badge']."' ");
			//print $sql;exit;
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
}
