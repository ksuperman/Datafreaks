<?php

include "../utilities/global_variables.php";
include("$document_root/utilities/dbConnect.php");
include("$document_root/utilities/errorhandler.php");
include "$document_root/utilities/Zebra_Session.php";
set_error_handler('customErrorHandler');

global $db_pdo;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = filter_input(INPUT_POST, "username");
    $password = filter_input(INPUT_POST, "password");
    $query_account = $db_pdo->prepare("SELECT * FROM ACCOUNT WHERE USERID = (SELECT ID FROM USER WHERE USERNAME = :username)");
    $params_account = array(
        "username" => $username
    );

    $query_account->execute($params_account);
    $row = $query_account->fetch(PDO::FETCH_ASSOC);
    $hash_pwd = $row['PASSWORD'];
    echo "PASSWORD in DB is" . $hash_pwd;
    $hash = password_verify($password, $hash_pwd);
    echo "Hash is " . $hash;
    if ($hash == 0) {
        header("location: index.php?error=Your Login Name or Password is invalid");
        die();
    } else {
        sessionWrapperLogin($db, $row['USERID']);
        header("location: home.php");
        die();
    }
}

function sessionWrapperLogin($dbConnection, $userid)
{
    global $securityCode;

    global $session;

    $session = new Zebra_Session($dbConnection, $securityCode);

    $_SESSION['uid'] = $userid;
}

?>


