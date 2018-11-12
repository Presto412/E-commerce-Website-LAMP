<?php

if (!isset($_SESSION['admin_email'])) {

    echo "<script>window.open('login.php','_self')</script>";

} else {

    ?>

<?php

    if (isset($_GET['edit_product'])) {

        $edit_id = $_GET['edit_product'];

        $get_p = "select * from products where product_id='$edit_id'";

        $run_edit = mysqli_query($con, $get_p);

        $row_edit = mysqli_fetch_array($run_edit);

        $p_id = $row_edit['product_id'];

        $p_title = $row_edit['product_title'];

        $p_cat = $row_edit['p_cat_id'];

        $cat = $row_edit['cat_id'];

        $m_id = $row_edit['manufacturer_id'];

        $p_image3 = $row_edit['product_img3'];

        $new_p_image3 = $row_edit['product_img3'];

        $p_video = $row_edit['product_video'];

    }

    $get_manufacturer = "select * from manufacturers where manufacturer_id='$m_id'";

    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    $row_manfacturer = mysqli_fetch_array($run_manufacturer);

    $manufacturer_id = $row_manfacturer['manufacturer_id'];

    $manufacturer_title = $row_manfacturer['manufacturer_title'];

    $get_p_cat = "select * from product_categories where p_cat_id='$p_cat'";

    $run_p_cat = mysqli_query($con, $get_p_cat);

    $row_p_cat = mysqli_fetch_array($run_p_cat);

    $p_cat_title = $row_p_cat['p_cat_title'];

    $get_cat = "select * from categories where cat_id='$cat'";

    $run_cat = mysqli_query($con, $get_cat);

    $row_cat = mysqli_fetch_array($run_cat);

    $cat_title = $row_cat['cat_title'];

    ?>


<!DOCTYPE html>

<html>

<head>

<title> Edit Products </title>

<script src="js/jquery.min.js"> </script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'#product_desc,#product_features' });</script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>

<div class="row">

<div class="col-lg-12">

<ol class="breadcrumb">

<li class="active">

<i class="fa fa-dashboard"> </i> Dashboard / Edit Products

</li>

</ol>

</div>

</div>


<div class="row">

<div class="col-lg-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title">

<i class="fa fa-money fa-fw"></i> Edit Products

</h3>

</div>

<div class="panel-body">

<form class="form-horizontal" method="post" enctype="multipart/form-data">

<div class="form-group" >

<label class="col-md-3 control-label" > Product Title </label>

<div class="col-md-6" >

<input type="text" name="product_title" class="form-control" required value="<?php echo $p_title; ?>">

</div>

</div>


<div class="form-group" >

<label class="col-md-3 control-label" > Product Url </label>

<div class="col-md-6" >

<input type="text" name="product_url" class="form-control" required value="<?php echo $p_url; ?>" >

<br>

<p style="font-size:15px; font-weight:bold;">

Product Url Example : navy-blue-t-shirt

</p>

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label" > Select A Manufacturer </label>

<div class="col-md-6" >

<select name="manufacturer" class="form-control">

<option value="<?php echo $manufacturer_id; ?>">
<?php echo $manufacturer_title; ?>
</option>

<?php

    $get_manufacturer = "select * from manufacturers";

    $run_manufacturer = mysqli_query($con, $get_manufacturer);

    while ($row_manfacturer = mysqli_fetch_array($run_manufacturer)) {

        $manufacturer_id = $row_manfacturer['manufacturer_id'];

        $manufacturer_title = $row_manfacturer['manufacturer_title'];

        echo "
          <option value='$manufacturer_id'>
          $manufacturer_title
          </option>
          ";

    }

    ?>

</select>

</div>

</div>

<div class="form-group" >

<label class="col-md-3 control-label" > Product Category </label>

<div class="col-md-6" >

<select name="product_cat" class="form-control" >

<option value="<?php echo $p_cat; ?>" > <?php echo $p_cat_title; ?> </option>


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

<option value="<?php echo $cat; ?>" > <?php echo $cat_title; ?> </option>

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

<input type="file" name="product_img1" class="form-control" >
<br><img src="product_images/<?php echo $p_image1; ?>" width="70" height="70" >

</div>

</div>



<div class="form-group" >

<label class="col-md-3 control-label" > Product Price </label>

<div class="col-md-6" >

<input type="text" name="product_price" class="form-control" required value="<?php echo $p_price; ?>" >

</div>

</div>






<div class="form-group" >

<label class="col-md-3 control-label" ></label>

<div class="col-md-6" >

<input type="submit" name="update" value="Update Product" class="btn btn-primary form-control" >

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

    if (isset($_POST['update'])) {

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
        $product_img2 = $_FILES['product_img2']['name'];
        $product_img3 = $_FILES['product_img3']['name'];

        $temp_name1 = $_FILES['product_img1']['tmp_name'];
        $temp_name2 = $_FILES['product_img2']['tmp_name'];
        $temp_name3 = $_FILES['product_img3']['tmp_name'];

        if (empty($product_img1)) {

            $product_img1 = $new_p_image1;

        }

        if (empty($product_img2)) {

            $product_img2 = $new_p_image2;

        }

        if (empty($product_img3)) {

            $product_img3 = $new_p_image3;

        }

        move_uploaded_file($temp_name1, "product_images/$product_img1");
        move_uploaded_file($temp_name2, "product_images/$product_img2");
        move_uploaded_file($temp_name3, "product_images/$product_img3");

        $update_product = "update products set p_cat_id='$product_cat',cat_id='$cat',manufacturer_id='$manufacturer_id',date=NOW(),product_title='$product_title',product_url='$product_url',product_img1='$product_img1',product_img2='$product_img2',product_img3='$product_img3',product_price='$product_price',product_psp_price='$psp_price',product_desc='$product_desc',product_features='$product_features',product_video='$product_video',product_keywords='$product_keywords',product_label='$product_label',status='$status' where product_id='$p_id'";

        $run_product = mysqli_query($con, $update_product);

        if ($run_product) {
            $query = "select subscriber_id from subscribers where product_id = $p_id";
            echo "<script>alert('$query')</script>";
            $run_mail = mysqli_query($con, $query);
            if ($run_mail) {
                $subscribers = mysqli_fetch_all($run_mail);
                foreach ($subscribers as $key => $value) {
                    echo
                        "
                    <script>
                        $.ajax({
                            url: 'http://mysql:3000/mail',
                            type: 'POST',
                            data: JSON.stringify({ to_id: '" . $value[0] . "', product_title : '$product_title', 'new_price': '$product_price' }),
                            contentType: 'application/json; charset=utf-8',
                            success: function (response) {
                                console.log(response);
                            }
                        });
                        </script>
                        ";
                }
            } else {
                echo "<script>alert('DB Error')</script>";
            }

            echo "<script> alert('Product has been updated successfully and mail sent') </script>";

        }

    }

    ?>

<?php }?>
