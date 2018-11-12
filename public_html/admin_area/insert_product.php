<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    ?>
<!DOCTYPE html>
<html>
<head>
<title> Insert Products </title>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'#product_desc,#product_features' });</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="row">
<div class="col-lg-12">
<ol class="breadcrumb">
<li class="active">
<i class="fa fa-dashboard"> </i> Dashboard / Insert Products
</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-money fa-fw"></i> Insert Products
</h3>
</div>
<div class="panel-body">
<form class="form-horizontal" method="post" enctype="multipart/form-data">
<div class="form-group" >
<label class="col-md-3 control-label" > Product Title </label>
<div class="col-md-6" >
<input type="text" name="product_title" class="form-control" required >
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Product Url </label>
<div class="col-md-6" >
<input type="text" name="product_url" class="form-control" required >
<br>
<p style="font-size:15px; font-weight:bold;">
Product Url Example : navy-blue-t-shirt
</p>
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Select A Manufacturer </label>
<div class="col-md-6" >
<select class="form-control" name="manufacturer">
<option> Select A Manufacturer </option>
<?php
$get_manufacturer = "select * from manufacturers";
    $run_manufacturer = mysqli_query($con, $get_manufacturer);
    while ($row_manufacturer = mysqli_fetch_array($run_manufacturer)) {
        $manufacturer_id = $row_manufacturer['manufacturer_id'];
        $manufacturer_title = $row_manufacturer['manufacturer_title'];
        echo "<option value='$manufacturer_id'>
$manufacturer_title
</option>";
    }
    ?>
</select>
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Product Category </label>
<div class="col-md-6" >
<select name="product_cat" class="form-control" >
<option> Select  a Product Category </option>
<?php
$get_p_cats = "select * from product_categories";
    $run_p_cats = mysqli_query($con, $get_p_cats);
    while ($row_p_cats = mysqli_fetch_array($run_p_cats)) {
        $p_cat_id = $row_p_cats['p_cat_id'];
        $p_cat_title = $row_p_cats['p_cat_title'];
        echo "<option value='$p_cat_id' >$p_cat_title</option>";
    }
    ?>
</select>
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Category </label>
<div class="col-md-6" >
<select name="cat" class="form-control" >
<option> Select a Category </option>
<?php
$get_cat = "select * from categories ";
    $run_cat = mysqli_query($con, $get_cat);
    while ($row_cat = mysqli_fetch_array($run_cat)) {
        $cat_id = $row_cat['cat_id'];
        $cat_title = $row_cat['cat_title'];
        echo "<option value='$cat_id'>$cat_title</option>";
    }
    ?>
</select>
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Product Image 1 </label>
<div class="col-md-6" >
<input type="file" name="product_img1" class="form-control" required >
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" > Product Price </label>
<div class="col-md-6" >
<input type="text" name="product_price" class="form-control" required >
</div>
</div>
<div class="form-group" >
<label class="col-md-3 control-label" ></label>
<div class="col-md-6" >
<input type="submit" name="submit" value="Insert Product" class="btn btn-primary form-control" >
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</body>
</html>
<?php
if (isset($_POST['submit'])) {
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $cat = $_POST['cat'];
        $manufacturer_id = $_POST['manufacturer'];
        $product_price = $_POST['product_price'];
        $product_desc = $_POST['product_desc'];
        $product_keywords = $_POST['product_keywords'];
        $psp_price = $_POST['psp_price'];
        $product_label = $_POST['product_label'];
        $product_url = $_POST['product_url'];
        $product_features = $_POST['product_features'];
        $product_video = $_POST['product_video'];
        $status = "product";
        $product_img1 = $_FILES['product_img1']['name'];
        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        move_uploaded_file($temp_name1, "product_images/$product_img1");
        $insert_product = "insert into products (p_cat_id,cat_id,manufacturer_id,date,product_title,product_url,product_img1,product_price,product_psp_price,product_desc,product_features,product_video,product_keywords,product_label,status) values ('$product_cat','$cat','$manufacturer_id',NOW(),'$product_title','$product_url','$product_img1','$product_price','$psp_price','$product_desc','$product_features','$product_video','$product_keywords','$product_label','$status')";
        $run_product = mysqli_query($con, $insert_product);
        if ($run_product) {
            echo "<script>alert('Product has been inserted successfully')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }
    ?>
<?php }?>
