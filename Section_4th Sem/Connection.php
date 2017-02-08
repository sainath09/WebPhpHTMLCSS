<?php 
 $host="localhost";
 $root="root";
 $pass="";
 $db="section";
 $table="sec";
 $res=mysql_connect($host,$root,$pass) or die("Not Found :P");
 $con=mysql_select_db($db,$res) or die("Not Found :P");
?>