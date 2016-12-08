
<!-- Nick Ashton -->
<!-- fiscally.so copyright header -->
<!-- The menu.php file contains all of the navbar items pertinent to the webpage -->
<?php session_start();
$currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
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

                <!-- User menu item features below-->
                <?php if(isset($_SESSION['firstName'])) {?>
                <li><a href="uploads.php"> Uploads</a></li>
                <?php } else {} ?>
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

