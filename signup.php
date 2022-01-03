<!DOCTYPE html>
<html>
<head>
	<title>Animated signup Form</title>
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
		</ul>
	</nav>
	
	</header>

	<img class="wave" src="images/landing_img/loginwave.png">
	<div class="container">
		<div class="img">
			<img src="images/landing_img/loginpic.png">
		</div>
		<div class="login-content">
			<form action="signup-check.php" method="post">

				<img src="images/landing_img/avatar.svg">
				<h2 class="title">Signup</h2>
				<?php if (isset($_GET['error'])) { ?>
                    <p class="error"><?php echo $_GET['error']; ?></p>
               <?php } ?>

               <?php if (isset($_GET['success'])) { ?>
                    <p class="success"><?php echo $_GET['success']; ?></p>
               <?php } ?><br><br>

           	<div class="input-div one">

				<div class="i">
					<i class="fas fa-user"></i>
				</div>

				<div class="div">
					<h5>Name</h5>
					<?php if (isset($_GET['name'])) { ?>
                    <input type="text" name="name" class="input"
                         <?php echo $_GET['name']; ?>"><?php }else{ ?>
                    <input type="text" name="name" class="input"><?php }?>
			</div>
			</div>

			<div class="input-div one">

			<div class="i">
					<i class="fas fa-user"></i>
			</div>

			<div class="div">
				<h5>Username</h5>
				<?php if (isset($_GET['uname'])) { ?>
				<input type="text" name="uname" class="input"<?php echo $_GET['uname']; ?>"><br><?php }else{ ?>
				<input type="text" name="uname" class="input"><?php }?>                     
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

			<div class="input-div pass">
				<div class="i"> 
					<i class="fas fa-lock"></i>
				</div>
				<div class="div">
					<h5>Re-Password</h5>
                    <input type="password" class="input" name="re_password">
				</div>

			</div>
			<a href="login2.php">Already have an account?</a>
			<input type="submit" class="btn" value="Signup">
		</form>
    </div>
    </div>
    <script type="text/javascript" src="js/login2.js"></script>
</body>
</html>
