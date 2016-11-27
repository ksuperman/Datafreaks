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
        height: 300px;
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
                <h1 class="page-header">User Details</h1>
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
        <!-- /.User Personal Details -->
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panelHeading"><i class="fa fa-user fa-fw "></i>My Details</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#personalInfo" data-toggle="tab"><i
                                        class="fa  fa-user fa-fw "></i>Personal Info</a>
                            </li>
                            <li><a href="#address" data-toggle="tab"><i class="fa  fa-home fa-fw "></i>My Address</a>
                            </li>
                            <li><a href="#payment" data-toggle="tab"><i class="fa fa-credit-card fa-fw "></i>My Payment
                                    Method</a>
                            </li>
                            <li><a href="#phone" data-toggle="tab"><i class="fa  fa-phone fa-fw "></i>My Contact
                                    Info</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <!-- Personal info -->
                            <div class="tab-pane fade in active" id="personalInfo">
                                <h4>My Personal Info</h4>
                                <form role="form">
                                    <fieldset disabled>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getFirstName()?>"
                                                   placeholder="First Name" name="firstname">
                                            <span class="input-group-addon">First Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getMiddleName()?>"
                                                   placeholder="Middle Name" name="middlename">
                                            <span class="input-group-addon">Middle Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getLastName()?>"
                                                   placeholder="Last Name" name="lastname">
                                            <span class="input-group-addon">Last Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getUserName()?>"
                                                   placeholder="Username" name="username">
                                            <span class="input-group-addon">Username</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="password" class="form-control" value="<?php echo $user->getPassword()?>"
                                                   placeholder="Password" name="password">
                                            <span class="input-group-addon">Password</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getDOB()?>"
                                                   placeholder="Date Of Birth" name="dob">
                                            <span class="input-group-addon">Date Of Birth</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="<?php echo $user->getEmail()?>"
                                                   placeholder="Email" name="email">
                                            <span class="input-group-addon">Email</span>
                                        </div>
                                    </fieldset>
                                </form>
                                <button class="btn btn-primary" data-toggle="modal" data-target="#userPersonalDetails">
                                    Update Personal Info
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="userPersonalDetails" tabindex="-1" role="dialog"
                                     aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <form role="form" action="./content_helpers/update_user_details.php" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Update Personal Info</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <fieldset>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getFirstName()?>"
                                                                   placeholder="First Name" name="firstname">
                                                            <span class="input-group-addon">First Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getMiddleName()?>"
                                                                   placeholder="Middle Name" name="middlename">
                                                            <span class="input-group-addon">Middle Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getLastName()?>"
                                                                   placeholder="Last Name" name="lastname">
                                                            <span class="input-group-addon">Last Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getUserName()?>"
                                                                   placeholder="Username" name="username" disabled>
                                                            <span class="input-group-addon">Username</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="password" class="form-control" value="<?php echo $user->getPassword()?>"
                                                                   placeholder="Password" name="password">
                                                            <span class="input-group-addon">Password</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getDOB()?>"
                                                                   placeholder="Date Of Birth" name="dob" disabled>
                                                            <span class="input-group-addon">Date Of Birth</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="<?php echo $user->getEmail()?>"
                                                                   placeholder="Email" name="email" disabled>
                                                            <span class="input-group-addon">Email</span>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                                        Close
                                                    </button>
                                                    <button type="submit" class="btn btn-primary">Update Changes
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.modal-content -->
                                        </form>
                                    </div>
                                    <!-- /.modal-dialog -->
                                </div>
                            </div>
                            <!-- Address  -->
                            <div class="tab-pane fade" id="address">
                                <h4>My Address</h4>
                                <div class="panel-group" id="address_accordion">
                                    <?php createUserAddressBlock() ?>
                                </div>
                            </div>
                            <!-- Payment  -->
                            <div class="tab-pane fade" id="payment">
                                <h4>My Payment Methods</h4>
                                <div class="panel-group" id="paymentAcc">
                                    <?php createUserPaymentBlock() ?>
                                </div>
                            </div>
                            <!-- Phone  -->
                            <div class="tab-pane fade" id="phone">
                                <h4>My Contact Info</h4>
                                <fieldset disabled>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Email"
                                               value="<?php echo $user->getEmail()?>">
                                    </div>
                                    <?php createUserPhoneNumberBlock() ?>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.User Order Details -->
        <div class="row" id="OrderDetailsLink">
            <div class="col-lg-12">
                <!-- Order Details-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panelHeading"><i class="fa fa-history fa-fw "></i>My Order History</h3>
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
