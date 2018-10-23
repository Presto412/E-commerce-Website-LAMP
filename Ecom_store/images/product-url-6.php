<!DOCTYPE html>
<head>
<link href="style.css" rel="stylesheet">
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<script src="../js/jquery.min.js"> </script>



</head>
<?php


$db = mysqli_connect("localhost", "root", "Queenie@11", "Ecom_Store");


    echo "



<div class='product' >
<img src='Jack---Jones-White-Solid-Denim-Jacket-3115-5549091-1-pdp_slider_l.jpg' style='float:left;height:390px;'>
<div class='container'>
<img src='Jack---Jones-White-Solid-Denim-Jacket-3115-5549091-1-pdp_slider_l.jpg' class='image'>
  <div class='night'>
  </div>

</div>

<p class='btn btn-primary btn1'>Day View</p>
<p class='btn btn-primary btn1 btn2'>Night View</p>
<br><br>
</div>

";



$get_prod = "select * from products where product_id=6";
$run_prod = mysqli_query($db, $get_prod);
   while($row_prod = mysqli_fetch_array($run_prod)){
       $pro_id= 6;
       $pro_price=$row_prod['product_price'];
}


$get_seller = "select * from seller WHERE seller_id=7";

$run_seller = mysqli_query($db, $get_seller);
echo "<table><tr><th>Seller Name</th><th>Delivery Charges</th><th>Shipping Time</th><th>Seller Rating</th><th>Total Amount</th><th>Select</th></tr>";
   while($row_seller = mysqli_fetch_array($run_seller)){
    $s_price=$row_seller['seller_price'];
    $amt=$s_price+$pro_price;

    echo "<tr><td>".$row_seller['seller_title']."</td><td>$".$row_seller['seller_price']."</td><td>".$row_seller['seller_time']."</td><td>".$row_seller['seller_rating']."</td><td>".$amt."</td><td class='btn btn-primary sel'><a href='../cart.php?itemId=$pro_id&quantity=1&price=$amt&size=Medium' class='btn btn-primary' style='text-decoration: none;'>Select</a></td></tr>";




        
}
echo "</table>";


?>

<script>

$(document).ready(function(){
    $(".sel").click(function(){
alert('Seller Selected');


});
});

</script>
