<?php
class leaderboard_manager extends mod_manager {
	function leaderboard_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'leaderboard');
		$this->obj_leaderboard = new leaderboard;
		$this->leaderboard_bl = new leaderboard_bl;
 	}
	function get_module_name() {
		return 'leaderboard';
	}
	function get_manager_name() {
		return 'leaderboard';
	}
	function _default() {

	}
	function _phpinfo(){
	    phpinfo();
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	function _leaderboard(){
	    check_session();
	    $arr['leaderboard']="leaderboard+1";
	    $cond="id_page= ".$_SESSION['id_page'];
	   // $this->obj_leaderboard->update_this("page", $arr, $cond,1);
	    $sss='';
	    if($this->_input['uname']){
		$sql="SELECT id_user FROM ".TABLE_PREFIX."user WHERE email='".$this->_input['uname']."' LIMIT 1";
		$res=getrows($sql,$err);
		if($res[0]['id_user']){
		    $sss="0";
		    $arr1['who']=$_SESSION['id_user'];
		    $arr1['whom']=$res[0]['id_user'];
		    $arr1['type']="Search";
		    $arr1['ip']=$_SERVER['REMOTE_ADDR'];
		    //$id_user_vs_user=$this->obj_leaderboard->insert_all("user_vs_user",$arr1,1);
		}else{
		    $sss="1";
		}
		$this->_output['uname']=$this->_input['uname'];
		$this->_output['id_user']=$res[0]['id_user'];
		$this->_output['lb_flag']=$this->_input['lb_flag'] ? $this->_input['lb_flag'] :"duels";
		$this->_output['tpl']="leaderboard/leaderboard_listall";
		$this->_output['search1']=$sss;
	    }else{
		$this->_output['lb_flag']=$this->_input['lb_flag'] ? $this->_input['lb_flag'] :"duels";
		$this->_output['search']=$sss;
		$this->_output['tab']=$this->_input['tab']?$this->_input['tab']:1;
		$this->_output['tpl']="leaderboard/leaderboard_search";
	    }
	}
	function _lb_duels($q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'leaderboard/lb_duels';
	    $sql=get_search_sql("user","id_admin !=1");
	    if($this->_input['chk']) {
		if($this->_input['uname']!=''){
		    //$uri .= "/uname/".$this->_input['uname'];
		     $sql1="SELECT id_user FROM ".TABLE_PREFIX."user WHERE email='".$this->_input['uname']."'";
		     $res=getrows($sql1, $err);
		     $id_user=$res[0]['id_user'];
		     if($res){
			//$sql_duels="SET @i=0;SELECT id_user, @i:=@i+1 AS POSITION FROM memeje__user  WHERE id_user=".$res[0]['id_user']." ORDER BY duels_won DESC LIMIT 1";
			//$sql_duels="SET @i=0;SELECT *, @i:=@i+1 AS pos FROM (SELECT id_user FROM memeje__user ORDER BY duels_won DESC ) t WHERE 1;";
			//$sql_duels=" SET @i=0;SELECT *, @i:=@i+1 AS pos FROM (SELECT * FROM memeje__user ) t WHERE id_user=".$res[0]['id_user']." order by duels_won  desc";   
			$sql_duels="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY duels_won DESC ) t WHERE id_user=$id_user";    
			$res_duels=getrows($sql_duels,$err);
			$pos_duels=$res_duels[0]['POSITION'];
		     }
		    $limit=7;
		    $qstart_duels=$pos_duels/$limit;
		    if($qstart_duels<1){
			$qstart_duels=0;
		    }else if($pos_duels%$limit==0){
			$qstart_duels=($qstart_duels-1)*$limit;
		    }else{
			$qstart_duels=floor($qstart_duels)*$limit;
		    }
		    $qstart=$qstart_duels;
		}
	    }
	    $this->_output['field'] = array("id_user" => array("id_user", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = 7;//$GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] ="duels_won";
	    $this->_output['sort_order'] = "DESC";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart']=$qstart;
	    $_REQUEST['qstart'] =$qstart;// $this->_input['qstart'];
	    $_REQUEST['choice'] ="lb_duels";
	    $this->_output['id_user']=$id_user;
	    $this->leaderboard_bl->page_listing($this, "leaderboard/duels_list");
	}
	
	function _lb_exp_point($q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'leaderboard/lb_exp_point';
	    $sql=get_search_sql("user","id_admin !=1");
	    if($this->_input['chk']) {
		if($this->_input['uname']!=''){
		    //$uri .= "/uname/".$this->_input['uname'];
		     $sql1="SELECT id_user FROM ".TABLE_PREFIX."user WHERE email='".$this->_input['uname']."'";
		    // print $sql;
		     $res=getrows($sql1, $err);
		     $id_user=$res[0]['id_user'];
		     if($res){
			$sql_exp="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=$id_user";    
			$res_exp=getrows($sql_exp,$err);
			$pos_exp=$res_exp[0]['POSITION'];
		     }
		    $limit=7;
		    $qstart_exp=$pos_exp/$limit;
		    if($qstart_exp<1){
			$qstart_exp=0;
		    }else if($pos_exp%$limit==0){
			$qstart_exp=($qstart_exp-1)*$limit;
		    }else{
			$qstart_exp=floor($qstart_exp)*$limit;
		    }
		    $qstart=$qstart_exp;
		}
	    }
	    $this->_output['field'] = array("id_user" => array("id_user", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = 7;//$GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] ="exp_point";
	    $this->_output['sort_order'] = "DESC";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['qstart'] =$qstart;
	    $this->_output['id_user']=$id_user;
	    $_REQUEST['choice'] =lb_exp_point;
	    $this->leaderboard_bl->page_listing($this, "leaderboard/exp_list");
	    /*if($this->_input['chk'] && $this->_input['uname']){
		$this->_output['id_user']=$id_user;
		$this->_output['tpl']="leaderboard/exp_list1";
	    }else{
	     $this->leaderboard_bl->page_listing($this, "leaderboard/exp_list");
	    }*/
	    
	    
	}
	function _lb_ques_won(){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'leaderboard/lb_ques_won';
	    $sql=get_search_sql("user","id_admin !=1");
	    if($this->arg['chk']) {
		if($this->arg['iduser']!=''){
		    $sql_ques="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY ques_week_won DESC ) t WHERE id_user='".$this->arg['iduser']."'";    
		    $res_ques=getrows($sql_ques,$err);
		    $pos_ques=$res_ques[0]['POSITION'];
		}
		$limit=7;
		$qstart_ques=$pos_ques/$limit;
		if($qstart_ques<1){
		    $qstart_ques=0;
		}else if($pos_ques%$limit==0){
		    $qstart_ques=($qstart_ques-1)*$limit;
		}else{
		    $qstart_ques=floor($qstart_ques)*$limit;
		}
		$qstart=$qstart_ques;
	    }
	    $this->_output['field'] = array("id_user" => array("id_user", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = 7;//$GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] ="ques_week_won";
	    $this->_output['sort_order'] = "DESC";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['qstart'] =$qstart;
	    $this->_output['id_user']=$this->arg['iduser'];
	    $_REQUEST['choice'] =lb_ques_won;
	    $this->leaderboard_bl->page_listing($this, "leaderboard/ques_week_won_list");
	    
	}
	function _lb_achievements($q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'leaderboard/lb_achievements';
	    $sql=get_search_sql("user","id_admin !=1");
	    if($this->arg['chk']) {
		if($this->arg['iduser']!=''){
		    $sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY no_badges DESC ) t WHERE id_user='".$this->arg['iduser']."'";    
		    $res_ach=getrows($sql_ach,$err);
		    $pos_ach=$res_ach[0]['POSITION'];
		}
		$limit=7;
		$qstart_ach=$pos_ach/$limit;
		if($qstart_ach<1){
		    $qstart_ach=0;
		}else if($pos_ach%$limit==0){
		    $qstart_ach=($qstart_ach-1)*$limit;
		}else{
		    $qstart_ach=floor($qstart_ach)*$limit;
		}
		$qstart=$qstart_ach;
	    }
	    $this->_output['field'] = array("id_user" => array("id_user", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = 7;//$GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] ="no_badges";
	    $this->_output['sort_order'] = "DESC";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['qstart'] =$qstart;
	    $this->_output['id_user']=$this->arg['iduser'];
	    $_REQUEST['choice'] =lb_achievements;
	    $this->leaderboard_bl->page_listing($this, "leaderboard/achievements_list");
	}
	function _auto_comp(){
	    $sql=$this->leaderboard_bl->get_search_sql("user","email like '%".$this->_input[q]."%' AND id_admin !=1","email");
	    $res=getrows($sql,$err);
	    if($res){
		$this->_output['res']=$res;
		$this->_output['tpl'] ="leaderboard/auto_comp";
	    }
	}
	function _show_profile(){
	    $sql_reqst_by_other="SELECT id_frnd_request,requested_to,req_status as req_oth FROM ".TABLE_PREFIX."frnd_request WHERE requested_to=".$_SESSION['id_user']." AND requested_by=".$this->_input['id']." AND req_status !=2";
	    $res_reqst_by_other=getrows($sql_reqst_by_other,$err);
	    $sql_reqst_to="SELECT id_frnd_request,requested_by,req_status FROM ".TABLE_PREFIX."frnd_request WHERE requested_to='".$this->_input['id']."' AND requested_by='".$_SESSION['id_user']."' AND req_status !=2";
	   // print $sql_reqst_to;
	    $res_reqst_to=getsingleindexrow($sql_reqst_to);
	    
	    $sql=$this->leaderboard_bl->get_search_sql("user","id_user=".$this->_input['id'],"*");
	    //print $sql;exit;
	    $res=getrows($sql,$err);
	    //$sql_frd=$this->leaderboard_bl->get_search_sql("user","id_user=".$_SESSION['id_user']." AND if (FIND_IN_SET('".$this->_input['id']."',rec_fd_request),1,0)","rec_fd_request"); 
	    //print $sql_frd;
	   /* $res_frd=getsingleindexrow($sql_frd);
	    if($res_frd['rec_fd_request']){
		$this->_output['frd']='1';
	    }*/
	    if($res_reqst_to){
		$this->_output['reqst_to']=$res_reqst_to;
	    }
	    if($res_reqst_by_other){
		$this->_output['request_by_oth']=$res_reqst_by_other;
	    }
	    $sql_duels="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY duels_won DESC ) t WHERE id_user=".$this->_input['id'];
	    $sql_ach="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY no_badges DESC ) t WHERE id_user=".$this->_input['id'];
	    $sql_exp="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY exp_point DESC ) t WHERE id_user=".$this->_input['id'];
	    $sql_ques="SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."user WHERE id_admin!=1 ORDER BY ques_week_won DESC ) t WHERE id_user=".$this->_input['id']; 
	    $res_duels=getsingleindexrow($sql_duels);
	    $res_ach=getsingleindexrow($sql_ach);
	    $res_exp=getsingleindexrow($sql_exp);
	    $res_ques=getsingleindexrow($sql_ques);
	    $this->_output['ach']=$res_ach['POSITION'];
	    $this->_output['duels']=$res_duels['POSITION'];
	    $this->_output['exp']=$res_exp['POSITION'];
	    $this->_output['ques']=$res_ques['POSITION'];
	    $this->_output['res']=$res;
	    $this->_output['nofrndbtn']=$this->_input['nofrndbtn'];
	    $this->_output['tpl']="leaderboard/show_profile";
	}
	function _addFriend(){
	    $arr['requested_by']=$notify['id_user']=$_SESSION['id_user'];
	    $arr['requested_to']=$notify['notified_user']=$this->_input['id'];
	    $arr['ip']=$notify['ip']=$_SERVER['REMOTE_ADDR'];
		$notify['notification_type'] = '5';
	    $fd_id=$this->obj_leaderboard->insert_all("frnd_request",$arr,1);
		$notify_id = $this->obj_leaderboard->insert_all("notification",$notify,1);
	    if($fd_id){
		print "1";
	    }
	}
   	function _privateMessaging(){
		$this->_output['tpl']="leaderboard/privatemessage";
	}
}
