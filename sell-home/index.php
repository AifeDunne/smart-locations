<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Locations - Sell Home</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:80vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#navMenu { float: left; margin-left: 10.5vw; width: 57vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.3); clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }
		
		#page1 { float:left; width: 58vw; margin-left: 10.5vw;}
		#toRegister { position:relative; float:left; width:48%; height:87%; margin-top: 3vh; }
		#toLogin { position:relative; float:right; width:48%; height:87%; margin-top: 3vh; }
		.contentBox { position:absolute; top:0; left:0; width:100%; height:100%; z-index:7; opacity:0.4; cursor:pointer; }
		.boxBG { position:absolute; top:0; left:0; width:100%; height:100%; background: rgba(255,255,255,0.3); z-index:5; }
		.positionBox { margin: auto; width:70%; height:60%; padding-top:20%; text-align:center; pointer-events:none; }
		.hFont { float:left; margin-bottom:4vh; font-size:2.3vw; font-weight:bold; font-family: 'Questrial', sans-serif; color:#000; pointer-events:none; }
		.spanFont { float:left; margin-top:3vh; font-size:1.4vw; font-family: 'Questrial', sans-serif; color:#000; pointer-events:none; }
	</style>
    </head>
    <body>
	<div id="centerBox">
	<?php $headerSection = 'sell'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="page1">
        <div id="toRegister">
			<div id="clickRegister" class="contentBox"><div class="positionBox">
			<span class="hFont">Register A New Account</span>
			<svg height="150" width="150">
				<circle cx="71" cy="71" r="70" stroke="black" stroke-width="2" fill="#FFF" />
				<polyline fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="85.8,33.087 45.63,68.087 85.375,105.8"/>
			</svg>  
			<span class="spanFont">With Smart Locations you can create virtual home tours, add and edit listings, edit your seller profile, and communicate with the people interested in buying your home! Take a minute to register an account with us and gain access to dozens of features allowing you to reach a wide audience of perspective house hunters.</span></div></div>
			<div class="boxBG"></div>
		</div>
		<div id="toLogin">
			<div id="clickLogin" class="contentBox"><div class="positionBox">
			<span class="hFont">Login To Your Current Account</span>
			<svg height="150" width="150">
				<circle cx="71" cy="71" r="70" stroke="black" stroke-width="2" fill="#FFF" />
				<polyline fill="none" stroke="#000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" points="55.375,35.375 100.63,68.087 55.375,105.8"/> 
			</svg>
			<span class="spanFont">If you already have an account with us merely click here to navigate to the member login portal so you can gain access to your Smart Locations account. If you cannot remember your password submit a lost password request and we can have it emailed to your account promptly.</span></div></div>
			<div class="boxBG"></div>
		</div>
	</div>
	<script>
	$(document).ready(function() {
	$("#clickRegister").on({
		mouseenter: function() { $("#clickRegister").stop().animate({"opacity":"1"},400); $("#clickLogin").stop().animate({"opacity":"0.4"},400); },
		mouseleave: function() { $("#clickRegister").stop().animate({"opacity":"0.4"},400);	},
		click: function(ev) { ev.stopPropagation(); window.location.href = "/sell-home/register/";	}
		});
	$("#clickLogin").on({
		mouseenter: function() { $("#clickLogin").stop().animate({"opacity":"1"},400); $("#clickRegister").stop().animate({"opacity":"0.4"},400); },
		mouseleave: function() { $("#clickLogin").stop().animate({"opacity":"0.4"},400);	},
		click: function(ev) { ev.stopPropagation(); window.location.href = "/dashboard/login/"; }
		});
	});
	</script>
	</div>
	</body>
</html>