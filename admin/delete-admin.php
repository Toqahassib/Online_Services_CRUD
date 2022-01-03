<?php

    // include constants.php file
    include('../config/constants.php');

    // 1. get id of admin to be deleted
    $id = $_GET['id'];

    // 2.create sql query to delete admin
    $sql = "DELETE FROM tbl_admin WHERE id=$id";

    // execute the query
    $res = mysqli_query($conn, $sql);

    // check whether the query executed successfully or not 
    if($res==TRUE)
    {
        // query executed successfully and admin is deleted
        // echo "Admin deleted";

        // create session variable to display the message
        $_SESSION['delete'] = "<div class='success'>Admin Deleted Successfully</div>";

        // redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed to delete the admin 
        // echo "failed to delete admin";


        // create session variable to display the message
        $_SESSION['delete'] = "<div class='error'>Failed to delete admin</div>";

        // redirect to manage-admin page
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    // 3. redirect to manage admin page with message (success or error)



?>