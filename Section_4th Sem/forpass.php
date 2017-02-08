<?php
 require "Connection.php";
 $email=$_POST['email'];
 $email=stripslashes($email);
 $email= mysql_real_escape_string($email);
 $res=mysql_query("SELECT * FROM $table WHERE Email='$email'") or die("Not Found :P.....  Better Luck Next Time");
 $result=mysql_fetch_array($res) or die("Not Found :P...  Better Luck Next Time...");
 if($result)
 {
  mysql_query("UPDATE $table SET Password='password',Passreset =  '1' WHERE $table.Email='$email'") or die("Not Found :P");
  echo "<script> alert('Your New Password is password. Please do login change it.') </script>";
  header("refresh:0 ; url=./");
 }
 else
 {
  echo "<script> alert('Invalid Email ID'); </script>";
  header("refresh:0;url=./");
 }
?>