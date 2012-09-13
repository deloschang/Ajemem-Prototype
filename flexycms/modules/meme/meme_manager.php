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

	function _check_fb_session(){
		$arr=$this->decrypt_fb_data();
		$facebook = $arr[0];
		$data = $arr[1];
		$fb_login_sts=$facebook->api_client->users_getLoggedInUser();
		if($fb_login_sts=='-1'){
			$_SESSION['fb_login']='';
		}
		print $fb_login_sts;exit;
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
			//print "<h1>Meme Manager Error</h1>";

		}

	}
	
#########################################################################################

############################ SAVE FLASH GENERATED MACROMEME #############################

#########################################################################################	
	function _load_flash_meme(){
		global $link;
		// grabs user_id that flash sends as a parameter
		$flash_user_id = mysql_real_escape_string($_GET['user_id']);
		
		// switch to grab memes from library
		if ($_REQUEST['library'] == 1){
			$sql = "SELECT type, thumb, source, title, top_caption, bottom_caption FROM memeje__genlibrary";
		} else if ($_REQUEST['id']){
			$meme_id = mysql_real_escape_string($_REQUEST['id']); // passed in from flash
			$sql = "SELECT type, thumb, source, title, top_caption, bottom_caption FROM memeje__meme WHERE id_meme =".$meme_id;
		} else {
			$sql = "SELECT type, thumb, source, title, top_caption, bottom_caption FROM memeje__meme WHERE user_id =".$flash_user_id;
		}
		$res = mysqli_query($link,$sql);
	    
	    if(!$res){
			exit("mysql search failed");
	    } 
		
		$rows['items'] = array();
		$i = 0;
		while($rec = mysqli_fetch_assoc($res)){
			$rows['items'][] = $rec;
			$decoded_top_caption = json_decode($rec['top_caption'], true);
			$decoded_bot_caption = json_decode($rec['bottom_caption'], true);
			$rows['items'][$i]['top_caption'] = $decoded_top_caption;
			$rows['items'][$i]['bottom_caption'] = $decoded_bot_caption;
			$i++;
		}		
		$json_rows = json_encode($rows);
		$final_rows = stripslashes($json_rows);
		
		exit($final_rows);
	}
	
function _save_flash_meme(){
		global $link;
		$tagged = $_POST['tagged_user']; // comes back as comma-delimited list
		
		$img_byte_array = $_POST["image"];
		$source_byte_array = $_POST['source'];
		//$img_byte_array = 'iVBORw0KGgoAAAANSUhEUgAAAfQAAABkCAYAAABwx8J9AAAewUlEQVR4Xu2dSaxuS1XHH9gmBjsiogM82I5ARYWoRI5tQmKDDcaQABcRExOUh81M8QI+nag8u4kNXFQGBuQ924GCHjVhoOgTdaJGORoGSgz6jAOIxrh+uJcsi9q7Vu3mO/vb57+Tyv3u+apb/1pV/1qrVu3vMffpEQJCQAgIASEgBM4egcecvQQSQAgIASEgBISAELhPhC4lEAJCQAgIASFwAARE6AcYRIkgBISAEBACQkCELh0QAkJACAgBIXAABEToBxhEiSAEhIAQEAJCQIQuHRACQkAICAEhcAAEROgHGESJIASEgBAQAkJAhC4dEAJCQAgIASFwAARE6AcYRIkgBISAEBACQkCELh0QAkJACAgBIXAABEToBxhEiSAEhIAQEAJCQIQuHRACQkAICAEhcAAEROgHGESJIASEgBAQAkJAhC4dEAJCQAgIASFwAARE6AcYRIkgBISAEBACQkCELh0QAkJACAgBIXAABEToBxhEiSAEhIAQEAJCQIQuHRACQkAICAEhcAAEROgHGESJIASEgBAQAkJAhC4dEAJCQAgIASFwAARE6AcYRIkgBISAEBACQkCELh0QAkJACAgBIXAABEToBxjEMxDhJdbHn53Zz/+0cs+w9MjM8j3FnmWZryYKvNe+e6KlR3sqVV4hIASEwCkQOCqhRwKZswh/mIH/LktPGAbh++3fB4bP5XdrjVNJXDUSfK419qbOBmv1/IrV8S0j9SzFrlbtngn9sdbh37T07E5c5+hVZxPKvhMETjXndyLuZDfK+RLXxnPo/6H7KEKvD+9eCf3t1t1nWnpfUivHFiIR+v8C2LLIMzBrQcugdN55ROgfGD8R+o51WYR+XoROb3us9DHCuklC792UbDV9xrwGU/i+xjpzf9EhEfpWI7SfekXoIvT9aONET0To/YSeHdi4+M8hsTHCydY15Uq+7YRe2+j0bJSebErwDkuPsyRCz86I4+dbOufPASFZ6DseJRH6eRA65+YfZcnPeTPkE0mrLH+bCb1mbWXwrGkKmy7iLDy+YsdTXV07AQIi9BOArCbGERChnwehQ8BvteSR4i0rPe6iCbb7QkuvDhuC20zopedjSwu75qIvNW7uZqKsp+bROeUNgal1dkscpuIgTh24uDahT7n6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';
		
		$sql = "SELECT id_user, dupe_username FROM memeje__user where uid=".$_POST['user_id'];
		$res = mysqli_query($link, $sql);
		while($rec = mysqli_fetch_assoc($res)){
			$_SESSION['id_user'] = $rec['id_user'];
			$_SESSION['dupe_username'] = $rec['dupe_username'];
			
		}
		
		$source_file_format = $_POST['file_format'];
		
		$save_filename = $_SESSION['dupe_username'].'_'.mt_rand(0,9999999999999999);
		$save_file_path = 'image/orig/meme/'.$save_filename.'.png';
		$save_relative_path = $save_filename.'.png';
		$thumbnail_file_path = 'image/thumb/meme/'.$save_filename.'.png';
		//$thumbnail_relative_path = $save_filename.'.gif';
	
		// save image for result
		$binary = base64_decode($img_byte_array);
		if (!$file = fopen($save_file_path, "w")){
			echo "Cannot open file";
			exit;
		}
		if (fwrite($file, $binary) === FALSE){
			echo "Cannot write to file";
			exit;
		}
		fclose($file);
		
		$thumb_height = 120;
	    $thumb_width = 120;
		
		// save thumbnail image for result
		$this->r = new thumbnail_manager($save_file_path,$thumbnail_file_path);
	    $this->r->get_container_thumb($thumb_height,$thumb_width,0,0);
		
		
		// check if source is path or byte array
		if ($source_file_format){
			$source_file_path = 'image/source/'.$save_filename.$source_file_format;
			
			// save image for source
			$source_binary = base64_decode($source_byte_array);
			if (!$source_file = fopen($source_file_path, "w")){
				echo "Cannot open file";
				exit;
			}
			if (fwrite($source_file, $source_binary) === FALSE){
				echo "Cannot write to file";
				exit;
			}
			fclose($source_file);
			$data['source'] = $source_file_path;
		} else {
			$data['source'] = $source_byte_array;
		}

		// Testing -- Saves variables from Flash generator	
		// $data['type'] = "meme";
		// $data['source'] = '/some/path/for/source';
		// $data['image'] = $save_file_path;
		// $data['thumb'] = $thumbnail_file_path;
		// $data['title'] = "Bad Joke Eel";
		// $data['top_caption'] = '{"x":15.5,"text":"What do you call someone with no body and a nose?","fontSize":50,"width":576.65,"autoSize":true,"height":100,"y":20}';
		// $data['bottom_caption'] = '{"x":15.5,"text":"Nobody Knows","fontSize":50,"width":576.65,"autoSize":true,"height":100,"y":321}';
		// $data['user_id'] = '1337222';	// Flash facebook ID
		// $data['id_user'] = '141';		// we have foreign key constraint later remove and use this:
			//$data['id_user'] = $_SESSION['id_user']
		
		// Localize Flash variables
		$data['type'] = $_POST['type'];
		$data['image'] = $save_relative_path;
		$data['thumb'] = $thumbnail_file_path;
		$data['title'] = $_POST['title'];
		$data['top_caption'] = $_POST['top_caption'];
		$data['bottom_caption'] = $_POST['bottom_caption'];
		$data['user_id'] = $_POST['user_id'];
		//$data['tagged_user'] = $_POST['tagged_user'];
		$data['id_user'] = $_SESSION['id_user'];
		
		$test_success_id = $this->obj_meme->insert_all("meme",$data);
		if ($test_success_id){
			$response = array();
			$response['type'] = $data['type'];
			$response['thumb'] = $data['thumb'];
			$response['source'] = $data['source'];
			$response['title'] = $data['title'];
			
			$decoded_top_caption = json_decode(stripslashes($data['top_caption']), true);
			$decoded_bot_caption = json_decode(stripslashes($data['bottom_caption']), true);
			
			$response['top_caption'] = $decoded_top_caption;
			$response['bottom_caption'] = $decoded_bot_caption;
			
			// enter dupe_username for now to test...remove later
			if (!$_SESSION['dupe_username']){
				$_SESSION['dupe_username'] = 'memeja_tester';
			}
			
			// end
			$response['url'] = 'http://memeja.com/?id='.$_SESSION['dupe_username'].'&meme='.$test_success_id;
			
			$response_rows = json_encode($response);
			$final_rows = stripslashes($response_rows);
			
			//exit($final_rows);
			
			// start here with FB posting
			///////////// POST TO FACEBOOK WALL CODE HERE
			if ($tagged != ''){
				$arr = $this->decrypt_fb_data();
				$facebook = $arr[0];
				
				if (!$_POST['title']){
					$_POST['title'] = 'Hello world';
				} 
				
				//$feed_dir = '/541259857/feed/';
				$body = array(
					'name' 			=> $_POST['title'],
					'message' 		=> '',
					//'caption' 		=> '', 
						// might also add who else was tagged 
					'description'	=> 'Check out this meme I created on Memeja and tagged you in',
					'picture'		=> 'http://memeja.com/'.$thumbnail_file_path,
					'link'			=> LBL_SITE_URL.'?id='.$_SESSION['dupe_username'].'&meme='.$test_success_id,
					);		
				
				//http://memeja.com in picture has to be hardcoded in.
				
				$batchPost = array();
				//fb($data);
			
				//fb('the value is '.$data['tagged_user']);
				$tagged_id = explode(",", $tagged);
				//fb('first id is '.$tagged_id[0]);
				//fb('second id is '.$tagged_id[1]);
				foreach ($tagged_id as $value){
					$batchPost[] = array(
						'method' => 'POST',
						'relative_url' => "/$value/feed",
						'body' => http_build_query($body)
					);
				}
				
				try {
					//$result = $facebook->api($feed_dir, 'post', $body);
					$multiPostResponse = $facebook->api('?batch='.urlencode(json_encode($batchPost)), 'POST');
					exit($final_rows);
				} catch (FacebookApiException $e) {
					error_log($e);
					//fb($e);
					print("Post failed (please try again). We would greatly appreciate it if you emailed feedback@memeja.com with this error:");
					exit($e);
				}
				
				
			} else {
				exit($final_rows);
			}
			
		} else{
			exit('failure');
		}
	}
	
	
	function _create_username() {
        global $link;

        if (isset($this->_input['username'])) {
            // Setup query to see if username is already taken
            $myusername = mysql_real_escape_string(stripslashes($this->_input['username']));

            $check_table = "SELECT COUNT(*) FROM " . TABLE_PREFIX . "user WHERE username='" . $myusername . "'";
            //var_dump($check_table);
            $result = mysqli_query($link, $check_table) or die(mysqli_error());

            $row = mysqli_fetch_assoc($result);

            //var_dump($row['COUNT(*)']);

            if ($row['COUNT(*)'] != 0) {
                echo 'This user already exists';
            } else {
                ##### Updating database with new username #####
                $sql = "UPDATE " . TABLE_PREFIX . "user SET username= '" . $myusername . "' WHERE id_user=" . $_SESSION['id_user'];
                $result = mysqli_query($link, $sql);
                //var_dump($result);
				
                ##### Update TOC session to 1, username selected ######
                $sql = "UPDATE " . TABLE_PREFIX . "user SET toc=1 WHERE id_user=" . $_SESSION['id_user'];
                mysqli_query($link, $sql);
                $_SESSION['toc'] = '1';
                $_SESSION['username'] = $myusername;

                ##### Redirect user out #####
                redirect(LBL_SITE_URL);
            }
        }
    }

########################################################################

########################### SHOWING MEME EDITOR ########################

########################################################################


	function _addMeme(){

	    check_session();
		
		global $link;

	    $data = $this->_input;

	    if($data['id'])

			$this->_output['idq']=$data['id'];

	    if($data['duel'])

			$this->_output['duel']=$data['duel'];
			
		if ($data['tag']){
			$sql="SELECT uid FROM ".TABLE_PREFIX."user WHERE dupe_username=".$data['tag']." LIMIT 1";
			$res = mysqli_fetch_assoc(mysqli_query($link,$sql));
			
			if($res){
				$this->_output['pretag'] = $res['uid'];
			}
		}

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
	    
	    $data['can_all_comment'] = 1;
	    $data['can_all_view'] = 1;

	    if($data['image']){

			$data['image'] = convert_me($data['image']);

			$tmp_img=explode(".",$data['image']);

			$tmp_img[count($tmp_img)-1]='png';

			$data['image']=implode(".",$tmp_img);

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

			// possibly create separate $data to insert into memeje__tags
			
			// For tagging user

			$notify['id_meme']=$id;

#			foreach ($this->_input['tagged_user'] as $key => $value) {

#				$notify['notified_user'] = $value;

#				$notify_id = $this->obj_meme->insert_all("notification",$notify,1);

#		   	}

			// End
			
			if ($this->_input['tagged_user'] != ""){
		
				foreach($this->_input['tagged_user'] as $key => $value){
					$tag['tagged'] = $value;
					$tag['id_meme'] = $id;
					$this->obj_meme->insert_all("tags",$tag);
				}

				// $tagged_user=implode(",",$this->_input['tagged_user']);

				// $data['tagged_user'] = $data['pretag'] ? $tagged_user.','.$data['pretag'] : $tagged_user;
			} 
			
			// elseif ($data['pretag']){
				// $data['tagged_user'] = $data['pretag'];
			// }

			$img['image '] = $id."_".$data['image'];

			$this->obj_meme->update_this("meme",$img," id_meme=".$id);

			$this->update_xp_points($_REQUEST['choice']);

			//$this->common_page_update($data['category']);

			// if($data['id_question']){

				// $inf['is_live'] = 0;

				// $this->obj_meme->update_this("meme",$inf," id_meme=".$id);

				// $this->image_crop($path_from,"meme/".$img['image ']);

				// header("Location:".LBL_SITE_URL."question/answer_to_ques/idq/".$data['id_question']);

			// }else{

				$usr_inf = $this->get_user_action_info();

				$this->badges_accd_user_action('exp_point',$usr_inf['exp_point']);

				$this->badges_accd_user_action('id_meme',$usr_inf['no_of_meme']);

				$this->image_crop($path_from,"meme/".$img['image ']);

			//$this->post_to_facebook_wall($data['image'],$data['title'],$id);
			
			//$src = LBL_SITE_URL.'image/thumb/meme/'.$id."_".$data['image'];

			//$href = LBL_SITE_URL.'meme/meme_details/id/'.$id."/fb/1";
			
			// POST TO FACEBOOK WALL CODE HERE
			$arr = $this->decrypt_fb_data();
			$facebook = $arr[0];
			
			//$feed_dir = '/541259857/feed/';
			$body = array(
				'name' 			=> $data['title'],
				'message' 		=> '',
				//'caption' 		=> '', 
					// might also add who else was tagged 
				'description'	=> 'Check out this meme I created on Memeja.com and tagged you in',
				'picture'		=> 'http://memeja.com/image/thumb/meme/330_Troll_I_Lied_Light.png',
				'link'			=> LBL_SITE_URL.'?id='.$_SESSION['dupe_username'].'&meme='.$id,
				);		
				
			//http://memeja.com in picture has to be hardcoded in.
						// on site
				// $body = array(
				// 'name' 			=> $data['title'],
				// 'message' 		=> '',
				//'caption' 		=> '', 
					//might also add who else was tagged 
				// 'description'	=> 'Check out this meme I created on Memeja and tagged you in',
				// 'picture'		=> 'http://memeja.com/image/thumb/meme/'.$id."_".$data['image'],
				// 'link'			=> LBL_SITE_URL.'?id='.$_SESSION['dupe_username'].'&meme='.$id,
				// );		
			
			$batchPost = array();
			//fb($data);
			//http://memeja.com/image/questions.png
			
			if ($this->_input['tagged_user'] != ""){
				//fb('the value is '.$data['tagged_user']);
				$tagged_id = $this->_input['tagged_user'];
				foreach ($tagged_id as $value){
					$batchPost[] = array(
						'method' => 'POST',
						'relative_url' => "/$value/feed",
						'body' => http_build_query($body)
					);
				}
				
				try {
					//$result = $facebook->api($feed_dir, 'post', $body);
					$multiPostResponse = $facebook->api('?batch='.urlencode(json_encode($batchPost)), 'POST');
					echo('Hooray, successful tagging is successful');
				} catch (FacebookApiException $e) {
					error_log($e);
					fb($e);
					echo("Post failed");
				}
				
			} 
				
		    	//header("Location:".LBL_SITE_URL."meme/meme_list/cat/".$data['category']);
		    	header("Location:".LBL_SITE_URL);

			}

			exit;

	    //}

		

	}



########################################################################

############################# IMAGE CROPPING ###########################

########################################################################



	function image_crop($path_from,$fname){

	    $uploadDir  = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_orig'].$fname;

	    $thumbnailDir = APP_ROOT.$GLOBALS['conf']['IMAGE']['image_thumb'].$fname;

	    copy($path_from, $uploadDir);

	    //chmod($uploadDir,777);

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

		//$sql = $this->meme_bl->get_search_sql("user"," id_user=".$_SESSION['id_user'],"memeje_friends");

		//$res = getrows($sql, $err);

		//$ids = $res['0']['memeje_friends'];

		//return $ids;

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


	function _meme_nlu_rand(){
		global $link;
		
		$rand_gen =(isset($data['rand_fg']) && $data['rand_fg']=='1')?" is_live=1 AND id_meme NOT IN(".$data['rnd_ids'].") ":" is_live=1 AND 1 "; 
		$rand_cat_cond = ($data['rnd_cat'])?" AND category IN(".trim($data['rnd_cat'],',').")":" AND 1";
		
		$cond_jn = $rand_gen.$rand_cat_cond." AND (tot_honour-tot_dishonour) > -3 ORDER BY RAND() LIMIT 1";
		
		$sql = get_search_sql("meme",$cond_jn);
		
		$res = mysqli_query($link,$sql);

	    if($res){

		while($rec = mysqli_fetch_assoc($res)){

		    $id_memes.=$rec['id_meme'].",";

		    $arr[] = $rec;

		}
		
		}
		
		$this->_output['res_meme']=$arr;
		var_dump($arr);
		$tpl = 'meme/random_meme';
	}
	
	
	// Experimental NLU pagination listing
	//function _nlu_list(){
	//	$data = $this->_input;
	//	print('function reached');
	//	exit;
	//}
	
	function _meme_list(){
	    //check_session();	 
	    global $link;
		
		$limit = 10; //pagination limit
		
	    $id_memes='';

	    $data = $this->_input;
		//fb($data);

	    $srch_cond = "";

	    if($data['muname']) 

			$srch_cond = " AND FIND_IN_SET(id_user,(SELECT IF(GROUP_CONCAT(id_user),GROUP_CONCAT(id_user),0) FROM ".TABLE_PREFIX."user WHERE username LIKE '%".$data['muname']."%')) ";
			
	    if($data['mtitle']){

			$srch_cond.=" AND title LIKE '%".$data['mtitle']."%'";
				
			$this->_output['is_search'] = 1;
				
		}

	    $tp_srt = (isset($data['srt']) && $data['srt']!=1)?" AND view_count > 0 ORDER BY view_count ":" AND (tot_honour-tot_dishonour) > 0 ORDER BY (tot_honour-tot_dishonour)";

		if ($_SESSION['id_user']){
			$frnd_ids = $this->get_user_friends();
		}

	    $frnd_ids = ($frnd_ids)?$frnd_ids:0;
		
		// Pati's Code, only paginates friends' memes
	    $rand_con = " AND IF(id_user=".$_SESSION['id_user'].",1,IF(can_all_view,1,FIND_IN_SET(id_user,'".$frnd_ids."')))";

	    $rand_cat_cond = ($data['rnd_cat'])?" AND category IN(".trim($data['rnd_cat'],',').")":" AND 1";

	    $rand_gen =(isset($data['rand_fg']) && $data['rand_fg']=='1')?" is_live=1 AND id_meme NOT IN(".$data['rnd_ids'].") ":" is_live=1 AND 1 "; 


	    ############ FRIENDS FEED #############
		
		if ($data['ext'] == 1) {
			$sql = "SELECT GROUP_CONCAT(following) FROM memeje__friends GROUP BY id_user HAVING id_user = ".$_SESSION['id_user'];
	   
			$frnd_ids = mysqli_fetch_assoc(mysqli_query($link, $sql));
			//fb($frnd_ids);

			$ext_cond = " AND id_user IN(".$frnd_ids['GROUP_CONCAT(following)'].",".$_SESSION['id_user'].")";
		} else {
			$ext_cond = " AND 1 ";
		}
	    

	    ############ WHILE SCROLLING DOWN I.E LOADMORE  ########################

	    
		
	    if($data['last_id']){
			if($data['cat']=='main_feed'){

				// Old Pati's Code, only paginates friends' memes
				//$cond_jn = " is_live=1 ".$rand_con.$ext_cond." AND id_meme < ".$data['last_id'].$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;
								
				$cond_jn = " id_meme<".$data['last_id']." AND is_live=1  ORDER BY id_meme DESC LIMIT ".$limit;
				/*
				if ($data['page_no'] == -2){
					$cond_jn = " is_live=1 AND id_meme < ".$data['last_id'].$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;
				} elseif ($data['page_no'] == -1){
					$cond_jn = " is_live=1 AND id_meme > ".$data['last_id'].$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;
				} else {
					$page_limit = (($data['page_no'] - 1) * $limit).",".$limit;
					$cond_jn = " is_live=1 ORDER BY id_meme DESC LIMIT ".$page_limit;
				}*/

			} else {

				$rand_fg = $data['rand_fg'];

				$cond_op = $this->get_common_cond($data['cats'],$data['bst'],$data['last_id'],2,$rand_fg);

				$cond_jn = ($data['cat']=='rand')?

								//$rand_gen.$rand_cat_cond.$rand_con.$srch_cond." AND (tot_honour-tot_dishonour) > -3 ORDER BY RAND() LIMIT 1"
								$rand_gen.$rand_cat_cond.$srch_cond." AND (tot_honour-tot_dishonour) > -3 ORDER BY RAND() LIMIT 1"

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


		## no last id ##
	    else{

			if($data['cat']=='main_feed'){

				$cond_jn = " is_live=1 ".$rand_con.$ext_cond.$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;

			} else {

				$cond_op = $this->get_common_cond($data['cats'],$data['bst'],'',1);



				$cond_jn =($data['cat']=='top')?

								$cond_op.$rand_con.$srch_cond.$tp_srt." DESC LIMIT ".$limit

							   :

							   (

								($data['cat']=='rand')?

											//$rand_gen.$rand_cat_cond.$rand_con." AND (tot_honour-tot_dishonour) > -3 ORDER BY RAND() LIMIT 1"
											$rand_gen.$rand_cat_cond." AND (tot_honour-tot_dishonour) > -3 ORDER BY RAND() LIMIT 1"

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
		
		$this->_output['icon_arr'] = 1;
		$this->_output['title_arr'] = 1;
		
		// total memes count/
		
		$page_sql="SELECT COUNT(*) FROM ".TABLE_PREFIX."meme WHERE is_live=1";
	    $page_res=mysqli_query($link,$page_sql);
		$page_row = $page_res->fetch_row();
		
		
		//print $row[0];
		
	    $id_memes = trim($id_memes,',');

	    $user_info = $this->get_userinfo();
            $user_follow = $this->get_userfollowing();

	    $hst_rtd_cap = $this->get_hst_rtd_caption($id_memes);

	    $last_id_meme = $this->get_last_id_meme();

	    $flag = ($data['last_id']) ? 1 : 0;
	
		// max pages to show
		
		$this->_output['page_row'] = ceil($page_row[0] / $limit);
		
	    $this->_output['flag']=$flag;

	    $this->_output['res_meme']=$arr;

	    $this->_output['rand_fg']=($data['rand_fg'])?1:0;

	    $this->_output['hrc']=$hst_rtd_cap;

	    $this->_output['last_id_meme']=$last_id_meme;

	    $this->_output['last_id']=$data['last_id'];

            $this->_output['uinfo']=$user_info;
            $this->_output['ufollow'] = $user_follow;

	    $this->_output['cat']=$data['cat'];

	    $this->_output['ext']=$ext;

	    $this->_output['id_memes']=$id_memes;

	    $this->_output['last_idmeme']=$arr[sizeof($arr)-1]['id_meme'];

	    if($data['cat']=='top')

			$tpl = ($data['srch'] || $flag)?'meme/loadmore_top_meme':'meme/top_memelist';

	    elseif($data['cat']=='rand')

			$tpl = ($data['srch'] || $flag)?'meme/loadmore_rand_meme':'meme/random_meme';

	    elseif ($data['ext'] == 1 || $data['ext'] == 0) 
		
			$tpl = 'meme/loadmorememe';
			
		else

			$tpl = ($flag)? 'meme/loadmorememe' : 'meme/meme_list';
		
		
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

	    $arr['id_meme'] = filter_var($data['id'], FILTER_SANITIZE_STRING);  

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

##################### HIGHLIGHT MEME AGREE/DISAGREE VIA CHOICE #########

################################### Delos ##############################

	function _check_vote() {
		
		$data = $this->_input;
		
		// formats the sql statement/syntax to be used
		$sql_agreed = $this->meme_bl->get_search_sql("meme"," FIND_IN_SET(".$_SESSION['id_user'].",honour_id_user) AND id_meme=".$data['id_meme']);
		
		$agreed = getrows($sql_agreed, $err);
		
		//$res[0] = 0;
		
		// If $agreed is true, then user has voted "Agree" on the meme
		if ($agreed) {
			$res[0] = 0;
		}
		
		//else {
			//$sql_disagreed = $this->meme_bl->get_search_sql("meme"," FIND_IN_SET(".$_SESSION['id_user'].",dishonour_id_user) AND id_meme=".$data['id_meme']);
			//$disagreed = getrows($sql_disagreed, $err);
			
			// If $disagreed is true, then user has voted "Disagree" on the meme
			//if ($disagreed) {
				//$hn[0] = 1;
			//}
		//}
	
	}

########################################################################

##################### UPDATING HONOUR AND DISHONOUR  ###################

########################################################################

	function _set_adaggr(){

	    $data = $this->_input;

		// get_search_sql in common_files.php
	    $sql = $this->meme_bl->get_search_sql("meme"," ( FIND_IN_SET(".$_SESSION['id_user'].",honour_id_user) OR FIND_IN_SET(".$_SESSION['id_user'].",dishonour_id_user) ) AND id_meme=".$data['id_meme']);

		// getrows in flexycms_core/common.php
	    $captions = getrows($sql, $err);

		// If $captions is false, user has not voted yet.
	    if(!$captions){

			$table_name = "meme";

			$cond = " id_meme=".$data['id_meme'];

			if($data['con']=='A'){

		    	$info['tot_honour '] = "tot_honour+1";

		    	$info['honour_id_user'] = "IF(honour_id_user='',".$_SESSION['id_user'].",CONCAT(honour_id_user,',','".$_SESSION['id_user']."'))";

		    	$this->update_xp_points('honour', $data['id_user_creator']);

			} else {

			    $info['tot_dishonour'] = "tot_dishonour+1";
	
			    $info['dishonour_id_user'] = "IF(dishonour_id_user='',".$_SESSION['id_user'].",CONCAT(dishonour_id_user,',','".$_SESSION['id_user']."'))";
		    
			    $this->update_xp_points('dishonor', $data['id_user_creator']);

			}

			$this->obj_meme->update_this($table_name,$info,$cond,1);

			$col = ($data['con']=='A')?"tot_honour":"tot_dishonour";

			$sql = $this->meme_bl->get_search_sql("meme",$cond,$col);

			$res= getrows($sql,$err);

			// $hn[0] is assigned total honor or dishonor
			$hn[0] = $res['0'][$col];
			
			// $hn[1] is assigned 1 if user agreed or 2 if user disagreed
			$hn[1] = ($data['con']=='A')?"1":"2";

		} else {

			// If $captions is true, user has voted.  
			$hn[0] = 0;

	    }

	    print json_encode($hn);

	    exit;

	}
	
	################### LIVE FEED TO UPDATE HONOR/DISHONOR ###################
	########################### DELOS #####################
	
	function _live_feed() {
		global $link;
		$data = $this ->_input;
		
		if(!$data['meme_id']){
	    	// No meme
			exit("no meme");
	    }
		
	// Check honor first...
		$sql="SELECT * FROM ".TABLE_PREFIX."meme WHERE id_meme=".$data['meme_id']." LIMIT 1";
	    $res=mysqli_fetch_assoc(mysqli_query($link,$sql));
	    
	    if(!$res){
	    	// Could not find exp_point in MySQL database for user
			exit("no response");
	    } 
	    		
		// Total Honor has not changed
		if ( $data['meme_tot_honor'] != $res['tot_honour'] && $this->_input['chk']=='1'){
			exit($res['tot_honour'].','.'honor');
	    	
			//exit("Total Honor has changed!!!!"."|".$data['meme_tot_honor']."|".$res['tot_honour']);
			//exit($data['meme_id']."|".$data['meme_tot_honor']);
		}
		
	// Check dishonor after..
				
		// Total Dishonor has not changed
		if ( $data['meme_tot_dishonor'] != $res['tot_dishonour'] && $this->_input['chk']=='1'){
			exit($res['tot_dishonour'].','.'dishonor'.','.$data['meme_tot_dishonor']);
	    	
			//exit("Total Honor has changed!!!!"."|".$data['meme_tot_honor']."|".$res['tot_honour']);
			//exit($data['meme_id']."|".$data['meme_tot_honor']);
		}
		
	// Check replies after...

		if ( $data['meme_tot_reply'] == $res['tot_reply'] && $this->_input['chk']=='1'){
			exit("no change");
		} else {
			exit($res['tot_reply'].','.'reply'.','.$data['meme_tot_reply']);
		}
	}

	################### LIVE FEED TO MEMES ###################
	########################### DELOS #####################
	function _live_meme() {
		global $link;
		$data = $this ->_input;
		
		// Check top_meme_id input
		if(!$data['top_meme_id']){
	    	// No meme
			exit("no meme");
	    } 
	    
	    $sql = "SET @i=0;SELECT *,POSITION FROM (SELECT *, @i:=@i+1 AS POSITION FROM ".TABLE_PREFIX."meme ORDER BY id_meme DESC ) t WHERE POSITION=1";
	    $res = getsingleindexrow($sql);
	    
	    if(!$res){
	    	// Could not find user's exp rank
			exit("no meme found in SQL");
		}
	    
	    // Compare highest id_meme in SQL with input
	    if($data['top_meme_id'] == $res['id_meme']){
	    	exit("No new meme updates");
	    } else {
	    	// send back the id of the meme and relevant image for linking
	   		exit("New Meme".','.$res['id_meme'].','.$res['title'].','.$res['image'].','.$res['id_user']);
	    
		}
	}
	
	function _live_feed_render(){
	
		global $link;
		
		$data = $this->_input;

#	    $id = ($id_meme!='')?$id_meme:$data['id'];

#	    $sql = $this->meme_bl->get_search_sql("reply"," id_meme=".$id);

#	    $replies = getrows($sql, $err);

	    $user_info = $this->get_userinfo();

#	    $flag = (isset($data['flag']))?$data['flag']:0;

	    $this->_output['meme_id'] = $data['meme_id'];

	    $this->_output['meme_title'] =  $data['meme_title'];

	    $this->_output['meme_picture'] = $data['meme_picture'];

	    $this->_output['meme_user'] = $data['meme_user'];
	    
#	    $this->_output['feed_count'] = $data['feed_count'];
	   
	    $this->_output['uinfo'] = $user_info;

#	    if($id_meme!=''){

#			$arr[0] = $replies;

#			$arr[1] = $user_info;

#			return $arr;

#	    }else{

		$this->_output['tpl']="meme/live_meme";

#	    }

	
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

	    } else{

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

		//$user_info[$rec['id_user']]['friends'] = explode(",",$rec['memeje_friends']);

	    }


	    mysqli_free_result($res);

	    mysqli_next_result($link);

	    return $user_info;

	}

        function get_userfollowing($id_user=""){
                global $link;

                $cond = ($id_user!='')?" id_user IN(".$id_users.")":" 1 ";
                
                $sql = "SELECT following FROM memeje__friends WHERE id_user=".$_SESSION['id_user'];

                $res = mysqli_query($link,$sql);

                // if current user is following, add a 1. Used for live feed indexing
                if($res){
                        while ($rec = mysqli_fetch_assoc($res)){
                                $user_follow[$rec['following']] = 1;    // 1 for yes am following
                        }
                } else{
exit('no response');
                }

                mysqli_free_result($res);

	        mysqli_next_result($link);
                return $user_follow;
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

	    //check_session();			Modified for NLU - 4/10/12

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
	    
#	    $this->_output['hrc']=$hst_rtd_cap;

#	    $this->_output['fg'] = (isset($data['fg'])) ? 1:0;

#		//$res[0] has all info for specific meme by ID
#	    $this->_output['det_meme'] = $res[0];

#	    $this->_output['rep_det'] = $rep_det[0];

#	    $this->_output['uinfo'] = $rep_det[1];

#	    $tpl = (isset($data['fb']))?"meme/from_fb_meme":"meme/meme_details";

#	    $this->_output['tpl'] = $tpl;

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

	
// Uses MySql db memeje__allotpoints to index for pts
	function update_xp_points($ch,$id_user=""){

	    $sql = $this->meme_bl->get_search_sql("allotpoints"," point_type='".$ch."'","points");

	    $res = getrows($sql,$err);

	    if($res){

			$info['exp_point']  = 'exp_point+'.$res[0]['points'];
			
			$this->obj_meme->update_this("user",$info," id_user=".$_SESSION['id_user'],1);
			
			if ($id_user) {
			$sql_other = $this->meme_bl->get_search_sql("allotpoints"," point_type='".$ch."_other"."'","points");
			$res_other = getrows($sql_other,$err);
			
			$info_creator['exp_point'] = 'exp_point+'.$res_other[0]['points'];
		
			$this->obj_meme->update_this("user",$info_creator," id_user=".$id_user,1);
		}
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
			
			$feed_dir = '/541259857/feed/';
			
			$body = array(
				'name' 			=> 'Muaz',
				'message' 		=> 'Hello World!',
				'description'	=> 'hey muaz',
				'link'			=> 'http://www.hellomuaz.com',
				'caption'		=> 'caption',
				//'picture'		=> LBL_SITE_URL.'image/thumb/meme/'.$id."_".$data['image'];
				//'link'			=> LBL_SITE_URL.'meme/meme_details/id/'.$id."/fb/1";
				);
			
			//$batchPost = array();
			
			try {
				$result = $facebook->api($feed_dir, 'post', $body);
				echo('SUCCESS!!!!!');
			
			} catch (FacebookApiException $e) {
				error_log($e);
				echo("Post failed");
			}
	
	
	   // $arr=$this->decrypt_fb_data();

	   // $facebook = $arr[0];

	   // $data = $arr[1];

	   // $uid=$data['uid'];

	       // $description = $description;

	       // $src = LBL_SITE_URL.'image/thumb/meme/'.$id."_".$name;

	       // $href = LBL_SITE_URL.'meme/meme_details/id/'.$id."/fb/1";

               // $video='';

               // if($name) {

                       // $attachment = array('name' => $name, 'href' =>$href, 'caption' =>'', 'description' => '', 'properties' => array(),'media' => array(array('type' => 'image', 'src' =>$src, 'href' => $href)));

               // }elseif($video) {

                       // $attachment = array('name' => '', 'href' => '', 'caption' =>'', 'description' => '', 'properties' => array(),'media' => array(array('type' => 'flash', 'swfsrc' =>$video , 'imgsrc' => $imgsrc,"width" => "80","height" => "60", "expanded_width" => "160", "expanded_height" => "120")));

               // }else {

                       // $attachment='';

               // }

               //$facebook->api_client->stream_publish($description,$attachment,'','',$uid);

	}

	function _logout(){
		// Called for both FB and normal user logout
		$site = $_SESSION['site_used'];
		setcookie('username', '', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('password','', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('email', '', time()-60*60*24*365,"/".SUB_DIR);
		setcookie('id_user','', time()-60*60*24*365,"/".SUB_DIR);
		//setcookie('login_cnt','', time()-60*60*24*365,"/");
		$_COOKIE['username'] = "";
		$_COOKIE['password'] = "";
		$_COOKIE['email'] ="";
		$_COOKIE['id_user']="";

		//$_COOKIE['login_cnt'] = "";
		$_SESSION = array('');
		unset($_SESSION);
		session_unset();
		session_destroy();
		session_start();
		$_SESSION['username'] = "";
		$_SESSION['email'] = "";
		$_SESSION['id_user'] = "";
		$_SESSION['raise_message']['global'] = "You have successfully logged out!";

		$_COOKIE['fbs_'.$app_id]="";
		if($this->_input['a']) {
			$_SESSION['id_admin'] = "";
			$_SESSION['admin'] = "";
			redirect(LBL_ADMIN_SITE_URL);
		} else {
			redirect(LBL_SITE_URL);
		}
	}

	function decrypt_fb_data(){
		//$api_key=$GLOBALS['conf']['FACEBOOK']['api_key'];
		$application_secret = $GLOBALS['conf']['FACEBOOK']['secret_key'];
		$app_id = $GLOBALS['conf']['FACEBOOK']['app_id'];
		
		// Start of newest FB changes
		if(isset($_COOKIE['fbsr_' . $app_id])){
			list($encoded_sig, $payload) = explode('.', $_COOKIE['fbsr_' . $app_id], 2);
   
        	$sig = base64_decode(strtr($encoded_sig, '-_', '+/'));
        	$data = json_decode(base64_decode(strtr($payload, '-_', '+/')), true);
  
        	if (strtoupper($data['algorithm']) !== 'HMAC-SHA256') {
            	return null;
         	}
         	
         	$expected_sig = hash_hmac('sha256', $payload,
         	$application_secret, $raw = true);
         	
          	if ($sig !== $expected_sig) {
            	return null;
          	}
          	
        	$token_url = "https://graph.facebook.com/oauth/access_token?"
         . "client_id=" . $app_id . "&client_secret=" . $application_secret. "&redirect_uri=" . "&code=" . $data['code'];
   
   			//var_dump($token_url);
   			// e.g.  "https://graph.facebook.com/oauth/access_token?client_id=219049284838691&client_secret=0b378365e966491e3e3b1d12bbc65afa&redirect_uri=&code=2.AQA__rw8Zipnc4k6.3600.1324440000.1-641286114|_u5nb7xpTi24QbgwPu6UWpUCJ8I" 
   			
          	$response = @file_get_contents($token_url);
          	$params = null;
          	
          	parse_str($response, $params);
          	
          	//var_dump($response);
          	// e.g. access_token=AAADHOWLPpSMBALRAuPIE7
//	184M0A80ARK8yRZBPIkvjaeCTk1JvrAZAUSRSIrQvyuBrIkZCrl9WJ8Qb
//	fttPeuOgD2dcgZDZD&expires=4659

			//var_dump($params);
			// e.g. ["access_token"] => "AAAADHOW..."

          	$data['access_token'] = $params['access_token']; 
          	
          	// formerly was $data['session_key']
          	$data['session_key'] = $data['code'];
          	$session_key = $data['code'];
          	
          	//var_dump($data['uid']); => evals to null
          	
			$arr[0] = new Facebook(array(
  				'appId'  => $app_id,
  				'secret' => $application_secret,
			));
			
			$facebook = $arr[0];
			
			$arr[1] = $data;
			return $arr;
			
          	//return $data;
     	} else {
     		// FB cookie doesn't exist
          	return null;
     	}
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

		    $sql=$this->meme_bl->get_search_sql("user","username like '%".$this->_input[q]."%' AND id_admin !=1","username");

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

	function _save_meme(){

		if (isset($GLOBALS["HTTP_RAW_POST_DATA"])) {

		    $imageData=$GLOBALS['HTTP_RAW_POST_DATA'];

		    $filteredData=substr($imageData, strpos($imageData, ",")+1);

		    $unencodedData=base64_decode($filteredData);

			$filename = APP_ROOT."/spad/workspace/".$_REQUEST['id_user'].'_img.png';



			//if (is_writable($filename)) {

				if (!$handle = fopen($filename, 'wb')) {

				     echo "Cannot open file ($filename)";

				     exit;

				}

				if (fwrite($handle, $unencodedData) === FALSE) {

				    echo "Cannot write to file ($filename)";

				    exit;

				}

				echo "Success, wrote to file ($filename)";

				fclose($handle);

			//} else {

			//	echo "The file $filename is not writable";

			//}

		}

	}

}
