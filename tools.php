<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 11/12/2016
 * Time: 3:07 PM
 */
require './includes/header.php';
//require_once ('../../pdo_config.php');

/*
 * =====================================================================================================================
 * Get values the user input from the form and check for errors and missing values
 */
if (isset($_GET['send'])) {
    //Check for errors and missing values
    $missing = array();
    $errors = array();

    $pvalue = trim(filter_input(INPUT_GET, 'pvalue', FILTER_SANITIZE_STRING)); //returns a string
    if (empty($pvalue))
        $missing[]='pvalue';

    $interest = trim(filter_input(INPUT_GET, 'interest', FILTER_SANITIZE_STRING));
    if (empty($interest))
        $missing[]='interest';

    $terms = trim(filter_input(INPUT_GET, 'terms', FILTER_SANITIZE_STRING));
    if (empty($terms))
        $missing[]='terms';
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


        echo '<main><h2>Thank you for registering</h2><h3>We have saved your information</h3></main>';
        include './includes/footer.php';
        exit;
    }
     */
}
/*======================================================================================================================
 * npvFormula takes 3 parameters and calculates the future value
 * This is a basic function that can easily be expanded upon to calculate loan repayments,
 * future values of investments, number of terms required to finish paying a loan, etc.
 */

/**
 * @param $pv the present value of the investment
 * @param $i the interest rate
 * @param $n number of terms
 * @return int future value after calculating the compounding interest
 */
function npvFormula($pv, $i, $n){
    //These variables will be needed for future calculations, but possibly in different functions
    $p = 0; //principle
    $fv = 0; //future value
    $pmt = 0;

    //All values are needed to calculate the future value
    $i = $i; //interest
    $n = $n; //number of terms
    $pv = $pv; //present value

    //Convert percent value to a decimal
    $i = $i / 100;

    //Formula
    $fv = $pv * ((1 + $i) ** $n);

    return $fv;
}
?>


<main>
    <div class="container">
        <h2>Net Present Value</h2>
        <p>Enter values to calculate the net present value.</p>
        <form method="get" action="tools.php">
            <fieldset>
                <legend>NPV Calculator</legend>
                <?php if ($missing || $errors) { ?>
                    <p class="label label-danger">Please fix the item(s) indicated.</p>
                <?php  } ?>
                <p>
                    <label for="pvalue">Present Value:
                        <?php if ($missing && in_array('pvalue', $missing)) { ?>
                            <span class="label label-danger">Please enter your first name</span>
                        <?php } ?> </label>
                    <input name="pvalue" id="pvalue" type="text"
                        <?php if (isset($pvalue)) {
                            echo 'value="'  . htmlspecialchars($pvalue) . '"';
                        } ?>
                    >
                </p>
                <p>
                    <label for="interest">Interest:
                        <?php if ($missing && in_array('interest', $missing)) { ?>
                            <span class="label label-danger">What is the interest rate?</span>
                        <?php } ?> </label>
                    <input name="interest" id="interest" type="text"
                        <?php if (isset($interest)) {
                            echo 'value="' . htmlspecialchars($interest) . '"';
                        } ?>
                    >
                </p>
                <p>
                    <label for="terms">Number of terms:
                        <?php if ($missing && in_array('terms', $missing)) { ?>
                            <span class="label label-danger">Enter the number of terms</span>
                        <?php } ?>
                    </label>
                    <input name="terms" id="terms" type="text"
                           <?php if (isset($terms)) {
                               echo 'value="' . htmlspecialchars($terms) . '"';
                           } ?>
                    >
                </p>
                <p>
                    <input name="send" type="submit" value="Calculate">
                </p>
            </fieldset>
        </form>
        <!-- Output the calculation -->
        <?php
        if (!$missing && !$errors) {
            $fv_calc = npvFormula($pvalue, $interest, $terms);
            echo '<h2>';
            printf("The future value is: $%.2f", $fv_calc);
            echo '</h2>';
        }
        ?>

    </div>
</main>



<?php require './includes/footer.php'; ?>
