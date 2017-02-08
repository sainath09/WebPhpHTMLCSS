<?php 
 $host="mysql.1freehosting.com";
 $root="u252003751_user";
 $pass="mhaibbusmhaibbus";
 $db="u252003751_user";
 $table="sec";
 $res=mysql_connect($host,$root,$pass) or die("Not Found :P");
 $con=mysql_select_db($db,$res) or die("Not Found :P");
?>