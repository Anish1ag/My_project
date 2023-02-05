<?php include('Common/header.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >EDIT USER</h1>
            <br>
            <?php include('session.php') ?>
            <?php

            //getting id
            $id = $_GET['id'];
         
            //making sql to select value
            $sql = "SELECT * FROM users where id='$id'";

            //execute the query
            $exec = mysqli_query($conn , $sql);

            //count the number of rows

            $count = mysqli_num_rows($exec);

            if($count == 1 ){
                while($rows=mysqli_fetch_assoc($exec)){
                    $id = $rows['id'];
                    $full_name = $rows['full_name'];
                    $user_name = $rows['user_name'];
                }
        }
            ?>
            <!-- Users table start -->
    <form method="post" action="" >
        <table class="table">
            <tr>
                <td class="text-right">UserName:</td>
                <td><input type="text" name="user_name" value="<?php echo $user_name; ?>" placeholder="Enter your username" id="user_name" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">fullName:</td>
                <td><input type="text" name="full_name"  value="<?php echo $full_name; ?>" placeholder="Enter your name" id="full_name" class="form-control"></td>
            </tr>
            <tr>
                <td colspan="2" class="text-center">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="submit" name="submit" id="submit" value="submit" class="btn btn-primary"></td>
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
    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if(isset($_POST['submit'])){
            //getting the data from the web form 
            $full_name=$_POST['full_name'];
            $user_name=$_POST['user_name'];
            $id = $_POST['id'];

            //making sql
            $sql= "UPDATE  users SET
            full_name='$full_name',
            user_name='$user_name'
            WHERE id='$id'
            ";
//check the connection
            if ($conn){
                $execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                //create database
                if($execute = TRUE){
                    $_SESSION['message']= '<div class="success">User updated Successfully</div>';
                    Header('location:'.APP_URL.'admin/manage-user.php');
                }else{
                    $_SESSION['message']= '<div class="error">Could not Edit User .Try Again!!</div>';
                    Header('location:'.APP_URL.'admin/adduser.php');
                }
            }else{
                die("Connection Failed!". mysqli_connect_error());
            }
        }
    }
    


    ?>