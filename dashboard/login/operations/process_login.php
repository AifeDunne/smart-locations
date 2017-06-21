<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';
 
sec_session_start();
if (isset($_POST['username'], $_POST['p'])) {
    $username = $_POST['username'];
    $password = $_POST['p'];
    if (login($username, $password, $mysqli) == true) {
		$privGroup = array_values(mysqli_fetch_array($mysqli->query("SELECT userLevel FROM members WHERE username = '".$username."'")))[0];
		if ($privGroup === '2') {
		header('Location: /dashboard/protected_page2.php');
		}
		else if ($privGroup === '1') {
		header('Location: /dashboard/');
		}
    } else {
        header('Location: /dashboard/login/');
    }
} else {
    echo 'Invalid Request';
}