<?php include('Common/header.php') ?>
     <!-- Body Section Starts -->
     <section class="content">
        <div class="wrapper">
        <h1 class="heading">EDIT PRODUCTS</h1>
        <br><br>
        <?php include('session.php') ?>
        <?php 
        //getting id 
        $id = $_GET['id'];
        
        //making sql to select value 
        $sql = "SELECT * FROM products where id='$id'";

        //execute the query
        $exec = mysqli_query($conn, $sql);

        //count the number of rows
        $count = mysqli_num_rows($exec);

        if($count == 1){
            while($rows=mysqli_fetch_assoc($exec)){
                $id = $rows['id'];
                $title = $rows['title'];
                $price = $rows['price'];
                $description = $rows['description'];
                $old_category_id = $rows['category_id'];
                $featured = $rows['featured'];
                $current_image = $rows['image_name'];
                $status = $rows['status'];
            }
        }
        ?>
            <!-- Users Add Form -->
            <form method="post" action="" enctype="multipart/form-data">
            <table class="table">
                    <tr>
                        <td class="text-right">Title</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?> " placeholder="Enter title.." id="" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Price</td>
                        <td>
                            <input type="text" name="price" value="<?php echo $price; ?> " placeholder="Enter price.." id="" class="form-control">
                        </td>
                    </tr>
                    
                    <tr>
                            <td class="text-right">Category</td>
                            <td>
                            <select name="category_id" id="category" class="form-control">
                            <?php
                                //creating the sql
                                $sql = "SELECT * FROM categories";

                                //execute the query
                                $execute = mysqli_query($conn,$sql);

                                //if true
                                if($execute == TRUE){
                                    //count the number
                                    $count = mysqli_num_rows($execute);

                                    if($count> 0){
                                        while($rows = mysqli_fetch_assoc($execute)){
                                            $category_name = $rows['title'];
                                            $category_id = $rows['id'];
                                            ?>
                                            <option <?php if($old_category_id!="" && $category_id == $old_category_id){echo "selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_name; ?></option>
                                            <?php
                                        }
                                    }else{
                                        echo "<option>No Category. </option>";
                                    }
                                }else{
                                    //
                                    echo "<option>No Category. </option>";
                                }
                            ?>
                            </select>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-right">Description</td>
                            <td>
                                <textarea rows="5"  name="description" placeholder="Enter description" id="description" class="form-control"><?php echo $description; ?></textarea>
                            </td>
                        </tr>
                    <tr>
                        <td class="text-right">Current Image</td>
                        <?php
                                        if($current_image != "") {
                                            ?>
                                            <td>
                                            <img width="100" height="100" src="../image/<?php echo $current_image; ?>" alt="<?php echo $title; ?>">
                                            </td>
                                            <?php
                                        }else{
                                           echo '<td>No Image Found</td>'; 
                                        }
                                    ?>
                    </tr>
                    <tr>
                        <td class="text-right">Upload New Image</td>
                        <td>
                            <input type="file" accept="image/*" name="image" id="image" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Featured</td>
                        <td>
                            <input type="radio" <?php if($featured == "Yes"){echo "checked";} ?> name="featured" id="" value="Yes">Yes
                            <input type="radio" <?php if($featured == "No"){echo "checked";} ?> name="featured" id="" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td class="text-right">Status</td>
                        <td>
                            <input type="radio" <?php if($status == "Yes"){echo "checked";} ?> name="status" id="" value="Yes">Active
                            <input type="radio" <?php if($status == "No"){echo "checked";} ?> name="status" id="" value="No"> InActive
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="text-center">
                            <input type="hidden" name="id" value="<?php echo $id;?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image;?>">
                            <input type="submit" name="submit" id="submit" value="Submit" class="btn btn-primary">
                        </td>
                    </tr>
                </table>
            </form>
            <!-- Users Add Form End -->
        </div>
    </section>
    <!-- Body Section Ends -->

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['submit'])){
        
        $title = $_POST['title'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        if(isset($_POST['featured'])){
            $featured = $_POST['featured'];
        }else{
            $featured = "No";
        }
        if(isset($_POST['status'])){
            $status = $_POST['status'];
        }else{
            $status = "No";
        }
        $id = $_POST['id'];
        $current_image = $_POST['current_image'];
         if($_FILES['image']['name']){
            $file_end = explode('.',$_FILES['image']['name']);
            $ext = end($file_end);
            $image = 'Product_'.rand(1111,9999).'.'.$ext;
            //uppload the image
            $uploaded_path = $_FILES['image']['tmp_name'];
            $destination_path = "../image/".$image;

            $upload = move_uploaded_file($uploaded_path, $destination_path);

            if($upload == false){
                $_SESSION['message'] = '<div class="error">Could not upload the image. Try Again</div>';
                die();
            }else{
                $image_name = $image;

                //remove the old image
                if(file_exists("../image/".$current_image)){
                    @unlink("../image/".$current_image);
                }
            }
        }else{
            $image_name = $current_image;
        }

        //making sql 
        $sql = "UPDATE PRODUCTS SET 
        title='$title',
        price='$price',
        description='$description',
        category_id='$category_id',
        featured='$featured',
        status='$status',
        image_name='$image_name'
        WHERE id='$id'";
       
	if($conn){
		$execute = mysqli_query($conn, $sql) or die(mysqli_error($conn));
			if($execute == TRUE){
				$_SESSION['message'] = "<div class='success'>Product updated Successfully</div>";
                header('location:'.APP_URL.'admin/manage-products.php');

			}else{
				$_SESSION['message'] = '<div class="error">Could not Edit Product Instantly. Try Again</div>';
                header('location:'.APP_URL.'admin/edit-products.php');
			}

	}else{
		die("Connection Failed!".mysqli_connect_error());
	}
    
    }
}
?>
<?php include('Common/footer.php')?>