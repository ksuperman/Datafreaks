<?php

include_once("$document_root/objects/user_account.php");
include_once("$document_root/objects/account_address.php");
include_once("$document_root/objects/user_payment.php");
include_once("$document_root/objects/user_order.php");
include_once("$document_root/objects/user_shopping_cart.php");
include_once("$document_root/objects/shopping_cart_items.php");

function setShoppingCartItemsContext()
{
    global $user_shopping_cart, $db_pdo, $shopping_cart_items;

    if (!empty($user_shopping_cart)) {

        if (isset($db_pdo)) {
            $db_pdo = getPDOObject();
        }

        $sql_stmt = "SELECT sc.ID AS SHOPPINGCARTITEMID, sc.PRODUCTID as PRODUCTID, sc.CARTID as CARTID, sc.QUANTITY as QUANTITY, p.CATALOGID, p.NAME, p.PRICE, p.DESCRIPTION, p.IMG FROM product_shoppingcart sc, product p WHERE p.ID = sc.PRODUCTID AND  CARTID = :SHOPPINGCARTID";

        $sql = $db_pdo->prepare($sql_stmt);

        $sql->execute(array(':SHOPPINGCARTID' => $user_shopping_cart->getSHOPPINGCARTID()));

        $shopping_cart_items = $sql->fetchAll(PDO::FETCH_CLASS, "shopping_cart_items");
    }
}

function setShoppingCartContext()
{
    global $aid, $db_pdo, $user_shopping_cart;

    if (!empty($aid)) {

        if (isset($db_pdo)) {
            $db_pdo = getPDOObject();
        }

        $sql_stmt = "SELECT ID as 'SHOPPINGCARTID', ACCOUNTID, STATUS FROM shoppingcart WHERE STATUS = 'ACTIVE' AND ACCOUNTID = :aid";

        $sql = $db_pdo->prepare($sql_stmt);

        $sql->execute(array(':aid' => $aid));

        $sql->setFetchMode(PDO::FETCH_CLASS, "user_shopping_cart");

        $user_shopping_cart = $sql->fetch();

        setShoppingCartItemsContext();
    }
}

function setUserOrderHistoryContext()
{
    global $uid, $db_pdo, $user_order;

    if (!empty($uid)) {

        if (isset($db_pdo)) {
            $db_pdo = getPDOObject();
        }

        $sql_stmt = "SELECT ord.ID AS ORDERID, ord.STATUS AS STATUS, ord.ORDERDATE AS ORDERDATE, ord.USERID AS USERID, ord.ADDRESSID AS ADDRESSID, ord.PAYMENTID AS PAYMENTID, addr.UNITNUMBER AS UNITNUMBER, addr.STREETNAME AS STREETNAME, addr.CITY as CITY, addr.STATE AS STATE, addr.COUNTRY as COUNTRY,addr.ZIPCODE AS ZIPCODE,pay.TYPE AS TYPE, pay.FULLNAME as FULLNAME,pay.CARDNUMBER as CARDNUMBER,pay.PIN_CVV as PIN_CVV,pay.ACCOUNTID AS ACCOUNTID,pay.EXPDATE as EXPDATE FROM orders ord, modeofpayment pay, address addr WHERE ord.PAYMENTID = pay.ID AND addr.ID = ord.ADDRESSID AND USERID = :uid";

        $sql = $db_pdo->prepare($sql_stmt);

        $sql->execute(array(':uid' => $uid));

        $user_order = $sql->fetchAll(PDO::FETCH_CLASS, "user_order");
    }
}

function setUserPaymentContext()
{
    global $aid, $db_pdo, $user_payment;

    if (!empty($aid)) {

        if (isset($db_pdo)) {
            $db_pdo = getPDOObject();
        }

        $sql_stmt = "SELECT `ID`, `TYPE`, `FULLNAME`, `CARDNUMBER`, `PIN_CVV`, `ADDRESSID`, `ACCOUNTID`, `EXPDATE` FROM `modeofpayment` WHERE ACCOUNTID = :aid";

        $sql = $db_pdo->prepare($sql_stmt);

        $sql->execute(array(':aid' => $aid));

        $user_payment = $sql->fetchAll(PDO::FETCH_CLASS, "user_payment");
    }
}

function setUserAddressContext()
{
    global $aid, $db_pdo, $user_addr;

    if (!empty($aid)) {

        if (isset($db_pdo)) {
            $db_pdo = getPDOObject();
        }

        $sql_stmt = "SELECT addr.ID, addr.UNITNUMBER, addr.STREETNAME, addr.CITY, addr.STATE, addr.COUNTRY, addr.ZIPCODE FROM address addr, address_account acc_addr where acc_addr.ADDRESSID = addr.ID AND acc_addr.ACCOUNTID = :aid";

        $sql = $db_pdo->prepare($sql_stmt);

        $sql->execute(array(':aid' => $aid));

        $user_addr = $sql->fetchAll(PDO::FETCH_CLASS, "account_address");
    }
}

function setUserAccountContext()
{
    global $uid, $db_pdo, $user, $aid;

    if (checkForActiveSession()) {
        $uid = getSessionUserId();
        logErrorToConsole('setUserAccountContext USER ID FOUND ==> ' . $uid);
    }

    if (isset($db_pdo)) {
        $db_pdo = getPDOObject();
    }

    try {
        if (!empty($uid)) {
            $sql_stmt = "SELECT u.ID as 'UID', u.FIRSTNAME , u.MIDDLENAME, u.LASTNAME, u.USERNAME, u.DOB, a.ID as 'AID',a.EMAIL, a.PASSWORD, a.ADDRESSID FROM user u, account a WHERE a.USERID = u.ID AND u.ID = :uid";
            $sql = $db_pdo->prepare($sql_stmt);
            $sql->execute(array(':uid' => $uid));
            $sql->setFetchMode(PDO::FETCH_CLASS, "user_account");
            $row = $sql->fetch();
            if (isset($row) AND $row) {
                $user = $row;
                if ($row) {
                    $aid = $row->getAccountId();
                }
                setUserAddressContext();
                setUserPaymentContext();
                setUserOrderHistoryContext();
                setShoppingCartContext();
                logErrorToConsole("Finally Setting UserAccountContext DONE !! ");
            } else {
                logErrorToConsole("Invalid User ID");
                redirectToLoginPage();
            }
        }
    } catch (Exception $error) {
        logErrorToConsole("setUserAccountContext ERROR -- !!!" . var_export($error, true));
        echo '<p>', $error->getMessage(), '</p>';
    }

}

setUserAccountContext();
