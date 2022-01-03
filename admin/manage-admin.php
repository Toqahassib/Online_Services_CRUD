<?php include('partials/menu.php'); ?>



        <!-- main content section start -->
        <div class="main">
            <div class="wrapper">
                <h1>Manage Admin</h1>
                <br><br>

                <?php 

                    // add-manage.php
                    if(isset($_SESSION['add']))
                    {
                        echo $_SESSION['add']; //display session message
                        unset($_SESSION['add']); //remove session message
                    }

                    // delete-manage.php
                    if(isset($_SESSION['delete']))
                    {
                        echo $_SESSION['delete']; //display session message
                        unset($_SESSION['delete']); //remove session message
                    }

                    // update-manage.php
                    if(isset($_SESSION['update']))
                    {
                        echo $_SESSION['update']; //display session message
                        unset($_SESSION['update']); //remove session message
                    }

                    // update-password.php
                    if(isset($_SESSION['user-not-found']))
                    {
                        echo $_SESSION['user-not-found']; //display session message
                        unset($_SESSION['user-not-found']); //remove session message
                    }

                    // update-password.php
                    if(isset($_SESSION['pwd-not-match']))
                    {
                        echo $_SESSION['pwd-not-match']; //display session message
                        unset($_SESSION['pwd-not-match']); //remove session message
                    }

                    // update-password.php
                    if(isset($_SESSION['change-pwd']))
                    {
                        echo $_SESSION['change-pwd']; //display session message
                        unset($_SESSION['change-pwd']); //remove session message
                    }
                ?>
                <br><br><br>

                <!-- button to add admin -->

                <a href="add-admin.php" class="btn-primary">Add Admin</a>
                <br><br><br>

                <table class="tbl-full">
                    <tr>
                        <th>S.N</th>
                        <th>Full Name</th>
                        <th>Username</th>
                        <th>Actions</th>
                    </tr>

                    <?php
                    // query to get all admin
                        $sql = "SELECT * FROM tbl_admin";
                        //execute the query
                        $res = mysqli_query($conn, $sql);

                        //check whether the query is executed or not
                        if($res==TRUE)
                        {
                            //count rows to check whether we have data in database or not
                            $count = mysqli_num_rows($res); // function to get all the rows in database

                            $sn = 1; //create a variable and assign the value
                            //check the num of rows
                            if($count>0)
                            {
                                //we have data in database
                                while($rows=mysqli_fetch_assoc($res))
                                {
                                    //using while loop to get all the data from database
                                    //and while loop will run as long as we have data in database

                                    //get individual data
                                    $id=$rows['id'];
                                    $full_name=$rows['full_name'];
                                    $username=$rows['username'];

                                    //display the values in our table
                                    ?>

                                    <tr>
                                        <td><?php echo $sn++; ?></td>
                                        <td><?php echo $full_name; ?></td>
                                        <td><?php echo $username; ?></td>
                                        <td>

                                            <!-- send id to through url (GET method)-->
                                            <a href="<?php echo SITEURL; ?>admin/update-password.php?id= <?php echo $id; ?>" class="btn-primary">Change Password</a>
                                            <a href="<?php echo SITEURL; ?>admin/update-admin.php?id= <?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                            <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id= <?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                        </td>
                                    </tr>

                                    <?php
                                }
                            }
                            else
                            {
                                //we do not have data in database
                            }
                        }
                    ?>
                </table>

            </div>
        </div>
        <!-- main content section end -->

<?php include('partials/footer.php'); ?>
