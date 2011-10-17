<?php
class site {
	var $is_container_enabled = 1; 
	function init() {
		$this->container_tpl = "common/common";
	}
	function handle_page($page) {
		$this->cache_id = $page;
		$this->smarty->caching = 0;
		switch ($page) {
			case "static" :
				$type=$_REQUEST['choice'];
				$this->default_tpl = "static/$type";
				break;

			default :
				$this->is_container_enabled = isset($_REQUEST['ce'])?$_REQUEST['ce']:1;
				$this->default_tpl = $page.'/home';
				break;
		}
	}
	function is_container_enabled(){
		return $this->is_container_enabled;
	}
	function set_container_enabled($ce){
		$this->is_container_enabled = $ce;
	}
	function get_container_tpl(){
		return $this->container_tpl;
	}
}
