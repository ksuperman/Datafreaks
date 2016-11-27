<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../utilities/global_variables.php");
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
    include("./partials/header_meta.php");
    ?>

    <title>Online Shopping Cart</title>

    <?php
    include("./partials/header_links.php");
    ?>

</head>

<body>
<script>
    var addr_id;
    var pmt_id;

    function populateOrder(index) {
        addr_id = document.getElementById('addrId' + index).innerHTML;
        var address = document.getElementById('addrId' + index).innerHTML + " ";
        address += document.getElementById('addrUnit' + index).innerHTML + " ";
        address += document.getElementById('addrStreet' + index).innerHTML + " ";
        address += document.getElementById('addrCity' + index).innerHTML + " ";
        address += document.getElementById('addrCountry' + index).innerHTML + " ";
        address += document.getElementById('addrZip' + index).innerHTML + " ";
        document.getElementById('finalOrderAddress').innerHTML = address;
    }

    function populatePayment(index) {

        var pmt = 1;
        if (index === 1) {
            pmt = "Cash Payment";
            pmt_id = 1;
        } else if (index === 2) {
            pmt = "Reward Point Payment";
            pmt_id = 2;
        }
        else {
            pmt_id = document.getElementById('pmtId' + index).innerHTML;
            pmt = document.getElementById('pmtId' + index).innerHTML + " ";
            pmt += document.getElementById('pmtType' + index).innerHTML + " ";
            pmt += document.getElementById('pmtFullName' + index).innerHTML + " ";
            pmt += document.getElementById('pmtCardNumber' + index).innerHTML + " ";
            pmt += document.getElementById('pmtPIN' + index).innerHTML + " ";
            pmt += document.getElementById('pmtExpDate' + index).innerHTML + " ";
        }
        document.getElementById('finalOrderPayment').innerHTML = pmt;
    }

    function placeOrder() {

        if (addr_id == null || pmt_id == null) {
            alert("Please select address and payment id");
        } else {
            var http = new XMLHttpRequest();
            var url = "orderSubmission.php";
            var params = "addrId=" + addr_id + "&pmtId=" + pmt_id;
            http.open("POST", url, true);

            //Send the proper header information along with the request
            http.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

            http.onreadystatechange = function () {//Call a function when the state changes.
                if (http.readyState == 4 && http.status == 200) {
                    var json = http.responseText;
                    var obj = JSON.parse(json);
                    console.log(obj);
                    console.log(obj.orderid);
                    console.log(obj['orderid']);

                    var message = "Your order has been placed! You Order ID is : " + obj['orderid'];
                    alert(message);

                    if (name != undefined && name != null) {
                        window.location = '/datafreak/pages/orderConfirmation.php?orderid=' + obj['orderid'];
                    }
                }
            }
            http.send(params);
        }
    }
</script>
<style>
    .panelHeading {
        margin: 0;
    }

    .scrollable-panel {
        overflow-y: scroll;
        height: 300px;
    }
</style>
<div id="wrapper">
    <!-- Navigation -->
    <?php
    include("./partials/navbar_top.php");
    ?>
    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Order Summary</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- row -->
            <div class="row">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panelHeading">
                                            <i class="fa fa-shopping-bag fa-fw "></i>Shopping Cart
                                        </h3>
                                    </div>
                                    <!-- /.panel-heading -->
                                    <div class="panel-body">
                                        <?php include '../utilities/OrderSummary.php'; ?>
                                        <?php include '../utilities/Address.php'; ?>
                                        <?php include '../utilities/Payment.php'; ?>
                                        <?php include '../helpers/tablehelpers.php'; ?>
                                        <?php
                                        $value = "";
                                        try {
                                            $dbh = getPDOObject();

                                            $cartId = getActiveCartId();

                                            $sql_stmt = "SELECT cart.productid,p.name,p.price,cart.quantity,p.price*cart.quantity as total FROM product_shoppingcart cart,product p WHERE cart.cartid = " . $cartId . " AND cart.productid = p.id;";

                                            $sql_stmt_orderTotal = "SELECT sum(p.price*cart.quantity) as total FROM product_shoppingcart cart,product p WHERE cart.cartid = " . $cartId . " AND cart.productid = p.id;";
                                        } catch (Exception $error) {
                                            echo '<p>', $error->getMessage(), '</p>';
                                        }

                                        $sql = $dbh->prepare($sql_stmt);

                                        $sql2 = $dbh->prepare($sql_stmt_orderTotal);

                                        if ($sql->execute()) {
                                            $sql->setFetchMode(PDO::FETCH_CLASS, "OrderSummary");
                                        }
                                        $sql2->execute();
                                        $row = $sql2->fetch();
                                        ?>
                                        <div class="table-responsive">
                                            <table id="mytable"
                                                   class="table table-bordred table-striped">
                                                <thead>
                                                <th>Id</th>
                                                <th>Name</th>
                                                <th>Price</th>
                                                <th>Quantity</th>
                                                <th>Total</th>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <?php
                                                    while ($orderSummary = $sql->fetch()) {
                                                        createOrderSummary($orderSummary);
                                                    }
                                                    ?>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="alert alert-info" role="alert"><h3>Order Total:
                                                <?php
                                                echo $row ['total'];
                                                ?> <i class="fa fa-usd fa-fw "></i></h3>
                                        </div>
                                    </div>
                                    <!--panel body -->
                                </div>
                                <!--panel default-->
                            </div>
                            <!-- col-lg-12 -->
                        </div>
                        <!-- row -->

                    </div>
                    <!-- /.container-fluid -->
                </div>
                <!-- col-lg-4 col-md-6 -->

            </div>
            <!-- row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panelHeading">
                                <i class="fa fa-user fa-fw "></i>My Details
                            </h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs">

                                <li class="active"><a href="#address" data-toggle="tab"><i
                                            class="fa  fa-home fa-fw "></i>My Address</a></li>
                                <li><a href="#payment" data-toggle="tab"><i
                                            class="fa fa-credit-card fa-fw "></i>My Payment Method</a></li>

                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <!-- Address  -->
                                <div class="tab-pane fade in active" id="address">
                                    <h4>My Address</h4>
                                    <div class="panel-group" id="accordion">

                                        <?php
                                        global $aid;
                                        $sql_stmt_address = "SELECT address.id, address.unitnumber,address.streetname,address.city,address.state,address.country,address.zipcode from address, address_account WHERE address.id = address_account.addressid AND accountid = " . $aid . "; limit 1";
                                        $sql = $dbh->prepare($sql_stmt_address);
                                        if ($sql->execute()) {
                                            $sql->setFetchMode(PDO::FETCH_CLASS, "Address");
                                        }
                                        ?>

                                        <?php
                                        $i = 1;
                                        while ($addr = $sql->fetch()) {
                                            addressP($addr, $i++);
                                        }
                                        ?>
                                    </div>
                                </div>

                                <!--Payment-->
                                <div class="tab-pane fade " id="payment">
                                    <h4>My Payment</h4>
                                    <div class="panel-group" id="paymentAcc">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#paymentAcc"
                                                       href="#payment1">Payment
                                                        Method #1</a>
                                                </h4>
                                            </div>
                                            <div id="payment1" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="form-group">

                                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                                                        <h4>Pay by Cash</h4>
                                                                        <span class="input-group-btn">
                                                                    <button class="btn btn-success" name="submit"
                                                                            onclick="populatePayment(1)" type="button"
                                                                            id="button1" value="val">Use this Payment Mode</button>
                                                                    </span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a data-toggle="collapse" data-parent="#paymentAcc"
                                                       href="#payment2">Payment
                                                        Method #2</a>
                                                </h4>
                                            </div>
                                            <div id="payment2" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                                <div class="form-group">
                                                                    <div class="col-lg-8 col-md-6 col-sm-6 col-xs-6">
                                                                        <h4>Use Reward Points</h4>
                                                                        <span class="input-group-btn">
                                                                    <button class="btn btn-success" name="submit"
                                                                            onclick="populatePayment(2)" type="button"
                                                                            id="button1" value="val">Use this Payment Mode</button>
                                                                    </span>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                        $sql_stmt_pmt = "SELECT id,type,fullname,cardnumber,pin_cvv,expdate from modeofpayment WHERE accountid = 7773;limit 1";
                                        $sql = $dbh->prepare($sql_stmt_pmt);
                                        if ($sql->execute()) {
                                            $sql->setFetchMode(PDO::FETCH_CLASS, "Payment");
                                        }
                                        ?>

                                        <?php
                                        $i = 3;
                                        while ($pmt = $sql->fetch()) {
                                            paymentPrint($pmt, $i++);
                                        }
                                        ?>

                                    </div>
                                </div>


                            </div>
                        </div>
                        <!-- /.panel-body-->
                    </div>
                    <!-- /#panel panel-default -->
                </div>
            </div>
            <!-- row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panelHeading">
                                <i class="fa fa-user fa-fw "></i>Final Order Details
                            </h3>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="alert alert-success" role="alert">
                                <h4><i class="fa  fa-home fa-fw "></i>
                                    Address Selected: </h4>
                                <h4 id="finalOrderAddress"></h4>
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <h4><i class="fa  fa-dollar fa-fw "></i>
                                    Payment Method Selected: </h4>
                                <h4 id="finalOrderPayment"></h4>
                            </div>

                            <span class="input-group-btn">
                                    <button class="btn btn-primary  btn-lg " onclick="placeOrder()">Place Order</button>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container fluid -->
    </div>
    <!-- Page Wrapper -->
</div>
<!-- Wrapper -->
<?php
include("./partials/footer_js.php");
?>
</body>
</html>
