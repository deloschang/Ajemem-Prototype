<?php
/**
 * Test class used in other examples
 * Constructors and private methods marked with _ are never exported in proxies to JavaScript
 */
include_once(AFIXI_CORE.'common.php');
class afixi_ajax{

	function afixi_ajax(){

	}

	function get_next_page($_input_ajax){
		if(is_object($_input_ajax))
		$_input_ajax = get_object_vars($_input_ajax);
		$qstart = $_input_ajax['qstart'];
		unset($_input_ajax['qstart']);
		if($qstart=='qstart'){
			$_REQUEST['qstart'] = $_input_ajax['dcount'];
			unset( $_input_ajax['dcount']);
		}else{
			$_REQUEST['qstart'] = $qstart;
		}
		$funname = $_input_ajax['fun_name'];
		unset($_input_ajax['fun_name']);
		return $this->{$funname}($_input_ajax);
	}

	function get_sorted_page($_input_ajax)	{
		if(is_object($_input_ajax))
		$_input_ajax = get_object_vars($_input_ajax);
		$_REQUEST['sort_by'] = $_input_ajax['sort_by'];
		$funname = $_input_ajax['fun_name'];
		unset($_input_ajax['fun_name']);
		$sort_by = $_input_ajax['sort_by'];
		unset($_input_ajax['sort_by']);
		return $this->{$funname}($_input_ajax);
	}

	function cache_alive(){
		if(empty($this->smarty)){
			$this->smarty = getSmarty();
			$this->smarty->caching=1;
		}
		return $this->smarty->is_cached($this->_output['tpl'].TEMPLATE_EXTENSION,$this->cache_id);
	}


	function getoutput(){
		$this->smarty->assign('AJAX', 1);
		$this->smarty->assign_by_ref("sm",$this->_output);
		$this->smarty->display($this->_output['tpl'],$this->cache_id);
	}


	function init_input(&$_input_ajax){
		if(is_object($_input_ajax)){
			$_input_ajax = get_object_vars($_input_ajax);
		}
		if(is_array($_input_ajax )){
			foreach ($_input_ajax as $k=>$v ){
				if(is_object($v)){
					$_input_ajax[$k] = get_object_vars($_input_ajax[$k]);
					if(is_array($_input_ajax[$k])){
						foreach($_input_ajax[$k] as $key => $val){
							if(is_object($val))
							$_input_ajax[$k][$key] = get_object_vars($_input_ajax[$k][$key]);
						}
					}
				}
			}
		}
		if(isset($_input_ajax['qstart']))
		$_REQUEST['qstart'] = $_input_ajax['qstart'];
		if(isset($_input_ajax['sort_by']))
		$_REQUEST['sort_by'] = $_input_ajax['sort_by'];
	}

	function clear_cache($cache_string){
		if(empty($this->smarty)){
			$this->smarty = getSmarty();
		}
		$this->smarty->caching = true;
		$this->smarty->clear_cache(null,$cache_string);
	}

}
