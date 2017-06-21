<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';

$listID = $_GET['buildingID']; 
$picString = $_GET['picString'];
$picRooms = $_GET['picRooms'];
$picTitle = $_GET['picTitle'];

$picChange = $_GET['picChange'];
$pString = explode(",",$picString);
$pRooms = explode(",",$picRooms);
if ($_GET['propType'] === "buy") { $vLocation = "buy-home"; }
else { $vLocation = "rent"; }

$pullGDetails = "SELECT number, room_array, name_array FROM virtual_tour WHERE listing_id = ".$listID;
$getGDetails = $mysqli->query($pullGDetails);
$gDetails = $getGDetails->fetch_array();
$loopNumber = $gDetails['number'];
$namesArray = $gDetails['name_array'];
$roomArray = $gDetails['room_array'];
$rArray = explode(",",$roomArray);
$nameArray = explode(",",$namesArray);
$nArray = array();
for ($g = 0; $g < $loopNumber; $g++) {
$roomNum = $rArray[$g];
$roomName = $nameArray[$g];
$nArray[$roomNum] = $roomName;
}

$rowData1 = array();
$rowData2 = array();
$rowData3 = array();
foreach ($pString as $pStr) {
$pSplit = explode("-",$pStr);
$pSID = $pSplit[0];
if (!in_array($pSID, $rowData1)) { $rowData1[] = $pSID; $rowData2[$pSID] = 0; }
$plusOne = $rowData2[$pSID];
$rowData3[$pSID][$plusOne] = $pSplit[1];
$plusOne++;
$rowData2[$pSID] = $plusOne;
}
$oldArray = $nArray;

if ($picTitle !== "none") {
$pArray2 = array();
$picTitle = explode(",",$picTitle);
$picArray = array();
$regNameString = "";
foreach($picTitle as $newPic) {
$cutPic = explode("-",$newPic);
$num1 = $cutPic[0];
$num2 = $cutPic[1];
$picArray[$num1] = $num2;
}

foreach ($pRooms as $pic) {
if (array_key_exists($pic, $picArray)) {
	$newTitle = $picArray[$pic];
	if (!empty($newTitle) || $newTitle !== "") {
	$newEntry = str_replace(" ", "", $newTitle);
	$nArray[$pic] = $newEntry; 
	$pArray2[] = array($pic,$newEntry);
			}
		}
	}

foreach ($pArray2 as $pArr) {
$crntNum = $pArr[0];
$crntName = $pArr[1];
$crntArray = $rowData3[$crntNum];
$countArr2 = count($crntArray);
$StartPicName = $nArray[$crntNum];
$OldStart = $oldArray[$crntNum];
if ($countArr2 <= 1) { $crntRow = $crntArray[0];
$FullOld = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$OldStart."-Picture".$crntRow.".jpg";
$FullName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$StartPicName."-Picture".$crntRow.".jpg";
unlink($FullOld);
move_uploaded_file($_FILES['files']['tmp_name'][$crntNum][$crntRow], $FullName); }
else {
foreach ($crntArray as $eachRow) {
$FullOld = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$OldStart."-Picture".$eachRow.".jpg";
$FullName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$StartPicName."-Picture".$eachRow.".jpg";
unlink($FullOld);
move_uploaded_file($_FILES['files']['tmp_name'][$crntNum][$eachRow], $FullName);}
		}
	$FullOld = "";
	$FullName = "";
	unset($rowData3[$crntNum]);
	$rowKey = array_search($crntNum,$rowData1);
	unset($rowData1[$rowKey]);
	}
}

if (!empty($rowData1)) {
foreach ($rowData1 as $keyValue) {
		$findArray = $rowData3[$keyValue];
		$crntName2 = $nArray[$keyValue];
		$countArr = count($findArray);
		if ($countArr <= 1) { $rowID = $findArray[0];
		$FullName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$crntName2."-Picture".$rowID.".jpg"; 
		unlink($FullName);
		move_uploaded_file($_FILES['files']['tmp_name'][$keyValue][$rowID], $FullName); } 
		else {
		foreach ($findArray as $picRow) {
		$FullName = $_SERVER['DOCUMENT_ROOT'].'/'.$vLocation.'/full-images/virtual-tour/Property'.$listID."-".$crntName2."-Picture".$picRow.".jpg";
		unlink($FullName);
		move_uploaded_file($_FILES['files']['tmp_name'][$keyValue][$picRow], $FullName); }
		}
		$FullName = "";
	}
}
?>