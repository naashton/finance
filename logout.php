<?php
/**
 * Created by PhpStorm.
 * User: nick
 * Date: 11/11/16
 * Time: 5:01 PM
 */

// Access the existing session.
session_start();
//require_once 'reg_conn.php';
require 'includes/header.php';
?>

<main>
    <div class="container">
    <?php
    if(isset($_SESSION) && isset($_SESSION['firstName'])){ //check for session variable
        $firstName = $_SESSION['firstName'];
        $_SESSION = array();

        session_destroy();
        //setcookie('PHPSESSID', '' ,time()-3600, '/');
        $message = 'You have successfully logged out ' . $firstName;
        $message2 = 'Thank you for visiting';
    } else {
        $message = 'You have reached this page in error';
        $message2 = 'Please use the menu at the right';
    }
    // Print the message:
    echo '<h2>'.$message.'</h2>';
    echo '<h3>'.$message2.'</h3>';
    ?>
    </div>
</main>
<?php // Include the footer and quit the script:
include ('./includes/footer.php');
?>

