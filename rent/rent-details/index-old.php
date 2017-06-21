<html>
    <head>
        <title>Smart Locations - Rental Details</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&signed_in=true&libraries=places"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:80vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#navMenu { float: left; margin-left: 2vw; width: 51vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.3); clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }
		.formHolder { float:left; clear:both; margin-bottom:1vh; }
		.formTitle { float:left; font-size:1.5vw; margin-right:1vw; font-family: 'Questrial', sans-serif; color:#000; }
		
		#box1 {float:left; width: 52vw; margin-left: 2vw;}
		#firstRow { float:left; width:100%; height:40vh; clear:both; }
		#secondRow { float:left; width:100%; height:19vh; clear:both; font-family: 'Questrial', sans-serif; padding-top:2vh; }
		#userBox { float:left; width: 95%; padding-left: 5%; height:14vh; padding-top:1vh; margin-bottom:1.5vh; background:rgba(255,255,255,0.3); font-family: 'Questrial', sans-serif; border:1px solid black; }
		#thirdRow { float:left; width:95%; height:22vh; clear:both; font-family: 'Questrial', sans-serif; padding-top:2vh; }
		#map-canvas { float:left; width:40%; height:100%; }
		#pictureBox { float:left; width:60%; height:100%; overflow-x:auto; }
		
		#box2 {float:left; width:24vw; background:rgba(255,255,255,0.3); height:98%; margin-top:-4%; margin-left:0.5vw;}
		</style>
    </head>
	<?php if (!empty($_GET['homeID'])) : ?>
    <body>
	<div id="centerBox">
	<?php $headerSection = 'rent'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="box1">
	<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
	$pullData = "SELECT user_id, street_address, rental_city, bedrooms, bathrooms, rental_cost, rental_type, rental_available, rental_lat, rental_long, rental_area, rental_thumb, rental_size, year_built, cooling, heating, fireplace, parking, lot_size, rental_description FROM rental_listing 
	LEFT JOIN rental_details ON rental_details.rental_id = rental_listing.rental_id
	WHERE rental_listing.rental_id = ".$_GET['homeID'];
	$getrental = $mysqli->query($pullData);
	$rentalDetails = $getrental->fetch_array();
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
	$firstRow = '<div id="firstRow">';
	if ($lat !== "NULL" && $long !== "NULL") {
	  $firstRow.= "<script>
	  function initialize() {
	  var myLatlng = new google.maps.LatLng(".$lat.", ".$long.");
	  var mapOptions = {
		zoom: 13,
		center: myLatlng
	  }
	  map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
	   overlay = new google.maps.OverlayView();
	   overlay.draw = function () {};
	   overlay.setMap(map);
	  }
	  $(document).ready(initialize);
	  </script>";
	}
  if ($size === 0 || $size === '0') { $size = "N/A"; }
  else { $size.= " sqft"; }
  if ($pic !== "NULL") {  $firstRow.= "<div id='map-canvas'></div><div id='pictureBox'><img src='/rent/full-images/".$pic."' style='float:right; height:100%;'/></div></div>";  }
  else { $firstRow.= "<div id='map-canvas'></div><div id='pictureBox'><img src='/rent/full-images/None.jpg' style='float:right; height:100%;'/></div></div>"; }
  echo $firstRow;
  
  $actualCool = array("N/A", "Central", "Window Unit", "Full A/C", "Ceiling Fan", "None");
  $actualHeat = array("N/A", "Central", "Home Furnace", "Gas Heated", "Wood Stove", "None");
  $actualFire = array("N/A", "Firewood", "Gas-Fed", "Electrical", "None");
  $actualPark = array("N/A", "Garage", "Carport", "Driveway", "Street", "None");
  $cooling = $actualCool[$cooling];
  $heating = $actualHeat[$heating];
  $fireplace = $actualFire[$fireplace];
  $parking = $actualPark[$parking];
  
  $secondRow = "<div id='secondRow'>";
  $secondRow.= "<div style='float:left; width:60%;'><span style='float:left; font-size:2vw;'>".$address.", ".$city.", OK</span><span style='float:left; clear:both; font-size:1.2vw;'>".$area." Oklahoma</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Available:</b> ".$available."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Year Built:</b> ".$year."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Listed Price:</b> $".$cost."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Bedrooms</b>: ".$bedrooms."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Bathrooms</b>: ".$bathrooms."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Home Type:</b> ".$type."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Square Footage:</b> ".$size."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Lot Size:</b> ".$lotsize."</span></div><div style='float:left; width:40%;'>";
  
  $userProfile =  "<div id='userBox'><span style='float:left; clear:both; font-size:2vw;'>".$name."</span>";
  $company = "<span style='float:left; clear:both; font-size:1.2vw;'>".$company."</span>";
  $type = "<span style='float:left; clear:both; font-size:1.2vw;'>".$userType."</span>"; 
  if ($company !== "N/A") { $userProfile.= $company; }
  if ($userType !== "N/A") { $userProfile.= $type; }
  $userProfile.= "</div>";
  
  $secondRow.= $userProfile."<span style='float:left; clear:both; font-size:1.2vw;'><b>Cooling:</b> ".$cooling."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Heating:</b> ".$heating."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Fireplace:</b> ".$fireplace."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Parking:</b> ".$parking."</span></div>";
  echo $secondRow;
  
  $thirdRow = "<div id='thirdRow'><span style='float:left; clear:both; font-size:1.2vw;'><b>Description:</b> ".$description."</span></div>";
  echo $thirdRow;
  echo "</div></div>";
  echo "<div id='box2'></div>";
	?>
	</div>
</body>
<?php else : ?>
            <p>
                <span id="NoHome">The home you are searching for does not exist.</span>
            </p>
        <?php endif; ?>
</html>