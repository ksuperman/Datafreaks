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
$firstname;
$middlename;
$lastname;

function redirectToUserDetailPage($count)
{
    header("Location:../user_details.php?update=$count");
    exit();
}

if (isset($_REQUEST['firstname'])) {
    $firstname = $_REQUEST['firstname'];
}

if (isset($_REQUEST['middlename'])) {
    $middlename = $_REQUEST['middlename'];
}

if (isset($_REQUEST['lastname'])) {
    $lastname = $_REQUEST['lastname'];
}

if (isset($_REQUEST['password'])) {
    $password = $_REQUEST['password'];
}

if (isset($firstname) OR isset($middlename) OR isset($lastname) OR isset($password)) {
    try {

        $count = 0;

        global $db_pdo,$uid,$aid;

        if (isset($firstname) OR isset($middlename) OR isset($lastname)){
            $sql_statement = "UPDATE user SET";
            $first = true;
            if (isset($firstname)) {
                if (!$first) {
                    $sql_statement = $sql_statement . ',';
                }
                $sql_statement = $sql_statement . " FIRSTNAME = :firstname ";
                $first = false;
            }
            if (isset($middlename)) {
                if (!$first) {
                    $sql_statement = $sql_statement . ',';
                }
                $sql_statement = $sql_statement . " MIDDLENAME = :middlename ";
                $first = false;
            }
            if (isset($lastname)) {
                if (!$first) {
                    $sql_statement = $sql_statement . ',';
                }
                $sql_statement = $sql_statement . " LASTNAME = :lastname ";
                $first = false;
            }

            $sql_statement = $sql_statement . " WHERE ID = :uid";

            $update_statement = $db_pdo->prepare($sql_statement);

            logErrorToConsole("Update User Details" . var_export($update_statement, true) );

            if (isset($firstname)) {
                $update_statement->bindValue(":firstname", $firstname, PDO::PARAM_STR);
            }
            if (isset($middlename)) {
                $update_statement->bindValue(":middlename", $middlename, PDO::PARAM_STR);
            }
            if (isset($lastname)) {
                $update_statement->bindValue(":lastname", $lastname, PDO::PARAM_STR);
            }

            $update_statement->bindValue(":uid", $uid, PDO::PARAM_INT);

            $count = $update_statement->execute();
        }

        if (isset($password)) {

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql_statement = "UPDATE account SET PASSWORD = :password WHERE ID = :aid";

            $update_statement = $db_pdo->prepare($sql_statement);

            $update_statement->bindValue(":password", $hashedPassword, PDO::PARAM_STR);

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

