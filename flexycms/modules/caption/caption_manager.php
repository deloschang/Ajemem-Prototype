<?php
class caption_manager extends mod_manager {
	function caption_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'caption');
		$this->obj_caption = new caption;
		$this->caption_bl = new caption_bl;
 	}
	function get_module_name() {
		return 'caption';
	}
	function get_manager_name() {
		return 'caption';
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
################### CAPTION LISTING WITH ADD NEW CAPTION ###############
########################################################################
	
	function _add_caption(){
	    global $link;
	    $cond='';
	    $data = $this->_input;
	    $c=1;
	    $user_info = $this->get_user_info();
	    $cond = ($data['id_meme'])?$data['id_meme']." AND id_caption<".$data['id_cap']:$data['id'];
	    $sql = $this->caption_bl->get_search_sql("caption"," id_meme=".$cond." ORDER BY id_caption DESC LIMIT 10 ","*,IF(TIMESTAMPDIFF(SECOND,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(SECOND,add_date,NOW()),' secs'),(IF(TIMESTAMPDIFF(MINUTE,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(MINUTE,add_date,NOW()),' mins'),(IF(TIMESTAMPDIFF(HOUR,add_date,NOW()) BETWEEN 0 AND 24,CONCAT(TIMESTAMPDIFF(HOUR,add_date,NOW()),' hours'),CONCAT(TIMESTAMPDIFF(DAY,add_date,NOW()),' days')))))) AS timesago");
	    $res = mysqli_query($link,$sql);
	    if($res){
		while($rec=  mysqli_fetch_assoc($res)){
			$captions[] = $rec;
			if($c==1)
			$last_cap = $rec['id_caption'];
			$c++;
		}
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    $flag = ($data['id_meme'])?1:0;
	    $fg_rnd = (isset($data['flag']))?1:0;
	    $id_meme = ($data['id_meme'])?$data['id_meme']:$data['id'];
	    $this->_output['id']=$id_meme;
	    $this->_output['flag']=$flag;
	    $this->_output["last_id"]=$captions[sizeof($captions)-1]['id_caption'];
	    $this->_output["captions"]=$captions;
	    $this->_output["lst_cap"]=$last_cap;
	    $this->_output["user_info"]=$user_info;
	    if($flag){
		   $this->_output['tpl']=($fg_rnd)?"caption/rand_loadmore_caption":"caption/loadmore_caption";
	    }
	    else{
		    $page['add_caption'] = "add_caption+1";
		    //$this->obj_caption->update_this("page",$page," id_page=".$_SESSION['id_page'],1);
		    $this->_output['tpl']=($fg_rnd)?"caption/rand_add_caption":"caption/add_caption";
	    }
	}

########################################################################
################ INSERTING CAPTIONS AND APPEND TO LISTING ##############
########################################################################
	
	function _insert_caption(){
	    $RQ = $_REQUEST;
	    $data['caption'] = $RQ['caption'];
	    $data['id_meme'] = $RQ['id_meme'];
	    $data['ip'] = $_SERVER['REMOTE_ADDR'];
	    $data['id_user'] = $_SESSION['id_user'];
	    $id = $this->obj_caption->insert_all("caption",$data,1);
	    $cnod = (isset($RQ['flag']))?1:0;
	    $meme_update['tot_caption'] = "tot_caption+1"; 
	    $meme_update['id_captions'] = "IF(id_captions='',".$id.",CONCAT(id_captions,',','".$id."'))"; 
	    $this->obj_caption->update_this("meme",$meme_update," id_meme=".$data['id_meme'],1);
	    $sql = $this->caption_bl->get_search_sql("meme"," id_meme=".$data['id_meme'],"tot_caption");
	    $tot_cap = getrows($sql,$err);
	    $sql = $this->caption_bl->get_search_sql("caption"," id_caption=".$id." LIMIT 1 ","*,IF(TIMESTAMPDIFF(SECOND,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(SECOND,add_date,NOW()),' secs'),(IF(TIMESTAMPDIFF(MINUTE,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(MINUTE,add_date,NOW()),' mins'),(IF(TIMESTAMPDIFF(HOUR,add_date,NOW()) BETWEEN 0 AND 24,CONCAT(TIMESTAMPDIFF(HOUR,add_date,NOW()),' hours'),CONCAT(TIMESTAMPDIFF(DAY,add_date,NOW()),' days')))))) AS timesago");
	    $res = getrows($sql,$err);
	    $sql = $this->caption_bl->get_search_sql("user"," id_user=".$_SESSION['id_user']." LIMIT 1","id_user,fname,lname,avatar");
	    $user_info = getrows($sql,$err);
	    $this->update_xp_points($RQ['choice']);
	    $this->_output['res'] = $res[0];
	    $this->_output['totcap'] = $tot_cap[0]['tot_caption'];
	    $this->_output['id_meme'] = $data['id_meme'];
	     $this->_output["user_info"]=$user_info[0];
	    $this->_output['tpl'] =($cnod)?"caption/rand_response_caption":"caption/response_caption";
	}
	
########################################################################
############## UPDATING HONOUR AND DISHONOUR OF CAPTIONS ###############
########################################################################
	
	function _update_hnr_dishnr(){
	    global $link;
	    $data = $_REQUEST;
	    $sql = $this->caption_bl->get_search_sql("caption"," (FIND_IN_SET(".$_SESSION['id_user'].",honour_id_user) OR FIND_IN_SET(".$_SESSION['id_user'].",dishonour_id_u)) AND id_caption=".$data['id_cap']);
	    $captions = getrows($sql, $err);
	    if(!$captions){
		$table_name = "caption";
		$cond = " id_caption=".$data['id_cap'];
		if($data['flag']=='Honour'){
		    $info['tot_honour'] = "tot_honour+1";
		    $info['honour_id_user'] = "IF(honour_id_user='',".$_SESSION['id_user'].",CONCAT(honour_id_user,',','".$_SESSION['id_user']."'))";
		}else{
		    $info['tot_dishonour'] = "tot_dishonour+1";
		    $info['dishonour_id_u'] = "IF(dishonour_id_u='',".$_SESSION['id_user'].",CONCAT(dishonour_id_u,',','".$_SESSION['id_user']."'))";
		}
		$this->obj_caption->update_this($table_name,$info,$cond,1);
		$col = ($data['flag']=='Honour')?"tot_honour":"tot_dishonour";
		$sql = $this->caption_bl->get_search_sql($table_name,$cond,$col);
		$res= getrows($sql,$err);
		$hn[0] = $res['0'][$col];
		$hn[1] = ($data['flag']=='Honour')?"1":"2";
	    }else{
		$hn[0]=0;
	    }
	    print json_encode($hn);
	    exit;
	}
	
########################################################################
####### RETRIEVING THE CAPTIONS ADD TIME(CALLED BY SET TIMEOUT)#########
########################################################################
	
	function _get_all_time(){
	    global $link,$smarty;
	    $data = $this->_input;
	    $cond = "id_meme=".$data['id_meme'];
	    if($data['id_cap']!=-1)
		    $cond.= " AND id_caption >=".$data['id_cap'];
	    $cond .=" ORDER BY id_caption DESC";
	    $sql = $this->caption_bl->get_search_sql("caption",$cond,"id_caption,caption,id_user,tot_honour,tot_dishonour,IF(TIMESTAMPDIFF(SECOND,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(SECOND,add_date,NOW()),' secs'),(IF(TIMESTAMPDIFF(MINUTE,add_date,NOW()) BETWEEN 0 AND 59,CONCAT(TIMESTAMPDIFF(MINUTE,add_date,NOW()),' mins'),(IF (TIMESTAMPDIFF(HOUR,add_date,NOW()) BETWEEN 0 AND 24,CONCAT(TIMESTAMPDIFF(HOUR,add_date,NOW()),' hours'),CONCAT(TIMESTAMPDIFF(DAY,add_date,NOW()),' days')))))) AS timesago");
	    $res = mysqli_query($link,$sql);
	    if($res){
		while($rec=  mysqli_fetch_assoc($res)){
			$c=1;
			$times[] = $rec;
			if($rec['id_caption'] > $data['last_cap']){
			    $more_cap['cap'][$rec['id_caption']]=$rec;
			    if($c==1)
				$more_cap['last_cap'] = $rec['id_caption'];
			    $more_cap['last_cappage'] = $rec['id_caption'];
			}
			$c++;
		}
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
	    if($more_cap){
		$uinfo = $this->get_user_info();
		$cap['captions'] = $more_cap['cap'];
		$cap['user_info'] = $uinfo;
		$smarty->assign('sm',$cap);
		$arr[0] = $this->smarty->fetch($this->smarty->add_theme_to_template("caption/loadmore_caption"));
	    }
	    $arr[1] = $times;
	    $arr[2] = $more_cap['last_cap'];
	    $arr[3] = $more_cap['last_cappage'];
	    print json_encode($arr);exit;
	}
	
########################################################################
######## COMMON FUNCTION USED IN CAPTION LISTING TO GET USERINFO #######
########################################################################
	
	function get_user_info(){
	    $sql = $this->caption_bl->get_search_sql("user","1","id_user,fname,lname,avatar");
	    $user_info = getindexrows($sql,"id_user");
	    return $user_info;
	}
	
########################################################################
#### COMMON FUNCTION USED IN CAPTION LISTING TO UPDATE EXP. POINTS #####
########################################################################
	
	function update_xp_points($ch){
	    $sql = $this->caption_bl->get_search_sql("allotpoints"," point_type='".$ch."'","points");
	    $res = getrows($sql,$err);
	    $info['exp_point']  = 'exp_point+'.$res[0]['points'];
	    $this->obj_caption->update_this("user",$info," id_user=".$_SESSION['id_user'],1);
	}

}

?>
