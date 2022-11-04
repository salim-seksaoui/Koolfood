<?php include('./includes_front/menu.php'); ?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
        <?php
            // get the search keyword
            $search = $_POST['search'];
        ?>
            
            <h2>Résultat pour: <a href="#" class="text-white">"<?php echo $search; ?>"</a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>

            <?php

                // sql query to get foods based on search keybord
                $sql = "SELECT * FROM tbl_food WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                // execute the query
                $res = mysqli_query($conn, $sql);

                // count rows
                $count = mysqli_num_rows($res);

                // check whether food available or not
                if($count>0)
                {
                    // food available
                    while($row=mysqli_fetch_assoc($res))
                    {
                        // get the value
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
                                <h4><?php echo $title;?></h4>
                                <p class="food-price"><?php echo $price;?>€</p>
                                <p class="food-detail">
                                    <?php echo $description ?>
                                </p>
                                <br>

                                <a href="#" class="btn btn-primary">Commander</a>
                            </div>
                        </div>

                        <?php
                    }

                }
                else
                {
                    // food not available
                    echo "<div class='error'>Aucun resultat sorry...</div>";
                }
            
            ?>

            


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- fOOD Menu Section Ends Here -->

    <?php include('./includes_front/footer.php'); ?>