<?php

//getting the connection
include('constants.php');
 //taking the id 
 $id = $_GET['id'];
 //finding the category in order to delete photo
    //making sql to select value 
    $sql = "SELECT * FROM categories where id='$id'";

    //execute the query
    $exec = mysqli_query($conn, $sql);

    //count the number of rows
    $count = mysqli_num_rows($exec);

    if($count == 1){
        while($rows=mysqli_fetch_assoc($exec)){
            $current_image = $rows['image_name'];

            //remove the old image
            if(file_exists("images/".$current_image)){
                @unlink("images/".$current_image);
            }
        }
    }
// making the sql 

$sql = "DELETE FROM CATEGORIES WHERE ID = '$id'";

//execute query
$exec = mysqli_query($conn,$sql);

//checking either true or false
if($exec == TRUE){
    $_SESSION['message'] = '<div class="success"> Category Deleted Successfully </div>';

}else{
    $_SESSION['message'] = '<div class="error"> Something Went wrong. Try Again. </div>';
}
header('location:'.APP_URL.'admin/manage-category.php');
?>