<?php include('includes/menu.php');?>

<!-- main content starts-->

    <div class="main">

        <div class="wrapper">
        <h1>Manage Category</h1>
        <br><br>

        
        <?php

            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }

            if(isset($_SESSION['failed-remove']))
            {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }
        ?>
        <br><br>

        <!-- buttom to Add  -->
        <br> 
        <a class="btn-primary" href="<?php echo SITEURL;?>admin/add-category.php">Add Category</a>
        <br><br><br>

        <!-- Tables starts -->

        <table class="tbl-full">
            <tr>
                <th>Number</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>

            <?php
                // query to get all categories from database
                $sql = "SELECT * FROM tbl_category";

                // exe the query 
                $res = mysqli_query($conn, $sql);

                //count rows 
                $count = mysqli_num_rows($res);

                // serial number variables
                $sn=1;

                // check if we have data in db
                if($count>0)
                {
                    //data found
                    //get the data and display
                    while($row=mysqli_fetch_assoc($res))
                    {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                        ?>

                            <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $title; ?></td>

                                        <td>
                                            <?php  
                                                //check if image is available
                                                if($image_name!=="")
                                                {
                                                    //display the image
                                                    ?>

                                                    <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?> " width="100px" height="100px">

                                                    <?php
                                                }
                                                else
                                                {
                                                    //display the error message
                                                    echo "<div class='error'>Image not found</div>";
                                                }

                                            ?>
                                        
                                        </td>

                                        <td><?php echo $featured; ?></td>
                                        <td><?php echo $active; ?></td>
                                        <td>
                                            <a href="<?php echo SITEURL;?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                            <a href="<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Category</a>
                                        </td>

                                        
                            </tr>







                        <?php




                    }
                }
                else
                {
                    //data empty
                    //display message inside tables
                    ?>

                    <tr>
                        <td colspan="6">
                            <div class="error">No category Added.</div>
                        </td>
                    </tr>

                    <?php
                }

            
            ?>



        </table>
        <!-- Table End -->
        
        </div>
    </div>
    <!-- main content sections end -->


<?php include('includes/footer.php');?>