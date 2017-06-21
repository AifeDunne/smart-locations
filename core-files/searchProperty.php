<?php
include_once 'db_connect.php';

if (!empty($_POST['dataRequest'])) {
$dataRequest = $_POST['dataRequest'];
	function array_sort($array, $on, $order=SORT_ASC) {
    $new_array = array();
    $sortable_array = array();
    if (count($array) > 0) { foreach ($array as $k => $v) {
            if (is_array($v)) {
                foreach ($v as $k2 => $v2) { if ($k2 == $on) { $sortable_array[$k] = $v2; } }
            } else { $sortable_array[$k] = $v; }
        } switch ($order) {
            case SORT_ASC:
                asort($sortable_array);
            break;
            case SORT_DESC:
                arsort($sortable_array);
            break;
        } foreach ($sortable_array as $k => $v) { $new_array[$k] = $array[$k]['id']; }
    } return $new_array; }

	if ($dataRequest == 'SearchHome')  { $propType = "property"; $detailType = "home"; $propPath = "buy-home"; }
	else { $propType = "rental"; $detailType = "rent"; $propPath = "rent"; }
	$searchString1 = '';
	$searchString2 = '';
	$hasBoth = 0;
	$doubleArray1 = array();
	$doubleArray2 = array();
	$idArray = '';
	$hasNeither = 0;
	if ($_POST['hasPrimary'] !== 'NULL') {
	$hasBoth++;
	$hasNeither++;
		if ($_POST['searchBy'] !== 'NULL') { if ($_POST['searchWith'] === 'region') { $searchBy = 'property_area'; } else { $searchBy = 'property_city'; }
		$searchFor = $searchBy." = '".$_POST['searchWith']."' AND "; $searchString1.= $searchFor; $doubleArray1[] = array($searchBy,$_POST['searchWith']); }
		if ($_POST['bedrooms'] !== 'NULL') { $searchString1.= "bedrooms = ".$_POST['bedrooms']." AND "; $doubleArray1[] = array("bedrooms",$_POST['bedrooms']); }
		if ($_POST['bathrooms'] !== 'NULL') { $searchString1.= "bathrooms = ".$_POST['bathrooms']." AND "; $doubleArray1[] = array("bathrooms",$_POST['bathrooms']); }
		if ($_POST['minimumP'] !== 'NULL') { $searchString1.= $propType."_cost > ".$_POST['minimumP']." AND "; $doubleArray1[] = array("minimumP",$_POST['minimumP']); }
		if ($_POST['maximumP'] !== 'NULL') { $searchString1.= $propType."_cost < ".$_POST['maximumP']." AND "; $doubleArray1[] = array("maximumP",$_POST['maximumP']); }
		if ($_POST['dateReady'] !== 'NULL') {
		$fixDate = explode("/",$_POST['dateReady']); 
		$actualDate = $fixDate[2]."-".$fixDate[0]."-".$fixDate[1]; 
		$searchString1.= $propType."_available <= ".$actualDate." AND ";
		$doubleArray1[] = array("dateReady",$actualDate); }
		$searchString1 = substr($searchString1, 0, -4);  
	}
	if ($_POST['hasOptional'] !== 'NULL') {
	$hasBoth++;
	$hasNeither++;
		if ($_POST['cooling'] !== 'NULL') { $searchString2.= "cooling = ".$_POST['cooling']." AND "; $doubleArray2[] = array("cooling",$_POST['cooling']); }
		if ($_POST['heating'] !== 'NULL') { $searchString2.= "heating = ".$_POST['heating']." AND "; $doubleArray2[] = array("heating",$_POST['heating']); }
		if ($_POST['fireplace'] !== 'NULL') { $searchString2.= "fireplace = ".$_POST['fireplace']." AND "; $doubleArray2[] = array("fireplace",$_POST['fireplace']); }
		if ($_POST['parking'] !== 'NULL') { $searchString2.= "parking = ".$_POST['parking']." AND "; $doubleArray2[] = array("parking",$_POST['parking']); }
		if ($_POST['yearBuilt'] !== 'NULL') { $searchString2.= "year_built = ".$_POST['yearBuilt']." AND "; $doubleArray2[] = array("year_built",$_POST['yearBuilt']); }
		$searchString2 = substr($searchString2, 0, -4); 
	}
	if ($hasNeither === 0) { $searchString = "SELECT ".$propType."_id FROM ".$propType."_listing"; }
	else if ($hasBoth !== 2) {
	if ($_POST['hasPrimary'] !== 'NULL') { $searchString = "SELECT ".$propType."_id FROM ".$propType."_listing WHERE ".$searchString1;  }
	else { $searchString = "SELECT ".$propType."_id FROM ".$propType."_details WHERE ".$searchString2;  }
	} else {
	$nString1 = '';
	$nString2 = '';
	foreach ($doubleArray1 as $var1) {
	$nString1.= $propType."_listing.".$var1[0]." = ".$var1[1]." AND ";
		}
	foreach ($doubleArray2 as $var2) {
	$nString2.= $propType."_details.".$var2[0]." = ".$var2[1]." AND ";
		}
	$nString2 = substr($nString2, 0, -4);  
	$nString = $nString1.$nString2;
	$searchString = "SELECT ".$propType."_listing.".$propType."_id FROM ".$propType."_listing 
		LEFT JOIN ".$propType."_details ON ".$propType."_details.".$propType."_id = ".$propType."_listing.".$propType."_id
		WHERE ".$nString;
	}
	$findRows = $mysqli->query($searchString);
	if ( $findRows->num_rows === 0) { echo "Sorry No Results Were Found For This Search"; }
	else {
	if ($fetchListings = $mysqli->prepare($searchString)) {
		$fetchListings->execute();
		$fetchListings->bind_result($property_id);
		while ($fetchListings->fetch()) { $idArray.= $property_id.", ";}
		$fetchListings->close();
		} else { echo "Sorry No Results Were Found For This Search"; }
	$idArray = substr($idArray, 0, -2);
	$finalList = '';
	$sortNow = array();
	$dayArayAsc = 'var dayArrayAsc = [';
	$dayArayDesc = 'var dayArrayDesc = [';
	$contentArray = 'var contentArray = [';
	$priceArrayAsc = 'var priceArrayAsc = [';
	$priceArrayDesc = 'var priceArrayDesc = [';
	$addressArrayAsc = 'var addressArrayAsc = [';
	$addressArrayDesc = 'var addressArrayDesc = [';
	$availableArrayAsc = 'var availableArrayAsc = [';
	$availableArrayDesc = 'var availableArrayDesc = [';
	$squareFootaArrayAsc = 'var squareFootaArrayAsc = [';
	$squareFootaArrayDesc = 'var squareFootaArrayDesc = [';
	$timeArray = array();
	$dateArray = array();
	$wCount = 0;
	$retrieveResults = "SELECT ".$propType."_id, street_address, ".$propType."_city, bedrooms, bathrooms, ".$propType."_cost, ".$propType."_size, dateAdded, ".$propType."_available, ".$propType."_thumb FROM ".$propType."_listing WHERE ".$propType."_id IN (".$idArray.")";
	if ($propertyDetail = $mysqli->prepare($retrieveResults)) {
		$propertyDetail->execute();
		$propertyDetail->bind_result($homeID,$street,$city,$bedrooms,$bathrooms,$cost,$size,$dayAdded,$available,$thumb);
		while ($propertyDetail->fetch()) {
		$wCount++;
		$addSafe = preg_split('/ +/', $street);
		$addSafe = intval($addSafe[0]);
		$size = intval($size);
		$date = new DateTime($available);
		$datePosted = new DateTime($dayAdded);
		$aSafe1 = $date->format('F');
		$aSafe2 = $date->format('d');
		$addDays1 = $datePosted->format('F');
		$addDays2 = $datePosted->format('d');
		$timeArray[$aSafe1][$aSafe2] = $homeID;
		$dateArray[$addDays1][$addDays2] = $homeID;
		$sortArray[] = array("id" => $homeID, "price" => $cost, "address" => $addSafe, "size" => $size);
		$available = $aSafe1." ".$aSafe2;
		$postedOn = $addDays1." ".$addDays2;
		if ($thumb === "NULL") { $thumb = "None.jpg"; }
		$partialString = '<div id="sResult'.$homeID.'" style="float:left; width:99%; height:14.4vh; clear:both; margin-bottom:1vh; background:rgba(255,255,255,0.6); border:1px solid #b3b3b3;"><div style="float:left; width: auto; height:100%;"><img src="/'.$propPath.'/images/'.$thumb.'"/></div><div style="float:left; width:70%; margin-left:1vw; font-family: Questrial, sans-serif; color:#000; padding-top:1vh;"><span style="float:left; font-weight:bold; font-size:1.5vw;">'.$street.', '.$city.', OK </span><span style="float:left; font-size:1.3vw;"> - $'.$cost.'</span><span style="float:left; clear:both; font-size:1.2vw;"><b>Layout:</b> '.$bedrooms.' Bedrooms - '.$bathrooms.' Bathrooms</span><span style="float:left; clear:both; font-size:1.2vw;"><b>Size:</b> '.$size.'</span><span style="float:left; clear:both; font-size:1vw;"><b>Posted On:</b> '.$postedOn.'</span><span style="float:left; clear:both; font-size:1vw;"><b>Available:</b> '.$available.'</span></div><div style="float:left; width:9.1%; height:100%; border-left:1px solid #b3b3b3;"><a style="color: #000; position: relative; float: left; font-family: Questrial, sans-serif; transform: rotate(-90deg); margin-top: 4vh; height: 3vw; width: 12vh; text-decoration:none; font-size:1.1vw;" href="'.$detailType.'-details?homeID='.$homeID.'">View Details</a></div></div>';
		$contentArray.= "'".$partialString."',";
		$finalList.= $partialString; }
	    echo $finalList;
		$propertyDetail->close();
		$scriptString = "<script>";
		function sortAddArray($getArray,$startID) {
			foreach ($getArray as $got) { $startID.= $got.","; }
			$startID = substr($startID, 0, -1);
			$startID.= "];";
		return $startID; }
		$sortNow = array_sort($sortArray, 'price', SORT_ASC);
		$priceArrayAsc = sortAddArray($sortNow,$priceArrayAsc);
		$sortNow = array_sort($sortArray, 'price', SORT_DESC);
		$priceArrayDesc = sortAddArray($sortNow,$priceArrayDesc);
		$sortNow = array_sort($sortArray, 'address', SORT_ASC);
		$addressArrayAsc = sortAddArray($sortNow,$addressArrayAsc);
		$sortNow = array_sort($sortArray, 'address', SORT_DESC);
		$addressArrayDesc = sortAddArray($sortNow,$addressArrayDesc);
		$sortNow = array_sort($sortArray, 'size', SORT_ASC);
		$squareFootaArrayAsc = sortAddArray($sortNow,$squareFootaArrayAsc);
		$sortNow = array_sort($sortArray, 'size', SORT_DESC);
		$squareFootaArrayDesc = sortAddArray($sortNow,$squareFootaArrayDesc);
		function FixDateTime($tArray) {
		$fCount = -1;
		$fString = "";
		$fArray = array();
		foreach ($tArray as $month) { foreach ($month as $day) { $fCount++; $fString.= $day.","; $fArray[] = $day; } }
		$fString2 = "";
		for($b = $fCount; $b > -1; $b=$b-1) { $fString2.= $fArray[$b].","; }
		$fString = substr($fString, 0, -1);
		$fString2 = substr($fString2, 0, -1);
		$finalResult = array($fString,$fString2);
		return $finalResult;
		}
		$getTString1 = FixDateTime($timeArray);
		$availableArrayDesc.= $getTString1[0]."];";
		$availableArrayAsc.= $getTString1[1]."];";
		$getTString2 = FixDateTime($dateArray);
		$dayArayDesc.= $getTString2[0]."];";
		$dayArayAsc.= $getTString2[1]."];";
		
		$contentArray = substr($contentArray, 0, -1);
		$contentArray.= $contentArray."];";		
		$scriptString.= "var amountReturned = ".$wCount.";
		".$dayArayAsc."
		".$dayArayDesc."
		".$priceArrayAsc."
		".$priceArrayDesc."
		".$addressArrayAsc."
		".$addressArrayDesc."
		".$availableArrayDesc."
		".$availableArrayAsc."
		".$squareFootaArrayAsc."
		".$squareFootaArrayDesc."
		</script>";
		echo $scriptString;
		}
	}
}
?>