<?php
    include '../config/constant.php';

    // 1. destroy the session

    session_destroy(); // unset session and user


    // 2. redirect to login page

        header('Location:' . SITEURL. 'admin/login.php');

?>