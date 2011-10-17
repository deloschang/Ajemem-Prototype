<?php
/**
 * Test class used in other examples
 * Constructors and private methods marked with _ are never exported in proxies to JavaScript
 */

class sample_ajax extends afixi_ajax{

function sample_ajax(){
		$this->bl_obj = new sample_bl;
		$this->obj_stud = new sample_student;
	}

function sample_list($_input_ajax)	{
	    $this->init_input($_input_ajax);
		$sql = $this->bl_obj->get_search_sql("");
		$results_params = Array(
			'AJAX_FUNC' => "sample','sample_list" ,
			'SQL' => $sql,
			'MODULE' => 'sample',
			'CACHE_PREPEND' =>'ajax|sample|list|',
			'RESULTS_UNDER' => 'student_list',
			'DEBUG' => 1 
		);
		$this->_output=$this->bl_obj->setupresults($results_params);
		$this->cache_id =$this->bl_obj->get_cache_id();
		$this->_output['tpl'] = "user/sample/list";
		$this->_output['cache_id'] =$this->bl_obj->get_cache_id();
		if(!$this->cache_alive()){
			$this->_output = array_merge($this->_output, $this->bl_obj->get_output()); 
			$this->_output['TITLE']="event List";
			$this->_output['use_session'] = "1";
			$this->_output['search_event'] = $_SESSION['search_event'];
			$this->_output['choice'] ='student_list';
		}
		ob_start();
		$this->getoutput();
		$x = ob_get_contents();
		ob_end_clean();
		return "$x"	;
	}

function sample_add(){
	if(!$this->cache_alive()){
		$this->_output['TITLE']="Add Student Detail";
		$this->_output['debug'] = 1;
		$this->_output['choice'] = "insert";
		$this->_output['tpl'] = "user/sample/add_new";
		ob_start();
		$this->getoutput();
		$x = ob_get_contents();
		ob_end_clean();
		return "$x"	;		
		}
	}


function sample_edit($_input_ajax)	{
		$this->init_input($_input_ajax);
		if(!$this->cache_alive()){
			if(!$this->_output['add_new']){  
	             $this->obj_stud->get_sample_student($_input_ajax['username']);
	             $this->_output['add_new']=get_object_vars($this->obj_stud);
			}	
			$this->_output['TITLE']="Edit sample_student Detail";
			$this->_output['stats'] = $stats;
			$this->_output['tpl'] = "user/sample/add_new";
			$this->_output['choice'] = "update";
		}		
		ob_start();
		$this->getoutput();
		$x = ob_get_contents();
		ob_end_clean();
		return "$x"	;		
	}

function sample_update($_input_ajax){
		$this->init_input($_input_ajax);
		$this->_output['TITLE']="Update Sample Detail";
		$this->obj_stud->loadfromarr($_input_ajax['add_new']);
		$err = $this->obj_stud->validate();
		if($err){
			$this->_output['err'] = $err;
			$this->_output['add_new'] = $_input_ajax;
			$this->_output['message'] =getmessage('check_valid','en');
			$_SESSION['raise_message']['sample'] = getmessage('check_valid', 'en',$err);
			$_SESSION['raise_message']['global'] = getmessage('check_valid', 'en',$err);
			return $this->sample_edit($dummy);
		}else{
			$err = $this->obj_stud->update($err);
			if($err!== TRUE){
				$this->_output['message'][]=getmessage('Update Failure','en',$err);
				$this->_output['add_new'] = $_input_ajax['add_new'];
				return $this->sample_edit($dummy);
			}else{
				$this->clear_cache('ajax|sample|list');
				$this->clear_cache('sef|sample|list');
				$_SESSION['raise_message']['sample'] = getmessage('Update Succes', 'en');
				$_SESSION['raise_message']['global'] = getmessage('Update Succes', 'en');
				return $this->sample_list($dummy);
			}	
		}
	$this->_output['tpl'] = "sample/list";
	}

function sample_insert($_input_ajax){
		$this->init_input($_input_ajax);
		$this->obj_stud->loadfromarr($_input_ajax['add_new']);
		$err = $this->obj_stud->validate();
		if($err){
			$this->_output['err']= $err;
			$this->_output['message']=getmessage('check_valid','en');
			$_SESSION['raise_message']['sample'] = getmessage('check_valid', 'en',$err);
			$_SESSION['raise_message']['global'] = getmessage('check_valid', 'en',$err);
			$this->_output['add_new'] = $_input_ajax;
			return 	$this->sample_add();
		}else{
			$err = $this->obj_stud->insert($err);
			if($err !== TRUE ){
				$this->_output['message'][]=getmessage('Insert Failure','en');
				$this->_output['add_new'] = $_input_ajax;
				return 	$this->sample_add(); 
			}else{
				$this->clear_cache('ajax|sample|list');
				$this->clear_cache('sef|sample|list');
				$_SESSION['raise_message']['sample'] = getmessage('Insert Succes', 'en');
				$_SESSION['raise_message']['global'] = getmessage('Insert Succes', 'en');
				return $this->sample_list($dummy);
			}
		}
		$this->_output['tpl'] = "sample/list";
	}

function sample_delete($_input_ajax){
		if(is_object($_input_ajax))
		$_input_ajax = get_object_vars($_input_ajax);
		$err = $this->obj_stud->delete($_input_ajax['username']);
		if($err !== TRUE){
		$_SESSION['raise_message'] = getmessage('delete_failure','en');
		}else{
			$this->clear_cache('ajax|sample|list');
			$this->clear_cache('sef|sample|list');
		  	$_SESSION['raise_message'] = getmessage('delete_success','en');
		}
		return	$this->sample_list($dummy);
	}


}
