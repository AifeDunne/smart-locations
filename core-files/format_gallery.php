<?php
include_once 'db_connect.php';

$dataType = $_GET['dataType'];
if ($dataType === 'add' || $dataType === 'update') {
$propType = $_GET['propType'];
if ($propType === "buy-home") { $pType = "property"; }
else { $pType = "rent"; }
$roomSequence = $_GET['roomCount'];
$regularNames = $_GET['roomName'];
$roomNames = str_replace(" ", "", $regularNames);
$countQuery = "SELECT var_value FROM sysVar WHERE var_name = 'tour_count'";
$selectCount = $mysqli->query($countQuery);
$getTour = $selectCount->fetch_array();
$tourCount = $getTour['var_value'];
$tourCount++;
$updateCount = "UPDATE sysVar SET var_value = ".$tourCount." WHERE var_name = 'tour_count'";
$executeCount = $mysqli->query($updateCount);

if ($dataType === 'add') {
$listCountQ = "SELECT var_value FROM sysVar WHERE var_name = '".$pType."_count'";
$selectCount = $mysqli->query($listCountQ);
$pCount = $selectCount->fetch_array();
$propertyCount = $pCount['var_value'];
} else if ($dataType === 'update') {
$propertyCount = $_GET['propID'];
}

$regNames = explode(",",$regularNames);
$roomSArray = explode(",",$roomSequence);
$allRooms = explode(",",$roomNames);
$roomCount = 0;
$forCount = 0;
$lowerCount = 0;
$newRooms = "";
$newSequence = "";
$newRegular = "";
$newFString = "";
	$fileString = $_GET['roomArray'];
	$fileArray = explode(",",$fileString);
	foreach ($allRooms as $roomName) {
	$forCount++;
	$fileNumber = $fileArray[$forCount];
	if ($fileNumber !== 0) {
		for ($p = 0; $p < $fileNumber; $p++) {
		$fileName = "";
		$getName = $_FILES['files']['name'][$forCount][$p];
		$getName = explode(".",$getName);
		$getName = $getName[1];
		$fileName = "Property".$propertyCount."-".$roomName."-Picture".$p.".".$getName;
		$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/'.$propType.'/full-images/virtual-tour/'.$fileName;
		move_uploaded_file($_FILES['files']['tmp_name'][$roomCount][$p], $uploadfile);
			}
		$newRooms.= $roomName.","; 
		$newSequence.= $roomSArray[$roomCount].",";
		$newRegular.= $regNames[$roomCount].",";
		$newFString.= $fileNumber.",";
		} else { $lowerCount++; } 
		$roomCount++;
	}
	$roomCount = $roomCount - $lowerCount;
	$newRooms = substr($newRooms, 0, -1);
	$newSequence = substr($newSequence, 0, -1);
	$newRegular = substr($newRegular, 0, -1);
	$newFString = substr($newFString, 0, -1);

$quoteCatch = $tourCount.", ".$propertyCount.", 'Property".$propertyCount."', ".$roomCount.", '".$newSequence."', '".$newRooms."', '".$newRegular."', '".$newFString."'";
$inputGallery = "INSERT INTO virtual_tour VALUES (".$quoteCatch.")";
$insertGallery = $mysqli->query($inputGallery);
}

if ($dataType === 'edit') {
$propID = $_GET['propertyNumber'];
$propType = $_GET['propType'];
if ($propType === "buy-home") { $pType = "property"; }
else { $pType = "rent"; }
$roomSequence = $_GET['roomCount'];
$regularNames = $_GET['roomName'];
$roomNames = str_replace(" ", "", $regularNames);

$currentTourQuery = "SELECT number, room_array, name_array, regular_array, picArray FROM virtual_tour WHERE listing_id = ".$propID;
$cTour = $mysqli->query($currentTourQuery);
$cDetails = $cTour->fetch_array();
$number = $cDetails['number'];
$r1Array = $cDetails['room_array'];
$n1Array = $cDetails['name_array'];
$reg1Array = $cDetails['regular_array'];
$p1Array = $cDetails['picArray'];
$rArray = explode(",",$r1Array);
$nArray = explode(",",$n1Array);
$regArray = explode(",",$reg1Array);
$rString = ""; $nString = ""; $regString = "";
for ($s = 0; $s < $number; $s++) { $rString.= $rArray[$s].","; $nString.= $nArray[$s].","; $regString.= $regArray[$s].","; }

$roomSArray = explode(",",$roomSequence);
$regNamesArray = explode(",",$regularNames);
$allRooms = explode(",",$roomNames);
$roomCount = 0;
$forCount = $number;
$n2Count = $number;
$fileString = $_GET['roomArray'];
$fileString = str_replace(" ", "", $fileString);
$fileArray = explode(",",$fileString);

foreach ($allRooms as $roomName) {
	$forCount++;
	$fileNumber = $fileArray[$n2Count];
	if ($fileNumber !== 0) {
		for ($p = 0; $p < $fileNumber; $p++) {
		$fileName = "";
		$getName = $_FILES['files']['name'][$roomCount][$p];
		$getName = explode(".",$getName);
		$getName = $getName[1];
		$fileName = "Property".$propID."-".$roomName."-Picture".$p.".".$getName;
		$uploadfile = $_SERVER['DOCUMENT_ROOT'].'/'.$propType.'/full-images/virtual-tour/'.$fileName;
		move_uploaded_file($_FILES['files']['tmp_name'][$roomCount][$p], $uploadfile);
		}
		$number++;
		$p1Array.= ",".$fileNumber;
		$rString.= $number.",";
		$nString.= $roomName.",";
		$regString.= $regNamesArray[$roomCount].",";
		}
	$roomCount++;
	$n2Count++;
	}
	$rString = substr($rString, 0, -1); $nString = substr($nString, 0, -1); $regString = substr($regString, 0, -1); 
	$updateTQuery = "UPDATE virtual_tour SET number = ".$number.", room_array = '".$rString."', name_array = '".$nString."', regular_array = '".$regString."', picArray = '".$p1Array."' WHERE listing_id = ".$propID;
	$updateGallery = $mysqli->query($updateTQuery);
	}
	
if ($dataType === 'addpics') {
	$propID = $_GET['propertyNumber'];
	$propType = $_GET['propType'];
	if ($propType === "buy-home") { $pType = "property"; }
	else { $pType = "rent"; }
	$getAddString = $_GET['addPicArray'];
	$getAddString = str_replace(" ", "", $getAddString);
	$getAddArray = explode(",",$getAddString);
	$fullMulti = array();
	foreach ($getAddArray as $miniArray) {
	if ($splitMini !== 0) {
	$splitMini = explode("-",$miniArray);
	$mID = $splitMini[0];
	$fullMulti[$mID] = array($mID,$splitMini[1],$splitMini[2]);
		}
	}
	$currentTourQuery = "SELECT name_array, picArray FROM virtual_tour WHERE listing_id = ".$propID;
	$cTour = $mysqli->query($currentTourQuery);
	$cDetails = $cTour->fetch_array();
	$picString = $cDetails['picArray'];
	$nameString = $cDetails['name_array'];
	$picArray = explode(",",$picString);
	$nameArray = explode(",",$nameString);
	$returnArray = "";
	foreach ($fullMulti as $updatePic) {
	$roomID = $updatePic[0];
	$arrayKey = $roomID - 1;
	$startID = $updatePic[1];
	$endID = $updatePic[2];
	$currentRoom = $nameArray[$arrayKey];
	$picArray[$arrayKey] = $endID;
	$returnArray.= $roomID."|";
	$startString = "Property".$propID."-".$currentRoom."-Picture";
	for ($u = $startID; $u < $endID; $u++) {
	$getName = $_FILES['files']['name'][$roomID][$u];
	$getName = explode(".",$getName);
	$getName = $getName[1];
	$fileName = $startString.$u.".".$getName;
	$uString = '/'.$propType.'/full-images/virtual-tour/'.$fileName;
	$returnArray.= $uString.",";
	$uploadfile = $_SERVER['DOCUMENT_ROOT'].$uString;
	move_uploaded_file($_FILES['files']['tmp_name'][$roomID][$u], $uploadfile);
		}
		$returnArray = substr($returnArray, 0, -1);
		$returnArray.= "+";
	}
	$returnArray = substr($returnArray, 0, -1);
	$pUpdate = "";
	foreach ($picArray as $picByte) { $pUpdate.= $picByte.","; } 
	$pUpdate = substr($pUpdate, 0, -1);
	$updateTQuery = "UPDATE virtual_tour SET picArray = '".$pUpdate."' WHERE listing_id = ".$propID;
	$updateGallery = $mysqli->query($updateTQuery);
	echo $returnArray;
}
?>