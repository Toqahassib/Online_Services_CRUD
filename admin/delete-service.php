<?php

    //include constants file
    include('../config/constants.php');

    // check whether the id and image_name value is set or not
    if(isset($_GET['id']))
    {
        //get the value and delete
        $id = $_GET['id'];
        $image_name = $_GET['image_name'];

        //remove the image file if available
        if($image_name != "")
        {
            //image is available so remoce it
            $path = "../images/category/".$image_name;

            //remove the image
            $remove = unlink($path);

            //if failed to remove image then add an error message and stop the process
            if($remove==false)
            {
                //set the session msg
                $_SESSION['remove'] = "<div class='error'> Failed to remove category image </div>";
                //redirect to manage category page
                header('location:'.SITEURL.'admin/manage-service.php');
                //stop process
                die();
            }

        }
        //delete data from database
        // sql query to delete data from database
        $sql = "DELETE FROM tbl_services WHERE id=$id";

        //execute the query
        $res = mysqli_query($conn, $sql);

        //check whether the data is deketed from database or not
        if($res==true)
        {
            //set success message and redirect
            $_SESSION['delete'] = "<div class='success'> service deleted successfully </div>";
            //redirect to manage categpry
            header('location:'.SITEURL.'admin/manage-service.php');
        }
        else
        {
            //set faile message and redirect
            $_SESSION['delete'] = "<div class='error'> Failed to delete service </div>";
            //redirect to manage categpry
            header('location:'.SITEURL.'admin/manage-service.php');        }

    }
    else
    {
        //redirect to manage category page
        $_SESSION['unauthorize'] = "<div class='error'> unauthorized access </div>";
        header('location:'.SITEURL.'admin/manage-service.php');
        
    }
?>


?>