<<<<<<< HEAD
<?php
function smarty_modifier_suffixdate_format($string)
{
		if($string){
			$m=split('[/:-]', $string);
			$s=date("jS M Y", mktime(0, 0, 0, $m[1], $m[0], $m[2]));
		}
		return $s;
}
=======
<?php
function smarty_modifier_suffixdate_format($string)
{
		if($string){
			$m=split('[/:-]', $string);
			$s=date("jS M Y", mktime(0, 0, 0, $m[1], $m[0], $m[2]));
		}
		return $s;
}
>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>