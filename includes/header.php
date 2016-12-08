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

    <?php require './includes/menu.php'; ?>


    <header>
    <div class="jumbotron text-center">
    <h1>fiscally.so</h1>
    </div>
    </header>
</div>