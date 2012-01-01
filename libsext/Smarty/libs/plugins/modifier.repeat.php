<?php
function smarty_modifier_repeat($string, $format=1)
{
	$s=str_repeat($string,$format);
	return $s;
}
?>