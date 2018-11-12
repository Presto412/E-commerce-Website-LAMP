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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
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
<img src="images/logo.png" width="80px" height="40px" alt="logo" class="hidden-xs animated bounce">
<img src="images/logo-small.png" alt="logo" class="visible-xs animated bounce" >
</a>
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
<li>Shop</li>
</ul>
</div>
<div class="col-md-3">
<?php include "includes/sidebar.php";?>
</div>
<div class="col-md-9" >
<div class='box'>
<h1 class='animated bounce'>Shop</h1>
<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using '</p>
</div>
<div class="row animated zoomIn" id="Products" >
<?php getProducts();?>
</div>
<center>
<ul class="pagination" >
<?php getPaginator();?>
</ul>
</center>
</div>
<div id="wait" style="position:absolute;top:40%;left:45%;padding:100px;padding-top:200px;">
</div>
</div>
</div>
<?php
include "includes/footer.php";
?>
<script src="js/jquery.min.js"> </script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
/// Hide And Show Code Starts ///
$('.nav-toggle').click(function(){
$(".panel-collapse,.collapse-data").slideToggle(700,function(){
if($(this).css('display')=='none'){
$(".hide-show").html('Show');
}
else{
$(".hide-show").html('Hide');
}
});
});
/// Hide And Show Code Ends ///
/// Search Filters code Starts ///
$(function(){
$.fn.extend({
filterTable: function(){
return this.each(function(){
$(this).on('keyup', function(){
var $this = $(this),
search = $this.val().toLowerCase(),
target = $this.attr('data-filters'),
handle = $(target),
rows = handle.find('li a');
if(search == '') {
rows.show();
} else {
rows.each(function(){
var $this = $(this);
$this.text().toLowerCase().indexOf(search) === -1 ? $this.hide() : $this.show();
});
}
});
});
}
});
$('[data-action="filter"][id="dev-table-filter"]').filterTable();
});
});
</script>
<script>
$(document).ready(function(){
  // getProducts Function Code Starts
  function getProducts(){
  // Manufacturers Code Starts
    var sPath = '';
var aInputs = $('li').find('.get_manufacturer');
var aKeys = Array();
var aValues = Array();
iKey = 0;
$.each(aInputs,function(key,oInput){
if(oInput.checked){
aKeys[iKey] =  oInput.value
};
iKey++;
});
if(aKeys.length>0){
var sPath = '';
for(var i = 0; i < aKeys.length; i++){
sPath = sPath + 'man[]=' + aKeys[i]+'&';
}
}
// Manufacturers Code ENDS
// Products Categories Code Starts
var aInputs = Array();
var aInputs = $('li').find('.get_p_cat');
var aKeys = Array();
var aValues = Array();
iKey = 0;
$.each(aInputs,function(key,oInput){
if(oInput.checked){
aKeys[iKey] =  oInput.value
};
iKey++;
});
if(aKeys.length>0){
for(var i = 0; i < aKeys.length; i++){
sPath = sPath + 'p_cat[]=' + aKeys[i]+'&';
}
}
// Products Categories Code ENDS
   // Categories Code Starts
var aInputs = Array();
var aInputs = $('li').find('.get_cat');
var aKeys  = Array();
var aValues = Array();
iKey = 0;
    $.each(aInputs,function(key,oInput){
    if(oInput.checked){
    aKeys[iKey] =  oInput.value
};
    iKey++;
});
if(aKeys.length>0){
    for(var i = 0; i < aKeys.length; i++){
    sPath = sPath + 'cat[]=' + aKeys[i]+'&';
}
}
   // Categories Code ENDS
   // Loader Code Starts
$('#wait').html('<img src="images/load.gif">');
// Loader Code ENDS
// ajax Code Starts
$.ajax({
url:"load.php",
method:"POST",
data: sPath+'sAction=getProducts',
success:function(data){
 $('#Products').html('');
 $('#Products').html(data);
 $("#wait").empty();
}
});
    $.ajax({
url:"load.php",
method:"POST",
data: sPath+'sAction=getPaginator',
success:function(data){
$('.pagination').html('');
$('.pagination').html(data);
}
    });
// ajax Code Ends
   }
   // getProducts Function Code Ends
$('.get_manufacturer').click(function(){
getProducts();
});
  $('.get_p_cat').click(function(){
getProducts();
});
$('.get_cat').click(function(){
getProducts();
});
 });
</script>
</body>
</html>
