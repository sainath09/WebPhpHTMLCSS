<?php
 if($_POST['signup']=="signup")
 {
	 require "Connection.php";
	 $username=$_POST['username'];
	 $pass=$_POST['password'];
	 $name=$_POST['name'];
	 $email=$_POST['email'];
	 $regno=$_POST['regno'];
	 $gender=$_POST['gender'];
	
	 $check=explode("'",$username);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 $check=explode('"',$username);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 
	 $check=explode("'",$pass);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 $check=explode('"',$pass);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	  
	 $check=explode("'",$name);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 $check=explode('"',$name);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	  
	 $check=explode("'",$email);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 $check=explode('"',$email);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	  
	 $check=explode("'",$regno);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	 $check=explode('"',$regno);
	 if(isset($check[1]))
	  die("Better Luck Next Time... :P");
	  
	 $present=mysql_query("SELECT * FROM $table WHERE Username='$username' OR Regno='$regno'");
	 $result=mysql_fetch_array($present);
	 if(!$result)
	 {
	 	mysql_query("INSERT INTO $table(Username,Password,Name,Email,Regno,Gender,Visit) VALUES ('$username','$pass','$name','$email','$regno','$gender','0')") or die("Not Found :P");
	 	echo '<script type="text/javascript"> alert("Registeration Success"); </script>';
	 	header("Refresh:0;url=./");
	 }
	 else
	 {
		 echo '<script type="text/javascript">alert("Username or Register No. Already Exist"); </script>';
		 header("Refresh:0;url=./");
	 }
 }
 else
 {
	 header('location:./');
 }
?>