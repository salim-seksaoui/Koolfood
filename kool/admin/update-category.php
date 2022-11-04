<?php include('includes/menu.php'); ?>

<div class="main">
        
        <div class="wrapper">
            <h1>Update Category</h1>
            <br><br>

            <?php
            
                //check if the id is set 
                if(isset($_GET['id']))
                {
                    //get the id and all details
                    $id = $_GET['id'];

                    //create sql query to get all details
                    $sql = "SELECT * FROM tbl_category WHERE id ='$id'";

                    // exec the query
                    $res = mysqli_query($conn, $sql);

                    //count the rows to check if id is valid
                    $count = mysqli_num_rows($res);

                    if($count==1)
                    {
                        // get all the data
                        $row = mysqli_fetch_assoc($res);
                        $title = $row['title'];
                        $current_image = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];
                    }
                    else
                    {
                        // redirect with error message
                        $_SESSION['no-category-found'] = "<div class='error'>category not found sorry</div>";
                        header('Location:'.SITEURL.'admin/manage-category.php');
                    }
                }
                else
                {
                    //redirect to manage category
                    header('Location:'.SITEURL.'admin/manage-category.php');
                }
            
            
            ?>

            <!-- Update category form start -->
            
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-form">
                <tr>
                    <td>title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current image: </td>
                    <td>
                        <?php
                            
                            if($current_image !="")
                            {
                                //display image
                                ?>

                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px" height="150px">

                                <?php

                                
                            }
                            else
                            {
                                //display error message
                                echo "<div class='error'>Image not Added.</div>";
                            }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td>New image: </td>
                    <td>
                        <input type="file" name="image" >
                    </td>
                </tr>
                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "Checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "Checked";} ?> type="radio" name="featured" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "Checked";} ?> type="radio" name="active" value="Yes"> Yes

                        <input <?php if($active=="No"){echo "Checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
            </form>

            <?php
            
                if(isset($_POST['submit']))
                {
                    //1. Get the value from form

                    $id = $_POST['id'];
                    $title = $_POST['title'];
                    $current_image = $_POST['current_image'];
                    $featured = $_POST['featured'];
                    $active = $_POST['active'];

                    //2. Updating new image if selected

                    if(isset($_FILES['image']['name']))
                    {
                        //get the image details
                        $image_name = $_FILES['image']['name'];

                        // check if the image is available
                        if($image_name !="")
                        {
                            //A. upload the new image

                            //auto rename the image
                            //get the extention of the image
                            $ext = end(explode('.', $image_name));

                            //remane the image and save 
                            $image_name = "Food_category_".rand(000, 999).'.'.$ext; 

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/category/".$image_name;

                            //finally upload the image

                            $upload = move_uploaded_file($source_path, $destination_path);
                            
                            // check if the image is upload
                            // and if the image is not uploaded stop process and redirect
                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                //redirect to add category
                                header('location:'.SITEURL.'admin/manage-category.php');
                                //stop process
                                die();
                            }

                            //B. remove the old image if the image available
                            if($current_image !="")
                            {
                                $remove_path = "../images/category/".$current_image;
                                $remove = unlink($remove_path);
    
                                //check if the image is removed
                                //if failed to remove then display message and stop process
                                if($remove==false)
                                {
                                    $_SESSION['failed-remove'] = "<div class='error'>Failed to remove current image</div>";
                                    header('Location:'.SITEURL.'admin/manage-category.php');
                                    die();
                                }
                            }
            
                        }
                        else
                        {
                            $image_name = $current_image;
                        }
                    }
                    else
                    {
                        $image_name = $current_image;
                    }

                    //3. update the database

                    $sql2 = "UPDATE tbl_category SET
                            title = '$title',
                            image_name = '$image_name',
                            featured = '$featured',
                            active = '$active'
                            WHERE id='$id'
                            ";
                    //exec the query
                    $res2 = mysqli_query($conn, $sql2);

                    //4. redirect to manage category
                    //check whether is executed successfully
                    if ($res2==true)
                    {
                        //category updated
                        $_SESSION['update'] = "<div class='success'>Category updated successfully</div>";
                        header('Location:'.SITEURL.'admin/manage-category.php');
                    }
                    else
                    {
                        $_SESSION['update'] = "<div class='error'>Failed to update category</div>";
                        header('Location:'.SITEURL.'admin/manage-category.php');
                    }




                }
            
            ?>

            <!-- Update category form end -->








        </div>
</div>




<?php include('includes/footer.php'); ?>