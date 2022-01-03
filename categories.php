<?php include('partials-front/menu.php');
 

include "./config/constants.php";


if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {  ?>


        <!-- CAtegories Section Starts Here -->
        <section class="categories">
            <div class="container">
                <h2 class="text-center">Explore Services</h2>

                <?php 
                    //create php code to display category from database
                    //1. create sql to get all active categories from database
                    $sql = "SELECT * FROM tbl_category WHERE active='Yes'";

                    // execute query
                    $res = mysqli_query($conn, $sql);

                    //count rows to check whether we have categories or not
                    $count = mysqli_num_rows($res);

                    //if count greater than 0 we have categories else we do not have 
                    if($count>0)
                    {
                        //we have categories
                        while($row=mysqli_fetch_assoc($res))
                        {
                            //get the details of categories
                            $id = $row['id'];
                            $title = $row['title'];
                            $image_name = $row['image_name'];

                            ?> 
                            <a href="<?php echo SITEURL; ?>category-service.php?category_id=<?php echo $id; ?>">
                                <div class="box-3 float-container">
                                    <?php
                                        if($image_name=="")
                                        {
                                            //image not available
                                            echo "<div class='error'>Image not found.</div>";
                                        }
                                        else
                                        {
                                            //image available
                                            ?>
                                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" alt="Pizza" class="img-responsive img-curve">
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
                        //we do not have categories
                        echo "<div class='error'>Category not found</div>";

                    }
                    //2. display on dropdown

                ?>

                

                <div class="clearfix"></div>
            </div>
        </section>
        <!-- Categories Section Ends Here -->

        
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