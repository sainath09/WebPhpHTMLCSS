<?php
include('connect2.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
		$name = $_POST['name'];
		$regno = $_POST['regno'];
		$branch = $_POST['branch'];
		$roleinsinc = $_POST['roleinsinc'];
		$roleinseds = $_POST['roleinseds'];
		$workedfor = $_POST['workedfor'];
		
		$sql=mysql_query("INSERT into list(name,regno,branch,workedfor,roleinsinc,roleinseds) VALUES ('$name','$regno','$branch','$workedfor','$roleinsinc','$roleinseds')") or die(mysql_error());

 }
?>


<html>
<head>
</head>
<body>
<h1>Project SEDS SASTRA</h1>

<br>

<h2>Greetings! You will be receiving your certificates soon!</h2>
</body>

</html>