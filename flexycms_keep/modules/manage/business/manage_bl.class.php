<<<<<<< HEAD
<?php
class manage_bl extends business{
    function get_search_sql($tbl,$cond,$cols='*'){
		$sql = 'CALL get_search_sql("'.TABLE_PREFIX.$tbl.'","'.$cond.'","'.$cols.'")';
		return $sql;
    }
    function get_max_recs($tbl,$cols='*',$cond){
		$sql = 'CALL get_max_recs("'.$tbl.'","'.$cols.'","'.$cond.'")';
		return $sql;
    }
=======
<?php
class manage_bl extends business{
    function get_search_sql($tbl,$cond,$cols='*'){
		$sql = 'CALL get_search_sql("'.TABLE_PREFIX.$tbl.'","'.$cond.'","'.$cols.'")';
		return $sql;
    }
    function get_max_recs($tbl,$cols='*',$cond){
		$sql = 'CALL get_max_recs("'.$tbl.'","'.$cols.'","'.$cond.'")';
		return $sql;
    }
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
}