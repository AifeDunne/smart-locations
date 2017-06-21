<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/psl-config.php';
 
$error_msg = "";
if (isset($_POST['username'], $_POST['email'], $_POST['realname'], $_POST['p'])) {
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
	$realname = filter_input(INPUT_POST, 'realname', FILTER_SANITIZE_STRING);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) { $error_msg = 0; }
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) { $error_msg = 1; } 
 
    $prep_stmt = "SELECT id FROM userDetails WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows == 1) {
            $error_msg = 2; 
                        $stmt->close();
        }
                $stmt->close();
    } else { $stmt->close(); }
 
    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
    if ($stmt) {
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $stmt->store_result();
                if ($stmt->num_rows == 1) {
                        $error_msg = 3;
                        $stmt->close();
                }
                $stmt->close();
        } else { $stmt->close(); }
 
    if (empty($error_msg)) {
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
        $password = hash('sha512', $password . $random_salt);
		$getMemberCount = "SELECT var_value FROM sysVar WHERE var_name = 'member_count'";
		$grabCount = $mysqli->query($getMemberCount);
		$getCount = $grabCount->fetch_array();
		$memberCount = intval($getCount['var_value']);
		$memberCount++;
        if ($insert_stmt = $mysqli->prepare("INSERT INTO members (id, username, password, salt) VALUES (?, ?, ?, ?)")) {
            $insert_stmt->bind_param('isss', $memberCount, $username, $password, $random_salt);
            if (! $insert_stmt->execute()) { echo "Failure to Insert"; }
			else {
			$company = htmlspecialchars($_POST['company'], ENT_QUOTES);
			$primaryPhone = str_replace("-", "", $_POST['primary']);
			$secondaryPhone = str_replace("-", "", $_POST['secondary']);
			$fax = htmlspecialchars($_POST['fax'], ENT_QUOTES);
			$website = htmlspecialchars($_POST['website'], ENT_QUOTES);
			$sellerType = $_POST['type'];
			$add_details = $mysqli->prepare("INSERT INTO userDetails (id, name, company, email, primary_phone, secondary_phone, fax, website, user_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
			$add_details->bind_param('issssssss', $memberCount, $realname, $company, $email, $primaryPhone, $secondaryPhone, $fax, $website, $sellerType);
			if (! $add_details->execute()) { echo "Failure to Insert Details"; }
			else { 
			$updateCount = "UPDATE sysVar SET var_value = ".$memberCount." WHERE var_name = 'member_count'";
			$execute = $mysqli->query($updateCount);
			echo "Success"; }
			}
        }
    } else { echo $error_msg; }
}