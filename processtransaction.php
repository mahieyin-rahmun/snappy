<title> Confirm Purchase </title>

<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>
<?php

	$msg = "";
	$msgClass = "";
	$cart = $_SESSION['cart'];
	$customerid = $_SESSION['customer_id'];
	$bkash = "BKash";
	$cash = "Cash On Delivery";

	$query = "SELECT concat(first_name, ' ', last_name) AS fullname, concat(housenum, ', ', roadnum, ', ', location, ', ', city) AS address FROM users WHERE customer_id =".$customerid;
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);

	$totalPrice = 0;

	$keylength = 4;
	$str = "1234567890";
	$counterNumber = substr(str_shuffle($str), 0, $keylength);

	$orderDate = date("Y-m-d H:i");
	$deliveryDate = date("Y-m-d H:i", strtotime('+ 7 days'));
	$_SESSION['order_date'] = $orderDate;
	$_SESSION['delivery_date'] = $deliveryDate;

	$oD = preg_replace('/[^a-z0-9]+/i', '', $orderDate);
	$dD = preg_replace('/[^a-z0-9]+/i', '', $deliveryDate);
	
	$keylength = 15;
	$str = "1234567890".$oD.$dD;
	$orderId = "O-".$customerid."-".substr(str_shuffle($str), 0, $keylength);

	$_SESSION['order_id'] = $orderId;

	if(isset($_POST['confirm'])) {
		if(!isset($_POST['optradio'])) {
			$msg = "Please choose a payment option!";
			$msgClass = "alert-danger";
		} else {
			switch ($_POST['optradio']) {
				case "bkash":
					$_SESSION['payment_mode'] = $bkash;
					break;
				
				case "cashondelivery":
					$_SESSION['payment_mode'] = $cash;
					break;
			}
			header("Location: confirmtransaction.php");
		}

	}
?>

<title> Shopping Cart </title>
<div class="container">
	<h1> Items Added: <?php echo $_SESSION['shop_count']; ?> </h1>

  	<p>You have added the following items to your cart: </p>            
	  <table class="table table-bordered text-center">
	    <thead>
	      <tr>
	        <th class="text-center text-uppercase">Product ID</th>
	        <th class="text-center text-uppercase">Product Name</th>
	        <th class="text-center text-uppercase">Vendor Name</th>
	        <th class="text-center text-uppercase">Quantity</th>
	        <th class="text-center text-uppercase">Unit Price (BDT)</th>
	        <th class="text-center text-uppercase">Total Price (BDT) </th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php foreach ($cart as $item): ?>
	      <tr>
	        <td><?php echo $item['product_id']; ?></td>
	        <td><?php echo $item['product_name']; ?></td>
	        <td><?php echo $item['vendor_name']; ?></td>
	        <td><?php echo $item['product_qty']; ?></td>
	        <td><?php echo $item['product_price']; ?></td>
	        <td>
	        	<?php 
	        		$total = ($item['product_qty'] * $item['product_price']);
	        		$totalPrice = $totalPrice + $total;
	        		echo $total; 
	        	?>	        		
	        </td>
	      </tr>
	  <?php endforeach; ?>
	    </tbody>
	  </table>

	  <h1 class="text-success text-right"> Total: BDT. <?php echo $totalPrice; 
	  														 $_SESSION['total_price'] = $totalPrice;
	  													?>.00 </h1>

	  <!-- display shipping address -->
	  <h2> The items will be delivered to: </h2>
	  <table class="table table-bordered">
	  	<thead>
	  		<tr>
		  		<th class="text-center text-uppercase">Customer ID</th>
		  		<th class="text-center text-uppercase">Customer Name</th>
		        <th class="text-center text-uppercase">Address</th>
		    </tr>
	  	</thead>
	  	<tbody class="text-center">
	  		<tr>
	  			<td> <?php echo $customerid; ?> </td>
	  			<td> <?php echo $row['fullname']; ?> </td>
	  			<td> <?php echo $row['address']; ?> </td>
	  		</tr>
	  	</tbody>
	  </table>

	  <?php if(strlen($msg) != 0) : ?>
        <div class ="text-center alert <?php echo $msgClass; ?>"> 
            <?php echo $msg; ?>
        </div> 
      <?php endif; ?>

	  <!-- payment options -->
	  <h2> Choose A Payment Option Below: </h2>
	  <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
	  	<div class="radio">
		  <label id="bkash-label" class="h4"><input type="radio" id="bkash" name="optradio" value="bkash">BKash</label>
		</div>
		<div id="bkash-text" style="display: none;">
	  	<div class="jumbotron">
	  		<h3> Bkash Payment Procedures: </h3>
	  	</div>
		  	<div class="text-justify" style="border: 1px solid black; border-radius: 10px; margin-top: -31px; padding-left: 20px; ">
		 		<h5>
		 			<p> 01. Go to your bKash Mobile Menu by dialing *247# </p> </h5>
					<p> 02. Choose “Payment” </p>
					<p> 03. Enter the Merchant bKash Account Number: 01715253545 </p>
					<p> 04. Enter the amount you want to pay </p>
					<p> 05. Enter a reference* against your payment (you can mention the purpose of the transaction in one word. e.g. Bill) </p>
					<p> 06. Enter the Counter Number: <?php echo $counterNumber ?> </p>
					<p> 07. Now enter your bKash Mobile Menu PIN to confirm </p>
					<p> 08. Click "Confirm Purchase" button </p>
		 		</h5>
		  	</div>
		  </div>
		<div class="radio">
		  <label class="h4"><input type="radio" id="cash" name="optradio" value="cashondelivery">Cash On Delivery</label>
		</div>
		<div id="cash-text" style="display: none;">
			<div class="jumbotron">
	  			<h3> Cash On Delivery Procedures: </h3>
	  		</div>
	  		<div class="text-justify" style="border: 1px solid black; border-radius: 10px; margin-top: -31px; padding-left: 20px; ">
		 		<h5>
		 			<p> Our agents will go to the shipping address that you provided during registration.</p>
		 			<p> If you have changed your address/wish to review it, please update it in your profile before clicking <kbd>"Confirm Purchase"</kbd> button. </p>
		 			<p> <em> Snappy takes no responsibility for lost products due to wrong shipping addresses. </em> </p>
		 		</h5>
		  	</div>

		</div>
		<input style="margin-top: 50px; margin-bottom: 20px;" type="submit" class="btn btn-danger btn-lg" name="confirm" value="Confirm Purchase" />
	  </form>
	</div>
<!-- this script handles the animation when a radio box is selected -->
<script>
	$(document).ready(function() {
		$("#bkash").click(function(event) {
			$("#bkash-text").show(500);
		});

		$("#cash").click(function(event) {
			$("#cash-text").show(500);
		});
	});
</script>

<?php include('inc/footer2.php'); ?>