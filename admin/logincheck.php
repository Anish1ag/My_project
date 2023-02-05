<?php
if(!isset($_SESSION['user'])){
$_SESSION['message']='<div class="error">Please login to access the Admin.</div>';
 header('location:'.APP_URL.'admin/login.php');
}
?>