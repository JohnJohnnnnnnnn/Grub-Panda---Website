<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>CONFIRMATION | CHECKOUT | GRUBPANDA</title>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="css/stylesadmin.css">
</head>
<body>
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
			<p> Your Address: <span>".$flat.",".$street.",".$city.",".$state.",".$country.",".$pin_code."</span> </p>
			<p> Your Payment Mode: ".$method."<span></span>.</p>
		</div>
			<a href='dashboard.php' class='btn'>Continue Ordering</a>
		</div>
	</div>

<script type="text/javascript" src="js/script.js"></script>
</body>
</html>