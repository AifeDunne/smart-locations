<html>
    <head>
        <title>Smart Locations - View Profile</title>
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
		
		#box1 {float:left; width: 51vw; margin-left: 2vw;}
		#userProfile { float:left; width: 100%; height:33vh; padding-left:1vw; margin-top:2vh; clear:both; font-family: 'Questrial', sans-serif; color:#000; background: rgba(255,255,255,0.3); }
		#emailBox { position:relative; float:left; width: 100%; height:51vh; padding-left:1vw; margin-top:2vh; clear:both; font-family: 'Questrial', sans-serif; color:#000; background: rgba(255,255,255,0.3); }
		#selectBox { float:right; margin-right:1vw; }
		#inquiryOption { float:left; height: 4vh; margin-top: 0.8vw; margin-left:1vw; }
		#emailForm { float:left; margin-top:3vh; clear:left; }
		#emailButton { position:absolute; bottom:1vh; left:0; width:100%; height:8vh; }
		#emailWarn { float:left; clear:both; color:red; margin-left: 7vw; margin-top: -0.2vh; display:none; }
		#emailSuccess { float:left; clear:both; color:green; margin-left: 7vw; margin-top: -0.2vh; display:none; }
		
		#propertyList {float:left; width:24vw; background:rgba(255,255,255,0.3); height:98%; margin-top:-4%; margin-left:1.5vw;}
		</style>
    </head>
	<?php if (!empty($_GET['profileID'])) : ?>
    <body>
	<div id="centerBox">
	<?php $headerSection = 'other'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="box1">
	<?php
	include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
	$pullPerson = "SELECT name, company, primary_phone, secondary_phone, fax, website, user_type FROM userDetails	WHERE id = ".$_GET['profileID'];
	$getPerson = $mysqli->query($pullPerson);
	$userDetails = $getPerson->fetch_array();
	$name = $userDetails['name'];
	$company = $userDetails['company'];
	if ($company === "") { $company = "Unaffiliated"; }
	$primary_phone = $userDetails['primary_phone'];
	$secondary_phone = $userDetails['secondary_phone'];

	function FixPhone($phone_number) {
	if ( $phone_number !== "N/A" ) {
	$new_phone = str_split($phone_number);
	$phoneStr = '';
	$phoneCount = 0;
	$dashCount = 0;
	foreach ($new_phone as $digits) {
	$phoneCount++;
	if ($dashCount < 2) { if ($phoneCount === 4) { $phoneStr.= "-"; $phoneCount = 1; $dashCount++; }	}
	$phoneStr.= $digits;
		}
	return $phoneStr; }
	else { return $phone_number; }
	}
	$primary_phone = FixPhone($primary_phone);
	$secondary_phone = FixPhone($secondary_phone);
	
	$fax = $userDetails['fax'];
	$website = $userDetails['website'];
	$user_type = $userDetails['user_type'];
	$actualuser = array("N/A","Private Seller","Landlord","Realtor","Property Manager");
	$user_role = $actualuser[$user_type];
  
  $userProfile = "<div id='userProfile'>";
  $userProfile.= "<div style='float:left; width:60%;'><span style='float:left; font-size:2vw; margin-top:3vh;'>".$name."</span><span style='float:left; clear:both; font-size:1.2vw;'>".$user_role."</span><span style='float:left; margin-top:2vh; clear:both; font-size:1.2vw;'><b>Company: </b>".$company."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Primary Phone: </b>".$primary_phone."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Seconday Phone: </b>".$secondary_phone."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Fax:</b> ".$fax."</span><span style='float:left; clear:both; font-size:1.2vw;'><b>Website:</b> ".$website."</span></div>
  </div>";
  echo $userProfile;
  
  $hasListings = "Yes";
  $propertyProfile = "
  <div id='propertyList'>";
	$findListings = "SELECT street_address, property_city, bedrooms, bathrooms, property_cost FROM property_listing WHERE user_id = ".$_GET['profileID'];
	$listingAmount = $mysqli->query($findListings);
	if ( $listingAmount->num_rows === 0) {
	$propertyProfile.= 'No results found.';
	$hasListings = "No";
	} else {
	$returnListings = $mysqli->prepare($findListings);
	$returnListings->execute();
	$getAddress = array();
	$returnListings->bind_result($street, $city, $bedrooms, $bathrooms, $cost);
	while ($returnListings->fetch()) {
	$getAddress[] = $street;
	$propertyProfile.= "<div style='float:left; width:100%; height:14.4vh; clear:both; margin-bottom:1vh;'>
		<div style='float:left; width:70%; margin-left:1vw; font-family: Questrial, sans-serif; color:#000; padding-top:1vh;'>
		<span style='float:left; font-weight:bold; font-size:1.5vw;'>".$street."<br/>".$city.", OK </span><span style='float:left; clear:both; font-size:1.2vw;'>".$bedrooms." Bedrooms - ".$bathrooms." Bathrooms</span><span style='float:left; clear:both; font-size:1.2vw;'>Price: $".$cost."</span>
		</div>
	</div>
	";}
	$returnListings->close();
	}
    $propertyProfile.= "</div>";
  
  $emailForm = "<div id='emailBox'><span style='float:left; font-size:2vw; margin-top:2vh;'>Contact Me</span><div id='selectBox'><span style='float:left; font-size:1.5vw; margin-top:2vh; '>Topic: </span>";
  $emailInput = "<select id='inquiryOption' class='selectData'><option value=''></option><option value='General Question'>General Question</option><option value='Pricing'>Pricing</option>";
  if ($hasListings !== "No") {
  foreach ($getAddress as $listing) {
  $formValue = "Property - ".$listing;
  $stringLength = strlen($formValue);
  if ($stringLength > 40) { $formValue = substr($formValue, 0, 40)."..."; }
  $emailInput.= "<option value='".$formValue."'>".$formValue."</option>";  }
  }
  $emailInput.= "</select></div>";
  $emailForm.= $emailInput;
  $emailFields = '<div id="emailForm">
  <div class="formHolder"><label for="email-address" class="formTitle">Email Address: </label><input class="textInput selectData" type="text" name="email-address" id="email-address" placeholder="test@test.com" style="width:16vw; height:4vh;"></div>
  <div class="formHolder"><label for="email-name" class="formTitle">Full Name: </label><input class="textInput selectData" type="text" name="email-name" id="email-name" placeholder="John Smith" style="width:19vw; height:4vh;"></div>
  <div class="formHolder"><label for="email-message" class="formTitle">Message: </label><textarea id="email-message" class="selectData" rows="8" cols="50" placeholder="Enter your message here." style="width:30vw; height:20vh;"></textarea></div>
  <div id="emailWarn">You have not filled out all the required information.</div>
  <div id="emailSuccess">Your message has been sent successfully!</div>
  </div>
  <button id="emailButton">Send Message</button>';
  $emailForm.= $emailFields;
  $emailScript = '
  <script>
  var IDEmail = '.$_GET['profileID'].';
  $(document).ready(function() {
  $("#emailButton").on("click", function() {
		var requiredInfo = "";
		$(".selectData").each(function(){ var grabData = $(this).val();	if (grabData == "") { requiredInfo = "NULL"; }	});
		if (requiredInfo == "NULL") { $("#emailWarn").stop().fadeIn(400); setTimeout(function() { $("#emailWarn").stop().fadeOut(400); },2000); }
		else {
		var dataArr = new Array();
		$(".selectData").each(function(){
		var grabData2 = $(this).val();
		dataArr.push(grabData);
		});
		$.ajax({
			type: "POST",
			url: "email/sendEmail.php", 
			data: { sendTo: IDEmail, emailTopic: dataArr[0], emailFrom: dataArr[1], emailName: dataArr[2], emailMessage: dataArr[3] },
			success: function () { $(".selectData").val(""); 
			$("#emailSuccess").stop().fadeIn(400); setTimeout(function() { $("#emailSuccess").stop().fadeOut(400); },2000);
					}
				})
			}
		});
  });
  </script>';
  echo $emailForm.$emailScript."</div></div>";
  echo $propertyProfile;
  ?>
	</div>
</body>
<?php else : ?>
            <p>
                <span id="NoProfile">The profile you are searching for does not exist.</span>
            </p>
        <?php endif; ?>
</html>