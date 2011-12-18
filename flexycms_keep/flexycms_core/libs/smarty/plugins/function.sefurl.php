<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* File:     function.sefurl.php
* Type:     function
* Name:     sefurl
* Purpose:  Creates a SEF Url 
*           
* -------------------------------------------------------------
*/
function smarty_function_sefurl($params, &$smarty  ){
   $url = $params['url'] ? $params['url'] : $_ENV['SCRIPT_NAME'];
   
   if(!empty($params['choice']))
   {
   	$url .='/choice/'.$params['choice'];
   }
   
  
   if(!empty($params['parameters']))
   {
     $id = explode('|',$params['parameters']);//Separating first parameter
	 if(is_array($id))
	 {
	  foreach($id as $v){
	   $_input[] = $v;
	   
	   $id1[] = explode('=' ,$v);//getting each comaparing field and value
	   }
		
	}
	$qs ='';
	if(is_array($id1)){
	 foreach($id1 as $k){
	   $qs.= $k[0].'/'.$k[1].'/';
	}	
	}
	$url .='/'.$qs;
   }
return $url;

}



?> 