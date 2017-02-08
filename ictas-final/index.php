<style type="text/css" media="screen">

body{
background:url(images/bg4.png) no-repeat;
 background-size:cover;
background-attachment: fixed;

}

@font-face {
	font-family: 'forum';
	src: url('home/fonts/anirm.ttf');
	font-weight: normal;
	font-style: normal;
}
#wobble{
    width:100px;
    height:100px;
    margin:0 auto;
    top:250px;
    position: relative;
    color: #a34gfd;
    font-family: forum;
	/*font-family: Arial, "MS Trebuchet", sans-serif;*/
	font-weight: lighter;
	font-size:1em;
	
	text-decoration: none;
	
}
ul{
	list-style-type: none;
	
}

</style>
<div id="wobble">
	<ul>
		<li><a  href="./home" style="text-decoration:none">ICTAS</a></li>
		<li><a href="./techcarnival15" style="text-decoration:none">TC'15</a></li>	
	 
		
			
	</ul>
</div>
<script type="text/javascript" src="./jquery.js"></script>

<script type="text/javascript">
var radious=200;//Change the Radious of circle
var speed = 35000;//Change the Speed
var duration=20;
var offsetX = $("#wobble").offset().left;
var offsetY = $("#wobble").offset().top;
function rotate(r1){
var sine,coss,nwidth,nheight;
for(var i=0;i<total;i++){
	q = ((360/cnt)*i+deg)*Math.PI/180;
	sine	= Math.sin(q);
	coss = Math.cos(q);
	q = (0.6+eSin*0.4);
	nwidth	= q*dim.width;
	nheight	= q*dim.height;
     $('#wooble').css({
	  top: centerY+15*sine,
	  left		: centerX+200*eCos,
	 opacity		: 0.8+sine*0.2,
	 marginLeft	: -nwidth/2,
	 zIndex		: Math.round(80+sine*20)
 	}).width(nwidth).height(nheight);

}
}
rotate(radious);
$("#wobble").hover(function() {	$(this).css({'z-index' : '10'});	$(this).find('img').addClass("hover").stop()
		.animate({marginTop: '-110px',	marginLeft: '-140px',	top: '50%',	left: '50%',width: '160px',		height: '160px', 
			padding: '15px'
		},100); 
	$(this).next().css({'z-index' : '30'}); $(this).next().find('img').addClass("hover").stop().animate({	marginTop: '-130px', 
			marginLeft: '-120px',
			top: '50%',
			left: '50%',
			width: '120px', 
			height: '120px', 
			padding: '15px'
		}, 200); 
  $(this).prev().css({'z-index' : '30'});
  $(this).prev().find('img').addClass("hover").stop()
		.animate({
			marginTop: '-130px', 
			marginLeft: '-120px',
			top: '50%',
			left: '50%',
			width: '120px', 
			height: '120px', 
			padding: '15px'
		},100); 
  
  
  } , function() {  
	$(this).css({'z-index' : '0'});
	$(this).find('img').removeClass("hover").stop() 
		.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0',
			left: '0',
			width: '100px',
			height: '100px',
			padding: '10px'
		}, 100);

$(this).next().css({'z-index' : '0'});
$(this).next().find('img').removeClass("hover").stop() 
	.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0',
			left: '0',
			width: '100px',
			height: '100px',
			padding: '10px'
		}, 100);
$(this).prev().css({'z-index' : '0'});
$(this).prev().find('img').removeClass("hover").stop() 
	.animate({
			marginTop: '0', 
			marginLeft: '0',
			top: '0',
			left: '0',
			width: '100px',
			height: '100px',
			padding: '5px'
		}, 100);

});
</script>






