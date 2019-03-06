<?php include('inc/header.php'); ?>

<title> Welcome to Snappy </title>
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
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                <li data-target="#myCarousel" data-slide-to="1"></li>
                <li data-target="#myCarousel" data-slide-to="2"></li>
                <li data-target="#myCarousel" data-slide-to="3"></li>
                <li data-target="#myCarousel" data-slide-to="4"></li>
            </ol>

            <div class="carousel-inner" style="height: 700px;">
                <div class="item active">
                    <img class="img-responsive center-block" src="assets/snappy.jpg" alt="snappy">
                <div class="carousel-caption">
                    <h3> What is Snappy?</h3>
                    <p> Snappy is an online shopping website designed keeping the users on mind. It is fast, secure and reliable. </p>
                </div>
            </div>

            <div class="item">
            	<img class="img-responsive center-block" src="assets/fas2t.jpg" alt="fast">
            <div class="carousel-caption">
                <h3> Fast </h3>
                <p> Snappy responses to you in its maximum speed. Your orders will arrive on the assigned date and not late. </p>
            </div>
            </div>

            <div class="item">
            <img class="img-responsive center-block" src="assets/secure.jpg" alt="secure">
            <div class="carousel-caption">
                <h3> Secure </h3>
                <p> Snappy values its users' credentials and handles purchase requests and payments with full attention to the user's convenience and security. </p>
            </div>
            </div>

            <div class="item">
                <img class="img-responsive center-block" src="assets/reliable.jpg" alt="reliable">
                <div class="carousel-caption">
                    <h3> Reliable </h3>
                    <p> With more than a thousand products available to be purchased from various vendors, Snappy provides the best and most reliable online shopping experience to date.</p>
                </div>
            </div>

            <div class="item">
                <img class="img-responsive center-block" src="assets/supportive.jpg" alt="supportive">
                <div class="carousel-caption">
                    <h3> Supportive </h3>
                    <p> Our customer support is always here to help you out. <a href="#"> Contact us </a> with all the valid issues and leave us your valuable feedback that we can use to improve us further.</p>
                </div>
            </div>
        </div>

  <!-- Left and right controls -->
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
