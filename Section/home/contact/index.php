<html>
<head>
 <title>Contact Us</title>	
 <link rel="stylesheet" href="css/screen.css" media="screen" />
</head>
<body>
 <div id="container">
  <h1>Message</h1>
  <form id="form1" action="./send.php" method="post">	
   <fieldset><legend>Details</legend>
	<p class="first">
	 <label for="web">PHONE NUMBER</label>
	 <input type="text" name="phone" id="web" size="11" required/>
	</p>
    <p>
	 <label for="web">Subject</label>
	 <input type="text" name="sub" id="web" size="30" required/>
	</p>			
   </fieldset>
   <fieldset>																			
	<p>
	 <label for="message">Message</label>
	 <textarea name="msg" id="message" cols="30" rows="10" required></textarea>
	</p>								
   </fieldset>					
   <p class="submit"><button type="submit" name="send" value="send">Send</button></p>		
  </form>	
 </div>
</body>
</html>