
<div id="footer">
	<div class="container">
		<div class="row">
			<div class="col-md-3 col-sm-6" >
				<h4>Pages</h4>
					<ul>
						<li><a href="../cart.php">Shopping Cart</a></li>
						<li><a href="../contact.php">Contact Us</a></li>
						<li><a href="../shop.php">Shop</a></li>
						<li>
							<?php

								if(!isset($_SESSION['customer_email'])){
									echo "<a href='../checkout.php' >My Account</a>";
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
echo "<a href='../checkout.php' >Login</a>";
}
else{
echo "<a href='my_account.php?my_orders'>My Account</a>";
}
?>
</li>
<li><a href="../customer_register.php">Register</a></li>
<li><a href="../terms.php"> Terms And Conditions </a></li>
</ul>

<hr class="hidden-md hidden-lg hidden-sm" >
</div>
<div class="col-md-3 col-sm-6">
<h4> Top Products Categories </h4>
<ul>
<?php
$get_p_cats = "select * from product_categories";
$run_p_cats = mysqli_query($con,$get_p_cats);
while($row_p_cats = mysqli_fetch_array($run_p_cats)){
$p_cat_id = $row_p_cats['p_cat_id'];
$p_cat_title = $row_p_cats['p_cat_title'];
echo "<li> <a href='shop.php?p_cat=$p_cat_id'> $p_cat_title </a> </li>";
}
?>
</ul>
<hr class="hidden-md hidden-lg">
</div>
<div class="col-md-3 col-sm-6">

<h4>Contact Us at</h4>
<p><!-- p Starts -->
<strong>IWP Project</strong>
<br>Queenie Das
<br>dasqueenie@gmail.com
<br>Priyansh Jain
<br>priyansh.jain0246@gmail.com
<br>
</p>
<a href="../contact.php">Go to Contact us page</a>
<hr class="hidden-md hidden-lg">
</div>
<div class="col-md-3 col-sm-6">
<h4>Subscribe with us</h4>
<form action="https://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('https://feedburner.google.com/fb/a/mailverify?uri=computerfever', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
<div class="input-group">
<input type="text" class="form-control" name="email">
<input type="hidden" value="computerfever" name="uri"/>
<input type="hidden" name="loc" value="en_US"/>
<span class="input-group-btn">
<input type="submit" value="subscribe" class="btn btn-default">
</span>
</div>
</form>

<hr>

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

<p class="pull-left"> &copy; 2016 IWP Project </p>

</div>


</div>

</div>







