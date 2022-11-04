<?php include('includes/menu.php'); ?>

<div class="main-content">
    <div class="wrapper">
    
        <h1>Update Order</h1>
        <br><br>

        <?php
        
            //check if id is set or not
            if(isset($_GET['id']))
            {
                //get the order by id
                $id = $_GET['id'];

                // query to get all the details
                $sql = "SELECT * FROM tbl_order WHERE id=$id";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // count rows 
                $count = mysqli_num_rows($res);

                if($count==1)
                {
                    //details available
                    $row = mysqli_fetch_assoc($res);

                    $id = $row['id'];
                    $food = $row['food'];
                    $price = $row['price'];
                    $total = $row['total'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                }
                else
                {
                    // details not available so redirect to
                    // header('location:'.SITEURL.'admin/manage-order.php');
                }

            }
            else
            {
                header('location:'.SITEURL.'admin/manage-order.php');
            }
        
        ?>

        <form action="" method="POST">

            <table class="tbl-30">
                <tr>
                    <td>Food Name :</td>
                    <td><?php echo $food; ?></td>  
                </tr>

                <tr>
                    <td>Price :</td>
                    <td><?php echo $price; ?>€</td>
                </tr>

                <tr>
                    <td>Qty :</td>
                    <td>
                        <input type="number" name="qty" value="<?php echo $qty; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Status</td>
                    <td>
                        <select name="status" id="">
                            <option <?php if($status=="Ordered"){echo "selected";}?>value="Ordered">Ordered</option>
                            <option <?php if($status=="On Delivery"){echo "selected";}?> value="On Delivery">On Delivery</option>
                            <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                            <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <input type="submit" name="submit" value="Update" class="btn btn-secondary">
                    </td>
                </tr>
            
            </table>
        
        </form>

        <?php 
            // check if the update button is clicked

            if(isset($_POST['submit']))
            {
                // echo "clicked";
                // get all the value from from

                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];

                // update the values

                $sql2 = "UPDATE tbl_order SET
                    qty = $qty,
                    total = $total,
                    status = '$status'
                    WHERE id=$id
                ";

                // exec the query

                $res2 = mysqli_query($conn, $sql2);

                // check if updated or not

                if($res2==true)
                {
                    // updated
                    $_SESSION['update'] = "<div class='success'>Order updated Successfully.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
                else
                {
                
                    $_SESSION['update'] = "<div class='error'>Order failled to update.</div>";
                    header('location:'.SITEURL.'admin/manage-order.php');
                }
            }
            
        
        
        
        ?>
    
    
    </div>




</div>









<?php include('includes/footer.php'); ?>