<?php //This is the login page for registered users
session_start();
require 'secure_conn.php';
//require 'includes/header.php';
if (isset($_POST['send'])) {
	$missing = array();
	$errors = array();
	
	$valid_email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid	
	if (trim($_POST['email']=='')|| (!$valid_email))  //Either empty or invalid email will be considered missing
		$missing[] = 'email';
	else
		$email = $valid_email;
	
	$password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
	
	// Check for a password:
	if (empty($password))
		$missing[]='password';
	
	if (!$missing && !$errors) {
		require_once ('../../pdo_config.php'); // Connect to the db.
		// Make the query:
		$sql = "SELECT firstName, emailAddr, pw FROM finance_reg_users WHERE emailAddr = :email";
		$stmt = $conn->prepare($sql);
		$stmt->bindValue(':email', $email);
		$stmt->execute();
		$errorInfo = $stmt->errorInfo();
		if (isset($errorInfo[2])){
			echo $errorInfo[2];
			exit;
		}
		else {
			$rows = $stmt->rowCount();
			if ($rows==0) { //email not found
				$errors[] = 'email';
			}
			else { // email found, validate password
				$result = $stmt->fetch();
				if ($password == password_verify($password, $result['pw'])) { //passwords match
					//$firstName = $result['firstName'];
					//session_start();
					$_SESSION['firstName'] = $result['firstName'];
					$_SESSION['email'] = $result['email'];
					$firstName = $_SESSION['firstName'];
					$email = $_SESSION['email'];
					
					//set cookies
					setcookie('firstName',$firstName);
					setcookie('email',$email);
					//redirect
					//ToDO: redirect header using HTTP_HOST and PHP_SELF
					//$_SERVER['HTTP_HOST'] = 'webdev.cislabs.uncw.edu';
					//$_SERVER['PHP_SELF'] = '/~naa5728/finance_web/logged_in.php';
					//dirname($_SERVER['PHP_SELF']) = '/~naa5728/finance_web/logged_in.php';
					//$url = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']);
					//header("Location:$url");
					header('Location:http://webdev.cislabs.uncw.edu/~naa5728/finance_web/logged_in.php');
                    exit();
				}
				else {
					$errors[]='password';
				}
			} 
		} // End of else errors
	
	}
}
require 'includes/header.php';
?>
    <!--ToDo: Alter the look of the password label to match the e-mail label -->
	<main>
		<div class="container">
			<h2>fiscally.so</h2>
        	<p></p>

            <form method="post" action="" class="form-horizontal">
                <div class="form-group">
                    <fieldset>
                        <legend>Registered Users Login</legend>
                        <?php if ($missing || $errors) { ?>
                        <p class="warning">Please fix the item(s) indicated.</p>
                        <?php } ?>
                    <p>
                        <label class="control-label col-sm-2" for="email">Email:
                            <div class="col-sm-4">
                                <?php if ($missing && in_array('email', $missing)) { ?>
                                        <span class="label label-danger">An email address is required</span>
                                    <?php } ?>
                                <?php if ($errors && in_array('email', $errors)) { ?>
                                        <span class="label label-danger">The email address you provided is not associated with an account</span>
                                    <?php } ?>
                        </label>
                                <input name="email" id="email" type="text"
                                <?php if (isset($email) && !$errors['email']) {
                                    echo 'value="' . htmlspecialchars($email) . '"';
                                } ?>>
                            </div>
                    <p>
                        <?php if ($errors && in_array('password', $errors)) { ?>
                                <span class="label label-danger">The password supplied does not match the password for this email address. Please try again.</span>
                            <?php } ?> </label>
                        <label for="pw">Password:

                        <?php if ($missing && in_array('password', $missing)) { ?>
                                <span class="label label-danger">Please enter a password</span>
                            <?php } ?> </label>
                        <input name="password" id="pw" type="password">
                    </p>

                    <p>
                        <input name="send" type="submit" value="Login">
                    </p>
                    </fieldset>
            </form>
        </div>
	</main>
<?php include './includes/footer.php'; ?>
