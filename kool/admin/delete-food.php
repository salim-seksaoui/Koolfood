<?php
    include('../config/constant.php');

    // check if id and image_name is set
    if(isset($_GET['id']) AND isset($_GET['image_name']))
    {
        // Get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the physical image file
        if($image_name != "")
        {
            //image is available so remove it
            $path = "../images/food/".$image_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove add message and stop process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failled to remove food image.</div>";
                //redirect to manage category
                header('Location:'.SITEURL."admin/manage-food.php");
                //stop the process
                die();
            }
        }

        //delete data from database
        //sql query to delete from db
        $sql = "DELETE FROM tbl_food WHERE id='$id'";

        //exe the query
        $res = mysqli_query($conn, $sql);

        //check if the data is deleted from database
        if($res==true)
        {

        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Food deleted successfully</div>";
        //redirect
        header('Location:'.SITEURL.'admin/manage-food.php');
        }
        else
        {
            // set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete food</div>";
            //redirect
            header('Location:'.SITEURL.'admin/manage-food.php');
        }
    }
    else
    {
        // redirect to manage_food page
        header('Location:'.SITEURL.'admin/manage-food.php');

    }



?>