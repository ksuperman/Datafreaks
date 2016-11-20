<?php

include 'Zebra_Session.php';

function sessionWrapper($dbConnection)
{
    $securityCode = 'sEcUr1tY_c0dE';

    $session = new Zebra_Session($dbConnection, $securityCode);

    if((!checkForActiveSession()) && $_SERVER['PHP_SELF'] != "/datafreak/pages/index.php") {
        // redirectToLoginPage();
    }

    return $session;
}

function checkForActiveSession()
{
    return isset($_SESSION['uid']);
}

function redirectToLoginPage()
{
    header('Location:index.php');
    exit();
}

