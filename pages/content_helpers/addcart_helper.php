<?php
/**
 * Created by PhpStorm.
 * User: lazylad91
 * Date: 11/26/16
 * Time: 5:10 AM
 */

include "../../utilities/global_variables.php";
include("$document_root/utilities/dbConnect.php");
include("$document_root/utilities/errorhandler.php");
set_error_handler('customErrorHandler');
include("$document_root/utilities/session.php");
include("$document_root/utilities/applicationContext.php");


if (isset($_POST['action'])) {
    echo '<br />The ' . $_POST['submit'] . ' submit button was pressed<br />';
    $productId=$_POST['submit'];
    global $uid;
    addToCart($uid,$productId);
}

function addToCart($uid,$productId){
    $cartId = getActiveCartId();
    if(!isset($cartId)){
        $cartId = insertIntoShoppingCart();
        echo "<p> this is newly insterted - $cartId</p>";
    }
    insertIntoProductShoppingCart($cartId,$productId);
}
function insertIntoShoppingCart(){
    global $db_pdo;
    global $aid;
    $query_cartId = $db_pdo->prepare("insert into shoppingcart(accountid,status) values(:accountId,'active') ");
    $params_cartId = array(
        "accountId" => $aid
    );
    $data = $query_cartId->execute($params_cartId);
    $insert_cartId = $db_pdo->lastInsertId();
    return $insert_cartId;
}

function insertIntoProductShoppingCart($cartId,$productId){
    global $db_pdo;
    global $aid;
    $query_insert = $db_pdo->prepare("insert into product_shoppingcart(productid,cartid,quantity) values(:productid,:cartid,1) ");
    $params_cartId = array(
        "productid" => $productId,
        "cartid" => $cartId
    );
    $data = $query_insert->execute($params_cartId);
    $insert_cartId = $db_pdo->lastInsertId();
    echo "<p> this is newly inserted line item - $insert_cartId</p>";
}

function getActiveCartId(){
    global $db_pdo;
    global $aid;
    $sql_statement = "select id from shoppingcart where status='ACTIVE' and accountid=:aid;";
    $sql = $db_pdo->prepare($sql_statement);
    $sql->execute(array(':aid' => $aid));
    $row = $sql->fetch(PDO::FETCH_ASSOC);
    $cartId = $row["id"];
    echo "<p> this is $cartId </p>";
    return $cartId;
}