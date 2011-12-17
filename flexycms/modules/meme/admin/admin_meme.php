<<<<<<< HEAD
<?php
class admin_meme extends meme_manager {
	
	function admin_meme(& $smarty, & $_output, & $_input) {
		$this->meme_manager($smarty, $_output, $_input, 'meme');
		$this->obj_meme = new meme;
		$this->meme_bl = new meme_bl;
	}
	function get_module_name() {
		return 'meme';
	}
	function get_manager_name() {
		return 'meme';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	
	function _list_premadeImages($x='0', $q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'flexyadmin/meme/list_premadeImages';
	    if ($this->_input['chk']) {
		$cond=" 1 ";
		if($this->_input['image']!=''){
		    $cond .= " AND image LIKE '%".$this->_input['image']."%'";
		    $uri .= "/image/".$this->_input['image'];
		}
		if($this->_input['add_date']!=''){
		    $dd_date=convertodate($this->_input['add_date'],'mm-dd-yyyy','yyyy-mm-dd');
		    $cond .= " AND add_date LIKE '%".$dd_date."%'";
		    $uri .= "/add_date/".$this->_input['add_date'];
		}
		$cond .= " ORDER BY id_premade_image DESC";
		$sql=get_search_sql("premade_images", "$cond ");
	    } else {
		$sql = get_search_sql("premade_images", "1 ORDER BY id_premade_image DESC ");
	    }
	    $this->_output['field'] = array("id_premade_images" => array("id_premade_images", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_premade_image";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['choice'] =list_premadeImages;
	    if ($this->_input['chk'] || $x) {
		$this->meme_bl->page_listing($this, "admin/meme/premaid_imagelist");
	    } else {
		$this->meme_bl->page_listing($this, "admin/meme/premaid_imagesearch");
	    }
	}
	function _addImages(){
	    $this->_output['category']=$GLOBALS['conf']['PREMADE_CATEGORY'];
	    $this->_output['tpl']="admin/meme/uplodify";
	}
	function _upload_image(){
	    $meme['image']=$this->_input['Filename'];
	    $meme['id_category']=$this->_input['category'];
	    $meme['ip']=$_SERVER['REMOTE_ADDR'];
	    $id=$this->obj_meme->insert_all("premade_images",$meme,1);
	    if($_FILES){
			$uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
			$img['name'] =$this->_input['Filename'];//print $img['name'];exit;
			//$img['name'] = substr($this->_input['Filename'],(strpos($this->_input['Filename'],"-")+1));
			$fname =$id."_".convert_me($img['name']);
			$file_tmp=$_FILES['Filedata']['tmp_name'];
			@copy($file_tmp, $uploadDir.$fname);
			$arr['img_name']=$fname;
			$img_id=$this->obj_meme->update_this("premade_images", $arr," id_premade_image=".$id);
			//Crop
			$thumb_path = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image_thumb'];
			//copy($uploadDir.$fname, $thumb_path.$fname);
			$thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
			$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
			$thumb_object = new thumbnail_manager($uploadDir.$fname, $thumb_path.$fname);
			$thumb_object->get_container_thumb($thumb_width, $thumb_height, 0, 0);
			// End of crop
			if($id){
				$_SESSION['raise_message']['global']="New image inserted successfully";
			}else{
				$_SESSION['raise_message']['global']="Problem in insert image";
			}
			ob_clean();
			print $id;
	    }else {
			print "No image Uploaded";
			exit;
	    }
		
	}
	function _imgList(){
	    $ids=trim($this->_input['ids'],",");
	    $sql=get_search_sql("premade_images","id_premade_image IN($ids)");
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/meme/imglist";
	}
	function _edit_premadeImages(){
	    $sql="SELECT id_premade_image,image,img_name,id_category FROM ".TABLE_PREFIX."premade_images WHERE id_premade_image =".$this->_input['id'];
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['qstart'] = $this->_input['qstart'];
	    $this->_output['tpl'] = 'admin/meme/editimage';
	}
	function _update_category(){
	    $arr['id_category']=$this->_input['id_category'];
	    $this->obj_meme->update_this("premade_images",$arr," id_premade_image=".$this->_input['id']);
	    $this->_list_premadeImages("2",$this->_input['qstart']);
	}
	function _delete_premadeImages(){
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
	    unlink($uploadDir."/".$this->_input['id_premade_image']."_".$this->_input['image']);
	    $id = $this->obj_meme->delete_premadeImages("premade_images", $this->_input['id_premade_image'],"id_premade_image");
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['no'] == 1 && $qstart > 0) {
		$qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['no'] > 1 && $qstart > 1) {
		$qstart = $qstart;
	    } else {
		$qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    $this->_list_premadeImages(2, $this->_input['qstart']);
	}
	function _deleteAll(){
	    global $link;
	    $id_premade_image=$this->_input['id_premade_image'];
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
		$image_thumb = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image_thumb'];
	    $sql = get_search_sql("premade_images", "id_premade_image in($id_premade_image)");
	    $res = $link->query($sql);
		while($rec=mysqli_fetch_assoc($res)){
		    unlink($uploadDir."/".$rec['img_name']);
			unlink($image_thumb."/".$rec['img_name']);
		}
	    $this->obj_meme->delete_premadeImages("premade_images", $id_premade_image,"id_premade_image");
	    $this->_list_premadeImages(2,$this->_input['qstart']);
	}
	function _preview(){
	    print_r($_FILES);exit;
	    if ($_FILES['img_name']['name']){
		    $time= strtotime("now");
		    $rid=$time."_";
		    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
		    $thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
		    $thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
		    $thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
		    $fname = $rid.convert_me($_FILES['img_name']['name']);
		    $file_tmp=$_FILES['img_name']['tmp_name'];
		    @copy($file_tmp, $uploadDir.$fname);
		    $copy_thumb=@copy($uploadDir.$fname, $thumbnailDir.$fname);
		    $this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
		    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		    echo $fname;exit;
			
	    }
	}
	function _show_flag(){
	    $limit = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : 0;
	    $arr = $this->get_info($qstart, $limit);
	    $this->_output['user_info'] = $arr['user'];
	    $this->_output['meme_info'] = $arr['meme'];
	    $this->_output['uri'] = $uri;
	    $uri = 'flexyadmin/meme/show_flag';
	    $sql = get_search_sql("flag","1");
	    $this->_output['field'] = array("id_flag" => array("id_flag", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $limit;
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_flag";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $this->meme_bl->page_listing($this, "admin/meme/flag_list");
	}
	
	function get_info($qstart,$limit){
	    global $link;
	    $id_memes='';
	    $id_users ='';
	    $sql = "SELECT id_flag,id_meme,id_user FROM ".TABLE_PREFIX."flag LIMIT ".$qstart.",".$limit;
	    $res = mysqli_query($link,$sql);
	    while($rec=mysqli_fetch_assoc($res)){
		$flags[$rec['id_meme']] = $rec;
		$id_memes.=$rec['id_meme'].",";
		$id_users.=$rec['id_user'].",";
	    }
	    $sql = "SELECT image,id_meme,id_user FROM ".TABLE_PREFIX."meme WHERE id_meme IN(".trim($id_memes,',').")";
	    $res = mysqli_query($link,$sql);
	    while($rec=mysqli_fetch_assoc($res)){
		$meme[$rec['id_meme']]=$rec;
		$ids.=$rec['id_user'].",";
	    }
	    $ids .= trim($id_users,',');
	    
	    $sql = $this->meme_bl->get_search_sql("user"," id_user IN(".$ids.")","fname,lname,id_user");
	    $usr = getindexrows($sql, "id_user");
	    $arr['meme'] = $meme;
	    $arr['user'] = $usr;
	    return $arr;
	}
	function _meme_listing(){
	    $limit = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : 0;
	    $uri = 'flexyadmin/meme/meme_listing';
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
	    if($this->_input['type']){
		    $uri.="/type/".$this->_input['type'];
		    switch($this->_input['type']){
			case 1: /* for Duels */
			    $cond.=" AND id_duel";
			    break;
			case 2: /* for Questions */
			    $cond.=" AND id_question";
			    break;
			case 3: /* for Memes */
			    $cond.=" AND is_live";
			    break;
		    }
	    }
	    if($this->_input['category']){
		$uri.="/category/".$this->_input['category'];
		$cond.=" AND category=".$this->_input['category'];
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
	    $sql = get_search_sql("meme",$cond);
	    print $sql;
	    $res = getrows($sql,$err);
	    $this->_output['field'] = array("id_meme" => array("id_meme", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $limit;
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_meme";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    if ($this->_input['chk']) {
		$this->meme_bl->page_listing($this, "admin/meme/meme_list");
	    } else {
		$this->meme_bl->page_listing($this, "admin/meme/search_meme");
	    }
	}
}
=======
<?php
class admin_meme extends meme_manager {
	
	function admin_meme(& $smarty, & $_output, & $_input) {
		$this->meme_manager($smarty, $_output, $_input, 'meme');
		$this->obj_meme = new meme;
		$this->meme_bl = new meme_bl;
	}
	function get_module_name() {
		return 'meme';
	}
	function get_manager_name() {
		return 'meme';
	}
	function manager_error_handler() {
		$call = "_".$this->_input['choice'];
		if (function_exists($call)) {
			$call($this);
		} else {
			print "<h1>Put your own error handling code here</h1>";
		}
	}
	
	function _list_premadeImages($x='0', $q='0'){
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : $q;
	    $uri = 'flexyadmin/meme/list_premadeImages';
	    if ($this->_input['chk']) {
		$cond=" 1 ";
		if($this->_input['image']!=''){
		    $cond .= " AND image LIKE '%".$this->_input['image']."%'";
		    $uri .= "/image/".$this->_input['image'];
		}
		if($this->_input['add_date']!=''){
		    $dd_date=convertodate($this->_input['add_date'],'mm-dd-yyyy','yyyy-mm-dd');
		    $cond .= " AND add_date LIKE '%".$dd_date."%'";
		    $uri .= "/add_date/".$this->_input['add_date'];
		}
		$cond .= " ORDER BY id_premade_image DESC";
		$sql=get_search_sql("premade_images", "$cond ");
	    } else {
		$sql = get_search_sql("premade_images", "1 ORDER BY id_premade_image DESC ");
	    }
	    $this->_output['field'] = array("id_premade_images" => array("id_premade_images", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_premade_image";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $_REQUEST['choice'] =list_premadeImages;
	    if ($this->_input['chk'] || $x) {
		$this->meme_bl->page_listing($this, "admin/meme/premaid_imagelist");
	    } else {
		$this->meme_bl->page_listing($this, "admin/meme/premaid_imagesearch");
	    }
	}
	function _addImages(){
	    $this->_output['category']=$GLOBALS['conf']['PREMADE_CATEGORY'];
	    $this->_output['tpl']="admin/meme/uplodify";
	}
	function _upload_image(){
	    $meme['image']=$this->_input['Filename'];
	    $meme['id_category']=$this->_input['category'];
	    $meme['ip']=$_SERVER['REMOTE_ADDR'];
	    $id=$this->obj_meme->insert_all("premade_images",$meme,1);
	    if($_FILES){
			$uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
			$img['name'] =$this->_input['Filename'];//print $img['name'];exit;
			//$img['name'] = substr($this->_input['Filename'],(strpos($this->_input['Filename'],"-")+1));
			$fname =$id."_".convert_me($img['name']);
			$file_tmp=$_FILES['Filedata']['tmp_name'];
			@copy($file_tmp, $uploadDir.$fname);
			$arr['img_name']=$fname;
			$img_id=$this->obj_meme->update_this("premade_images", $arr," id_premade_image=".$id);
			//Crop
			$thumb_path = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image_thumb'];
			//copy($uploadDir.$fname, $thumb_path.$fname);
			$thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
			$thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
			$thumb_object = new thumbnail_manager($uploadDir.$fname, $thumb_path.$fname);
			$thumb_object->get_container_thumb($thumb_width, $thumb_height, 0, 0);
			// End of crop
			if($id){
				$_SESSION['raise_message']['global']="New image inserted successfully";
			}else{
				$_SESSION['raise_message']['global']="Problem in insert image";
			}
			ob_clean();
			print $id;
	    }else {
			print "No image Uploaded";
			exit;
	    }
		
	}
	function _imgList(){
	    $ids=trim($this->_input['ids'],",");
	    $sql=get_search_sql("premade_images","id_premade_image IN($ids)");
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['tpl']="admin/meme/imglist";
	}
	function _edit_premadeImages(){
	    $sql="SELECT id_premade_image,image,img_name,id_category FROM ".TABLE_PREFIX."premade_images WHERE id_premade_image =".$this->_input['id'];
	    $res=getrows($sql, $err);
	    $this->_output['res']=$res;
	    $this->_output['qstart'] = $this->_input['qstart'];
	    $this->_output['tpl'] = 'admin/meme/editimage';
	}
	function _update_category(){
	    $arr['id_category']=$this->_input['id_category'];
	    $this->obj_meme->update_this("premade_images",$arr," id_premade_image=".$this->_input['id']);
	    $this->_list_premadeImages("2",$this->_input['qstart']);
	}
	function _delete_premadeImages(){
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
	    unlink($uploadDir."/".$this->_input['id_premade_image']."_".$this->_input['image']);
	    $id = $this->obj_meme->delete_premadeImages("premade_images", $this->_input['id_premade_image'],"id_premade_image");
	    if ($this->_input['qstart']) {
		$qstart = $this->_input['qstart'];
	    } else {
		$qstart = 0;
	    }
	    if ($this->_input['no'] == 1 && $qstart > 0) {
		$qstart = $qstart - $this->_input['limit'];
	    } else if ($this->_input['no'] > 1 && $qstart > 1) {
		$qstart = $qstart;
	    } else {
		$qstart = 0;
	    }
	    $this->_input['qstart'] = $qstart;
	    $this->_list_premadeImages(2, $this->_input['qstart']);
	}
	function _deleteAll(){
	    global $link;
	    $id_premade_image=$this->_input['id_premade_image'];
	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image'];
		$image_thumb = APP_ROOT.$GLOBALS['conf']['IMAGE']['premade_image_thumb'];
	    $sql = get_search_sql("premade_images", "id_premade_image in($id_premade_image)");
	    $res = $link->query($sql);
		while($rec=mysqli_fetch_assoc($res)){
		    unlink($uploadDir."/".$rec['img_name']);
			unlink($image_thumb."/".$rec['img_name']);
		}
	    $this->obj_meme->delete_premadeImages("premade_images", $id_premade_image,"id_premade_image");
	    $this->_list_premadeImages(2,$this->_input['qstart']);
	}
	function _preview(){
	    print_r($_FILES);exit;
	    if ($_FILES['img_name']['name']){
		    $time= strtotime("now");
		    $rid=$time."_";
		    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_orig'];
		    $thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['preview_thumb'];
		    $thumb_height = $GLOBALS['conf']['IMAGE']['thumb_height'];
		    $thumb_width = $GLOBALS['conf']['IMAGE']['thumb_width'];
		    $fname = $rid.convert_me($_FILES['img_name']['name']);
		    $file_tmp=$_FILES['img_name']['tmp_name'];
		    @copy($file_tmp, $uploadDir.$fname);
		    $copy_thumb=@copy($uploadDir.$fname, $thumbnailDir.$fname);
		    $this->r = new thumbnail_manager($uploadDir.$fname,$thumbnailDir.$fname);
		    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		    echo $fname;exit;
			
	    }
	}
	function _show_flag(){
	    $limit = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : 0;
	    $arr = $this->get_info($qstart, $limit);
	    $this->_output['user_info'] = $arr['user'];
	    $this->_output['meme_info'] = $arr['meme'];
	    $this->_output['uri'] = $uri;
	    $uri = 'flexyadmin/meme/show_flag';
	    $sql = get_search_sql("flag","1");
	    $this->_output['field'] = array("id_flag" => array("id_flag", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $limit;
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_flag";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    $this->meme_bl->page_listing($this, "admin/meme/flag_list");
	}
	
	function get_info($qstart,$limit){
	    global $link;
	    $id_memes='';
	    $id_users ='';
	    $sql = "SELECT id_flag,id_meme,id_user FROM ".TABLE_PREFIX."flag LIMIT ".$qstart.",".$limit;
	    $res = mysqli_query($link,$sql);
	    while($rec=mysqli_fetch_assoc($res)){
		$flags[$rec['id_meme']] = $rec;
		$id_memes.=$rec['id_meme'].",";
		$id_users.=$rec['id_user'].",";
	    }
	    $sql = "SELECT image,id_meme,id_user FROM ".TABLE_PREFIX."meme WHERE id_meme IN(".trim($id_memes,',').")";
	    $res = mysqli_query($link,$sql);
	    while($rec=mysqli_fetch_assoc($res)){
		$meme[$rec['id_meme']]=$rec;
		$ids.=$rec['id_user'].",";
	    }
	    $ids .= trim($id_users,',');
	    
	    $sql = $this->meme_bl->get_search_sql("user"," id_user IN(".$ids.")","fname,lname,id_user");
	    $usr = getindexrows($sql, "id_user");
	    $arr['meme'] = $meme;
	    $arr['user'] = $usr;
	    return $arr;
	}
	function _meme_listing(){
	    $limit = $GLOBALS['conf']['PAGINATE_ADMIN']['rec_per_page'];
	    $qstart = $this->_input['qstart'] ? $this->_input['qstart'] : 0;
	    $uri = 'flexyadmin/meme/meme_listing';
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
	    if($this->_input['type']){
		    $uri.="/type/".$this->_input['type'];
		    switch($this->_input['type']){
			case 1: /* for Duels */
			    $cond.=" AND id_duel";
			    break;
			case 2: /* for Questions */
			    $cond.=" AND id_question";
			    break;
			case 3: /* for Memes */
			    $cond.=" AND is_live";
			    break;
		    }
	    }
	    if($this->_input['category']){
		$uri.="/category/".$this->_input['category'];
		$cond.=" AND category=".$this->_input['category'];
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
	    $sql = get_search_sql("meme",$cond);
	    print $sql;
	    $res = getrows($sql,$err);
	    $this->_output['field'] = array("id_meme" => array("id_meme", 1));
	    $this->_output['uri'] = $uri;
	    $this->_output['limit'] = $limit;
	    $this->_output['show'] = $GLOBALS['conf']['PAGINATE_ADMIN']['show_page'];
	    $this->_output['sql'] = $sql;
	    $this->_output['type'] = 'box';
	    $this->_output['sort_by'] = "id_meme";
	    $this->_output['sort_order'] = "Desc";
	    $this->_output['ajax'] = '1';
	    $this->_output['qstart'] = $qstart;
	    if ($this->_input['chk']) {
		$this->meme_bl->page_listing($this, "admin/meme/meme_list");
	    } else {
		$this->meme_bl->page_listing($this, "admin/meme/search_meme");
	    }
	}
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
