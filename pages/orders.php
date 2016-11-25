<!DOCTYPE html>
<html lang="en">

<head>
    <?php
    include("../utilities/dbConnect.php");
    ?>

    <?php
    include("../utilities/errorhandler.php");
    ?>

    <?php
    include("../utilities/session.php");
    ?>

    <?php
    sessionWrapper($db);
    $_SESSION["test"] = "test"; // This Value is Persisted in the Session on MYSQL Database
    logErrorToConsole(var_export($_SESSION, true)); // This is printed in the file on path /XAMPP/logs/php_error_log
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
            include ("./partials/navbar_top.php");
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
                    <div class="col-lg-4 col-md-6">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panelHeading">
                                                <i class="fa fa-user fa-fw "></i>Order Details
                                            </h3>
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <?php include '../utilities/OrderSummary.php'; ?>
                                            <?php include '../utilities/Address.php'; ?>
                                            <?php include '../utilities/Payment.php'; ?>
                                            <?php include '../helpers/tablehelpers.php'; ?>
                                            <?php
                                                $servername = "localhost";
                                                $username = "datafreaks";
                                                $password = "sesame";
                                                $dbname = "datafreaks_prod";
                                                $value = "";
                                                try {
                                                    $dbh = new PDO ( "mysql:host=$servername;dbname=$dbname", $username, $password );
                                                    $sql_stmt = "SELECT cart.productid,p.name,p.price,cart.quantity,p.price*cart.quantity as total FROM product_shoppingcart cart,product p WHERE cart.cartid = 7773 AND cart.productid = p.id;";
                                                    $sql_stmt_orderTotal = "SELECT sum(p.price*cart.quantity) as total FROM product_shoppingcart cart,product p WHERE cart.cartid = 7773 AND cart.productid = p.id;";
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
                                            <div class="alert alert-info" role="alert">Order Total: 
                                                <?php
                                                    echo $row ['total'];
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
                                                $sql_stmt_address = "SELECT address.id, address.unitnumber,address.streetname,address.city,address.state,address.country,address.zipcode from address, address_account WHERE address.id = address_account.addressid AND accountid = 7773; limit 1";
                                                $sql = $dbh->prepare ( $sql_stmt_address );
                                                if ($sql->execute ()) {
                                                    $sql->setFetchMode ( PDO::FETCH_CLASS, "Address" );
                                                }                          
                                            ?>

                                            <?php
                                                $i=1;
                                                while ( $addr = $sql->fetch () ) {
                                                    addressP( $addr ,$i++);
                                                }
                                            ?>  
                                        </div>
                                    </div>

                                    <!--Payment-->
                                     <div class="tab-pane fade " id="payment">
                                        <h4>My Payment</h4>
                                        <div class="panel-group" id="paymentAcc">
                                       
                                            <?php
                                                $sql_stmt_pmt = "SELECT type,fullname,cardnumber,pin_cvv,expdate from modeofpayment WHERE accountid = 7773;limit 1";
                                                $sql = $dbh->prepare ( $sql_stmt_pmt );
                                                if ($sql->execute ()) {
                                                    $sql->setFetchMode ( PDO::FETCH_CLASS, "Payment" );
                                                }                          
                                            ?>

                                            <?php
                                                $i=1;
                                                while ( $pmt = $sql->fetch () ) {
                                                    paymentPrint( $pmt,$i++);
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
            </div>
        <!-- container fluid -->
        </div>
        <!-- Page Wrapper -->
   </div>
   <!-- Wrapper -->
   <?php
        include ("./partials/footer_js.php");
     ?>
</body>
</html>
