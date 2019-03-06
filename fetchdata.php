<?php 
require('configurations/database.php');

	$output = '';

	$sql = "SELECT product_id, category_id, product_name FROM products WHERE product_name LIKE '%".$_POST['search']."%'";
	$result = mysqli_query($conn, $sql);
	$resultCheck = mysqli_num_rows($result);
	$output = '<ul class="list-unstyled">';

	if($resultCheck > 0) {
		while($row = mysqli_fetch_array($result)) {
			$output .= '<li> <a href=productview.php?pid='.$row['product_id'].'&cid='.$row['category_id'].'>'.$row['product_name'].'</a> </li>';
		}

	} else {
		$output .= '<li>'.'Product Not Found!'.'</li>';
	}

	$output .= '</ul>';
	echo $output;
	
?>
