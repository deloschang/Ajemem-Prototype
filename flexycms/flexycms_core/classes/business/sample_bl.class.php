<?php
require_once(AFIXI_CORE."classes/common/business.php");
class sample_bl extends business{
	function get_search_sql($search_condition=""){
		if(!$search_condition){
			$sql = "SELECT * FROM ".TABLE_PREFIX."sample" ;
		}else{

		}
		return $sql;
	}
};
