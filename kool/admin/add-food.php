<?php include('includes/menu.php'); ?>

<div class="main">
        
        <div class="wrapper">
            <h1>Add food</h1>
            <br><br>

            <?php
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }
                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
            
            ?>

        <!-- add Food form start -->
            
            <form action="" method="POST" enctype="multipart/form-data">
                <table class="tbl-form">
                    <tr>
                        <td>Title: </td>
                        <td>
                            <input type="text" name="title" placeholder="Food Title">
                        </td>
                    </tr>
                    <tr>
                        <td>Description: </td>
                        <td>
                            <textarea name="description" id="" cols="30" rows="5" placeholder="Food Description"></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price: </td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>
                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image" placeholder="">
                        </td>
                    </tr>
                    <tr>
                        <td>Category: </td>
                        <td>
                            <select name="category">
                                <?php
                                    //create php code to display categories from database
                                    //1.sql query to get all ACTIVE categories from db

                                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                                    $res = mysqli_query($conn, $sql);

                                    $count = mysqli_num_rows($res);

                                    if($count>0)
                                    {
                                        //2. user while loop to display active categories on dropdown
                                        while($row = mysqli_fetch_assoc($res))
                                        {
                                            //get the details of the category
                                            $id = $row['id'];
                                            $title = $row['title'];
                                            ?>
                                                <option value="<?php echo $id;?>"><?php echo $title;?> </option>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        ?>
                                        <option value="0">No category found</option>
                                        <?php
                                    }
                                        ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Featured: </td>
                        <td>
                            <input type="radio" name="featured" value="Yes"> Yes
                            <input type="radio" name="featured" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td>Active: </td>
                        <td>
                            <input type="radio" name="active" value="Yes"> Yes
                            <input type="radio" name="active" value="No"> No
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type="submit" name="submit" value="Add Food" class="btn-secondary">
                        </td>
                    
                    </tr>
                </table>
            </form>
            <?php
                //submit button check
                if(isset($_POST['submit']))
                {
                    //Add the food in database
                    
                    //1. get data from form 
                    $title = $_POST['title'];
                    $description = $_POST['description'];
                    $price = $_POST['price'];
                    $category = $_POST['category'];
                    
                    // verify radio button of featured and active are checked
                    if(isset($_POST['featured']))
                    {
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        $featured = "No";
                    }
                    if(isset($_POST['active']))
                    {
                        $active = $_POST['active'];
                    }
                    else
                    {
                        $active = "No";
                    }

                    //2 .upload the food image
                    if(isset($_FILES['image']['name']))
                    {
                        $image_name = $_FILES['image']['name'];

                        // upload the image only if image is selected
                        if($image_name !="")
                        {

                            //auto rename the image
                            //get the extention of the image
                            $ext = @end(explode('.', $image_name));

                            //remane the image and save 
                            $image_name = "Food_image_".$title.rand(000, 999).'.'.$ext; 

                            $source_path = $_FILES['image']['tmp_name'];

                            $destination_path = "../images/food/".$image_name;

                            //finally upload the image

                            $upload = move_uploaded_file($source_path, $destination_path);

                            // check if the image is upload
                            // and if the image is not uploaded stop process and redirect
                            if($upload==false)
                            {
                                //set message
                                $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                                //redirect to add category
                                header('location:'.SITEURL.'admin/add-food.php');
                                //stop process
                                exit;
                            }
                        }

                    }
                    else
                    {
                        //dont upload image
                        $image_name ="";
                    }
                    
                    
                    //3. insert into database
                        // for int dont need ''
                    $sql2 = "INSERT INTO tbl_food SET 
                        title = '$title',
                        description = '$description',
                        price = $price,
                        image_name = '$image_name',
                        category_id = $category,
                        featured = '$featured',
                        active = '$active'
                        ";
                        
                    $res2 = mysqli_query($conn, $sql2);

                    if($res2 == true)
                    {
                        //query executed and food added
                        $_SESSION['add'] = "<div class='success'>Food added successfully</div>";
                        //redirect to manage food page
                        header('location:'.SITEURL.'admin/manage-food.php');
                        
                        
                    }
                    else
                    {
                        //failed to add category 
                        $_SESSION['add'] = "<div class='error'>Failed to add new Food</div>";
                        //redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-food.php');
                        
                        
                        
                    }
                    
                }
            
            
            ?>

            <!-- add Food form end -->





            </div>
</div>


<?php include('includes/footer.php'); ?>