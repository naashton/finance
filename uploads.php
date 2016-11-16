<?php
//require 'secure_conn.php';
require 'includes/header.php';

require_once ('../../pdo_config.php'); // Connect to DB
echo "<main>";
echo "<div class='container'>";
// Get folder name from session
session_start();
$folder = $_SESSION['folders'];
//echo "<script type='text/javascript'>alert('folder: $folder')</script>";
$emailAddr = $_SESSION['email'];
//echo "<script type='text/javascript'>alert('email: $emailAddr')</script>";

//$name = $_FILES['upload']['name'];
//$type = $_FILES['upload']['type'];
// Check if the form has been submitted:
if (isset($_POST['submit'])) {
    // Check for an uploaded file:
    if (isset($_FILES['upload'])) {
        // Validate the type. Should be JPEG or PNG.
        $allowed = array ('image/pjpeg', 'image/jpeg', 'image/JPG', 'image/X-PNG', 'image/PNG', 'image/png', 'image/x-png');
        if (in_array($_FILES['upload']['type'], $allowed)) {
            // Move the file over.
            if (move_uploaded_file ($_FILES['upload']['tmp_name'], "../../finance/{$folder}/{$_FILES['upload']['name']}")) {
                echo '<h2>The file '.$_FILES['upload']['name'].' has been uploaded!</h2>';
                echo "</main>";
                $name = $_FILES['upload']['name'];
                $type = $_FILES['upload']['type'];

                // SQL insert into finance_user_images table
                $sql = "INSERT into finance_user_images (emailAddr, filename, filetype) VALUES (:email, :filename, :filetype)";
                $stmt= $conn->prepare($sql);
                $stmt->bindValue(':email', $emailAddr);
                $stmt->bindValue(':filename', $name);
                $stmt->bindValue(':filetype', $type);
                $stmt->execute();

                include './includes/footer.php';
                // Delete the file if it still exists:
                if (file_exists ($_FILES['upload']['tmp_name']) && is_file($_FILES['upload']['tmp_name'])) {
                    unlink ($_FILES['upload']['tmp_name']);
                }
                exit;
            } // End of move... IF.
        } else { // Invalid type.
            echo '<h2 class="warning">Please upload a JPEG or PNG image.</h2>';
        }
    } // End of isset($_FILES['upload']) IF.

    // Check for an error:
    if ($_FILES['upload']['error'] > 0) {
        echo '<p class="warning">The file could not be uploaded because: <strong>';
        // Print a message based upon the error.
        switch ($_FILES['upload']['error']) {
            case 1:
                echo 'The file exceeds the upload_max_filesize setting in php.ini.';
                break;
            case 2:
                echo 'The file exceeds the MAX_FILE_SIZE setting in the HTML form.';
                break;
            case 3:
                echo 'The file was only partially uploaded.';
                break;
            case 4:
                echo 'No file was uploaded.';
                break;
            case 6:
                echo 'No temporary folder was available.';
                break;
            case 7:
                echo 'Unable to write to the disk.';
                break;
            case 8:
                echo 'File upload stopped.';
                break;
            default:
                echo 'A system error occurred.';
                break;
        } // End of switch.
        echo '</strong></p>';

    } // End of error IF.

} // End of the submitted conditional.
?>
    <h2>Upload an image</h2>

<?php
// Check to make sure the user is logged in.
if(isset($_SESSION['firstName'])){
    ?>
    <form enctype="multipart/form-data" action="uploads.php" method="post">
        <input type="hidden" name="MAX_FILE_SIZE" value="2097152">
        <fieldset>
            <legend>Select a JPEG or PNG image of 2M or smaller to be uploaded:</legend>
            <label for="file">
                File:<input type="file" name="upload" id="file"></label>
            <label for = "submit">And press
                <input type="submit" name="submit" value="Submit" id="submit"></label>
        </fieldset>
    </form>
    <?php
}
else {
    echo '<h2 class="warning">You need to be logged in to access this page.</h2>';
}
?>
</div>
</main>
<?php include './includes/footer.php'; ?>
