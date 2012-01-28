<?php
function get_maxids()
{
  $link = mysql_connect("localhost","demos4clients","d3m05dbp455") or die("Could not connect: ".mysql_error());
  mysql_select_db ("demos4clients_com_db") or die("Could not select database : ".mysql_error());
  $max_id_meme = mysql_query("SELECT MAX( id_meme ) FROM `memeje__meme`");

  $numberOfRows = mysql_num_rows($max_id_meme);
  $numberOfColumns = mysql_num_fields($max_id_meme);
  $print_str = mysql_result($max_id_meme, 0, 0);
  echo $print_str;
  return $print_str;
}
get_maxids();
?>
