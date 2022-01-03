<?php include('partials-front/menu.php'); 

include "./config/constants.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) { ?>


        <!-- service sEARCH Section Starts Here -->
        <section class="service-search text-center">
            <div class="container">
                
                <form action="<?php echo SITEURL; ?>service-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search for Service.." required>
                    <input type="submit" name="submit" value="Search" class="btn btn-primary">
                </form>

            </div>
        </section>
        <!-- service sEARCH Section Ends Here -->



        <!-- service MEnu Section Starts Here -->
        <section class="service-menu">
            <div class="container">
                <h2 class="text-center">Service Menu</h2>

                <?php 
                    //display service that are active
                    $sql = "SELECT * FROM tbl_services WHERE active='Yes'";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether the service is available or not
                    $count = mysqli_num_rows($res);

                    //check whether the service is acailabe or not
                    if($count>0)
                    {
                        //services available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //fet the values like id, title, image_name
                            $id = $row['id'];
                            $title = $row['title'];
                            $description = $row['description'];
                            $price = $row['price'];
                            $image_name = $row['image_name'];
                            ?>
                            <div class="service-menu-box">
                                <div class="service-menu-img">
                                <?php  
                                        //check whether img is available or not
                                        if($image_name=="")
                                        {
                                            //display msg img not available
                                            echo "<div class='error'>image not available</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                            <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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
                        //service not available
                        echo "<div class='error'>Service not found</div>";
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