<html>
    <head>
        <title>Smart Locations - Home Details</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBQ09GeRsP4JKvQeLtr5OjUGywjx6YCz8U" type="text/javascript"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
	$pullData = "SELECT user_id, street_address, rental_city, bedrooms, bathrooms, rental_cost, rental_type, rental_available, rental_lat, rental_long, rental_area, rental_thumb, rental_size, year_built, cooling, heating, fireplace, parking, lot_size, rental_description FROM rental_listing 
	LEFT JOIN rental_details ON rental_details.rental_id = rental_listing.rental_id
	WHERE rental_listing.rental_id = ".$_GET['homeID'];
	$getProperty = $mysqli->query($pullData);
	$rentalDetails = $getProperty->fetch_array();
	$address = $rentalDetails['street_address'];
	$city = $rentalDetails['rental_city'];
	$bedrooms = $rentalDetails['bedrooms'];
	$bathrooms = $rentalDetails['bathrooms'];
	$cost = $rentalDetails['rental_cost'];
	$type = $rentalDetails['rental_type'];
	$available = $rentalDetails['rental_available'];
	$date = new DateTime($available);
	$available = $date->format('F d');
	$lat = $rentalDetails['rental_lat'];
	$long = $rentalDetails['rental_long'];
	$area = $rentalDetails['rental_area'];
	$pic = $rentalDetails['rental_thumb'];
	$size = $rentalDetails['rental_size'];
	$year = $rentalDetails['year_built'];
	$cooling = $rentalDetails['cooling'];
	$heating = $rentalDetails['heating'];
	$fireplace = $rentalDetails['fireplace'];
	$parking = $rentalDetails['parking'];
	$lotsize = $rentalDetails['lot_size'];
	$description = $rentalDetails['rental_description'];
	$hasGallery = $rentalDetails['hasGallery'];
	$person = $rentalDetails['user_id'];
	$profileData = "SELECT name, company, user_type FROM userDetails WHERE id = ".$person;
	$getPerson = $mysqli->query($profileData);
	$profileConstruct = $getPerson->fetch_array();
	$name = $profileConstruct['name'];
	$company = $profileConstruct['company'];
	if ($company === "") { $company = "Unaffiliated"; }
	$userNumber = $profileConstruct['user_type'];
	$userArray = array("N/A","Private Seller","Landlord","Realtor","Property Manager");
	$userType = $userArray[$userNumber];
	if ($area !== "Oklahoma City") { $area = $area." Oklahoma"; }
	$fullString = "";
	$addressRow = "<div id='addressBox' style='float:left; width:99%; height:7vh; padding-left:1%; padding-top:0.5vh; padding-bottom:0.5vh; font-family: Questrial, sans-serif; text-align:left; clear:both;'><span style='font-size:2vw;'>".$address.", ".$city."</span><br><span style='clear:both; font-size:1.2vw;'>".$area."</span></div>";
	$firstRow = '<div id="firstRow">';
	if ($lat !== "NULL" && $long !== "NULL") {
	  $firstRow.= "<script>
	  function initialize() {
	  var myLatlng = new google.maps.LatLng(".$lat.", ".$long.");
	  var mapOptions = {
		zoom: 14,
		center: myLatlng
	  }
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	  var marker = new google.maps.Marker({
      position: myLatlng,
      map: map,
      title: 'Home Location'
		});
	  }
	  $(document).ready(initialize);
	  </script>";
	}
  if ($size === 0 || $size === '0') { $size = "N/A"; }
  else { $size.= " sqft"; }
  if ($pic !== "NULL") {  $firstRow.= "<div id='map-canvas'></div><div id='pictureBox'><img src='/rent/full-images/".$pic."' style='float:right; height:100%;'/></div></div>";  }
  else { $firstRow.= "<div id='map-canvas'></div><div id='pictureBox'><img src='/rent/full-images/None.jpg' style='float:right; height:100%;'/></div></div>"; }
  $fullString.= $addressRow.$firstRow;
  
  $actualCool = array("N/A", "Central", "Window Unit", "Full A/C", "Ceiling Fan", "None");
  $actualHeat = array("N/A", "Central", "Home Furnace", "Gas Heated", "Wood Stove", "None");
  $actualFire = array("N/A", "Firewood", "Gas-Fed", "Electrical", "None");
  $actualPark = array("N/A", "Garage", "Carport", "Driveway", "Street", "None");
  $cooling = $actualCool[$cooling];
  $heating = $actualHeat[$heating];
  $fireplace = $actualFire[$fireplace];
  $parking = $actualPark[$parking];
  if ($area === "Oklahoma City") { $area = ""; }
  else { $area = $area.", Oklahoma"; }
  
  $userProfile = "<div id='userBox'><a href='/view-profile?profileID=".$person."' style='float:left; font-size:2.2vw;'>".$name."</a>";
  $company = "<span style='float:left; font-size:1.5vw; clear:both; '>".$company."</span>";
  $uType = "<span style='float:left; clear:both; font-size:1.2vw;'>".$userType."</span>"; 
  if ($company !== "N/A") { $userProfile.= $company; }
  if ($userType !== "N/A") { $userProfile.= $uType; }
  $userProfile.= "</div>";
  $thirdRow.= "<div id='thirdRow'><div style='float:left; width:58%; margin-top:0.5vh;'><span style='float:left; clear:both; font-size:2vw;'><b>Listed Price:</b> $".$cost."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Square Footage:</b> ".$size."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Available:</b> ".$available."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Bedrooms</b>: ".$bedrooms."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Bathrooms</b>: ".$bathrooms."</span><div style='float:left; height:28vh; clear:both; font-size:1.2vw; margin-top:1vh; overflow-y:auto;'><b>Description:</b> ".$description."</div></div><div style='float:left; width:40%; padding-left:2%;'>".$userProfile."<span style='float:left; clear:both; font-size:1.2vw;'><b>Apartment Type:</b> ".$type."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Year Built:</b> ".$year."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Cooling:</b> ".$cooling."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Heating:</b> ".$heating."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Fireplace:</b> ".$fireplace."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Parking:</b> ".$parking."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Lot Size:</b> ".$lotsize."</span></div></div></div>";
  $fullString.= $thirdRow;
  
	$box2 = "";
	if ($hasGallery === "Yes") {
	$boxWidth = "95vw";
	$box2 = "<div id='box2'>";
	$boxTitle = "<div id='box2T'>Apartment Tour</div>";
	$controlBox = "<div id='controlBox' style='float:right; width:34%; height:91.9%;'><div id='quickSearch' style='float:left; width: 90%; margin-left: 4%; padding-bottom: 1.5%; border-left:1px solid #b3b3b3;'>";
	$galleryPicB = "<div id='galleryPicBox' style='background: rgba(255,255,255,0.2);'><div class='sContent' style='float:right; height:100%; margin-right: -3%; direction:ltr;'>";
  	$pullGallery = "SELECT prefix, number, room_array, name_array, regular_array, picArray FROM virtual_tour WHERE listing_id = ".$_GET['homeID'];
	$getGallery = $mysqli->query($pullGallery);
	$galleryDetails = $getGallery->fetch_array();
	$prefix = $galleryDetails['prefix'];
	$number = $galleryDetails['number'];
	$roomArray = $galleryDetails['room_array'];
	$nameArray = $galleryDetails['name_array'];
	$regularArray = $galleryDetails['regular_array'];
	$picArr = $galleryDetails['picArray'];
	$qScript = "<script>
	var roomsNow = [".$picArr."];
	</script>";
	$roomArray = explode(",",$roomArray);
	$nameArray = explode(",",$nameArray);
	$regularArray = explode(",",$regularArray);
	$picArray = explode(",",$picArr);
	$startBorder = 0;
	$qLinks = "";
	foreach ($roomArray as $roomNum) {
	$mOne = $roomNum - 1;
	if ($mOne === 0) { $pMargin = ""; }
	else { $pMargin = "margin-top:3vh;"; }
	$picAmount = intval($picArray[$mOne]);
	$isGreater = 0;
	if ($picAmount > 1) { $isGreater = 1; $pRoomPad = "1vh"; $pScrollPad = ""; }
	else { $pRoomPad = "2vh"; $pScrollPad = "padding-top:2vh;"; }
	$galleryPicB.= "<div id='room".$roomNum."' style='position:relative; float:left; width:24vw; font-family: Questrial, sans-serif; padding-top:0.5vh; padding-bottom:".$pRoomPad."; ".$pMargin." text-align:center; clear:both;'><span style='font-size:1.3vw;'>".$regularArray[$mOne]."</span>";
	$qLinks.= "<div id='qLink".$roomNum."' class='qLink'>".$roomNum.". ".$regularArray[$mOne]."</div>";
	$imgPic = "Rental".$_GET['homeID']."-".$nameArray[$mOne]."-Picture";
	$picCounter = 0;
	$picString = "<div id='roomShow".$roomNum."' class='picShow' style='position:relative; float:left; width:24vw; margin-top:1vh; max-height: 40vh; clear:both;'>";
	$textIntString = "<div id='pScroll".$roomNum."' class='textInt' style='position:relative; float:left; text-align:center; width:100%; clear:both; ".$pScrollPad."'>";
	if ($isGreater > 0) { $textIntString.= "<span id='pLArrow".$roomNum."' class='pLArrow' style='margin-right:1vw; font-size:1.5vw; cursor:pointer; '>&#x21e6;</span>"; }
	$picHide = 0;
	for ($x = 0; $x < $picAmount; $x++) {
	$picCounter++;
	$fullPic = $imgPic.$x.".jpg";
	if ($picHide === 0) { $pDisplay = "activePic"; $pClass = "aNumLink"; }
	else { $pDisplay = "inactivePic"; $pClass = "iNumLink"; }
	$picString.= "<img id='rPic".$roomNum."-".$x."' class='vtElement roomPic".$roomNum." ".$pDisplay."' src='/rent/full-images/virtual-tour/".$fullPic."' style='float:left; width:24vw; max-height: 40vh; cursor:zoom-in;' />";
	$textIntString.= "<span id='r".$roomNum."-".$x."' class='r".$roomNum." numLinks ".$pClass."' style='margin-right:1vw;'>".$picCounter."</span>";
	$picHide++;	}
	if ($isGreater > 0) { $textIntString.= "<span id='pRArrow".$roomNum."' class='pRArrow' style='margin-right:1vw; font-size:1.5vw; cursor:pointer;'>&#x21e8;</span>"; }
	$isGreater = 0;
		$galleryPicB.= $picString."</div>".$textIntString."</div></div>";
		}
	$controlBox.= $qLinks."</div></div>";
	$box2.= $boxTitle.$controlBox.$galleryPicB."</div></div>".$qScript;
	$fullString.= $box2."</div>";
	} else { $boxWidth = "56vw"; }
	?>
		<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:<?php echo $boxWidth; ?>; float:none; margin-left:auto; margin-right:auto;  }
		#navMenu { float: left; margin-left: 1vw; width: 53vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.8); clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }
		.formHolder { float:left; clear:both; margin-bottom:1vh; }
		.formTitle { float:left; font-size:1.5vw; margin-right:1vw; font-family: 'Questrial', sans-serif; color:#000; }
		
		#box1 {float:left; width: 52vw; margin-left: 1vw; padding-left:1vw; padding-right:1vw; background:rgba(255,255,255,0.7);}
		#firstRow { float:left; width:100%; height:40vh; clear:both; }
		#secondRow { float:left; width:100%; height:7vh; clear:both; font-family: 'Questrial', sans-serif; padding-top:1vh; }
		#userBox { float:left; width: 97%; padding-left: 3%; height:14vh; padding-top:1vh; margin-bottom:0.5vh; background:rgba(255,255,255,0.3); font-family: 'Questrial', sans-serif; border:1px solid black; }
		#thirdRow { float:left; width:100%; height:44vh; clear:both; font-family: 'Questrial', sans-serif;  padding-top:1vh; }
		#map-canvas { float:left; width:40%; height:100%; }
		#pictureBox { float:left; width:60%; height:100%; overflow-x:auto; }
		
		#box2 {position:relative; float:right; width:37.5vw; border-left:1.5vw solid rgba(255,255,255,0); background: rgba(255,255,255,0.7); height: 99.5%; margin-top: -3.45%; }
		#box2T { position:relative; float:left; width: 67%; height: 4%; padding-right: 33%; padding-top: 2.4%; padding-bottom: 3%; font-family: 'Questrial', sans-serif; font-size: 2vw; text-align:center; clear:both; }
		#galleryPicBox { position:relative; float:right; width:66%; height:91.9%; overflow-y:auto; overflow-x:hidden; direction:rtl;}
		#galleryPicBox::-webkit-scrollbar-track{ background:rgba(255,255,255,0.3); }
		#galleryPicBox::-webkit-scrollbar{ width: 0.8vw; background:rgba(255,255,255,0.3); }
		#galleryPicBox::-webkit-scrollbar-thumb{ background: #FFF; border:1px solid #b3b3b3; }
		
		.qLink { float:left; width:100%; height:4vh; padding-top:1vh; padding-left: 5.5%; font-family: Questrial, sans-serif; font-size:1.3vw; text-align:left; clear:both; background:transparent; cursor:pointer; }
		.qLink:hover { background:rgba(255,255,255,0.9); }
		
		.activePic { display:block; }
		.inactivePic { display:none; }
		
		.aNumLink { font-weight:bold; cursor:default; }
		.iNumLink { font-weight:none; cursor:pointer; }
		</style>
    </head>
	<?php if (!empty($_GET['homeID'])) : ?>
    <body>
	<div id="centerBox">
	<?php $headerSection = 'buy'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="box1">
	<?php echo $fullString; ?>
	</div>
	
	<div id='picOverlay' style='position:absolute; top:0; right:1px; width:60%; height:100%; border-left:4vw solid rgba(255,255,255,0.2); border-right:4vw solid rgba(255,255,255,0.2); z-index:10; background:rgba(255,255,255,0.7); display:none; font-family: Questrial, sans-serif; font-size:2vw; color:#000; text-align:center;'><div id="prevLPic" style="position:absolute; left:-4vw; font-size:4vw; top:50%; transform: translateY(-50%); cursor:pointer;">&#x21e6;</div><div id="closeOverlay" style="position:absolute; right:-3vw; top:3vh; font-size:3vw; z-index:15; cursor:pointer;">&#x2716;</div><div id="nextLPic" style="position:absolute; right:-4vw; font-size:4vw; top:50%; transform: translateY(-50%); cursor:pointer;">&#x21e8;</div></div>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.11.3/jquery-ui.min.js"></script>
		<script>
			$.fn.scrollTo = function( target, options, callback ){
			  if(typeof options == 'function' && arguments.length == 2){ callback = options; options = target; }
			  var settings = $.extend({
				scrollTarget  : target,
				offsetTop     : 50,
				duration      : 500,
				easing        : 'swing'
			  }, options);
			  return this.each(function(){
				var scrollPane = $(this);
				var scrollTarget = (typeof settings.scrollTarget == "number") ? settings.scrollTarget : $(settings.scrollTarget);
				var scrollY = (typeof scrollTarget == "number") ? scrollTarget : scrollTarget.offset().top + scrollPane.scrollTop() - parseInt(settings.offsetTop);
				scrollPane.animate({scrollTop : scrollY }, parseInt(settings.duration), settings.easing, function(){
				  if (typeof callback == 'function') { callback.call(this); }
				});
			  });
			}
						
		$(document).ready(function() {
		$(document).on("click", ".qLink", function() {
		var goToRoom = $(this).attr("id");
		goToRoom = goToRoom.replace("qLink","");
		var fRoom = "#room"+goToRoom
		$('#galleryPicBox').scrollTo(fRoom,{duration:'slow', offsetTop : '67'});;
			});
		
		$(document).on("click", ".pLArrow", function() {
		var whichRoom = $(this).attr("id");
		whichRoom = whichRoom.replace("pLArrow","");
		var oldNumLink = $(this).parent().find(".aNumLink");
		var oldPic = $(this).parent().parent().find(".picShow").find(".activePic");
		var currentNum = oldPic.attr("id");
		currentNum = currentNum.split("-");
		currentNum = currentNum[1];
		currentNum = parseInt(currentNum);
		var calcRate1 = currentNum - 1;
		if (calcRate1 >= 0) {
		oldPic.stop().fadeOut(500);
		setTimeout(function() {
		oldPic.removeClass("activePic").addClass("inactivePic");
		oldNumLink.removeClass("aNumLink").addClass("iNumLink");
		$("#rPic"+whichRoom+"-"+calcRate1).removeClass("inactivePic").addClass("activePic");
		$("#r"+whichRoom+"-"+calcRate1).removeClass("iNumLink").addClass("aNumLink");
		$("#rPic"+whichRoom+"-"+calcRate1).stop().fadeIn(500);
		}, 500);
				}
			});
		$(document).on("click", ".pRArrow", function() {
		var whichRoom = $(this).attr("id");
		whichRoom = whichRoom.replace("pRArrow","");
		var aKey = whichRoom - 1;
		var fullRoomN = roomsNow[aKey];
		var oldNumLink = $(this).parent().find(".aNumLink");
		var oldPic = $(this).parent().parent().find(".picShow").find(".activePic");
		var currentNum = oldPic.attr("id");
		currentNum = currentNum.split("-");
		currentNum = currentNum[1];
		currentNum = parseInt(currentNum);
		var calcRate2 = currentNum + 1;
		if (calcRate2 < fullRoomN) {
		oldPic.stop().fadeOut(500);
		setTimeout(function() {
		oldPic.removeClass("activePic").addClass("inactivePic");
		oldNumLink.removeClass("aNumLink").addClass("iNumLink");
		$("#rPic"+whichRoom+"-"+calcRate2).removeClass("inactivePic").addClass("activePic");
		$("#r"+whichRoom+"-"+calcRate2).removeClass("iNumLink").addClass("aNumLink");
		$("#rPic"+whichRoom+"-"+calcRate2).stop().fadeIn(500);
		}, 500);
				}
			});
			
		$(document).on("click", ".numLinks", function() {	
		var cTitleCheck = $(this).attr("class");
		cTitleCheck = cTitleCheck.split(" ");
		var wClass = cTitleCheck[2];
		if (wClass == "iNumLink") {
		var crntParent = $(this).parent();
		var oldText = crntParent.find(".aNumLink");
		var crntData = $(this).attr("id");
		crntData = crntData.split("-");
		var crntPRoom = crntData[0];
		crntPRoom = crntPRoom.replace("r","");
		crntPRoom = parseInt(crntPRoom);
		var changeToPic = crntData[1];
		changeToPic = parseInt(changeToPic);
		var oldPicC = $("#roomShow"+crntPRoom).find(".activePic");
		oldPicC.stop().fadeOut(500);
		setTimeout(function() {
		oldText.removeClass("aNumLink").addClass("iNumLink");
		oldPicC.removeClass("activePic").addClass("inactivePic"); 
		$("#r"+crntPRoom+"-"+changeToPic).removeClass("iNumLink").addClass("aNumLink");
		$("#rPic"+crntPRoom+"-"+changeToPic).removeClass("inactivePic").addClass("activePic");
		$("#rPic"+crntPRoom+"-"+changeToPic).stop().fadeIn(500);
		}, 500);
				}
			});
	
	var busyAnim = 0;
	$(document).on("click", ".vtElement", function() {
	var gVar = $(this).attr("id");
	gVar = gVar.split("-");
	var gArrVar = gVar[0];
	gArrVar = gArrVar.replace("rPic","");
	gArrVar = parseInt(gArrVar);
	gArrVar = gArrVar - 1;
	var gPicKey = gVar[1];
	gPicKey = parseInt(gPicKey);
	var ggPerNoRe = roomsNow[gArrVar];
	ggPerNoRe = ggPerNoRe - 1;
	var gPicGet = $(this).attr("src");
	$("#picOverlay").append("<img id='largePic' src='"+gPicGet+"' style='position:relative; max-width:100%; max-height:100%; top: 50%; transform: translateY(-50%); margin-left:auto; margin-right:auto;'/>");
	$("#picOverlay").show( "slide", {direction: "right" }, 500 );
	$(document).on("click", "#closeOverlay", function() {
	gVar = "";
	gPicKey = "";
	gArrVar = "";
	ggPerNoRe = "";
	$("#picOverlay").hide( "slide", {direction: "right" }, 500 );
	setTimeout(function() { $("#picOverlay").find("#largePic").remove(); }, 500);
				});
	function goLeft(G1A,G1B) {
	if (busyAnim == 0) {
	if (G1A > 0) {
	G1A = G1A - 1;
	busyAnim = 1;
	var lPic1 = $("#picOverlay").find("#largePic");
	var crName = G1B + 1;
	var nsPic = $("#rPic"+crName+"-"+G1A);
	var nsPath = nsPic.attr("src");
	lPic1.stop().fadeOut(450);
	setTimeout(function() { lPic1.attr("src",""); }, 450);
	setTimeout(function() { lPic1.attr("src",nsPath); }, 480);
	setTimeout(function() { lPic1.stop().fadeIn(450); }, 550);
	setTimeout(function() { busyAnim = 0; }, 1000);
	var uText1 = "UPDATE";
	return uText1;
			}
		} else { return false; }
	}
	function goRight(G2A,G2B) {
	if (busyAnim == 0) {
	if (G2A < G2B) {
	G2A++;
	busyAnim = 1;
	var lPic2 = $("#picOverlay").find("#largePic");
	var crName = gArrVar + 1;
	var nsPic = $("#rPic"+crName+"-"+G2A);
	var nsPath = nsPic.attr("src");
	lPic2.stop().fadeOut(450);
	setTimeout(function() { lPic2.attr("src",""); }, 450);
	setTimeout(function() { lPic2.attr("src",nsPath); }, 480);
	setTimeout(function() { lPic2.stop().fadeIn(450); }, 550);
	setTimeout(function() { busyAnim = 0; }, 1000);
	var uText2 = "UPDATE";
	return uText2;
			}
		} else { return false; }
	}
	$(document).on("click", "#prevLPic", function() { var gStatus1 = goLeft(gPicKey,gArrVar); if (gStatus1 == "UPDATE") { gPicKey = gPicKey - 1; }});
	$(document).on("click", "#nextLPic", function() { var gStatus2 = goRight(gPicKey,ggPerNoRe); if (gStatus2 == "UPDATE") { gPicKey++; }});
			});
		});
	</script>
</body>
<?php else : ?>
            <p>
                <span id="NoHome">The home you are searching for does not exist.</span>
            </p>
        <?php endif; ?>
</html>