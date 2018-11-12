<?php
session_start();
include "includes/db.php";
include "functions/functions.php";
?>
<!DOCTYPE html>
<html>
<head>
<title>E commerce Store </title>
<link href="http://fonts.googleapis.com/css?family=Lato:400,500,700,300,100" rel="stylesheet" >
<link href="styles/bootstrap.min.css" rel="stylesheet">
<link href="styles/style.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="css/animate.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div id="top">
<div class="container">
<div class="col-md-6 offer">
<a href="#" class="btn btn-success btn-sm" >
<?php
if (!isset($_SESSION['customer_email'])) {
    echo "Welcome :Guest";
} else {
    echo "Welcome : " . $_SESSION['customer_email'] . "";
}
if (isset($_GET['subscribe'])) {
    if (!isset($_SESSION['customer_email'])) {
        echo "<script>window.location = 'checkout.php'</script>";
    }
    addSubscriber($_GET['product_id'], $_SESSION['customer_email']);
}
?>
</a>
<a href="cart.php">
Shopping Cart Total Price: <?php total_price();?>, Total Items <?php items();?></a>
</div>
<div class="col-md-6">
<ul class="menu">
<li>
<a href="customer_register.php">
Register
</a>
</li>
<li>
<?php
if (!isset($_SESSION['customer_email'])) {
    echo "<a href='checkout.php' >My Account</a>";
} else {
    echo "<a href='customer/my_account.php?my_orders'>My Account</a>";
}
?>
</li>
<li>
<a href="cart.php">
Go to Cart
</a>
</li>
<li>
<?php
if (!isset($_SESSION['customer_email'])) {
    echo "<a href='checkout.php'> Login </a>";
} else {
    echo "<a href='logout.php'> Logout </a>";
}
?>
</li>
</ul>
</div>
</div>
</div>
<div class="navbar navbar-default" id="navbar">
<div class="container" >
<div class="navbar-header">
<a class="navbar-brand home" href="index.php" >
<img src="images/logo.png" width="80px" height="40px" alt="computerfever logo" class="hidden-xs" >
<img src="images/logo-small.png" alt="computerfever logo" class="visible-xs" >
</a>
</div>
<div class="navbar-collapse collapse" id="navigation" >
<div class="padding-nav" >
<ul class="nav navbar-nav navbar-left">
<li class="active">
<a href="index.php"> Home </a>
</li>
<li>
<a href="shop.php"> Shop </a>
</li>
<li>
<?php
if (!isset($_SESSION['customer_email'])) {
    echo "<a href='checkout.php' >My Account</a>";
} else {
    echo "<a href='customer/my_account.php?my_orders'>My Account</a>";
}
?>
</li>
<li>
<a href="cart.php"> Shopping Cart </a>
</li>
<li>
<a href="about.php"> About Us </a>
</li>
<li>
<a href="contact.php"> Contact Us </a>
</li>
</ul>
</div>
<div class="navbar-collapse collapse right">
<button class="btn navbar-btn btn-primary" type="button" data-toggle="collapse" data-target="#search">
<span class="sr-only">Toggle Search</span>
<i class="fa fa-search"></i>
</button>
</div>
<div class="collapse clearfix" id="search">
<form class="navbar-form" method="get" action="results.php">
<div class="input-group">
<input class="form-control" type="text" placeholder="Search" name="user_query" required>
<span class="input-group-btn">
<button type="submit" value="Search" name="search" class="btn btn-primary">
<i class="fa fa-search"></i>
</button>
</span>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="container" id="slider">
<div class="col-md-12">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
<ol class="carousel-indicators">
<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
<li data-target="#myCarousel" data-slide-to="1"></li>
<li data-target="#myCarousel" data-slide-to="2"></li>
<li data-target="#myCarousel" data-slide-to="3"></li>
</ol>
<div class="carousel-inner">
<?php
$get_slides = "select * from slider LIMIT 0,1";
$run_slides = mysqli_query($con, $get_slides);
while ($row_slides = mysqli_fetch_array($run_slides)) {
    $slide_name = $row_slides['slide_name'];
    $slide_image = $row_slides['slide_image'];
    $slide_url = $row_slides['slide_url'];
    echo "
<div class='item active'>
<a href='$slide_url'><img src='admin_area/slides_images/$slide_image'></a>
</div>
";
}
?>
<?php
$get_slides = "select * from slider LIMIT 1,3 ";
$run_slides = mysqli_query($con, $get_slides);
while ($row_slides = mysqli_fetch_array($run_slides)) {
    $slide_name = $row_slides['slide_name'];
    $slide_image = $row_slides['slide_image'];
    $slide_url = $row_slides['slide_url'];
    echo "
<div class='item'>
<a href='$slide_url'><img src='admin_area/slides_images/$slide_image'></a>
</div>
";
}
?>
</div>
<a class="left carousel-control" href="#myCarousel" data-slide="prev">
<span class="glyphicon glyphicon-chevron-left"> </span>
<span class="sr-only"> Previous </span>
</a>
<a class="right carousel-control" href="#myCarousel" data-slide="next">
<span class="glyphicon glyphicon-chevron-right"> </span>
<span class="sr-only"> Next </span>
</a>
</div>
</div>
</div>
<div id="advantages">
<div class="container">
<div class="same-height-row" >
<?php
$get_boxes = "select * from boxes_section";
$run_boxes = mysqli_query($con, $get_boxes);
while ($run_boxes_section = mysqli_fetch_array($run_boxes)) {
    $box_id = $run_boxes_section['box_id'];
    $box_title = $run_boxes_section['box_title'];
    $box_desc = $run_boxes_section['box_desc'];
    ?>
<div class="col-sm-4">
<div class="box same-height">
<div class="icon">
<i class="fa fa-heart" ></i>
</div>
<h3><a href="#"> <?php echo $box_title; ?> </a></h3>
<p>
<?php echo $box_desc; ?>
</p>
</div>
</div>
<?php
}?>
</div>
</div>
</div>
<div id="hot">
<div class="box">
<div class="container">
<div class="col-md-12">
<h2>Latest this week</h2>
</div>
</div>
</div>
</div>
<div id="content" class="container">
<div class="row">
<?php
getPro();
?>
</div>
</div>
<?php
include "includes/footer.php";
?>
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
