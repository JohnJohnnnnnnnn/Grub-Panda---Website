<?php 
require 'config.php';
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>GRUB PANDA | LOGIN PAGE</title>
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css">
	<script src="https://kit.fontawesome.com/abfb78afe4.js" crossorigin="anonymous"></script>
	<link rel="stylesheet" type="text/css" href="css/styles.css">
</head>
<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="img/logo.png" class="brand_logo" alt="Grub Panda Logo">
					</div>
				</div>
			<div class="d-flex justify-content-center form_container">
				<form class="" action="index.php" method="post" autocomplete="off">
					<div class="input-group mb-3">
						<div class="input-group-append">
							<span class="input-group-text">
							<i class="fa-solid fa-user-large"></i>
							</span>
						</div>
						<input type="text" name="username" id="username" class="form-control" required value="">	
						</input>
					</div>
					<div class="input-group mb-2">
						<div class="input-group-append">
							<span class="input-group-text">
							<i class="fa-solid fa-key"></i>
							</span>
						</div>
						<input type="password" name="password" id="password" class="form-control input_pass" required value="">
					</div>
					<div class="form-group">
						<div class="forgot">
							<a href="#" style="color: white;">Forgot Password?</a>
						</div>
					</div>
			</div>
			<div class="d-flex justify-content-center mt-3 login-container">
				<button type="submit" name="submit" class="btn login_btn">Login</button>
			</div>
				</form>
			<div class="mt-4">
				<div class="d-flex justify-content-center links">
					Don't have an Account?<a href="registration.php" class="m1-2">Sign Up</a>
				</div>
			</div>
		</div>
	</div>
<script src="https://code.jquery.com/jquery-3.6.1.min.js" 
			integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" 
			crossorigin="anonymous">	
</script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"></script>

</body>
</html>