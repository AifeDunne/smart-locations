<?php
		$hasListing = 0;
		$amountParse = array(0,0);
		$userSession = " WHERE user_id = ".$_SESSION['userID'];
		$findListings = "SELECT street_address, property_city, bedrooms, bathrooms, property_cost, property_size FROM property_listing".$userSession;
		$qListings = $findListings;
		$listingAmount = $mysqli->query($findListings);
		$listAmount = $listingAmount->num_rows;
		if ( $listAmount !== 0) { $hasListing++; $amountParse[0] = $listAmount; }
		$findRentals = "SELECT street_address, rental_city, bedrooms, bathrooms, rental_cost, rental_size FROM rental_listing".$userSession;
		$qRental = $findRentals; 
		$rentalAmount = $mysqli->query($findRentals);
		$rentAmount = $rentalAmount->num_rows;
		if ( $rentAmount !== 0) { $hasListing++; $amountParse[1] = $rentAmount; }
		if ($hasListing === 0) { $fullList = '<div id="noListings" style="float:left; font-family:Questrial; font-size:1.5vw; margin-top:5vh; margin-left:2vw;">You do not currently have any listings.</div>'; } 
		else {
		function getGallery($galleryType) {
		global $mysqli;
		if ($galleryType === "BuyProperty") { $dType = "property_details"; $findID = "property_id"; }
		else { $dType = "rental_details"; $findID = "rental_id"; }
		$hasArray = array();
		$getHasGallery = "SELECT ".$findID." FROM property_details WHERE hasGallery = 'Yes'";
		$getConfirmation = $mysqli->prepare($getHasGallery);
		$getConfirmation->execute();
		$getConfirmation->bind_result($confirmID);
		while ($getConfirmation->fetch()) { $hasArray[] = $confirmID; }
		$getConfirmation->close();
		$whereStatement = '';
		foreach ($hasArray as $confirmed) { $whereStatement.= "listing_id = ".$confirmed." OR "; }
		$whereStatement = substr($whereStatement, 0, -4);
		$fullArray = array();
		$queryGallery = "SELECT listing_id, prefix, number, room_array, name_array, regular_array, picArray FROM virtual_tour WHERE ".$whereStatement;
		$getGallery = $mysqli->prepare($queryGallery);
		$getGallery->execute();
		$getGallery->bind_result($boxID, $prefix, $number, $roomArray, $nameArray, $regularArray, $picPer);
		while ($getGallery->fetch()) {
		$partialArray = array('prefix' => $prefix, 'picNumber' => $number, 'rooms' => $roomArray, 'regNames' => $regularArray, 'picNames' => $nameArray, 'picsPer' => $picPer);
		$fullArray[$boxID] = $partialArray;	}
		$getGallery->close();
		return $fullArray; }
		
		$countArray = array();
		$picPerArray = array();
		$varArray = array();
		$roomVar = array();
		function getData($thisQuery, $typeID, $dbID, $galleryArray) {
			global $mysqli,$userSession,$countArray,$picPerArray,$varArray,$roomVar;
			$grabID = explode("SELECT",$thisQuery);
			if ($typeID === 'property_id,') { $filePath = array("buy-home","home"); $listType = "buy"; $typeID = "property_listing.".$typeID; $newVar = ", property_type, year_built, cooling, heating, fireplace, parking, lot_size, property_description, hasGallery "; $typeArray = "
			LEFT JOIN property_details ON property_details.property_id = property_listing.property_id
			".$userSession." ORDER BY property_listing.property_id DESC"; }
			if ($typeID === 'rental_id,') { $filePath = array("rent","rent"); $listType = "rent"; $typeID = "rental_listing.".$typeID; $newVar = ", rental_type, year_built, cooling, heating, fireplace, parking, lot_size, rental_description "; $typeArray = "
			LEFT JOIN rental_details ON rental_details.rental_id = rental_listing.rental_id
			".$userSession." ORDER BY rental_listing.rental_id DESC"; }
			$thisQuery = "SELECT ".$typeID.$grabID[1];
			$splitID = explode("WHERE", $thisQuery);
			$splitID = explode("FROM", $splitID[0]);
			$thisQuery = substr($splitID[0], 0, -1).$newVar."FROM ".$dbID.$typeArray;
			$queryCounter = 0;
			$gList = $mysqli->prepare($thisQuery);
			if ($gList->execute()) {
			$returnContent = '';
			
			$coolArray = array("N/A","Central","Window Unit","Full A/C","Ceiling Fan","None");
			$heatArray = array("N/A","Central","Home Furnace","Gas Heater","Wood Stove","None");
			$fireArray = array("N/A","Firewood","Gas-Fed","Electrical","None");
			$parkArray = array("N/A","Garage","Carport","Driveway","Street","None");
			$bedroomsArr = array("N/A","1 Bedroom","2 Bedrooms","3 Bedrooms","4 Bedrooms","5 Bedrooms");
			$bathroomsArr = array("N/A","1 Bathroom","2 Bathrooms","3 Bathrooms","4 Bathrooms","5 Bathrooms");
			function getOption($arrayFind,$inputHere,$num) {
			$select0 = '<option value="0" ';
			$select1 = '<option value="1" ';
			$select2 = '<option value="2" ';
			$select3 = '<option value="3" ';
			$select4 = '<option value="4" ';
			$select5 = '<option value="5" ';
			$select6 = '<option value="6" ';
			$selectArray = array($select0,$select1,$select2,$select3,$select4,$select5,$select6);
			$findOption = $selectArray[$inputHere];
			$findOption.= 'selected="selected"';
			$selectArray[$inputHere] = $findOption;
			$selectString = '';
			for ($x = 0; $x <= $num; $x++) { $selectString.= $selectArray[$x].">".$arrayFind[$x]."</option>"; }
			return $selectString; }
			
			$gList->bind_result($id, $street, $city, $bedrooms, $bathrooms, $cost, $this_size, $this_type, $yearBuilt, $cool, $heat, $fire, $park, $lsize, $descript, $hasGallery);
			while ($gList->fetch()) {
			$rCool = getOption($coolArray,$cool,5);
			$rHeat = getOption($heatArray,$heat,5);
			$rFire = getOption($fireArray,$fire,3);
			$rPark = getOption($parkArray,$park,5);
			$tBed = getOption($bedroomsArr,$bedrooms,5);
			$tBath = getOption($bathroomsArr,$bathrooms,5);
			$returnContent.= "<div id='list".$id."' class='homelisting'><div class='homeDetail'>
			<span style='float:left; font-weight:bold; font-size:1.5vw;'>".$street.", ".$city.", OK </span><span style='float:left; font-size:1.3vw;'> - $".$cost."</span><span style='float:left; clear:both; font-size:1.2vw;'>".$bedrooms." Bedrooms - ".$bathrooms." Bathrooms</span></div>
			<div id='topHolder' style='float:left; width:30vw; height: 7vh;'><button id='openEntry".$id."' class='editListing'>Edit Listing</button>
			<div id='switch".$id."' class='enterSwitch'><span class='dEdit switchItem switchClicked'>Listing</span><span class='vEdit switchItem'>Virtual Tour</span></div><div class='closeDelete' id='extraOptions".$id."'><a class='goTo' href='/".$filePath[0]."/".$filePath[1]."-details/?homeID=".$id."'>View</a><span class='closeEntry'>Close</span><span class='deleteEntry'>Delete X</span></div><div id='editVConfirmed' style='position: absolute; top: 2vh; right: 0vw; width: 35vw; font-size: 1.5vw; font-family: Questrial; color: green; display:none;'>Your edit has been successfully submitted.</div><div id='editVError' style='position: absolute; top: 2vh; right: 0vw; width: 35vw; font-size: 1.5vw; font-family: Questrial; color: red; display:none;'>There has been an error. Try again.</div><div id='timeVError' style='position: absolute; top: 2vh; right: 0vw; width: 35vw; font-size: 1.5vw; font-family: Questrial; color: red; display:none;'>Please wait until the edit has been submitted.</div>";
			if ($hasGallery === "Yes") { $returnContent.= "<div id='vTopHolder".$id."' style='position: absolute; height: 4vh; top: 3vh; right: 2.6vw; display:none;'><button id='addR".$id."' class='addRooms' style='position:relative; height: 4vh; margin-top:4vh; float:right; width: 12vw;'>Add Rooms</button><span style='float:right; margin-top:4.7vh; margin-right:1vw; font-size:1.2vw; font-family: Questrial, sans-serif;'>Maximum of 10 Entries - 3MB Size Limit</span><span id='bExceed".$id."' style='position:absolute; right:0; top:0; font-size:1.2vw; font-family: Questrial, sans-serif; color:red; display:none;'>Error: Exceeds maximum amount allowed.</span><span id='pExceed".$id."' style='position:absolute; right:0; top:0; color:red; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;'>Error: Exceeds maximum picture size.</span></div>"; }
			$returnContent.= "</div><div id='entry".$id."' class='editField subtab'>
			<div id='cEdit1'>
				<div class='formElement'><span class='formT'>Street: </span> <input type='text' id='street-edit' class='box".$id." formInput2' value='".$street."'/></div>
				<div class='formElement'><span class='formT'>City: </span> <input type='text' id='city-edit' class='box".$id." formInput2' value='".$city."'/></div>
				<div class='formElement'><span class='formT'>Bedrooms: </span> <select class='box".$id." sForm2'>".$tBed."</select></div>
				<div class='formElement'><span class='formT'>Bathrooms: </span> <select class='box".$id." sForm2'>".$tBath."</select></div>
				<div class='formElement'><span class='formT'>Cost: </span> <input type='text' id='cost-edit' class='box".$id." formInput2' value='".$cost."'/></div>
				<div class='formElement'><span class='formT'>Size: </span> <input type='text' id='size-edit' class='box".$id." formInput2' value='".$this_size."'/></div>
				<div class='formElement'><span class='formT'>Type: </span> <input type='text' id='type-edit' class='box".$id." formInput2' value='".$this_type."'/></div>
				<div class='formElement'><span class='formT'>Year: </span> <input type='text' id='year-edit' class='box".$id." formInput2' value='".$yearBuilt."'/></div>
				<div class='formElement'><span class='formT'>Lot Size: </span> <input type='text' id='lot-edit' class='box".$id." formInput2' value='".$lsize."'/></div>
			</div>
			<div id='cEdit2'>
				<div class='formElement'><span class='formT'>Cooling: </span> <select class='box".$id." sForm2'>".$rCool."</select></div>
				<div class='formElement'><span class='formT'>Heating: </span> <select class='box".$id." sForm2'>".$rHeat."</select></div>
				<div class='formElement'><span class='formT'>Fireplace: </span> <select class='box".$id." sForm2'>".$rFire."</select></div>
				<div class='formElement'><span class='formT'>Parking: </span> <select class='box".$id." sForm2'>".$rPark."</select></div>
				<div class='formElement'><span class='formT'>Description: </span> <textarea id='descript-edit' class='box".$id."' rows='8' cols='50' style='width:26.75vw'>".$descript."</textarea></div>
				<div id='editConfirmed".$id."' style='float:left; margin-top:2vh; clear:both; display:none;'><span style='float:left; font-size:1.5vw; font-family:Questrial; color:green;'>Your edit has been successfully submitted.</span></div>
				</div>
			</div>";
			
			if ($hasGallery === "Yes") {
			$returnContent.= "<div id='tour".$id."' class='tourField subtab' style='width:98.5%; margin-left:0.7%;'>";
			if (array_key_exists($id, $galleryArray)) {
			$roomCount = intval($galleryArray[$id]['picNumber']);
			$roomVar[] = $galleryArray[$id]['rooms'];
			$roomNArray = $galleryArray[$id]['rooms'];
			$roomNArray = explode(",",$roomNArray);
			$countArray[] = array($id,$roomCount);
			$varArray[] = 0;
			$getNames = $galleryArray[$id]['regNames'];
			$regNames = explode(",",$getNames);
			$pPerD = $galleryArray[$id]['picsPer'];
			$getPer = $pPerD;
			$splitPer = explode(",",$pPerD);
			$picPerArray[] = array($id,$getPer);
			$picsPerRoom = explode(",",$getPer);
			$galleryString = "";
			for ($t = 0; $t < $roomCount; $t++) {
			$countT = $t + 1;
			$currentPer = intval($picsPerRoom[$t]);
			$pCName = $regNames[$t];
			$pCName = str_replace(" ", "", $pCName);
			$currentNR = $roomNArray[$t];
			$galleryString.= "<div style='position:relative; float:left; width:100%; height:34.3vh; border-bottom:1px solid #b3b3b3; background:#FFF; cursor:pointer;'><div class='textHolder' style='position:absolute; padding-left:1%; width:50%; padding-top:1vh; padding-bottom:1.5vh; clear:both; z-index:11;'><label for='roomNameE".$countT."' style='float:left; font-size:1.5vw; font-family:Questrial; margin-right:0.3vw; margin-top:0.2vh;'><span class='rNumber'>".$countT."</span>. Room Name: </label><input type='text' id='roomNameE".$countT."' class='editText editTour' style='float:left; width:13.5vw; height:3vh; margin-top:0.2vh;' value='".$regNames[$t]."'/></div><div id='pHold".$id."-".$countT."' class='picHolder pBox".$id."' style='position:absolute; top:0; left:0; width:100%; height:34.3vh; overflow-x:scroll; clear:both; z-index:10;'><span style='position:absolute; top:1.5vh; right:14vw; font-size:1.5vw; font-family:Questrial;cursor:default;'>Add/Remove Pictures:</span><select class='picEAmnt select".$id." contains".$currentPer."' style='position:absolute; top:1vh; right:10vw; height:4vh; width:3vw; margin-left:0.2vw;'>";
			$thisPer = intval($splitPer[$t]);
			for ($f = 1; $f < 6; $f++) { if ($f === $thisPer) { $opSelect = " selected = 'selected'"; } else { $opSelect = ""; }
			$galleryString.= "<option value='".$f."'".$opSelect.">".$f."</option>"; }
			$galleryString.= "</select><span class='deleteRoom remove".$id."-".$countT."' style='position:absolute; top:1.5vh; right:1vw; font-size:1.5vw; font-family:Questrial; color:red; cursor:pointer;'>Delete X</span>";
				$addedPics = "<div class='picReel' style='float:left; width:100%; height:22vh; margin-top:6.4vh; padding-top:0.1vh; clear:both;'>";
				$inputString = "";
				for($p = 0; $p < $currentPer; $p++) {
				$addedPics.= "<img class='pic".$p."' style='float:left; width:20.42vw; border-top:1px solid #b3b3b3; border-right:1px solid #b3b3b3; max-height:22vh; cursor:default;' src='/".$filePath[0]."/full-images/virtual-tour/Property".$id."-".$pCName."-Picture".$p.".jpg'/>";
				$inputString.= "<span style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:0.3vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh; cursor:default;'>Replace: </span><input class='editFile editTour row".$p."' id='roomE".$countT."[".$p."]' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/>"; }
			$galleryString.= $addedPics."</div>".$inputString."</div></div>"; }
			$returnContent.= $galleryString; }
			} else {
			$returnContent.= "<div id='tour".$id."' class='newField subtab'>";
			$returnContent.= '<div class="checkHolder2"><label for="etour'.$id.'" id="editLabel'.$id.'" style="float:left; margin-left:1vw; margin-top:2vh; font-size:1.5vw; font-family:Questrial;">Add Virtual Tour: </label><input type="checkbox" id="etour'.$id.'" class="eTourC" style="float:left; margin-left:0.5vw; margin-top:2.4vh; width:1.2vw; height:2.4vh;"/></div>
			<div class="checkContent2 formHolder" style="display:none; margin-top:1vh;"><label id="editMany'.$id.'" for="eColumn'.$id.'" class="formTitle" style="margin-left:1vw;">How Many Rooms? </label><input type="text" id="eColumn'.$id.'" style="float:left; width:4vw; height:3vh;"/><button id="editAddRooms'.$id.'" class="eRoomsPlus" style="float:left; margin-left:1vw; width:8vw; height:3.8vh;">Add Rooms</button><span style="float:left;  margin-left:0.5vw; margin-top: 1vh; font-size:1.2vw; font-family: Questrial, sans-serif;">Maximum of 10 Entries - 3MB Size Limit</span><span id="numberEWarning'.$id.'" style="float:right; color:red; margin-right:0.5vw; display:none;">Error: No number entered.</span><span id="bExceed'.$id.'" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum amount allowed.</span><span id="pExceed'.$id.'" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum picture size.</span>
			<div class="editHolder" style="position:relative; float:left; width:100%; height:68.2vh; clear:both; overflow-y:auto;"></div></div>'; }
			$returnContent.= "</div>
				<button id='editEntry".$id."' class='submitEdit ".$listType."'>Submit Edit</button>
				</div>";
			}
			$gList->close();
			} else { printf ($mysqli->error); }
			return $returnContent; }
			
		$fullList = '';
		if ($amountParse[0] !== 0) { $galleries = getGallery("BuyProperty"); $fullList.= getData($qListings,"property_id,","property_listing",$galleries); }
		if ($amountParse[1] !== 0) { $galleries = getGallery("RentProperty");  $fullList.= getData($qRental,"rental_id,","rental_listing",$galleries); }
	 }
		?>