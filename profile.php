<title> Customer Profile </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
	$customerId = $_SESSION['customer_id'];

	$query = "SELECT concat(first_name, ' ', last_name) AS fullname, concat(housenum, ', ', roadnum, ', ', location, ', ', city) AS address, email, phone_number, gender FROM users WHERE customer_id =".$customerId;
	$result = mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($result);
?>
<div class="container">
<div>
	<h1 style="text-decoration: underline;"> Customer Information: </h1>

	<table class="table table-bordered">
	  	<thead>
	  		<tr>
		  		<th class="text-center text-uppercase">Customer ID</th>
		  		<th class="text-center text-uppercase">Customer Name</th>
		        <th class="text-center text-uppercase">Address</th>
		        <th class="text-center text-uppercase">Email</th>
		        <th class="text-center text-uppercase">Phone Number</th>
		        <th class="text-center text-uppercase">Gender</th>
		    </tr>
	  	</thead>
	  	<tbody class="text-center">
	  		<tr>
	  			<td style="font-weight: bold;"> <?php echo $customerId; ?> </td>
	  			<td> <?php echo $row['fullname']; ?> </td>
	  			<td> 
	  				<?php echo $row['address']; ?>
	  				<form method="POST" action="editprofile.php?edit=address"> 
	  					<input type="hidden" name="address" value="<?php echo $row['address']; ?>">
	  					<input type="submit" name="edit" value="Edit"> 
	  				</form>
	  			</td>
	  			<td> 
	  				<?php echo $row['email']; ?> 
	  				<form method="POST" action="editprofile.php?edit=email"> 
	  					<input type="hidden" name="email" value="<?php echo $row['email']; ?>">
	  					<input type="submit" name="edit" value="Edit"> 
	  				</form>
	  			</td>
	  			<td> 
	  				<?php echo $row['phone_number']; ?> 
	  				<form method="POST" action="editprofile.php?edit=phone"> 
	  					<input type="hidden" name="phone" value="<?php echo $row['phone_number']; ?>">
	  					<input type="submit" name="edit" value="Edit"> 
	  				</form>
	  			</td>
	  			<td> <?php echo $row['gender']; ?> </td>
	  		</tr>
	  	</tbody>
	  </table>

	  <h1 style="text-decoration: underline;"> Past Purchases: </h1>
	  <em style="font-size: 20px;"> You can view all the purchases you have made through Snappy by <a href="history.php"> clicking here. </a> </em> 
</div>
</div>

<?php include('inc/footer2.php'); ?>