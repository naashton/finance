<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap -->
    <link href = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" rel = "stylesheet">
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <title>fiscally.so<?php if(isset($title)) {echo "&mdash;$title";} ?></title>
    <!--<link href="styles/main.css" rel="stylesheet" type="text/css">-->
</head>



<body>
<div class="container">
    <?php
    //require './includes/menu.php'; ?>

        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">fiscally.so</a>
                </div>
                <div class="collapse navbar-collapse" id="myNavbar">
                    <ul class="nav navbar-nav">
                        <!--li class="active"><a href="#">Home</a></li>-->
                        <li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
                        <li><a href="tools.php" <?php if ($currentPage == 'tools.php') {echo 'id="here"'; } ?>>Tools</a></li>
                    </ul>

                    <!-- Check if there is an active user session -->
                    <ul class="nav navbar-nav navbar-right">
                        <?php if(isset($_SESSION['firstName'])) { ?>
                            <li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
                        <?php } else { ?>
                            <li><a href="register.php"><span class="glyphicon glyphicon-user"></span> Register</a></li>
                            <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>


    <header>
    <div class="jumbotron text-center">
    <h1>fiscally.so</h1>
    </div>
    </header>
</div>

