<?php include('includes/menu.php'); ?>

<div class="main">
        
        <div class="wrapper">
            <h1>Add Category</h1>
            <br><br>


            <?php

                if(isset($_SESSION['add']))
                {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['upload']))
                {
                    echo $_SESSION['upload'];
                    unset($_SESSION['upload']);
                }

            ?>

            <!-- add category form start -->
            
            <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-form">
                <tr>
                    <td>title: </td>
                    <td>
                        <input type="text" name="title" placeholder="Category Title">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image" placeholder="">
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
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
            </form>

            <!-- add category form end -->

            <?php

                 // Process the value from Form and save it in Database

                // Check if the submit buttom is clicked or not

                if(isset($_POST['submit']))
                {
                    // buttom clicked
                    
                
                    //1. Get the value from category form
                    $title = $_POST['title'];

                    // for radio input, we need  to check if the button is selected
                    if(isset($_POST['featured']))
                    {
                        // get the value from form
                        $featured = $_POST['featured'];
                    }
                    else
                    {
                        // set the default value
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

                    // check if the image is selected and set the value for image name
                    // print_r($_FILES['image']);
                    // die();
                    if(isset($_FILES['image']['name']))
                    {
                        //upload the image
                        //to upload the image we need image name, source path and destination path

                        $image_name = $_FILES['image']['name'];

                        // upload the image only if image is selected
                        if($image_name !="")
                        {

                            //auto rename the image
                            //get the extention of the image
                            $ext = end(explode('.', $image_name));

                            //remane the image and save 
                            $image_name = "Food_category_".$title.rand(000, 999).'.'.$ext; 

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
                                header('location:'.SITEURL.'admin/add-category.php');
                                //stop process
                                die();
                            }
                        }

                    }
                    else
                    {
                        //dont upload image
                        $image_name ="";
                    }

                    //2. create sql query to insert into database

                    $sql = "INSERT INTO tbl_category SET
                            title='$title',
                            image_name='$image_name',
                            featured='$featured',
                            active='$active'
                            ";
                    //3. create query and save in database

                    $res = mysqli_query($conn, $sql);

                    //4. check if the query is executed and data added

                    if($res==true)
                    {
                        //query executed and catefory added
                        $_SESSION['add'] = "<div class='success'>Category added successfully</div>";
                        //redirect to manage category page
                        header('location:'.SITEURL.'admin/manage-category.php');

                    }
                    else
                    {
                        //failed to add category 
                        $_SESSION['add'] = "<div class='error'>Failed to add new Category</div>";
                        //redirect to manage category page
                        header('location:'.SITEURL.'admin/add-category.php');

                    }
                }

            
            
            
            ?>

        </div>
</div>




<?php include('includes/footer.php'); ?>