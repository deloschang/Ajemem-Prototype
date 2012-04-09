<?php
function incr_exp_points()
{
  $id_user = $_GET["id_user"];
  $link = mysql_connect("localhost", "root", "") or die("Could not connect: ".mysql_error());
  mysql_select_db ("demos4clients_com_db") or die("Could not select database : ".mysql_error());
  $max_id_meme = mysql_query("UPDATE memeje__user SET exp_point=exp_point+10 WHERE id_user=".$id_user);

  mysql_close($link);
}
incr_exp_points();
?>