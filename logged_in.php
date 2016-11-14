<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 11/12/2016
 * Time: 9:56 AM
 */

session_start();
require 'includes/header.php';
?>

<main>
    <div class="container">
    <?php
        if(isset($_SESSION) && isset($_SESSION['firstName'])){
            $firstname = $_SESSION['firstName'];
            $message = "Welcome back, $firstname";
        } else {
            $message = "You have reached this page in error";
        }

        echo '<h2>'.$message.'</h2>';
    ?>
    </div>
</main>
<?php include ('./includes/footer.php'); ?>