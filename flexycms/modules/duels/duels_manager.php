<?php
class duels_manager extends mod_manager {
	function duels_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'duels');
		$this->obj_duels = new duels;
		$this->duels_bl = new duels_bl;
 	}
	function get_module_name() {
		return 'duels';
	}
	function get_manager_name() {
		return 'duels';
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
	function _invitefriends(){
		if($this->_input['flag_duel']){
			$this->_output['duel_flag']=$this->_input['flag_duel'];
		}
	    $this->_output['tpl']="duels/invitefriends";
		
	}
	function  _getfriends(){
	    global $link;
	    $sent_usrs = $this->sent_users();
		$sent_usrs = ($sent_usrs)?$sent_usrs:0;
		$cond = ($sent_usrs)?" AND id_user NOT IN(".$sent_usrs.")":"";

		//its for tagging triends 
		if($this->_input['flg']){
			$sql_frnd = $this->duels_bl->get_search_sql("user"," id_user=".$_SESSION['id_user'],"memeje_friends");
			$res_frnd=getrows($sql_frnd,$err);
			$sql = $this->duels_bl->get_search_sql("user","id_user IN(".$res_frnd[0]['memeje_friends'].") ");
		//end
		}else{
			//for check user alerady accept duel request
			$sql_is_accept=$this->duels_bl->get_search_sql("duel","(duelled_by IN(".$_SESSION['id_user'].") OR duelled_to IN(".$_SESSION['id_user'].")) AND is_accepted=1 ","is_accepted");
			$res_is_accept=getsingleindexrow($sql_is_accept);
				if($res_is_accept){
					print "1";exit;
				//end
				}else{
					$sql = $this->duels_bl->get_search_sql("user"," id_user<>".$_SESSION['id_user']." AND id_admin<>1 ".$cond." AND id_user in(".$_SESSION['friends'].")");
				}
	   	}
	 	$res = mysqli_query($link,$sql);
	    while($rec= mysqli_fetch_assoc($res)){
			$img_nm = ($rec['avatar'])?$rec['avatar']:(($rec['gender']='M')?"memeje_male.jpg":"memeje_female.jpg");
			$img = "<img src='".LBL_SITE_URL."image/thumb/avatar/".$img_nm."' style='width:40px;height:40px;'/>";
			$arr[] = array("name"=>$rec['fname'],"value"=>$rec['id_user'],"lname"=>$rec['lname'],"pf_img"=>$img);
	    }
	    mysqli_free_result($res);
	    mysqli_next_result($link);
		if(!$arr && $this->_input['flg_duel']){
			print "1";exit;
		}
	    print json_encode($arr);exit;
	}
	function sent_users(){
		/* FOR user can duel multiple 
			$sql = $this->duels_bl->get_search_sql("duel","duelled_by=".$_SESSION['id_user'],"GROUP_CONCAT(duelled_to) users");
		*/
		//for user can duel once	    
		$sql = $this->duels_bl->get_search_sql("duel","((duelled_by=".$_SESSION['id_user']." OR duelled_to=".$_SESSION['id_user'].") AND is_ignored <>1) OR (((duelled_by IN(".$_SESSION['friends'].") OR duelled_to IN(".$_SESSION['friends'].")) AND is_ignored <>1 )AND is_accepted=1)","concat(GROUP_CONCAT(duelled_to),',',GROUP_CONCAT(duelled_by)) users");
	    $res = getrows($sql,$err);
	    return $res[0]['users'];
	}
	function _send_duelinvitation_to(){
	    $data = $_REQUEST;
	    $arr['duelled_by'] = $notify['id_user'] =$_SESSION['id_user'];
	    $arr['own_ip'] =$notify['ip']=$_SERVER['REMOTE_ADDR'];
	    $notify['notification_type'] = '2';
	    foreach ($data['ids'] as $key => $value) {
		$arr['duelled_to'] = $notify['notified_user'] = $value;
		$id = $this->obj_duels->insert_all("duel",$arr,1);
		$notify_id = $this->obj_duels->insert_all("notification",$notify,1);
	    }
	    $this->_mail_notification($data['ids'],"invited_duel");
	}
	
	function _list_duels($x=''){
	    check_session();
	    $id_user=$_SESSION['id_user'];
	    $sql_active="SELECT a.fname as duelledto_name,a.id_user as duelledto_id_user,a.avatar as duelledto_avatar ,c.fname as duelledby_name,c.id_user as duelledby_id_user,c.avatar as duelledby_avatar,b.* FROM ".TABLE_PREFIX."duel b,".TABLE_PREFIX."user a ,".TABLE_PREFIX."user c WHERE  b.duelled_to = a.id_user  AND b.duelled_by=c.id_user  AND ( duelled_to=".$_SESSION['id_user']." OR b.duelled_by=".$_SESSION['id_user'].") AND b.is_ignored<>1 AND b.is_cancelled<>1 ";
	    $sql_complete="SELECT a.fname as duelledto_name,a.id_user as duelledto_id_user,a.avatar as duelledto_avatar ,c.fname as duelledby_name,c.id_user as duelledby_id_user,c.avatar as duelledby_avatar,b.* FROM ".TABLE_PREFIX."duel b,".TABLE_PREFIX."user a ,".TABLE_PREFIX."user c WHERE  b.duelled_to = a.id_user  AND b.duelled_by=c.id_user  AND ( duelled_to=".$_SESSION['id_user']." OR b.duelled_by=".$_SESSION['id_user'].") AND (b.is_ignored=1 OR b.is_cancelled=1)";
	    $res_active=getrows($sql_active, $err);
	    $res_complete=getrows($sql_complete, $err);
	    $this->_output['res_complete']=$res_complete;
	    $this->_output['res_active']=$res_active;
	    $this->_output['tpl']="duels/list_duels";
	}
	
	function _accept_challange(){
		$sql=$this->duels_bl->get_search_sql("duel","id_duel=".$this->_input['id_duel']."","is_cancelled");
		$res=getsingleindexrow($sql);
		if($res['is_cancelled']==0){
		    $arr[$this->_input['fld']]=1;
		    $id= $this->obj_duels->update_this("duel",$arr," id_duel=".$this->_input['id_duel']);

		    if($this->_input['fld']=="is_accepted"){
				$arr1['is_cancelled']=1;
				$cond="(duelled_by IN(".$this->_input['duelled_by'].",".$this->_input['duelled_to'].") OR duelled_to IN (".$this->_input['duelled_to'].",".$this->_input['duelled_by'].") )AND id_duel<>".$this->_input['id_duel']."";
				$this->obj_duels->update_this("duel",$arr1," $cond");
				//for notification accept duel invitation 
				$cond_notify="(id_user IN(".$this->_input['duelled_by'].",".$this->_input['duelled_to'].") OR  notified_user IN (".$this->_input['duelled_to'].",".$this->_input['duelled_by'].")) AND notification_type=2";

				$this->obj_duels->delete("notification",$cond_notify);//fon notification delete duel invitation record.

				$notify['notified_user'] =$this->_input['duelled_by'];
				$notify['id_user']=$_SESSION['id_user'];
				$notify['notification_type'] = '3';
				$notify_id = $this->obj_duels->insert_all("notification",$notify,1);
						
				//end
		    }

		//for notification
			
			$notify1['is_removed']='1';
			$notify_upd=$this->obj_duels->delete("notification","id_user =".$this->_input['duelled_by']." AND  notified_user=".$_SESSION['id_user']." AND notification_type=2");
		   //end 
			$this->_mail_notification($this->_input['duelled_by'],"accept_duel");
		    $this->_list_duels(2);
		}else{
		  print '1';
		}
	}
	
	function _mail_notification($ids,$param){
		global $link;
		if (is_array($ids)){
		    $ids=implode(",", $ids);
		}
		switch($param){
		    case "invited_duel":
			$subject=$_SESSION['fname']." invited you to duel. ";
			$tpl="duels/mail_invite_duel";
			break;
		    case "accept_duel":
			$subject=$_SESSION['fname']." accepted your duel invitation.";
			$tpl="duels/mail_accept_duel";
			break;
		}
		$sql=  $this->duels_bl->get_search_sql("user","id_user IN ($ids)","email,fname");
		//$sql="SELECT email,fname FROM memeje__user where id_user IN ($ids)";
		$query=mysqli_query($link,$sql);
		while($rec=mysqli_fetch_assoc($query)){
		    $info['name']=$rec['fname'];
		    $to=$rec['email'];
		   /// $subject=$_SESSION['fname']." send you a friend request";
		    $from = $GLOBALS['conf']['SITE_ADMIN']['email'];
		    //$tpl = "user/$tmpl";
		    $this->smarty->assign('sm',$info);
		    $body = $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
		    print($body);exit;
		    $msg=sendmail($to,$subject,$body,$from);
		    if ($msg){
			$msg[]="Mail Sent Sucessfully TO ".$value;
		    }
		}
	}
	
#################################################
###############DUEL UPDATE CRON##################
#################################################	
	function _duel_challange(){
	    $sql="SELECT duelled_to,duelled_by FROM ".TABLE_PREFIX."duel WHERE duelled_by =".$_SESSION['id_user']." AND is_accepted = 1 ";
	    $res=getsingleindexrow($sql,$err);
	    $sql="SELECT * FROM ".TABLE_PREFIX."meme  WHERE is_duel = 1 AND ( id_user = ".$res['duelled_by']." OR id_user = ".$res['duelled_to'].")";
	    $res=getrows($sql, $err);
	    if($res[0]['tot_honour'] > $res[1]['tot_honour']){
		$arr['duel_won']=$res[0]['id_user'];		
	    }else{
		$arr['duel_won']=$res[1]['id_user'];
	    }
	    $cond = " id_user = ".$arr['duel_won'];
	    $r = $this->obj_duels->update_this("meme",$arr,$cond);
	    if($r == ""){
		$sql="UPDATE ".TABLE_PREFIX."user SET duels_won = duels_won +1 WHERE id_user = ".$arr['duel_won'];
		execute($sql, $err);
		print "Succesfully Updated";
	    }else{
		print "error";
	    }
	}
#################################################
##################DUEL CRON######################
#################################################
	function _cron_duel(){
	    global $link;
	    $idq = $this->get_id_question();
	    $idq = ($idq)?$idq:0;
	    $sql = "SELECT duelled_by,duelled_to FROM ".TABLE_PREFIX."duel WHERE own_meme AND duelled_meme AND is_accepted=1";
	    $res = mysqli_query($link,$sql);
	    while($rec = mysqli_fetch_assoc($res)){
		$sql_duel = "SELECT a.id_user FROM ".TABLE_PREFIX."meme AS a JOIN ".TABLE_PREFIX."meme as b ON (a.tot_honour-a.tot_dishonour) > (b.tot_honour-b.tot_dishonour) WHERE (
(a.is_duel=1 AND a.id_question=".$idq." AND a.id_user IN(".$rec['duelled_by'].','.$rec['duelled_to'].")) AND (b.is_duel=1 AND b.id_question=".$idq." AND b.id_user IN(".$rec['duelled_by'].','.$rec['duelled_to'].")))";
		$result = getsingleindexrow($sql);
		############ Declaring duel winner ############
		if($result){
		    $con_win = " id_user=".$result['id_user']." AND is_duel=1 AND id_question=".$idq;
		    $con_usr_duel_own = "id_user=".$result['id_user'];
		}
		###### Tie( Declaring both users as winner) ####
		else{
		    $con_win = " id_user IN (".$rec['duelled_by'].','.$rec['duelled_to'].") AND is_duel=1 AND id_question=".$idq;
		    $con_usr_duel_own = " id_user IN (".$rec['duelled_by'].','.$rec['duelled_to'].")";
		}
		$usr_duel['duels_won'] = "duels_won+1";
		$this->obj_duels->update_this("user",$usr_duel,$con_usr_duel_own,1);
		$win['duel_won']=1;
		$this->obj_duels->update_this("meme",$win,$con_win);
	    }
		###### Removing all duel informations ####
		$sql_duel="DELETE FROM ".TABLE_PREFIX."duel";
		mysqli_query($link,$sql_duel);
		
		###### Removing all duel meme informations ####
		$sql_duel_meme="DELETE FROM ".TABLE_PREFIX."duel_meme";
		mysqli_query($link,$sql_duel_meme);
		
		###### Removing all duel notifications ####
		$sql_duel_noti="DELETE FROM ".TABLE_PREFIX."notification WHERE notification_type IN(2,3)";
		mysqli_query($link,$sql_duel_noti);
	}
	function get_id_question(){
		$cond=" AND START_DATE <= CURDATE() AND END_DATE >= CURDATE() ";
		$sql=$this->duels_bl->get_search_sql("question","1".$cond." LIMIT 1","id_question");
		$res = getsingleindexrow($sql);
		return $res['id_question'];
	}
}
