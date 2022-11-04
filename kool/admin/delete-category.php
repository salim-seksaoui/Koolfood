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
            $path = "../images/category/".$image_name;
            //remove the image 
            $remove = unlink($path);

            //if failed to remove add message and stop process
            if($remove==false)
            {
                //set the session message
                $_SESSION['remove'] = "<div class='error'>Failled to remove category image.</div>";
                //redirect to manage category
                header('Location:'.SITEURL."admin/manage-category.php");
                //stop the process
                die();
            }
        }

        //delete data from database
        //sql query to delete from db
        $sql = "DELETE FROM tbl_category WHERE id='$id'";

        //exe the query
        $res = mysqli_query($conn, $sql);

        //check if the data is deleted from database
        if($res==true)
        {

        //set success message and redirect
        $_SESSION['delete'] = "<div class='success'>Category deleted successfully</div>";
        //redirect
        header('Location:'.SITEURL.'admin/manage-category.php');
        }
        else
        {
            // set fail message and redirect
            $_SESSION['delete'] = "<div class='error'>Failed to delete category</div>";
            //redirect
            header('Location:'.SITEURL.'admin/manage-category.php');
        }
    }
    else
    {
        // redirect to manage_category page
        header('Location:'.SITEURL.'admin/manage-category.php');

    }



?>