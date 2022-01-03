<?php include('partials-front/menu.php'); ?>

<?php
    //check whether id is passed or not
    if(isset($_GET['category_id']))
    {
        //category id is set and get the id
        $category_id = $_GET['category_id'];

        //get category title based on catgeory -d
        $sql = "SELECT title FROM tbl_category WHERE id=$category_id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //get value from datavase
        $row = mysqli_fetch_assoc($res);

        //get the title
        $category_title = $row['title'];
    }
    else
    {
        //vatgeory not passed and redirect to home pg
        header('location:'.SITEURL.'home.php');
    }
?>

    <!-- service sEARCH Section Starts Here -->
    <section class="service-search text-center">
        <div class="container">
            
            <h2>Services on <a href="#" class="text-white"><?php echo $category_title; ?></a></h2>

        </div>
    </section>
    <!-- service sEARCH Section Ends Here -->



    <!-- service MEnu Section Starts Here -->
    <section class="service-menu">
        <div class="container">
            <h2 class="text-center">Service Menu</h2>

            <?php 
                //create sql query to get service based on selected catgepry
                $sql2 = "SELECT * FROM tbl_services WHERE category_id=$category_id";

                //execture the query
                $res2 = mysqli_query($conn, $sql2);

                //count the rows
                $count2 = mysqli_num_rows($res2);

                //check whether service is available or not
                if($count2>0)
                {
                    //service is available
                    while($row2=mysqli_fetch_assoc($res2))
                    {
                        $id = $row2['id'];
                        $title = $row2['title'];
                        $price = $row2['price'];
                        $description = $row2['description'];
                        $image_name = $row2['image_name'];

                        ?>
                        <div class="service-menu-box">
                            <div class="service-menu-img">

                            <?php  
                                //check whether img is available or not
                                if($image_name=="")
                                {
                                    //display msg 
                                    echo "<div class='error'>image not available</div>";
                                }
                                else
                                {
                                    //image available
                                    ?>
                                    <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                    <?php
                                }
                            ?>
                            </div>

                            <div class="service-menu-desc">
                                <h4><?php echo $title ?></h4>
                                <p class="service-price">$<?php echo $price ?></p>
                                <p class="service-detail"><?php echo $description ?></p>
                                <br>

                                <a href="<?php echo SITEURL ?>order.php?service_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>
                        <?php

                    }
                }
                else
                {
                    //service not availavle
                    echo "<div class='error'>service is not available</div>";
                }
            ?>


            <div class="clearfix"></div>

            

        </div>

    </section>
    <!-- service Menu Section Ends Here -->

    <?php include('partials-front/footer.php'); ?>



</body>
</html>