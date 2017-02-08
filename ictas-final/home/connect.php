<?php 
 $host="localhost";
 $root="root";
 $pass="";
 $db="ictas";
 $table="quiery";
 
 $res=mysql_connect($host,$root,$pass) or die("Not Found");
 $con=mysql_select_db($db,$res) or die("Not Found");
?>