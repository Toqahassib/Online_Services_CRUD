 <?php 

include "./config/constants.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {  

    include('partials-front/menu.php'); 


    ?>
        <!-- service sEARCH Section Starts Here -->
            <section id="home" class="home">
                
            <h1 class="banner">Rapid Repair - Home Services</h1>
            <div class="cookie">
            <?php
                echo "RECENT COOKIE : " . $_COOKIE['search_val'] ; 
        
            ?>

            </div>
            <form action="<?php echo SITEURL; ?>service-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for service.." required>
                
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>
            <div class="wave wave1"></div>
            <div class="wave wave2"></div>
            <div class="wave wave3"></div>

            <div class="fas fa-cog nut1"></div>
            <div class="fas fa-cog nut2"></div>
            </section>

        <?php
            if(isset($_SESSION['order']))
            {
                echo $_SESSION['order'];
                unset ($_SESSION['order']);
            }
        ?>

        <!-- service sEARCH Section Ends Here -->

        <!-- CAtegories Section Starts Here -->
        <section class="categories">
            <div class="container">
                <h2 class="text-center">Explore Services</h2>

                <?php 
                    //create sql query to display category from database 
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes' AND featured='Yes' LIMIT 3";

                    //execute the query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether the category is available or not
                    $count = mysqli_num_rows($res);

                    if($count>0)
                    {
                        //categories available
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //fet the values like id, title, image_name
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];
                            ?>
                            <a href="<?php echo SITEURL; ?>category-service.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
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
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
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
                        //categories not available
                        echo "<div class='error'>Category not added</div>";
                    }
                ?> 


                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Categories Section Ends Here -->

        <!-- service MEnu Section Starts Here -->
        <section class="service-menu">
            <div class="container">
                <h2 class="text-center">Service Menu</h2>

                <?php 
                    //display service that are active
                    $sql2 = "SELECT * FROM tbl_services WHERE active='Yes' AND featured='Yes' LIMIT 6";

                    //execute the query
                    $res2 = mysqli_query($conn, $sql2);

                    //count rows to check whether the service is available or not
                    $count2 = mysqli_num_rows($res2);

                    //check whether the service is acailabe or not
                    if($count>0)
                    {
                        //service available
                        while($row=mysqli_fetch_assoc($res2))
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
                                            <img src="<?php echo SITEURL; ?>images/service/<?php echo $image_name; ?>" alt="" class="img-responsive img-curve">
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