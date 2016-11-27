<?php

include "../utilities/global_variables.php";
include("$document_root/utilities/dbConnect.php");
include("$document_root/utilities/errorhandler.php");
set_error_handler('customErrorHandler');
include("$document_root/utilities/session.php");
include("$document_root/utilities/applicationContext.php");

global $db_pdo;

if($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = filter_input(INPUT_POST,"username");
      $password = filter_input(INPUT_POST,"password");
    $query_account = $db_pdo->prepare("SELECT * FROM ACCOUNT WHERE USERID = (SELECT ID FROM USER WHERE USERNAME = :username)");
    $params_account = array(
       "username" => $username
    );

    $query_account->execute($params_account);
    $row = $query_account->fetch(PDO::FETCH_ASSOC);
    $hash_pwd = $row['PASSWORD'];
    echo "PASSWORD in DB is".$hash_pwd;
    $hash = password_verify($password,$hash_pwd);
    echo "Hash is ".$hash;
//   $count = $query_account->rowCount();
//      if($count == 1) {
    if ($hash == 0)
    {
        header("location: login.php?error=Your Login Name or Password is invalid");
      }else {
        sessionWrapper($db_pdo,$_POST['userid']);
        header("location: welcome.php?username=".urlencode($_POST['username']));
      }
   }

function sessionWrapper($dbConnection,$userid)
{
    global $securityCode;

    global $session;

    $session = new Zebra_Session($dbConnection, $securityCode);

    $_SESSION['uid'] = $userid;

}

?>


