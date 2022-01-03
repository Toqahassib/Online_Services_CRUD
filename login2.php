<!DOCTYPE html>
<html>
<head>
	<title>Animated Login Form</title>
	<link rel="stylesheet" type="text/css" href="css/registration2.css">


	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

	<!-- header section starts -->
<header class="header">
	<a href="#" class="logo">Rapid Repair.</a>
	
	
	<div class="fas fa-bars"></div>
	
	<nav class="navbar">
	
		<ul>
			<li><a href="index.php">home</a></li>
			<li><a href="index.php#about">about</a></li>
			<li><a href="index.php#service">services</a></li>
			<li><a href="index.php#projects">projects</a></li>
			<li><a href="index.php#team">team</a></li>
			<li><a href="index.php#contact">contact</a></li>
			<li><a href="signup.php" class="login-btn">Signup</a></li>
	
		</ul>
	</nav>
	
	</header>

		<!-- header section ends -->

	<img class="wave" src="images/landing_img/loginwave.png">
	<div class="container">
		<div class="img">
			<img src="images/landing_img/loginpic.png">
		</div>
		<div class="login-content">
        <form action="login.php" method="post">

				<img src="images/landing_img/avatar.svg">
				<h2 class="title">Welcome</h2>
				<?php if (isset($_GET['error'])) { ?>
					<p class="error"><?php echo $_GET['error']; ?></p>
				<?php } ?>
           		<div class="input-div one">
           		   <div class="i">
           		   		<i class="fas fa-user"></i>
           		   </div>
           		   <div class="div">
           		   		<h5>Username</h5>
           		   		<input type="text" class="input" name="uname">
           		   </div>
           		</div>
           		<div class="input-div pass">
           		   <div class="i"> 
           		    	<i class="fas fa-lock"></i>
           		   </div>
           		   <div class="div">
           		    	<h5>Password</h5>
           		    	<input type="password" class="input" name="password">
            	   </div>
            	</div>
            	<input type="submit" class="btn" value="Login">
            </form>
        </div>
    </div>


    <script type="text/javascript" src="js/login2.js"></script>
	<!-- <script type="text/javascript" src="js/main.js"></script> -->

</body>
</html>
