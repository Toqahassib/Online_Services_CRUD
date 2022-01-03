<?php include('../config/constants.php') ?>

<html>

    <head>
        <title>Login - Service Order System</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <body>
        
        <div class="login">
            <h1 class="text-center">Login</h1> 
            <br>

            <?php
                if(isset($_SESSION['login']))
                {
                    echo($_SESSION['login']);
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);

                }

            ?>

            <!-- login form starts here -->
            <form action="" method="post" class="text-center">
                Username: <br><br>
                <input type="text" name="username" placeholder="Enter username"><br><br>

                Password: <br><br>
                <input type="password" name="password" placeholder="Enter password"><br><br>

                <input type="submit" name="submit" value="Login" class="btn-primary"><br><br>

            </form>
            <!-- login form ends here -->



            <p class="text-center">Created by - <a href="#">Toqa Hassib</a></p>
        </div>
    </body>

</html>

<?php

    // check whether the submit button is clicked or not
    if(isset($_POST['submit']))
    {
        // proccess for login
        //1. get the data from login form

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. create sql query to check whether username exists or not
        $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        // 3. execute the query
        $res = mysqli_query($conn, $sql);

        // 4. count rows to check whether the users exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // user available and login success
            $_SESSION['login'] = "<div class='success'>Login successfull.</div>";
            $_SESSION['user'] = $username; //to check whether the user is logged in or not and logout will unset it

            // redirect to home page/dashboard
            header('location:'.SITEURL.'admin/');
        }
        else
        {
            // user not available and login fail
            $_SESSION['login'] = "<div class='error text-center'>username and password did not match</div>";
            // redirect to home page/dashboard
            header('location:'.SITEURL.'admin/login.php');

        } 
    }


?>