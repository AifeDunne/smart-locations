<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';

session_start();

	$topic = $_GET['emailTopic'];
	$memberID = $_GET['sendTo'];
	$pullEmail = "SELECT email FROM userDetails WHERE id = ".$memberID;
	$getEmail = $mysqli->query($pullEmail);
	$thisEmail = $getEmail->fetch_array();
	$sendTo = $thisEmail['email'];
	
    $error_message = "";
	$bannedString = "/^[A-Za-z .'-]+$/";
	$emailFrom = $_GET['emailFrom'];
	$bannedMail = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
	if(!preg_match($bannedMail,$emailFrom)) { $error_message .= 'The email address you entered does not appear to be valid.'; }
	$emailName = $_GET['emailName'];
	if(!preg_match($bannedString,$emailName)) { $error_message .= 'The name you entered does not appear to be valid.'; }
	$emailMessage = $_GET['emailMessage'];
	
	$headers = 'From: '.$emailFrom."\r\n".'Reply-To: '.$emailFrom."\r\n";
	$clientMsg = "Name: ".$emailName."\n"."Email Address: ".$emailFrom."\n"."Message: ".$emailMessage."\n";
		
@mail($sendTo, $topic, $clientMsg, $headers);

?>