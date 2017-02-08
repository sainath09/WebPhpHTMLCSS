<?php
  if($_POST['send'])
  {
	 session_start();
	 require "../../Connection.php";
	 $phone=$_POST['phone'];
	 $sub=$_POST['sub'];
	 $msg=$_POST['msg'];
	 $email=stripslashes($email);
	 $phone=stripslashes($phone);
	 $sub=stripslashes($sub);
	 $msg=stripslashes($msg);
	 $email=mysql_real_escape_string($email);
	 $phone=mysql_real_escape_string($phone);
	 $sub=mysql_real_escape_string($sub);
	 $msg=mysql_real_escape_string($msg);
	 mysql_query("INSERT INTO msg(Username,Subject,Msg,Phone) VALUES('".$_SESSION['username']."','$sub','$msg','$phone')") or die(mysql_error());
     echo '<script type="text/javascript"> alert("Message Sent Successfully"); </script>';
  }
  mysql_close($res);
  header('refresh:0;url=./');
?>