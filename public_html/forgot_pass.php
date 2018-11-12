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

<div class="box">

<div class="box-header">

<center>

<h3> Enter Your Email Below , We Will Send You , Your Password </h3>

</center>

</div>

<div align="center">

<form action="" method="post">

<input type="text" class="form-control" name="c_email" placeholder="Enter Your Email">

<br>

<input type="submit" name="forgot_pass" class="btn btn-primary" value="Send My Password">

</form>

</div>

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

<?php

if (isset($_POST['forgot_pass'])) {

    $c_email = $_POST['c_email'];

    $sel_c = "select * from customers where customer_email='$c_email'";

    $run_c = mysqli_query($con, $sel_c);

    $count_c = mysqli_num_rows($run_c);

    $row_c = mysqli_fetch_array($run_c);

    $c_name = $row_c['customer_name'];

    $c_pass = $row_c['customer_pass'];

    if ($count_c == 0) {

        echo "<script> alert('Sorry, We do not have your email') </script>";

        exit();

    } else {

        $message = "

<h1 align='center'> Your Password Has Been Sent To You </h1>

<h2 align='center'> Dear $c_name </h2>

<h3 align='center'>

Your Password is : <span> <b>$c_pass</b> </span>

</h3>

<h3 align='center'>

<a href='mysql/ecom_store/checkout.php'>

Click Here To Login Your Account

</a>

</h3>

";

        $from = "sad.ahmed22224@gmail.com";

        $subject = "Your Password";

        $headers = "From: $from\r\n";

        $headers .= "Content-type: text/html\r\n";

        mail($c_email, $subject, $message, $headers);

        echo "<script> alert('Your Password has been sent to you, check your inbox ') </script>";

        echo "<script>window.open('checkout.php','_self')</script>";

    }

}

?>

