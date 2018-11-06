<!DOCTYPE html>
<head>
<link href="style.css" rel="stylesheet">
<link href="../styles/bootstrap.min.css" rel="stylesheet">
<script src="../js/jquery.min.js"> </script>



</head>
<?php


$db = mysqli_connect('mysql', "root", "pass", "Ecom_Store");


    echo "



<div class='product' >
<img src='fur coat with button1.jpg' style='float:left;height:390px;'>
<div class='container'>
<img src='fur coat with button1.jpg' class='image'>
  <div class='night' id='night'>
  </div>

</div>

<p class='btn btn-primary btn1'>Day View</p>

<p class='btn btn-primary btn1 btn2'>Night View
<fieldset class='field' style='width: 150px; height: 150px;display:inline-block;margin-left:50px;font-size:20px;'>
  <label for='b'></label>
  Darker&ensp;Lighter<input type='range' min='0' max='255' id='b' step='1' value='0'>
  <output for='b' style='font-size:20px;'></output>
</fieldset>  </p>
<br><br>
</div>


";




$get_prod = "select * from products where product_id=7";
$run_prod = mysqli_query($db, $get_prod);
   while($row_prod = mysqli_fetch_array($run_prod)){
       $pro_id= 7;
       $pro_price=$row_prod['product_price'];
}


$get_seller = "select * from seller WHERE seller_id=4";

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
var slide = document.querySelector('#night'), 
    b = document.querySelector('#b'),
    b_out = document.querySelector('#b_out');

function setColor(){
  var b_hex = parseInt(b.value,10).toString(16);
      if(b_hex.length<2)
        {
          b_hex="0"+n;
        }
     var hex = "#0000" + b_hex;
  slide.style.backgroundColor = hex; 
}

b.addEventListener('input', function() {
  setColor();
});

$(document).ready(function(){
    $(".sel").click(function(){
alert('Seller Selected');


});
});

</script>
