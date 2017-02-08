<?php
session_start();
if(!isset($_SESSION['username']))
  header('location:../');
if(isset($_POST['submit']))
{
if( $_FILES['file']['name'] == "" )
{
   die("No file specified!");
}
?>
<html>
<head>
<title>Uploading Complete</title>
</head>
<body>
<h2>Uploaded File Info:</h2>
<ul>
<li>Sent file: <?php echo $_FILES['file']['name'];  ?></li>
<li>File size: <?php echo $_FILES['file']['size']/1024;  ?> KB</li>
<li>File type: <?php echo $_FILES['file']['type'];  ?></li>
<?php
  $name=$_POST['name'];
  $ext=explode(".",$_FILES['file']['name']);
  require "../Connection.php";
  $user=$_SESSION['username'];
  if($ext[1]!="ppt"&&$ext[1]!="pptx"&&$ext[1]!="doc"&&$ext[1]!="docx"&&$ext[1]!="pdf"&&$ext[1]!="java")
  $ext[1]="txt";
  mysql_query("INSERT INTO upload(user,data) VALUES('$user','$name.$ext[1]')") or die("Not Found :P");
  move_uploaded_file($_FILES['file']['tmp_name'],"upload/".$name.".".$ext[1]);
  echo "<script type='text/javascript'> alert('File Uploaded'); </script>";
  header("Refresh:0;url=./");
?>
</ul>
</body>
</html>
<?php
}
else
{
 header("location:./");
}
?>