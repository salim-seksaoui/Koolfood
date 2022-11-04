<?php 

    // authorization - access control
    
    // check if the user is logged

    if (!isset($_SESSION['user'])) //if user session is not set
    {
        // user is not logged in
        //redirect to login page
        $_SESSION['no-login-message'] ="<div class='error text-center'>Please login to acces Admin Panel";
        //redirect to login page
        header('Location:' .SITEURL. 'admin/login.php');
    }

?>