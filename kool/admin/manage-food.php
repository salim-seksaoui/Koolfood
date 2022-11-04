<?php include('includes/menu.php'); ?>

<!-- main content starts-->

    <div class="main">
        
        <div class="wrapper ">

        <h1>Manage Admin</h1>

<!-- buttom to Add  -->
<br> 
<a class="btn-primary" href="<?php echo SITEURL;?>admin/add-food.php">Add Food</a>
<br><br><br>

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
    if(isset($_SESSION['failed-remove']))
    {
        echo $_SESSION['failed-remove'];
        unset($_SESSION['failed-remove']);
    }
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);
    }

?>

<!-- Table starts -->

<table class="tbl-full">
    <tr>
        <th>Number</th>
        <th>Title</th>
        <th>Price</th>
        <th>Image</th>
        <th>Featured</th>
        <th>Active</th>
        <th>Action</th>
    </tr>

    <?php
        //create sql query to get all the food
        $sql = "SELECT * FROM tbl_food";

        $res = mysqli_query($conn, $sql);

        $count = mysqli_num_rows($res);

        $sn = 1;

        if($count>0)
        {
            while($row=mysqli_fetch_assoc($res))
            {
                //get the value from individual colums
                $id = $row['id'];
                $title = $row['title'];
                $price = $row['price'];
                $image_name = $row['image_name'];
                $featured = $row['featured'];
                $active = $row['active'];
                ?>

                <tr>
                        <td><?php echo $sn++; ?></td>
                        <td><?php echo $title; ?></td>
                        <td><?php echo $price; ?></td>
                        <td>
                            <?php  
                                //check if image is available
                                if($image_name!=="")
                                {
                                    //display the image
                                    ?>

                                    <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name; ?> " width="100px" height="100px">

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
                            <a href="<?php echo SITEURL;?>admin/update-food.php?id=<?php echo $id; ?>" class="btn-secondary">Update Food</a>
                            <a href="<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>" class="btn-danger">Delete Food</a>
                        </td>




                <?php
            }
        }
        else
        {
            echo "<tr> <td colspan='7' class='error'> Food not Added yet. </td> </tr>";
        }
    
    
    ?>




        
</table>
<!-- Table End -->
    
        
        </div>
    </div>
    <!-- main content sections end -->


<?php include('includes/footer.php');?>