<?php
	session_start();
	if(isset($_SESSION['username']))
		header("Refresh:0;url=./home/");
?>

<!DOCTYPE html>
<html>
<head>
	<title>CSE C Section</title>	
	<link rel="icon" type="image/jpg" href="images/form1/fav.jpg"/>
    <link rel="stylesheet" href="css/screen.css" media="screen" />
	<script language="javascript">
    function validate()
    {
     var g=document.forms["signup"]["gender"].value;
	 var p=document.forms["signup"]["password"].value;
	 var cp=document.forms["signup"]["confirmpassword"].value;
	 var r=document.forms["signup"]["regno"].value;
	 if(p!=cp)
	 {
		 alert("Password Mismatch");
		 return false;
	 }
	 if(r<116003999&&r>116003000)
	 {
		 return true;
	 }
	 else
	 {
		 alert("Invalid Register No.");
		 return false;
	 }
	 if(g=="0")
     {
      alert("Please Select Gender");
      return false;
     }
    }
	function forgot()
	{
	 if(document.getElementById('pass').checked)
	 {
	  document.getElementById('passtext').style.visibility="visible";
	  document.getElementById('usertext').style.visibility="hidden";
	 }
	 else
	 {
	  document.getElementById('usertext').style.visibility="visible";
  	  document.getElementById('passtext').style.visibility="hidden";
	 }
	}
    </script>
</head>
<body>
<div id="container">
  <h1><b>Login Page</b></h1>
  <form id="form1" action="./checklogin.php" method="post">	
	<legend>Login</legend>
	 <input type="text" name="username" id="name" size="30" required autofocus placeholder="Username"/><br>
	 <input type="password" name="password" size="30" required placeholder="Passphrase" /><br>
	 <input type="hidden" name="visit" />	    
     <button type="submit" class="submit" value="login" name="login">Login</button>
	 <br><br>
	   </form>
  <font face="Georgia, Times New Roman, Times, serif" size="+1" color="#FF0000" style="background:#FFFFFF;">Forgot Username???</font>
  <input id="user" style="margin-left:0px;" type="radio" name="foruser" value="foruser" onClick="javascript:forgot();" border="solid" />
  <form id="usertext" action="./foruser.php" method="post" style="visibility:hidden;">
	  <input type="text" autofocus placeholder="Register No." name="Reg" />
	  <input type="submit" value="Go" name="enter"/>
  </form>
  <font face="Georgia, Times New Roman, Times, serif" size="+1" color="#FF0000" style="background:#FFFFFF;">Forgot Password???</font>
     <input id="pass" style="margin-left:7px;" type="radio" name="foruser" value="foruser" onClick="javascript:forgot();" border="solid" />  
  <br>
  <form id="passtext" action="./forpass.php" method="post" style="visibility:hidden;">
	  <input type="text" placeholder="Email" name="email"/>
	  <input type="submit" value="Go" name="enter"/> 
  </form>
 
  <form id="form2" name="signup" action="./signup.php" method="post" onSubmit="return validate()">
   <fieldset style="margin-left:400px; margin-top:-240px;">
    <legend>Signup</legend>
     <input type="text" name="username" required id="name" size="30" placeholder="Username" />
	 <input type="password" name="password" required size="30" placeholder="Passphrase" />
     <input type="password" name="confirmpassword" required size="30" placeholder="Confirm Passphrase" />
     <input type="text" name="name" id="name" required size="30" placeholder="Name" />
     <input type="email" name="email" id="name" required size="30" placeholder="Email Id" />
     <input type="text" name="regno" maxlength="9" required id="name" size="30" placeholder="Register No." />
     <select name="gender">
      <option value="0" selected>--------------Gender----------------</option>
      <option value="1">Male</option>
      <option value="2">Female</option></select><br>
     <button name="signup" value="signup" class="signup" type="submit">Signup</button>
    </fieldset>      
  </form>

</div>
</body>
</html>