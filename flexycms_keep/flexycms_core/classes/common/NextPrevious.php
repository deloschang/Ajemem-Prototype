<?php
	class NextPrevious {
	var $start;		// start is a record no
	var $dcount;		// dcount is a no of records to be displayed
	var $alink;		
	var $total;		// total is the total no of records
	var $linktag;
	var $show;
	var $fun_name;	
	var $divid;
	function NextPrevious($link,$sql,$module,$show=5, $count_on_parent='')
	{
		$this->dcount =  isset($GLOBALS['conf']['RECORDS_PER_PAGE']) ? $GLOBALS['conf']['RECORDS_PER_PAGE'] : 10;
		$this->start =  isset($_REQUEST['qstart']) ? $_REQUEST['qstart'] : 0 ;
		$this->alink = $link;
		$this->sql = $sql;
		$this->divid = $_REQUEST['page']."_".$_REQUEST['choice'];
		$this->module = $module;
		$this->show = $show;
		$this->count_on_parent = $count_on_parent;
/*		if(preg_match("/\/$/",$this->alink)) {
			$this->linktag = '';
		} else {
			$this->linktag = '-';
		}*/
		if (defined('LINK_SEPARATOR')) {
			$this->linktag = LINK_SEPARATOR;
		} else {
			$this->linktag = "-";
		}
	}

	function get_cacheid() {
		return md5($this->get_final_sql());
	}
	function oldgetlimitrows()	{
		$rows = getrows($this->get_final_sql(),$err);
		$this->page_last = $this->start+count($rows);
		return $rows;
	}
	function gettotalrows() {
		$sql = preg_replace('/\n/m','', $this->sql);
		if($this->count_on_parent){
			$sql = preg_replace('/.*( FROM .*)/im','SELECT COUNT(DISTINCT '.$this->count_on_parent.')  AS total_records $1 ', $sql);
		}else{
			if(preg_match('/HAVING/i',$sql) || preg_match('/[\s\t]UNION[\s\t]/i',$sql)){
			} else {
				$afterfrom = preg_split('/[\s\t]FROM[\s\t]/i',$sql);
				array_shift($afterfrom) ;
				$sql = "SELECT COUNT(*) AS total_records FROM ".implode(" FROM ", $afterfrom);
			}
		}
		$rows = getrows($sql,$err);
		if($this->count_on_parent){
			$sql1 = preg_replace('/.*( FROM .*)/im','SELECT COUNT(*)  AS child_records, '.$this->count_on_parent.' $1  GROUP BY '.$this->count_on_parent .' ORDER BY '.$_SESSION[$this->module][sort_by]."  ".$_SESSION[$this->module][sort_order] , $sql);
			$this->childs_count_arr = $this->getrows($sql1,$err);			
		}
		if(preg_match('/GROUP BY/i',$sql) || preg_match('/[\s\t]UNION[\s\t]/i',$sql) || preg_match('/[\s\t]HAVING[\s\t]/i',$sql)){
			return count($rows);
		}else{
			return $rows[0]['total_records'];
		}
	}
	function get_final_sql() {
		if($this->final_sql) return $this->final_sql ;
		$this->total = $this->gettotalrows();
		if ($this->start > $this->total) {
			$this->start = $this->total - $this->dcount;
		}
		$sql =$this->sql;
//		print "<br>".$sql."<br>";exit;
		if ($_SESSION[$this->module]['sort_by'] || $_SESSION[$this->module]['sort_order']){
			if(preg_match('/ORDER BY/i',$this->sql)){
				$sql.=' , '.$_SESSION[$this->module]['sort_by']."  ".$_SESSION[$this->module]['sort_order'] ;
			}else{ 
				$sql.=' ORDER BY '.$_SESSION[$this->module]['sort_by']."  ".$_SESSION[$this->module]['sort_order'] ; 
			}
		}
		if(!$this->count_on_parent){
			$this->start = ($this->start > $this->total  ) ? $this->total - $this->total%$this->dcount : $this->start ;
			$sql.= " LIMIT $this->start ,$this->dcount " ;
		}else{		
			$this->start = ($this->start > $this->total  ) ? $this->total - $this->total%$this->dcount : $this->start ;
			$start_from =0;
			for($i = 0 ; $i < ($this->start+$this->dcount); $i++)
				{
				if($i>=$this->start)
					{
						$getnext += $this->childs_count_arr[$i]['child_records'];
					}else{
						$start_from +=$this->childs_count_arr[$i]['child_records'];
					}
				}
			$sql.=" LIMIT $start_from , $getnext " ;
		}
		$this->final_sql = $sql;
		return $sql;
	}
	function new_get_final_sql() {
		$sql = "SELECT SQL_CALC_FOUND_ROWS ".substr($this->sql, 6);
		if ($_SESSION[$this->module]['sort_by'] || $_SESSION[$this->module]['sort_order']){
			if(preg_match('/ORDER BY/i',$this->sql)){
				$sql.=' , '.$_SESSION[$this->module]['sort_by']."  ".$_SESSION[$this->module]['sort_order'] ;
			}else{ 
				$sql.=' ORDER BY '.$_SESSION[$this->module]['sort_by']."  ".$_SESSION[$this->module]['sort_order'] ; 
			}
		}
		if(!$this->count_on_parent){
			$sql.= " LIMIT $this->start ,$this->dcount " ;
		}else{		
			$start_from =0;
			for($i = 0 ; $i < ($this->start+$this->dcount); $i++)
				{
				if($i>=$this->start)
					{
						$getnext += $this->childs_count_arr[$i]['child_records'];
					}else{
						$start_from +=$this->childs_count_arr[$i]['child_records'];
					}
				}
			$sql.=" LIMIT $start_from , $getnext " ;
		}
		$this->final_sql = $sql;
		return $sql;
	}
	function getlimitrows()	{
		$rows = getrows($this->new_get_final_sql(),$err);
		// Added By Parwesh
		//$foundrecs = mysql_fetch_array(mysql_query("SELECT FOUND_ROWS()"));
		$foundrecs = getarray();
		$this->total = $foundrecs[0];
		$this->page_last = $this->start+count($rows);
		return $rows;
	}
	function currentposition() {
		return "Showing : $this->start to $this->page_last of $this->total";
	}
	function currentpage() {
		$s = ceil($this->start/$this->dcount)+1;
		$_REQUEST['page_goto']=$s;
		$e = ceil($this->total/$this->dcount);
		return "<label>Page : $s of $e</label>";
	}
	function generateFirst($prev) {
		if(isset($this->ajax_func)){
			$generate = "\"javascript:get_next_page('$this->ajax_next_prev','0','$this->dcount', '$this->divid')\" Title=\"Previous Page\" >";
		}else{
			$generate = "'".$this->alink.$this->linktag."qstart{$this->linktag}0' Title=\"Previous Page\">";
		}
		return "<a class=\"page_other\" href=".$generate."<img src='/demo_flexycms/templates/images/first.jpg' /></a>";
	}
	function generateLast($next) {
		if ($this->total>0) {
			$next = floor($this->total/$this->dcount)*$this->dcount;
			if(isset($this->ajax_func)){
				$generate = "href=\"javascript:get_next_page('$this->ajax_next_prev','$next','$this->dcount', '$this->divid')\" >";
			}else{
				$generate = "href='".$this->alink.$this->linktag."qstart{$this->linktag}$next' >";
			}
			return "<a Title=\"page_next Page\" ".$generate."<img src='/demo_flexycms/templates/images/last.jpg' /></a>";
		}
	}
	function generateFirstLink($prev) {
		if(isset($this->ajax_func)){
			$r = "\"javascript:get_next_page('$this->ajax_next_prev','0','$this->dcount', '$this->divid')\"";
		}else{
			$r = "'".$this->alink.$this->linktag."qstart{$this->linktag}0'";
		}
		return "<a Title=\"First Page\" class=\"page_other\" href=".$r." >First</a>";
	}
	function generateLastLink($next) {
		if ($this->total>0) {
			if($this->total%$this->dcount!=0){
				$next = floor($this->total/$this->dcount)*$this->dcount;
			}else{
				$next = (floor($this->total/$this->dcount)-1)*$this->dcount;
			}
			
			if(isset($this->ajax_func)){
				$g = "\"javascript:get_next_page('$this->ajax_next_prev','$next','$this->dcount', '$this->divid')\"";
			}else{
				$g = "'".$this->alink.$this->linktag."qstart{$this->linktag}$next'";
			}
			return "<a Title='Last Page' class='page_other' href=".$g." >Last</a>";
		}
	}
	
	function generatePrevB($prev) {
		if(isset($this->ajax_func)){
			$generate = "\"javascript:get_next_page('$this->ajax_next_prev','$prev','$this->dcount', '$this->divid')\" Title=\"Previous Page\" >";
		}else{
			$generate = "'".$this->alink.$this->linktag."qstart{$this->linktag}$prev' Title=\"Previous Page\">";
		}
		return "<a class=\"page_other\" href=".$generate."<img src='/demo_flexycms/templates/images/previous.jpg' /></a>";
	}
	function generateNextB($next) {
		if(isset($this->ajax_func)){
			$generate = "href=\"javascript:get_next_page('$this->ajax_next_prev','$next','$this->dcount', '$this->divid')\" >";
		}else{
			$generate = "href='".$this->alink.$this->linktag."qstart{$this->linktag}$next' >";
		}
		return "<a Title='Next Page' class=\"page_other\"".$generate."<img src='/demo_flexycms/templates/images/next.jpg' /></a>";
	}

	function onlynextprev() {
		if($this->start > 1){
			$first = $this->generatePrev($this->start-$this->dcount);
		}
		if($this->page_last < $this->total){
			$last .= $this->generateNext($this->page_last);
		}
		return $first.$last;
	}

	function generateextra() {
		$start = ceil($this->start / $this->dcount);
		$end = ceil($this->total/$this->dcount);
		$min = $this->show-1;

		$fs = $start>0 ? $this->generateFirstLink($this->start) : "";
		$fs .= $start>0 ? $this->generatePrev($this->start-$this->dcount) : "";
		if ($end <= $this->show) {
			$fs .= $this->generateSeq(1,$end,$this->start);
		} elseif ($start < $min) {
			$fs .= $this->generateSeq(1,$this->show,$this->start);
			$fs .= ".....";
			$fs .= $this->generateSeq($end-1,$end,$this->start);
		} elseif ($start+$min >= $end) {
			$fs .= $this->generateSeq(1,2,$this->start);
			$fs .= ".....";
			$fs .= $this->generateSeq($end-$min,$end,$this->start);
		} else {
			$fs .= $this->generateSeq(1,2,$this->start);
			$fs .= ".....";
			$p = $start - floor($this->show/2) + 1;
			$fs .= $this->generateSeq($p,$p+$this->show-1,$this->start);
			$fs .= ".....";
			$fs .= $this->generateSeq($end-1,$end,$this->start);
		}
		$fs .= $start+1<>$end ? $this->generateNext($this->start+$this->dcount) : "";
		$fs .= $start+1<>$end ? $this->generateLastLink($this->total-$this->dcount) : "";
		return $fs;
	}

	function generateadv() {
		$start = intval($this->start / ($this->dcount*$this->show));
		$start = ($start)*$this->show+1;
		$end = $start + $this->show -1;
		if($this->start > 1){
			$first = $this->generateFirst(0);
			$first .= $this->generatePrevB($this->start-$this->dcount);
		}
		if($this->page_last < $this->total){
			$last .= $this->generateNextB($this->page_last);
			$last .= $this->generateLast($this->total-$this->show);
		}
		$output = $this->currentpage();
		return "<form action='{$this->alink}' method='get' name='pg'><label>Page :</label><input type='text' size='1' name='page_goto' class='txtbox' value='{$_REQUEST[page_goto]}'><label>Show rows:</label><select name='page_norec' id='page_norec'><option value='5'>5</option><option value='10'>10</option><option value='25'>25</option><option value='50'>50</option><option value='100'>100</option><option label='All' value='10000'>All</option></select><input class='submit_btn' type='submit' value='Go'> {$first} {$output} {$last}</form><script type='text/javascript'>document.getElementById('page_norec').value='{$_REQUEST[page_norec]}';</script>";
	}

	function generate() {
		$start = intval($this->start / ($this->dcount*$this->show));
		$start = ($start)*$this->show+1;
		$end = $start + $this->show -1;
		if($start > 1){
			$first = $this->generatePrev($this->start-$this->dcount);
		}else{
			$first ='';
		}
		if((($end) * $this->dcount) < $this->total){
			$last .= $this->generateNext($this->page_last);
		}else{
			$end = ceil($this->total/$this->dcount);
			$last='';
		}
		if(isset($this->ajax_next_prev)) {
			$output = $first. $this->ajax_generateSeq($start,$end,$this->start). $last;
		}else{
			$output = $first. $this->generateSeq($start,$end,$this->start). $last;
		}
		return $output;
	}

	function generate1() {
		$start = intval($this->start / ($this->dcount*$this->show));
		
		$start = ($start)*$this->show+1;
		$end = $start + $this->show -1;
		
		if($this->start > 0){
			$first = $this->generatePrev($this->start-$this->dcount);
		}else{
			$first ='';
		}
		$end = min($end, ceil($this->total/$this->dcount));

		if($this->page_last < $this->total){
			$last .= $this->generateNext($this->page_last);
		}else{
			$end = ceil($this->total/$this->dcount);
			$last='';
		}

		
		
		if(isset($this->ajax_next_prev)) {
			$output = $this->ajax_generateSeq($start,$end,$this->start).$first.$last;
		}else{
			$output = $this->generateSeq($start,$end,$this->start).$first.$last;
		}
		return $output;
	}

	function generatePrev($prev) {
		if(isset($this->ajax_func)){
			$generate = "\"javascript:get_next_page('$this->ajax_next_prev','$prev','$this->dcount', '$this->divid')\" Title=\"Previous Page\" >";
		}else{
			$generate = "'".$this->alink.$this->linktag."qstart{$this->linktag}$prev' Title=\"Previous Page\">";
		}
		if ($prev<0) {
			$generate = "javascript:viod(0);";
		}
		return "<a Title='Previous Page' class='page_other previous' href=".$generate."&lt; Prev</a>";
	}

	function generateNext($next) {
		if ($this->total>0) {
			if(isset($this->ajax_func)){
				$generate = "\"javascript:get_next_page('$this->ajax_next_prev','$next','$this->dcount', '$this->divid')\"";
			}else{
				$generate = "'".$this->alink.$this->linktag."qstart{$this->linktag}$next'";
			}
			if ($this->total<=$next) {
				$generate = "javascript:viod(0);";
			}
			return "<a Title='Next Page' class='page_other next' href=".$generate." >Next &gt;</a>";
		}
	}

	function generateSeq($start,$end,$high) {
		$generate = '';
		for($i=$start;$i<=$end;$i++){
			$j = ($i-1)*($this->dcount);
			if($high != $j){
				if(isset($this->ajax_func)){
					$generate.= "<a class='page_next' href=\"javascript:get_next_page('$this->ajax_next_prev','$j','$this->dcount', '$this->divid')\" Title=\"Page $i\" >$i</a>&nbsp;" ;
				}else{
					$generate .= "<a class=\"page_next\" href='".$this->alink.$this->linktag."qstart{$this->linktag}$j' Title=\"Page $i\">$i</a>&nbsp;";
				}
			} else{
				if(isset($this->ajax_func)){
					$generate.= "<a class=\"page_current\" href=\"javascript:get_next_page('$this->ajax_next_prev','$j','$this->dcount', '$this->divid')\" Title=\"Page $i\" >$i</a>&nbsp;";
				}else{
					$generate .= "<a class=\"page_current\" href='".$this->alink.$this->linktag."qstart{$this->linktag}$j' Title=\"Page $i\">$i</a>&nbsp;";
				}
			}
		}
		return $generate;
	}

	function ajax_generateSeq($start,$end,$high) {
		$generate = '';
		for($i=$start;$i<=$end;$i++){
			$j = ($i-1)*($this->dcount);
			if($high != $j)
			{
				$generate.= "<a class=\"page_next\"  href=\"javascript:get_next_page('$this->ajax_next_prev','$j','$this->dcount', '$this->divid')\" > $i </a>&nbsp;" ;
			}else{
				$generate.= "<a class=\"page_current\" href=\"javascript:get_next_page('$this->ajax_next_prev','$j','$this->dcount', '$this->divid')\" >$i</a>&nbsp;" ;
			}
		}
		return $generate;
	}
}
