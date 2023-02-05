<?php include('Common/header.php') ?>
    <!-- body sec. starts -->
    <section class="content">
            <div class="wrapper">
            <h1 class="heading" >UPDATE PASSWORD</h1>
            <br>
            <?php include('session.php') ?>
            <?php

            //getting id
            $id = $_GET['id'];
           
        
            ?>
            <!-- Users table start -->
    <form method="post" action="" >
        <table class="table">
            <tr>
                <td class="text-right">Old Password:</td>
                <td><input type="text" name="old_password"  placeholder="Enter your Old Password.." id="old-password" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">New Password:</td>
                <td><input type="text" name="new_password"   placeholder="Enter your New Password.." id="New-Password" class="form-control"></td>
            </tr>
            <tr>
                <td class="text-right">Confirm Password:</td>
                <td><input type="text" name="confirm_password"   placeholder="Enter your Confirm Password" id="confirm-Password" class="form-control"></td>
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
            $old_password=md5($_POST['old_password']);
            $new_password=md5($_POST['new_password']);
            $confirm_password=md5($_POST['confirm_password']);
            $id = $_POST['id'];

            //checking the user exist
            $checksql = "SELECT * FROM USERS WHERE ID =$id AND password='$old_password'";
            
            //execute the checking sql
            $exe = mysqli_query($conn ,$checksql);

            //if execution is successful
            if($exe == TRUE){
                //count the no. of rows
                $count = mysqli_num_rows($exe);

                if($count == 1){
            
            if($new_password == $confirm_password){
                //creating update sql
                $sql= "UPDATE  users SET
                password='$new_password',
                WHERE id='$id' AND password='$old_password'";

                //execute the query 
            $execute = mysqli_query($conn,$sql);

            //check if update
            if($execute == TRUE){
                $_SESSION['message'] = '<div class="success"> Password updated successfully.</div>';
                header('location:'.APP_URL.'admin/manage-user.php?id='.$id);
            }else{
                $_SESSION['message']= '<div class="error">Could not update the password.Try Again!</div>';
                header('location:'.APP_URL.'admin/update-password.php?id='.$id);
 
            }
        }else{
            $_SESSION['message']= '<div class="error">Please Confirm Your Password.</div>';
            header('location:'.APP_URL.'admin/update-password.php?id='.$id);
        }


            }else{
                $_SESSION['message'] = '<div class="error">Can not found the user.</div>';
                header('location:'.APP_URL.'admin/update-password.php?id='.$id);
            }
        }else{
            $_SESSION['message']= '<div class="error">Could not execute the query.Try Again!</div>';
            header('location:'.APP_URL.'admin/update-password.php?id='.$id);
        
    }
            
        }
    }
    


    ?>
