<?php

    //  include constants file for db conn

    include('../config/constant.php');

    // 1. get ID of admin to be deleted

    $id = $_GET['id'];

    // 2. create sql query to delete admin 

    $sql = "DELETE FROM tbl_admin WHERE id =  $id";
    
    // execute the query
    $res = mysqli_query($conn, $sql);

    // check if the query executed successfully

    if ($res==true)
    {
         // creating session variable to display message
        $_SESSION['delete'] = "<div class='success'>Admin deleted Successfully.</div>";
         // Redirect to manage admin
        header("location:". SITEURL .'admin/manage-admin.php');
    }
    else
    {
        // creating session variable to display message
        $_SESSION['delete'] = " <div class='error'>Failed to delete admin please try again.</div>";
        // Redirect to add admin
        header("location:". SITEURL .'admin/manage-admin.php');
    }

    // 3. redirect to manage admin page with message (success or error)

    







?>