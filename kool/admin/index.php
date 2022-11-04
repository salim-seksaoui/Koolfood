<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>KOOL | Dashboard</title>
</head>
<body>
    <!-- menu sections start -->
    <?php 
        include('includes/menu.php');
    ?>

    <!-- menu sections end -->

    <!-- main content sections start -->
    <div class="main">
        <h1 class="title">Dashboard</h1>

        <?php
            if(isset($_SESSION['login']))
            {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
        ?>
        <br><br>
        
        
        <div class="wrapper card-flex">
        
            <div class="col-4 text-center">

                <?php
                    // sql query
                    $sql = "SELECT * FROM tbl_category";
                    // execute query
                    $res = mysqli_query($conn, $sql);
                    // count rows
                    $count = mysqli_num_rows($res);
                ?>
                <h1><?php echo $count; ?></h1>
                <br/>
                Categories
            </div>
            <div class="col-4 text-center">

                <?php
                    // sql query
                    $sql2 = "SELECT * FROM tbl_food";
                    // execute query
                    $res2 = mysqli_query($conn, $sql2);
                    // count rows
                    $count2 = mysqli_num_rows($res2);
                ?>

                <h1><?php echo $count2; ?></h1>
                <br/>
                Foods
            </div>
            <div class="col-4 text-center">
                <?php
                    // sql query
                    $sql3 = "SELECT * FROM tbl_order";
                    // execute query
                    $res3 = mysqli_query($conn, $sql3);
                    // count rows
                    $count3 = mysqli_num_rows($res3);
                ?>
                <h1><?php echo $count3; ?></h1>
                <br/>
                Total Orders
            </div>
            <div class="col-4 text-center">
                <?php
                    // sql query to get total Revenue
                    // aggregate fonction in sql
                    $sql4 = "SELECT SUM(total) AS Total FROM tbl_order WHERE status='Delivered'";
                    // execute query
                    $res4 = mysqli_query($conn, $sql4);
                    
                    // get the value

                    $row4 = mysqli_fetch_assoc($res4);

                    // get the total Revenue
                    $total_revenue  = $row4['Total'];

                    

                ?>
                <h1><?php echo $total_revenue; ?>€</h1>
                <br/>
                Revenue Generated
            </div>
        
        </div>

        
    </div>
    <!-- main content sections end -->

    <!-- footer sections Start -->
    <?php include('includes/footer.php') ?>
    <!-- footer sections End -->
</body>
</html>