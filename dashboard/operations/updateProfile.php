<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';

$id = $_POST['id'];
$email = $_POST['email'];
$company = htmlspecialchars($_POST['company'], ENT_QUOTES);
$primaryPhone = str_replace("-", "", $_POST['primary']);
$secondaryPhone = str_replace("-", "", $_POST['secondary']);
$fax = htmlspecialchars($_POST['fax'], ENT_QUOTES);
$website = htmlspecialchars($_POST['website'], ENT_QUOTES);
$userType = $_POST['type'];
$profileString = "UPDATE userDetails SET company = '".$company."', email = '".$email."', primary_phone = '".$primaryPhone."', secondary_phone = '".$secondaryPhone."', fax = '".$fax."', website = '".$website."', user_type = '".$userType."' WHERE id = ".$id;
if ($updateProfile = $mysqli->query($profileString)) { echo "SUCCESS"; }
else { echo "FAILURE"; }
?>