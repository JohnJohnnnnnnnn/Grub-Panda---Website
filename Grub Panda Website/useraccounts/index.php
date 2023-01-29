<head>
	<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<?php
session_start();
require 'config.php';
	if(isset($_POST['username']) && isset($_POST['password'])){
		$username = $_POST["username"];
		$password = $_POST["password"];
		$sql = "SELECT * FROM users WHERE username = '$username'";
		$result = mysqli_query($conn,$sql);
		$row = mysqli_fetch_assoc($result);
		if ($row && $row["usertype"]==!''){
			if ($row["usertype"]=="user"){
				if(mysqli_num_rows($result) > 0){
					if($password == $row["password"]){
						$_SESSION['username'] = $row['username'];
						$_SESSION['firstname'] = $row['firstname'];
						$_SESSION['id'] = $row['id'];
						echo '<script type="text/javascript">
						$(document).ready(function(){
						swal.fire({
							icon: "success",
  							title: "Welcome User!",
  							text: "Login Successfully",
							}).then(function(){
								window.location = "dashboard.php";
								});
						})
					</script>';
					}
					else{
						echo '<script type="text/javascript">
						$(document).ready(function(){
						swal.fire({
							icon: "error",
  							title: "Oops...",
  							text: "Incorrect Username or Password",
							}).then(function(){
								window.location = "login.php";.222222
								});
						})
					</script>';
					}
				}	
			}
			else{
			if(mysqli_num_rows($result) === 1){
				if($password == $row["password"]){
					$_SESSION['username'] = $row['username'];
					$_SESSION['firstname'] = $row['firstname'];
					$_SESSION['id'] = $row['id'];
					echo '<script type="text/javascript">
					$(document).ready(function(){
					swal.fire({
						icon: "success",
  						title: "Welcome Admin!",
  						text: "Login Successfully",
						}).then(function(){
							window.location = "admin.php";
							});
					})
				</script>';
				}
				else{
					echo '<script type="text/javascript">
					$(document).ready(function(){
					swal.fire({
						icon: "error",
  						title: "Oops...",
  						text: "Incorrect Username or Password",
						}).then(function(){
							window.location = "login.php";
							});
					})
				</script>';
				}
			}
			}
		}
		else{
				echo '<script type="text/javascript">
				$(document).ready(function(){
					swal.fire({
						icon: "error",
  						title: "Oops...",
  						text: "Account Does Not Exist",
						}).then(function(){
							window.location = "login.php";
							});
					})
				</script>';
			}
	}
else{
	header("Location: login.php?error");
	exit();
}
?>