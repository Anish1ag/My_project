<?php 
ob_start();
include('constants.php');
include('logincheck.php');
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="../admin/admin.css">
</head>
<body>
    <h1></h1>
    <!--menu section starts-->
    <section class="menu-bar">
        <div class="wrapper">
            <div class="logo">
                <img src="../image/sahakarikhajalogo.png" class="img-responsive" alt="logo">
            </div>
            <div class="menu text-center">
                <ul>
                    <li><a href="index.php">Dashboard</a></li>
                    <li><a href="manage-user.php">User</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-products.php">Product</a></li>
                    <li><a href="manage-order.php">Order</a></li>
                    <li><a href="logout.php">logout</a></li>

                </ul>
            </div>
            <div class="clear-fix"></div>
</div>
</section>
<!--menu section ends-->