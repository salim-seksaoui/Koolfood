<?php include('./includes_front/menu.php'); ?>


    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Recherche" required>
                <input type="submit" name="submit" value="Recherche" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

            <?php
                // display food that are active
                $sql = "SELECT * FROM tbl_food WHERE active='Yes'";
                //exec the query 
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check if food available
                if ($count>0)
                {
                    //food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //got the value
                        $id = $row['id'];
                        $title = $row['title'];
                        $description = $row['description'];
                        $price = $row['price'];
                        $image_name = $row['image_name'];

                        ?>
                        
                        <div class="food-menu-box">
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
                                <h4><?php echo $title; ?></h4>
                                <p class="food-price"><?php echo $price; ?>€</p>
                                <p class="food-detail">
                                    <?php echo $description; ?>
                                </p>
                                <br>

                                <a href="<?php echo SITEURL; ?>order.php?food_id=<?php echo $id; ?>" class="btn btn-primary">Commander</a>
                            </div>
                        </div>

                        <?php    
                    }
                }
                else
                {
                    //food not available

                    echo "<div class='error'>Rien à manger ici :( </div>";
                }    
                ?>
            
            
            



            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('./includes_front/footer.php'); ?>