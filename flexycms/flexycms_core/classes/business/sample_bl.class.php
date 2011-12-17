<<<<<<< HEAD
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
=======
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
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
