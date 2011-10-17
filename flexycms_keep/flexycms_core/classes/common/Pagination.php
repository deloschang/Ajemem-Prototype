<?php
/**
 * This classes is to generate the next previous links for the humorcms
 * Style 1 ... 3 4 5 7 ... 28
**/

class Pagination{
	var $tcount;
	var $limit;
	var $start;
	
	function Pagination($tcount,$limit=10,$start=0,$linkto=''){
		$this->tcount = $tcount;
		$this->limit = $limit;
		$this->start = $start;
		$this->linkto = $linkto;
	}
	
	function gen_link($num){
		$anum = $num -1;
		$sym = '?';
		$this->linkto = preg_replace('/[\?|&]+start=\d+/','',$this->linkto);
		if($this->linkto && preg_match('/\?/',$this->linkto)){
			$sym = '&';
		}
		if($anum != $this->start){
			$gen_link = "<a class='pn' href='{$this->linkto}{$sym}start={$anum}'>$num</a> ";
		}else{
			$gen_link = " $num ";			
		}
		return $gen_link;
	}
	
	function generate(){
		$ncount = ceil((float)$this->tcount/(float)$this->limit);
		$this->num_links = $this->gen_link(1);
		if($ncount - 1 > 1){
			$second = $this->start-1;
			if(($ncount - ($this->start+1)) < 3){
				$temp = 3 - ($ncount - ($this->start+1));		
				if(($second - $temp) > 1){
					$second -= $temp;
				}
			}			
			if($second - 1 > 1){
				$this->num_links .= ' ... ';
				
			}else{
				$second = 2;	
			}
			for($i=0;$i<=4;$i++){
				$next = $i+$second;
				if($next < $ncount){
					$this->num_links .= $this->gen_link($next);							
				}else{
					break;
				}
			}
		}
		if($ncount - 1 > 0){
			if($next && ($ncount - $next) > 1){
				$this->num_links .= ' ... ';
			}			
			$this->num_links .= $this->gen_link($ncount);					
		}

		return $this->num_links;
	}
}
