<title> Details </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
	if(empty($_POST)) {
		header("Location: history.php");
	}

	if(isset($_POST['sortprice'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location',  products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY t_price";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	} else if (isset($_POST['sortname'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY prod_name";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);		
	} else if (isset($_POST['sortvendor'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY vend_name";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	} else if (isset($_POST['sortvendorId'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY vend_id";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	} else if (isset($_POST['sortquantity'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY qty";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	} else if (isset($_POST['sortlocation'])) {
		$orderNum = $_POST['hordernum'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY vend_location";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);

	} else {
		$orderNum = $_POST['details'];

		$query = "SELECT products.product_name AS 'prod_name', vendors.vendor_id AS 'vend_id', vendors.vendor_name AS 'vend_name', vendors.location AS 'vend_location', products_ordered.quantity AS 'qty', products.price AS 'u_price', (products.price*products_ordered.quantity) AS 't_price' FROM products, vendors, products_ordered WHERE products.product_id = products_ordered.product_id AND products.v_id = vendors.vendor_id AND order_num = ". '"'. $orderNum. '"'. "ORDER BY prod_name";

		$result = mysqli_query($conn, $query);
		$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
	}
?>
<div class="container">
<div>
	<form class="form-inline" method="POST" action="#">
		<input type="hidden" name="hordernum" value="<?php if(empty($_POST['details'])) {print "".$_POST['hordernum'];}else{print "".$_POST['details'];}?>">
		<input class="btn btn-info text-center" type="submit" name="sortname" value="Sort By Product Name">
		<input class="btn btn-info text-center" type="submit" name="sortvendorId" value="Sort By Vendor ID">
		<input class="btn btn-info text-center" type="submit" name="sortvendor" value="Sort By Vendor Name">
		<input class="btn btn-info text-center" type="submit" name="sortlocation" value="Sort By Vendor Location">
		<input class="btn btn-info text-center" type="submit" name="sortquantity" value="Sort By Quantity">
		<input class="btn btn-info text-center" type="submit" name="sortprice" value="Sort By Total Price">
	</form>
</div>

<table class="table table-bordered">
    	<thead>
    		<tr style="font-weight: bold;">
    			<td> Product Name </td>
    			<td> Vendor ID </td>
    			<td> Vendor Name </td>
    			<td> Vendor Location </td>
    			<td> Quantity </td>
    			<td> Unit Price </td>
    			<td> Total Price </td>
    		</tr>
    	</thead>
    	<tbody>
    		<?php foreach ($rows as $row): ?>
    			<tr>
    				<td> <?php echo $row['prod_name']; ?> </td>
    				<td> <?php echo $row['vend_id']; ?> </td>
    				<td> <?php echo $row['vend_name']; ?> </td>
    				<td> <?php echo $row['vend_location']; ?> </td>
    				<td> <?php echo $row['qty']; ?> </td>
    				<td> BDT. <?php echo $row['u_price']; ?> </td>
    				<td> BDT. <?php echo $row['t_price']; ?> </td>
    			</tr>
    		<?php endforeach; ?>	
    	</tbody>
</table>

<a class="h3 text-danger" href="history.php" style="margin: 20px auto;"> << Return to previous page </a>
</div>
<?php include('inc/footer2.php'); ?>