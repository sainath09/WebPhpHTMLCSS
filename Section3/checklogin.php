<html>
<head>
<script type="text/javascript">
function validate()
{
     var p=document.forms["signup"]["password"].value;
	 var cp=document.forms["signup"]["confirmpassword"].value;
	 if(p!=cp)
	 {
		 alert("Password Mismatch");
		 return false;
	 }
}
</script>
</head>
</html>


<?php
 require "Connection.php";
 session_start();
 if(isset($_POST['passreset']))
 {
  $pass=$_POST['password'];
  $user=$_POST['name'];
  $user= stripslashes($user);
  $pass= stripslashes($pass);
  $user= mysql_real_escape_string($user);
  $pass= mysql_real_escape_string($pass);
  mysql_query("UPDATE $table SET Passreset='0',Password='$pass' WHERE Username='$user'") or die("Not Found :P");
  echo '<script> alert("Password Changed Successfully"); </script>';
  header("Refresh:0;url=./");
 }
 else if($_POST['login'])
 {
	 $name=$_POST['username'];
	 $pass=$_POST['password'];
	 $name= stripslashes($name);
     $pass= stripslashes($pass);
     $name= mysql_real_escape_string($name);
     $pass= mysql_real_escape_string($pass);
     $u=mysql_query("SELECT * FROM $table WHERE Username='$name'") or die("Not Found :P");
	 $result=mysql_fetch_array($u) or die("Not Found :P");
	 if($result)
	 {
		 if($pass==$result['Password'])
	 	 {
		 	 $curuser=$result['Name'];
			 $visit=$result['Visit']+1; 
			 mysql_query("UPDATE $table SET Visit='$visit' WHERE Username='$name'") or die("Not Found :P");
			 $_SESSION['username']=$name;
			 if($result['Passreset']==1)
			 {
			  echo '<form name="signup" style="background:#FFFFFF; margin-left:550px; margin-top:80px;" action="./checklogin.php" method="POST" onSubmit="return validate()">';
			  echo '<input type="hidden" name="passreset" value="passreset"/>';
			  echo "<input type='hidden' name='name' value='$name' />";
			  echo '<input type="password" name="password" required size="30" placeholder="New Passphrase" required/><br>';
              echo '<input type="password" name="confirmpassword" required size="30" placeholder="Confirm Passphrase" required/>';
			  echo '<input type="submit" value="Go"/>';
			  echo '</form>';
			 }
			 else
			 {
			  echo "<script type='text/javascript'> alert('Welcome $curuser'); </script>"; 
		 	  header('Refresh:0; url=./home/');
			 }
	 	 }
	 	 else
	 	 {
		 	 echo '<script type="text/javascript"> alert("Password Mismatch"); </script>';
		 	 header('Refresh:0; url=./');
	 	 }
	 }
	 else
	 {
		 echo '<script type="text/javascript"> alert("Username Doesn\'t Exist"); </script>';
		 header('Refresh:0;url=./');
	 }
 }
 else
 {
	 header("refresh:0;url=./");
 }
 mysql_close($res);
?>