<?php
include('common.php');

error_reporting(0);
class User
{
	public function aslam_safe($string)
	{
		//$string = stripslashes($string);
		$string = mysql_real_escape_string($string);
		//$string = strip_tags($string);
		//$string = htmlspecialchars($string);
		$string = htmlentities($string, ENT_QUOTES | ENT_IGNORE, "UTF-8");
		return $string;
	}

}

$user = new User();
if ($_SERVER["REQUEST_METHOD"] == "POST") 
  {
		$name = $_POST['name'];
		$mobile = $_POST['mobile'];
		$email = $_POST['email'];
		$address = $_POST['address'];
		$college = $_POST['college'];
		$registno = $_POST['registno'];
		$member1 = $_POST['member1'];
		$cid = $_POST['cid'];
		$chaptername = $_POST['chaptername'];
		$d = $_POST['d'];
		$w = $_POST['w'];
		
		
		
		$name = $user->aslam_safe($name);
		$mobile = $user->aslam_safe($mobile);
		$mobile = $user->aslam_safe($mobile);
		
		
		
		$sql=mysql_query("INSERT into members(name,email,mobile,college,address,d,w,member1,chaptername,cid,registno) VALUES ('$name','$email','$mobile','$college','$address','$d','$w','$member1','$chaptername','$cid','$registno')") or die(mysql_error());

	
  }
?>


<!DOCTYPE html>
<head>
  <link rel="icon" href="images/logo1.jpg" sizes="48x48">
  <title> :: SINC 2k14 ::</title>
  <style type="text/css" media="all">
  @import url("css/system.base.css");
@import url("css/system.menus.css");
@import url("css/system.messages.css");
@import url("css/system.theme.css");</style>
<style type="text/css" media="all">@import url("css/jquery.ui.core.css");
@import url("css/jquery.ui.theme.css");
@import url("css/jquery.ui.button.css");</style>
<style type="text/css" media="all">@import url("css/aggregator.css");
@import url("css/date.css");
@import url("css/field.css");
@import url("css/node.css");
@import url("css/rotator.css");
@import url("css/user.css");</style>
<style type="text/css" media="all">@import url("css/ctools.css");
@import url("css/panels.css");
@import url("css/front-content.css");</style>
<style type="text/css" media="all">@import url("css/maintenance-page.css");
@import url("css/footer.css");
@import url("css/menus.css");
@import url("css/nodes.css");
@import url("css/search.css");
@import url("css/sidebar.css");
@import url("css/views.css");
@import url("css/fonts.css");
@import url("css/980_grid.css");
@import url("css/style.css");</style>
<style type="text/css" media="all">@import url("css/nivo-slider.css");</style>
  <script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery.once.js"></script>
<script type="text/javascript" src="js/drupal.js"></script>
<script type="text/javascript" src="js/innerfade.js"></script>
<script type="text/javascript" src="js/jquery.ui.core.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.widget.min.js"></script>
<script type="text/javascript" src="js/jquery.ui.button.min.js"></script>
<script type="text/javascript" src="js/rotator.js"></script>



<script type="text/javascript" src="js/panels.js"></script>
<script src="js/rightclick.js"></script>
<script src="js/aslam.js"></script>
<!-- <BODY BGCOLOR="#000000" onLoad="fly()">
<script src="js/myjs.js"></script>-->
						
				



  
  
</head>

<body class="html front not-logged-in one-sidebar sidebar-second page-index home" >
    <div id="header-wrapper" class="wrapper container_20 clearfix">

  

  <header id="header" role="banner" class="clearfix">
	      <div class="grid_10">
        <a href="index.php" title="Home" id="logo">
          <img src="images/final.png" alt="Home" />
        </a>
      </div>
    
 <!--  <hgroup class="grid_10">
	  	    <nav id="secondary">
	      <h2 class="element-invisible">Secondary menu</h2><ul id="secondary-menu" class="links clearfix">
	      <li class="menu-504 first"><a href="http://sedssastra.juplo.com/" title="SEDS-SASTRA Home Page">SEDS-SASTRA</a></li>
<li class="menu-505"><a href="http://www.sastra.edu" title="SASTRA WebSite">SASTRA</a></li>
<li class="menu-506"><a href="http://india.seds.org//" title="SEDS-INDIA Home page">SEDS-INDIA</a></li>
<li class="menu-507 last"><a href="contactus.php">Contact Us</a></li>
</ul>	    </nav>
	    </hgroup>-->
  <div class="clear"></div>

    
  </header> <!-- /#header -->
  
</div> <!-- /#header-wrapper -->


 
 

	<div id="content-wrapper" class="wrapper container_20 clearfix">
		<nav id="nav" role="navigation" class="grid_20 clearfix">
			<div class="region region-navigation">
				<section id="block-block-2" class="block block-block">




					<div class="content">
						<div
							
							<ul class="level-1" id="menu">

								<li><a class="navlink" href="index.php">Home</a></li>

								<li><a class="navlink" href="aboutus.php">About us</a>

									<div class="drop" id="dropdown-6">
										<div class="col-1">
											<ul class="level-2">

												<li><a href="sastra.php" title="SASTRA">SASTRA University</a></li>

												<li><a href="http://www.sedssastra.juplo.com/"
													title="SEDS-SASTRA">SEDS-SASTRA</a></li>
												<li><a href="contactus.php" title="SEDS-SASTRA">CONTACT</a></li>
										<li>
							<a href="credits.php" >CREDITS</a></li>


											</ul>
										</div>

										<div class="col-2">
											<div class="menu-photo-1">
												<a href="sastra.php"><img src="images/sastra.jpg"
													style="width: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green" href="sastra.php">SASTRA University</a>
												</p>
											</div>
											<div class="menu-photo-2">
												<a href="sedssastra.php"><img src="images/logo1.jpg"
													style="width: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green"
														href="http://www.sedssastra.juplo.com/">SEDS-SASTRA</a>
												</p>
											</div>
										</div>
										<div class="col-3">
											<h2 class="blue">SASTRA UNIVERSITY</h2>
											<p>SEDS INDIA NATIONAL CONFERENCE 2K14 Host, SASTRA
												UNIVERSITY is a sprawling campus housing a built-up area of
												over 30,00,000 square feet and a vibrant population of over
												10,000 students and over 700 teaching faculty have made
												itself a landmark in the educational map of India.</p>


										</div>
									</div></li>




								<li><a class="navlink" href="details.php">Registration</a>
									<div class="drop" id="dropdown-1">
										<div class="col-1">
											<ul class="level-2">
												<li class="level-2 first"><a href="details.php" title="">Registration
														Details</a></li>

											</ul>
										</div>
										<div class="col-2">
											<div class="menu-photo-1">
												<a href=""><img src="images/register.jpg"
													style="width: 200px;" /></a>

											</div>
											<div class="menu-photo-2">
												<a href="details.php"><img src="images/regdetail.jpg"
													style="width: 200px;" /></a>

											</div>
										</div>
										<div class="col-3">
											<h2 class="blue">Register Now</h2>
											<p>
												<strong>REGISTRATIONS OPEN</strong> <br>Registrations for
												SINC 2k14 are open.
											</p>

										</div>
									</div></li>


								<li><a class="navlink" href="workshops.php"> Workshops</a>
									<div class="drop" id="dropdown-2">
										<div class="col-1">
											<ul class="level-2">

												<li class="level-2 first"><a href="workshops.php"
													title="Conference Workshops">Workshops</a></li>


											</ul>
										</div>
										<div class="col-2">
											<div class="menu-photo-1">
												<a href="cansat.php"><img src="images/workshops/cansat.jpg"
													style="width: 200px; height: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green" href="cansat.php">CANSAT</a>
												</p>
											</div>
											<div class="menu-photo-2">
												<a href="aphoto.php"><img src="images/workshops/aphoto.jpg"
													style="width: 200px; height: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green" href="aphoto.php">Astro Photography</a>
												</p>
											</div>
										</div>
										<div class="col-3">
											<h2 class="blue">SINC 2k14</h2>

										</div>
									</div></li>


								<li><a class="navlink" href="shows.php">Shows</a>
									<div class="drop" id="dropdown-3">
										<div class="col-1">
											<ul class="level-2">

												<li><a href="so.php">Solar Observation</a></li>

												<li><a href="nso.php">Night Sky Observation</a></li>



											</ul>
										</div>
										<div class="col-2">
											<div class="menu-photo-1">
												<a class="name" href="so.php"><img
													src="images/show/sunspot.jpg" style="width: 200px;" />Solar
													Observation</a>

											</div>
											<div class="menu-photo-2">
												<a class="name" href="nso.php"><img
													src="images/show/night sky.jpg" style="width: 200px;" />Night
													Sky Observation</a>

											</div>

										</div>
										<div class="col-3">
											<h2 class="blue">SHOWS</h2>
											<p>For the convenience of people who wish to take part <b>only</b> in shows, registration will be done on the spot respectively.</p>

										</div>
									</div></li>



								<li><a class="navlink" href="events.php">Events</a>
									<div class="drop" id="dropdown-3">
										<div class="col-1">
											<ul class="level-2">

												<li class="first"><a href="pp.php"
													title="Paper Presentation">Paper Presentation</a></li>
												<li><a href="rover.php" title="rover design">Lunar Trek</a></li>
												<li><a href="igf.php">Intergalactic Forces</a></li>

												<li><a href="wrock.php">Water Rocketry</a></li>

												<li><a href="quiz.php" title="Quiz">Interstellar wizardry</a></li>
												<li><a href="th.php" title="treasurehunt">Space Hunt</a></li>
												<li><a href="modelexpo.php">Model Exhibition</a></li>
												<li><a href="junkyard.php">Junk Yard</a></li>
												<li><a href="spaceface.php">Space Face</a></li>



											</ul>
										</div>
										<div class="col-2">
											<div class="menu-photo-1">
												<ul id="rotator">
													<li><a href="pp.php"><img src="images/events/paper.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="pp.php">Paper Presentation</a>
														</p></li>
													<li><a href="lunar.jpg"><img src="images/events/lunar.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="rover.php">Lunar Trek</a>
														</p></li>
													<li><a href="wrock.php"><img
															src="images/events/water rocket.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="wrock.php">Water Rocketry</a>
														</p></li>
													<li><a href="igf.php"><img
															src="images/events/robot-army1.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="igf.php">InterGalactic
																Forces</a>
														</p></li>


													<li><a href="th.php"><img
															src="images/events/space hunt1.gif" href="th.php" /></a>
														<p class="caption">
															<a class="arrow-green" href="th.php">Space Hunt</a>
														</p></li>
												</ul>
											</div>

											<div class="menu-photo-2">
												<ul id="rotator">
													<li><a href="quiz.php"><img
															src="images/events/Space_Wizard.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="quiz.php">Interstellar
																Wizardry</a>
														</p></li>
													<li><a href="junkyard.php"><img
															src="images/events/junkyard.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="junkyard.php">Junk Yard</a>
														</p></li>
													<li><a href="spaceface.php"><img
															src="images/events/Space face.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="Space face.php">Space Face</a>
														</p></li>
													<li><a href="modelexpo.php"><img
															src="images/events/modelexpo.jpg" /></a>
														<p class="caption">
															<a class="arrow-green" href="modelexpo.php">Model
																Exhibition</a>
														</p></li>

												</ul>
											</div>
										</div>

										<div class="col-3">
											<h2 class="blue">A 'Universal' Experience</h2>
											<p>For the convenience of people who wish to take part <b>only</b> in events, registration will be done on the spot for each event respectively.</p>

										</div>
									</div></li>


								<li><a class="navlink" href="talks.php">SEDS TALKS</a>
									<div class="drop" id="dropdown-4">
										<div class="col-1">
											<ul class="level-2">
												<li><a href="YSRajan.php" title="">Talk 1</a></li>
												<li><a href="prajval.php" title="">Talk 2</a></li>
												<li><a href="avinash.php" title="">Talk 3</a></li>

												<li><a href="kk.php" title="">Talk 4</a></li>
												<li><a href="Srinivas_Laxman.php" title="">Talk 5</a></li>


											</ul>
										</div>
										<div class="col-2">
											<div class="menu-photo-1">
												<ul id="rotator">
													<li><a class="name" href="YSRajan.php"><img
															src="images/Guest pics/ys rajan_2.jpg" />Dr.Y.S.Rajan</a>
													</li>
													<li><a class="name" href="prajval.php"><img
															src="images/Guest pics/Dr.Prajval.jpg" />Dr.Prajval
															Shastri</a></li>
													<li><a class="name" href="avinash.php"><img
															src="images/Guest pics/Dr.Avinash deshpande.jpg" />Dr.Avinash
															Deshpande</a></li>
												</ul>
											</div>
											<div class="menu-photo-2">
												<ul id="rotator">
													<li><a class="name" href="kk.php"><img
															src="images/Guest pics/kunhi.jpg" />Dr.P Kunhi Krishnan</a>
													</li>
													<li><a class="name" href="Srinivas_Laxman.php"><img
															src="images/Guest pics/srinivas laxman_1.jpg" />Mr.Srinivas
															Laxman</a></li>
															<li><a class="name" href="vkj.php"><img
															src="images/Guest pics/vkj.jpg" />Dr. V K Janardanan
													     </a></li>
												</ul>
											</div>
										</div>



										<div class="col-3">
											<h2 class="blue">SINC 2k14</h2>

										</div>
									</div></li>






								<li><a class="navlink" href="hotels.php">Travel &amp;
										Accomodation</a>
									<div class="drop" id="dropdown-6">
										<div class="col-1">
											<ul class="level-2">



												<li><a href="localattractions.php" title="The 'BIG' Temple">Local
														Attractions</a></li>

												<li><a href="hotels.php" title="Hotels">Hotels</a></li>
												<li><a
													href="http://www.sastra.edu/index.php?option=com_content&view=article&id=1879&Itemid=673"
													title="Getting to SINC 2k14">Getting to SASTRA</a></li>
												<li><a href="map.pdf" title="SASTRA Map">SASTRA map</a></li>

											</ul>
										</div>

										<div class="col-2">
											<div class="menu-photo-1">
												<a href="tanjore.php"><img src="images/tanjore.jpg"
													style="width: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green" href="tanjore.php">Thanjavur</a>
												</p>
											</div>
											<div class="menu-photo-2">
												<a href="trichy.php"><img src="images/trichy.jpg"
													style="width: 200px;" /></a>
												<p class="caption">
													<a class="arrow-green" href="trichy.php">Trichy</a>
												</p>

											</div>
										</div>

										<div class="col-3">
											<h2 class="blue">SASTRA UNIVERSITY</h2>


										</div>
									</div></li>








							</ul>



						</div>

					</div>

				</section>
				<!-- /.block -->



			</div>

		</nav>
		<!-- /#nav -->


<div class="grid_20 white-bg clearfix">
	
					<section id="feature" class="grid_20 alpha omega clearfix">
			  <div class="region region-feature">
  <section id="block-block-4" class="block block-block">

	
  <div class="content">
     <div id="novone"> 
  
<div class="banner">
<h2>Details</h2>
</div> <!-- End Banner -->

</div> <!-- End #novone -->
  
  
</section> <!-- /.block -->
</div>
 <!-- /.region -->
			</section>  <!-- /#feature -->
			<div class="clear"></div>
			
		  
  <section id="main" role="main" class="grid_13 boxsize clearfix">
      <a id="main-content"></a>
        
        
                
        
        
    
 <div class="panel-display panel-home clearfix" id="front">


  
<div class="clear"></div>

<div class="panel-row panel-articles">
  <div id="home-article" class="panel-panel panel-article"><div class="panel-pane pane-node" > <!-- left -->
  
        
        
        <br> <br> <br> <br> <br> <br>
        <h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
        
        
        Thank You for registering. Please visit the website for updates. </h2>
        <br>
        <h4>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        NOTE:
        
        Please bring your institution issued ID Card & SEDS-ID proof(If member)</h4>
         <br> <br> <br> <br> <br> <br>
                <a class="arrow-green" href="index.php">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       
        HOME</b></b></a>
    
  <br><br>
  
 </div>



  
  </article> <!-- /.node -->
  </div>

  
  </div>
</div> 
    
  </section> <!-- /#main -->
  
  
    
    
     <section id="bottom">
	    &nbsp;
	        </section> 
    

	</div>
  
</div> <!-- /#content-wrapper -->
<div class="clear"></div>

<div id="footer-wrapper" class="wrapper container_20 clearfix">

  <footer id="footer" role="contentinfo" class="grid_20 clearfix">
    <div class="region region-footer">
  <section id="block-system-main-menu" class="block block-system block-menu">

	
  <div class="content">
    <ul class="menu"><li class=""><a href="">(c) 2013 SEDS - SASTRA</a></li>
 
</ul>  </div>
  
</section> <!-- /.block -->
</div>
 <!-- /.region -->
      </footer> <!-- /#footer -->
  
</div> <!-- /#footer-wrapper -->
<div class="clear"></div>
  </body>

</html>