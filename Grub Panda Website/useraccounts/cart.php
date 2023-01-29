<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])){

?>
<?php 
@include 'config.php';

if (isset($_POST['update_update_btn'])) {
	$update_value = $_POST['update_quantity'];
	$update_id = $_POST['update_quantity_id'];
	$update_quantity_query = mysqli_query($conn, "UPDATE cart SET quantity= '$update_value' WHERE id = '$update_id'");
	if ($update_quantity_query) {
		header('location:cart.php');
	};
};

if (isset($_GET['remove'])) {
	$remove_id = $_GET['remove'];
	mysqli_query($conn, "DELETE FROM cart WHERE id = '$remove_id'");
	header('location:cart.php');
};

if (isset($_GET['delete_all'])) {
	mysqli_query($conn, "DELETE FROM cart");
	header('location:cart.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>SHOPPING CART | DASHBOARD | GRUB PANDA</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesadmin.css">
</head>
<body>
<?php
	include 'headerdash.php';
?>
<div class="container">
	<section class="shopping-cart">
		<h1 class="heading">Shopping Cart</h1>

		<table>
			<thead>
				<th>image</th>
				<th>name</th>
				<th>price</th>
				<th>quantity</th>
				<th>total price</th>
				<th>action</th>
			</thead>

			<tbody>
				<?php 
				$select_cart = mysqli_query($conn, "SELECT * FROM cart");
				$grand_total = 0;
				if (mysqli_num_rows($select_cart) > 0) {
					while ($fetch_cart = mysqli_fetch_assoc($select_cart)){
				?>
				<tr>
					<td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" alt="" height="100"></td>
					<td><?php echo $fetch_cart['name']; ?></td>
					<td>₱<?php echo number_format($fetch_cart['price']);?></td>
					<td>
						<form action="" method="post">
							<input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
							<input type="number" min="1" name="update_quantity" value="<?php echo $fetch_cart['quantity']; ?>">
							<input type="submit" name="update_update_btn" value="Update">
						</form>
					</td>
					<td>₱<?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']);?></td>
					<td><a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('Remove Item From Cart?')" class="delete-btn"><i class="fas fa-trash"></i>Remove</a></td>
				</tr>
				<?php
					$grand_total += $sub_total;
					};
				};
				?>
				<tr class="table-bottom">
					<td><a href="dashboard.php" class="option-btn" style="margin-top: 0;">Continue Ordering</a></td>
					<td colspan="3">Grand Total</td>
					<td>₱<?php echo $grand_total; ?></td>
					<td><a href="cart.php?delete_all" onclick="return confirm('Are you sure you want to delete all items?');" class="delete-btn"><i class="fas fa-trash"></i>Delete All</a></td>
				</tr>
			</tbody>
		</table>

		<div class="checkout-btn">
			<a href="checkout.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Proceed to Checkout</a>
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