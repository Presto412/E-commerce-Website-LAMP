<head>
<link href="styles/bootstrap.min.css" rel="stylesheet">
<script src="js/angular.js" ></script>
<script src="js/formjs.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6" >
				<h4>Pages</h4>
					<ul>
						<li><a href="#">Shopping Cart</a></li>
						<li><a href="contact.php">Contact Us</a></li>
						<li><a href="shop.php">Shop</a></li>
						<li>
							<?php

								if(!isset($_SESSION['customer_email'])){
									echo "<a href='checkout.php' >My Account</a>";
								}
								else{
									echo "<a href='my_account.php?my_orders'>My Account</a>";
								}

							?>
						</li>
					</ul>
	<hr>
		<h4>User Section</h4>
					<ul>
<li>
<?php
if(!isset($_SESSION['customer_email'])){
echo "<a href='checkout.php' >Login</a>";
}
else{
echo "<a href='my_account.php?my_orders'>My Account</a>";
}
?>
</li>
<li><a href="customer_register.php">Register</a></li>
<li><a href="terms.php"> Terms And Conditions </a></li>
</ul>

<hr class="hidden-md hidden-lg hidden-sm" >
</div>

<div class="col-md-3 col-sm-6">

<h4>Contact Us at</h4>
<p>
<strong>IWP Project</strong>
<br>Queenie Das
<br>dasqueenie@gmail.com
<br>Priyansh Jain
<br>priyansh.jain0246@gmail.com
<br>
</p>
<a href="contact.php">Go to Contact us page</a>
<hr class="hidden-md hidden-lg">
</div>
<div class="col-md-6 col-sm-6">


<h4> Social Media </h4>

<p class="social">
<a href="#"><i class="fa fa-facebook"></i></a>
<a href="#"><i class="fa fa-twitter"></i></a>
<a href="#"><i class="fa fa-instagram"></i></a>
<a href="#"><i class="fa fa-google-plus"></i></a>
<a href="#"><i class="fa fa-envelope"></i></a>
</p>


</div>

</div>

</div>
</div>

<div id="copyright">

<div class="container" >

<div class="col-md-6" >

<p class="pull-left"> &copy; 2018 IWP Project </p>

</div>


</div>

</div>







