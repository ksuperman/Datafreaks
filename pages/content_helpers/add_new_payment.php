<?php
include "../../utilities/global_variables.php"
?>

<?php
include("$document_root/utilities/dbConnect.php");
?>

<?php
include("$document_root/utilities/errorhandler.php");
set_error_handler('customErrorHandler');
?>

<?php
include("$document_root/utilities/session.php");
?>

<?php
include("$document_root/utilities/applicationContext.php");
?>


<?php
function redirectToUserDetailPage($count)
{
    header("Location:../user_details.php?update=$count");
    exit();
}

if (isset($_REQUEST['type'])) {
    $type = $_REQUEST['type'];
}

if (isset($_REQUEST['FULLNAME'])) {
    $FULLNAME = $_REQUEST['FULLNAME'];
}

if (isset($_REQUEST['CARDNUMBER'])) {
    $CARDNUMBER = $_REQUEST['CARDNUMBER'];
}

if (isset($_REQUEST['PIN_CVV'])) {
    $PIN_CVV = $_REQUEST['PIN_CVV'];
}

if (isset($_REQUEST['EXPDATE'])) {
    $EXPDATE = $_REQUEST['EXPDATE'];
}

logErrorToConsole("Add New Address Details" . var_export($type.$FULLNAME.$CARDNUMBER.$PIN_CVV.$EXPDATE, true) );

if (isset($type) AND isset($FULLNAME) AND isset($CARDNUMBER) AND isset($PIN_CVV) AND isset($EXPDATE)) {
    try {

        $count = 0;

        global $db_pdo,$uid,$aid,$user;

        $sql_statement = "INSERT INTO `modeofpayment`(`TYPE`, `FULLNAME`, `CARDNUMBER`, `PIN_CVV`, `ADDRESSID`, `ACCOUNTID`, `EXPDATE`) VALUES (:type, :fullname, :cardnumber, :pin, :addrid, :aid,:expdate)";

        $insert_statement = $db_pdo->prepare($sql_statement);

        logErrorToConsole("Add New Address Details" . var_export($insert_statement, true) );

        $insert_statement->bindValue(":type", $type, PDO::PARAM_STR);

        $insert_statement->bindValue(":fullname", $FULLNAME, PDO::PARAM_STR);

        $insert_statement->bindValue(":cardnumber", $CARDNUMBER, PDO::PARAM_STR);

        $insert_statement->bindValue(":pin", $PIN_CVV, PDO::PARAM_INT);

        $insert_statement->bindValue(":addrid", $user->getAddressId(), PDO::PARAM_INT);

        $insert_statement->bindValue(":aid", $aid, PDO::PARAM_INT);

        $insert_statement->bindValue(":expdate", $EXPDATE, PDO::PARAM_STR);

        $count = $insert_statement->execute();

        $addressid = $db_pdo -> lastInsertId();

    } catch (Exception $error) {
        logErrorToConsole("update_user_details ERROR -- !!!" . var_export($error, true));
        echo '<p>', $error->getMessage(), '</p>';
        $count = 0;
    }finally{
        redirectToUserDetailPage($count);
    }
} else {
    redirectToUserDetailPage(0);
}

