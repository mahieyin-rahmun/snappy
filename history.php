<title> Payment History </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php 
	$customerId = $_SESSION['customer_id'];
	$query = "SELECT * FROM `payment_history` WHERE customer_id=".$customerId." ORDER BY purchase_date DESC";
	$result = mysqli_query($conn, $query);
	$resultCheck = mysqli_num_rows($result);
	$msg = "";
	$msgClass = "";

	if($resultCheck <= 0) {
		$msg = "You have not made any purchases via Snappy yet!";
		$msgClass = "alert-info" ;
	}
?>
<div class="container">
    <div class="h3 text-center toprated"> This page contains the list of all your previous purchases made through Snappy. </div>
    
    <table class="table table-bordered">
    	<thead>
    		<tr>
    			<td> Order Number </td>
    			<td> Total Price </td>
    			<td> Purchased On </td>
    			<td> Delivered On </td>
    			<td> No. of Products </td>
    		</tr>
    	</thead>
    	<tbody>
    		<?php if(strlen($msg) != 0) : ?>
			        <div class ="text-center alert <?php echo $msgClass; ?>"> 
			            <?php echo $msg; ?>
			        </div> 
			<?php endif; ?>
    		<?php if($resultCheck > 0) {
					$rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    				foreach($rows as $row) { ?>
	    		<tr>
	    			<td> 
	    				<form method="POST" action="detailedhistory.php"> 
	    					<input type="submit" name="details" class="btn btn-info btn-large text-center" value="<?php echo $row['order_num'];	?>">
	    			 	</form> 
	    			</td>
	    			<td> BDT. <?php echo $row['total_price']; ?> </td>
	    			<td> <?php echo $row['purchase_date']; ?> </td>
	    			<td> <?php echo $row['delivery_date']; ?> </td>
	    			<td> <?php echo $row['no_of_products']; ?> </td>
	    		</tr>
	    	<?php }} ?>
    	</tbody>
    	
    </table>
</div>
<?php include('inc/footer2.php'); ?>