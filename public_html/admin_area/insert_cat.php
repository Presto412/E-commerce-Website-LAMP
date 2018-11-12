<?php

if(!isset($_SESSION['admin_email'])){

echo "<script>window.open('login.php','_self')</script>";

}

else {


?>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li>

<i class="fa fa-dashboard"></i> Dashboard / Insert Category

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Insert Category

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">

<div class="form-group">

<label class="col-md-3 control-label">Category Title</label>

<div class="col-md-6">

<input type="text" name="cat_title" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Show as Category Top</label>

<div class="col-md-6">

<input type="radio" name="cat_top" value="yes">

<label>Yes</label>

<input type="radio" name="cat_top" value="no">

<label>No</label>

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label">Select Category Image</label>

<div class="col-md-6">

<input type="file" name="cat_image" class="form-control">

</div>

</div>

<div class="form-group">

<label class="col-md-3 control-label"></label>

<div class="col-md-6">

<input type="submit" name="submit" value="Insert Category" class="btn btn-primary form-control">

</div>

</div>

</form>

</div>

</div>

</div>

</div>

<?php

if(isset($_POST['submit'])){

$cat_title = $_POST['cat_title'];

$cat_top = $_POST['cat_top'];

$cat_image = $_FILES['cat_image']['name'];

$temp_name = $_FILES['cat_image']['tmp_name'];

move_uploaded_file($temp_name,"other_images/$cat_image");

$insert_cat = "insert into categories (cat_title,cat_top,cat_image) values ('$cat_title','$cat_top','$cat_image')";

$run_cat = mysqli_query($con,$insert_cat);

if($run_cat){

echo "<script> alert('New Category Has Been Inserted')</script>";

echo "<script> window.open('index.php?view_cats','_self') </script>";

}

}



?>

<?php } ?>