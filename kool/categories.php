<?php include('./includes_front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>

        <?php
            //displays all active categories
            $sql = "SELECT * FROM tbl_category WHERE active ='Yes'";

            //exec the query 
            $res = mysqli_query($conn, $sql);

            //count rows
            $count = mysqli_num_rows($res);

            //check if category available
            if ($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    //got the value
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];
                    ?>
                    <a href="<?php echo SITEURL;?>category-foods.php?category_id=<?php echo $id; ?>">
                        <div class="box-3 float-container">
                            <?php
                                if($image_name=="")
                                {
                                    echo "<div class='error'>Pas d'image ici ?</div>";
                                }
                                else
                                {
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="<?php echo $title;?>" class="img-responsive img-curve" max-height="335px">
                                    <?php
                                }
                            ?>
                            

                            <h3 class="float-text text-white"><?php echo $title;?></h3>
                        </div>
                    </a>
                    <?php
                }
            }
            else
            {
                echo "<div class='error'>Section vide :(</div>";
            }

        
        ?>
            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('./includes_front/footer.php'); ?>