<<<<<<< HEAD
<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* File:     function.current_date_time.php
* Type:     function
* Name:     current_date_time
* Purpose:  Outputs the current Date and time 
*           
* -------------------------------------------------------------
*/
function smarty_function_current_date_time($params, &$smarty  ){

  if(empty($params['format'])) {
    $format = "%b-%e-%Y <BR> %I:%M:%S";
  } else {
    $format = $params['format'];
  }
$id = rand();
$time = strftime($format,time());
//print_r($smarty);
$tpl_file=$params['tpl_file'];
$str =<<<EOF
<a name='name_$id' href='#name_$id' onmouseover="window.status='View this date'; show(event, '$id'); return true;" onmouseout="hide('$id'); return true;">CT </a>
<div id='$id' class="popup"> $tpl_file <BR>  $time </div>
EOF;

return $str;

}



=======
<?php
/*
* Smarty plugin
* -------------------------------------------------------------
* File:     function.current_date_time.php
* Type:     function
* Name:     current_date_time
* Purpose:  Outputs the current Date and time 
*           
* -------------------------------------------------------------
*/
function smarty_function_current_date_time($params, &$smarty  ){

  if(empty($params['format'])) {
    $format = "%b-%e-%Y <BR> %I:%M:%S";
  } else {
    $format = $params['format'];
  }
$id = rand();
$time = strftime($format,time());
//print_r($smarty);
$tpl_file=$params['tpl_file'];
$str =<<<EOF
<a name='name_$id' href='#name_$id' onmouseover="window.status='View this date'; show(event, '$id'); return true;" onmouseout="hide('$id'); return true;">CT </a>
<div id='$id' class="popup"> $tpl_file <BR>  $time </div>
EOF;

return $str;

}



>>>>>>> 92a34e21bcd0e6ce28c090bc9e39740372d54833
?>