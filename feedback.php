<title> Rate Vendors </title>
<?php include('inc/logged-in-header.php'); ?>

<?php
	$msg = "";
	$msgClass = "";


	$customerId = $_SESSION['customer_id'];

	$query = "SELECT products.v_id AS 'v_id', vendors.vendor_name AS 'v_name', vendors.location AS 'loc' FROM payment_history JOIN products_ordered ON payment_history.order_num = products_ordered.order_num, products, vendors WHERE customer_id = ".'"'.$customerId. '"'. " AND products_ordered.product_id = products.product_id AND products.v_id = vendors.vendor_id GROUP BY vendors.vendor_name ORDER BY vendors.vendor_name";

	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);

	if($resultCheck <= 0) {
		$msg="You haven't made purchases from any vendors yet!";
		$msgClass = "alert-info";
	}

	if(isset($_POST['rate'])) {
		$rating = $_POST['vendorrating'];

		if($rating < 1 || $rating > 5) {
			$msg = "Invalid rating. Please put a rating within the range 1-5!";
			$msgClass = "alert-danger";
		} else {
			$vendorId = $_POST['vendorid'];

			$query = "SELECT c_id, v_id FROM vendor_rating WHERE c_id = ".$customerId. " AND v_id = ".$vendorId;
			$result = mysqli_query($conn, $query);
			$resultCheck = mysqli_num_rows($result);

			if($resultCheck > 0) {
				$query = "UPDATE `vendor_rating` SET `rating`= ".$rating. " WHERE c_id = ".$customerId. " AND v_id = ".$vendorId;
				mysqli_query($conn, $query);

				$msg = "Rating Saved. Thank you for your feedback.";
				$msgClass = "alert-success";
			} else {
				$query = "INSERT INTO `vendor_rating`(`c_id`, `v_id`, `rating`) VALUES ('$customerId','$vendorId', '$rating')";
				mysqli_query($conn, $query);

				$msg = "Rating Saved. Thank you for your feedback.";
				$msgClass = "alert-success";
			}
		}
	}

?>
<div class="container">
<div>
	<?php if(strlen($msg) != 0) : ?>
        <div class ="text-center alert <?php echo $msgClass; ?>">
            <?php echo $msg; ?>
        </div>
    <?php endif; ?>

	<h3> These are the vendors you have made purchases from so far: </h3>

	<table class="table table-bordered table-hover">
		<thead class="text-center" style="font-weight: bold;">
			<tr>
				<td> Vendor ID </td>
				<td> Vendor Name</td>
				<td> Vendor Location </td>
				<td> Rate The Vendor (out of 5) </td>
			</tr>
		</thead>
		<tbody class="text-center">
			<?php
				$query = "SELECT products.v_id AS 'v_id', vendors.vendor_name AS 'v_name', vendors.location AS 'loc' FROM payment_history JOIN products_ordered ON payment_history.order_num = products_ordered.order_num, products, vendors WHERE customer_id = ".'"'.$customerId. '"'. " AND products_ordered.product_id = products.product_id AND products.v_id = vendors.vendor_id GROUP BY vendors.vendor_name ORDER BY vendors.vendor_name";
				$result = mysqli_query($conn, $query);
				$resultCheck = mysqli_num_rows($result);
				if($resultCheck > 0) {
				$results = mysqli_fetch_all($result, MYSQLI_ASSOC);
			?>
			<?php foreach($results as $result): ?>
				<tr>
					<td> <?php echo $result['v_id']; ?> </td>
					<td> <?php echo $result['v_name']; ?> </td>
					<td> <?php echo $result['loc']; ?> </td>
					<td>
						<form class="form-inline" method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
							<select class="form-control" name="vendorrating" style="width: 70px; display: inline-block; margin-left: 5px;">
		                        <option>1</option>
		                        <option>2</option>
		                        <option>3</option>
		                        <option>4</option>
		                        <option>5</option>
		                    </select>
							<input type="hidden" name="vendorid" value="<?php echo $result['v_id']; ?>">
							<input type="submit" style="display: inline-block;" class="btn btn-warning" name="rate" value="Rate">
						</form>
					</td>
				</tr>
			<?php endforeach; } ?>
		</tbody>
	</table>
</div>
</div>
<?php include('inc/footer2.php')?>
