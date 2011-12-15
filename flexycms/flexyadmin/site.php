<?php
class site {
	var $is_container_enabled = 1; 
	function init() {}
	
	function handle_page($page) {
		$this->smarty->caching = 1;
		$this->smarty->cache_lifetime = 2000;
		switch ($page) {
			case 'admin':
				$this->cache_id = "admin_login";
				$this->default_tpl = 'admin/userlogin';	
				break;			
			default :
				$this->cache_id = $page;
				$this->default_tpl = 'admin/'.$page.'/home';
				break;			
		}
	}
	
	function is_container_enabled($ce){
		return $ce;	
	}

	function get_container_tpl(){
		if($_SESSION['id_admin']){
			if($_SESSION['admin']){
				//$_SESSION['id_user']=$_SESSION['admin'];
				$_SESSION['display_name']=$_SESSION['admin_name'];
				$_SESSION['admin'] ='';
				$_SESSION['admin_name']='';
			}
			return "admin/home";
		}else{
			return "admin/userlogin";
		}	
	}
}
