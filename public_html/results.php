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
?>
</a>
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
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation"  >
<span class="sr-only" >Toggle Navigation </span>
<i class="fa fa-align-justify"></i>
</button>
<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search" >
<span class="sr-only" >Toggle Search</span>
<i class="fa fa-search" ></i>
</button>
</div>
<div class="navbar-collapse collapse" id="navigation" >
<div class="padding-nav" >
<ul class="nav navbar-nav navbar-left">
<li>
<a href="index.php"> Home </a>
</li>
<li class="active" >
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
<div id="content" >
<div class="container" >
<div class="col-md-12" >
<ul class="breadcrumb" >
<li>
<a href="index.php">Home</a>
</li>
<li>Search Results</li>
</ul>
</div>
<div class="col-md-12" >
<div class="row" id="Products" >
<?php
if (isset($_GET['search'])) {
    $user_keyword = $_GET['user_query'];
    $get_products = "select * from products where product_title like '%$user_keyword%'";
    $run_products = mysqli_query($con, $get_products);
    $count = mysqli_num_rows($run_products);
    if ($count == 0) {
        echo "
<div class='box'>
<h2>No Search Results Found</h2>
</div>
";
    } else {
        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_price = $row_products['product_price'];
            $pro_img1 = $row_products['product_img1'];
            $manufacturer_id = $row_products['manufacturer_id'];
            $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
            $run_manufacturer = mysqli_query($db, $get_manufacturer);
            $row_manufacturer = mysqli_fetch_array($run_manufacturer);
            $manufacturer_name = $row_manufacturer['manufacturer_title'];
            $pro_url = $row_products['product_url'];
            echo "
<div class='col-md-3 col-sm-6 center-responsive' >
<div class='product' >
<a href='images/$pro_url.php' >
<img src='admin_area/product_images/$pro_img1' class='img-responsive' >
</a>
<div class='text' >
<center>
<p class='btn btn-primary'> $manufacturer_name </p>
</center>
<hr>
<h3><a href='images/$pro_url.php' >$pro_title</a></h3>
<p class='price' > Rs. $pro_price </p>
<p class='buttons' >
</p>
</div>
</div>
</div>
";
        }
    }
}
?>
</div>
</div>
</div>
</div>
<?php
include "includes/footer.php";
?>
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
