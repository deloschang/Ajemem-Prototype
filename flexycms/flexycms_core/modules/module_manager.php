<?phpclass mod_manager {		function mod_manager(& $smarty, & $_output, & $_input, $module) {		$this->smarty = & $smarty;		$this->global_output = & $_output;		$this->_input = & $_input;		$this->module = $module;		include_files('modules/'.$module);		if (!defined("THROUGH_CONTROLLER")) {			$obj = new user_templates;			$this->smarty->register_function('get_mod', array (&$obj, 'get_mod'));		}	}		function run($arg) {		unset ($this->output_set);		unset ($this->_output);		unset ($this->arg);		$this->arg = $arg;		$module = $this->arg['module']?$this->arg['module']:$this->_input['module'];		$module = $module?$module:$this->_input['mod'];		$mgr = 	$this->arg['mgr']?$this->arg['mgr']:$this->_input['mgr'];		$mgr = $mgr?$mgr:$module;		$module = $module?$module:$mgr;		$mgr_choice = $this->get_manager_name().'_choice';		$choice = isset ($arg[$mgr_choice]) ? $arg[$mgr_choice] : $this->_input[$mgr_choice];		if(!$choice){			$choice = isset ($arg['choice']) ? $arg['choice'] : $this->_input['choice'];						$choice = isset ($choice) ? $choice : $_REQUEST['choice'];			$choice = isset ($choice) ? $choice : "default";		}		$choice = $choice ? $choice: "default";				// print $choice; //$choice is meme_list for main feed.		if ($module=="user" && $choice=="set_login") {			if (checkforadmin($this->_input['username'], $this->_input['password'])) {				$this->setMySession();				redirect(LBL_ADMIN_SITE_URL."index.php");			}        }		$this->_output['tpl'] = isset ($arg['tpl']) ? $arg['tpl'] : $this->_input['tpl'];		$module_name = $this->get_module_name();				if ($GLOBALS[$module_name.'_'.$choice]) {			$this->_output = $GLOBALS[$module_name.'_'.$choice];		}		$function_name = '_'.$choice;		$start = getmicrotime();		$GLOBALS['func_name'] = $module_name.'_'.$function_name;		$this->_output = $GLOBALS['obj_pre_events']->run($module,$mgr,$choice,$this->_input,$this->_output);		//Added By Parwesh For Error Handling Only for methods in class		if (method_exists($this,$function_name)) {			$action_result = $this->{$function_name}();			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);			if ($this->action_obj){		    		unset ($GLOBALS['func_name']);			 	unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);				return $action_result;			}			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {				$this->_output['debug'] = 1;				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;			}			unset ($GLOBALS['func_name']);			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);					$result = $this->getoutput();							return $result;		}else {					    if (method_exists($this,manager_error_handler)) {			$action_result = $this->manager_error_handler();			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);			if ($this->action_obj){				unset ($GLOBALS['func_name']);				unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);				return $action_result;			}			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {				$this->_output['debug'] = 1;				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;			}			unset ($GLOBALS['func_name']);			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);			$result = $this->getoutput();			return $result;		    }else{			unset ($GLOBALS['func_name']);			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);			$this->default_error_handler();		    }						}	}	function getoutput() {		//$this->_output['debug']=1; 		if (isset ($this->output_set))			return $this->output_set;		if (!$this->_output['tpl']) {			// Added by Delos to show live feed for non-logged-in users						if (!$_SESSION['id_user'] && $this->arg['mgr'] =="meme" || $_SESSION['id_user']) {				global $link;								/*				if(!$_SESSION['id_user']){				// Message of the Day				$msg_query = "SELECT * FROM ".TABLE_PREFIX."quotes ORDER BY rand() LIMIT 3";				// rand(" . date("Ymd") . ") --> for message of the day				$msg_res=mysqli_query($link,$msg_query);				while ($item = mysqli_fetch_assoc($msg_res)){					$msg_arr[] = $item['Situation'];					$link_arr[] = $item['Link'];				}								$this -> _output['msg_arr'] = $msg_arr;				$this -> _output['link_arr'] = $link_arr;								// End of Message of the Day				*/				/* meme icon border									// can order by id_meme					// order by honor etc..				$icon_cond = "SELECT image, title FROM ".TABLE_PREFIX."meme WHERE is_live=1 ORDER BY tot_honour DESC LIMIT 14";				$res = mysqli_query($link,$icon_cond);								while($rec = mysqli_fetch_assoc($res)){					$icon_arr[] = $rec['image'];					$title_arr[] = $rec['title'];				}									// temporary placeholder until more memes are uploaded						// remove when able to upload own memes..					while (count($icon_arr) < 56) {									$icon_cond = "SELECT image, title FROM ".TABLE_PREFIX."meme WHERE is_live=1 ORDER BY id_meme DESC LIMIT 14";							// need only 54 memes to make full circle.						$res = mysqli_query($link,$icon_cond);																			while($rec = mysqli_fetch_assoc($res)){									$icon_arr[] = $rec['image'];									$title_arr[] = $rec['title'];							}					}				*/								//}			/*				$encoded = json_encode($icon_arr);				$title_encoded = json_encode($title_arr);								$this -> _output['icon_arr'] = $encoded;				$this -> _output['title_arr'] = $title_encoded;															//end				*///end								if($data['muname']) {					$srch_cond = " AND FIND_IN_SET(id_user,(SELECT IF(GROUP_CONCAT(id_user),GROUP_CONCAT(id_user),0) FROM ".TABLE_PREFIX."user WHERE username LIKE '%".$data['muname']."%')) ";				}									if($data['mtitle']){					$srch_cond.=" AND title LIKE '%".$data['mtitle']."%'";											$this->_output['is_search'] = 1;										}				                                // doesn't seem to do anything				/*$cond_jn = " is_live=1 ".$rand_con.$ext_cond.$srch_cond." ORDER BY id_meme DESC LIMIT ".$limit;*/							// manual string copied from meme_manager.php                                /*$sql = 'CALL get_search_sql("memeje__meme"," is_live=1 AND IF(id_user=2,1,IF(can_all_view,1,FIND_IN_SET(id_user,\'1,4,35\'))) AND 1 ORDER BY id_meme DESC LIMIT 5","*")'; */                                $sql = 'CALL get_search_sql("memeje__meme"," is_live=1 AND 1 ORDER BY id_meme DESC LIMIT 5","*")'; 									$res = mysqli_query($link,$sql);	   			if($res){	   								// for each row, add to the array					while($rec = mysqli_fetch_assoc($res)){						$id_memes.=$rec['id_meme'].",";						$arr[] = $rec;					}						}                               				    		@mysqli_free_result($res);		    	mysqli_next_result($link);				// Added by Delos to sustain pagination ($sm.page_rows)				$page_sql="SELECT COUNT(*) FROM ".TABLE_PREFIX."meme WHERE is_live=1";				$page_res=mysqli_query($link,$page_sql);				$page_row = $page_res->fetch_row();								$this->_output['page_row'] = ceil($page_row[0] / 5);								// other inputs		    	$id_memes = trim($id_memes,',');		   		$user_info = $this->get_userinfo();		    	$hst_rtd_cap = $this->get_hst_rtd_caption($id_memes);		    	$last_id_meme = $this->get_last_id_meme();			    $flag = ($data['last_id'])?1:0;			    $this->_output['flag']=$flag;				// array for meme listings			    $this->_output['res_meme']=$arr;	    		    	//print $this->_output['res_meme']; // meme array is loaded..		    	$this->_output['rand_fg']=($data['rand_fg'])?1:0;		    	$this->_output['hrc']=$hst_rtd_cap;		    	$this->_output['last_id_meme']=$last_id_meme;			    $this->_output['last_id']=$data['last_id'];		    	$this->_output['uinfo']=$user_info;		    	$this->_output['cat']=$data['cat'];		    	$this->_output['ext']=$ext;		    	$this->_output['id_memes']=$id_memes;		    	$this->_output['last_idmeme']=$arr[sizeof($arr)-1]['id_meme'];				$tpl = ($flag)?'meme/loadmorememe':'meme/meme_list';		    	$this->_output['tpl'] = $tpl;		    	// end of code added from meme_manager.php's meme_listing							$this->smarty->assign("sm", $this->_output);							// grabs template 'meme_list' for Smarty to fetch				// meme/meme_list taken from _output['tpl'] 				$ret = $this->smarty->fetch($this->smarty->add_theme_to_template('meme/meme_list'),$this->_output['cache_id']);										unset ($this->smarty->_tpl_vars['sm']);				$this->smarty->caching = $old_caching;				$this->smarty->cache_lifetime = $old_cache_lifetime;											// return Smarty's fetch for run()					return $ret;								}						return;				}		//$this->smarty->assign('_output',$this->_output);		if ($this->_input['ce']) {			eval ('$page_title=\''.$GLOBALS['conf']['PAGE_HEADERS'][$this->module.'_module_title'].'\';');			$this->smarty->assign('page_title', $page_title);// D: $content, assigned from add_theme func in AfixiSmarty.php			$this->smarty->assign('content', $this->smarty->add_theme_to_template($this->_output['tpl'].'tpl'));			$tpl = $this->_input['mtpl'] ? $this->_input['mtpl'] : 'common/home.tpl';			return $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));		} else {			$old_caching = $this->smarty->caching;			$old_cache_lifetime = $this->smarty->cache_lifetime;			$this->smarty->caching = $this->_output['caching'];			$this->smarty->cache_lifetime = $this->_output['cache_lifetime'];			if (isset ($this->smarty->_tpl_vars['sm'])) {				if (!isset ($this->smarty->_tpl_vars['old_sm'])) {					$this->smarty->_tpl_vars['old_sm'] = array ();				}				array_push($this->smarty->_tpl_vars['old_sm'], $this->smarty->_tpl_vars['sm']); //&				unset ($this->smarty->_tpl_vars['sm']);			}			// _output seems to be already set by meme_manager's meme_list			$this->smarty->assign("sm", $this->_output);  // this controls the $sm.res_meme etc for live feed, achievements, and more!!			//echo $this->smarty->add_theme_to_template($this->_output['tpl'].'.tpl' ).":::: ".$this->_output['cache_id'];			$module_name = $this->get_module_name();			$choice_name = $this->_output['choice'];			/*				if(isset($GLOBALS["{$module_name}_{$choice_name}_theme"])){					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_{$choice_name}_theme"]);					}elseif(isset($GLOBALS["{$module_name}_theme"])){					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_theme"]);					}			*/			// commenting this out removes live feed			// think _output['tpl'] comes from _meme_list func, called before this...			$ret = $this->smarty->fetch($this->smarty->add_theme_to_template($this->_output['tpl']),$this->_output['cache_id']);						//print $this->_output['res_meme'][0];		//D: for meme, it's meme_list -> how live feed is called			if (isset ($this->smarty->_tpl_vars['old_sm'])) {				$this->smarty->_tpl_vars['sm'] = & array_pop($this->smarty->_tpl_vars['old_sm']);			} else {				unset ($this->smarty->_tpl_vars['sm']);			}			$this->smarty->caching = $old_caching;			$this->smarty->cache_lifetime = $old_cache_lifetime;			return $ret;		}	}		function setMySession() {		$_SESSION['id_developer']=$_SESSION['id_admin']=$_SESSION['id_user']=-1;		$_SESSION['admin']=1;	}	function cache_alive() {		return $this->smarty->is_cached($this->_output['tpl'].TEMPLATE_EXTENSION, $this->_output['cache_id']);	}			function clear_cache($cache_string){		$this->smarty->caching = true;		$this->smarty->clear_cache(null,$cache_string);	}		function sendmail($input) {		for ($i = 0; $i < count($input); $i ++) {			$this->smarty->assign('_output', $input[$i]['_output']);			$mail_message = $this->smarty->fetch($input[$i]['template']);			mail($input[$i]['to'], $input[$i]['subject'], $mail_message, $input[$i]['header']);		}	}	function is_mod_manager(){		return ($this->get_module_name() === $this->get_manager_name());	}	//Added By Parwesh For Error Handling Only for methods in class	function default_error_handler(){		global $smarty;		$smarty->display('default/error_handler');	}};
