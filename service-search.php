<?php include('partials-front/menu.php');

include "./config/constants.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {  ?>

        <!-- service sEARCH Section Starts Here -->
        <section class="service-search text-center">
            <div class="container">
                <?php

                    //get search keyword
                    $search = $_POST['search']; 
                    setcookie("search_val",$search,time() + 84600) ; 

                ?>
                
                <h2>Services on Your Search <a href="#" class="text-white"><?php echo $search; ?></a></h2>

            </div>
        </section>
        <!-- service sEARCH Section Ends Here -->



        <!-- service MEnu Section Starts Here -->
        <section class="service-menu">
            <div class="container">
                <h2 class="text-center">Service Menu</h2>

                <?php

                //sql query to get service based on search keyword
                $sql = "SELECT * FROM tbl_services WHERE title LIKE '%$search%' OR description LIKE '%$search%'";

                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows
                $count = mysqli_num_rows($res);

                //check whether service available or not
                if($count>0)
                {
                    //service availabw
                    while($row=mysqli_fetch_assoc($res))
                    {
                        //get the details
                        $id = $row['id'];
                        $title = $row['title'];
                        $price = $row['price'];
                        $description = $row['description'];
                        $image_name = $row['image_name'];
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
                                            <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
                                            <?php
                                        }
                                    ?>
                            </div>

                            <div class="service-menu-desc">
                                <h4><?php echo $title; ?></h4>
                                <p class="service-price"><?php echo $price; ?></p>
                                <p class="service-detail"><?php echo $description; ?></p>
                                <br>

                                <a href="<?php echo SITEURL ?>order.php?service_id=<?php echo $id; ?>" class="btn btn-primary">Order Now</a>
                            </div>
                        </div>

                        <?php

                    }
                }
                else
                {
                    //service not available
                    echo "<div class='error'>Service not found.</div>";
                }

                ?>

                <div class="clearfix"></div>

                

            </div>

        </section>
        <!-- service Menu Section Ends Here -->

        <?php include('partials-front/footer.php'); ?>


    </body>
    </html>
<?php
}else
{
    header("location: login2.php");
    exit();
}
?>