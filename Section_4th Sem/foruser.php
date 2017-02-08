<?php
 require "Connection.php";
 $reg=$_POST['Reg'];
 $res=mysql_query("SELECT Username FROM $table WHERE Regno='$reg'") or die("Not Found :P");
 $result=mysql_fetch_array($res) or die("Not Found :P");
 if($result)
 $user=$result['Username'];
 else
 $user="Invalid Register No.";
 echo "<script type='text/javascript'> alert('$user'); </script>";
 header("Refresh:0;url=./");
?>