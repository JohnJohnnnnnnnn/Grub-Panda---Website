<head>
	<script src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
	<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])){

?>
<?php

@include 'config.php';

if(isset($_POST['add_product'])){
	$p_name = $_POST['p_name'];
	$p_price = $_POST['p_price'];
	$p_image = $_FILES['p_image']['name'];
	$p_image_tmp_name = $_FILES['p_image']['tmp_name'];
	$p_image_folder = 'uploaded_img/'.$p_image;
	$duplicate = mysqli_query($conn, "SELECT * FROM products WHERE name = '$p_name' OR
		image = '$p_image'");
	if(mysqli_num_rows($duplicate) > 0){
		echo '<script type="text/javascript">
				$(document).ready(function(){
					swal.fire({
						icon: "error",
  						title: "Product Already Exist",
  						width: "500px",
  						height: "500px"
						}).then(function(){
							window.location = "admin.php";
							});
					})
				</script>';
	}else{
		$insert_query = "INSERT INTO products VALUES('','$p_name','$p_price','$p_image')";
		mysqli_query($conn,$insert_query) or die('query failed');
		if ($insert_query) {
			move_uploaded_file($p_image_tmp_name, $p_image_folder);
			echo '<script type="text/javascript">
				$(document).ready(function(){
				swal.fire({
					position: "center",
  					icon: "success",
  					title: "Product Added Successfully",
  					showConfirmButton: false,
  					timer: 1500
					}).then(function(){
						window.location = "admin.php";
						});
					})
				</script>';
		}else{
			echo "<script>
			alert('Product not successfully');
			</script>";
		}	
	}
};
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ADMIN | GRUB PANDA</title>

	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesadmin.css">


</head>
<body>
<?php
	include 'header.php';
?>
<div class="container">
	<section>
		<form action="" method="post" class="add_product_form" enctype="multipart/form-data">
			<h3>Add A New Product</h3>
			<input type="text" name="p_name" placeholder="Enter The Product Name" class="box" required>
			<input type="number" name="p_price" placeholder="Enter The Product Price" class="box" required>
			<input type="file" name="p_image" accept="image/png, image/jpg, image/jpeg" class="box" required>
			<input type="submit" value="Add Product" name="add_product" class="btn">
		</form>
	</section>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>

<?php 
}else{
	header("Location: login.php?error");
	exit();
}
?>
