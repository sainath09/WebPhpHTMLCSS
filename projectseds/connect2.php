<?php 
 $host="mysql11.000webhost.com";
 $root="a9360692_seds";
 $pass="Iamatsastra@1234";
 $db="a9360692_seds";
 $table="list";
 
 $res=mysql_connect($host,$root,$pass) or die("Not Found :P");
 $con=mysql_select_db($db,$res) or die("Not Found :P");
?>