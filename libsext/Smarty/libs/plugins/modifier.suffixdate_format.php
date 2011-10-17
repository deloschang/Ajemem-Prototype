<?php
function smarty_modifier_suffixdate_format($string)
{
		if($string){
			$m=split('[/:-]', $string);
			$s=date("jS M Y", mktime(0, 0, 0, $m[1], $m[0], $m[2]));
		}
		return $s;
}
?>