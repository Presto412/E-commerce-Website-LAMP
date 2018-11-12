<!DOCTYPE html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
<link href="styles/bootstrap.min.css" rel="stylesheet">
</head>
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
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css" rel="stylesheet">
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

<img src="images/logo.png" width="80px" height="40px" alt="logo" class="hidden-xs animated bounce" >
<img src="images/logo-small.png" alt="logo" class="visible-xs animated bounce" >

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


<li class="active" >
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

<li>Contact Us</li>

</ul>



</div>




<div class="col-md-12" >

<div class="box animated zoomIn" >

<div class="box-header" >

<center>

<?php

$get_contact_us = "select * from contact_us";

$run_conatct_us = mysqli_query($con, $get_contact_us);

$row_conatct_us = mysqli_fetch_array($run_conatct_us);

$contact_heading = $row_conatct_us['contact_heading'];

$contact_desc = $row_conatct_us['contact_desc'];

$contact_email = $row_conatct_us['contact_email'];

?>

<h2> <?php echo $contact_heading; ?> </h2>

<p class="text-muted" >
<?php echo $contact_desc; ?>
</p>

</center>

</div>
<div ng-app="validationApp" ng-controller="mainController">
<div class="container">
<div class="row">
<div class="col-sm-10">
    

    <form name="userForm" ng-submit="submitForm()" novalidate>

        
        <div class="form-group" ng-class="{ 'has-error' : userForm.name.$invalid && !userForm.name.$pristine }">
            <label>Name</label>
            <input type="text" name="name" class="form-control" ng-model="user.name" required>
            <p ng-show="userForm.name.$invalid && !userForm.name.$pristine" class="help-block">You name is required.</p>
        </div>

        <div class="form-group" ng-class="{ 'has-error' : userForm.subject.$invalid && !userForm.subject.$pristine }">
            <label>Subject</label>
            <input type="text" name="subject" class="form-control" ng-model="user.subject" ng-minlength="3" ng-maxlength="15">
            <p ng-show="userForm.subject.$error.minlength" class="help-block">Subject is too short.</p>
            <p ng-show="userForm.subject.$error.maxlength" class="help-block">Subject is too long.</p>
        </div>

        
        <div class="form-group" ng-class="{ 'has-error' : userForm.email.$invalid && !userForm.email.$pristine }">
            <label>Email</label>
            <input type="email" name="email" class="form-control" ng-model="user.email">
            <p ng-show="userForm.email.$invalid && !userForm.email.$pristine" class="help-block">Enter a valid email.</p>
        </div>
        <div class="form-group" ng-class="{ 'has-error' : userForm.message.$invalid && !userForm.message.$pristine }">
            <label>Message</label>
            <textarea name="message" class="form-control" ng-model="user.message" ng-minlength="5" ng-maxlength="100"></textarea>
            <p ng-show="userForm.message.$error.minlength" class="help-block">Message is too short.</p>
            <p ng-show="userForm.message.$error.maxlength" class="help-block">Message is too long.</p>
        </div>

	<div class="form-group">
		<label> Select Enquiry Type </label>
		<select name="enquiry_type" class="form-control">
		<option> Select Enquiry Type </option>
		<?php
$get_enquiry_types = "select * from enquiry_types";
$run_enquiry_types = mysqli_query($con, $get_enquiry_types);
while ($row_enquiry_types = mysqli_fetch_array($run_enquiry_types)) {
    $enquiry_title = $row_enquiry_types['enquiry_title'];
    echo "<option> $enquiry_title </option>";
}
?>
		</select>
	</div>

	<button type="submit" class="btn btn-primary" ng-disabled="userForm.$invalid">Submit</button>

    </form>
</div>
</div>
<div>




</div>

</div>



</div>
</div>



<?php

include "includes/footer.php";

?>

<script src="js/jquery.min.js"> </script>
<script>
// create angular app
	var validationApp = angular.module('validationApp', []);

	// create angular controller
	validationApp.controller('mainController', function($scope) {

		// function to submit the form after all validation has occurred
		$scope.submitForm = function() {

			// check to make sure the form is completely valid
			if ($scope.userForm.$valid) {
				alert('our form is submitted');
			}

		};

	});
</script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
