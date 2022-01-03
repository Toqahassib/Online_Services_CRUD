<?php include('partials/menu.php'); ?>

<div class="main">
    <div class="wrapper">
        <h1>Add Service</h1>
        <br><br>

        <?php 

            if(isset($_SESSION['add']));
            {
                echo $_SESSION['add'];
                unset ($_SESSION['add']);
            }

            if(isset($_SESSION['upload']))
            {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
        ?>

        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" placeholder="title of the service">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5" placeholder="description of the service"></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price">
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
                    </td>
                </tr>

                <tr>
                    <td>Category: </td>
                    <td>
                        <select name="category">

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
                                        ?>

                                            <option value="<?php echo $id; ?>"> <?php echo $title ?> </option>
                                        
                                        <?php
                                    }
                                    
                                }
                                else
                                {
                                    //we do not have categories
                                    ?> 
                                        <option value="0">No categories found</option>
                                    <?php

                                }
                            ?>
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input type="radio" name="featured" value="Yes"> Yes
                        <input type="radio" name="featured" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input type="radio" name="active" value="Yes"> Yes
                        <input type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Service" class="btn-secondary">
                    </td>
                </tr>
                
            </table>
        </form>

        <?php
            //check whether the button is clicked or not
            if(isset($_POST['submit']))
            {
                //add service in database

                //1. get the data from form 
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];

                // check whether radio button for featured and active are checked or not
                if(isset($_POST['featured']))
                {
                    $featured = $_POST['featured'];
                }
                else
                {
                    $featured = "No"; //setting the default value
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];
                }
                else
                {
                    $active = "No"; //setting the default value
                }

                //2. upload image if selected
                //check whether the select image is clicked or ont and upload the image if is it selected
                if(isset($_FILES['image']['name']))
                {
                    //get the details of the image
                    $image_name = $_FILES['image']['name'];

                    //check whethe rthe image is seleceted or not and upload it only if selected
                    if($image_name!="")
                    {
                        //image is selected
                        //A. rename the image
                        //get extension of the image 
                        $ext = end(explode('.', $image_name));

                        //create new name for image
                        $image_name = "Service-Name=".rand(0000,9999).".".$ext; //new image name such as "Service-Name.657.jpg"

                        //B. upload the image
                        //get the src path and destination path

                        //source path is the current location of the image
                        $src = $_FILES['image']['tmp_name'];

                        //destination path for the image to be upload
                        $dst = "../images/service/".$image_name;

                        //finally upload service image
                        $upload = move_uploaded_file($src, $dst);

                        //check whether image uploaded or not
                        if($upload==false)
                        {
                            //failed to upload the image
                            //redirect to add service page with error message
                            $_SESSION['upload'] = "<div class='error'>Failed to upload image</div>";
                            header('location:'.SITEURL.'/admin/add-service.php');

                            //stop the proccess
                            die();
                        }
                    }
                }
                else
                {
                    $image_name= ""; //setting default value as blank
                }

                //3. insert into database
                //create sql query to save or add service 
                $sql2 = "INSERT INTO tbl_services SET
                    title= '$title',
                    description= '$description',
                    price= $price,
                    image_name= '$image_name',
                    category_id= $category,
                    featured= '$featured',
                    active= '$active'
                ";                      

                //execute the query
                $res2 = mysqli_query($conn, $sql2);

                //check whethe the data is inserted or not
                //4. redirect with message to manage service page 
                if($res2 == true)
                {
                    //data inserted successfully
                    $_SESSION['add'] = "<div class='success'>Service Added successfully</div>";
                    header('location:'.SITEURL.'admin/manage-service.php');
                }
                else
                {
                    //failed to insert data
                    $_SESSION['add'] = "<div class='error'>Failed to add service</div>";
                    header('location:'.SITEURL.'admin/add-service.php');
                    // echo "ERROR: "  . mysqli_error($conn); 
                    // echo "$title, $description , $price , $image_name , $category, $featured, $active" ; 
                }

            }
        ?>

    </div>
</div>

<?php include('partials/footer.php'); ?>