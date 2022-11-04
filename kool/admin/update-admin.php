<?php include('includes/menu.php'); ?>

<div class="main">
        
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br>

        <?php 
            // 1. get id of selected admin

            $id=$_GET['id'];


            //  2. create sql query to get the details

            $sql= "SELECT * FROM tbl_admin WHERE id = $id";

            // execute the query

            $res=mysqli_query($conn,$sql);

            //  check if the query is executed successfully
            if($res==true)
            {
                // check whether the data is available
                $count = mysqli_num_rows($res);
                // check whether we have admin data
                if($count==1)
                {
                    // get the details
                    $row=mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];

                    $username = $row['username'];
                }
                else
                {
                    // redirect to manage admin page
                    header('Location:'. SITEURL . '/admin/manage-admin.php');
                }
            }
        
        
        ?>
        <form action="" method="POST">
        <table class="tbl-form">
                <tr>
                    <td>Full Name: </td>
                    <td>
                        <input type="text" name="full_name" value="<?php echo $full_name; ?>">
                    </td>
                </tr>
                <tr>
                    <td>Username: </td>
                    <td>
                        <input type="text" name="username" value="<?php echo $username; ?>">
                    </td>
                </tr>
        
                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="Update" class="btn-secondary">
                    </td>
                
                </tr>
            </table>
        
        
        </form>

        </div>
</div>

<?php

    // Check if the submit button is clicked
    
    if(isset($_POST['submit']))
    {
        // get the value from form to update
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        // create sql query to update Admin
        $sql = "UPDATE tbl_admin SET
        full_name = '$full_name',
        username = '$username' 
        WHERE id= '$id'
        ";

        // execute the query
        $res = mysqli_query($conn, $sql);

        // check if the query is executed
        if($res==true)
        {
            // query executed and admin updated
            $_SESSION['update'] =  "<div class='success'>Admin updated Successfully.</div>";
            // Redirect to manage admin
            header("location:". SITEURL .'admin/manage-admin.php');
        }
        else
        {
            // failed to updated
            $_SESSION['update'] =  "<div class='success'>Failed to update admin please try again.</div>";
            // Redirect to manage admin
            header("location:". SITEURL .'admin/manage-admin.php');
        }
    }
    


?>









<?php include('includes/footer.php'); ?>