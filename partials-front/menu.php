<?php include('config/constants.php') ?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="css/style-admin2.css">
</head> 

<body>
    <!-- header section starts -->
    <header class="header">

    <a href="#" class="logo">Rapid Repair.</a>
    <img src="" alt="">

    <div class="fas fa-bars"></div>

    <nav class="navbar">

        <ul>
            <li><a href="<?php echo SITEURL; ?>home.php">home</a></li>
            <li><a href="<?php echo SITEURL; ?>categories.php">categories</a></li>
            <li><a href="<?php echo SITEURL; ?>service.php">services</a></li>
            <li><a href="#contact">contact</a></li>
            <li><a href="<?php echo SITEURL; ?>logout.php">logout</a></li>

        </ul>
    </nav>

    </header>
    <!-- header section ends -->