<?php include('inc/logged-in-header.php'); ?>
<?php require('configurations/database.php'); ?>

<?php 
  $query = "SELECT products.product_id, products.product_name, products.price, products.image_src, vendors.vendor_name, ROUND(AVG(product_rating.rating), 1) AS 'Rating' FROM products JOIN vendors ON products.v_id = vendors.vendor_id, product_rating WHERE products.product_id = product_rating.product_id GROUP BY products.product_id ORDER BY Rating DESC LIMIT 6";
  $result = mysqli_query($conn, $query);
  $resultCheck = mysqli_num_rows($result);

  if($resultCheck > 0) {
    $rows = mysqli_fetch_all($result, MYSQLI_ASSOC);
    $count = 0;
  }

?>
<style type="text/css">
    .carousel-indicators li {
        display: inline-block;
        width: 10px;
        height: 10px;
        margin: 10px;
        text-indent: 0;
        cursor: pointer;
        border: none;
        border-radius: 50%;
        background-color: #000000;
        box-shadow: inset 1px 1px 1px 1px rgba(0,0,0,0.5);    
    }
    .carousel-indicators .active {
        width: 15px;
        height: 15px;
        margin: 10px;
        background-color: #c4c4c4;
}
</style>
<div class="container">
        <div class="h3 text-center toprated"> Here's some of the top-rated products of the week: </div>

        <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
                <li data-target="#myCarousel" data-slide-to="5"></li>
                <li data-target="#myCarousel" data-slide-to="6"></li>
            </ol>
            
            <?php foreach($rows as $row) {
                    if($count == 0) {
            ?>
            <div class="carousel-inner" style="height:950px;">

                <div class="item active">
                    <img class="img-responsive center-block" src="<?php echo $row['image_src']; ?>" alt="">
                    <div class="text-left text-uppercase" style="margin-left: 20px; margin-top: 50px;">
                        <h3> Product Name: <?php echo $row['product_name']; ?> </h3>
                        <p> Vendor: <?php echo $row['vendor_name']; ?> </p>
                        <p> Price: <?php echo $row['price']; ?></p>
                        <p> Rating: <?php echo $row['Rating']."/5.0"; ?> </p>
                    </div>
                </div>
            <?php 
              $count++;
              } else {
            ?>
               <div class="item">
                <img class="img-responsive center-block" src="<?php echo $row['image_src']; ?>" alt="">
                    <div class="text-left text-uppercase" style="margin-left: 20px; margin-top: 50px;">
                        <h3> Product Name: <?php echo $row['product_name']; ?> </h3>
                        <p> Vendor: <?php echo $row['vendor_name']; ?> </p>
                        <p> Price: <?php echo $row['price']; ?></p>
                        <p> Rating: <?php echo $row['Rating']."/5.0"; ?> </p>
                    </div>
              </div>
            <?php $count++;
              }
            }
            ?>
            </div>

        <a class="left carousel-control" href="#myCarousel" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right"></span>
            <span class="sr-only">Next</span>
        </a>
        </div>
</div>
<?php include('inc/footer.php'); ?>