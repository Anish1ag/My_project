<?php include('header.php'); ?>

    <!--Search Bar Begins Here-->
    <section class="search text-center">
        <div class="container">
            <form method="GET" action="search_result.php">
                <input type="search" name="search" id="search" placeholder="Search for Food here...">
                <input type="button" value="Search" class="btn btn-primary">
            </form>
        </div>
    </section>
    <!--Search Ends Here-->

    <!--explore section begins here-->

    <section class="food-menu">
      <div class="container">
        <h2 class="text-center">EXPLORE FOODS</h2>
        
        <?php
                //sql to fetch products

                $product_sql = "SELECT * FROM products WHERE status = 'yes'";

                //execute this sql
                $pro_exec = mysqli_query($conn,$product_sql);

                //check if execution is true
                if($pro_exec == TRUE){
                    //count the numer of rows
                    $count = mysqli_num_rows($pro_exec);
                    
                    if($count > 0){
                        //run the while loop
                        while($pro_rows= mysqli_fetch_assoc($pro_exec)){
                           $pro_id = $pro_rows['id'];
                           $pro_title = $pro_rows['title'];
                           $pro_description = $pro_rows['description'];
                           $pro_price = $pro_rows['price'];
                           $pro_image = $pro_rows['image_name'];
                           ?>
                            <div class="box">
                                <div class="box-img">
                                <img src="image/<?php echo $pro_image; ?>" alt="<?php echo $pro_title; ?>" class="img-responsive img-rounded">
                                </div>
                                <div class="box-desc">
                                    <h4><?php echo $pro_title; ?></h4>
                                    <p class="item-price">Rs.<?php echo $pro_price; ?></p>
                                    <p class="item-desc"><?php echo $pro_description; ?></p>
                                    <a href="<?php echo APP_URL; ?>order.php?id=<?php echo $pro_id; ?>" class="btn btn-primary">Order Now</a>
                                </div>
                            </div>
                            <?php
                        }
                    }else{
                        echo "<div class='text-center'>No Products found.</div>";

                    }
                }
            ?>
       
          <div class="clearfix"></div>
        </div>
    </section>
    <!--explore section ends here-->

    <?php include('footer.php'); ?>