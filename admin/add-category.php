
<?php include('partials/menu.php'); 

ini_set ('error_reporting', E_ALL); ini_set ('display_errors', 1); ini_set ('display_startup_errors', 1);
?>

<div class="main">
    <div class="wrapper">
        <h1>Add Category</h1>
        <br><br>

        <?php
            if(isset($_SESSION['add'])) //checking whether the session is set or not
            {
                echo $_SESSION['add']; //display session message
                unset($_SESSION['add']); //remove session message
            }

            if(isset($_SESSION['upload'])) //checking whether the session is set or not
            {
                echo $_SESSION['upload']; //display session message
                unset($_SESSION['upload']); //remove session message
            }
        ?>

        <br><br>

        <!-- Add category form starts-->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class="tbl-30">
                <tr>
                    <td>Title: </td>
                    
                    <td>
                        <input type="text" name="title" placeholder="Category title" >
                    </td>
                </tr>

                <tr>
                    <td>Select Image: </td>
                    <td>
                        <input type="file" name="image">
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
                        <input type="radio" name="active" value="Yes">Yes
                        <input type="radio" name="active" value="No">No
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                    </td>
                </tr>
            </table>
        </form>
        <!-- Add category form ends-->

        <?php
            // check whether the submit button is clicked or not
            if(isset($_POST['submit']))
            { 
                // echo "clicked";
                // 1. get the value from category form
                $title = $_POST['title'];

                // for radio input, we need to check whether the button is selected or not
                if(isset($_POST['featured']))
                {
                    // get the value from form
                    $featured = $_POST['featured'];

                }
                else
                {
                    // det the default value
                    $featured = "No";
                }

                if(isset($_POST['active']))
                {
                    $active = $_POST['active'];

                }
                else
                {
                    $active = "No";
                }

                //check whether the image is selected or not and set the value for image name accordingly
                // print_r($_FILES['image']);
                // die();

                if(isset($_FILES['image']['name']))
                {
                    //upload the image
                    //to upload image we need image name, src path, and destination path
                    $image_name = $_FILES['image']['name'];

                    //upload the image only if image is selected 
                    if($image_name!="")
                    {
                        // auto rename our image
                        //get the extension of our image
                        $ext = end(explode('.',$image_name));
                        // var_dump($ext);
                        // $img_name = $image_name;

                        //rename the image
                        $image_name = "Service-Category=".rand(0000,9999).".".$ext; //new image name such as "service-Name.657.jpg"
                        
                        $source_path = $_FILES['image']['tmp_name'];
                        $destination_path = "../images/category/".$image_name;
                        
                        
                        //finally upload image
                        $upload = move_uploaded_file($source_path, $destination_path);
                          
                        
                        //check whether the image is uploaded or not
                        //if the image is not uploaded then stop the process and redirect with errpr msg
                        if(!$upload)
                        {
                            
                            //set message
                            $_SESSION['upload']= "<div class='error'> ERROR: "  . $upload . "</div>";

                            header('location:'.SITEURL.'/admin/add-category.php?');
                            //stop the proccess
                            die();
                        }
                    
                    }

                }
                else
                {
                    //dont upload image and set the image_name value as blank
                    $image_name = "";
                }

                // 2. create sql query to insert category into database
                $sql = "INSERT INTO tbl_category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";

                // 3. execute the query and save in database
                $res = mysqli_query($conn, $sql);

                

                // 4. check whether the query is executed or not and data added or not
                if($res==TRUE)
                {
                    // query executed and category added
                    $_SESSION['add'] = "<div class='success'>Category Added successfully</div>";
                    // redirect to manage category
                    header("location:".SITEURL.'admin/manage-category.php');
                }
                else
                {
            
                    // failed to add category
                    $_SESSION['add'] = "<div class='error'>Failed to add Category</div>";
                    // redirect to manage category
                    header("location:".SITEURL.'admin/add-category.php');
                }
                
            }
        ?>


    </div>
</div>


<?php include('partials/footer.php'); ?>
