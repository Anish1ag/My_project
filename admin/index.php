<?php include('Common/header.php') ?>

   <!--body section starts-->
   <section class="content">
        <div class="wrapper">
            <strong> <div class="heading"> Dashboard</div></strong>
            <br>
            <?php 
                include('session.php');
            ?>
            <div class="clearfix"></div>

            <div class="col-4 text-center">
                <h2></h2>
                <a href="manage-user.php">
                <h2>Users</h2>
                </a>
                <br>
</div>
<div class="col-4 text-center">
                <h2></h2>
                <a href="manage-category.php">
                <h2>Categories</h2>
                </a>
                <br>
</div>
<div class="col-4 text-ceter">
                <h2></h2>
                <a href="manage-products.php">
                <h2>Products</h2>
                </a>
                <br>
</div>
<div class="col-4 text-center">
                <h2></h2>
                <a href="manage-order.php">
                <h2>Orders</h2>
                </a>
                <br>
</div>
<div class="clear-fix"></div> 

</div>
</section>
           


<!--body section ends-->
<?php include('Common/footer.php') ?>
 