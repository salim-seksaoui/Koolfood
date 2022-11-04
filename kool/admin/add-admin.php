<?php include('includes/menu.php'); ?>

<!-- main content sections start -->
<div class="main">
        
        <div class="wrapper">
        <h1>Add Admin</h1>

        <!-- Add admin Form -->

        <?php
            if(isset($_SESSION['add'])) //check if the session is set or not
            {
                echo $_SESSION['add']; //display session message if set
                unset($_SESSION['add']); //remove session message
            }
        
        ?>

        <form action="" method="POST">
            <table class="tbl-form">
                <tr>
                    <td>Full Name:</td>
                    <td>
                        <input type="text" name="full_name" placeholder="Enter your name">
                    </td>
                </tr>
                <tr>
                    <td>Username:</td>
                    <td>
                        <input type="text" name="username" placeholder="Enter your username">
                    </td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td>
                        <input type="password" name="password" placeholder="Enter a password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
        </form>
        </div>
</div>
<?php
    // Process the value from Form and save it in Database

    // Check if the submit buttom is clicked or not

    if(isset($_POST['submit']))
    {
        // buttom clicked
    
    //1. Get the data from form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = password_hash($_POST['password']); // Password encrypted  hashed 

    // 2. SQL Query to save the data into DB

    $sql = "INSERT INTO tbl_admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
            ";
    
    // 3.execute query and save data in DB

    $res = mysqli_query($conn, $sql) or die(mysqli_error(''));

    // 4. Check whether the (Query is executed) data is insered or not and diqplay appropriate message
    if($res==true)
    {
        // creating session variable to display message
        $_SESSION['add'] = "<div class='success'>Admin Added Successfully !</div>";
        // Redirect to manage admin
        header("location:". SITEURL .'admin/manage-admin.php');
    }
    else{
        // creating session variable to display message
        $_SESSION['add'] = "Failed to add admin please try again !";
        // Redirect to add admin
        header("location:". SITEURL .'admin/add-admin.php');
    }


    }

?>

<?php include('includes/footer.php'); ?>

