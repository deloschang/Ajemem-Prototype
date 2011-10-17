<?php


function smarty_block_addliteral( $params, $content, &$smarty, &$repeat)
{

   //echo " In my_literal with $content <HR>";
   if($content) return "{literal}\n $content {/literal}\n";	
}
?> 
