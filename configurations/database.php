<?php
	
	$conn = mysqli_connect('localhost', 'root', '', 'cse311onlineshop');

	if(mysqli_connect_errno()) {
		echo "Failed to connect to the database server.". mysqli_connect_errno();
	}
?>