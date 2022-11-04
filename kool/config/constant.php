<?php

// Start the session

session_start();


// Create constants to not repeat values

define('SITEURL', 'https://salimdev.alwaysdata.net/');
define('DB_HOST', 'mysql-salimdev.alwaysdata.net');
define('DB_USERNAME', 'salimdev');
define('DB_PASSWORD', 'EH!atH9ajQ8V!b8');
define('DB_NAME', 'salimdev_kool');


$conn = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error('')); //Database connection
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error('')); //Database selection