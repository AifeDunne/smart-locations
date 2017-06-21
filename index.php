<html>
    <head>
        <title>Smart Locations</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:49.5vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#headerBox {position:relative; float:left; margin-left:0.9vw;  margin-top: 2vh; }
		#logoBox { position:relative; float:left; height:auto; width:auto; }
		#headerText { float:left; font-family: 'Questrial', sans-serif; color:#000; font-size: 4vw; margin-top: 6vh; }
		#subHeader { float:left; font-family: 'Questrial', sans-serif; color:#000; font-size: 1.2vw;  margin-top: -0.8vh;  margin-left: 4vw; }
		#navMenu { float: left; margin-left: 1.8vw; width: 46vw; height: 4.5vh; padding-top:2vh; margin-top: 3.5vh; background: rgba(255,255,255,0.3); text-align:center; clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; text-decoration:none; }
		#boxContent { float:left; margin-left: 1.8vw; width: 46.5vw; height:56vh; margin-top: 1.5vh; clear:left; }
		
		#t1 {float: left; width: 31%; height: 87%; padding-top:5%; background:url(/resources/Stripes.jpg); text-align:center; border:2px solid rgba(255,255,255,0.5); cursor:pointer; }
		#t2 {float: left; width: 31%; height: 87%; margin-left: 2%; padding-top:5%; background:url(/resources/Stripes.jpg); text-align:center; border:2px solid rgba(255,255,255,0.5); cursor:pointer;}
		#t3 { float: left; width: 31%; height: 87%; margin-left: 2%; padding-top:5%; background:url(/resources/Stripes.jpg); text-align:center; border:2px solid rgba(255,255,255,0.5); cursor:pointer;}
		
		.homeText { bottom:4vh; font-family: 'Questrial', sans-serif; color:#000; font-size:2.5vw; opacity:0.6; pointer-events:none; }
		.homePic { margin-bottom:1.5vh; pointer-events:none; }
		
		#footer { position:absolute; bottom:0; left:1.8vw; width:45.8vw; height:13vh; padding-top:2vh; background: rgba(255,255,255,0.3); }
		.footerItems { font-family: 'Questrial', sans-serif; color:#000; font-size: 1.2vw; text-align:center; clear:both; }
		</style>
    </head>
    <body>
	<div id="centerBox">
	<div id="headerBox"><img id="logoBox" src="/resources/Logo1.png"/><span id="headerText">Smart Locations</span><br><span id="subHeader">Oklahoma real estate listings.</span></div>
	<?php $headerSection = 'home'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="boxContent">
		<div id="t1" class="tiles"><img class="homePic" id="searchBox" src="/resources/Sold1.png"/><br><span class="homeText">Buy A Location</span></div>
		<div id="t2" class="tiles"><img class="homePic" id="sellBox" src="/resources/ForSale1.png"/><br><span class="homeText">List A Location</span></div>
		<div id="t3" class="tiles"><img class="homePic" id="rentBox" src="/resources/ForRent1.png"/><br><span class="homeText">Rent A Location</span></div></div>
	<script>
	$(document).ready(function() {
	var linkArray = ['None','/buy-home/','/sell-home/','/rent/'];
	$(".tiles").on({
		mouseenter: function() { $(this).find("span").stop().animate({"opacity":"1"},400); },
		mouseleave: function() { $(".homeText").stop().animate({"opacity":"0.6"},400); },
		click: function(ev) { ev.stopPropagation(); 
		var getLink = $(this).attr('id'); 
		getLink = getLink.substring(1); 
		getLink = linkArray[getLink]; 
		window.location.href = getLink; }
		});
	});
	</script>
	<div id="footer">
		<div class="footerItems"><b>Phone:</b> 555-5555</div>
		<div class="footerItems"><b>Email:</b> admin@smartlocations.com</div>
		<div class="footerItems"><b>555 Tornado Lane Drive, Oklahoma City, OK</b></div>
		<div class="footerItems" style="margin-top:0.8vh;">Smart Locations 2015 ©</div>
	</div>
	</div>
    </body>
</html>