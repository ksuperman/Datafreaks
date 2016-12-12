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
    include('content_helpers/user_details_helper.php');
    ?>

    <?php
    include("$document_root/pages/partials/header_meta.php");
    ?>

    <title>User Details Page</title>

    <?php
    include("$document_root/pages/partials/header_links.php");
    ?>

</head>

<body>

<style>
    .panelHeading {
        margin: 0;
    }

    .scrollable-panel {
        overflow-y: scroll;
        max-height: 1000px;
    }
    .alert-floating {
        position: absolute;
        top: 62px;
        right: 20px;
        z-index: 10000000;
        width: 70%;
        opacity: 0.9;
    }
</style>

<div id="wrapper">

    <!-- Navigation -->
    <?php
    include("./partials/navbar_top.php");
    ?>

    <div id="page-wrapper">
        <?php displayUserDetailsUpdateStatus() ?>
        <!--Heading -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Order Details</h1>
            </div>
            <!-- /.col-lg-12 -->
        </div>
        <!-- /.User Quick Status -->
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-tasks fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php getCountOfPlacedOrder()?></div>
                                <div>Orders Placed</div>
                            </div>
                        </div>
                    </div>
                    <a href="#OrderDetailsLink">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php getCountOfPendingOrder()?></div>
                                <div>Orders Pending Delivery</div>
                            </div>
                        </div>
                    </div>
                    <a href="#OrderDetailsLink">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 col-md-12">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge"><?php getItemCountInShoppingCart() ?></div>
                                <div>Items in Your Shopping Cart</div>
                            </div>
                        </div>
                    </div>
                    <a href="#">
                        <div class="panel-footer">
                            <span class="pull-left">View Details</span>
                            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                            <div class="clearfix"></div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <!-- /.User Order Details -->
        <div class="row" id="OrderDetailsLink">
            <div class="col-lg-12">
                <!-- Order Details-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panelHeading"><span class="glyphicon glyphicon-dashboard"></span>My Order History</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body scrollable-panel">
                        <?php createUserOrdersBlock() ?>
                    </div>
                    <!-- /.panel-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php
include("./partials/footer_js.php");
?>
</body>
</html>
