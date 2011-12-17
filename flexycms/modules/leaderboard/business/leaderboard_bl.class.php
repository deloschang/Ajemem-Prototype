<<<<<<< HEAD
<?php
class leaderboard_bl extends business{
    function get_search_sql($tbl,$cond,$cols='*'){
		$sql = 'CALL get_search_sql("'.TABLE_PREFIX.$tbl.'","'.$cond.'","'.$cols.'")';
		return $sql;
    }
}

=======
<?php
class leaderboard_bl extends business{
    function get_search_sql($tbl,$cond,$cols='*'){
		$sql = 'CALL get_search_sql("'.TABLE_PREFIX.$tbl.'","'.$cond.'","'.$cols.'")';
		return $sql;
    }
}

>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>