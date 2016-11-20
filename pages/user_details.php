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
    include("./partials/navbar_top.php");
    ?>

    <div id="page-wrapper">
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
                                <div class="huge">12</div>
                                <div>Orders Placed</div>
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
            <div class="col-lg-4 col-md-6">
                <div class="panel panel-yellow">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-support fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">124</div>
                                <div>Orders Pending Delivery</div>
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
            <div class="col-lg-4 col-md-12">
                <div class="panel panel-red">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fa fa-shopping-cart fa-5x"></i>
                            </div>
                            <div class="col-xs-9 text-right">
                                <div class="huge">13</div>
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
                                            <input type="text" class="form-control" value="Rakshith"
                                                   placeholder="First Name" name="firstname">
                                            <span class="input-group-addon">First Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="Koravadi"
                                                   placeholder="Middle Name" name="middlename">
                                            <span class="input-group-addon">Middle Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="Hatwar"
                                                   placeholder="Last Name" name="lastname">
                                            <span class="input-group-addon">Last Name</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="rakshithk"
                                                   placeholder="Username" name="username">
                                            <span class="input-group-addon">Username</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="password" class="form-control" value="password"
                                                   placeholder="Password" name="password">
                                            <span class="input-group-addon">Password</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="08/13/1988"
                                                   placeholder="Date Of Birth" name="dob">
                                            <span class="input-group-addon">Date Of Birth</span>
                                        </div>
                                        <div class="form-group input-group">
                                            <input type="text" class="form-control" value="rakshithk@live.com"
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
                                        <form role="form" action="index.php" method="post">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <button type="button" class="close" data-dismiss="modal"
                                                            aria-hidden="true">&times;</button>
                                                    <h4 class="modal-title" id="myModalLabel">Update Personal Info</h4>
                                                </div>
                                                <div class="modal-body">
                                                    <fieldset>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="Rakshith"
                                                                   placeholder="First Name" name="firstname">
                                                            <span class="input-group-addon">First Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="Koravadi"
                                                                   placeholder="Middle Name" name="middlename">
                                                            <span class="input-group-addon">Middle Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="Hatwar"
                                                                   placeholder="Last Name" name="lastname">
                                                            <span class="input-group-addon">Last Name</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="rakshithk"
                                                                   placeholder="Username" name="username">
                                                            <span class="input-group-addon">Username</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="password" class="form-control" value="password"
                                                                   placeholder="Password" name="password">
                                                            <span class="input-group-addon">Password</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control" value="08/13/1988"
                                                                   placeholder="Date Of Birth" name="dob">
                                                            <span class="input-group-addon">Date Of Birth</span>
                                                        </div>
                                                        <div class="form-group input-group">
                                                            <input type="text" class="form-control"
                                                                   value="rakshithk@live.com"
                                                                   placeholder="Email" name="email">
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
                                <!-- /.modal -->
                            </div>
                            <!-- Address  -->
                            <div class="tab-pane fade" id="address">
                                <h4>My Address</h4>
                                <div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">Address
                                                    #1</a>
                                            </h4>
                                        </div>
                                        <div id="collapseOne" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>Unit Number</label>
                                                            <p class="form-control-static">Apt 7</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>Street Name</label>
                                                            <p class="form-control-static">Santa Clara Street</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>City</label>
                                                            <p class="form-control-static">San Jose</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>County</label>
                                                            <p class="form-control-static">San Jose</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>State</label>
                                                            <p class="form-control-static">California</p>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                        <div class="form-group">
                                                            <label>Zipcode</label>
                                                            <p class="form-control-static">95112</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">Address
                                                    #2</a>
                                            </h4>
                                        </div>
                                        <div id="collapseTwo" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Unit Number</label>
                                                                <p class="form-control-static">Apt 7</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Street Name</label>
                                                                <p class="form-control-static">Santa Clara Street</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <p class="form-control-static">San Jose</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>County</label>
                                                                <p class="form-control-static">San Jose</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <p class="form-control-static">California</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Zipcode</label>
                                                                <p class="form-control-static">95112</p>
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
                                                <a data-toggle="collapse" data-parent="#accordion"
                                                   href="#collapseThree">Address #3</a>
                                            </h4>
                                        </div>
                                        <div id="collapseThree" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Unit Number</label>
                                                                <p class="form-control-static">Apt 7</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Street Name</label>
                                                                <p class="form-control-static">Santa Clara Street</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>City</label>
                                                                <p class="form-control-static">San Jose</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>County</label>
                                                                <p class="form-control-static">San Jose</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>State</label>
                                                                <p class="form-control-static">California</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Zipcode</label>
                                                                <p class="form-control-static">95112</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Payment  -->
                            <div class="tab-pane fade" id="payment">
                                <h4>My Payment Methods</h4>
                                <div class="panel-group" id="paymentAcc">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a data-toggle="collapse" data-parent="#paymentAcc" href="#payment1">Payment
                                                    Method #1</a>
                                            </h4>
                                        </div>
                                        <div id="payment1" class="panel-collapse collapse in">
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Name On Card</label>
                                                                <p class="form-control-static">Rakshith K Hatwar</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Card Number</label>
                                                                <p class="form-control-static">7298472394293480</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>PIN/CVV</label>
                                                                <p class="form-control-static">3432</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Expire Date</label>
                                                                <p class="form-control-static">12/12/2020</p>
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
                                                <a data-toggle="collapse" data-parent="#paymentAcc" href="#payment2">Payment
                                                    Method #1</a>
                                            </h4>
                                        </div>
                                        <div id="payment2" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Name On Card</label>
                                                                <p class="form-control-static">Rakshith K Hatwar</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Card Number</label>
                                                                <p class="form-control-static">7298472394293480</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>PIN/CVV</label>
                                                                <p class="form-control-static">3432</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Expire Date</label>
                                                                <p class="form-control-static">12/12/2020</p>
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
                                                <a data-toggle="collapse" data-parent="#paymentAcc" href="#payment3">Payment
                                                    Method #1</a>
                                            </h4>
                                        </div>
                                        <div id="payment3" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Name On Card</label>
                                                                <p class="form-control-static">Rakshith K Hatwar</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Card Number</label>
                                                                <p class="form-control-static">7298472394293480</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>PIN/CVV</label>
                                                                <p class="form-control-static">3432</p>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                                            <div class="form-group">
                                                                <label>Expire Date</label>
                                                                <p class="form-control-static">12/12/2020</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Phone  -->
                            <div class="tab-pane fade" id="phone">
                                <h4>My Contact Info</h4>
                                <fieldset disabled>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon">@</span>
                                        <input type="text" class="form-control" placeholder="Email"
                                               value="rakshithk@live.com">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone fa-1x"></i></span>
                                        <input type="text" class="form-control" placeholder="Phone" value="6692478890">
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="fa fa-phone fa-1x"></i></span>
                                        <input type="text" class="form-control" placeholder="Phone" value="6692478891">
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.User Order Details -->
        <div class="row">
            <div class="col-lg-12">
                <!-- Order Details-->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panelHeading"><i class="fa fa-history fa-fw "></i>My Order History</h3>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body scrollable-panel">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h4 class="panelHeading"><i class="fa fa-truck fa-fw "></i>Order #23161873</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Status</label>
                                            <p class="form-control-static">Processing</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Static Control</label>
                                            <p class="form-control-static">email@example.com</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Date</label>
                                            <p class="form-control-static">11/13/2016</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Order Amount</label>
                                            <p class="form-control-static">$ 300</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-6">
                                        <div class="form-group">
                                            <label>Payment Mode</label>
                                            <p class="form-control-static">Credit Card</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-info">
                                    View Order Details
                                </button>
                            </div>
                        </div>
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
