<?php

//getting the connection
include('constants.php');
//taking the id 

$id= $_GET['id'];

//making the sql
$sql = "DELETE FROM USERS WHERE ID = '$id'";

//execute query

$exec = mysqli_query($conn,$sql);

//checking either true or false
if($exec == TRUE){
    $_SESSION['message'] = '<div class="success"> Users Deleted successfully</div>';
   
}
else{
    $SESSION['message'] = '<div class="error"> Something Went wrong. Try Again. </div>';
}
header('location:'.APP_URL.'admin/manage-user.php');
?>