<?php

include 'Zebra_Session.php';

$session;

$securityCode = 'sEcUr1tY_c0dE';

function sessionWrapper($dbConnection)
{
    global $securityCode;

    global $session;

    $session = new Zebra_Session($dbConnection, $securityCode);

    $_SESSION['uid'] = 103; // Remove this

    if ((!checkForActiveSession()) && $_SERVER['PHP_SELF'] != "/datafreak/pages/index.php") {
        redirectToLoginPage();
    }

    return $session;
}

function checkForActiveSession()
{
    return isset($_SESSION['uid']);
}

function checkForUserSessionObject()
{
    return isset($_SESSION['user']);
}

function redirectToLoginPage()
{
    global $session;
    if ($_SERVER['PHP_SELF'] != "/datafreak/pages/index.php") {
        session_unset();
        $session->stop();
        header('Location:index.php');
        exit();
    }
}

function getSessionUserId()
{
    if (checkForActiveSession()) {
        $uid = $_SESSION['uid'];
    }
    return $uid;
}

function getSessionUserObject()
{
    if (checkForUserSessionObject()) {
        $user = $_SESSION['user'];
    }
    return $user;
}

function setSessionAttribute($attributeName, $attributeValue)
{
    if (isset($attributeName, $attributeValue)) {
        $_SESSION[$attributeName] = $attributeValue;
    }
}

// Setup Session On Include
sessionWrapper($db);
