


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">


<html xmlns="http://www.w3.org/1999/xhtml">


<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>CSE C SECTION</title>
	<link rel="stylesheet" href="css/main.css" type="text/css" />
    <script type="text/javascript" src="js/jquery-1.4.1.min.js"></script>
    <script type="text/javascript" src="js/menu.js"></script>
    <script type="text/javascript" src="js/cufon-yui.js"></script>
    <LAYER NAME="a0" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ffffff" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a1" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#fff000" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a2" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ffa000" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a3" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ff00ff" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a4" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#00ff00" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a5" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#FF00FF" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a6" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#FF0000" CLIP="0,0,1,1"></LAYER>
<LAYER NAME="a7" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ffffff" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a8" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#fff000" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a9" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ffa000" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a10" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#ff00ff" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a11" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#00ff00" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a12" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#0000ff" CLIP="0,0,2,2"></LAYER>
<LAYER NAME="a13" LEFT=10 TOP=10 VISIBILITY=SHOW BGCOLOR="#FF0000" CLIP="0,0,3,3"></LAYER>


<script language="JavaScript">

/*
Magic Wand cursor (By Kurt at kurt.grigg@virgin.net)
Modified and permission granted to Dynamic Drive to feature script in archive
For full source, usage terms, and 100's more DHTML scripts, visit http://dynamicdrive.com
*/

if (document.all){
with (document){
write('<div id="starsDiv" style="position:absolute;top:0px;left:0px">')
write('<div style="position:relative;width:1px;height:1px;background:#ffffff;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#fff000;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#ffa000;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#ff00ff;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#00ff00;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#0000ff;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:1px;height:1px;background:#FF0000;font-size:1px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#ffffff;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#fff000;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#ffa000;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#ff00ff;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#00ff00;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:2px;height:2px;background:#0000ff;font-size:2px;visibility:visible"></div>')
write('<div style="position:relative;width:3px;height:3px;background:#FF0000;font-size:3px;visibility:visible"></div>')
write('</div>')
}
}


var Clrs=new Array(6)
Clrs[0]='ff0000';
Clrs[1]='00ff00';
Clrs[2]='000aff';
Clrs[3]='ff00ff';
Clrs[4]='fff000';
Clrs[5]='fffff0';



if (document.layers)
{window.captureEvents(Event.MOUSEMOVE);}
var yBase = 200;
var xBase = 200;
var step;
var currStep = 0;
var Xpos = 1;
var Ypos = 1;

if (document.all)
{
  function MoveHandler(){
  Xpos = document.body.scrollLeft+event.x;
  Ypos = document.body.scrollTop+event.y;
  }
  document.onmousemove = MoveHandler;
}

else if (document.layers)
{
  function xMoveHandler(evnt){
  Xpos = evnt.pageX;
  Ypos = evnt.pageY;
  }
  window.onMouseMove = xMoveHandler;
}

function animateLogo() {
if (document.all)
{
 yBase = window.document.body.offsetHeight/4;
 xBase = window.document.body.offsetWidth/4;
}
else if (document.layers)
{
 yBase = window.innerHeight/4;
 xBase = window.innerWidth/4;
}

if (document.all)
{
 for ( i = 0 ; i < starsDiv.all.length ; i++ )
 {step=3;
  starsDiv.all[i].style.top = Ypos + yBase*Math.cos((currStep + i*4)/12)*Math.cos(0.7+currStep/200);
  starsDiv.all[i].style.left = Xpos + xBase*Math.sin((currStep + i*3)/10)*Math.sin(8.2+currStep/400);
  for (ai=0; ai < Clrs.length; ai++)
    {
     var c=Math.round(Math.random()*[ai]);
    }
    starsDiv.all[i].style.background=Clrs[c];
 }
}

else if (document.layers)
{
 for ( j = 0 ; j < 14 ; j++ ) //number of NS layers!
 {step = 4;
  var templayer="a"+j
  document.layers[templayer].top = Ypos + yBase*Math.sin((currStep + j*4)/12)*Math.cos(0.7+currStep/200);
  document.layers[templayer].left = Xpos + xBase*Math.sin((currStep + j*3)/10)*Math.sin(8.2+currStep/400);
  for (aj=0; aj < Clrs.length; aj++)
    {
     var c=Math.round(Math.random()*[aj]);
    }
    document.layers[templayer].bgColor=Clrs[c]; 
 }
}
currStep+= step;
setTimeout("animateLogo()", 10);
}
animateLogo();
// -->
</script>
    <script type="text/javascript">
		function clicked($head)
		{
			if($head=='home')
			{
				document.getElementById("main").style.maxHeight="470px";
			}
			else if($head=='daa')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='coca')
			{
				document.getElementById("main").style.maxHeight="770px";
			}
			else if($head=='dbms')
			{
				document.getElementById("main").style.maxHeight="420px";
			}
			else if($head=='nw')
			{
				document.getElementById("main").style.maxHeight="520px";
			}
			else if($head=='os')
			{
				document.getElementById("main").style.maxHeight="670px";
			}
			else if($head=='rts')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='info')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='assign')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='sem')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='tt')
			{
				document.getElementById("main").style.maxHeight="470px";
			}
			else if($head=='syl')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='contact')
			{
				document.getElementById("main").style.maxHeight="370px";
			}
			else if($head=='about')
			{
				document.getElementById("main").style.maxHeight="620px";
			}
		}
		
		function loading()
		{
		}
		
		
	</script>
</head>

<body onload="loading()">
	<div id="bg">
    	<div class="wrap" style="margin-top:-30px;">
        	
           
       		<div id="mainmenu">
				<ul id="menu">
					<li><a href="#home" onclick="clicked('home')">Home</a></li>
					<li><a href="#">Resources</a>
						<ul style="margin-top:-30px;">
                    		<li><a href="#daa" onclick="clicked('daa')">DAA</a></li>
                        	<li><a href="#coca" onclick="clicked('coca')">Advanced COCA</a></li>
                        	<li><a href="#dbms" onclick="clicked('dbms')">DBMS</a></li>
                        	<li><a href="#networks" onclick="clicked('nw')">Networks</a></li>
                        	<li><a href="#os" onclick="clicked('os')">OS</a></li>
                        	<li><a href="#rts" onclick="clicked('rts')">RTS</a></li>
                    	</ul>
					</li>
					<li><a href="#">Misc</a>
                   		<ul style="margin-top:-30px;">
                    		<li><a href="#assign" onclick="clicked('assign')">Assignments</a></li>
                        	<li><a href="#sem" onclick="clicked('sem')">Seminar</a></li>
                        	<li><a href="#info" onclick="clicked('info')">Info</a></li>
                        	<li><a href="#tt" onclick="clicked('tt')">Timetable</a></li>
                        	<li><a href="#syl" onclick="clicked('syl')">Syllabus</a></li>
                    	</ul>
                	</li>
                	<li><a href="files.php" target="_blank">Uploaded Files</a></li>
					<li><a href="#about" onclick="clicked('about')">About Us</a></li>
					<li><a href="#contact" onclick="clicked('contact')">Contact Us</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</div>
            
            <div>
            	<img src="images/bg/UI1_edited.jpg" />
                <br /><br /><BR />
            </div>
            
            <div id="main" style="min-height:40px;">
			
			
			
            	<div id="home" style="visibility:visible;">	
                    <div>
						<h2>Welcome</h2>
						<p>CSE 5th Semester C Section Online Portal for Students to distribute and access resources</p>
					</div>
                	<?php
					if($_SESSION['username']=="Admin")
					{ 
					?>
                    	<div id="upload">
      						<h3 style="color:#000000;">File Upload:</h3>
      						<form action="./file_uploader.php" method="post" enctype="multipart/form-data" style="color:#000000;">
				        		<font face="Tempus Sans ITC"><b>File Name Without Extension:</b></font><br />
					    		<input type="text" name="name" required style="min-width:30px;" /><br><br>Select a file to upload: <br>
					    		<input type="file" name="file" size="50" /><br><br />
                        		<input type="submit" value="Upload File" name="submit" /><br /><br /><br /><br />
                        	</form>
     					</div>
               	 	<?php
					}
					?>
                
            	    <div id="bits">
						<br /><BR />
                    	
                        <div class="bit" >
							<h4>SASTRA</h4>
							<div>
								<a href="http://www.sastra.edu" target="_blank"><img src="images/sastra.png" height="100" width="200" alt="SASTRA" /></a>
							</div>
						</div>
                    
						<div class="bit">
							<h4>Parent's Corner</h4>
							<div>
								<a href="http://webstream.sastra.edu/sastrapwi/" target="_blank"><img src="images/pc.png" height="100" width="200" alt="Parent's Corner" /></a>
							</div>	
						</div>
                    
						<div class="bit last">
							<h4>Student Toolkit</h4>
							<div>
								<a href="http://toolkit.sastra.edu/" target="_blank"><img src="images/sc.png" height="100" width="200" alt="Toolkit" /></a>
							</div>	
						</div>
                    
						<div class="clear"></div>
                        
					</div>
                </div>                



            
            	<BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />
            
            
            
            	<div id="daa">
					<h2>Design and Analysis of Algorithms</h2>
					<p>
           				<a href="https://drive.google.com/file/d/0BxNIqSTirOIBVDZsVTloLUltSkU/edit?usp=sharing" target="_blank">
            			<img src="images/DAA.jpg" />
            			</a>
            		</p>
					<div id="bits">
                	</div>	
            	</div>
            

            
            
            	<BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />


            
            
            	<div id="coca">
					<h2>Advanced Computer Organisation and Architecture</h2>
					<p>
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBQmhGeHg5R3lpRjA/edit?usp=sharing" target="_blank">
                    	<img src="images/COCA 2.jpg" />
                     	</a>
                    </p>
					<div id="bits">
                 	 	<div class="bit">
							<h4></h4>
							<div>
								<a href="https://drive.google.com/file/d/0BxNIqSTirOIBTVVGNWkxc1MzNmM/edit?usp=sharing" target="_blank"><img src="./images/acoca-1.png" width=200 height=190 alt="Thumb"/></a>
                     		</div>
						</div>					
				
               		 	<div class="bit">
							<h4></h4>
							<div>							
                           	 <a href="https://drive.google.com/file/d/0BxNIqSTirOIBSkZRLVgwZ2dzTG8/edit?usp=sharing" target="_blank"><img src="./images/acoca-2.png" width=200 height=200 alt="Thumb" /></a>
							</div>
						</div>					
				
        	        	<div class="bit last">
							<h4></h4>
							<div>
								<a href="https://drive.google.com/file/d/0BxNIqSTirOIBYU81NFY4STJLbGdkZGlBN1VfMndSTXlBWmpv/edit?usp=sharing" target="_blank"><img src="./images/coca 3.png" width=200 height=200 alt="Thumb"/></a>                       
  							</div>
						</div>
					
                		<div class="bit more">
							<h4></h4>
							<div >
								<a href="https://drive.google.com/file/d/0BxNIqSTirOIBejhGajhhWjNUcWsxdnMyajFJYXlsWU9qVEg0/edit?usp=sharing" target="_blank"><img src="./images/coca 3.png" width=200 height=200 alt="Thumb" /></a>
                    		</div>
						</div>
                 	   <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />
					</div>
				</div>
                
                            
				
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />



				<div id="dbms">
					<h2>Database Management System</h2>
					<p>
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBMVVEX2FZZnNUTmc/edit?usp=sharing" target="_blank"><img src="images/DBMS 1.jpg" /></a>
                    	&nbsp;&nbsp;&nbsp;
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBYWVvRVUwLXJYQk0/edit?usp=sharing" target="_blank"><img src="images/DBMS 2.gif" /></a>
                    </p>
					<div id="bits">
                    </div>
                </div>
            	
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR />
                
                
                
                
                <div id="networks">
					<h2>Networks</h2>
					<p>
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBM2NxRTc3V3lxM2M/edit?usp=sharing" target="_blank">
                    	<img src="images/networks.jpg" />
                     	</a>
                    </p>
					<div id="bits">
                  		<div class="bit">
							<h4></h4>
							<div>
								<a href="https://drive.google.com/file/d/0BxNIqSTirOIBMWtzUXhPMExKdkE/edit?usp=sharing" target="_blank"><img src="images/net.jpg" alt="Thumb"/><bR /> ERROR CORRECTION </a>
                    		</div>
						</div>		
					</div>
				</div>
                
                
                
            
            	<BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                 
                
                
                <div id="os">
					<h2>Operating System</h2>
					<p>
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBZVFLUWZ0YlNnQ0k/edit?usp=sharing" target="_blank">
                    	<img src="images/os1.jpeg" />
                    	</a>
                        &nbsp;&nbsp;&nbsp;
                    	<a href="https://drive.google.com/file/d/0BxNIqSTirOIBMWo0WlFHMFJYSUk/edit?usp=sharing" target="_blank">
                    	<img src="images/os2.jpg" />
                    	</a>
                    </p>
					<div id="bits">
                    	<div class="bit">
                        	<h4>Message Queues</h4>
                        	<a href="uploaded/Message Queues/" target="_blank"><img src="images/folder.png" /></a>
                        </div>
                        <div class="bit">
                        	<h4>Shared Memory</h4>
                        	<a href="uploaded/Shared Memory/" target="_blank"><img src="images/folder.png" /></a>
                        </div>
  					</div>
  				</div>
				
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                
                <div id="rts">
                	<h2>Real Time Systems</h2>
					<p></p>
                    <div id="bits">
                    </div>
                </div>
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
            
            
                
                <div id="assign">
					<h2>Assignments</h2>
					<p></p>
					<div id="bits">
                  	</div>
                </div>
				
			
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />


				<div id="info">
					<h2>Miscellenous Informations</h2>
					<p></p>
					<div id="bits">
                	</div>	
				</div>
				


                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />

				
                <div id="sem">
					<h2>Seminar</h2>
					<p></p>
					<div id="bits">
					</div>					
				</div>
             

                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                
                <div id="syl">
					<h2>Syllabus</h2>
					<p><a href="https://drive.google.com/file/d/0BxNIqSTirOIBWHRjZ1NfcEVyMGM/edit?usp=sharing" target="_blank"><img src="images/Syllabus.jpg" height="300" width="300" /></a>
                    </p>
					<div id="bits">
    				</div>
    			</div>           
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                <div id="tt">
            		<h2>Time Table</h2>
					<p> <a href="https://drive.google.com/file/d/0BxNIqSTirOIBWW1LMHdlOU94VjQ/edit?usp=sharing" target="_blank"> <img src="images/timetable.gif" style="border-color:#00F; border:dashed;" /> </a>
                    </p>
					<div id="bits">
                  	</div>
                </div>
                
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                
                <div id="contact">
					<h2>Contact Us</h2>
					<p></p>
                    <object data="./contact/" type="all" style="min-height:400px; min-width:800px; margin-left:-50px;">
   					<embed src="./contact/" style="min-height:380px; min-width:800px; margin-left:-50px;">
				    </embed></object>
					<div id="bits">
                  	</div>
				</div>
			
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
                
                <div id="about">
					<h2>About Us</h2>
					<p>
                    
                    <img src="images/admin.jpg" style="border:dashed;" width="250" height="200" />&nbsp;&nbsp;&nbsp;
                    <img src="images/UIadmin.JPG" style="border:dotted;" width="230" height="200" />
                                       
                    <br />
                    <font color="#FF0000"><b>ADMIN:</b><b style="margin-left:210px;">UI Designer:</b></font><br />
                    <font color="#000000">M Veera Manohara Subbiah<font style="margin-left:95px;"> S.Sowmya Narayanan</font><br />116003223<font style="margin-left:195px;"> 116003223</font><br />mvm.subbiah@gmail.com <font style="margin-left:113px;">virvind@gmail.com</font></font>
                    <br />
                                  
                    </p>
                    <div id="bits">
                    	<div class="bit">
                    		<img src="images/add.jpg" width="150" height="150" />
                    		<bR />
                    		<font color="#000000">Volunteers are Invited...</font>
                        </div>
                    </div>
                    
                </div>
			
				
                
                
                <BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><BR /><br /><br />
                
            </div>
            
            
            
            
			
        
        
            
            
            
            
            <div id="side">
            	<h4>Latest News</h4>
            	<div class="news">
                	<p>
                     E-Books for Avanced COCA, DAA, DBMS, OS and Networks has been Uploaded.
                    </p>
                    <p>
                     Class Timetable has been Uploaded.
                    </p>
                    <p>
                     Syllabus is made available.
                    </p>
                </div>
                <div id="news"> 
                	<?php 
				      if($_SESSION['username']=='Admin')
					  {
					  	echo '<a href="#upload"><h4>Upload Files</h4></a>';
					?>
                    
						<h3 style="font-family:'Lucida Calligraphy'; color:#FF0000;">Max. Upload Size---25MB</h3> 
                    <?php
					  }
					?>
				</div>
           	</div>   
        </div>
        
        
        
        
        
    
    
    	<div id="footer">
			<div id="footerbg">
				<div class="wrap">
					<p id="copy" align="center"><span>Site Created and Maintained by M.Veera Manohara Subbiah</span></p>
					<div class="clear"></div>
				</div>
			</div>
		</div>
	</div>
    
    <script type="text/javascript">
		alert("Put Your Hands together... \nS.Sowmya Narayanan is our Class website's\nNEW UI DESIGNER !!! :D");
	</script>	
	
</body>



</html>