<!DOCTYPE html>
<head>
<script src="../js/jquery.min.js"> </script>
</head>
<?php
$db = mysqli_connect('mysql', "root", "pass", "Ecom_Store");
/// IP address code starts /////
function getRealUserIp()
{
    switch (true) {
        case (!empty($_SERVER['HTTP_X_REAL_IP'])):
            return $_SERVER['HTTP_X_REAL_IP'];
        case (!empty($_SERVER['HTTP_CLIENT_IP'])):
            return $_SERVER['HTTP_CLIENT_IP'];
        case (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])):
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        default:
            return $_SERVER['REMOTE_ADDR'];
    }
}
/// IP address code Ends /////
// items function Starts ///
function items()
{
    global $db;
    $ip_add = getRealUserIp();
    $get_items = "select * from cart where ip_add='$ip_add'";
    $run_items = mysqli_query($db, $get_items);
    $count_items = mysqli_num_rows($run_items);
    echo $count_items;
}
// items function Ends ///
// total_price function Starts //
function total_price()
{
    global $db;
    $ip_add = getRealUserIp();
    $total = 0;
    $select_cart = "select * from cart where ip_add='$ip_add'";
    $run_cart = mysqli_query($db, $select_cart);
    while ($record = mysqli_fetch_array($run_cart)) {
        $pro_id = $record['p_id'];
        $pro_qty = $record['qty'];
        $sub_total = $record['p_price'] * $pro_qty;
        $total += $sub_total;
    }
    echo "Rs." . $total;
}
// total_price function Ends //
function addToCart($item_id, $qty, $price, $size)
{
    global $db;
    $ip_add = getRealUserIp();
    $insert_cart = "insert into cart (p_id, ip_add, qty, p_price, size) VALUES
($item_id, '$ip_add', $qty, '$price', '$size')";
    $run_cart = mysqli_query($db, $insert_cart);
    if ($run_cart) {
        echo "<script> alert('Item has been added to Cart')</script>";
        echo "<script> window.open('cart.php','_self') </script>";
    }
}
// getPro function Starts //
function getPro()
{
    $loading_str = file_get_contents("functions/loader-b64.txt");
    global $db;
    $get_products = "select * from products order by 1 DESC LIMIT 0,8";
    $run_products = mysqli_query($db, $get_products);
    while ($row_products = mysqli_fetch_array($run_products)) {
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $manufacturer_id = $row_products['manufacturer_id'];
        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
        $run_manufacturer = mysqli_query($db, $get_manufacturer);
        $row_manufacturer = mysqli_fetch_array($run_manufacturer);
        $manufacturer_name = $row_manufacturer['manufacturer_title'];
        $pro_url = 'images/' . $row_products['product_url'] . '.php';
        echo "
            <div class='col-md-4 col-sm-6 single' >
            <div class='product' >
            <a href='$pro_url' >
            <img src='" . $loading_str . "' class='img-responsive' id='imageId_$pro_id' >
            </a>
            <div class='text' >
            <center>
            <p class='btn btn-primary'> $manufacturer_name </p>
            </center>
            <hr>
            <h3><a href='$pro_url' >$pro_title</a></h3>
            <p class='price' >Rs. $pro_price </p>
            <p class='buttons' >
            <a href='$pro_url' class='btn btn-default' >View details</a>
            <a href='cart.php?itemId=$pro_id&quantity=1&price=$pro_price&size=Medium' class='btn btn-primary'>
            <i class='fa fa-shopping-cart'></i> Add to cart
            </a>
            <a href='index.php?subscribe=true&product_id=$pro_id' class='btn btn-primary'>Subscribe</a>
            </p>
            </p>
            </div>
            </div>
            </div>
            <script>
            var wid = screen.availWidth;
            var level = 0;
            if (wid <= 425) level = 3;
            else if (wid <= 768) level = 2;
            else if (wid <= 1440) level = 1;
            else level = 0;
            $(document).ready(function () {
                $.ajax({
                    url: 'http://0.0.0.0:3000/image',
                    type: 'POST',
                    data: JSON.stringify({ image_name: '" . $pro_img1 . "', level: level }),
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        document.getElementById('imageId_$pro_id').src = response.data;
                    }
                });
            });
            </script>
            ";
    }
}
function addSubscriber($product_id, $customer_id)
{
    echo "<script>alert('$product_id, $customer_id')</script>";
    global $db;
    $query = "insert into subscribers values($product_id, '$customer_id')";
    $result = mysqli_query($db, $query);
    if ($result) {
        echo "<script>alert('You have subscribed to the Product!')</script>";
    } else {
        echo "<script>alert('Failed!')</script>";
    }
}
/// getProducts Function Starts ///
function getProducts()
{
/// getProducts function Code Starts ///
    global $db;
    $loading_str = file_get_contents("functions/loader-b64.txt");
    $aWhere = array();
/// Manufacturers Code Starts ///
    if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {
        foreach ($_REQUEST['man'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'manufacturer_id=' . (int) $sVal;
            }
        }
    }
/// Manufacturers Code Ends ///
    /// Products Categories Code Starts ///
    if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {
        foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'p_cat_id=' . (int) $sVal;
            }
        }
    }
/// Products Categories Code Ends ///
    /// Categories Code Starts ///
    if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {
        foreach ($_REQUEST['cat'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'cat_id=' . (int) $sVal;
            }
        }
    }
/// Categories Code Ends ///
    $per_page = 6;
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    $start_from = ($page - 1) * $per_page;
    $sLimit = " order by 1 DESC LIMIT $start_from,$per_page";
    $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' or ', $aWhere) : '') . $sLimit;
    $get_products = "select * from products  " . $sWhere;
    $run_products = mysqli_query($db, $get_products);
    while ($row_products = mysqli_fetch_array($run_products)) {
        $pro_id = $row_products['product_id'];
        $pro_title = $row_products['product_title'];
        $pro_price = $row_products['product_price'];
        $pro_img1 = $row_products['product_img1'];
        $manufacturer_id = $row_products['manufacturer_id'];
        $get_manufacturer = "select * from manufacturers where manufacturer_id='$manufacturer_id'";
        $run_manufacturer = mysqli_query($db, $get_manufacturer);
        $row_manufacturer = mysqli_fetch_array($run_manufacturer);
        $manufacturer_name = $row_manufacturer['manufacturer_title'];
        $pro_url = 'images/' . $row_products['product_url'] . '.php';
        echo "
            <div class='col-md-4 col-sm-6 center-responsive' >
            <div class='product' >
            <a href='$pro_url' >
            <img src='" . $loading_str . "' class='img-responsive' id='imageId_$pro_id'>
            </a>
            <div class='text' >
            <center>
            <p class='btn btn-primary'> $manufacturer_name </p>
            </center>
            <hr>
            <h3><a href='$pro_url' >$pro_title</a></h3>
            <p class='price' >Rs. $pro_price</p>
            <p class='buttons' >
            <a href='$pro_url' class='btn btn-default' >View details</a>
            <a href='cart.php?itemId=$pro_id&quantity=1&price=$pro_price&size=Medium' class='btn btn-primary'>
            <i class='fa fa-shopping-cart'></i> Add to cart
            </a>
            <a href='index.php?subscribe=true&product_id=$pro_id' class='btn btn-primary'>Subscribe</a>
            </div>
            </div>
            </div>
            <script>
            var wid = screen.availWidth;
            var level = 0;
            if (wid <= 425) level = 3;
            else if (wid <= 768) level = 2;
            else if (wid <= 1440) level = 1;
            else level = 0;
            $(document).ready(function () {
                $.ajax({
                    url: 'http://0.0.0.0:3000/image',
                    type: 'POST',
                    data: JSON.stringify({ image_name: '" . $pro_img1 . "', level: level }),
                    contentType: 'application/json; charset=utf-8',
                    success: function (response) {
                        document.getElementById('imageId_$pro_id').src = response.data;
                    }
                });
            });
            </script>
            ";
        // loadImages($pro_img1, $pro_id);
    }
/// getProducts function Code Ends ///
}
/// getProducts Function Ends ///
/// getPaginator Function Starts ///
function getPaginator()
{
/// getPaginator Function Code Starts ///
    $per_page = 6;
    global $db;
    $aWhere = array();
    $aPath = '';
/// Manufacturers Code Starts ///
    if (isset($_REQUEST['man']) && is_array($_REQUEST['man'])) {
        foreach ($_REQUEST['man'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'manufacturer_id=' . (int) $sVal;
                $aPath .= 'man[]=' . (int) $sVal . '&';
            }
        }
    }
/// Manufacturers Code Ends ///
    /// Products Categories Code Starts ///
    if (isset($_REQUEST['p_cat']) && is_array($_REQUEST['p_cat'])) {
        foreach ($_REQUEST['p_cat'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'p_cat_id=' . (int) $sVal;
                $aPath .= 'p_cat[]=' . (int) $sVal . '&';
            }
        }
    }
/// Products Categories Code Ends ///
    /// Categories Code Starts ///
    if (isset($_REQUEST['cat']) && is_array($_REQUEST['cat'])) {
        foreach ($_REQUEST['cat'] as $sKey => $sVal) {
            if ((int) $sVal != 0) {
                $aWhere[] = 'cat_id=' . (int) $sVal;
                $aPath .= 'cat[]=' . (int) $sVal . '&';
            }
        }
    }
/// Categories Code Ends ///
    $sWhere = (count($aWhere) > 0 ? ' WHERE ' . implode(' or ', $aWhere) : '');
    $query = "select * from products " . $sWhere;
    $result = mysqli_query($db, $query);
    $total_records = mysqli_num_rows($result);
    $total_pages = ceil($total_records / $per_page);
    echo "<li><a href='shop.php?page=1";
    if (!empty($aPath)) {
        echo "&" . $aPath;
    }
    echo "' >" . 'First Page' . "</a></li>";
    for ($i = 1; $i <= $total_pages; $i++) {
        echo "<li><a href='shop.php?page=" . $i . (!empty($aPath) ? '&' . $aPath : '') . "' >" . $i . "</a></li>";
    }
    ;
    echo "<li><a href='shop.php?page=$total_pages";
    if (!empty($aPath)) {
        echo "&" . $aPath;
    }
    echo "' >" . 'Last Page' . "</a></li>";
/// getPaginator Function Code Ends ///
}
/// getPaginator Function Ends ///
?>
