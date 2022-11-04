<?php include('./includes_front/menu.php'); ?>

<?php
    // check whether food ID is set or not
    if(isset($_GET['food_id']))
    {
        // get the food ID and details of the selected food
        $food_id = $_GET['food_id'];

        // get the details of the selected food
        $sql = "SELECT * FROM tbl_food WHERE id=$food_id";
        //exec the query
        $res = mysqli_query($conn, $sql);
        //count the rows
        $count = mysqli_num_rows($res);
        //check if the data is available
        if($count==1)
        {
            // we have data available
            // get the data from the database
            $row = mysqli_fetch_assoc($res);

            $title = $row['title'];
            $price = $row['price'];
            $image_name = $row['image_name'];

        }
        else
        {
            // food not available so redirect 
            header('location:'.SITEURL);
            
        }

    }
    else
    {
        // redirect to home page
        header('location:'.SITEURL);
        
    }


?>

    <!-- Order Section Starts Here -->
    <section class="food-search">
        <div class="container">
            
            <h2 class="text-center text-white">Formulaire de commande</h2>
            
            <!-- Order form -->
            
            <form method="POST" action="" class="order">
                <fieldset>
                    <legend>Votre selection</legend>

                    <div class="food-menu-img">
                    <?php
                        if($image_name=="")
                        {
                            echo "<div class='error'>Pas de photo alléchante :( </div>";
                        }
                        else
                        {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve" max-height="335px">
                            <?php
                        }
                    
                    ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title; ?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">

                        <p class="food-price"><?php echo $price; ?>€</p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantités</div>
                        
                        <input type="number" name="qty" class="input-responsive" value="1" required>
                        
                    </div>

                </fieldset>
                
                <fieldset>
                    <legend>Information de livraison</legend>
                    <div class="order-label">Nom complet</div>
                    <input type="text" name="customer_name" placeholder="" class="input-responsive" required>

                    <div class="order-label">Numero de téléphone</div>
                    <input type="tel" name="customer_contact" placeholder="" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="customer_email" placeholder="" class="input-responsive" required>

                    <div class="order-label">Addresse</div>
                    <textarea name="customer_address" rows="10" placeholder="" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Je Commande !" class="btn btn-primary">
                </fieldset>

            </form>

            <!-- order form ends here-->

            <?php

                // check if submit button is clicked
                if(isset($_POST['submit']))
                {
                    //get the details from the form
                    $food = htmlspecialchars($_POST['food']);
                    $price = htmlspecialchars($_POST['price']);
                    $qty = htmlspecialchars($_POST['qty']);
                    $total = $price * $qty;
                    $status = "Ordered"; // ordered, on delevery, delivered, cancelled
                    $customer_name = htmlspecialchars($_POST['customer_name']);
                    $customer_contact = htmlspecialchars($_POST['customer_contact']);
                    $customer_email = htmlspecialchars($_POST['customer_email']);
                    $customer_address = htmlspecialchars($_POST['customer_address']);

                    

                    // save the data in database
                    // create sql to save the data 

                    $sql2 = "INSERT INTO tbl_order SET
                        food = '$food',
                        price = '$price',
                        qty = '$qty',
                        total = '$total',
                        order_date = NOW(),
                        status = '$status',
                        customer_name = '$customer_name',
                        customer_contact = '$customer_contact',
                        customer_email = '$customer_email',
                        customer_address = '$customer_address'
                    ";

                    // var_dump($sql2);
                    // echo $sql2; die();

                    // $sql2 = "INSERT INTO tbl_order (food, price, qty, total, order_date, status, customer_name, customer_contact, customer_email, customer_address)
                    //                     VALUES 
                    //                     ($food, $price, $qty, $total, $order_date, $status, $customer_name, $customer_contact, $customer_email, $customer_address)";
                       
                    // execute the query

                    $res2 = mysqli_query($conn, $sql2);
                    // var_dump($res2);
                
    
                    // check if the query executed successfully
                    if($res2==true)
                    {
                        //order saved
                        $_SESSION['order'] = "<div class'success'>Votre commande est dans les tuyaux 👍 </div>";
                        header('location:'.SITEURL);
                    }
                    else
                    {
                        //failled to save order
                        $_SESSION['order'] = "<div class'error'>La commande n'a pas abouti 😣 </div>";
                        header('location:'.SITEURL);
                    }
                    
                }
            
            
            ?>

        </div>
    </section>
    <!-- Order Section Ends Here -->

    <?php include('./includes_front/footer.php'); ?>