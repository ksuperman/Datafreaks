<?php

define('DB_SERVER', 'localhost:3306');
define('DB_USERNAME', 'datafreaks');
define('DB_PASSWORD', 'sesame');
define('DB_DATABASE', 'datafreaks_prod');

global $db_pdo, $db;

// Creating a Shared Database Connection
$db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

// Creating a Shared Database PDO Object
$db_pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
$db_pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Function to get New PDO Object for Making Queries
function getPDOObject()
{
    $pdoObject = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_DATABASE, DB_USERNAME, DB_PASSWORD);
    $pdoObject->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdoObject;
}

// Function to Execute Query and Return Single Result
function queryForSingleRow($sql_stmt, $params)
{
    $db_pdo = getPDOObject();
    $sql = $db_pdo->prepare($sql_stmt);
    $sql->execute($params);
    $sql->setFetchMode(PDO::FETCH_ASSOC);
    $row = $sql->fetch();
    $sql = null;
    $db_pdo = null;
    return $row;
}

// Function to Execute Query and Return Results Array
function queryForMultipleRows($sql_stmt, $params)
{
    $db_pdo = getPDOObject();
    $sql = $db_pdo->prepare($sql_stmt);
    $sql->execute($params);
    $result_set = $sql->fetchALL(PDO::FETCH_ASSOC);
    $sql = null;
    $db_pdo = null;
    return $result_set;
}

?>