<!DOCTYPE html>
<html lang="en">

<head>

    <?php
    include "../utilities/global_variables.php"
    ?>

    <?php
    include("../utilities/dbConnect.php");
    ?>

    <?php
    include("../utilities/errorhandler.php");
    set_error_handler('customErrorHandler');
    ?>

    <?php
    include("../utilities/session.php");
    ?>

    <?php
    include("../utilities/applicationContext.php");
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
                        <h1 class="page-header">Order Confirmation</h1>

                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->

                <div class="row">
                    <div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panelHeading">
                                                <i class="fa fa-shopping-bag fa-fw "></i>Products Ordered 
                                            </h3>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php include '../utilities/OrderSummary.php'; ?>
                                            <?php include '../utilities/Address.php'; ?>
                                            <?php include '../utilities/Payment.php'; ?>
                                            <?php include 'content_helpers/order_confirmation_helper.php'; ?>
                                            <?php
                                                $orderid = $_GET["orderid"];                                               
                                                $value = "";
                                                try {
                                                    $dbh = getPDOObject();

                                                    $sql_stmt = "SELECT ol.productid,p.name,ol.unitprice as price, ol.quantity,ol.unitprice*ol.quantity as total FROM orderlineitems ol,product p WHERE ol.orderid = ".$orderid . " AND ol.productid = p.id;";

                                                    $sql_stmt_orderTotal = "SELECT sum(ol.unitprice*ol.quantity) as total FROM orderlineitems ol WHERE ol.orderid = ". $orderid . ";";

                                                    } 
                                                catch ( Exception $error ) {
                                                        echo '<p>', $error->getMessage (), '</p>';
                                                }
                                                $sql = $dbh->prepare ( $sql_stmt );
                                                $sql2 = $dbh->prepare ( $sql_stmt_orderTotal );
                                                if ($sql->execute ()) {
                                                    $sql->setFetchMode ( PDO::FETCH_CLASS, "OrderSummary" );
                                                }
                                                $sql2->execute ();
                                                $row = $sql2->fetch ();
                                            ?>
                                            <div class="alert alert-success" role="alert"><h3>Order# 
                                                <?php
                                                    echo $orderid;
                                                ?>   
                                            </div>
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
                                                            while ( $orderSummary = $sql->fetch () ) {
                                                            createOrderSummary ( $orderSummary );
                                                            }
                                                            ?>                                                                             
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="alert alert-info" role="alert"><h3>Order Total: 
                                                <?php
                                                    echo $row ['total'];
                                                ?>   <i class="fa fa-usd fa-fw "></i></h3>
                                            </div>
                                        </div>
                                        <!--panel body -->
                                    </div>
                                    <!--panel default-->
                                </div>
                                <!-- col-lg-12 -->
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
		                                                <i class="fa fa-home fa-fw "></i>Address 
		                                            </h3>
		                                        </div>
		                                        <!-- /.panel-heading -->
		                                        <div class="panel-body">
		                                            <div class="panel-group" id="accordion">
		                                            <?php
		                                      
		                                                try {
		                                                 
		                                                    $sql_stmt_addr = "select address.id, address.unitnumber,address.streetname,address.city,address.state,address.country,address.zipcode from address, orders where orders.id = " .$orderid." and orders.addressid = address.id;";
		                                                   // echo $sql_stmt;


		                                                    $sql_stmt_pmt = "select modeofpayment.id, modeofpayment.type,modeofpayment.fullname, modeofpayment.cardnumber, modeofpayment.pin_cvv,modeofpayment.expdate  from modeofpayment, orders where orders.id = " .$orderid." and orders.paymentid = modeofpayment.id;";
		                                                    
		                                                   //  echo $sql_stmt_orderTotal;
		                                                } 
		                                                catch ( Exception $error ) {
		                                                        echo '<p>', $error->getMessage (), '</p>';
		                                                }
		                                                $sql = $dbh->prepare ( $sql_stmt_addr );                                
		                                                if ($sql->execute ()) {
		                                                    $sql->setFetchMode ( PDO::FETCH_CLASS, "Address" );
		                                                }

		                                                $i=1;
		                                                while ( $addr = $sql->fetch () ) {
		                                                    addressPrinting( $addr ,$i++);
		                                                }
		                                            ?>  
		                                       		</div>	                                        
		                                        
		                                        </div>
		                                        <!--panel body -->
		                                    </div>
		                                    <!--panel default-->
		                                </div>
		                                <!-- col-lg-12 -->
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
		                                                <i class="fa fa-home fa-fw "></i>Payment Method 
		                                            </h3>
		                                        </div>
		                                        <!-- /.panel-heading -->
		                                        <div class="panel-body">
		                                            <div class="panel-group" id="accordion">
		                                            <?php

		                                                $sql = $dbh->prepare ( $sql_stmt_pmt );                                
		                                                if ($sql->execute ()) {
		                                                    $sql->setFetchMode ( PDO::FETCH_CLASS, "Payment" );
		                                                }

		                                                $i=1;
		                                                while ( $pmt = $sql->fetch () ) {
		                                                    paymentPrinting( $pmt ,$i++);
		                                                }
		                                            ?>  
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
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
    <?php
        include("./partials/footer_js.php");
    ?>
</body>

</html>
