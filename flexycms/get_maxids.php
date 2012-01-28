<?php
function get_maxids()
{
  echo "HHHHHHHHH";
		$link = mysql_connect("localhost",DB_USER,DB_PASS,DB_DB) or die("Could not connect: ".mysql_error()); //change this to DB_HOST when live
		mysql_select_db (DB_DB) or die("Could not select database : ".mysql_error());
  #$link = mysql_connect("localhost",DB_USER,DB_PASS,DB_DB) or die("Could not connect: ".mysql_error());
  $max_id_meme = mysql_query("SELECT MAX( id_meme ) FROM `memeje__meme`");
  echo $max_id_meme;
  return $max_id_meme;
}
get_maxids();
?>

