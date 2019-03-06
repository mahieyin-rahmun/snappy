<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php 
	$customerId = $_SESSION['customer_id'];
	$_SESSION['errors'] = "";

	if($_GET['value'] == "address") {
		$updatedHouse = $_POST['housenumber'];
		$updatedRoad = $_POST['roadnumber'];
		$updatedLocation = $_POST['elocation'];
		$updatedCity = $_POST['ecity'];

		$query = "UPDATE `users` SET `housenum`='$updatedHouse',`roadnum`='$updatedRoad',`location`='$updatedLocation',`city`='$updatedCity' WHERE customer_id = ".$customerId;
		mysqli_query($conn, $query);
		Header("Location: profile.php");

	} else if ($_GET['value'] == "email") {
		$updatedEmail = $_POST['eemail'];
		if(filter_var($updatedEmail, FILTER_VALIDATE_EMAIL) == false) {
			$_SESSION['errors'] = "Invalid Email!";
			Header("Location: editprofile.php?edit=email");
		} else {
			$query = "UPDATE `users` SET `email`='$updatedEmail' WHERE customer_id = ".$customerId;
			mysqli_query($conn, $query);
			$_SESSION['errors'] = "";
			Header("Location: profile.php");
		}
	} else if ($_GET['value'] == "phone") {
		$updatedPhone = $_POST['ephone'];
		if(!is_numeric($updatedPhone) || strlen($updatedPhone) != 11) {
			$_SESSION['errors'] = "Invalid Phone Number!";
			Header("Location: editprofile.php?edit=phone");
		} else {
			$query = "UPDATE `users` SET `phone_number`='$updatedPhone' WHERE customer_id = ".$customerId;
			mysqli_query($conn, $query);
			$_SESSION['errors'] = "";
			Header("Location: profile.php");
		}
	}
?>

<?php include('inc/footer.php'); ?>