<?php
include_once 'db_connect.php';

if (!empty($_POST['dataRequest'])) {
$dataRequest = $_POST['dataRequest'];
$userID = $_POST['userID']; 

	if ($_POST['hasGallery'] === 'Yes') { $gallery = 'Yes'; $galleryItems = $_POST['rPer']; }
	else { $gallery = 'No'; $galleryItems = ""; }
	$createPath = $_POST['thumbName'];
	if ($_POST['rArray'] !== 'NULL') { $rArray = $_POST['rArray']; } 
	else { $rArray = "None"; }
	date_default_timezone_set('America/Chicago');
	$time = getdate();
	$month = $time['mon'];
	$day = $time['mday'];
	$year = $time['year'];
	$currentDate = $year."-".$month."-".$day;
	$street = str_replace("'", "", $_POST['addStreet']);
	$street = str_replace('"', '', $street);
	$cost = str_replace(",", "", $_POST['addCost']);
	$cost = str_replace('$', '', $cost);
	$cost = str_replace('.', '', $cost);
	$size = str_replace(",", "", $_POST['addSize']);
	$lSize = str_replace(",", "", $_POST['addLot']);
	if (!empty($_POST['addType'])) { $type = htmlspecialchars($_POST['addType'], ENT_QUOTES); } else { $type = ""; }
	if (!empty($_POST['addDesc'])) { $desc = htmlspecialchars($_POST['addDesc'], ENT_QUOTES); } else { $desc = ""; }
	$yearBuilt = preg_replace("/[^0-9,.]/", "", $_POST['addBuilt']);
	$listingEntry = Array($userID,$street,$_POST['addCity'],$_POST['addBedrooms'],$_POST['addBathrooms'],$cost,$size,$currentDate,$_POST['addAvail'],"NULL","NULL","NULL",$createPath);
	$detailEntry = Array($type,$yearBuilt,$_POST['addCooling'],$_POST['addHeating'],$_POST['addFireplace'],$_POST['addParking'],$lSize,$desc,$gallery);
	
	function AddListing($dbName, $p1, $p2) {
	global $mysqli,$userID;
		$listCountQ = "SELECT var_value FROM sysVar WHERE var_name = '".$dbName."_count'";
		$selectCount = $mysqli->query($listCountQ);
		$propertyCount = $selectCount->fetch_array();
		$propertyCount = intval($propertyCount['var_value']);
		$propertyCount++;
		if ($dbName === "property") { $imgName = "Property"; $dbVar = "buy"; $filePath = array("buy-home","home"); }
		else { $dbVar = "rent"; $imgName = "Rental";  $filePath = array("rent","rent"); }
		if ($p1[12] !== 'NULL') { $getExtension = $p1[12]; $breakOpen = explode(".",$getExtension); $newPath = $imgName."-".$propertyCount.".".$breakOpen[1]; }
		else { $newPath = "None.jpg"; }
		$p1[12] = $newPath;
		$buyQuery = "SELECT ".$dbVar."_listings FROM userDetails WHERE id = ".$userID;
		$selectBuy = $mysqli->query($buyQuery);
		$getBuy = $selectBuy->fetch_array();
		$gType = $dbVar.'_listings';
		$buyCount = intval($getBuy[$gType]);
		$buyCount++;
		$queryString1 = "INSERT INTO ".$dbName."_listing VALUES (".$propertyCount.",";
		$queryString2 = "INSERT INTO ".$dbName."_details VALUES (".$propertyCount.",";
		function addAddress($qString,$vArray) {
			foreach ($vArray as $vItem) { $qString.= "'".$vItem."', ";	}
				$qString = substr($qString, 0, -2);
				$qString.= ")";
				return $qString; }
		$fString1 = addAddress($queryString1,$p1);
		$fString2 = addAddress($queryString2,$p2);
		if ($insertListing = $mysqli->query($fString1)) {
			$updateCount = "UPDATE sysVar SET var_value = ".$propertyCount." WHERE var_name = '".$dbName."_count'";
			$executeCount = $mysqli->query($updateCount);
			$updateBuy = "UPDATE userDetails SET ".$dbVar."_listings = ".$buyCount." WHERE id = ".$userID;
			$executeBuy = $mysqli->query($updateBuy);
			if ($insertDetail = $mysqli->query($fString2)) {
				sleep(2);
				$completeAddress = $p1[1].",".$p1[2].",OK";
				$address = str_replace(" ", "+", $completeAddress);
				$json = file_get_contents("http://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=US");
				$json = json_decode($json);
				$lat = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
				$long = $json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
				$stateArea = '';
				if ($long > -97.756348 && $long < -97.300415 && $lat > 35.162021 && $lat < 35.609860) { $stateArea = "Oklahoma City"; }
					else { if ($long > -97.526321) { if ($lat < 35.413117) { $stateArea = "South East"; }	else { $stateArea = "North East"; }
					} else { if ($lat < 35.162021) { $stateArea = "South West"; }	else { $stateArea = "North West"; }
					}
				}
				$addGeoCode = "UPDATE ".$dbName."_listing SET ".$dbName."_lat = '".$lat."', ".$dbName."_long = '".$long."', ".$dbName."_area = '".$stateArea."' WHERE ".$dbName."_id = ".$propertyCount;
				if ($addGeo = $mysqli->query($addGeoCode)) {
			
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
			
			$rCool = getOption($coolArray,$p2[2],5);
			$rHeat = getOption($heatArray,$p2[3],5);
			$rFire = getOption($fireArray,$p2[4],3);
			$rPark = getOption($parkArray,$p2[5],5);
			$tBed = getOption($bedroomsArr,$p1[3],5);
			$tBath = getOption($bathroomsArr,$p1[4],5);

			$AddEdit = "<div class='homelisting'><div class='homeDetail'>
			<span style='float:left; font-weight:bold; font-size:1.5vw;'>".$p1[1].", ".$p1[2].", OK </span><span style='float:left; font-size:1.3vw;'> - $".$p1[5]."</span><span style='float:left; clear:both; font-size:1.2vw;'>".$p1[3]." Bedrooms - ".$p1[4]." Bathrooms</span></div>
			<div id='topHolder' style='float:left; width:30vw; height: 7vh;'><button id='openEntry".$buyCount."' class='editListing'>Edit Listing</button>
			<div id='switch".$buyCount."' class='enterSwitch'><span class='dEdit switchItem switchClicked'>Listing</span><span class='vEdit switchItem'>Virtual Tour</span></div><div class='closeDelete' id='extraOptions".$buyCount."'><a class='goTo' href='/".$filePath[0]."/".$filePath[1]."-details/?homeID=".$buyCount."'>View</a><span class='closeEntry'>Close</span><span class='deleteEntry'>Delete X</span></div><div id='editVConfirmed' style='position: absolute; top: 5vh; right: 20vw; width: 18vw; font-size: 1.5vw; font-family: Questrial; color: green; display:none;'>Your edit has been successfully submitted.</div><div id='editVError' style='position: absolute; top: 5vh; right: 20vw; width: 18vw; font-size: 1.5vw; font-family: Questrial; color: red; display:none;'>There has been an error. Try again.</div><div id='timeVError' style='position: absolute; top: 5vh; right: 20vw; width: 18vw; font-size: 1.5vw; font-family: Questrial; color: red; display:none;'>Please wait until the edit has been submitted.</div>";
			if ($p2[8] === 'Yes') { $AddEdit.= "<div id='vTopHolder".$buyCount."' style='position: absolute; height: 4vh; top: 3vh; right: 2.6vw; display:none;'><button id='addR".$buyCount."' class='addRooms' style='position:relative; height: 4vh; margin-top:4vh; float:right; width: 12vw;'>Add Rooms</button><span style='float:right; margin-top:4.7vh; margin-right:1vw; font-size:1.2vw; font-family: Questrial, sans-serif;'>Maximum of 10 Entries - 3MB Size Limit</span><span id='bExceed".$buyCount."' style='position:absolute; right:0; top:0; font-size:1.2vw; font-family: Questrial, sans-serif; color:red; display:none;'>Error: Exceeds maximum amount allowed.</span><span id='pExceed".$buyCount."' style='position:absolute; right:0; top:0; color:red; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;'>Error: Exceeds maximum picture size.</span></div>"; }
			$AddEdit.= "</div><div id='entry".$buyCount."' class='editField subtab'>
			<div id='cEdit1'>
				<div class='formElement'><span class='formT'>Street: </span> <input type='text' id='street-edit' class='box".$buyCount." formInput2' value='".$p1[1]."'/></div>
				<div class='formElement'><span class='formT'>City: </span> <input type='text' id='city-edit' class='box".$buyCount." formInput2' value='".$p1[2]."'/></div>
				<div class='formElement'><span class='formT'>Bedrooms: </span> <select class='box".$buyCount." sForm2'>".$tBed."</select></div>
				<div class='formElement'><span class='formT'>Bathrooms: </span> <select class='box".$buyCount." sForm2'>".$tBath."</select></div>
				<div class='formElement'><span class='formT'>Cost: </span> <input type='text' id='cost-edit' class='box".$buyCount." formInput2' value='".$p1[5]."'/></div>
				<div class='formElement'><span class='formT'>Size: </span> <input type='text' id='size-edit' class='box".$buyCount." formInput2' value='".$p1[6]."'/></div>
				<div class='formElement'><span class='formT'>Type: </span> <input type='text' id='type-edit' class='box".$buyCount." formInput2' value='".$p2[0]."'/></div>
				<div class='formElement'><span class='formT'>Year: </span> <input type='text' id='year-edit' class='box".$buyCount." formInput2' value='".$p2[1]."'/></div>
				<div class='formElement'><span class='formT'>Lot Size: </span> <input type='text' id='lot-edit' class='box".$buyCount." formInput2' value='".$p2[6]."'/></div>
			</div>
			<div id='cEdit2'>
				<div class='formElement'><span class='formT'>Cooling: </span> <select class='box".$buyCount." sForm2'>".$rCool."</select></div>
				<div class='formElement'><span class='formT'>Heating: </span> <select class='box".$buyCount." sForm2'>".$rHeat."</select></div>
				<div class='formElement'><span class='formT'>Fireplace: </span> <select class='box".$buyCount." sForm2'>".$rFire."</select></div>
				<div class='formElement'><span class='formT'>Parking: </span> <select class='box".$buyCount." sForm2'>".$rPark."</select></div>
				<div class='formElement'><span class='formT'>Description: </span> <textarea id='descript-edit' class='box".$buyCount."' rows='8' cols='50' style='width:26.75vw'>".$p2[7]."</textarea></div>
				<div id='editConfirmed' style='float:left; margin-top:2vh; background:#FFF; clear:both; display:none;'><span style='float:left; font-size:1.5vw; font-family:Questrial; color:green;'>Your edit has been successfully submitted.</span></div>
				</div>
			</div>";
			$AddEdit.= "<div id='tour".$buyCount."' class='tourField subtab'>";
			if ($p2[8] === 'Yes') {
			$AddEdit.= "<div id='tour".$buyCount."' class='tourField subtab'>";
			global $rArray, $galleryItems;
			$roomCount = 0;
			$galleryString = "";
			$gallItems = explode(",",$galleryItems);
			$orderString = "'";
			$zeroString = "'";
			foreach ($rArray as $unpacked) {
			$countT = $roomCount + 1;
			$orderString.= $roomCount.",";
			$zeroString.= "1,";
			$gallCount = $gallItems[$countT];	
			$galleryString.= "<div style='position:relative; float:left; width:100%; height:34.3vh; border-bottom:1px solid #b3b3b3; background:#FFF; cursor:pointer;'><div class='textHolder' style='position:absolute; padding-left:1%; width:50%; padding-top:1vh; padding-bottom:1.5vh; clear:both; z-index:11;'><label for='roomNameE".$countT."' style='float:left; font-size:1.5vw; font-family:Questrial; margin-right:0.3vw; margin-top:0.2vh;'><span class='rNumber'>".$countT."</span>. Room Name: </label><input type='text' id='roomNameE".$countT."' class='editText editTour' style='float:left; width:13.5vw; height:3vh; margin-top:0.2vh;' value='".$unpacked."'/></div><div id='pHold".$buyCount."-".$countT."' class='picHolder pBox".$buyCount."' style='position:absolute; top:0; left:0; width:100%; height:34.3vh; overflow-x:scroll; clear:both; z-index:10;'><span style='position:absolute; top:1.5vh; right:14vw; font-size:1.5vw; font-family:Questrial;cursor:default;'>Add/Remove Pictures:</span><select class='picEAmnt select".$buyCount." contains".$gallCount."' style='position:absolute; top:1vh; right:10vw; height:4vh; width:3vw; margin-left:0.2vw;'>";
			$thisPer = intval($gallCount);
			for ($f = 1; $f < 6; $f++) { if ($f === $thisPer) { $opSelect = " selected = 'selected'"; } else { $opSelect = ""; }
			$galleryString.= "<option value='".$f."'".$opSelect.">".$f."</option>"; }
			$galleryString.= "</select><span class='deleteRoom remove".$buyCount."-".$countT."' style='position:absolute; top:1.5vh; right:1vw; font-size:1.5vw; font-family:Questrial; color:red; cursor:default;'>Delete X</span>";
				$addedPics = "<div class='picReel' style='float:left; width:100%; height:22vh; margin-top:6.4vh; padding-top:0.1vh; clear:both;'>";
				$inputString = "";
			for($v = 0; $v < $thisPer; $v++) { 
			$addedPics.= "<img class='pic".$v."' style='float:left; width:20.42vw; border-top:1px solid #b3b3b3; border-right:1px solid #b3b3b3; max-height:22vh;cursor:default;' src='/".$filePath[0]."/full-images/virtual-tour/Property".$buyCount."-".$unpacked."-Picture".$v.".jpg'/>";
			$inputString.= "<span style='float:left; font-size:1.3vw; font-family:Questrial; padding-left:0.3vw; padding-bottom:0.5vh; padding-right:0.5vw; padding-top:0.5vh;cursor:default;'>Replace: </span><input class='editFile editTour row".$v."' id='roomE".$countT."[".$v."]' type='file' style='float:left; width:14.52vw; padding-bottom:0.5vh; border-right:1px solid #b3b3b3; padding-top:0.5vh;'/>";  }
			$galleryString.= $addedPics."</div>".$inputString."</div></div>";
			$roomCount++; }
			$orderString = substr($orderString, 0, -1);
			$zeroString = substr($zeroString, 0, -1);
			$orderString.= "'";
			$zeroString.= "'";
			$updateVar = "<script>
			(function($){
			gRooms.push(".$buyCount.");
			gPicsC.push(".$countT.");
			gPicsC2.push(".$countT.");
			GPicArray1.push(".$galleryItems.");
			GPicArray2.push(".$galleryItems.");
			editChange.push(0);
			picChange.push(0);
			textChange.push(0);
			hasPicAdded.push(0);
			addEditRooms.push(0);
			addOrEdit.push(0);
			rOrderEdit.push(0);
			delCount.push(0);
			roomOrder.push(".$orderString.");
			roomOrder2.push(".$orderString.");
			deleteRoom.push(".$zeroString.");
			})(jQuery);
			</script>";
			$AddEdit.= $galleryString."
			".$updateVar;
			} else {
			$AddEdit.= "<div id='tour".$buyCount."' class='newField subtab'>";
			$AddEdit.= '<div class="checkHolder2"><label for="etour'.$buyCount.'" id="editLabel'.$buyCount.'" style="float:left; margin-left:1vw; margin-top:2vh; font-size:1.5vw; font-family:Questrial;">Add Virtual Tour: </label><input type="checkbox" id="etour'.$buyCount.'" class="eTourC" style="float:left; margin-left:0.5vw; margin-top:2.4vh; width:1.2vw; height:2.4vh;"/></div>
			<div class="checkContent2 formHolder" style="display:none; margin-top:1vh;"><label id="editMany'.$buyCount.'" for="eColumn'.$buyCount.'" class="formTitle" style="margin-left:1vw;">How Many Rooms? </label><input type="text" id="eColumn'.$buyCount.'" style="float:left; width:4vw; height:3vh;"/><button id="editAddRooms'.$buyCount.'" class="eRoomsPlus" style="float:left; margin-left:1vw; width:8vw; height:3.8vh;">Add Rooms</button><span style="float:left;  margin-left:0.5vw; margin-top: 1vh; font-size:1.2vw; font-family: Questrial, sans-serif;">Maximum of 10 Entries - 3MB Size Limit</span><span id="numberEWarning'.$buyCount.'" style="float:right; color:red; margin-right:0.5vw; display:none;">Error: No number entered.</span><span id="bExceed'.$buyCount.'" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum amount allowed.</span><span id="pExceed'.$buyCount.'" style="float:right; color:red; margin-right:0.5vw; font-size:1.2vw; font-family: Questrial, sans-serif; display:none;">Error: Exceeds maximum picture size.</span>
			<div class="editHolder" style="position:relative; float:left; width:100%; height:37.2vh; clear:both; overflow-y:auto;"></div></div>';
			}
			$AddEdit.= "</div><button id='editEntry".$buyCount."' class='submitEdit ".$dbVar."'>Submit Edit</button></div>";
			echo $AddEdit;
				} else { printf ($mysqli->error); }
			} else { printf ($mysqli->error); }
		} else { printf ($mysqli->error); }
	}

	if ($dataRequest == 'AddProperty') { AddListing("property", $listingEntry, $detailEntry); }
	if ($dataRequest == 'AddRental') { AddListing("rental", $listingEntry, $detailEntry); }
} else { echo "ERROR"; }
?>