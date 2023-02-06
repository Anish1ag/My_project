<?php include('header.php'); ?>

      <!--contact file -->
      <?php
      //get the id of the product
      $product_id = $_GET['id'];
      
      
      //sql to get the id of Product
      $sql = "SELECT * FROM products where id=$product_id";

      //execute the query
      $execute = mysqli_query($conn,$sql);

      //check if executed
      if($execute == TRUE){
        //COUNTING the number of rows
        $count = mysqli_num_rows($execute);

        //if exactly 1
        if($count == 1){
            //get the value of respective product
            $rows=mysqli_fetch_assoc($execute);
            $pro_title = $rows['title'];
            $pro_id = $rows['id'];
            $pro_price = $rows['price'];
            $pro_desc = $rows['description'];
            $pro_image = $rows['image_name'];

        }else{
            //redirect to the home page
            header('location:'.APP_URL);
        }

      }else{
        header('location:'.APP_URL);
      }

      ?>
      <section class ="search">
        <div class="container">
            <h2 class="text-center text-white ">Please fill the form to order the product</h2>
            <form action=""  method="post" class="form-horizontal">
                <fieldset>
                    <legend>Selected Item</legend>
                    <div class="box-img">
                        <img src="image/<?php echo $pro_image; ?>" alt="<?php echo $pro_title; ?>" class="img-responsive img rounded">
                    </div>
                    <div class="box-desc">
                        <h4><?php echo $pro_title; ?></h4>
                        <p class="item-price">Rs.<?php echo $pro_price; ?> </p>
                        <p class="item-desc"><?php echo $pro_desc; ?></p>
                    </div>
                </fieldset>

                <fieldset>
                    <legend>Order Details:</legend>
                <label for="" >Name</label>
                <input type="hidden" name="product_id" value="<?php echo $pro_id; ?>">
                <input type="hidden" name="product" value="<?php echo $pro_title; ?>">
                <input type="hidden" name="price" value="<?php echo $pro_price; ?>">
                   
                <input type="text" class="form-control" id="name" placeholder="Enter your name">

                <label for=""><br>Email</label>
                <input class="form-control" type="text" name="email" id="email" placeholder="Enter your email">

                <label for=""><br>Address</label>
                <input class="form-control" type="text" name="address" id="address" placeholder="eg. dhulikhel-2,kavre">

                <label for="">Contact</label>
                <input class="form-control" type="number" min=9000000000 max=9999999999 name="contact" id="contact" required placeholder="enter your contact number">

                <label for=""><br>Quantity</label>
                <input class="form-control" type="number" min="1" name="quantity" required id="quantity" value="1">

                <label for=""><br>Feedback</label>
                <textarea class="form-control" type="text" name="Feedback" id="feedback" cols="30" rows="10" placeholder="give your suggestions if any..."></textarea>

                <input type="submit" name="submit" class="btn text-center btn-primary">
            </fieldset>
            </form>
        </div>
      </section>

      <?php
    //to submit the form
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            //Getting the data from the web form in respective variable
            $product_id = $_POST['product_id'];  
            $product = $_POST['product'];
            $price = $_POST['price'];
            $quantity = $_POST['quantity'];
            $total = $price * $quantity;
            $customer_name = $_POST['name'];
            $customer_address = $_POST['address'];
            $customer_email = $_POST['email'];
            $customer_contact = $_POST['contact'];
            $customer_feedback = $_POST['feedback'];
            $order_date = date('Y-m-d H:i:sa');
    
            //making sql
            $sql = "INSERT INTO orders SET
            product_id='$product_id',
            product='$product',            
            price='$price',
            quantity='$quantity',
            total='$total',
            customer_name='$customer_name',
            customer_address='$customer_address',
            customer_contact='$customer_contact',
            customer_email='$customer_email',
            order_date='$order_date',
            customer_feedback='$customer_feedback'";

            //Check the connection
            if($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database 
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success"> Order placed Succefully </div>';
                    header('location:'.APP_URL);
                }else{
                    $_SESSION['message'] = '<div class="error"> Could not Add Order Instantly. Try Again </div>';
                    header('location:'.APP_URL.'order.php?id=$id');
                }
            }else{
                die("Connection Failed".mysqli_connect_error());
            }
        }
    }
    ?>
    
      <?php include('footer.php'); ?>
     
  
      