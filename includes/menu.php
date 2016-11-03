<?php $currentPage = basename($_SERVER['SCRIPT_FILENAME']); ?>
	<ul id="nav">
        <li><a href="index.php" <?php if ($currentPage == 'index.php') {echo 'id="here"'; } ?>>Home</a></li>
        <li><a href="register.php" <?php if ($currentPage == 'register.php') {echo 'id="here"'; } ?>>Register</a></li>
        <li><a href="login.php" <?php if ($currentPage == 'register.php') {echo 'id="here"'; } ?>>Login</a></li>
    </ul>