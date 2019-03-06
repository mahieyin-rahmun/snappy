<title> View Product </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php 
	$productID = $_GET['pid'];
	$customerId = $_SESSION['customer_id'];
	$msg = "";
	$msgClass = "";

	$shopCount = $_SESSION['shop_count'];

  	$categoryid = $_GET['cid'];

  	if($categoryid < 1 || $categoryid > 5) {
    	header("Location: browse.php?cid=1");
  	}

  	if(isset($_POST['addCart'])) {
    $cart = $_SESSION['cart'];
    $existingprodid = false;

    $productid = $_POST['hprodid'];

    if(!empty($cart)) {
      foreach ($cart as $item) {
        if($productid === $item['product_id']) {
          $existingprodid = true;
          break;
        }
      }
    }

    if(!$existingprodid) {
      $productname = $_POST['hprodname'];
      $vendorname = $_POST['hvendname'];
      $price = $_POST['hprodprice'];
      $qty = $_POST['quantity'];
      $instock = $_POST['hstock'];

      if($qty > $instock) {
        $msg = "Not enough products in stock as per quantity demanded!";
        $msgClass = "alert-danger";
      } else {
          $item = array(
              'product_id' => $productid,
              'product_name' => $productname,
              'vendor_name' => $vendorname,
              'product_qty' => $qty,
              'product_price' => $price
          );

          array_push($_SESSION['cart'], $item);
          $shopCount++;
          $_SESSION['shop_count'] = $shopCount;
          header("Refresh:0");
        }
      } else {
          $msg = "Item already exists in cart!";
          $msgClass = "alert-danger";
      }
  }

  if(isset($_POST['rate'])) {
    $rating = $_POST['rating'];
    $product_ID = $_POST['hprodid'];

    $query = "SELECT customer_id, product_id FROM product_rating WHERE customer_id = ".$customerId. " AND product_id = ".$product_ID;
      $result = mysqli_query($conn, $query);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0) {
        $query = "UPDATE `product_rating` SET `rating`= ".$rating. " WHERE customer_id = ".$customerId. " AND product_id = ".$product_ID;
        mysqli_query($conn, $query);

        $msg = "Rating Saved. Thank you for your feedback.";
        $msgClass = "alert-success";
      } else {
        $query = "INSERT INTO `product_rating`(`customer_id`, `product_id`, `rating`) VALUES ('$customerId','$product_ID', '$rating')";
        mysqli_query($conn, $query);

        $msg = "Rating Saved. Thank you for your feedback.";
        $msgClass = "alert-success";
      }
  }

	$sql = "SELECT * FROM products WHERE product_id = ".$productID;
	$result = mysqli_query($conn, $sql);

	$row = mysqli_fetch_assoc($result);


?>
<style type="text/css">
  #searchresult ul {
    opacity: 0.4;
    cursor: pointer;
  }

  #searchresult ul:hover {
    opacity: 1.0;
    cursor: pointer;
  }

  #searchresult ul li{
    font-family: monospace;
    font-size: 20px;
  }

  #searchresult ul li a{
    margin-left: 10px auto;
    text-decoration: none;
    color: black;
  }
</style>
<div class="container">
<div class="form-group">
  <div class="input-group">
    <span class="input-group-addon glyphicon glyphicon-search"> </span>
    <input type="text" id="search-text" name="search-text" style="margin-top: 2px; height:33px;" id="search-text" placeholder="Search by Product Name" class="form-control" />
  </div>
</div>
<div id="searchresult"></div>

<?php if(strlen($msg) != 0) : ?>
    <div class ="text-center alert <?php echo $msgClass; ?>">
        <?php echo $msg; ?>
    </div>
<?php endif; ?>

<div class="row">
<div class="col-xs-8 item-photo">
    <img style="border:1px solid gray; max-width:100%;" src="<?php echo $row['image_src'] ?>" />
</div>
<div class="col-xs-4" style="border:0px solid gray">
    <h3> <?php echo $row['product_name'] ?></h3>    
    <h4> Vendor: <?php 
    	$innerquery = "SELECT vendor_name FROM vendors WHERE vendor_id=".$row['v_id'];
    	$innerresult = mysqli_query($conn, $innerquery);
    	$innertuple = mysqli_fetch_assoc($innerresult);

    	echo $innertuple['vendor_name'];
    ?> </h4>
    <h4> Vendor ID: <?php echo $row['v_id']; ?> </h4>
    <h4> Size: <?php echo $row['size']; ?> </h4>
    <h4> Material: <?php echo $row['material']; ?> </h4>
    <h4> In Stock: <?php echo $row['quantity']; ?> </h4>

    <br>

    <h6 class="title-price">Price</h6>
    <h3 style="margin-top:0px;"><?php echo "BDT. ".$row['price'].".00"; ?></h3> 

    <form method="POST" action="productview.php?action=add&cid=<?php echo $row['category_id']?>&pid=<?php echo $row['product_id']; ?>">
    	<input class="form-control" style="display: inline-block; width: 70px" type="number" min="1" max="<?php echo $row['quantity']; ?>" name="quantity" value="1" />
        <input type="submit" name="addCart" class="btn btn-primary" id="addCart" value="Add To Cart" style="display: inline-block; margin-left: 20px;">

        <input type="hidden" name="hprodid" value="<?php echo $row['product_id']; ?>" />
        <input type="hidden" name="hprodname" value="<?php echo $row['product_name']; ?>" />
        <input type="hidden" name="hvendname" value="<?php echo $innertuple['vendor_name'] ?>" />
        <input type="hidden" name="hprodprice" value="<?php echo $row['price']; ?>" />
        <input type="hidden" name="hstock" value="<?php echo $row['quantity']; ?>" />
    </form>

    <form method="POST", action="productview.php?action=rate&cid=<?php echo $row['category_id']?>&pid=<?php echo $row['product_id']; ?>">
    <select class="form-control" name="rating" style="width: 70px; display: inline-block;">
        <option>1</option>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>5</option>
    </select>
    <input type="submit" name="rate" class="btn btn-danger" id="rate" value="Rate Product" style="display: inline-block; margin-left: 20px;" />
    <input type="hidden" name="hprodid" value="<?php echo $row['product_id']; ?>" />
  </form>  
</div>
</div>

<h2> <a href="browse.php?cid=<?php echo $categoryid ?>"> << Return to products page </a> </h2>
</div>

<!-- this script handles the search bar function and animations within it -->
<!-- AJAX has been used -->
<script>
  $(document).ready(function() {
    $('#search-text').keyup(function(event) { //when data is typed in the search bar
        var boxText = $(this).val(); //keep the typed content into this variable
        if(boxText != '') {
            $.ajax({ //ajax function
            url: 'fetchdata.php',
            method: 'POST',
            data: {search: boxText},
            success:function(data) {
              $('#searchresult').fadeIn();
              $('#searchresult').html(data);
            }
          }); 
        }

        if(boxText == '') {
          $('#searchresult').fadeOut(); //fade out the search results when nothing has been typed
        }
    });

    $(document).on('click', 'li', function() { //when user clicks on any of the results, hide the results and keep only the clicked data
      $('#search-text').val($(this).text());
      $('#searchresult').fadeOut();
    });
  });
</script>

<?php include('inc/footer2.php'); ?>