<?php

        include('../config/constant.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Kool's food delevery</title>
</head>
<body>

    <div class="login">
        <h1 class="title">Login</h1>

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }

            if(isset($_SESSION['no-login-message']))
            {
                echo $_SESSION['no-login-message'];
                unset($_SESSION['no-login-message']);
            }
        ?>
        

        <!-- Login form starts -->

        <form class="login_form" action="" method="POST">
            <input type="text" name="username" placeholder="Username">
            <input type="password" name="password" placeholder="Password">
            <input class="btn btn-primary" type="submit" name="submit" value="Login">
        </form>

        <!-- Login form ends -->

        <p></p>
    </div>

</body>
</html>

<?php
    // check if the submit button is clicked

    if(isset($_POST['submit']))
    {
        // process for login
        // 1. get the data from login form

        $username = $_POST['username'];
        $password = password_hash($_POST['password']);

        // 2.sql query to check username and pssword exist

        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. execute the query from

        $res = mysqli_query($conn, $sql);

        // 4. count rows to check if user Exist

        $count = mysqli_num_rows($res);
        
        if($count==1)
        
        {
            // user available and login success
            $_SESSION['login'] = "<div class='success'>Login successfull.</div>";
            $_SESSION['user'] = $username; // verify the statut of the user login or logout

            // redirect
            header('location:' .SITEURL. 'admin/');
        }
        else
        {
            // user not available anf login fail
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            // redirect
            header('location:' .SITEURL. 'admin/login.php');

        }

    }

    


?>