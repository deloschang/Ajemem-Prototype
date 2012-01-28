<?
class question_manager extends mod_manager {
	function question_manager (& $smarty, & $_output, & $_input) {
		$this->mod_manager($smarty, $_output, $_input, 'question');
		$this->obj_question = new question;
		$this->question_bl = new question_bl;
 	}
	function get_module_name() {
		return 'question';
	}
	function get_manager_name() {
		return 'question';
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
	function _get_this_week_question(){
	    $cond=" AND START_DATE <= CURDATE() AND END_DATE >= CURDATE() ";
	    $sql=$this->question_bl->get_search_sql("question","1".$cond." LIMIT 1");
	    $this->_output['week_quest']=getsingleindexrow($sql);
	    $this->_output['tpl']="question/this_week_question";
	}
	function _que_details(){
	    if($this->_input['id'] !=""){
	       $sql=$this->question_bl->get_search_sql("question"," id_question = ".$this->_input['id']." LIMIT 1");
	       $this->_output['res']=getsingleindexrow($sql);
	       $this->_output['tpl']="question/que_details";
	   }
	}
	function _answer_to_ques(){
		global $link;
		check_session();
		$sql = $this->question_bl->get_search_sql("meme"," id_question =".$this->_input['idq']);
		$res = mysqli_query($link,$sql);
		if($res){
			while($rec = mysqli_fetch_assoc($res)){
				$answers[$rec['id_user']] = $rec;
				$id_memes.=$rec['id_meme'].",";
			}
		}
		mysqli_free_result($res);
		mysqli_next_result($link);
		$uinfo = $this->get_userinfo();
		$id_memes = trim($id_memes,',');
		$hst_rtd_cap = $this->get_hst_rtd_caption($id_memes);
		$sql=$this->question_bl->get_search_sql("question"," id_question = ".$this->_input['idq']." LIMIT 1");
		$this->_output['res']=getsingleindexrow($sql);
		$this->_output['ans'] = $answers;
		$this->_output['idq'] = $this->_input['idq'];
		$this->_output['uinfo'] = $uinfo;
		$this->_output['hrc']=$hst_rtd_cap;
		$this->_output['tpl'] = "question/answers";

	}
	function get_userinfo(){
	    /*$sql = $this->question_bl->get_search_sql("user"," 1 ","*");
	    $user_info = getindexrows($sql, "id_user");
	    return $user_info;*/
		global $link;
	    $sql = $this->question_bl->get_search_sql("user"," 1 ");
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
	    $sql = $this->question_bl->get_max_recs("(select * from ".TABLE_PREFIX."caption order by tot_honour desc) a","id_meme,caption","1 GROUP BY id_meme");
	    $hst_rtd_cap = getindexrows($sql, "id_meme");
	    return $hst_rtd_cap;
	}
	###################################################################################################################################################################
	###############################################DELETE UPDATE QUESTION FROM MEMEJE__MEME############################################################################
	
	function _cron_question(){
		global $link;
		$info="u";
		$day_of_week=date("w");
		echo date('Y-m-d h:i:s ')."<br />";
		$start_date_of_week=date('Y-m-d', strtotime("-".$day_of_week." day"))."<br />";
		$day_of_week=7-$day_of_week;
		$end_date_of_week=date('Y-m-d', strtotime("+".$day_of_week." day"))."<br />";
		/*$sql = "select id_captions from memeje__meme where id_question=(select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' )";
		//print $sql;exit;
		$arr1=getrows($sql, $err);
		print($arr1[0]['id_captions']);
		$sql2="update memeje__caption set is_live=3 where id_caption=".$arr1[0]['id_captions'];
		//print $sql2;exit;
		mysql_query($sql2);*/
		if($info=='d'){
			$sql1="delete from memeje__meme where id_question=(select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' )";
			mysqli_query($link,$sql1);
		}
		else if($info=='u'){
			$sql1="update memeje__meme set is_live=3 where id_question in (select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' )";
			$sql2="update memeje__caption set is_live=3 where id_caption in (select id_captions from memeje__meme where id_question=(select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' )".")";
			$sql3="update memeje__reply set is_live=3 where id_meme in(select id_meme from memeje__meme where id_question in(select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' )".")";
			//print $sql1;exit;
			mysqli_query($link,$sql1);
			//print "number of rows modified in meme".mysql_affected_rows();//."<br />";
			mysqli_query($link,$sql2);
			//echo "number of rows modified in caption".mysql_affected_rows();
			mysqli_query($link,$sql3);
		}
		
	}
	function _most_accept_question(){
		global $link;
		$info="u";
		$day_of_week=date("w");
		$day_of_week1=$day_of_week-1;
		//echo date('Y-m-d h:i:s ')."<br />";
		$start_date_of_week=date('Y-m-d', strtotime("-".$day_of_week1." day"))."<br />";
		$day_of_week=7-$day_of_week;
		$end_date_of_week=date('Y-m-d', strtotime("+".$day_of_week." day"))."<br />";
		print $start_date_of_week ." ". $end_date_of_week;
		$sql1="select id_user from memeje__meme where tot_honour in (select max(total_honour) from memeje__meme ) and id_question in (select id_question from memeje__question where date(add_date) between '".$start_date_of_week."'and '".$end_date_of_week."' ) group by id_question"; 
		print $sql1;exit;
	}
}

?>
