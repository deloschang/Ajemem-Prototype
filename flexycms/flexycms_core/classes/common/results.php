<<<<<<< HEAD
<?php

class results
{

	function results(){

	}

	function getOutput($sql,$uri,$table,$tpl,$class_func='',$cache_id=''){
			//global $stats;
			$next_prev = new NextPrevious(APP_ROOT_URL.$uri,$sql,$table);
			if($class_func){
				$next_prev->ajax_next_prev=$class_func;
				$_output['ajax_func'] = $class_func;
			}
			//if(!$smarty->is_cached($tpl."tpl.html",$cache_id)){
				$_output['list']=$next_prev->getlimitrows();
				$_output['next_prev'] = $next_prev;
				//$_output['debug'] = 1;
				//$_output['stats'] = $stats;
			//}
			return $_output;
		}
}
=======
<?php

class results
{

	function results(){

	}

	function getOutput($sql,$uri,$table,$tpl,$class_func='',$cache_id=''){
			//global $stats;
			$next_prev = new NextPrevious(APP_ROOT_URL.$uri,$sql,$table);
			if($class_func){
				$next_prev->ajax_next_prev=$class_func;
				$_output['ajax_func'] = $class_func;
			}
			//if(!$smarty->is_cached($tpl."tpl.html",$cache_id)){
				$_output['list']=$next_prev->getlimitrows();
				$_output['next_prev'] = $next_prev;
				//$_output['debug'] = 1;
				//$_output['stats'] = $stats;
			//}
			return $_output;
		}
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
