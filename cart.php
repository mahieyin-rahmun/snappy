<title> Shopping Cart </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php

	$msg = "";
	$msgClass = "";

	$cart = $_SESSION['cart'];
	$totalPrice = 0;

	if(isset($_POST['clear'])) {
		$shopCount = 0;
		$_SESSION['shop_count'] = $shopCount;
		$_SESSION['cart'] = array();
		header("Refresh:0");
	}

	if(isset($_POST['process'])) {
		if(sizeof($cart) == 0) {
			$msg = "No item added to cart!";
			$msgClass = "alert-danger";
		} else {
			header("Location: processtransaction.php");
		}
	}
?>

<title> Shopping Cart </title>
<div class="container">	
	<h1> Items Added: <?php echo $_SESSION['shop_count']; ?> </h1>

  	<p>You have added the following items to your cart: </p>            
	  <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th>Product ID</th>
	        <th>Product Name</th>
	        <th>Vendor Name</th>
	        <th>Quantity</th>
	        <th>Unit Price (BDT)</th>
	        <th> Total Price (BDT) </th>
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
	        <td> <a href="removeitem.php?pid=<?php echo $item['product_id']; ?>"> Remove </a> </td>
	      </tr>
	  <?php endforeach; ?>
	    </tbody>
	  </table>

	  <?php if(strlen($msg) != 0) : ?>
        <div class ="text-center alert <?php echo $msgClass; ?>"> 
            <?php echo $msg; ?>
        </div> 
      <?php endif; ?>

	  <h1 class="text-success text-right"> Total: BDT. <?php echo $totalPrice; ?>.00 </h1>

	<form method="POST" action="">
		<input style="display: inline-block; margin: 25px auto;" type="submit" class="btn btn-primary btn-lg" name="process" value="Check Out" />
		<input style="display: inline-block; margin: 25px auto; margin-left: 50px;" type="submit" class="btn btn-danger btn-lg"  name="clear" value="Clear Cart" />
	</form>
</div>

<?php include('inc/footer2.php'); ?>

