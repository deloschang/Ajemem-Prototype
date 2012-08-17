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

	    $cond = (!$this->_input['last_id']) ? $comm : $comm." AND id_meme <".$this->_input['last_id'];
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
		
		// maybe abstract 
		$each_id = explode(',',$id_memes);
		foreach($each_id as $key => $value){
			if ($value){
				$tag_sql = "SELECT tagged FROM memeje__tags WHERE id_meme=".$value;
				$tag_res = mysqli_query($link,$tag_sql);
				
				if ($tag_res){
					$i = 0;
					while($tag_rec = mysqli_fetch_assoc($tag_res)){
						$arr[$key]['who_was_tagged'][] = $tag_rec;
						$arr[$key]['who_was_tagged'][$i]['tag_name'] = json_decode(file_get_contents('http://graph.facebook.com/'.$tag_rec['tagged']))->name;
						$i += 1;
					}
				}
			}
		}				
		
	    $hst_rtd_cap = $this->get_hst_rtd_caption(trim($id_memes,','));		
	    $usr_info=$this->get_user_info();
	    $this->_output['uinfo']=$usr_info;
		
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
		$id_user = $_SESSION['profile_uid'] ? $_SESSION['profile_uid'] : (($_SESSION['profile_id']) ? '' : $_SESSION['uid']);  //this is facebook id
	
		global $link;
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'];
		
		// old code for old data..
	    //$cond = "FIND_IN_SET(".$id_user.",tagged_user) ";
	    // $cond.=" ORDER BY id_meme DESC LIMIT ".$limit;
	    // $sql=$this->manage_bl->get_search_sql("meme",$cond,"*");
	    // $res = mysqli_query($link,$sql);
	    // if($res){
			// while($rec = mysqli_fetch_assoc($res)){
				// $id_memes.=$rec['id_meme'].",";
				// $arr[] = $rec;
			// }
	    // }
		
		// SELECT b.title, b.color, b.detail, a.friend_id
// FROM table1 a INNER JOIN table2 b
// on a.pic_id = b.pic_id
// WHERE EXISTS (SELECT 1 FROM table1 t 
              // WHERE t.pic_id = a.pic_id AND t.friend_id = 84589)
		
	$sql = "SELECT * FROM memeje__tags a INNER JOIN memeje__meme b
						on a.id_meme = b.id_meme
				WHERE tagged =".$id_user." ORDER BY b.id_meme DESC LIMIT ".$limit;
			
			// table 1= memeje__tags
			// table 2 = memeje__meme
			// friend_id = tagged
			// pic_id = id_meme
			
		//$sql = "SELECT b.title, a.tagged FROM memeje__tags a INNER JOIN memeje__meme b on a.id_meme = b.id_meme WHERE EXISTS (SELECT 1 FROM memeje__tags t WHERE t.id_meme = a.id_meme AND t.tagged =".$id_user;
		//$sql = "SELECT *
  // GROUP_CONCAT(friend_pics.tagged) as friend_ids
// FROM memeje__tags as root_pics
// JOIN memeje__tags as friend_pics 
  // USING(id_meme)
// JOIN memeje__meme as pic_details
  // ON root_pics.id_meme = pic_details.id_meme OR friend_pics.id_meme = pic_details.id_meme
// WHERE tagged = 641286114
// GROUP BY pic_details.id_meme";
		$res = mysqli_query($link,$sql);
		if($res){
			while ($rec = mysqli_fetch_assoc($res)){
				$id_memes.=$rec['id_meme'].",";
				$arr[] = $rec;
				
			}
		}
		
	    @mysqli_free_result($res);
	    mysqli_next_result($link);
		
		// takes each id_meme that has user tagged in it and finds OTHER users who are tagged in same meme.
			// maybe an easier way to do it in above MySQL?
		$each_id = explode(',',$id_memes);
		foreach($each_id as $key => $value){
			if ($value){
				$tag_sql = "SELECT tagged FROM memeje__tags WHERE id_meme=".$value;
				$tag_res = mysqli_query($link,$tag_sql);
				
				if ($tag_res){
					$i = 0;
					while($tag_rec = mysqli_fetch_assoc($tag_res)){
						$arr[$key]['who_was_tagged'][] = $tag_rec;
						$arr[$key]['who_was_tagged'][$i]['tag_name'] = json_decode(file_get_contents('http://graph.facebook.com/'.$tag_rec['tagged']))->name;
						$i += 1;
					}
				}
			}
		}		
		
		$this->_output['flg']=2;
	    $this->_output['res']=$arr;
		
		$usr_info=$this->get_user_info();
	    $this->_output['uinfo']=$usr_info;
		
		if($this->arg['gmod']==1){
			$tpl="manage/my_meme_list";
	    } else{
			$tpl=(!$this->_input['last_id'])?"manage/my_meme_details":"manage/loadmore_my_meme";
	    }
	    $this->_output['tpl'] = $tpl;
	}
	
	function _my_favorites(){
	    //check_session();
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
	    $sql = $this->manage_bl->get_search_sql("user",$cond,"id_user,fname,lname,avatar,gender,dupe_username,uid,username");
	    $res = mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
			$user_info[$rec['id_user']] = $rec;
		//$user_info[$rec['id_user']]['friends'] = explode(",",$rec['memeje_friends']);
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
