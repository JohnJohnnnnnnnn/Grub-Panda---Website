<?php
require 'config.php';
if(isset($_POST['submit'])){
	$firstname = $_POST["firstname"];
	$lastname = $_POST["lastname"];
	$address = $_POST["address"];
	$email = $_POST["email"];
	$phonenumber = $_POST["phonenumber"];
	$username = $_POST["username"];
	$password = md5($_POST["password"]);
	$conpassword = md5($_POST["conpassword"]);
	$usertype = $_POST['usertype'];
	$duplicate = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email' OR phonenumber = '$phonenumber' OR username = '$username'");
	if(mysqli_num_rows($duplicate) > 0){
		echo "<script> 
			window.location.assign('registration.php');
			alert('Email or Username are Already Exist!'); </script>";
	}
	else{
		if($password == $conpassword){
			$query = "INSERT INTO users VALUES('','$firstname','$lastname','$address','$email','$phonenumber','$username','$password','$conpassword','$usertype')";
				mysqli_query($conn,$query);
				echo "<script>
				window.location.assign('login.php');
				alert('Registration Successful!');
				</script>";
				

			}
		else{
			echo "<script> 
			window.location.assign('registration.php');
			alert('Password Does not Match'); </script>";
			}
		}
	}
?> 
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GRUB PANDA | REGISTRATION PAGE</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesreg.css">
	<script src="https://kit.fontawesome.com/abfb78afe4.js" crossorigin="anonymous"></script>

</head>
<body>
<div>
</div>
		<div class="container">
			<div class="heading">Registration</div>
			<p>Fill up the form with correct values.</p>
				<form action="registration.php" method="post">
					<div class="card_details">
						<div class="card_box">
							<span class="details">First Name</span>
								<input class="form_control" type="text" placeholder="Enter your First Name" id="firstname" name="firstname" required>
						</div>
						<div class="card_box">
							<span class="details">Last Name</span>
								<input class="form_control" type="text" placeholder="Enter your Last Name" id="lastname" name="lastname" required>
						</div>
						<div class="card_box">
							<span class="details">Address</span>
								<input class="form_control" type="text" placeholder="Enter your Complete Address" id="address" name="address" required>
						</div>
						<div class="card_box">
							<span class="details">Email</span>
								<input class="form_control" type="text" placeholder="Enter your Email" id="email" name="email" required>
						</div>
						<div class="card_box">
							<span class="details">Phone Number</span>
								<input class="form_control" type="number" placeholder="Enter your Phone Number" id="phonenumber" name="phonenumber" required>
						</div>
						<div class="card_box">
							<span class="details">Username</span>
								<input class="form_control" type="text" placeholder="Enter your Username" id="username" name="username" required>
						</div>	
						<div class="card_box">
							<span class="details">Password</span>
								<input class="form_control" type="password" placeholder="Enter your Password" id="password" name="password" required>
						</div>
						<div class="card_box">
							<span class="details">Confirm Password</span>
								<input class="form_control" type="password" placeholder="Confirm Password" id="conpassword" name="conpassword" required>
								<input type="hidden" name="usertype" value="user">
						</div>
						<div class="button">
							<input type="submit" value="Register" id="register" name="submit" class="btn">

						</div>
					</div>
				</form>
					<button id="back" onclick="gotologin()">
						<i class="fa-solid fa-arrow-left"></i>
					</button>
		</div>
<script>
	function gotologin(){
		window.location.assign('login.php');
	}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
</body>
</html>