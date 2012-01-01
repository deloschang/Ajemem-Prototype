<?php
class admin_caption extends caption_manager {
	
	function admin_caption(& $smarty, & $_output, & $_input) {
		$this->caption_manager($smarty, $_output, $_input, 'caption');
		$this->obj_caption = new caption;
		$this->caption_bl = new caption_bl;
	}
	function get_module_name() {
		return 'caption';
	}
	function get_manager_name() {
		return 'caption';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	function _caption_listing(){
	    $limit = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : 0;
	    $uri = 'flexyadmin/index.php/caption/caption_listing';
	    $cond = " 1 ";
	    $st_date = $this->_input['st_date'];
	    $end_date =$this->_input['end_date'];
	    
	    if($this->_input['id_user']){
		$uri.="/id_user/".$this->_input['id_user'];
		$cond.=" AND id_user=".$this->_input['id_user'];
	    }
	    if($this->_input['title']){
		$uri.="/title/".$this->_input['title'];
		$cond.=" AND title LIKE '%".$this->_input['title']."%'";
	    }
	    if($st_date || $end_date){
		    if($st_date && $end_date){
			 $uri.="/st_date/".$st_date."/end_date/".$end_date;
			 $cond.=" AND add_date BETWEEN '".convertodate($st_date,'m-d-Y','Y-m-d')."' AND '".convertodate($end_date,'m-d-Y','Y-m-d')."'";
		    }
		    elseif($st_date){
			 $uri.="/st_date/".$st_date;
			 $cond.=" AND add_date >='".convertodate($st_date,'m-d-Y','Y-m-d')."'";
		    }
		    elseif($end_date){
			 $uri.="/end_date/".$end_date;
			 $cond.=" AND add_date <= '".convertodate($end_date,'m-d-Y','Y-m-d')."'";
		    }
	    }
	   // $sql = get_search_sql("caption",$cond);
		$sql="SELECT a.email,a.id_user,b.id_meme,b.title ,c.* FROM ".TABLE_PREFIX."caption c,".TABLE_PREFIX."user a,".TABLE_PREFIX."meme b WHERE  c.id_user=a.id_user AND c.id_meme=b.id_meme";
	    $res = getrows($sql,$err);
	    $this->_output['field'] = array("id_caption" => array("id_caption", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $limit;
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_caption";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
		$_REQUEST['choice'] ="caption_listing";
	    if ($this->_input['chk']) { 
		$this->caption_bl->page_listing($this, "admin/caption/caption_list");
	    } else {
		$this->caption_bl->page_listing($this, "admin/caption/search_caption");
	    }
	}
}		

?>
