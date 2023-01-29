<?php
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])){
?>

<?php 
	@include 'config.php';

if (isset($_POST['add_to_cart'])) {
	$product_name = $_POST['product_name'];
	$product_price = $_POST['product_price'];
	$product_image = $_POST['product_image'];
	$product_quantity = 1;

	$select_cart = mysqli_query($conn, "SELECT * FROM cart WHERE name = '$product_name'");
	if (mysqli_num_rows($select_cart) > 0) {
		echo "<script>alert('Product Already Added to Cart!');</script>";
	}else{
		$insert_product = mysqli_query($conn, "INSERT INTO cart (name,price,image,quantity) VALUES ('$product_name','$product_price','$product_image','$product_quantity')");
		echo "<script>alert('Product Added to Cart!');</script>";
	}


}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesadmin.css">
	<title>DASHBOARD | GRUB PANDA</title>
</head>
<body>
<?php 
	include 'headerdash.php';
?>

<div class="container">
	<section class="products">
		<h1 class="heading">Latest Food Added</h1>
		<div class="box-container">
			<?php 
			$select_products = mysqli_query($conn, "SELECT * FROM products");
			if (mysqli_num_rows($select_products) > 0) {
				while($fetch_product = mysqli_fetch_assoc($select_products)){
			?>
			<form action="" method="post">
				<div class="box">
					<img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
					<h3><?php echo $fetch_product['name'];?></h3>
					<div class="price">₱<?php echo $fetch_product['price'];?></div>
					<input type="hidden" name="product_name" value="<?php echo $fetch_product['name'];?>">
					<input type="hidden" name="product_price" value="<?php echo $fetch_product['price'];?>">
					<input type="hidden" name="product_image" value="<?php echo $fetch_product['image'];?>">
					<input type="submit" class="btn" name="add_to_cart" value="Add To Cart">
				</div>
			</form>
			<?php 
				};
			};
			?>
		</div>
	</section>
</div>








<script type="text/javascript" src="js/script.js"></script>
</body>
</html>

<?php
}else{
	header("Location: login.php?error");
	exit();
}
?>