<?php
if($_REQUEST['choice']=='meme_insert'){
       require_once(APP_ROOT."flexycms/classes/common/facebook-library/facebook.php");
}
class meme_manager extends mod_manager {
	function meme_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'meme');
		$this->obj_meme = new meme;
		$this->meme_bl = new meme_bl;
 	}
	
	function get_module_name() {
		return 'meme';
	}
	
	function get_manager_name() {
		return 'meme';
	}
	
	function _default() {

	}
	
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
########################################################################
########################### SHOWING MEME EDITOR ########################
########################################################################

	function _addMeme(){
	    check_session();
	    $data = $this->_input;
	    if($data['id'])
		$this->_output['idq']=$data['id'];
	    if($data['duel'])
		$this->_output['duel']=$data['duel'];
	    $sql=$this->meme_bl->get_search_sql("premade_images","id_category=0");
	    
	    ############### Updating memeje__page #############

	    $page['maka_a_meme'] = "maka_a_meme+1";
	    //$this->obj_meme->update_this("page",$page," id_page=".$_SESSION['id_page'],1);

	    ###################################################
	    $this->_output['premade_imgs']=getrows($sql,$err);
	    $this->_output['tpl']="meme/addmeme";
	}

########################################################################
###################### GETTING ALL PREMADE IMAGES ######################
########################################################################

	function _get_premade_images(){
	   if($this->_input['id_category']==''){
		exit;
	   }
           $sql=$this->meme_bl->get_search_sql("premade_images","id_category=".$this->_input['id_category']);
           $this->_output['premade_imgs']=getrows($sql,$err);
           $this->_output['tpl']="meme/premade_image";
	}

########################################################################
################### IAMGE UPLOAD TO PREVIEW FOLDER  ####################
########################################################################

	function _upload_image(){
		$uploadDir  = "preview/orig/";
		if ($_FILES['updimage']['name']){
			$fname = $_FILES['updimage']['name'];
			$file_tmp=$_FILES['updimage']['tmp_name'];
			copy($file_tmp, $uploadDir.$fname);
		} else {
			$fpath = $_POST['url'];
			$img_info=pathinfo($fpath);
			$filecon = file_get_contents($fpath);
			$fname=$_SESSION['id_user']."_".time()."_uploaded.".$img_info['extension'];
			$fp=fopen($uploadDir.$fname,"w+");
			fwrite($fp,$filecon);
			fclose($fp);
		}
		ob_clean();
		print $fname;
	}

########################################################################
########################## MEME INSERTATION ############################
########################################################################

	function _meme_insert(){
	    $data = $this->_input['meme'];
	    $path_from = APP_ROOT."spad/workspace/".$_SESSION['id_user']."_img.png";
	    if($data['image']){
		$data['image'] = convert_me($data['image']);
		$tmp_img=explode(".",$data['image']);
		$tmp_img[count($tmp_img)-1]='png';
		$data['image']=implode(".",$tmp_img);
	    }
	    if($this->_input['tagged_user']!=""){
		$taged_user=implode(",",$this->_input['tagged_user']);
		$data['tagged_user']=$taged_user;
	    }
	    $data['ip'] = $notify['ip']=$_SERVER['REMOTE_ADDR'];
	    $data['id_user']=$notify['id_user']= $_SESSION['id_user'];
	    $notify['notification_type'] ='6';
	    
	    ########################## FOR DUEL ############################

	    if($data['duel']){
			unset($data['duel']);
			$idq = $this->get_id_question();
			$idq = ($idq)?$idq:'0';
			$data['id_question'] = $idq;
			$id = $this->obj_meme->insert_all("duel_meme",$data);
			// For tagging user
			if($this->_input['tagged_user']){
				$notify['id_meme']=$id;
				foreach ($this->_input['tagged_user'] as $key => $value) {
					$notify['notified_user'] = $value;
					$notify_id = $this->obj_meme->insert_all("notification",$notify,1);
			   	}
			}
			// End
			$img['image '] = $id."_".$data['image'];
			$this->obj_meme->update_this("duel_meme",$img," id_duel_meme=".$id);
			$path_to = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_orig']."duel/".$img['image '];
			copy($path_from,$path_to);
			//chmod($path_to,777);
			$chk = $this->get_status_duel();
			if($chk['dueler']){
				$duel['own_meme'] = $id;
				$con = "duelled_by = ".$_SESSION['id_user']." AND is_accepted=1";
			}else{
				$duel['duelled_meme'] = $id;
				$duel['duelled_ip'] = $_SERVER['REMOTE_ADDR'];
				$con = "duelled_to = ".$_SESSION['id_user']." AND is_accepted=1";
			}
			$this->obj_meme->update_this("duel",$duel,$con);
			if($chk['own_meme'] || $chk['duelled_meme']){
				$pre_id = ($chk['own_meme'])?$chk['own_meme']:$chk['duelled_meme'];
				$pre_id.=",".$id;
				$this->transfer_duel_to_meme($pre_id);
				$info['is_transfered_to_meme']  = '1';
				$this->obj_meme->update_this("duel_meme",$info," id_duel_meme IN(".$pre_id.")");
			}
			header("Location:".LBL_SITE_URL."meme/dueled_meme");
			exit;
	    }
	    ########################## FOR MEME AND QUESTIONS ############################

	    else{
			$id = $this->obj_meme->insert_all("meme",$data,1);
			// For tagging user
			$notify['id_meme']=$id;
			foreach ($this->_input['tagged_user'] as $key => $value) {
				$notify['notified_user'] = $value;
				$notify_id = $this->obj_meme->insert_all("notification",$notify,1);
		   	}
			// End
			$img['image '] = $id."_".$data['image'];
			$this->obj_meme->update_this("meme",$img," id_meme=".$id);
			$this->update_xp_points($_REQUEST['choice']);
			$this->common_page_update($data['category']);
			if($data['id_question']){
				$inf['is_live'] = 0;
				$this->obj_meme->update_this("meme",$inf," id_meme=".$id);
				$this->image_crop($path_from,"meme/".$img['image ']);
				header("Location:".LBL_SITE_URL."question/answer_to_ques/idq/".$data['id_question']);
			}else{
				$usr_inf = $this->get_user_action_info();
				$this->badges_accd_user_action('exp_point',$usr_inf['exp_point']);
				$this->badges_accd_user_action('id_meme',$usr_inf['no_of_meme']);
				$this->image_crop($path_from,"meme/".$img['image ']);
				$this->post_to_facebook_wall($data['image'],$data['title'],$id);
		    	    header("Location:".LBL_SITE_URL."meme/meme_list/cat/".$data['category']);
			}
			exit;
	    }
		
	}

########################################################################
############################# IAMGE CROPPING ###########################
########################################################################

	function image_crop($path_from,$fname){
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_orig'].$fname;
	    $thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_thumb'].$fname;
	    copy($path_from, $uploadDir);
	    chmod($uploadDir,777);
	    $thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
	    $thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
	    $this->r = new thumbnail_manager($uploadDir,$thumbnailDir);
	    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
	}

########################################################################
############## GETTING DUEL STATUS AND USER FRIENDS ####################
########################################################################

	function get_status_duel(){
	    $sql = $this->meme_bl->get_search_sql("duel"," is_accepted=1","duelled_by,own_meme,duelled_meme,IF(duelled_by=".$_SESSION['id_user'].",1,0) as dueler");
	    $res = getrows($sql,$err);
	    return $res[0];
	}
	
	function get_user_friends(){
		$sql = $this->meme_bl->get_search_sql("user"," id_user=".$_SESSION['id_user'],"memeje_friends");
		$res = getrows($sql, $err);
		$ids = $res['0']['memeje_friends'];
		return $ids;
	}
	
	function get_id_question(){
	    $cond=" AND START_DATE <= CURDATE() AND END_DATE >= CURDATE() ";
	    $sql=$this->meme_bl->get_search_sql("question","1".$cond." LIMIT 1","id_question");
	    $res = getsingleindexrow($sql);
	    return $res['id_question'];
	}
########################################################################
####### TRANSFERING TO MEME WHILE BOTH USERS POST MEME FOR DUEL ########
########################################################################

	function transfer_duel_to_meme($ids){
	    global $link;
	    $sql = get_search_sql("duel_meme"," id_duel_meme IN(".$ids.")");
	    $res= mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
			unset($rec['id_duel_meme']);
			unset($rec['is_transfered_to_meme']);
			$pos = strpos($rec['image'],"_");
			$meme_img = substr($rec['image'],$pos+1);
			$rec['is_duel'] = "1";
			$id = $this->obj_meme->insert_all("meme",$rec);
			$img['image'] = $id."_".$meme_img;
			$this->obj_meme->update_this("meme",$img," id_meme=".$id);
			$path_from = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_orig']."duel/".$rec['image'];
			$this->image_crop($path_from,"meme/".$img['image']);
			@unlink($path_from);
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	}

########################################################################
########################### MEME LISTING  ##############################
########################################################################

	function _meme_list(){
	    check_session();
	    global $link;
	    $limit = $GLOBALS['conf']['PAGINATE']['rec_per_page'];
	    $id_memes='';
	    $data = $this->_input;
	    $srch_cond = "";
	    if($data['muname'])
		$srch_cond = " AND FIND_IN_SET(id_user,(SELECT IF(GROUP_CONCAT(id_user),GROUP_CONCAT(id_user),0) FROM ".TABLE_PREFIX."user WHERE email LIKE '%".$data['muname']."%')) ";
	    if($data['mtitle'])
		$srch_cond.=" AND title LIKE '%".$data['mtitle']."%'";
	    $tp_srt = (isset($data['srt']) && $data['srt']!=1)?" AND view_count > 0 ORDER BY view_count ":" AND (tot_honour-tot_dishonour) > 0 ORDER BY (tot_honour-tot_dishonour)";
	    $frnd_ids = $this->get_user_friends();
	    $frnd_ids = ($frnd_ids)?$frnd_ids:0;
	    $rand_con = " AND IF(id_user=".$_SESSION['id_user'].",1,IF(can_all_view,1,FIND_IN_SET(id_user,'".$frnd_ids."')))";
	    $rand_cat_cond = ($data['rnd_cat'])?" AND category IN(".trim($data['rnd_cat'],',').")":" AND 1";
	    $rand_gen =(isset($data['rand_fg']) && $data['rand_fg']=='1')?" is_live=1 AND id_meme NOT IN(".$data['rnd_ids'].") ":" is_live=1 AND 1 "; 
	    
	    ############ Enhancement on 02-09-2011 #############
	    $ext_cond = (isset($data['ext']))?" AND id_user IN(".$frnd_ids.",".$_SESSION['id_user'].")":" AND 1 ";
	    
	    ############ WHILE SCROLLING DOWN I.E LOADMORE  ########################
	    
	    if($data['last_id']){
		if($data['cat']=='main_feed'){
		    $cond_jn = " is_live=1 ".$rand_con.$ext_cond." AND id_meme < ".$data['last_id'].$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;
		}else{
		    $rand_fg = $data['rand_fg'];
		    $cond_op = $this->get_common_cond($data['cats'],$data['bst'],$data['last_id'],2,$rand_fg);
		    $cond_jn = ($data['cat']=='rand')?
							$rand_gen.$rand_cat_cond.$rand_con.$srch_cond." AND (tot_honour-tot_dishonour) >0 ORDER BY RAND() LIMIT 1"
						     :
						     (
							 ($data['cat']=='top')?
										$cond_op.$rand_con.$srch_cond.$tp_srt." DESC LIMIT ".$limit
									      :
										" id_meme<".$data['last_id'].$rand_con.$srch_cond.$ext_cond." AND category=".$data['cat']." AND is_live=1  ORDER BY id_meme DESC LIMIT ".$limit
						     );
		}
	    }

################ FIRST TIME  NORMAL PAGE LISTING  ###############

	    else{
		if($data['cat']=='main_feed'){
		    $cond_jn = " is_live=1 ".$rand_con.$ext_cond.$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;
		}else{
		    $cond_op = $this->get_common_cond($data['cats'],$data['bst'],'',1);

		    $cond_jn =($data['cat']=='top')?
							$cond_op.$rand_con.$srch_cond.$tp_srt." DESC LIMIT ".$limit
						   :
						   (
							($data['cat']=='rand')?
										$rand_gen.$rand_cat_cond.$rand_con." AND (tot_honour-tot_dishonour) > 0 ORDER BY RAND() LIMIT 1"
									      :
										" category=".$data['cat'].$rand_con.$srch_cond.$ext_cond." AND is_live=1  ORDER BY id_meme DESC LIMIT ".$limit
						   );

		}
		$this->common_page_update($data['cat']);
	    }
	    $sql = $this->meme_bl->get_search_sql("meme",$cond_jn);
	    $res = mysqli_query($link,$sql);
	    if($res){
		while($rec = mysqli_fetch_assoc($res)){
		    $id_memes.=$rec['id_meme'].",";
		    $arr[] = $rec;
		}
	    }
	    @mysqli_free_result($res);
	    mysqli_next_result($link);
	    $id_memes = trim($id_memes,',');
	    $user_info = $this->get_userinfo();
	    $hst_rtd_cap = $this->get_hst_rtd_caption($id_memes);
	    $last_id_meme = $this->get_last_id_meme();
	    $flag = ($data['last_id'])?1:0;
	    $this->_output['flag']=$flag;
	    $this->_output['res_meme']=$arr;
	    $this->_output['rand_fg']=($data['rand_fg'])?1:0;
	    $this->_output['hrc']=$hst_rtd_cap;
	    $this->_output['last_id_meme']=$last_id_meme;
	    $this->_output['last_id']=$data['last_id'];
	    $this->_output['uinfo']=$user_info;
	    $this->_output['cat']=$data['cat'];
	    $this->_output['ext']=$ext;
	    $this->_output['id_memes']=$id_memes;
	    $this->_output['last_idmeme']=$arr[sizeof($arr)-1]['id_meme'];
	    if($data['cat']=='top')
		$tpl = ($data['srch'] || $flag)?'meme/loadmore_top_meme':'meme/top_memelist';
	    elseif($data['cat']=='rand')
		$tpl = ($data['srch'] || $flag)?'meme/loadmore_rand_meme':'meme/random_meme';
	    else
		$tpl = ($flag)?'meme/loadmorememe':'meme/meme_list';
	    $this->_output['tpl'] = $tpl;
	}

########################################################################
### COMMON DYNAMIC FUNCTION TO GENERATE CONDITION FOR MEME LISTING #####
########################################################################

	function get_common_cond($cats,$bst,$ids='',$fg,$rand=''){
	    $date_info = getdate();
	    if($rand)
		    $cond_op = ($rand=='1')?" is_live=1 AND id_meme >".$ids:" is_live=1 AND id_meme <=".$ids;
	    else
		    $cond_op = ($fg==1)?" is_live=1 ":"id_meme NOT IN(".$ids.") AND is_live=1 ";
	    if($cats!='')
		    $cond_op.=" AND FIND_IN_SET(category,'".trim($cats,',')."') ";
	    if($bst){
		if($bst==0)
			$cond_op .= " AND 1 ";
		if($bst==7)
			$cond_op.=" AND add_date BETWEEN DATE_SUB(NOW(),INTERVAL ".$date_info['wday']." DAY) AND NOW() ";
		if($bst==30)
			$cond_op.=" AND DATE_FORMAT(add_date,'%Y-%m') = DATE_FORMAT(NOW(),'%Y-%m') ";
		if($bst==1)
			$cond_op.=" AND DATE_FORMAT(add_date,'%Y-%m-%d') = DATE_FORMAT(NOW(),'%Y-%m-%d') ";
		if($bst==365)
			$cond_op.=" AND DATE_FORMAT(add_date,'%Y')=  DATE_FORMAT(NOW(),'%Y') ";
	    }
	    return $cond_op;
	}

########################################################################
##################### INSERTING MEME AS QUESTION #######################
########################################################################

	function _answer_to_meme(){
	    $data = $this->_input;
	    $arr['id_user'] = $_SESSION['id_user'];
	    $arr['id_meme'] = $data['id'];
	    $arr['reply'] = $data['answer'];
	    $arr['ip'] = $_SERVER['REMOTE_ADDR'];
	    $id = $this->obj_meme->insert_all("reply",$arr,1);

	    $rlp['tot_reply'] = "tot_reply+1";
	    $this->obj_meme->update_this("meme",$rlp," id_meme=".$data['id'],1);
	    
	    $sql = $this->meme_bl->get_search_sql("meme"," id_meme=".$data['id'],"tot_reply");
	    $res= getrows($sql,$err);
	    $tot_peply = $res['0']['tot_reply'];
	    $this->update_xp_points($data['choice']);
	    $usr_inf = $this->get_user_action_info(1);
	    $this->badges_accd_user_action('exp_point',$usr_inf['exp_point']);
	    $this->badges_accd_user_action('reply',$usr_inf['no_of_reply']);
	    print $tot_peply;
	    exit;
	}

########################################################################
##################### UPDATING HONOUR AND DISHONOUR  ###################
########################################################################

	function _set_adaggr(){
	    $data = $this->_input;
	    $sql = $this->meme_bl->get_search_sql("meme"," ( FIND_IN_SET(".$_SESSION['id_user'].",honour_id_user) OR FIND_IN_SET(".$_SESSION['id_user'].",dishonour_id_user) ) AND id_meme=".$data['id_meme']);
	    $captions = getrows($sql, $err);
	    if(!$captions){
		$table_name = "meme";
		$cond = " id_meme=".$data['id_meme'];
		if($data['con']=='A'){
		    $info['tot_honour '] = "tot_honour+1";
		    $info['honour_id_user'] = "IF(honour_id_user='',".$_SESSION['id_user'].",CONCAT(honour_id_user,',','".$_SESSION['id_user']."'))";
		    $this->update_xp_points('honour');
		}else{
		    $info['tot_dishonour'] = "tot_dishonour+1";
		    $info['dishonour_id_user'] = "IF(dishonour_id_user='',".$_SESSION['id_user'].",CONCAT(dishonour_id_user,',','".$_SESSION['id_user']."'))";
		}
		$this->obj_meme->update_this($table_name,$info,$cond,1);
		$col = ($data['con']=='A')?"tot_honour":"tot_dishonour";
		$sql = $this->meme_bl->get_search_sql("meme",$cond,$col);
		$res= getrows($sql,$err);
		$hn[0] = $res['0'][$col];
		$hn[1] = ($data['con']=='A')?"1":"2";
	    }else{
		$hn[0] = 0;
	    }
	    print json_encode($hn);
	    exit;
	}

########################################################################
############ RETRIEVING ALL REPLIES TO MEME WITH NEW REPLY  ############
########################################################################

	function _get_all_replies($id_meme=""){
	    $data = $this->_input;
	    $id = ($id_meme!='')?$id_meme:$data['id'];
	    $sql = $this->meme_bl->get_search_sql("reply"," id_meme=".$id);
	    $replies = getrows($sql, $err);
	    $user_info = $this->get_userinfo();
	    $flag = (isset($data['flag']))?$data['flag']:0;
	    $this->_output['reparr'] = $replies;
	    $this->_output['flag'] =  $flag;
	    $this->_output['uinfo'] = $user_info;
	    $this->_output['id_meme'] = $id;
	    if($id_meme!=''){
		$arr[0] = $replies;
		$arr[1] = $user_info;
		return $arr;
	    }else{
		$this->_output['tpl']="meme/respective_replies";
	    }
	}

########################################################################
############ RETRIEVING MEME INFO(CALLED BY SET TIMEOUT)  ##############
########################################################################

	function _get_all_flag_details(){
	    global $link,$smarty;
	    $id_memes="";
	    $data=$this->_input;
	    $frnd_ids = $this->get_user_friends();
	    $frnd_ids = ($frnd_ids)?$frnd_ids:0;
	    $rand_con = " AND IF(id_user=".$_SESSION['id_user'].",1,(IF(can_all_view,1,FIND_IN_SET(id_user,'".$frnd_ids."'))))";
	    
	    ############ Enhancement on 02-09-2011 #############
	    $ext_cond = (isset($data['ext']) && $data['ext']!=='')?" AND id_user IN(".$frnd_ids.",".$_SESSION['id_user'].")":" AND 1 ";
	    
	    if($data['cat']=='main_feed'){
		$cond_pre = " is_live=1 ".$rand_con.$ext_cond." AND id_meme >=".$data['last_id'];
	    }else{
		$data['page_ids'] =($data['page_ids'])?$data['page_ids']:0;
		$cond_pre = " category=".$data['cat']." AND is_live=1 ".$rand_con.$ext_cond;
		$cond_pre=($data['last_id']!=1)?$cond_pre." AND id_meme IN(".$data['page_ids'].")":$cond_pre;
	    }
	    $cond_meme = " category=".$data['cat']." AND id_meme >".$data['lid']." AND is_live=1 ".$rand_con.$ext_cond;
	    $cond_post=' ORDER BY id_meme DESC ';
	    $cond_meme .=$cond_post;
	    $sql =$this->meme_bl->get_search_sql("meme",$cond_pre.$cond_post);
	    $res = mysqli_query($link,$sql);
	    if($res){
		while($rec = mysqli_fetch_assoc($res)){
		    $id_memes.=$rec['id_meme'].",";
		    $meme[$rec['id_meme']] = $rec;
		}
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    $arr[0] = $meme;
	    $arr[2] = "Nothing";
	    $result= $this->append_more_meme($cond_meme);
	    if($result['ids']!='')
		$id_memes.=$result['ids'];
	    $arr[1] = $this->get_hst_rtd_caption($id_memes);
	    if($result['ids']!=''){
		$user_info = $this->get_userinfo();
		$r['res_meme']=$result['more_meme'];
		$r['uinfo']=$user_info;
		$r['hrc']=$arr[1];
		$this->smarty->assign('sm',$r);
		$arr[2] = $this->smarty->fetch($this->smarty->add_theme_to_template("meme/loadmorememe"));
		$arr[3] = $result['last'];
		$arr[4] = trim($id_memes,",");
	    }
	   print json_encode($arr);exit;
	}

########################################################################
############ RETRIEVING NEW MEME (CALLED BY SET TIMEOUT)  ##############
########################################################################

	function append_more_meme($cond){
	    global $link;
	    $sql = $this->meme_bl->get_search_sql("meme",$cond);
	    $res = mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
		$id_memes.=$rec['id_meme'].",";
		$arr['more_meme'][$rec['id_meme']] = $rec;
		$arr['last'] = $rec['id_meme'];
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    $arr['ids']=trim($id_memes,",");
	    return  $arr;
	}

########################################################################
########################## OTHER COMMON FUNCTIONS   ####################
########################################################################

	function get_userinfo($id_users=""){
	    global $link;
	    $cond = ($id_users!='')?" id_user IN(".$id_users.")":" 1 ";
	    $sql = $this->meme_bl->get_search_sql("user",$cond);
	    $res = mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
		$user_info[$rec['id_user']] = $rec;
		$user_info[$rec['id_user']]['friends'] = explode(",",$rec['memeje_friends']);
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    return $user_info;
	}
	
	function get_hst_rtd_caption($id_memes){
	    $sql = $this->meme_bl->get_max_recs("(select * from ".TABLE_PREFIX."caption order by tot_honour desc) a","id_meme,caption","1 GROUP BY id_meme");
	    $hst_rtd_cap = getindexrows($sql, "id_meme");
	    return $hst_rtd_cap;
	}
	
	function get_last_id_meme(){
	    $sql = $this->meme_bl->get_search_sql("meme"," 1 ORDER BY id_meme DESC LIMIT 1"," id_meme ");
	    $last_id_meme = getrows($sql,$err);
	    return  $last_id_meme[0]['id_meme'];
	}

	function _check_user_answered(){
	    $data = $this->_input;
	    $sql = $this->meme_bl->get_search_sql("meme"," id_question =".$data['idq']." AND id_user =".$_SESSION['id_user']." LIMIT 1"," id_meme ");
	    $res = getrows($sql, $err);
	    $flag = ($res)?"1":"0";
	    print $flag;
	    exit;
	}
	
	function _meme_details(){
	    check_session();
	    $data = $this->_input;
	    if(isset($data['fg']))
		$sql = $this->meme_bl->get_search_sql("duel_meme"," id_duel_meme =".$data['id']." LIMIT 1","*");
	    else
		$sql = $this->meme_bl->get_search_sql("meme"," id_meme =".$data['id']." LIMIT 1","*");
	    $res = getrows($sql, $err);
	    if(!isset($data['fg'])){
		$mem['view_count'] = "view_count+1";
		$this->obj_meme->update_this("meme",$mem," id_meme=".$data['id'],1);
		$rep_det = $this->_get_all_replies($data['id']);
	    }
	    $hst_rtd_cap = $this->get_hst_rtd_caption($res[0]['id_meme']);
	    $this->_output['hrc']=$hst_rtd_cap;
	    $this->_output['fg'] = (isset($data['fg']))?1:0;
	    $this->_output['det_meme'] = $res[0];
	    $this->_output['rep_det'] = $rep_det[0];
	    $this->_output['uinfo'] = $rep_det[1];
	    $tpl = (isset($data['fb']))?"meme/from_fb_meme":"meme/meme_details";
	    $this->_output['tpl'] = $tpl;
	}
	
	function common_page_update($cat){
	    switch ($cat){
		case 1:
		    $page['funny'] = "funny+1";
		    break;
		case 2:
		    $page['love '] = "love +1";
		    break;
		case 3:
		    $page['trees'] = "trees+1";
		    break;
		case 4:
		    $page['everyday'] = "everyday+1";
		    break;
		case 'top':
		    $page['top_memes'] = "top_memes+1";
		    break;
		case 'rand':
		    $page['random'] = "random+1";
		    break;
		case 'main_feed':
		    $page['main_feed'] = "main_feed+1";
		    break;
		case 'network_feed':
		    $page['network_feed'] = "network_feed+1";
		    break;
	    }
	   // $this->obj_meme->update_this("page",$page," id_page=".$_SESSION['id_page'],1);
	}
	
	function update_xp_points($ch){
	    $sql = $this->meme_bl->get_search_sql("allotpoints"," point_type='".$ch."'","points");
	    $res = getrows($sql,$err);
	    if($res){
		$info['exp_point']  = 'exp_point+'.$res[0]['points'];
		$this->obj_meme->update_this("user",$info," id_user=".$_SESSION['id_user'],1);
	    }
	}
	
	function badges_accd_user_action($tpype,$no){
	    $cond = " badge_type='".$tpype."'";
		switch ($tpype){
		    case 'exp_point':
			$cond .= " AND badge_type_number < ".$no;
			break;
		    case 'id_meme':
			$cond .= " AND badge_type_number = ".$no;
			break;
		    case 'reply':
			$cond .= " AND badge_type_number = ".$no;
			break;
		    case 'ques_week_won':
			$cond .= " AND badge_type_number = ".$no;
			break;
		    case 'duels_won':
			$cond .= " AND badge_type_number = ".$no;
			break;
		}
	    $sql = $this->meme_bl->get_search_sql("badge",$cond,"id_badge");
	    $res = getrows($sql,$err);
	    $id_badge = $res[count($res)-1]['id_badge'];
	    if($id_badge){
		$badge['no_badges'] = 'no_badges+1';
		$this->obj_meme->update_this("user",$badge,"id_user=".$_SESSION['id_user'],1);
		$this->obj_meme->update_diff_data("id_badges","user","id_user=".$_SESSION['id_user'],$id_badge);
		// Achievement Rank
		$sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user ORDER BY no_badges DESC ) t WHERE id_user=".$_SESSION['id_user'];
		$res_ach=getsingleindexrow($sql_ach);
		
		$_SESSION['achv_rank']=$res_ach['POSITION'];
		// End
	    }
	}
	
	function get_user_action_info($fg=""){
		###### reply count ######
	    if($fg){
		$sql3 = $this->meme_bl->get_search_sql("reply","id_user=".$_SESSION['id_user'],"COUNT(*) no_of_reply");
		$res = getrows($sql3, $err);
		$arr['no_of_reply'] = $res[0]['no_of_reply'];
	    }else{
		###### no_of_meme count ######
		$sql2 = $this->meme_bl->get_search_sql("meme","id_user=".$_SESSION['id_user'],"COUNT(*) no_of_meme");
		$res = getrows($sql2, $err);
		$arr['no_of_meme'] = $res[0]['no_of_meme'];
	    }
		###### exp_point ######
		$sql1 = $this->meme_bl->get_search_sql("user","id_user=".$_SESSION['id_user'],"exp_point");
		$res = getrows($sql1, $err);
		$arr['exp_point'] = $res[0]['exp_point'];
	    return $arr;
	}

########################################################################
############ PODTING TO FACEBOOK WALL WHILE INSERTING ONE MEME #########
########################################################################

	function post_to_facebook_wall($name,$description,$id){
               $arr=$this->decrypt_fb_data();
               $facebook = $arr[0];
               $data = $arr[1];
               $uid=$data['uid'];
	       $description = $description;
	       $src = LBL_SITE_URL.'image/thumb/meme/'.$id."_".$name;
	       $href = LBL_SITE_URL.'meme/meme_details/id/'.$id."/fb/1";
               $video='';
               if($name) {
                       $attachment = array('name' => $name, 'href' =>$href, 'caption' =>'', 'description' => '', 'properties' => array(),'media' => array(array('type' => 'image', 'src' =>$src, 'href' => $href)));
               }elseif($video) {
                       $attachment = array('name' => '', 'href' => '', 'caption' =>'', 'description' => '', 'properties' => array(),'media' => array(array('type' => 'flash', 'swfsrc' =>$video , 'imgsrc' => $imgsrc,"width" => "80","height" => "60", "expanded_width" => "160", "expanded_height" => "120")));
               }else {
                       $attachment='';
               }
               $facebook->api_client->stream_publish($description,$attachment,'','',$uid);
	}
	
	function decrypt_fb_data(){
	       $api_key=$GLOBALS['conf']['FACEBOOK']['api_key'];
	       $secret=$GLOBALS['conf']['FACEBOOK']['secret_key'];
	       $app_id=$GLOBALS['conf']['FACEBOOK']['app_id'];
	       $arr = explode('&',trim(stripslashes($_REQUEST['fbs_'.$app_id]),'"'));
	       foreach($arr as $k => $v){
		       $key = substr($v,0,strpos($v,'='));
		       $val = substr($v,strpos($v,'=')+1);
		       $data[$key] = $val;
	       }
	       $session_key = $data['session_key'];
	       $arr[0] = new Facebook($api_key,$secret,$session_key);
	       $arr[1] = $data;
	       return $arr;
	}

########################################################################
############################ MEME FLAGGING #############################
########################################################################

	function _flagging_meme(){
	   if($this->_input['chk']){
	       $sql = $this->meme_bl->get_search_sql("flag"," id_user=".$_SESSION['id_user']." AND id_meme=".$this->_input['id'],"id_flag");
	       $fg = (getrows($sql, $err))?1:0;
	       print $fg;
	   }else{
	       $flag_info['id_user'] = $_SESSION['id_user'];
	       $flag_info['id_meme'] = $this->_input['id'];
	       $flag_info['ip'] = $_SERVER['REMOTE_ADDR'];
	       $this->obj_meme->insert_all("flag",$flag_info,1);

	       /*	
			//Admin email from db
			$sql_admin = $this->meme_bl->get_search_sql("user"," id_admin GROUP BY id_admin","GROUP_CONCAT(email) as email");
			$res = getrows($sql_admin,$err);
			$admin_email=$res[0]['email'];
	       */
	       $admin_email=$GLOBALS['conf']['SITE_ADMIN']['email'];	

	       $sql = $this->meme_bl->get_search_sql("meme"," id_meme=".$this->_input['id']." LIMIT 1","title,image,category");
	       $meme_inf = getrows($sql,$err);
	       $cat = $GLOBALS['conf']['CATEGORY'][$meme_inf[0]['category']];
	       $this->smarty->assign('sm',$meme_inf[0]);
	       $this->smarty->assign('cat',$cat);	
	       $body = $this->smarty->fetch($this->smarty->add_theme_to_template("meme/mail_flag"));
	       $subject = "Flagging of meme.";
	//  exit;
	       sendmail($admin_email, $subject, $body,$_SESSION['email']);
	   }
	}

	function _twitter(){
			print json_encode("1");exit;
	}
	
	function _auto_comp(){
	    if($this->_input['flg'])
		     $sql=$this->meme_bl->get_search_sql("meme","title like '%".$this->_input[q]."%'","title");
	    else
		    $sql=$this->meme_bl->get_search_sql("user","email like '%".$this->_input[q]."%' AND id_admin !=1","email");
	    $res=getrows($sql,$err);
	    $this->_output['res']=$res;
	    $this->_output['tpl'] ="meme/auto_comp";
	}
	
	function _dueled_meme(){
	    $sql=$this->meme_bl->get_search_sql("duel","((duelled_by =".$_SESSION['id_user']." OR duelled_to =".$_SESSION['id_user'].") AND is_accepted=1)","CONCAT(GROUP_CONCAT(duelled_to),',',GROUP_CONCAT(duelled_by)) users");
	    $res = getsingleindexrow($sql);
	    $fg=0;
	    if(isset($res['users'])){
		$fg=1;
		$user_info= $this->get_userinfo($res['users']);
		$sql=$this->meme_bl->get_search_sql("duel_meme"," id_user IN(".$res['users'].")");
		$meme_info_tmp = getindexrows($sql,"id_user");
		$sql=$this->meme_bl->get_search_sql("meme"," id_user IN(".$res['users'].")");
		$meme_info = getindexrows($sql,"id_user");
	    }
	    $this->_output['fg']=$fg;
	    $this->_output['user_info']=$user_info;
	    $this->_output['meme_info_tmp']=$meme_info_tmp;
	    $this->_output['meme_info']=$meme_info;
	    $this->_output['tpl']="meme/dueled_meme";
	}
}
