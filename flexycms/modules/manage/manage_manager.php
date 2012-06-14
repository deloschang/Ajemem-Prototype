<?php
class manage_manager extends mod_manager {
	function manage_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'manage');
		$this->obj_manage= new manage;
		$this->manage_bl = new manage_bl;
 	}
	function get_module_name() {
		return 'manage';
	}
	function get_manager_name() {
		return 'manage';
	}
	function _default() {

	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Manager Error</h1>";
		}
	}
	function _suggestion(){
	    check_session();
	    $arr['feature']="feature+1";
	    $cond="id_page= ".$_SESSION['id_page'];
	    //$this->obj_manage->update_this("page", $arr, $cond,1);
	    $sql=$this->manage_bl->get_search_sql("feature","activation=1");
	    $res=getrows($sql, $err);
	    $this->_output['feature']=$res;
	    $this->_output['tpl']="manage/suggestion_list";
	    
	}
	function _insert_suggestion(){
	    $arr['id_feature']=$this->_input['id_feature'];
	    $arr['suggestion'] = $this->_input['suggestion'];
	    $arr['id_user']=$_SESSION['id_user'];
	    $arr['ip']=$_SERVER['REMOTE_ADDR'];
	    $id=$this->obj_manage->insert_all("suggestion",$arr,'1');
	    if($id){
		$feature['no_of_suggestion']="no_of_suggestion+1";
		$cond="id_feature= ".$arr['id_feature'];
		$this->obj_manage->update_this("feature",$feature,$cond,1);
	    }
	    print $id;
	}

	
	function _my_meme_list(){

	    //check_session();
		
		// is this a profile or my own page?
		$id_user = $_SESSION['profile_id'] ? $_SESSION['profile_id'] : $_SESSION['id_user'];
		
	    global $link;
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'] + 10;
	    $comm = " id_user=".$id_user;

	    $cond = (!$this->_input['last_id'])?$comm:$comm." AND id_meme <".$this->_input['last_id'];
	    $cond.=" ORDER BY id_meme DESC LIMIT ".$limit;
	    $sql=$this->manage_bl->get_search_sql("meme",$cond,"*");
	    $res = mysqli_query($link,$sql);
	    if($res){
			while($rec = mysqli_fetch_assoc($res)){
				$id_memes.=$rec['id_meme'].",";
				$arr[] = $rec;
			}
	    }
	    @mysqli_free_result($res);
	    mysqli_next_result($link);
	    $hst_rtd_cap = $this->get_hst_rtd_caption(trim($id_memes,','));
	    $this->_output['res']=$arr;
	    $this->_output['hrc']=$hst_rtd_cap;
	    $this->_output['last_res_id_meme']=($arr)?$arr[count($arr)-1]['id_meme']:"";
	    if($this->arg['gmod']==1){
			$tpl="manage/my_meme_list";
	    } else {
			$tpl=(!$this->_input['last_id'])?"manage/my_meme_details":"manage/loadmore_my_meme";
	    }
	    $this->_output['tpl'] = $tpl;
	}
	
	function get_hst_rtd_caption($id_memes){
	    $sql = $this->manage_bl->get_max_recs("(select * from ".TABLE_PREFIX."caption order by tot_honour desc) a","id_meme,caption","1 GROUP BY id_meme");
	    $hst_rtd_cap = getindexrows($sql, "id_meme");
	    return $hst_rtd_cap;
	}
	
	function _tagged_memes(){
		$id_user = $_SESSION['profile_uid'] ? $_SESSION['profile_uid'] : (($_SESSION['profile_id']) ? '' : $_SESSION['uid']);
	
		global $link;
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'];
	    $cond = "FIND_IN_SET(".$id_user.",tagged_user) ";
	    $cond.=" ORDER BY id_meme DESC LIMIT ".$limit;
	    $sql=$this->manage_bl->get_search_sql("meme",$cond,"*");
	    $res = mysqli_query($link,$sql);
	    if($res){
			while($rec = mysqli_fetch_assoc($res)){
				$id_memes.=$rec['id_meme'].",";
				$arr[] = $rec;
			}
	    }
	    @mysqli_free_result($res);
	    mysqli_next_result($link);
		
		$this->_output['flg']=2;
	    $this->_output['res']=$arr;
		
		if($this->arg['gmod']==1){
			$tpl="manage/my_meme_list";
	    } else{
			$tpl=(!$this->_input['last_id'])?"manage/my_meme_details":"manage/loadmore_my_meme";
	    }
	    $this->_output['tpl'] = $tpl;
	}
	
	function _my_favorites(){
	    check_session();
	    global $link;
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'] - 7;
	    $comm = "FIND_IN_SET(".$_SESSION['id_user'].",honour_id_user) ";
	    $cond = (!$this->_input['last_id'])?$comm:$comm." AND id_meme <".$this->_input['last_id'];
	    $cond.=" ORDER BY id_meme DESC LIMIT ".$limit;
	    $sql=$this->manage_bl->get_search_sql("meme",$cond,"*");
	    $res = mysqli_query($link,$sql);
	    if($res){
			while($rec = mysqli_fetch_assoc($res)){
				$id_memes.=$rec['id_meme'].",";
				$arr[] = $rec;
			}
	    }
	    @mysqli_free_result($res);
	    mysqli_next_result($link);
	    $hst_rtd_cap = $this->get_hst_rtd_caption(trim($id_memes,','));
	    $this->_output['hrc']=$hst_rtd_cap;
	    $usr_info=$this->get_user_info();
	    $this->_output['usr_info']=$usr_info;
	    $this->_output['flg']=1;
	    $this->_output['res']=$arr;
	    $this->_output['last_res_id_meme']=($arr)?$arr[count($arr)-1]['id_meme']:"";
	    if($this->arg['gmod']==1){
			$tpl="manage/my_meme_list";
	    } else{
			$tpl=(!$this->_input['last_id'])?"manage/my_meme_details":"manage/loadmore_my_meme";
	    }
	    $this->_output['tpl'] = $tpl;
	}

	function _dueled_meme(){
	}
########################################################################
###################  NEW NOTIFICATION COUNT WITH POP UP ################
########################################################################
	
	function _getall_notification($fg=""){
	    global $link;
	    $cnt=0;
	    $id_users="";
	    $id_badges="";
	    $cond = "notified_user=".$_SESSION['id_user']." AND is_removed<>1";
	    
	    if(!$fg)
			$cond.=" AND is_read<>1";
	    $cond.=" ORDER BY id_notification DESC LIMIT ".$GLOBALS['conf']['PAGINATE']['rec_per_page'];
	    $sql = $this->manage_bl->get_search_sql("notification",$cond);
	    $res = mysqli_query($link,$sql);
	    
	    while ($rec=mysqli_fetch_assoc($res)) {
			$cnt++;
			$not_arr[] = $rec;
			if($rec['notification_type']!='4')
				$id_users .= $rec['id_user'].",";
			else
				$id_badges .= $rec['id_user'].",";
	    }
	    
	    mysqli_free_result($res); 
	    mysqli_next_result($link);
	    
	    if($fg==1){
			$arr['notifications'] = $not_arr;
			$arr['id_users'] = trim($id_users,',');
			$arr['id_badges'] = trim($id_badges,',');
			return $arr;
	    }
	    
	    if($fg==2)
			return $not_arr;
			
	    $not[0] = trim($id_users,',');
	    $not[1] = trim($id_badges,',');
	    $not[2] = $cnt;
	    
	    if($cnt!=0){
			print json_encode($not);
	    } else {
			$not[0] = "-1";
			$not[1] = "1";
			$not[2] = "1";	    
			print json_encode($not);
	    }	
	    exit;
	}
	
########################################################################
##### NOTIFICATION LISTING WHEN USER CLICKS ON NOTIFICATION BUTTON #####
########################################################################
	
	function _get_details_notification(){
	    if($this->_input['id_users']!='' || $this->_input['id_badges']!=''){
			if($this->_input['id_users']!='')
		    	$not['user_info'] = $this->get_user_info();
			if($this->_input['id_badges']!='')
			    $not['badge_info'] = $this->get_user_info();
			$not['notifications'] = $this->_getall_notification(2);
	    }
	    
	    if($this->_input['id_badges']=='' && $this->_input['id_users']==''){
			$info = $this->_getall_notification(1);
			$not['notifications'] = $info['notifications'];
			$not['user_info'] = ($info['id_users']!='')?$this->get_user_info():'';
			$not['badge_info'] = ($info['id_badges']!='')?$this->badge_info($info['id_badges']):'';
	    }
	    
	    $isread["is_read"]='1';
	    $this->obj_manage->update_this("notification", $isread, "notified_user=".$_SESSION['id_user']);

	    $this->_output['result'] = $not;
	    $this->_output['tpl'] = "manage/notication_listing";
	}
########################################################################
############# COMMON FUNCTIONS USED FOR NOTIFICATION DETAILS ###########
########################################################################
	function get_user_info($id_users=""){
	    global $link;
	    $cond = ($id_users!="")?" id_user IN(".$id_users.")":1;
	    $sql = $this->manage_bl->get_search_sql("user",$cond,"id_user,fname,lname,avatar,gender");
	    $res = mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
		$user_info[$rec['id_user']] = $rec;
		$user_info[$rec['id_user']]['friends'] = explode(",",$rec['memeje_friends']);
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    return $user_info;
	}
	function badge_info($id_badges){
	    $id_badges = ($id_badges)?$id_badges:0;
	    $sql = $this->manage_bl->get_search_sql("badge"," id_badge IN(".$id_badges.")","id_badge,image_badge");
	    $not = getindexrows($sql, "id_badge");
	    return $not;
	}

########################################################################
# NOTIFICATION DETAIL LISTING WHEN USER CLICKS ON SEE ALL NOTIFICATION #
########################################################################
	
	function _see_all_notification(){
	    check_session();
	    if($this->_input['id_not']){
		$isremoved["is_removed"]='1';
		$this->obj_manage->update_this("notification", $isremoved, "id_notification=".$this->_input['id_not']);
		print "1";exit;
	    }
	    global $link;
	    $id_users= "";
	    $id_badges="";
	    $sql = $this->manage_bl->get_search_sql("notification"," notified_user=".$_SESSION['id_user']." AND is_removed<>1 ORDER BY add_date DESC ","*,DATE(add_date) date");
	    $res = mysqli_query($link,$sql);
	    if($res){
		while($rec = mysqli_fetch_assoc($res)){
		      $record[$rec['date']][]=$rec;	
		      if($rec['notification_type']!='4')
			$id_users .= $rec['id_user'].",";
		    else
			$id_badges .= $rec['id_user'].",";
		}
	    } 	    
	    mysqli_free_result($res); 
	    mysqli_next_result($link);
	    $this->_output['userinfo']  = ($id_users)?$this->get_user_info(trim($id_users,',')):'';
	    $this->_output['badges'] = ($id_badges)?$this->badge_info(trim($id_badges,',')):'';
	    $this->_output['not'] = $record;
	    $this->_output['tpl'] = "manage/see_all_not";
	}
	
}
