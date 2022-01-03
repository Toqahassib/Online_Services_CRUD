<?php include('partials/menu.php') ?>

<?php

//check whether the id is set or not 
if(isset($_GET['id']))
    {
        // 1. get id of selected admin
        $id=$_GET['id'];

        // 2. create sql query to get the details
        $sql2 ="SELECT * FROM tbl_services WHERE id=$id";

        // 3. execute the query
        $res2=mysqli_query($conn, $sql2);

        // get the value based on the query executed
        //get the details
        $row2=mysqli_fetch_assoc($res2);

        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['current_category'];
        $featured = $row2['featured'];
        $active = $row2['active'];
    }
    else
    {
        //redirect to manage category with session msg
        header('location:'.SITEURL.'admin/manage-category.php');
    }

?>

<div class="main">

    <div class="wrapper">
        <h1>Update Service</h1>

        <br><br>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Description: </td>
                    <td>
                        <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                    </td>
                </tr>

                <tr>
                    <td>Price: </td>
                    <td>
                        <input type="number" name="price" value="<?php echo $price; ?>">
                    </td>
                </tr>

                <tr>
                    <td>Current Image: </td>
                    <td>
                        <?php 
                            if($current_image != "")
                            {
                                //display th img
                                ?>
                                <img src="<?php echo SITEURL; ?>images/service/<?php echo $current_image; ?>width=150px;">
                                <?php

                            }
                            else
                            {
                                //display msg
                                echo "<div class='error'>Image not added</div>";
                            }
                        ?>
                    </td>
                </tr>

                <tr>
                    <td>New Image: </td>
                    <td>
                        <input type="file" name="image" >
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
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                        // echo "<option value='$category_id'>$category_title </option>";
                                        ?>
                                            <option <?php if($current_category==$category_id){echo "Selected";} ?> value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                        <?php
                                        
                                        
                                    }
                                    
                                }
                                else
                                {
                                    //we do not have categories
                                    echo "<option value='0'>Category not available </option>";


                                }
                                //2. display on dropdown

                            ?> 
                            
                        </select>
                    </td>
                </tr>

                <tr>
                    <td>Featured: </td>
                    <td>
                        <input <?php if($featured=="Yes"){echo "checked";} ?> type="radio" name="featured" value="Yes"> Yes

                        <input <?php if($featured=="No"){echo "checked";} ?> type="radio" name="featured" value="No"> No

                    </td>
                </tr>

                <tr>
                    <td>Active: </td>
                    <td>
                        <input <?php if($active=="Yes"){echo "checked";} ?> type="radio" name="active" value="Yes"> Yes
                        
                        <input <?php if($active=="No"){echo "checked";} ?> type="radio" name="active" value="No"> No
                    </td>
                </tr>

                <tr>
                    <td>
                        <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                        <input type="submit" name="submit" value="update category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>

    <?php 
        // check whether the submit button clicked or not
        if(isset($_POST['submit']))
        {
            //1 get all the values from form to update
            $id = $_POST['id'];
            $title = $_POST['title'];
            $description = $_POST['description'];
            $price = $_POST['price'];
            $current_image = $_POST['current_image'];
            $category = $_POST['category'];

            $featured = $_POST['featured'];
            $active = $_POST['active'];

            //2 updating new image if selected
            //check whether img is selected or not
            if(isset($_FILES['image']['name']))
            {
                //get the img details
                $image_name = $_FILES['image']['name'];

                //check whether the image is available or not
                if($image_name!="")
                {
                    //image available
                    //A. upload new img

                    //auto rename our image
                    //get the extension of our image
                    $ext = end(explode('.',$image_name));

                    //rename the image
                    $image_name = "Service-Category=".rand(0000,9999).".".$ext; //new image name such as "service-Name.657.jpg"



                    $src_path = $_FILES['image']['tmp_name'];
                    $dest_path = "../images/service".$image_name;

                    //finally upload image
                    $upload = move_uploaded_file($src_path, $dest_path);

                    //check whether the image is uploaded or not
                    //if the image is not uploaded then stop the process and redirect with errpr msg
                    if($upload==false)
                    {
                        //set message
                        $_SESSION['upload']= "<div class='error'> Failed to Upload image</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/manage-service.php');
                        //stop the proccess
                        die();
                    }
                    //B. remove current img if available
                    if($current_image!="")
                    {

                        $remove_path = "../images/service/".$current_image;

                        $remove = unlink($remove_path);

                        //check whether img is removed or not
                        //if failed to remove display msg and stop the process
                        if($remove==false)
                        {
                            //failed to remove img
                            $_SESSION['falied-remove'] = "<div class='error'> Failed to remove image</div>";
                            header('location:'.SITEURL.'admin/manage-service.php');
                            die();

                        }

                    }

                }
                else
                {
                    $image_name = $current_image; //default img when img is not selected
                }
            }
            else
            {
                $image_name = $current_image; //default img when button is not clicked
            }

            //3. update the database
            $sql3 = "UPDATE tbl_services SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            featured = '$featured',
            active = '$active'
            WHERE id= $id
            ";


            // execute the query 
            $res3 = mysqli_query($conn, $sql3);

            // check whether the queary is executed successfully or not
            if($res3==TRUE)
            {
                // query executed and admin is updated
                $_SESSION['update'] = "<div class='success'> Category updated successfully </div>";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-service.php');
            }
            else
            {
                // failed to update admin
                $_SESSION['update'] = "<div class='error'> Failed to update Category</div>";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-service.php');
            }
        }
    ?>
</div>
</div>

<?php include('partials/footer.php') ?>
