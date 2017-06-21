<?php
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/db_connect.php';
include_once $_SERVER['DOCUMENT_ROOT'].'/core-files/functions.php';
 
sec_session_start();
if (login_check($mysqli) == true) { header('Location: /dashboard/');
} else { $logged = 'out'; }
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Locations - Login</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:80vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#navMenu { float: left; margin-left: 10.5vw; width: 57vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.3); clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }
		
		#page1 { float:left; width: 58vw; margin-left: 10.5vw; margin-top:5vh; background:rgba(255,255,255,0.3);}
		#loginBox { float: left; width: 20vw; padding: 3vh; margin-left: 0vw; margin-top: 4vh; }
		.formHolder { float:left; clear:both; margin-bottom:1vh; width:100%; }
		.formSpan { float:left; font-family: 'Questrial', sans-serif; color:#000; font-size:1.5vw; }
		.formInput { float:right; margin-left:1vw; height:3vh; }
		#logText { float:left; clear:left; font-family: 'Questrial', sans-serif; color:#000; font-size:1.2vw; }
		#loginButton { float:left; clear:both; height:4vh; width:15vw; margin-top:3vh; }
	</style>
    </head>
	<script type="text/JavaScript" src="operations/sha512.js"></script> 
    <script type="text/JavaScript" src="operations/forms.js"></script> 
    <body>
	<div id="centerBox">
	<div id="navMenu"><a class="navItems" href="/">Home</a><a class="navItems" href="/buy-home/">Buy</a><a class="navItems" href="/rent/">Rent</a><a class="navItems" href="/">InfoCenter</a><a class="navItems" href="/">About Us</a><a class="navItems" href="/login/">Log In</a></div>
	<div id="page1">
		<div id="loginBox">
		<?php
        if (isset($_GET['error'])) { echo '<p class="error">Error Logging In!</p>'; }
        ?> 
        <form action="operations/process_login.php" method="post" name="login_form">
            <div class="formHolder"><span class="formSpan">Username: </span><input type="text" name="username" class="formInput"/></div>
            <div class="formHolder"><span class="formSpan">Password: </span><input type="password" name="password" id="password" class="formInput"/></div>
            <?php
			if (login_check($mysqli) == false) { echo '<span id="logText">Currently logged ' . $logged . '.</span>'; }
			?>
			<input id="loginButton" type="button" value="Login" onclick="formhash(this.form, this.form.password);" /> 
        </form>
		</div>
	</div>
	</body>
</html>