<?php include('partials/menu.php') ?>

<div class="main">

    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>

        <?php

            //check whether the id is set or not 
            if(isset($_GET['id']))
            {
                // 1. get id of selected admin
                $id=$_GET['id'];

                // 2. create sql query to get the details
                $sql="SELECT * FROM tbl_category WHERE id=$id";

                // 3. execute the query
                $res=mysqli_query($conn, $sql);

                // check whether the data is available or not
                $count = mysqli_num_rows($res);

                // check whether we have admin data or not
                // ==1 because we are getting the value of 1 single id
                if($count==1)
                {
                    //get the details
                    $row=mysqli_fetch_assoc($res);

                    $title = $row['title'];
                    $current_image = $row['image_name'];
                    $featured = $row['featured'];
                    $active = $row['active'];

                }
            }
                else
                {
                    //redirect to manage category with session msg
                    $_SESSION['no-category-found'] = "<div class='error'>Category not found</div>";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }
 
            

        ?>

        <form action="" method="POST" enctype="multipart/form-data">

            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    <td>
                        <input type="text" name="title" value="<?php echo $title; ?>">
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
                                <img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>width=150px;">
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
            // echo "Button Clicked";
            //1 get all the values from form to update
            $id = $_POST['id'];
            $title = $_POST['title'];
            $current_image = $_POST['current_image'];
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
                    $image_name = "Service-Category=".rand(0000,9999).".".$ext; //new image name such as "Service-Name.657.jpg"



                    $source_path = $_FILES['image']['tmp_name'];
                    $destination_path = "../images/category".$image_name;

                    //finally upload image
                    $upload = move_uploaded_file($source_path, $destination_path);

                    //check whether the image is uploaded or not
                    //if the image is not uploaded then stop the process and redirect with errpr msg
                    if($upload==false)
                    {
                        //set message
                        $_SESSION['upload']= "<div class='error'> Failed to Upload image</div>";
                        //redirect to add category page
                        header('location:'.SITEURL.'admin/manage-category.php');
                        //stop the proccess
                        die();
                    }
                    //B. remove current img if available
                    if($current_image!="")
                    {

                        $remove_path = "../images/category/".$current_image;

                        $remove = unlink($remove_path);

                        //check whether img is removed or not
                        //if failed to remove display msg and stop the process
                        if($remove==false)
                        {
                            //failed to remove img
                            $_SESSION['falied-remove'] = "<div class='error'> Failed to remove image</div>";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die();

                        }
                        else
                        {

                        }
                    }

                }
                else
                {
                    //img not available
                }
            }
            else
            {
                $image_name = $current_image;
            }

            //3. update the database
            $sql2 = "UPDATE tbl_category SET
            title = '$title',
            featured = '$featured',
            active = '$active'
            WHERE id= '$id'
            ";

            // execute the query 
            $res2 = mysqli_query($conn, $sql2);

            // check whether the queary is executed successfully or not
            if($res2==TRUE)
            {
                // query executed and admin is updated
                $_SESSION['update'] = "<div class='success'> Category updated successfully </div>";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
            else
            {
                // failed to update admin
                $_SESSION['update'] = "<div class='success'> Failed to update Category</div>";

                // redirect to manage admin page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
    ?>
</div>
</div>