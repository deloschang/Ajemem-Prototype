<<<<<<< HEAD
<?php
class mod_manager {
	
	function mod_manager(& $smarty, & $_output, & $_input, $module) {
		$this->smarty = & $smarty;
		$this->global_output = & $_output;
		$this->_input = & $_input;
		$this->module = $module;
		include_files('modules/'.$module);
		if (!defined("THROUGH_CONTROLLER")) {
			$obj = new user_templates;
			$this->smarty->register_function('get_mod', array (&$obj, 'get_mod'));
		}
	}
	
	function run($arg) {
		unset ($this->output_set);
		unset ($this->_output);
		unset ($this->arg);
		$this->arg = $arg;
		$module = $this->arg['module']?$this->arg['module']:$this->_input['module'];
		$module = $module?$module:$this->_input['mod'];
		$mgr = 	$this->arg['mgr']?$this->arg['mgr']:$this->_input['mgr'];
		$mgr = $mgr?$mgr:$module;
		$module = $module?$module:$mgr;
		$mgr_choice = $this->get_manager_name().'_choice';
		$choice = isset ($arg[$mgr_choice]) ? $arg[$mgr_choice] : $this->_input[$mgr_choice];
		
		if(!$choice){
			$choice = isset ($arg['choice']) ? $arg['choice'] : $this->_input['choice'];			
			$choice = isset ($choice) ? $choice : $_REQUEST['choice'];
			$choice = isset ($choice) ? $choice : "default";
		}
		$choice = $choice?$choice: "default";
		if ($module=="user" && $choice=="set_login") {
			if (checkforadmin($this->_input['username'], $this->_input['password'])) {
				$this->setMySession();
				redirect(LBL_ADMIN_SITE_URL."index.php");
			}
        	}
		$this->_output['tpl'] = isset ($arg['tpl']) ? $arg['tpl'] : $this->_input['tpl'];
		$module_name = $this->get_module_name();		
		if ($GLOBALS[$module_name.'_'.$choice]) {
			$this->_output = $GLOBALS[$module_name.'_'.$choice];
		}
		$function_name = '_'.$choice;
		$start = getmicrotime();
		$GLOBALS['func_name'] = $module_name.'_'.$function_name;
		$this->_output = $GLOBALS['obj_pre_events']->run($module,$mgr,$choice,$this->_input,$this->_output);

		//Added By Parwesh For Error Handling Only for methods in class
		if (method_exists($this,$function_name)) {
			$action_result = $this->{$function_name}();
			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);
			if ($this->action_obj){
		    		unset ($GLOBALS['func_name']);
			 	unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
				return $action_result;
			}
			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {
				$this->_output['debug'] = 1;
				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];
				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;
			}
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
		
			$result = $this->getoutput();
	
			return $result;
		}else {			
		    if (method_exists($this,manager_error_handler)) {
			$action_result = $this->manager_error_handler();
			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);
			if ($this->action_obj){
				unset ($GLOBALS['func_name']);
				unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
				return $action_result;
			}
			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {
				$this->_output['debug'] = 1;
				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];
				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;
			}
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);

			$result = $this->getoutput();

			return $result;

		    }else{
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
			$this->default_error_handler();
		    }				
		}
	}
	function getoutput() {
		//$this->_output['debug']=1; 
		if (isset ($this->output_set))
			return $this->output_set;
		if (!$this->_output['tpl'])
			return;
		//$this->smarty->assign('_output',$this->_output);
		if ($this->_input['ce']) {
			eval ('$page_title=\''.$GLOBALS['conf']['PAGE_HEADERS'][$this->module.'_module_title'].'\';');
			$this->smarty->assign('page_title', $page_title);
			$this->smarty->assign('content', $this->smarty->add_theme_to_template($this->_output['tpl'].'tpl'));
			$tpl = $this->_input['mtpl'] ? $this->_input['mtpl'] : 'common/home.tpl';
			return $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
		} else {
			$old_caching = $this->smarty->caching;
			$old_cache_lifetime = $this->smarty->cache_lifetime;
			$this->smarty->caching = $this->_output['caching'];
			$this->smarty->cache_lifetime = $this->_output['cache_lifetime'];
			if (isset ($this->smarty->_tpl_vars['sm'])) {
				if (!isset ($this->smarty->_tpl_vars['old_sm'])) {
					$this->smarty->_tpl_vars['old_sm'] = array ();
				}
				array_push($this->smarty->_tpl_vars['old_sm'], $this->smarty->_tpl_vars['sm']); //&
				unset ($this->smarty->_tpl_vars['sm']);
			}
			$this->smarty->assign("sm", $this->_output);
			//echo $this->smarty->add_theme_to_template($this->_output['tpl'].'.tpl' ).":::: ".$this->_output['cache_id'];
			$module_name = $this->get_module_name();
			$choice_name = $this->_output['choice'];
			/*
				if(isset($GLOBALS["{$module_name}_{$choice_name}_theme"])){
					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_{$choice_name}_theme"]);	
				}elseif(isset($GLOBALS["{$module_name}_theme"])){
					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_theme"]);	
				}
			*/
			$ret = $this->smarty->fetch($this->smarty->add_theme_to_template($this->_output['tpl']),$this->_output['cache_id']);
			if (isset ($this->smarty->_tpl_vars['old_sm'])) {
				$this->smarty->_tpl_vars['sm'] = & array_pop($this->smarty->_tpl_vars['old_sm']);
			} else {
				unset ($this->smarty->_tpl_vars['sm']);
			}
			$this->smarty->caching = $old_caching;
			$this->smarty->cache_lifetime = $old_cache_lifetime;
			return $ret;
		}
	}
	
	function setMySession() {
		$_SESSION['id_developer']=$_SESSION['id_admin']=$_SESSION['id_user']=-1;
		$_SESSION['admin']=1;
	}
	function cache_alive() {
		return $this->smarty->is_cached($this->_output['tpl'].TEMPLATE_EXTENSION, $this->_output['cache_id']);
	}	
	
	function clear_cache($cache_string){
		$this->smarty->caching = true;
		$this->smarty->clear_cache(null,$cache_string);
	}
	
	function sendmail($input) {
		for ($i = 0; $i < count($input); $i ++) {
			$this->smarty->assign('_output', $input[$i]['_output']);
			$mail_message = $this->smarty->fetch($input[$i]['template']);
			mail($input[$i]['to'], $input[$i]['subject'], $mail_message, $input[$i]['header']);
		}
	}
	function is_mod_manager(){
		return ($this->get_module_name() === $this->get_manager_name());
	}

	//Added By Parwesh For Error Handling Only for methods in class
	function default_error_handler(){
		global $smarty;
		$smarty->display('default/error_handler');
	}
};
=======
<?php
class mod_manager {
	
	function mod_manager(& $smarty, & $_output, & $_input, $module) {
		$this->smarty = & $smarty;
		$this->global_output = & $_output;
		$this->_input = & $_input;
		$this->module = $module;
		include_files('modules/'.$module);
		if (!defined("THROUGH_CONTROLLER")) {
			$obj = new user_templates;
			$this->smarty->register_function('get_mod', array (&$obj, 'get_mod'));
		}
	}
	
	function run($arg) {
		unset ($this->output_set);
		unset ($this->_output);
		unset ($this->arg);
		$this->arg = $arg;
		$module = $this->arg['module']?$this->arg['module']:$this->_input['module'];
		$module = $module?$module:$this->_input['mod'];
		$mgr = 	$this->arg['mgr']?$this->arg['mgr']:$this->_input['mgr'];
		$mgr = $mgr?$mgr:$module;
		$module = $module?$module:$mgr;
		$mgr_choice = $this->get_manager_name().'_choice';
		$choice = isset ($arg[$mgr_choice]) ? $arg[$mgr_choice] : $this->_input[$mgr_choice];
		
		if(!$choice){
			$choice = isset ($arg['choice']) ? $arg['choice'] : $this->_input['choice'];			
			$choice = isset ($choice) ? $choice : $_REQUEST['choice'];
			$choice = isset ($choice) ? $choice : "default";
		}
		$choice = $choice?$choice: "default";
		if ($module=="user" && $choice=="set_login") {
			if (checkforadmin($this->_input['username'], $this->_input['password'])) {
				$this->setMySession();
				redirect(LBL_ADMIN_SITE_URL."index.php");
			}
        	}
		$this->_output['tpl'] = isset ($arg['tpl']) ? $arg['tpl'] : $this->_input['tpl'];
		$module_name = $this->get_module_name();		
		if ($GLOBALS[$module_name.'_'.$choice]) {
			$this->_output = $GLOBALS[$module_name.'_'.$choice];
		}
		$function_name = '_'.$choice;
		$start = getmicrotime();
		$GLOBALS['func_name'] = $module_name.'_'.$function_name;
		$this->_output = $GLOBALS['obj_pre_events']->run($module,$mgr,$choice,$this->_input,$this->_output);

		//Added By Parwesh For Error Handling Only for methods in class
		if (method_exists($this,$function_name)) {
			$action_result = $this->{$function_name}();
			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);
			if ($this->action_obj){
		    		unset ($GLOBALS['func_name']);
			 	unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
				return $action_result;
			}
			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {
				$this->_output['debug'] = 1;
				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];
				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;
			}
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
		
			$result = $this->getoutput();
	
			return $result;
		}else {			
		    if (method_exists($this,manager_error_handler)) {
			$action_result = $this->manager_error_handler();
			$this->_output = $GLOBALS['obj_post_events']->run($module,$mgr,$choice,$this->_input,$this->_output);
			if ($this->action_obj){
				unset ($GLOBALS['func_name']);
				unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
				return $action_result;
			}
			if ($this->debug || $this->arg['debug'] || $this->_output['debug']) {
				$this->_output['debug'] = 1;
				$this->_output['stats']['func'][$module_name.'_'.$function_name] = $GLOBALS['stats']['func'][$module_name.'_'.$function_name];
				$this->_output['stats']['func'][$module_name.'_'.$function_name]['time'] = getmicrotime() - $start;
			}
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);

			$result = $this->getoutput();

			return $result;

		    }else{
			unset ($GLOBALS['func_name']);
			unset ($GLOBALS['stats']['func'][$module_name.'_'.$function_name]);
			$this->default_error_handler();
		    }				
		}
	}
	function getoutput() {
		//$this->_output['debug']=1; 
		if (isset ($this->output_set))
			return $this->output_set;
		if (!$this->_output['tpl'])
			return;
		//$this->smarty->assign('_output',$this->_output);
		if ($this->_input['ce']) {
			eval ('$page_title=\''.$GLOBALS['conf']['PAGE_HEADERS'][$this->module.'_module_title'].'\';');
			$this->smarty->assign('page_title', $page_title);
			$this->smarty->assign('content', $this->smarty->add_theme_to_template($this->_output['tpl'].'tpl'));
			$tpl = $this->_input['mtpl'] ? $this->_input['mtpl'] : 'common/home.tpl';
			return $this->smarty->fetch($this->smarty->add_theme_to_template($tpl));
		} else {
			$old_caching = $this->smarty->caching;
			$old_cache_lifetime = $this->smarty->cache_lifetime;
			$this->smarty->caching = $this->_output['caching'];
			$this->smarty->cache_lifetime = $this->_output['cache_lifetime'];
			if (isset ($this->smarty->_tpl_vars['sm'])) {
				if (!isset ($this->smarty->_tpl_vars['old_sm'])) {
					$this->smarty->_tpl_vars['old_sm'] = array ();
				}
				array_push($this->smarty->_tpl_vars['old_sm'], $this->smarty->_tpl_vars['sm']); //&
				unset ($this->smarty->_tpl_vars['sm']);
			}
			$this->smarty->assign("sm", $this->_output);
			//echo $this->smarty->add_theme_to_template($this->_output['tpl'].'.tpl' ).":::: ".$this->_output['cache_id'];
			$module_name = $this->get_module_name();
			$choice_name = $this->_output['choice'];
			/*
				if(isset($GLOBALS["{$module_name}_{$choice_name}_theme"])){
					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_{$choice_name}_theme"]);	
				}elseif(isset($GLOBALS["{$module_name}_theme"])){
					$this->smarty->AfixiSmarty($GLOBALS["{$module_name}_theme"]);	
				}
			*/
			$ret = $this->smarty->fetch($this->smarty->add_theme_to_template($this->_output['tpl']),$this->_output['cache_id']);
			if (isset ($this->smarty->_tpl_vars['old_sm'])) {
				$this->smarty->_tpl_vars['sm'] = & array_pop($this->smarty->_tpl_vars['old_sm']);
			} else {
				unset ($this->smarty->_tpl_vars['sm']);
			}
			$this->smarty->caching = $old_caching;
			$this->smarty->cache_lifetime = $old_cache_lifetime;
			return $ret;
		}
	}
	
	function setMySession() {
		$_SESSION['id_developer']=$_SESSION['id_admin']=$_SESSION['id_user']=-1;
		$_SESSION['admin']=1;
	}
	function cache_alive() {
		return $this->smarty->is_cached($this->_output['tpl'].TEMPLATE_EXTENSION, $this->_output['cache_id']);
	}	
	
	function clear_cache($cache_string){
		$this->smarty->caching = true;
		$this->smarty->clear_cache(null,$cache_string);
	}
	
	function sendmail($input) {
		for ($i = 0; $i < count($input); $i ++) {
			$this->smarty->assign('_output', $input[$i]['_output']);
			$mail_message = $this->smarty->fetch($input[$i]['template']);
			mail($input[$i]['to'], $input[$i]['subject'], $mail_message, $input[$i]['header']);
		}
	}
	function is_mod_manager(){
		return ($this->get_module_name() === $this->get_manager_name());
	}

	//Added By Parwesh For Error Handling Only for methods in class
	function default_error_handler(){
		global $smarty;
		$smarty->display('default/error_handler');
	}
};
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
