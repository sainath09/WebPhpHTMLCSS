<html>
<body>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.js"></script> 
<script src="cd/main.js"></script>
<div id="boxes">
  <div style="top: 199.5px; left: 551.5px; display: none;" id="dialog" class="window">
    <div id="lorem">
      <p>
      Welcome to Daksh-Book</p><br/><br/>
      <img src="bbb.jpg"/><br/>
      <br/>
      <div id="ali"><p>This is an oppurtunity to connect to your friends.You can share your thoughts through posts,you can upload your pics,you can message your friends and get to know latest information about your friends from anywhere in the world.</p></div> 
    </div>
    <div id="popupfoot"> <a href="#" class="close agree">CLICK HERE TO ENTER VIRTUAL WORLD</a> </div>
  </div>
  <div style="width: 1478px; font-size: 32pt; color:white; height: 602px; display: none; opacity: 0.8;" id="mask"></div>
</div>
<?php include("./inc/header.inc.php"); ?>
<?php
$reg = @$_POST['reg'];
$fn="";
$ln="";
$un="";
$em="";
$em2="";
$pswd="";
$pswd2="";
$d="";
$a="";
$u_check="";
$fn=strip_tags(@$_POST['fname']);
$ln=strip_tags(@$_POST['lname']);;
$un=strip_tags(@$_POST['username']);;
$em=strip_tags(@$_POST['email']);;
$a=strip_tags(@$_POST['age']);;
$em2=strip_tags(@$_POST['email2']);;
$pswd=strip_tags(@$_POST['password']);;
$pswd2=strip_tags(@$_POST['password2']);;
$d=date("Y-m-d");
if($reg) {
	if($em==$em2) {
		$u_check=mysql_query("SELECT username FROM users WHERE username = '$un'");
		$check = mysql_num_rows($u_check);
		$e_check=mysql_query("SELECT email FROM users WHERE email = '$em'");
		$email_check = mysql_num_rows($e_check);
		if($check==0) {
			if($email_check==0) {
			if($fn&&$ln&&$un&&$em&&$em2&&$pswd&&$pswd2) {
				if($pswd==$pswd2) {
					if(strlen($un)>25||strlen($fn)>25||strlen($ln)>25) {
						echo "The maximum limit for username/firstname/lastname is 25 characters!";
					}
					else 
					{
						if(strlen($pswd)>30||strlen($pswd)<5) {
							echo "your password must be between 5 and 30 characters!";
						}
						else {
							$pswd = md5($pswd);
							$pswd2 = md5($pswd2);
							$query = mysql_query("INSERT INTO users VALUES ('','','$un','$fn','$ln','$em','$pswd','$d','0','','','','$a')");
							die("<h2>Welcome to findfriends</h2>Login to your account to get started ...");
							}
							}
							}
							else {
								echo "your passwords dont match!";
							}
			}
			else {
								echo "please fill in all of the fields";
							}
			}
			else { 
				echo "Sorry! but it looks like someone has already used that email!";
			}
	}
			else {
								echo "username already taken!";
							}
			}
			else {
								echo "your emails dont match!";
							}
			}
		
if(isset($_POST["user_login"])&& isset($_POST["password_login"])) {
	$user_login = preg_replace('#[^A-Za-z0-9]#i','',$_POST["user_login"]);
	$password_login = preg_replace('#[^A-Za-z0-9]#i','',$_POST["password_login"]);	
	$password_login_md5 = md5($password_login);	
$sql = mysql_query("SELECT id FROM users WHERE	username='$user_login' AND password='$password_login_md5' LIMIT 1");
    
	$userCount = mysql_num_rows($sql);
	if($userCount == 1) {
		while ($row = mysql_fetch_array($sql)) {
			$id = $row["id"];
		}
		$_SESSION["user_login"] = $user_login;
		header("location:home.php");
		exit();
	}
	else {
		echo 'The information is incorrect,try again';
		exit();
	}
}
			
?>
<div style="width:800px; margin: 0px auto 0px auto;">
<table>
<tr>
<td width="60%" valign="top">
 <h2>Already a member? Sign in below!</h2>
 <form action="index.php" method="post">
 <input type="text" name="user_login" size="25" placeholder="Username" /><br/><br/>
 <input type="password" name="password_login" size="25" placeholder="Password" /><br/><br/>
 <input type="submit" name="login" value="Login"/>
 </form>
 
 <br/>
 <br/>
 <img src="aaa.jpg"/><br/><br/>
 <h2>Welcome to Daksh-Book(D-Book)</h2>
 </td>
 <td width="40%" valign="top">
 <h2>Sign Up Below ...</h2>
 <form action="index.php" method="post">
 <input type="text" name="fname" size="25" placeholder="First Name" /><br/><br/>
 <input type="text" name="lname" size="25" placeholder="Last Name" /><br/><br/>
 <input type="text" name="username" size="25" placeholder="Username" /><br/><br/>
 <br/><br/>
 <input type="text" name="email2" size="25" placeholder="Email Address (again)" /><br/><br/>
  <input type="text" name="age" size="25" placeholder="Age" /><br/><br/>
 <input type="password" name="password" size="25" placeholder="Password" /><br/><br/>
 <input type="password" name="password2" size="25" placeholder="Password (again)" /><br/><br/>
 <input type="submit" name="reg" value="Sign Up!"/>
 </form>
 </td>
 </tr>
 </table>
 </div>
 <?php include("./inc/footer.inc.php"); ?>
 <br/>
 <h1><font face="times new roman" size="+6" color="#400000"><marquee behavior="alternate" width="100%">Design:Team Amigos</marquee></font></h1>
</body>
</html>
