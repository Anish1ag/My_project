<?php include('Common/header.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >ADD USER</h1>
            <br><br>
            <?php include('session.php') ?>
            <!-- Users table start -->
    <form method="post" action="adduser.php" >
        <table class="table">
            <tr>
                <td class="text-right">UserName:</td>
                <td><input type="text" name="user_name" placeholder="enter your user name" id="user-name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">fullName:</td>
                <td><input type="text" name="full_name" placeholder="enter your full name" id="full-name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Password:</td>
                <td><input type="password" name="password" placeholder="enter your password" id="password" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center"><input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary"></td>
            </tr>
        </table>
    </form>
    
            <!-- table ends -->

            </div>
        </section>
        <!-- body end here -->


    
    <?php include('Common/footer.php') ?>
    <?php 
    //form submit code
   //check if request method is POST or not.
 if($_SERVER["REQUEST_METHOD"] == "POST"){
    if(isset($_POST['submit'])){
        var_dump($_POST);
        
         //Getting the data from the web form in respective variable
         $full_name = $_POST['full_name'];
         $user_name = $_POST['user_name'];
         $password = md5($_POST['password']);
 
         //making sql 
         $sql = "INSERT INTO USERS SET 
         full_name='$full_name',
         user_name='$user_name',
         password='$password'
         ";
 
        //Check the connection 
     if($conn)
            {$execute = mysqli_query($conn , $sql) or die(mysqli_error($conn));
         //create database
             if($execute = TRUE){
                 $_SESSION['message'] = "User Added Successfully";
                 header('location:'.APP_URL.'admin/manage-user.php');
             }else{
                 $_SESSION['message'] = "Could not Add User Instantly. Try Again";
                 header('location:'.APP_URL.'admin/add-user.php');
             }
 
     }else{
         die("Connection Failed!".mysqli_connect_error());
     }
     
     }
 }
 ?>