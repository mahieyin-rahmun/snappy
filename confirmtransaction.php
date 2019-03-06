<title> Purchase Successful </title>

<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
	$cart = $_SESSION['cart'];

	if(sizeof($cart) > 0) {
		$_SESSION['previous_order_details'] = array();

		$itemsOrdered = sizeof($_SESSION['cart']);
		$customerId = $_SESSION['customer_id'];
		$orderId = $_SESSION['order_id'];
		$orderDate = $_SESSION['order_date'];
		$deliveryDate = $_SESSION['delivery_date'];
		$totalPrice = $_SESSION['total_price'];
		$mode = $_SESSION['payment_mode'];

		$previousOrder = array(
			'porder_id' => $orderId,
			'ppayment_mode' => $mode,
			'porder_date' => $orderDate,
			'pdelivery_date' => $deliveryDate,
			'pitems_ordered' => $itemsOrdered,
			'ptotal_price' => $totalPrice
		);

		array_push($_SESSION['previous_order_details'], $previousOrder);
		
		$query = "INSERT INTO `payment_history`(`customer_id`, `order_num`, `total_price`, `purchase_date`, `delivery_date`, `no_of_products`) VALUES ('$customerId', '$orderId', '$totalPrice', '$orderDate', '$deliveryDate', '$itemsOrdered')";
		
		if(strlen($orderId) > 0) {
			mysqli_query($conn, $query);
		}

		foreach($cart as $item) {
			$query = "INSERT INTO `products_ordered`(`order_num`, `product_id`, `quantity`) VALUES ('$orderId', '{$item['product_id']}', '{$item['product_qty']}')";
			mysqli_query($conn, $query);
		}
		

		foreach ($cart as $item) {
			$query = "SELECT quantity FROM products WHERE product_id=".$item['product_id'];
			$result = mysqli_query($conn, $query);
			$row = mysqli_fetch_assoc($result);
			$oldQty = $row['quantity'];
			$newQty = $oldQty - $item['product_qty'];
			if($newQty < 0) {
				$newQty = 0;
			}

			$query = "UPDATE `products` SET `quantity`= {$newQty} WHERE product_id =".$item['product_id'];
			mysqli_query($conn, $query);
		}
		
		$_SESSION['order_id'] = "";
		$_SESSION['payment_mode'] = "";
		$_SESSION['order_date'] = "";
		$_SESSION['delivery_date'] = "";
		$_SESSION['cart'] = array();
		$_SESSION['total_price'] = 0;
		$_SESSION['shop_count'] = 0;
		header("Refresh:0");
	}

?>

<div class="container">
<div class="h1 text-success text-center">
	Congratulations!	
</div>
<div style="width: 50%; margin: 0 auto; font-size: 25px; border-radius: 15px; border: 2px solid black; padding: 5px;">
	<?php foreach($_SESSION['previous_order_details'] as $details):	?>
		Order ID: <?php echo $details['porder_id']; ?>
		<br>
		Order Date: <?php echo $details['porder_date']; ?>
		<br>
		Probable Delivery Date: <?php echo $details['pdelivery_date']; ?>
		<br>
		Items ordered: <?php echo $details['pitems_ordered']; ?>
		<br>
		Total Price: BDT. <?php echo $details['ptotal_price']; ?>
		<br>
		Selected Payment Mode: <?php echo $details['ppayment_mode']; ?>
	<?php endforeach; ?>
</div>

<div class="text-info" style="width: 50%; margin: 0 auto; margin-top: 30px; font-size: 20px;">
	Please refer to your provided email address for further instructions. <br> <a href="home.php"> Click Here </a> to return to homepage.
</div>
</div>

<?php include('inc/footer2.php'); ?>