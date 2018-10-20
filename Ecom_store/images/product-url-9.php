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
<img src='product-1.jpg' style='float:left;height:400px;'>
<div class='container'>
<img src='product-1.jpg' class='image'>
  <div class='night'>
  </div>

</div>

<p class='btn btn-primary btn1'>Day View</p>
<p class='btn btn-primary btn1 btn2'>Night View</p>
<br><br>
</div>

";




$get_seller = "select * from seller WHERE seller_id=5";

$run_seller = mysqli_query($db, $get_seller);
echo "<table><tr><th>Seller Name</th><th>Delivery Charges</th><th>Shipping Time</th><th>Seller Rating</th><th>Select</th></tr>";
   while($row_seller = mysqli_fetch_array($run_seller)){

    echo "<tr><td>".$row_seller['seller_title']."</td><td>$".$row_seller['seller_price']."</td><td>".$row_seller['seller_time']."</td><td>".$row_seller['seller_rating']."</td><td class='btn btn-primary sel'>Select</td></tr>";



        
}
echo "</table>";


?>

<script>

$(document).ready(function(){
    $(".sel").click(function(){
alert('Seller Selected');
window.location.href = "../shop.php";

});
});

</script>
