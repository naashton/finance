<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 11/12/2016
 * Time: 3:07 PM
 */
//require '/include/header.php';
    global $fv;

//----------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------

require './includes/header.php';
require_once ('../../pdo_config.php');

if (isset($_GET['send'])) {
    //Determine if name or email is missing and report
    $missing = array();
    $errors = array();
    //$email_exists = False;

    $pvalue = trim(filter_input(INPUT_GET, 'pvalue', FILTER_SANITIZE_STRING)); //returns a string
    if (empty($pvalue))
        $missing[]='pvalue';

    $lastname = trim(filter_input(INPUT_GET, 'lastname', FILTER_SANITIZE_STRING));
    if (empty($lastname))
        $missing[]='lastname';

    $valid_email = trim(filter_input(INPUT_GET, 'email', FILTER_VALIDATE_EMAIL));	//returns a string or null if empty or false if not valid
    if (trim($_GET['email']==''))
        $missing[] = 'email';
    elseif (!$valid_email)
        $errors[] = 'email';
    else $email = $valid_email;

    //Password
    $password1 = trim(filter_input(INPUT_GET, 'password1', FILTER_SANITIZE_STRING));
    $password2 = trim(filter_input(INPUT_GET, 'password2', FILTER_SANITIZE_STRING));
    // Check for a password:
    if (empty($password1) || empty($password2))
        $missing[]='password';
    elseif ($password1 !== $password2)
        $errors[] = 'password';
    else $password = $password1;

    $accepted = filter_input(INPUT_GET, 'terms');
    if (empty($accepted) || $accepted !='accepted')
        $missing[] = 'accepted';

    /**
    if (!$missing && !$errors) {
        //require_once ('../../pdo_config.php'); // Connect to the db.
        $sql = "INSERT into finance_reg_users (firstName, lastName, emailAddr, pw) VALUES (:firstName, :lastName, :email, :pw)";
        $pw =
        $stmt= $conn->prepare($sql);
        $stmt->bindValue(':firstName', $firstname);
        $stmt->bindValue(':lastName', $lastname);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':pw', password_hash($password1, PASSWORD_DEFAULT));
        $success = $stmt->execute();
        $errorInfo = $stmt->errorInfo();

     if (isset($errorInfo[2]))
            echo $errorInfo[2];
        else


        echo '<main><h2>Thank you for registering</h2><h3>We have saved your information</h3></main>';
        include './includes/footer.php';
        exit;
    }
     */
}
//============================================================================================
//============================================================================================


function npvFormula(){
    $p = 0; //principle
    $i = .05; //interest
    $n = 3; //number of terms
    $pv = 100; //present value
    $fv = 0; //future value
    $pmt = 0;

    $fv = $pv * ((1 + $i) ** $n);

    return $fv;
}
?>

<!-- ======================================================================================= -->

<main>
    <div class="container">
        <h2>Loan Repayment Calculator</h2><br>
        <h4>This website seeks to provide the investor with the information and tools to help make informed financial and investment decisions. The site is free to use for any user and registration will allow for users to make an investor profile so they can more proactively keep track of their portfolio.</h4>
        <p><?php
            echo npvFormula() . "<br>";
            echo "The future value is: ". $fv . "<br>" ?></p>
        <p><?php
            printf("The future value is: $%.2f", npvFormula());
            ?></p>
    </div>
</main>

<!-- ====================================================================================== -->

<main>
    <div class="container">
        <h2>Net Present Value</h2>
        <p>Enter values to calculate the net present value.</p>
        <form method="get" action="tools.php">
            <fieldset>
                <legend>NPV Calculator</legend>
                <?php if ($missing || $errors) { ?>
                    <p class="warning">Please fix the item(s) indicated.</p>
                <?php  } ?>
                <p>
                    <label for="pvalue">Present Value:
                        <?php if ($missing && in_array('pvalue', $missing)) { ?>
                            <span class="warning">Please enter your first name</span>
                        <?php } ?> </label>
                    <input name="pvalue" id="pvalue" type="text"
                        <?php if (isset($pvalue)) {
                            echo 'value="'  . htmlspecialchars($pvalue) . '"';
                        } ?>
                    >
                </p>
                <p>
                    <label for="lastname">Last Name:
                        <?php if ($missing && in_array('lastname', $missing)) { ?>
                            <span class="warning">Please enter your last name</span>
                        <?php } ?> </label>
                    <input name="lastname" id="lastname" type="text"
                        <?php if (isset($lastname)) {
                            echo 'value="' . htmlspecialchars($lastname) . '"';
                        } ?>
                    >
                </p>
                <p>
                    <label for="email">Email:
                        <?php if ($missing && in_array('email', $missing)) { ?>
                            <span class="warning">Please enter your email address</span>
                        <?php } ?>
                        <?php if ($errors && in_array('email', $errors)) { ?>
                        <span class="warning">The email address you provided is not valid<  /span>
                            <?php } ?>
                            <!-- Check for duplicate email addresses -->
                            <?php if($errors && in_array('dup_email', $errors)) {
                                //if ($email_dup && in_array('email', $email_dup)) { ?>
                                <span class="warning">The email address you provided already exists in our system</span>
                            <?php } ?>
                    </label>
                    <input name="email" id="email" type="text"
                        <?php if (isset($email) && !$errors['email']) {
                            echo 'value="' . htmlspecialchars($email) . '"';
                        } ?>>
                </p>
                <!-- HTML Password-->
                <p>
                    <?php if ($errors && in_array('password', $errors)) { ?>
                        <span class="warning">The entered passwords do not match. Please try again.</span>
                    <?php } ?> </label>
                    <label for="pw1">Password:

                        <?php if ($missing && in_array('password', $missing)) { ?>
                            <span class="warning">Please enter a password</span>
                        <?php } ?> </label>
                    <input name="password1" id="pw1" type="password">
                </p>
                <p>
                    <label for="pw2">Confirm Password:
                        <?php if ($missing && in_array('password', $missing)) { ?>
                            <span class="warning">Please confirm the password</span>
                        <?php } ?> </label>
                    <input name="password2" id="pw2" type="password">
                </p>

                <p>
                    <label for="comment">Comment on our website:
                        <textarea rows="" cols=""></textarea>
                    </label>
                </p>
                <p>
                    <?php if ($missing && in_array('accepted', $missing)){?>
                        <span class="warning">You must agree to our terms</span><br>
                    <?php } ?>
                    <input type="checkbox" name="terms" value="accepted" id="terms"
                        <?php if($accepted){
                            echo 'checked';
                        }?>>
                    <label for="terms">I accept the terms of using this website</label>
                </p>
                <p>
                    <input name="send" type="submit" value="Send message">
                </p>
            </fieldset>
        </form>
    </div>
</main>


<?php require './includes/footer.php'; ?>
