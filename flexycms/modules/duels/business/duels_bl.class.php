<?php
class duels_bl extends business{
    function get_search_sql($tbl,$cond,$cols='*'){
		$sql = 'CALL get_search_sql("'.TABLE_PREFIX.$tbl.'","'.$cond.'","'.$cols.'")';
		return $sql;
    }
}
