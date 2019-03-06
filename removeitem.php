<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
	$oldcart = $_SESSION['cart'];
	if(sizeof($oldcart) == 1) {
		$shopCount = $_SESSION['shop_count'];
		if($shopCount > 0)
			$shopCount -= 1;
	    else
	    	$shopCount = 0;
		$_SESSION['cart'] = array();
		$_SESSION['shop_count'] = $shopCount;
	} else {
		$shopCount = $_SESSION['shop_count'];
		$pid = $_GET['pid'];
		$index = 0;

		foreach ($oldcart as $item) {
			if($item['product_id'] === $pid) {
				break;
			} else {
				$index++;
			}
		}

		unset($oldcart[$index]);
		if($shopCount > 0)
			$shopCount -= 1;
	    else
	    	$shopCount = 0;
		$_SESSION['shop_count'] = $shopCount;
		$newCart = array_values($oldcart);
		$_SESSION['cart'] = $newCart;
		
	}
	
	header("Location: cart.php");
?>