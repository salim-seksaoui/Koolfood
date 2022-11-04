<?php include('includes/menu.php'); ?>

    <!-- main content sections start -->
    <div class="main">
        
        <div class="wrapper">
        <h1>Manage Admin</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];//displays the message
                unset($_SESSION['add']);//removing session message
            }
            
            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if(isset($_SESSION['user-not-found']))
            {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if(isset($_SESSION['pwd-not-match']))
            {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if(isset($_SESSION['change-pwd']))
            {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }
        
        ?>
        <!-- buttom to Add admin -->
        <br> <br><br>
        <a class="btn-primary" href="add-admin.php">Add Admin</a>
        <br><br><br>

        <!-- Table starts -->

        <table class="tbl-full">
            <tr>
                <th>Number</th>
                <th>Full Name</th>
                <th>Username</th>
                <th>Action</th>
            </tr>

            <?php
                // Query to Get All admin

                $sql = "SELECT * FROM tbl_admin";

                // Execute the query

                $res = mysqli_query($conn ,$sql);

                // check whether the query is executed or not

                if($res==TRUE)
                {
                    // count ROws to check whether we have database or not

                    $count = mysqli_num_rows($res); //function to get all the rows in db

                    $sn=1; // variable to assign value for serial number

                    // check the num of ROws

                    if($count>0)
                    {
                        // we have data in db
                        while($rows=mysqli_fetch_assoc($res))
                        {
                            // using while loop to get data from database
                            // and while loop will run as long as we have data in database

                            // get individual data
                            $id=$rows['id'];
                            $full_name=$rows['full_name'];
                            $username=$rows['username'];

                            // display the values in our Table
                            ?>
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name;?></td>
                                    <td><?php echo $username;?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL;?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                            <?php
                        }
                    }
                    else
                    {
                        // we do not have data in db
                    }
                }

            
            ?>

        </table>
        <!-- Table End -->
        </div>
    </div>
    <!-- main content sections end -->

    <?php include('includes/footer.php') ?>

