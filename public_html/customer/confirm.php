<?php

session_start();

if (!isset($_SESSION['customer_email'])) {

    echo "<script>window.open('../checkout.php','_self')</script>";


} else {

    include("includes/db.php");

    include("functions/functions.php");

    if (isset($_GET['order_id'])) {

        $order_id = $_GET['order_id'];

    }

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
<a href="../customer_register.php">
Register
</a>
</li>

<li>
<?php

if (!isset($_SESSION['customer_email'])) {

    echo "<a href='../checkout.php' >My Account</a>";

} else {

    echo "<a href='my_account.php?my_orders'>My Account</a>";

}


?>
</li>

<li>
<a href="../cart.php">
Go to Cart
</a>
</li>

<li>
<?php

if (!isset($_SESSION['customer_email'])) {

    echo "<a href='../checkout.php'> Login </a>";

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
<a href="../index.php"> Home </a>
</li>

<li>
<a href="../shop.php"> Shop </a>
</li>

<li class="active">
<?php

if (!isset($_SESSION['customer_email'])) {

    echo "<a href='../checkout.php' >My Account</a>";

} else {

    echo "<a href='my_account.php?my_orders'>My Account</a>";

}


?>
</li>

<li>
<a href="../cart.php"> Shopping Cart </a>
</li>

<li>
<a href="../about.php"> About Us </a>
</li>


<li>
<a href="../contact.php"> Contact Us </a>
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

<li>My Account</li>

</ul>



</div>

<div class="col-md-3">

<?php include("includes/sidebar.php"); ?>

</div>

<div class="col-md-9">

<div class="box">

<h1 align="center"> Please Confirm Your Payment </h1>


<form action="confirm.php?update_id=<?php echo $order_id; ?>" method="post" enctype="multipart/form-data">

<div class="form-group">

<label>Invoice No:</label>

<input type="text" class="form-control" name="invoice_no" required>

</div>


<div class="form-group">

<label>Amount Sent:</label>

<input type="text" class="form-control" name="amount_sent" required>

</div>

<div class="form-group">

<label>Select Payment Mode:</label>

<select name="payment_mode" class="form-control">

<option>Select Payment Mode</option>
<option>Bank Code</option>
<option>UBL/Omni Paisa</option>
<option>Easy paisa</option>
<option>Western Union</option>

</select>

</div>

<div class="form-group">

<label>Transaction/Reference Id:</label>

<input type="text" class="form-control" name="ref_no" required>

</div>


<div class="form-group">

<label>Easy Paisa/Omni Code:</label>

<input type="text" class="form-control" name="code" required>

</div>


<div class="form-group">

<label>Payment Date:</label>

<input type="text" class="form-control" name="date" required>

</div>

<div class="text-center">

<button type="submit" name="confirm_payment" class="btn btn-primary btn-lg">

<i class="fa fa-user-md"></i> Confirm Payment

</button>

</div>

</form>

<?php

if (isset($_POST['confirm_payment'])) {

    $update_id = $_GET['update_id'];

    $invoice_no = $_POST['invoice_no'];

    $amount = $_POST['amount_sent'];

    $payment_mode = $_POST['payment_mode'];

    $ref_no = $_POST['ref_no'];

    $code = $_POST['code'];

    $payment_date = $_POST['date'];

    $complete = "Complete";

    $insert_payment = "insert into payments (invoice_no,amount,payment_mode,ref_no,code,payment_date) values ('$invoice_no','$amount','$payment_mode','$ref_no','$code','$payment_date')";

    $run_payment = mysqli_query($con, $insert_payment);

    $update_customer_order = "update customer_orders set order_status='$complete' where order_id='$update_id'";

    $run_customer_order = mysqli_query($con, $update_customer_order);

    $update_pending_order = "update pending_orders set order_status='$complete' where order_id='$update_id'";

    $run_pending_order = mysqli_query($con, $update_pending_order);

    if ($run_pending_order) {

        echo "<script>alert('your Payment has been received,order will be completed within 24 hours')</script>";

        echo "<script>window.open('my_account.php?my_orders','_self')</script>";

    }



}



?>


</div>

</div>

</div>
</div>



<?php

include("includes/footer.php");

?>

<script src="js/jquery.min.js"> </script>

<script src="js/bootstrap.min.js"></script>

</body>
</html>

<?php 
} ?>
