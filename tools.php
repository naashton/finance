<?php
/**
 * Created by PhpStorm.
 * User: Nick
 * Date: 11/12/2016
 * Time: 3:07 PM
 */
require './includes/header.php';
//require_once ('../../pdo_config.php');

/*======================================================================================================================
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

    $years = trim(filter_input(INPUT_GET, 'years', FILTER_SANITIZE_STRING));
    if (empty($years))
        $missing[]='years';

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
function npvFormula($pv, $i, $y, $n){
    //These variables will be needed for future calculations, but possibly in different functions
    $p = 0; //principle
    $fv = 0; //future value
    $pmt = 0;
    $m = 1; //number of terms as an integer value

    //All values are needed to calculate the future value
    $i = $i; //interest
    $n = $n; //number of terms as a string
    $pv = $pv; //present value
    $y = $y; //number of years

    //Convert terms
    if($n == "annual"){
        $m = 1;
    }
    elseif($n == "semiannual"){
        $m = 2;
    }
    elseif ($n == "monthly"){
        $m = 12;
    }
    elseif ($n == "weekly"){
        $m = 52;
    }

    //Convert nominative interest rate to EAR
    $ear = ((1 + $i/$m) ** $m) - 1;

    //Convert percent value to a decimal
    $i = $i / 100;
    $ear = $ear / 100;

    //Calculate the future value using the effective annual interest rate
    $fv = $pv * ((1 + $ear) ** $y);

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
                    <p class="label label-warning">Please fix the item(s) indicated.</p>
                <?php  } ?>
                <p>
                    <label for="pvalue">Present Value:
                        <?php if ($missing && in_array('pvalue', $missing)) { ?>
                            <span class="label label-warning">Please enter your first name</span>
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
                            <span class="label label-warning">What is the interest rate?</span>
                        <?php } ?> </label>
                    <input name="interest" id="interest" type="text"
                        <?php if (isset($interest)) {
                            echo 'value="' . htmlspecialchars($interest) . '"';
                        } ?>
                    >
                </p>
                <p>
                    <label for="years">Number of years:
                        <?php if ($missing && in_array('years', $missing)) { ?>
                            <span class="label label-warning">Enter the number of years</span>
                        <?php } ?>
                    </label>
                    <input name="years" id="years" type="text"
                           <?php if (isset($years)) {
                               echo 'value="' . htmlspecialchars($years) . '"';
                           } ?>
                    >
                </p>
                <!----------------------------------------------------------------------------------------------------->
                <!-- ToDo: Get terms from user via monthly, bimonthly, annual, semiannual, in order to calculate EAR -->
                <p>
                    <?php if ($missing && in_array('terms', $missing)) {?>
                        <span class="label label-warning">Enter the number of terms</span>
                    <?php }?>
                    <label for="terms">Frequency of compounding interest: </label>

                    <select name="terms" id="terms">
                        <option value="annual"
                            <?php if($terms=="annual") { echo "selected"; }?>>Annual</option>
                        <option value="semiannual"
                            <?php if($terms=="semiannual"){ echo "selected"; }?>>Semi-Annual</option>
                        <option value="monthly"
                            <?php if($terms=="monthly"){ echo "selected"; }?>>Monthly</option>
                        <option value="weekly"
                            <?php if($terms=="weekly"){ echo "selected"; }?>>Weekly</option>
                    </select>
                </p>
                <!----------------------------------------------------------------------------------------------------->
                <p>
                    <input name="send" type="submit" value="Calculate">
                </p>
            </fieldset>
        </form>
        <!-- Output the calculation -->
        <?php
        if (!$missing && !$errors) {
            $fv_calc = npvFormula($pvalue, $interest, $years, $terms);
            echo '<h2>';
            printf("The future value is: $%.2f", $fv_calc);
            echo '</h2>';
        }
        ?>

    </div>
</main>



<?php require './includes/footer.php'; ?>
