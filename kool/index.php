    <?php include('./includes_front/menu.php'); ?>

    <!-- food searh Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="<?php echo SITEURL; ?>food-search.php" method="POST">
                <input type="search" name="search" placeholder="Recherche" required>
                <input type="submit" name="submit" value="Recherche" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- food search Section Ends Here -->

    <?php
        if(isset($_SESSION['order']))
        {
            echo $_SESSION['order'];
            unset($_SESSION['order']);
        }
        
    
    ?>

    <!-- Categories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">🤤 Decouvrir nos Plats 🤤</h2>

            <?php
                //sql to display categoeies from database
                $sql = "SELECT * FROM tbl_category where active='Yes' AND featured='Yes' LIMIT 3";
                //exe th equery
                $res = mysqli_query($conn, $sql);
                //count rows to check whether the category is available or not
                $count = mysqli_num_rows($res);

                if($count>0)
                {
                    //categoeies available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //got the value like id title
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        ?>
                        <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                            <div class="box-3 float-container">
                                <?php
                                //check if the image is available
                                    if($image_name=="")
                                    {
                                        //display message
                                        echo "<div class='erroe'>Oups image introuvable</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>

                                <h3 class="float-text text-white"><?php echo $title; ?></h3>
                            </div>
                        </a>
                        <?php
                    }
                }
                else
                {
                    //not available
                    echo "<div class='error'>Oh non ! aucune categories n'a étais créer.</div>";
                }
            
            ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->

    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Menu</h2>

                <?php

                //getting food from db that active and featured
                //sql query
                $sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";

                //executing query
                $res2 = mysqli_query($conn, $sql2);

                //count rows
                $count2 = mysqli_num_rows($res2);

                //check if the food available
                if($count2>0)
                {
                    while($row=mysqli_fetch_assoc($res2))
                    {
                        //get all value
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
                        ?>
                        <div class="food-menu-box">
                            <div class="food-menu-img">
                            <?php
                                //check if the image is available
                                    if($image_name=="")
                                    {
                                        //display message
                                        echo "<div class='erroe'>Oups image introuvable</div>";
                                    }
                                    else
                                    {
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/food/<?php echo $image_name; ?>" alt="<?php echo $title; ?>" class="img-responsive img-curve">
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
                    echo "<div class='error'>Ohh non section vide :/</div>";
                }

                ?>
            

            
            <div class="clearfix"></div>

            

        </div>

        <p class="text-center">
            <a href="#">🤤 Voir tout nos Plats 🤤</a>
        </p>
    </section>
    <!-- fOOD Menu Section Ends Here -->

<?php include('./includes_front/footer.php'); ?>