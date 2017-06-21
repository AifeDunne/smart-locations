<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';
 
sec_session_start();
if (login_check($mysqli) == false) { header('Location: /dashboard/login/'); }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Locations - Dashboard</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.14/themes/black-tie/jquery-ui.css">
		<link rel="stylesheet" href="resources/dashboard.css">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    </head>
	<?php if (login_check($mysqli) == true) : ?>
    <body>
	<?php
		$findUser = $_SESSION['username'];
		$grabID = "SELECT id FROM members WHERE username = '".$findUser."'";
		$parseID = $mysqli->query($grabID);
		$currentWork = $parseID->fetch_array();
		$thisID = $currentWork['id'];
		$_SESSION['userID'] = $thisID;
		$grabName = "SELECT name FROM userDetails WHERE id = '".$_SESSION['userID']."'";
		$retrieveName = $mysqli->query($grabName);
		$getName = $retrieveName->fetch_array();
		$currentName = $getName['name'];
		require 'operations/fillDashboard.php'; 
		?>
	<div id="mainWindow">
	<script>
	<?php
	global $thisID;
	echo "var currentUser = ".$thisID.";";
	?>
	
	var cities = ['Ada','Adair','Afton','Alex','Allen','Altus','Alva','Anadarko','Antlers','Apache','Arapaho','Ardmore','Arkoma','Arnett','Atoka','Barnsdall','Bartlesville','Beaver','Beggs','Bernice','Bethany','Bethel Acres','Billings','Binger','Blackwell','Blair','Blanchard','Boise','Bokchito','Bokoshe','Boley','Boswell','Bray','Bristow','Broken Arrow','Broken Bow','Buffalo','Burns Flat','Byng','Cache','Caddo','Calera','Calumet','Canton','Canute','Carnegie','Carney','Catoosa','Cement','Central High','Chandler','Checotah','Chelsea','Cherokee','Cheyenne','Chickasha','Choctaw','Chouteau','Claremore','Clayton','Cleveland','Coalgate','Colbert','Colcord','Cole','Collinsville','Comanche','Commerce','Copan','Corn','Covington','Coweta','Crescent','Cushing','Cyril','Davenport','Davis','Del','Dewar','Dewey','Dibble','Dickson','Dill','Duncan','Durant','Earlsboro','Edmond','Elgin','Elk City','Elmore','El Reno','Empire','Enid','Erick','Eufaula','Fairfax','Fairland','Fairview','Fletcher','Forest Park','Forgan','Fort Cobb','Fort Gibson','Fort Towson','Frederick','Garber','Geronimo','Glencoe','Glenpool','Goldsby','Goodwell','Gore','Grandfield','Granite','Grove','Guthrie','Guymon','Haileyville','Hammon','Harrah','Hartshorne','Haskell','Healdton','Heavener','Helena','Hennessey','Henryetta','Hinton','Hobart','Holdenville','Hollis','Hominy','Hooker','Howe','Hugo','Hulbert','Hydro','Idabel','Inola','Jay','Jenks','Jones','Kansas','Kellyville','Keota','Kiefer','Kingfisher','Kingston','Kiowa','Konawa','Krebs','Lahoma','Langley','Langston','Laverne','Lawton','Lexington','Lindsay','Locust Grove','Lone Grove','Luther','McAlester','McCurtain','McLoud','Madill','Mangum','Mannsville','Marietta','Marlow','Medford','Meeker','Miami','Midwest','Minco','Moore','Mooreland','Morris','Morrison','Mounds','Mountain View','Muldrow','Muskogee','Mustang','Newcastle','New Cordell','Newkirk','Nichols Hills','Nicoma Park','Ninnekah','Noble','Norman','North Enid','Nowata','Oakland','Oilton','Okarche','Okay','Okeene','Okemah','Okmulgee','Oklahoma City','Olustee','Oologah','Owasso','Panama','Paoli','Pauls Valley','Pawhuska','Pawnee','Perkins','Perry','Pink','Pocola','Ponca City','Pond Creek','Porter','Porum','Poteau','Prague','Pryor Creek','Purcell','Quapaw','Quinton','Ramona','Ravia','Red Oak','Ringling','Rock Island','Roff','Roland','Rush Springs','Ryan','Salina','Sallisaw','Sand Springs','Savanna','Sayre','Schulter','Seiling','Seminole','Sentinel','Shady Point','Shattuck','Shawnee','Skiatook','Slaughterville','Snyder','South Coffeyville','Spencer','Sperry','Spiro','Springer','Sterling','Stigler','Stillwater','Stilwell','Stratford','Stroud','Sulphur','Tahlequah','Talihina','Tecumseh','Temple','Texhoma','The Village','Thomas','Tipton','Tishomingo','Tonkawa','Tulsa','Tuttle','Tyrone','Union','Valley Brook','Valliant','Velma','Verden','Verdigris','Vian','Vici','Vinita','Wagoner','Walters','Warner','Warr Acres','Washington','Watonga','Waukomis','Waurika','Wayne','Waynoka','Weatherford','Webbers Falls','Welch','Weleetka','Wellston','West Siloam Springs','Westville','Wetumka','Wewoka','Wilburton','Wilson','Winchester','Wister','Woodward','Wright','Wynnewood','Yale','Yukon'];
	var has_pic = 0;
	
	<?php
	global $countArray, $picPerArray, $varArray, $roomVar;
		function AssembleArrays($takeArray,$startVar,$arrayPos,$quotesYN) {
		foreach ($takeArray as $roomz) {
		if ($quotesYN === 0) { $startVar.= $roomz[$arrayPos].","; }
		else { $startVar.= "'".$roomz[$arrayPos]."',"; }
		}
		$startVar = substr($startVar, 0, -1);
		$startVar.= "];";
		return $startVar;
		}
		if (!empty($countArray)) { 
		$GalleryRoomsID = AssembleArrays($countArray,"var gRooms = [",0,0);
		$GalleryPicCount = AssembleArrays($countArray,"var gPicsC = [",1,0);
		$GalleryPicCount2 = AssembleArrays($countArray,"var gPicsC2 = [",1,0);
		echo $GalleryRoomsID."
		".$GalleryPicCount."
		".$GalleryPicCount2."
		";
		} else { echo "
		var gRooms = [];
		var gPicsC = [];
		var gPicsC2 = [];
		"; }
		if (!empty($picPerArray)) {
		$GalleryPicArray1 = AssembleArrays($picPerArray,"var GPicArray1 = [",1,1);
		$GalleryPicArray2 = AssembleArrays($picPerArray,"var GPicArray2 = [",1,1);
		echo $GalleryPicArray1."
		".$GalleryPicArray2;
		foreach($picPerArray as $changePer) { }
		} else { echo "
		var GPicArray1 = [];
		var GPicArray2 = [];
		"; }
		if (!empty($varArray)) {
		$cString = "";
		foreach ($varArray as $varNew) { $cString.= $varNew.","; }
		$cString = substr($cString, 0, -1);
		echo "
		var editChange = [".$cString."];
		var picChange = [".$cString."];
		var textChange = [".$cString."];
		var hasPicAdded = [".$cString."];
		var addEditRooms = [".$cString."];
		var addOrEdit = [".$cString."];
		var rOrderEdit = [".$cString."];
		var delCount = [".$cString."];";
		} else { echo "
		var editChange = [];
		var picChange = [];
		var textChange = [];
		var hasPicAdded = [];
		var addEditRooms = [];
		var addOrEdit = [];
		rOrderEdit = [];
		var delCount = [];"; }
		if (!empty($roomVar)) {
		$roomString = "var roomOrder = [";
		$roomString2 = "var roomOrder2 = [";
		$deleteRoom = "var deleteRoom = [";
		$zeroAll = "";
		foreach ($roomVar as $roomOrder) { 
		$roomString.= "'".$roomOrder."',";
		$roomString2.= "'".$roomOrder."',";
		$splitUp = explode(",",$roomOrder);
		$howLong = count($splitUp);
		$zeroPlus = "";
		for ($x = 0; $x < $howLong; $x++) { $zeroPlus.= "1,"; }
		$zeroPlus = substr($zeroPlus, 0, -1);
		$zeroAll.= "'".$zeroPlus."',";
			}
		$zeroAll = substr($zeroAll, 0, -1);
		$roomString = substr($roomString, 0, -1);
		$roomString2 = substr($roomString2, 0, -1);
		$roomString.= "];";
		$roomString2.= "];";
		$deleteRoom.= $zeroAll."];";
		echo "
		".$roomString."
		".$roomString2."
		".$deleteRoom;
		} else { echo "
		var roomOrder = [];
		var roomOrder2 = [];
		var deleteRoom = [];"; }
	?>
	
	var eachRoom = new Array();
	eachRoom.push(0);
	var roomCount = 0;
	var newRooms = new Array();
	newRooms.push(0);
	var roomCount2 = 0;
	var hasGallery = 0;
	var rArray = new Array();
		
	</script>
	<div id="column1">
		<div id="nav1" class="navTab navClicked"><span class='spanTab'>Add Listing</span><img class='navImg' src='resources/Icon1A.png'/></div>
		<div id="nav2" class="navTab"><span class='spanTab'>View Listings</span><img class='navImg' src='resources/Icon2A.png'/></div>
		<div id="nav3" class="navTab"><span class='spanTab'>Edit Profile</span><img class='navImg' src='resources/Icon3A.png'/></div>
		<div id="nav4" class="navTab"><span class='spanTab'>Log Out</span><img class='navImg' src='resources/Icon4A.png'/></div>
	</div>
	<div id="column2">
		<div id="tab1">
			<div id="pageScroll">
		<div id="c1Header"><span id="leftName">Welcome, <?php echo $currentName; ?></span><div style="float:right; width:40%;"><a href="/rent/" class="dashLink">Rent</a><a href="/buy-home/" class="dashLink">Buy</a><a href="/" class="dashLink">Home</a></div></div>
		<div id="fBox1">
			<div id="fBox1A">
				<div id="SellingProperty" style="margin-top:2vh;"><input id="selling" name="sellorrent" type="radio"/><label for="selling" style="float:left; font-size:2vw; font-family:Questrial;">I am selling</label></div>
				<div id="RentingProperty"><input id="renting" name="sellorrent" type="radio" /><label for="renting" style="float:left; font-size:2vw; font-family:Questrial;">I am leasing</label></div>
				<div id="SelectWarning" style="font-size:1.2vw; font-family: Questrial, sans-serif;">Error: None selected</div>
			</div>
			<div id="fBox1B">
			<div class="formHolder"><label for="p-mainPic" class="formTitle">Primary Picture</label><input name="p-mainPic" id="p-mainPic" type="file" /></div>
			<span style="float:left; font-size:1.1vw; font-family:Questrial; clear:both;">Cannot exceed 3MB</span>
			<div id="listingAdded" style="position:absolute; bottom:2vh; font-size:1.5vw; font-family:Questrial; color:green; display:none;">Your listing has been added!</div>
			<div id="mPicexceeds" style="position:absolute; bottom:2vh; font-size:1.5vw; font-family:Questrial; color:red; display:none;">Picture exceeds maximum size.</div>
			</div>
		</div>
		<div id="fBox2">
		<div id="fHolderAdd1">
			<div class="formHolder"><label for="add-address" class="formTitle">Street: </label><input class="textInput selectData required" type="text" name="add-address" id="add-address" placeholder="Enter the street address..." style="width:17vw;"/></div>
			<div class="formHolder"><label for="auto" class="formTitle">Nearest City: </label><input type="text" id="auto" class="textInput selectData required" style="width:13vw;"/></div>
			<div class="formHolder"><label for="p-bedrooms" class="formTitle">Bedrooms: </label><select class="selectInput selectData required" id="p-bedrooms"><option value="1">1 Bedroom</option><option value="2">2 Bedrooms</option><option value="3">3 Bedrooms</option><option value="4">4 Bedrooms</option><option value="5">5 Bedrooms</option></select></div>
			<div class="formHolder"><label for="p-bathrooms" class="formTitle">Bathrooms: </label><select class="selectInput selectData required" id="p-bathrooms"><option value="1">1 Bathroom</option><option value="2">2 Bathrooms</option><option value="3">3 Bathrooms</option><option value="4">4 Bathrooms</option><option value="5">5 Bathrooms</option></select></div>
			<div class="formHolder"><label for="sale-cost" class="formTitle">Property Cost: </label><input class="textInput selectData required" type="text" name="sale-cost" id="sale-cost" placeholder="100000" style="width:6vw;"/><span style="float:right;font-size:1.5vw;">$</span></div>
			<div class="formHolder"><label for="p-built" class="formTitle">Year Built: </label><input class="textInput selectData" type="text" name="p-built" id="p-built" placeholder="1999" style="width:6vw;"/></div>
			<div class="formHolder"><label for="p-type" class="formTitle">Property Type: </label><input class="textInput selectData" type="text" name="p-type" id="p-type" placeholder="Single family home"/></div>
			<div class="formHolder"><label for="p-available" class="formTitle">Available On: </label><input class="textInput selectData required" type="text" name="p-available" id="p-available" placeholder="Date property is available..."/></div>
			<div class="formHolder"><span id="reqWarning" style="float:left; font-family:Questrial; font-size:1.2vw; margin-top:1vh; color:red; display:none;">Please fill out all the required information</span></div>
			</div>
		<div id="fHolderAdd2">
			<div class="formHolder"><label for="p-feet" class="formTitle">Property Size: </label><div class='infoFix'><input class="textInputR selectData" type="text" name="p-feet" id="p-feet" placeholder="700" style="width:4vw;"><span style="float:left;font-size:1.5vw;margin-left:0.5vw;">sqft</span></div></div>
			<div class="formHolder"><label for="p-cool" class="formTitle">Cooling: </label><div class='infoFix'><select class="selectInputR selectData" id="p-cool"><option value="0">N/A</option><option value="1">Central</option><option value="2">Window Unit</option><option value="3">Full A/C</option><option value="4">Ceiling Fan</option><option value="5">None</option></select></div></div>
			<div class="formHolder"><label for="p-heat" class="formTitle">Heating: </label><div class='infoFix'><select class="selectInputR selectData" id="p-heat"><option value="0">N/A</option><option value="1">Central</option><option value="2">Home Furnace</option><option value="3">Gas Heated</option><option value="4">Wood Stove</option><option value="5">None</option></select></div></div>
			<div class="formHolder"><label for="p-fire" class="formTitle">Fireplace: </label><div class='infoFix'><select class="selectInputR selectData" id="p-fire"><option value="0">N/A</option><option value="1">Firewood</option><option value="2">Gas-Fed</option><option value="3">Electrical</option><option value="4">None</option></select></div></div>
			<div class="formHolder"><label for="p-parking" class="formTitle">Parking: </label><div class='infoFix'><select class="selectInputR selectData" id="p-parking"><option value="0">N/A</option><option value="1">Garage</option><option value="2">Carport</option><option value="3">Driveway</option><option value="4">Street</option><option value="5">None</option></select></div></div>
			<div class="formHolder"><label for="p-lot" class="formTitle">Lot Size: </label><div class='infoFix'><input class="textInputR selectData" type="text" name="p-lot" id="p-lot" placeholder="700" style="width:4vw;"/><span style="float:left;font-size:1.5vw;margin-left:0.5vw;">sqft</span></div></div>
			<div class="formHolder"><textarea id="p-desc" class="selectData" rows="8" cols="50" style="width:24vw; height:15vh;" placeholder="Enter a description of the property here."></textarea></div>
			</div>
		</div>
		<div id="fBox3">
			<div id="checkHolder"><label for="vtour" id="checkLabel">Add Virtual Tour: </label><input type="checkbox" name="vtour" id="vtour" /></div>
			<div id="checkContent" class="formHolder" style="display:none; margin-top:1vh;"><label id="howMany" for="vColumn" class="formTitle" style="margin-left:1vw;">How Many Rooms? </label><input type="text" name="vColumn" id="vColumn" style="float:left; width:4vw; height:3vh;"/><button id="addRooms" style="float:left; margin-left:1vw; width:8vw; height:3.8vh;">Add Rooms</button><span style="float:left;  margin-left:0.5vw; margin-top: 1vh; font-size:1.2vw; font-family: Questrial, sans-serif;">Maximum of 10 Entries - 3MB Size Limit</span><span id="numberWarning" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: No number entered.</span><span id="boxExceed" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum amount allowed.</span><span id="vTourExceed" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum picture size.</span>
			<div id="roomHolder" style="position:relative; float:left; width:100%; height:auto; clear:both;"></div></div>
			</div>
		</div>
		<div id="addPropHolder"><button id="addProp">Add Listing</button></div>
		</div>
			
		<div id="tab2">
			<div id="tabScroll">
		<?php global $fullList; echo $fullList; ?>
			</div>
		</div>
		
		<div id="tab3">
			<?php
			$userQuery = "SELECT company, email, primary_phone, secondary_phone, fax, website, user_type FROM userDetails WHERE id = ".$_SESSION['userID'];
			$getUserDetails = $mysqli->query($userQuery);
			$userDetails = $getUserDetails->fetch_array();
			$company = $userDetails['company'];
			$email = $userDetails['email'];
			$primaryPhone = $userDetails['primary_phone'];
			$secondaryPhone = $userDetails['secondary_phone'];
			$fax = $userDetails['fax'];
			$website = $userDetails['website'];
			$userType = intval($userDetails['user_type']);
			$option0 = '<option value="0" ';
			$option1 = '<option value="1" ';
			$option2 = '<option value="2" ';
			$option3 = '<option value="3" ';
			$option4 = '<option value="4" ';
			$optionArray = array($option0,$option1,$option2,$option3,$option4);
			$wordArray = array("N/A","Private Seller","Landlord","Realtor","Property Manager");
			$selectOption = $optionArray[$userType];
			$selectOption.= 'selected="selected"';
			$optionArray[$userType] = $selectOption;
			$optionString = '';
			$optionCount = 0;
			foreach ($optionArray as $option) {
			$optionString.= $option.">".$wordArray[$optionCount]."</option>";
			$optionCount++;
			}
			?>
			<div id="updateForm">
				<div class="formElement"><span class="formT">Email: </span> <input type='text' name='email' id='email' class="formInput formData2" value="<?php echo $email; ?>"/></div>
				<div class="formElement"><span class="formT">Company: </span> <input type='text' name='company' id='company' class="formInput formData2" value="<?php echo $company; ?>"/></div>
				<div class="formElement"><span class="formT">Primary Phone: </span> <input type='text' name='primePhone' id='primePhone' class="formInput formData2" value="<?php echo $primaryPhone; ?>"/></div>
				<div class="formElement"><span class="formT">Secondary Phone: </span> <input type='text' name='secondPhone' id='secondPhone' class="formInput formData2" value="<?php echo $secondaryPhone; ?>"/></div>
				<div class="formElement"><span class="formT">Fax Number: </span> <input type='text' name='fax' id='fax' class="formInput formData2" value="<?php echo $fax; ?>"/></div>
				<div class="formElement"><span class="formT">Website: </span> <input type='text' name='website' id='website' class="formInput formData2" value="<?php echo $website; ?>"/></div>
				<div class="formElement"><span class="formT">You Are A: </span><select class="formData2" style="float:right; height:2.8vh; width:15vw;"><?php echo $optionString; ?></select></div>
			</div>
		<button id="updateProfile" name="updateProfile" style="float:left; width:10vw; height:6vh; margin-top:1vh; margin-left:2vw; clear:both;">Update Profile</button>
		<div id="ErrorBox" style="float:left; width:100%; clear:both;"></div>
		</div>
	</div>
	<script src="resources/dash.js"></script>
	<script>
	$(document).ready(function() {
	var tabCount = 1;
	var startTracker = [0,0,0];
	
	function startPage(funcNumber) {
	if (funcNumber == 1) { page1(); }
	else if (funcNumber == 2) { page2(); }
	else if (funcNumber == 3) { page3(); }
	startTracker[funcNumber] = 1;
	}
	startPage(1);
	$("#nav1").css({"opacity":"1"});
	
		$('.navTab').on({
		mouseenter: function() { if ( $(this).hasClass("navClicked") == false ) { $(this).stop().animate({"opacity":"1"},400);} },
		mouseleave: function() { if ( $(this).hasClass("navClicked") == false ) { $(this).stop().animate({"opacity":"0.7"},400);} },
		click: function() {
		if ( $(this).hasClass("navClicked") == false ) {
		var getTab = $(this).attr("id");
		var haveTab = getTab.replace('nav','');
		if (haveTab == 4) { window.location.href = 'operations/logout.php'; }
		else {
		$(".navClicked").stop().animate({"opacity":"0.7"},400).removeClass("navClicked").addClass("navTab");
		$(this).stop().animate({"opacity":"1"},400).addClass("navClicked");
		var tabID = "#tab"+haveTab;
		var oldID = "#tab"+tabCount;
		tabCount = haveTab;
		$(oldID).stop().fadeOut(400);
		var getTracker = startTracker[tabCount];
		if (getTracker == 0) { startPage(tabCount); }
		setTimeout(function() {	$(tabID).stop().fadeIn(400); },400);
					}
				}
			}
		});
	});
	</script>
</div>
        <?php endif; ?>
    </body>
</html>