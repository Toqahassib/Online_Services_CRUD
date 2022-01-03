<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Manage Category</h1>

        <br><br><br>

        <?php
            if(isset($_SESSION['add']))
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['remove']))
            {
                echo $_SESSION['remove'];
                unset ($_SESSION['remove']);
            }

            if(isset($_SESSION['delete']))
            {
                echo $_SESSION['delete'];
                unset ($_SESSION['delete']);
            }

            if(isset($_SESSION['no-category-found']))
            {
                echo $_SESSION['no-category-found'];
                unset ($_SESSION['no-category-found']);
            }

            if(isset($_SESSION['update']))
            {
                echo $_SESSION['update'];
                unset ($_SESSION['update']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset ($_SESSION['upload']);
            }

            if(isset($_SESSION['falied-remove']))
            {
                echo $_SESSION['falied-remove'];
                unset ($_SESSION['falied-remove']);
            }
        ?>
        
        <br><br>

        <!-- button to add admin -->

        <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
        <br><br><br>

        <table class="tbl-full">
            <tr>
                <th>S.N</th>
                <th>Title</th>
                <th>Image</th>
                <th>Featured</th>
                <th>Active</th>
                <th>Actions</th>

            </tr>

            <?php
                // query to get all categories
                $sql = "SELECT * FROM tbl_category";
                //execute the query
                $res = mysqli_query($conn, $sql);

                //count rows to check whether we have data in database or not
                $count = mysqli_num_rows($res); // function to get all the rows in database

                //create num variable and set default value as 1
                $sn = 1;

                if($count>0)
                {
                    //we have data in database
                    while($rows=mysqli_fetch_assoc($res))
                    {
                        //using while loop to get all the data from database
                        //and while loop will run as long as we have data in database

                        //get individual data
                        $id=$rows['id'];
                        $title=$rows['title'];
                        $image_name=$rows['image_name'];
                        $featured=$rows['featured'];
                        $active=$rows['active'];

                        //display the values in our table
                        ?>

                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>

                        <td>
                                <?php 
                                    //check whether we have imahe or not
                                    if($image_name=="")
                                    {
                                        //we do not have image
                                        echo "<div class='error'> image not added </div>";
                                    }
                                    else
                                    {
                                        //we have image, display it
                                        ?>
                                        <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?>" width="100px">
                                        <?php
                                    }
                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>

                            <td>

                                <!-- send id to through url (GET method)-->
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id= <?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>"class="btn-danger">Delete Category</a>
                            </td>
                        </tr>

                    <?php
                }
            }
            else
            {
                //we do not have data in database
                echo "<tr> <td clospan='6' class='error'> Service Not Added Yet </td> </tr>";
            }
            
    ?>


        </table>
    </div>
</div>

<?php include('partials/footer.php'); ?>
