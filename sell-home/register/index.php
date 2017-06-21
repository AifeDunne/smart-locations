<html>
    <head>
        <meta charset="UTF-8">
        <title>Smart Locations - Register</title>
		<link href='http://fonts.googleapis.com/css?family=Questrial' rel='stylesheet' type='text/css'>
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
	<style>
		html { height: 100%; margin: 0px; padding: 0px; }
		body { position:absolute; top:0; left:0; height: 100%; width:100%; margin: 0px; padding: 0px; background:url(/resources/mainSmallX.jpg); background-size: cover; background-repeat: no-repeat; background-attachment: fixed; background-position: center;}
		#centerBox {  position: relative; height:100%; width:80vw; float:none; margin-left:auto; margin-right:auto; background:rgba(255,255,255,0.7); }
		#navMenu { float: left; margin-left: 10.5vw; width: 57vw; padding-left:1vw; height: 4.5vh; padding-top:2vh; margin-top: 0.5vh; background: rgba(255,255,255,0.3); clear:left; }
		.navItems { margin-right:1.5vw; font-family: 'Questrial', sans-serif; color:#000; font-size:1vw; margin-left:1vw; text-decoration:none; }

		#page1 {float:left; width: 58vw; margin-left: 10.5vw;}
		#regForm { float:left; padding-top:2vh; width:50%; }
		.formHeader { float:left; font-family:Questrial; font-size:2vw; font-weight:bold; }
		.formElement { float:left; clear:both; margin-bottom:1vh; width:100%; }
		.formT { float:left; font-family:Questrial; font-size:1.2vw; font-weight:bold; }
		.formInput { float:right; height: 2.8vh; width: 15vw; }
		.divide { float:left; width:100%; height:1px; background-color:#000; margin-top:1.5vh; margin-bottom:1.5vh; clear:both; }
		#ResponseBox { float:right; width:40%; margin-top:7vh; }
		#successRegister { float:left; font-family:Questrial; font-size:1.5vw; color:green; display:none; }
		#failedRegister { float:left; font-family:Questrial; font-size:1.5vw; color:red; display:none; }
	</style>
    </head>
    <body>
	<script type="text/JavaScript" src="operations/sha512.js"></script> 
	<div id="centerBox">
	<?php $headerSection = 'sell'; require $_SERVER['DOCUMENT_ROOT'].'/resources/header.php'; ?>
	<div id="page1">
	<div id="regForm">
		<div class="formElement"><span class="formHeader">Required</span><span id="reqWarning" style="float:right; font-family:Questrial; font-size:1vw; color:red; display:none; margin-top:0.5vh;">Error! You are missing required information.</span><span id="passWarning" style="float:right; font-family:Questrial; font-size:1vw; color:red; display:none; margin-top:0.5vh;">Error! Your passwords don't match.</span></div>
            <div class="formElement"><span class="formT">Username: </span> <input type='text' name='username' id='username' class="formInput formData1 required"/></div>
			<div class="formElement"><span class="formT">Email: </span> <input type='text' name='email' id='email' class="formInput formData1 required"/></div>
			<div class="formElement"><span class="formT">Full Name: </span> <input type='text' name='realname' id='realname' class="formInput formData1 required"/></div>
            <div class="formElement"><span class="formT">Password:</span> <input type="password" name="password" id="password" class="formInput required"/></div>
            <div style="float:left; clear:both; width:100%;"><span class="formT">Confirm password:</span> <input type="password" name="confirmpwd" id="confirmpwd" class="formInput required"/></div>
			<div id="addinstruct" style="float: left; width: 23vw; margin-top: 3vh; margin-left: 0; clear: both; margin-top: 1vh;"><span style="font-size:0.8vw;"><b>Note: </b>Usernames may contain only digits, upper and lower case letters and underscores. Passwords must be at least 6 characters long and contain one uppercase letter, one lower case letter, one number.</span></div>
			<div class="divide"></div>
		<div class="formElement"><span class="formHeader">Optional</span></div>
			<div class="formElement"><span class="formT">Company: </span> <input type='text' name='company' id='company' class="formInput formData2"/></div>
			<div class="formElement"><span class="formT">Primary Phone: </span> <input type='text' name='primePhone' id='primePhone' class="formInput formData2"/></div>
			<div class="formElement"><span class="formT">Secondary Phone: </span> <input type='text' name='secondPhone' id='secondPhone' class="formInput formData2"/></div>
			<div class="formElement"><span class="formT">Fax Number: </span> <input type='text' name='fax' id='fax' class="formInput formData2"/></div>
			<div class="formElement"><span class="formT">Website: </span> <input type='text' name='website' id='website' class="formInput formData2"/></div>
			<div class="formElement"><span class="formT">You Are A: </span><select class="formData2" style="float:right; height:2.8vh; width:15vw;"><option value="">N/A</option><option value="1">Private Seller</option><option value="2">Landlord</option><option value="3">Realtor</option><option value="4">Property Manager</option></select></div>
			</div>
			<div id="ResponseBox">
			<span id="successRegister"></span>
			<span id="failedRegister"></span>
			</div>
		<button id="registerAccount" name="addEmployee" style="float:left; width:10vw; height:6vh; margin-top:1vh; clear:both;">Register Account</button>
		<script>
		$(document).ready(function() {
		$("#registerAccount").on("click", function() {
			var rData = new Array();
			var oData = new Array();
			var checkSearch = '';
			var passH1 = '';
			$(".required").each(function(){
				var requiredData = $(this).val();
				if (requiredData == "") { checkSearch = "NULL"; }
			});
			if (checkSearch == "NULL") {
			checkSearch = '';
			$("#reqWarning").stop().fadeIn(400);
			setTimeout(function() { $("#reqWarning").stop().fadeOut(400); }, 2000);
			}
			else {
			var passValue = $("#password").val();
			var confirmPass = $("#confirmpwd").val();
			passH1 = hex_sha512(passValue);
			var passH2 = hex_sha512(confirmPass);
			if (passH1 != passH2) {
			checkSearch = '';
			passH1 = '';
			$("#passWarning").stop().fadeIn(400);
			setTimeout(function() { $("#passWarning").stop().fadeOut(400); }, 2000);
			}
			else {
			$(".formData1").each(function(){
				var fData1 = $(this).val();
				rData.push(fData1);
			});
			$(".formData2").each(function(){
				var getSearch2 = $(this).val();
				if (getSearch2 == "") { getSearch2 = "N/A"; }
				oData.push(getSearch2);
			});
			var errorArray = ['The email address you entered is not valid','Invalid password configuration.','A user with this email address already exists.','A user with this username already exists.'];
			$.ajax({
			type: "POST",
			url: "operations/register.inc.php",
			data: { username: rData[0], email: rData[1], realname: rData[2], p: passH1, company: oData[0], primary: oData[1], secondary: oData[2], fax: oData[3], website: oData[4], type: oData[5] },
			success: function (data) { if (data == "Success") { $("#successRegister").text("Your account has been successfully created."); $("#successRegister").stop().fadeIn(500);
				$(".formInput").val("");
				$(".formData2").val("");
				setTimeout(function() { $("#successRegister").stop().fadeOut(500); }, 3000);
				setTimeout(function() { $("#successRegister").text(""); }, 3500);
				}
			else { var newError = errorArray[data]; 
			$("#failedRegister").text(newError); $("#failedRegister").stop().fadeIn(500);
			setTimeout(function() { $("#failedRegister").stop().fadeOut(500); }, 3000);
			setTimeout(function() { $("#failedRegister").text(""); }, 3500);
								}
							}
						})
					}
				}
			});
		});
		</script>
		</div>
	</div>
	</body>
</html>