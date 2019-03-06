<?php require('configurations/database.php'); ?>
<?php session_start(); ?>

<?php 
  if(empty($_SESSION)) {
    Header("Location: index.php");
  }
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Home</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <style> .shop-count{margin-left: 5px;} .logo{margin-bottom: -5px;} </style>
</head>
<body>
  
        <div style="background-color: lightgrey; color: black;" class="jumbotron logo text-center">
            <h1> Snappy </h1>
            <h4> Online Shopping. At your doorstep. </h4>
        </div>

        <nav style="margin-bottom: 5px;" class="navbar navbar-inverse">
           <div class="container-fluid">
               <div class="navbar-brand" href="#">
                   Snappy: Online Shopping
               </div>
                    <ul class="nav navbar-nav">
                        <li> <a href="home.php"> Home </a></li>
                        <li> <a href="history.php"> Payment History </a> </li>
                        <li> <a href="browse.php?cid=1"> Browse </a> </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li> <a href="cart.php"> Shopping Cart<span class="badge shop-count"> <?php echo $_SESSION['shop_count'] ?> </span> </a> </li>
                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">  Welcome, <?php echo $_SESSION['username']; ?>  <span class="caret"></span></a>
                          <ul class="dropdown-menu">
                            <li><a href="profile.php"> Profile </a></li>
                            <li><a href="feedback.php"> Rate Vendors </a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="logout.php">Logout</a></li>
                          </ul>
                        </li>
                    </ul>
            </div>
        </nav>