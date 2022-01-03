<?php
include "./config/constants.php";


//check whether username and password are entered
if (isset($_POST['uname']) && isset($_POST['password'])) {

	function validate($data){
		//strip unnecessary characters (extra space, tab, newline) from the user input data
       $data = trim($data);

	   //remove backslashes (\) from the user input data 
	   $data = stripslashes($data);

	   //converts special characters to HTML entities. If a user tries to enter some code in the form, it will not be executed 
	   $data = htmlspecialchars($data);
	   return $data;
	}

    //1. get the data from login form
	$uname = validate($_POST['uname']);
	$pass = validate($_POST['password']);

	//validation for empty username
	if (empty($uname)) {
		header("Location: login2.php?error=User Name is required");
	    exit();
	
	//validation for empty password
	}else if(empty($pass)){
        header("Location: login2.php?error=Password is required");
	    exit();
	}else{
		// hashing the password
        $pass = md5($pass);

        //2. create sql query to check whether username exists or not
		$sql = "SELECT * FROM users WHERE user_name='$uname' AND password='$pass'";

		//execute the query
		$result = mysqli_query($conn, $sql);

		//if number of rows = 1, username and password exist
		if (mysqli_num_rows($result) === 1) {
			$row = mysqli_fetch_assoc($result);
			//if username and password match
            if ($row['user_name'] === $uname && $row['password'] === $pass) {
            	$_SESSION['user_name'] = $row['user_name'];
            	$_SESSION['name'] = $row['name'];
            	$_SESSION['id'] = $row['id'];
				//login
            	header("Location: home.php");
		        exit();
            }else{
				//if not then they do not exist so redirect to login page
				header("Location: login2.php?error=Incorect User name or password");
		        exit();
			}
		}else{
			header("Location: login2.php?error=Incorect User name or password");
	        exit();
		}
	}

}else{

	//not entered so redirect to same page
	header("Location: login2.php");
	exit();
}