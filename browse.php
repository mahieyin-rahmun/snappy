<title> Browse Products </title>
<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php
  $msg = "";
  $msgClass = "";


  $customerId = $_SESSION['customer_id'];

  $shopCount = $_SESSION['shop_count'];

  $categoryid = $_GET['cid'];

  if($categoryid < 1 || $categoryid > 5) {
    header("Location: browse.php?cid=1");
  }

    $query = "SELECT product_id, category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id WHERE category_id=".$categoryid. " ORDER BY products.product_name";
    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
      $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }

  if(isset($_POST['sortbyprice'])) {
      $query = "SELECT product_id, category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id WHERE category_id=".$categoryid. " ORDER BY products.price";

      $result = mysqli_query($conn, $query);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }

  } else if (isset($_POST['sortbyvendorname'])) {
      $query = "SELECT product_id, category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id WHERE category_id=".$categoryid. " ORDER BY vendors.vendor_name";
      $result = mysqli_query($conn, $query);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }

  } else if (isset($_POST['sortbysize'])) {
      $query = "SELECT product_id, category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id WHERE category_id=".$categoryid. " ORDER BY products.size";
      $result = mysqli_query($conn, $query);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }

  } else if (isset($_POST['sortbymaterial'])) {
      $query = "SELECT product_id, category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id WHERE category_id=".$categoryid. " ORDER BY products.material";
      $result = mysqli_query($conn, $query);
      $resultCheck = mysqli_num_rows($result);

      if($resultCheck > 0) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
      }

  } else if (isset($_POST['sortbyrating'])) {
    $query = "SELECT products.product_id, ROUND(AVG(product_rating.rating),1) AS 'Rating', category_id, product_name, price, vendor_name, quantity, material, size, image_src FROM products JOIN vendors ON vendors.vendor_id = products.v_id, product_rating WHERE category_id=".$categoryid." AND products.product_id = product_rating.product_id GROUP BY products.product_id ORDER BY Rating DESC";

    $result = mysqli_query($conn, $query);
    $resultCheck = mysqli_num_rows($result);

    if($resultCheck > 0) {
        $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
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

?>

<link rel="stylesheet" type="text/css" href="css/browse.css">
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
    <div style="margin-bottom: 20px;"">
      <ul class="nav nav-pills">
        <li role="presentation"><a href="browse.php?cid=1">Watches</a></li>
        <li role="presentation"><a href="browse.php?cid=2">Shirts</a></li>
        <li role="presentation"><a href="browse.php?cid=3">Trousers</a></li>
        <li role="presentation"><a href="browse.php?cid=4">Bags</a></li>
        <li role="presentation"><a href="browse.php?cid=5">Shoes</a></li>
      </ul>
    </div>


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

    <form class="form-inline" method="POST", action="browse.php?cid=<?php echo $_GET['cid']?>">
      <input type="submit" class="btn btn-info" name="sortbyname" value="Sort By Product Name" href="browse.php?cid=1" >
      <input type="submit" class="btn btn-info" name="sortbyprice" value="Sort By Price" >
      <input type="submit" class="btn btn-info" name="sortbyvendorname" value="Sort By Vendor" >
      <input type="submit" class="btn btn-info" name="sortbysize" value="Sort By Size" >
      <input type="submit" class="btn btn-info" name="sortbymaterial" value="Sort By Material" >
      <input type="submit" class="btn btn-info" name="sortbyrating" value="Sort By Rating" >
      <label class="text-center"> Note: Some products may not show up if sorted by <em> Rating </em> , when customers are yet to rate them. </label>
    </form>

      <div class="row">
      <?php foreach ($products as $product) : ?>

            <div class="col-lg-4 col-md-6 mb-4">
              <div class="card h-100" >
                <form method="POST" action="browse.php?action=add&cid=<?php echo $product['category_id']?>&pid=<?php echo $product['product_id']; ?>">
                <img class="card-img-top" style="width: 700px; height: 650px; margin-left: 20px;" src="<?php echo $product['image_src']; ?>" alt="">
                <div class="card-body">
                  <h4 class="card-title" style="margin-left: 5px;">
                    <p class="text-uppercase"> <a style="color: black; font-size: 20px;" href="productview.php?pid=<?php echo $product['product_id'];?>&cid=<?php echo $product['category_id']?>"> <?php echo $product['product_name']; ?> </a> </p>
                  </h4>
                  <h5 style="margin-left: 5px;">BDT. <?php echo $product['price']; ?></h5>
                  <p style="margin-left: 5px;" class="card-text">Vendor: <?php echo $product['vendor_name']; ?> </p>
                  <p style="margin-left: 5px;" class="card-text">Rating:
                    <?php
                      $prod_ID = $product['product_id'];

                      $innerquery = "SELECT products.product_id, ROUND(AVG(product_rating.rating),1) AS 'rating' FROM products, product_rating WHERE category_id=".$categoryid. " AND products.product_id =".$prod_ID." AND product_rating.product_id =".$prod_ID;
                      $innerresult = mysqli_query($conn, $innerquery);
                      $row = mysqli_fetch_assoc($innerresult);

                      if($row['rating'] === NULL) {
                        echo "No Rating Available";
                      } else {
                        echo $row['rating']."/5.0";
                      }
                    ?>
                  </p>
                  <p style="margin-left: 5px;" class="card-text">Size: <?php echo $product['size']; ?></p>
                  <p style="margin-left: 5px;" class="card-text">Material: <?php echo $product['material']; ?></p>
                  <p class="card-text" style="display: inline-block; margin-left: 5px;"> Order Quantity:
                      <input class="form-control" style="display: inline-block; width: 70px" type="number" min="1" max="<?php echo $product['quantity']; ?>" name="quantity" value="1" />
                      <input type="submit" name="addCart" class="btn btn-primary" id="addCart" value="Add To Cart" style="display: inline-block; margin-left: 20px;">
                  </p>
                </div>
                    <input type="hidden" name="hprodid" value="<?php echo $product['product_id']; ?>" />
                    <input type="hidden" name="hprodname" value="<?php echo $product['product_name']; ?>" />
                    <input type="hidden" name="hvendname" value="<?php echo $product['vendor_name']; ?>" />
                    <input type="hidden" name="hprodprice" value="<?php echo $product['price']; ?>" />
                    <input type="hidden" name="hstock" value="<?php echo $product['quantity']; ?>" />
                </form>
                <div class="card-footer">
                  <form method="POST", action="browse.php?action=rate&cid=<?php echo $product['category_id']?>">
                    <select class="form-control" name="rating" style="width: 70px; display: inline-block; margin-left: 5px;">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <input type="submit" name="rate" class="btn btn-danger" id="rate" value="Rate Product" style="display: inline-block; margin-left: 20px;" />
                    <input type="hidden" name="hprodid" value="<?php echo $product['product_id']; ?>" />
                  </form>

                </div>
              </div>

            </div>

      <?php endforeach; ?>
  </div>
</div>

<?php
    mysqli_free_result($result);
    mysqli_close($conn);
?>

<script>
  $(document).ready(function() {
    $('#search-text').keyup(function(event) {
        var boxText = $(this).val();
        if(boxText != '') {
            $.ajax({
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
          $('#searchresult').fadeOut();
        }
    });

    $(document).on('click', 'li', function() {
      $('#search-text').val($(this).text());
      $('#searchresult').fadeOut();
    });
  });
</script>

<?php include('inc/footer2.php'); ?>
