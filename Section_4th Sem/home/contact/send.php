<?php
  if($_POST['send'])
  {
	  session_start();
	  require "../../Connection.php";
	  $user=$_SESSION['username'];
	  $tab=mysql_query("SELECT * FROM $table WHERE Username='$user'") or die();
	  $result=mysql_fetch_array($tab) or die();
	  $pass=$_POST['password'];
	  if($result['Password']==$pass)
	  {
	   $msg=$_POST['msg'];
	   $sub=$_POST['sub'];
	   mysql_query("INSERT INTO msg(Username,Subject,Msg) VALUES('$user','$sub','$msg')");
       echo '<script type="text/javascript"> alert("Message Sent Successfully"); </script>';
	  }
	  else
	   echo '<script type="text/javascript"> alert("Sorry Password Mismatch.. Please Try Again..."); </script>';
  }
  else
  {
  }
  mysql_close($res);
  header('refresh:0;url=./');
?>