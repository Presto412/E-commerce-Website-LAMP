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
</div>
<div class="navbar-collapse collapse" id="navigation" >
<div class="padding-nav" >
<ul class="nav navbar-nav navbar-left">
<li>
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
<div id="content" >
<div class="container" >
<div class="col-md-12" >
<ul class="breadcrumb" >
<li>
<a href="index.php">Home</a>
</li>
<li>Register</li>
</ul>
</div>
<div class="col-md-12" >
<?php
if (!isset($_SESSION['customer_email'])) {
    include "customer/customer_login.php";
} else {
    include "payment_options.php";
}
?>
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
