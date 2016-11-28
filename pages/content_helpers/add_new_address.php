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

if (isset($_REQUEST['unitnumber'])) {
    $unitnumber = $_REQUEST['unitnumber'];
}

if (isset($_REQUEST['streetname'])) {
    $streetname = $_REQUEST['streetname'];
}

if (isset($_REQUEST['city'])) {
    $city = $_REQUEST['city'];
}

if (isset($_REQUEST['county'])) {
    $county = $_REQUEST['county'];
}

if (isset($_REQUEST['state'])) {
    $state = $_REQUEST['state'];
}

if (isset($_REQUEST['zipcode'])) {
    $zipcode = $_REQUEST['zipcode'];
}

logErrorToConsole("Add New Address Details" . var_export($zipcode.$unitnumber.$streetname.$city.$county.$state, true) );

if (isset($unitnumber) AND isset($streetname) AND isset($city) AND isset($county) AND isset($state) AND isset($zipcode)) {
    try {

        $count = 0;

        global $db_pdo,$uid,$aid;

        $sql_statement = "INSERT INTO `address`(`UNITNUMBER`, `STREETNAME`, `CITY`, `STATE`, `COUNTRY`, `ZIPCODE`) VALUES (:unitnumber, :streetname, :city, :county, :state, :zipcode)";

        $insert_statement = $db_pdo->prepare($sql_statement);

        $insert_statement->bindValue(":unitnumber", $unitnumber, PDO::PARAM_INT);

        $insert_statement->bindValue(":streetname", $streetname, PDO::PARAM_STR);

        $insert_statement->bindValue(":city", $city, PDO::PARAM_STR);

        $insert_statement->bindValue(":county", $county, PDO::PARAM_STR);

        $insert_statement->bindValue(":state", $state, PDO::PARAM_STR);

        $insert_statement->bindValue(":zipcode", $zipcode, PDO::PARAM_STR);

        $count = $insert_statement->execute();

        $addressid = $db_pdo -> lastInsertId();

        if (isset($addressid)) {

            $sql_statement = "INSERT INTO `address_account` (`ACCOUNTID`, `ADDRESSID`) VALUES( :aid, :addressid)";

            $update_statement = $db_pdo->prepare($sql_statement);

            $update_statement->bindValue(":addressid", $addressid, PDO::PARAM_STR);

            $update_statement->bindValue(":aid", $aid, PDO::PARAM_INT);

            $acc_count = $update_statement->execute();

            $count = $count + $acc_count;

        }
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

