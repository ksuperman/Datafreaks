<?php


include("../utilities/global_variables.php");

include("$document_root/utilities/dbConnect.php");

include("$document_root/utilities/errorhandler.php");
set_error_handler('customErrorHandler');

include("$document_root/utilities/session.php");

include("$document_root/utilities/applicationContext.php");

header("Content-Type: application/json;charset=utf-8");

if (isset($_POST["addrId"]) && isset($_POST["pmtId"])) {

    $addrId = $_POST['addrId'];
    $pmtId = $_POST['pmtId'];
    $userId = $_SESSION['uid'];

    $quantity;
    $productid;
    $unitprice;

    $db_pdo = getPDOObject();

    $query_order = $db_pdo->prepare("INSERT INTO orders (STATUS, USERID, ADDRESSID, PAYMENTID) VALUES (:status, :userid, :addressid, :paymentid)");
    $params_order = array(
        "status" => 'Pending',
        "userid" => $userId,
        "addressid" => $addrId,
        "paymentid" => $pmtId
    );
    $data = $query_order->execute($params_order);
    $insert_orderid = $db_pdo->lastInsertId();
    $cartId = getActiveCartId();

    //insert query for orderlineitems
    $query_orderlineitems_insert = $db_pdo->prepare("INSERT INTO orderlineitems (QUANTITY, PRODUCTID, ORDERID, UNITPRICE)
		    VALUES (:quantity, :productid, :orderid, :unitprice)");

    //fetch all rows from cart
    $sql_statement = "SELECT CART.PRODUCTID, CART.QUANTITY, PROD.PRICE FROM product_shoppingcart CART, product PROD WHERE CART.PRODUCTID = PROD.ID AND CART.CARTID = :cartId";
    $params_cart = array('cartId' => $cartId);
    $results = queryForMultipleRows($sql_statement, $params_cart);

    //add to orderlineitems one by one from shopping cart
    foreach ($results as $row) {
        $quantity = $row['QUANTITY'];
        $productid = $row['PRODUCTID'];
        $unitprice = $row['PRICE'];

        //echo $quantity . $productid . $unitprice;
        $params_orderlineitems = array(
            "quantity" => $quantity,
            "productid" => $productid,
            "orderid" => $insert_orderid,
            "unitprice" => $unitprice
        );
        $data = $query_orderlineitems_insert->execute($params_orderlineitems);
    }

    $sql_statement = "SELECT id FROM shoppingcart WHERE STATUS = 'ACTIVE' AND accountid = :aid";
    $params = array(':aid' => $aid);


    $sql_statement_update = $db_pdo->prepare("UPDATE shoppingcart SET STATUS = 'ORDERED' WHERE ID = :cartId");
    $params_cart = array('cartId' => $cartId);
    $data = $sql_statement_update->execute($params_cart);

    //$json = {"orderid": $insert_orderid};
    $json = array(
        'orderid' => $insert_orderid,
        'cartid' => $cartId
    );

    echo json_encode($json);
}


function getActiveCartId()
{
    global $aid;
    $sql_statement = "SELECT id FROM shoppingcart WHERE STATUS = 'ACTIVE' AND accountid = :aid";
    $params = array(':aid' => $aid);
    $cartId = queryForSingleRow($sql_statement, $params);
    return $cartId['id'];
}

?>