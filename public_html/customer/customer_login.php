<head><link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css"></head>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="box animated zoomIn" >

<div class="box-header" >

<center>

<h1>Login</h1>

<p class="lead" >Already our Customer</p>


</center>





</div>

<form action="checkout.php" method="post" >

<div class="form-group" >

<label>Email</label>

<input type="text" class="form-control" name="c_email" required >

</div>

<div class="form-group" >

<label>Password</label>

<input type="password" class="form-control" name="c_pass" required >

<h4 align="center">

<a href="forgot_pass.php"> Forgot Password </a>

</h4>

</div>

<div class="text-center" >

<button name="login" value="Login" class="btn btn-primary" >

<i class="fa fa-sign-in" ></i> Log in


</button>

</div>


</form>

<center>

<a href="customer_register.php" >

<h3>New ? Register Here</h3>

</a>


</center>


</div>

<?php

if(isset($_POST['login'])){

$customer_email = $_POST['c_email'];

$customer_pass = $_POST['c_pass'];

$select_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";

$run_customer = mysqli_query($con,$select_customer);

$get_ip = getRealUserIp();

$check_customer = mysqli_num_rows($run_customer);

$select_cart = "select * from cart where ip_add='$get_ip'";

$run_cart = mysqli_query($con,$select_cart);

$check_cart = mysqli_num_rows($run_cart);

if($check_customer==0){

echo "<script>swal('Wrong','password or email','error')</script>";

exit();

}

if($check_customer==1 AND $check_cart==0){

$_SESSION['customer_email']=$customer_email;

echo "<script>swal('You are Logged In')</script>";

echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

}
else {

$_SESSION['customer_email']=$customer_email;

echo "<script>window.open('customer/my_account.php?my_orders','_self')</script>";

} 


}

?>
