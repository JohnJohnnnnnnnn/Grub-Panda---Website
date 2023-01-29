<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])){

?>
<?php
@include 'config.php';

if (isset($_POST['order_btn'])) {
	$name = $_POST['name'];
	$number = $_POST['number'];
	$email = $_POST['email'];
	$method = $_POST['method'];
	$flat = $_POST['flat'];
	$street = $_POST['street'];
	$subd = $_POST['subd'];
	$city = $_POST['city'];
	$state = $_POST['state'];
	$country = $_POST['country'];
	$pin_code = $_POST['pin_code'];

	$cart_query = mysqli_query($conn, "SELECT * FROM cart");
	$price_total = 0;
	if (mysqli_num_rows($cart_query) > 0) {
		while($product_item = mysqli_fetch_assoc($cart_query)){
			$product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .' )';
			$product_price = number_format($product_item['price'] * $product_item['quantity']);
			$price_total += $product_price;
		};
	};

	$total_product = implode(', ',$product_name);
	$detail_query = mysqli_query($conn, "INSERT INTO orders (name, number, email, method, flat, street, subd, city, state, country, pin_code, total_products, total_price) VALUES ('$name','$number','$email','$method','$flat','$street','$subd','$city','$state','$country','$pin_code','$total_product','$price_total')") or die('query failed');

	if ($cart_query && $detail_query) {
		echo "
	<div class='order-message-container'>
	<div class='message-container'>
		<h3>Thank You for Shopping!</h3>
		<div class='order-detail'>
			<span>".$total_product."</span>
			<span class='total'>Total : ₱".$price_total."</span>
		</div>
		<div class='customer-details'>
			<p> Your Name: <span>".$name."</span>.</p>
			<p> Your Number: <span>".$number."</span>.</p>
			<p> Your Email: <span>".$email."</span>.</p>
			<p> Your Address: <span>".$flat.",".$street.",".$subd.",".$city.",".$state.",".$country.",".$pin_code."</span> </p>
			<p> Your Payment Mode: ".$method."<span></span>.</p>
		</div>
			<a href='dashboard.php' class='btn'>Continue Ordering</a>
		</div>
	</div>

		";
		mysqli_query($conn, "DELETE FROM cart");
		
	}
	
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CHECKOUT | DASHBOARD | GRUB PANDA</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesadmin.css">
</head>
<body>
<?php
	include 'headerdash.php';
?>
<div class="container">
	<section class="checkout-form">
		<h1 class="heading">Complete Your Order</h1>
		<form action="" method="post">
		<div class="display-order">
			<?php 
				$select_cart = mysqli_query($conn, "SELECT * FROM cart");
				$total = 0;
				$grand_total = 0;
				if (mysqli_num_rows($select_cart) > 0) {
					while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
						$total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
						$grand_total = $total += $total_price;

			?>
			<span><?= $fetch_cart['name']; ?>(<?= $fetch_cart['quantity']; ?>)</span>
			<?php 
					}
					}else{
						echo "<div class = 'display-order'><span>Your Shopping Cart is Empty!</span></div>";
				};
			?>
			<span class="grand-total">Grand Total: ₱
<?= $grand_total; ?> </span>
		</div>
			<div class="flex">
				<div class="inputbox">
					<span>Your Name</span>
					<input type="text" placeholder="Enter Your Name" name="name" required>
				</div>
				<div class="inputbox">
					<span>Your Mobile/Telephone Number</span>
					<input type="number" placeholder="Enter Your Mobile/Telephone Number" name="number" required>
				</div>
				<div class="inputbox">
					<span>Your Email</span>
					<input type="email" placeholder="Enter Your Email" name="email" required>
				</div>
				<div class="inputbox">
					<span>Payment Method</span>
					<select name="method">
						<option value="cash on delivery" selected>Cash On Delivery</option>
						<option value="credit card">Credit Card</option>
						<option value="e-wallet">E-Wallet</option>
					</select>
				</div>
				<div class="inputbox">
					<span>Unit/Floor</span>
					<input type="text" placeholder="Enter your Unit/Floor No." name="flat" required>
				</div>
				<div class="inputbox">
					<span>Street/Building Name</span>
					<input type="text" placeholder="Enter Your Street/Building Name" name="street" required>
				</div>
				<div class="inputbox">
					<span>Barangay/Subdivision Name</span>
					<input type="text" placeholder="Enter Your Brgy./Subdivision Name" name="subd" required>
				</div>
				<div class="inputbox">
					<span>City</span>
					<input type="text" placeholder="Enter Your City Name" name="city" required>
				</div>
				<div class="inputbox">
					<span>State</span>
					<input type="text" placeholder="Enter Your State Name" name="state" required>
				</div>
				<div class="inputbox">
					<span>Country</span>
					<input type="text" placeholder="Enter Your Country Name" name="country" required>
				</div>
				<div class="inputbox">
					<span>Zip Code</span>
					<input type="number" placeholder="Enter Your Zip Code" name="pin_code" required>
				</div>
				<input type="submit" name="order_btn" value="Order Now" class="btn">
			</div>
		</form>
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