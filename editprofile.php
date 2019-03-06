<title> Edit Information </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
	$msg = "";
	$msgClass = "";

	
	$customerId = $_SESSION['customer_id'];
	if(strlen($_SESSION['errors']) > 0) {
		$msg = $_SESSION['errors'];
		$msgClass = "alert-danger";
	}
?>

<?php if(strlen($msg) != 0) : ?>
        <div class ="text-center alert <?php echo $msgClass; ?>"> 
            <?php echo $msg; ?>
        </div> 
<?php endif; ?>

<?php 
	if($_GET['edit'] == "address") {
		$query = "SELECT housenum, roadnum, location, city FROM USERS WHERE customer_id =".$customerId;
		$result = mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($result);
?>
<div class="container">
	<div style="width: 30%; margin: 0 auto;">
		<h3> Edit Address: </h3>

		<form method="POST" action="update.php?value=address">
			<label> House Number: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="housenumber" value="<?php echo $row['housenum']; ?>">
			<label> Road Number: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="roadnumber" value="<?php echo $row['roadnum']; ?>">
			<label> Location: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="elocation" value="<?php echo $row['location']; ?>">
			<label> City: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="ecity" value="<?php echo $row['city']; ?>">
			<input type="submit" style="margin-top: 25px;" name="update" value="Update" class="btn btn-lg btn-danger">
		</form>
	</div>
	<?php } ?>

	<?php 
	if($_GET['edit'] == "email") {
?>
	<div style="width: 30%; margin: 0 auto;">
		<h3> Edit Email: </h3>

		<form method="POST" action="update.php?value=email">
			<label> New Email: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="eemail" value="">
			<input type="submit" style="margin-top: 25px;" name="update" value="Update" class="btn btn-lg btn-danger">
		</form>
	</div>
	<?php } ?>

	<?php 
	if($_GET['edit'] == "phone") {
?>
	<div style="width: 30%; margin: 0 auto;">
		<h3> Edit Phone: </h3>

		<form method="POST" action="update.php?value=phone">
			<label> New Phone Number: </label>
			<input type="text" class="form-control" style="margin-bottom: 25px; width: 350px;" name="ephone" value="">
			<input type="submit" style="margin-top: 25px;" name="update" value="Update" class="btn btn-lg btn-danger">
		</form>
	</div>
	<?php } ?>
</div>
<?php include('inc/footer2.php'); ?>