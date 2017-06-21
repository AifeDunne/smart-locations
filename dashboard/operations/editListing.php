<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';

if ($_POST['editType'] === "details") {
if ($_POST['propType'] === "buy") { $propType = "property"; }
else { $propType = "rental"; }
$listID = $_POST['listID'];

$addStreet = $_POST['addStreet'];
$addStreet = str_replace("'", "", $addStreet);
$addStreet = str_replace('"', '', $addStreet);
$addStreet = array($addStreet,"street_address");
$addCity = $_POST['addCity'];
$addCity = array($addCity,$propType."_city");
$addBedrooms = $_POST['addBedrooms'];
$addBedrooms = array($addBedrooms,"bedrooms");
$addBathrooms = $_POST['addBathrooms'];
$addBathrooms = array($addBathrooms,"bathrooms");
$addCost = $_POST['addCost'];
$addCost = str_replace(",", "", $addCost);
$addCost = str_replace('$', '', $addCost);
$addCost = str_replace('.', '', $addCost);
$addCost = array($addCost,$propType."_cost");
$addSize = $_POST['addSize'];
$addSize = str_replace(",", "", $addSize);
$addSize = array($addSize,$propType."_size");

$addType = $_POST['addType'];
$addType = htmlspecialchars($addType, ENT_QUOTES);
$addType = array($addType,$propType."_type");
$addBuilt = $_POST['addBuilt'];
$addBuilt = preg_replace("/[^0-9,.]/", "", $addBuilt);
$addBuilt = array($addBuilt,"year_built");
$addCooling = $_POST['addCooling'];
$addCooling = array($addCooling,"cooling");
$addHeating = $_POST['addHeating'];
$addHeating = array($addHeating,"heating");
$addFireplace = $_POST['addFireplace'];
$addFireplace = array($addFireplace,"fireplace");
$addParking = $_POST['addParking'];
$addParking = array($addParking,"parking");
$addLot = $_POST['addLot'];
$addLot = htmlspecialchars($addLot, ENT_QUOTES);
$addLot = array($addLot,"lot_size");
$addDesc = $_POST['addDesc'];
$addDesc = htmlspecialchars($addDesc, ENT_QUOTES);
$addDesc = array($addDesc,$propType."_description");

$primaryArray = array($addStreet, $addCity, $addBedrooms, $addBathrooms, $addCost, $addSize);
$detailArray = array($addType, $addBuilt, $addCooling, $addHeating, $addFireplace, $addParking, $addLot, $addDesc);
function UpdateListing($thisArray,$dbName) {
	global $mysqli, $propType, $listID;
	$fullDB = $propType."_".$dbName;
	$finalString = "UPDATE ".$fullDB." SET ";
	$setString = "";
	foreach ($thisArray as $arrayItem) { $setString.= $arrayItem[1]." = '".$arrayItem[0]."', "; }
	$setString = substr($setString, 0, -2);
	$finalString.= $setString." WHERE ".$propType."_id = ".$listID;
	echo $finalString." | ";
	if(!$updateListing = $mysqli->query($finalString)) { printf ($mysqli->error); }
	}
UpdateListing($primaryArray,"listing");
UpdateListing($detailArray,"details");
}
if ($_POST['editType'] === "tour") {
$listID = $_POST['listID'];
if ($_POST['propType'] === "buy") { $propType = "property"; $vLocation = "buy-home";}
else { $propType = "rental"; $vLocation = "rent"; }
$textString = $_POST['textString'];

$pullGDetails = "SELECT number, room_array, name_array, regular_array FROM virtual_tour WHERE listing_id = ".$listID;
$getGDetails = $mysqli->query($pullGDetails);
$gDetails = $getGDetails->fetch_array();
$loopNumber = $gDetails['number'];
$nameArray = $gDetails['name_array'];
$nArray = explode(",",$nameArray);
$oldArray = $nArray;
$regularArray = $gDetails['regular_array'];
$regArray = explode(",",$regularArray);

if (strpos($textString,',') !== false) {
$txtString = explode(",",$textString); 
$txtCount = 0;
foreach ($txtString as $txt) {
$splitTXT = explode("-",$txt);
$regName = $splitTXT[1];
$fixName = str_replace(" ", "", $regName);
$txtNumber = $splitTXT[0];
$txtNumber = $txtNumber - 1;
$nArray[$txtNumber] = $fixName;
$regArray[$txtNumber] = $regName;}
}
else { $txt = $textString; 
$splitTXT = explode("-",$txt);
$regName = $splitTXT[1];
$fixName = str_replace(" ", "", $regName);
$txtNumber = $splitTXT[0];
$txtNumber = $txtNumber - 1;
$nArray[$txtNumber] = $fixName;
$regArray[$txtNumber] = $regName;
}

$nameString = "";
$regString = "";
$renameArray = array();
$renameCount = 0;
for ($g = 0; $g < $loopNumber; $g++) { $nameString.= $nArray[$g].","; $regString.= $regArray[$g].","; 
if ($nArray[$g] !== $oldArray[$g]) { $pictureID = $g + 1; $renameArray[] = array($pictureID,$nArray[$g],$oldArray[$g]); $renameCount++; }
}
$nameString = substr($nameString, 0, -1);
$regString = substr($regString, 0, -1);
$finalString = "UPDATE virtual_tour SET name_array = '".$nameString."', regular_array = '".$regString."' WHERE listing_id = ".$listID;
if(!$updateListing = $mysqli->query($finalString)) { printf ($mysqli->error); }
else {
if ($renameCount !== 1) {
for ($r = 0; $r < $renameCount; $r++) {
$oldName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$renameArray[$r][2]."-".$renameArray[$r][0].".jpg"; 
$newName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$renameArray[$r][1]."-".$renameArray[$r][0].".jpg"; 
rename($oldName,$newName); }
} else {
$oldName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$renameArray[0][2]."-".$renameArray[0][0].".jpg"; 
$newName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$renameArray[0][1]."-".$renameArray[0][0].".jpg";
rename($oldName,$newName); }
	}
}

if ($_POST['editType'] === "delete") {
$propID = $_POST['propID'];
$deleteKeys = $_POST['deleteKeys'];
$propType = $_POST['propType'];
$targetQuery = "SELECT number, room_array, name_array, regular_array, picArray FROM virtual_tour WHERE listing_id = ".$propID;
$targetInfo = $mysqli->query($targetQuery);
$deleteData = $targetInfo->fetch_array();
$roomInt = $deleteData['number'];
$orgString = $deleteData['room_array'];
$orgArr = explode(",",$orgString);
$nameStr = $deleteData['name_array'];
$nameArr = explode(",",$nameStr);
$regularStr = $deleteData['regular_array'];
$regArr = explode(",",$regularStr);
$picOrg = $deleteData['picArray'];
$picArr = explode(",",$picOrg);
$deleteTarget = explode(",",$deleteKeys);
$updateNum = 0;
$updateRoomA = "";
$updateNameA = "";
$updateRegA = "";
$updatePicA = "";
$collectData = array();
for ($x = 0; $x < $roomInt; $x++) {
if (!in_array($x, $deleteTarget)) {
$updateNum++;
$updateRoomA.= $orgArr[$x].",";
$updateNameA.= $nameArr[$x].",";
$updateRegA.= $regArr[$x].",";
$updatePicA.= $picArr[$x].",";
		}
	}
$prepareFiles = array();
foreach($deleteTarget as $deletePic) {
$picDName = $nameArr[$deletePic];
$picNumR = $picArr[$deletePic];
$deleteLoc = "/".$propType."/full-images/virtual-tour/Property".$propID."-".$picDName."-Picture";
for ($r = 0; $r < $picNumR; $r++) {
$deleteComplete = $deleteLoc.$r.".jpg";
$prepareFiles[] = $deleteComplete; }
}
$updateRoomA = substr($updateRoomA, 0, -1);
$updateNameA = substr($updateNameA, 0, -1);
$updateRegA = substr($updateRegA, 0, -1);
$updatePicA = substr($updatePicA, 0, -1);
$deleteOrder = "UPDATE virtual_tour SET number = ".$updateNum.", room_array = '".$updateRoomA."', name_array = '".$updateNameA."', regular_array = '".$updateRegA."', picArray = '".$updatePicA."' WHERE listing_id = ".$propID;
if(!$deleteListing = $mysqli->query($deleteOrder)) { printf ($mysqli->error); }
else {
foreach ($prepareFiles as $deleteFiles) { unlink($deleteFiles); }
	}
}

if ($_POST['editType'] === "reOrder") {
$propID = $_POST['propID'];
$changeOrder = $_POST['changeOrder'];
$arrayMove = $_POST['arrayMove'];
$pullRDetails = "SELECT number, name_array, regular_array FROM virtual_tour WHERE listing_id = ".$propID;
$getRDetails = $mysqli->query($pullRDetails);
$rDetails = $getRDetails->fetch_array();
$picSafe = $rDetails['name_array'];
$picSafe = explode(",",$picSafe);
$roomTitle = $rDetails['regular_array'];
$currentACount = $rDetails['number'];

$shiftArray = 0;
if ($arrayMove !== 0) { $shiftArray = 1; }

$roomTitle = explode(",",$roomTitle);
$changeArray = explode(",",$changeOrder);
$newOrder = array();
$changeCount = 0;
foreach($changeArray as $changePos) { 
$adjustPos = intval($changePos); 
$adjustPost = $adjustPos - 1; 
if ($shiftArray === 1) {
	if ($adjustPos > $currentACount) { $adjustPost = $adjustPost - $arrayMove; }
	}
$newOrder[$changeCount] = $adjustPost; 
$changeCount++;	}
$newNameArr = "";
$newRegArr = "";
$adjustCount = 0;
$newRoomPlan = "";
foreach($newOrder as $newPos) {
$adjustCount++;
$newNameArr.= $picSafe[$newPos].",";
$newRegArr.= $roomTitle[$newPos].",";
$newRoomPlan.= $adjustCount.",";
	}
$newNameArr = substr($newNameArr, 0, -1);
$newRegArr = substr($newRegArr, 0, -1);
$newRoomPlan = substr($newRoomPlan, 0, -1);
$finalString = "UPDATE virtual_tour SET number = ".$adjustCount.", room_array = '".$newRoomPlan."', name_array = '".$newNameArr."', regular_array = '".$newRegArr."' WHERE listing_id = ".$propID;
if(!$updateListing = $mysqli->query($finalString)) { printf ($mysqli->error); }
else { echo "SUCCESS"; }
}
?>