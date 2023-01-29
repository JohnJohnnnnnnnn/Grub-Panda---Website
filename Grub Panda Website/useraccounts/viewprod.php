<?php 
session_start();
if (isset($_SESSION['id']) && isset($_SESSION['username'])){

?>
<?php
	@include 'config.php';
	if(isset($_GET['delete'])){
		$delete_id = $_GET['delete'];
		$delete_query = mysqli_query($conn, "DELETE FROM products WHERE id = $delete_id") or die('query failed');
		if ($delete_query) {
			echo "<script>alert('Product Delete Successfully');
				window.location.assign('viewprod.php');
			</script>";
		}else{
			echo "<script>alert('Product Delete Successfully');
				window.location.assign('viewprod.php');
			</script>";
		};
	};

if (isset($_POST['update_product'])) {
	$update_p_id = $_POST['update_p_id'];
	$update_p_name = $_POST['update_p_name'];
	$update_p_price = $_POST['update_p_price'];
	$update_p_image = $_FILES['update_p_image']['name'];
	$update_p_image_tmp_name = $_FILES['update_p_image']['tmp_name'];
	$update_p_image_folder = 'uploaded_img/'.$update_p_image;

	$update_query = mysqli_query($conn, "UPDATE products SET name = '$update_p_name', price = '$update_p_price', image = '$update_p_image' WHERE id = '$update_p_id'");
	if ($update_query) {
		move_uploaded_file($update_p_image_tmp_name, $update_p_image_folder);
		echo "<script>alert('Product Update Success');
				window.location.assign('viewprod.php');
			</script>";
	}else{
		echo "<script>alert('Product Update Not Success');</script>";
	}

}
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
<section class="display-product-table">
	<table>
		<thead>
			<th>Product Image</th>
			<th>Product Name</th>
			<th>Product Price</th>
			<th>Action</th>
		</thead>
		<tbody>
			<?php

				$select_products = mysqli_query($conn, "SELECT * FROM products");
				if(mysqli_num_rows($select_products) > 0){
					while($rows = mysqli_fetch_assoc($select_products)){	
			?>

			<tr>
				<td><img src="uploaded_img/<?php echo $rows['image']; ?>" height="100" alt=""></td>
				<td><?php echo $rows['name']; ?></td>
				<td>₱<?php echo $rows['price']; ?></td>
				<td>
					<a href="viewprod.php?edit=<?php echo $rows['id']; ?>" class="option-btn"><i class="fas fa-edit"></i>Update</a><br>
					<a href="viewprod.php?delete=<?php echo $rows['id']; ?>" class="delete-btn" onclick="return confirm('Are You Sure Your Want To Delete This Item?');"><i class="fas fa-trash"></i>Delete</a>
				</td>
			</tr>

			<?php
					};
				}else{
					echo "<div class = 'empty'>No Product Added</div>";	
				}

			?>
		</tbody>

	</table>
	
</section>
<section class="edit-form-container">
<?php
	if (isset($_GET['edit'])) {
		$edit_id = $_GET['edit'];
		$edit_query = mysqli_query($conn, "SELECT * FROM products WHERE id = $edit_id");
		if (mysqli_num_rows($edit_query) > 0) {
			while ($fetch_edit = mysqli_fetch_assoc($edit_query)) {
?>
	<form action="" method="post" enctype="multipart/form-data">
		<img src="uploaded_img/<?php echo $fetch_edit['image']; ?>" height="200" alt="">
		<input type="hidden" name="update_p_id" value="<?php echo $fetch_edit['id']; ?>">
		<input type="text" class="box" required name="update_p_name" value="<?php echo $fetch_edit['name']; ?>">
		<input type="number" min="0" class="box" required name="update_p_price" value="<?php echo $fetch_edit['price']; ?>">
		<input type="file" class="box" required name="update_p_image" accept="image/png, image/jpg, image/jpeg">
		<input type="submit" name="update_product" value="Update The Product" class="option-btn">
		<input type="reset" value="Cancel" id="close-edit" class="btn">
	</form>

	<?php 
			};
		};
		echo "<script>document.querySelector('.edit-form-container').style.display = 'flex';</script>";
	};
	?>
</section>

<script>
	function gotoview(){
		window.location.assign('viewprod.php');
	}
</script>
<script type="text/javascript" src="js/script.js"></script>
</body>
</html>
<?php 
}else{
	header("Location: login.php?error");
	exit();
}
?>