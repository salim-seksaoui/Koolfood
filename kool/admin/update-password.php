<?php include('./includes/menu.php'); ?>

<div class="main">
        
    <div class="wrapper">
        <h1>Change the Password</h1>
        <br><br>

        <?php
            if(isset($_GET['id']))
            {
                $id = $_GET['id'];
            }
        
        
        ?>

        <form action="" method="POST">
        
            <table class="tbl-form">
                <tr>
                    <td>Current password : </td>
                    <td>
                        <input type="password" name="current_password" value="" placeholder="Enter current password">
                    </td>
                </tr>
                <tr>
                    <td>New password : </td>
                    <td>
                        <input type="password" name="new_password" value="" placeholder="Enter new password">
                    </td>
                </tr>
                <tr>
                    <td>Confirm password : </td>
                    <td>
                        <input type="password" name="confirm_password" value="" placeholder="Confirm new password">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Change password" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
        </form>
        </div>
</div>


<?php

            // check if the submit is clicked
            if(isset($_POST['submit']))
            {
                // 1. get the data from form

                $_POST['id'];
                $current_password = password_hash($_POST['current_password']);
                $new_password = password_hash($_POST['new_password']);
                $confirm_password = password_hash($_POST['confirm_password']);

                // 2. check the user with the current id and current password exist

                $sql = "SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
                // exe the query
                $res = mysqli_query($conn, $sql);

                if($res==true)
                {
                    // check if data is available
                    $count=mysqli_num_rows($res);

                    if($count==1)
                    {
                        // user exist and password can be change
                        $_SESSION['password-updated'] = "<div class='success'>Password updated successfully</div>";
                        header('Location:' .SITEURL. 'admin/manage-admin.php' );
                    }
                    else{
                        // user does not exist set message and redirect
                        $_SESSION['user-not-found'] = "<div class='error'>User not found</div>";
                        // redirect
                        header('Location:' .SITEURL. 'admin/manage-admin.php');
                    }
                }

                // 3.check if the new password and confirm password match
                
                if($new_password==$confirm_password)
                {
                    // update password

                    $sql2 = "UPDATE tbl_admin SET
                            password='$new_password'
                            WHERE id=$id
                            ";
                    
                    // execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    // checked the exec of query
                    if($res2==true)
                    {
                        // display success message
                        $_SESSION['change-pwd'] = "<div class='success'>Password updated</div>";
                        // redirect
                        header('Location:' .SITEURL. 'admin/manage-admin.php');
                    }
                    else
                    {
                        // display err message
                        
                        $_SESSION['change-pwd'] = "<div class='success'>Password update failled</div>";
                        // redirect
                        header('Location:' .SITEURL. 'admin/manage-admin.php');

                    }
                }
                else{
                    // redirect to manage admin with err message
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password not match</div>";
                    // redirect
                    header('Location:' .SITEURL. 'admin/manage-admin.php');
                }

                // 4. change the password if all above is tru
            }



?>

<?php include('./includes/footer.php'); ?>