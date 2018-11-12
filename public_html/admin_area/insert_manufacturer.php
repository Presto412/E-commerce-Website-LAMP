<?php
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
    ?>
<div class="row">
<div class="col-lg-12">
<ol class="breadcrumb">
<li class="active">
<i class="fa fa-dashboard"></i> Dashboard / Insert Manufacturer
</li>
</ol>
</div>
</div>
<div class="row">
<div class="col-lg-12">
<div class="panel panel-default">
<div class="panel-heading">
<h3 class="panel-title">
<i class="fa fa-money fa-fw"> </i> Insert Manufacturer
</h3>
</div>
<div class="panel-body">
<form class="form-horizontal" action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label class="col-md-3 control-label"> Manufacturer Name </label>
<div class="col-md-6">
<input type="text" name="manufacturer_name" class="form-control" >
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label"> Show as Top Manufacturers </label>
<div class="col-md-6">
<input type="radio" name="manufacturer_top" value="yes" >
<label> Yes </label>
<input type="radio" name="manufacturer_top" value="no" >
<label> No </label>
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label"> Select Manufacturer Image </label>
<div class="col-md-6">
<input type="file" name="manufacturer_image" class="form-control" >
</div>
</div>
<div class="form-group">
<label class="col-md-3 control-label"> </label>
<div class="col-md-6">
<input type="submit" name="submit" class="form-control btn btn-primary" value=" Insert Manufacturer " >
</div>
</div>
</form>
</div>
</div>
</div>
</div>
<?php
if (isset($_POST['submit'])) {
        $manufacturer_name = $_POST['manufacturer_name'];
        $manufacturer_top = $_POST['manufacturer_top'];
        $manufacturer_image = $_FILES['manufacturer_image']['name'];
        $tmp_name = $_FILES['manufacturer_image']['tmp_name'];
        move_uploaded_file($tmp_name, "other_images/$manufacturer_image");
        $insert_manufacturer = "insert into manufacturers (manufacturer_title,manufacturer_top,manufacturer_image) values ('$manufacturer_name','$manufacturer_top','$manufacturer_image')";
        $run_manufacturer = mysqli_query($con, $insert_manufacturer);
        if ($run_manufacturer) {
            echo "<script>alert('New Manufacturer Has Been Inserted')</script>";
            echo "<script>window.open('index.php?view_manufacturers','_self')</script>";
        }
    }
    ?>
<?php }?>
