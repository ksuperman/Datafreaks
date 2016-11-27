<?php
include("$document_root/pages/content_helpers/navbar_top_content_helpers.php");
?>
<style>
    ul.dropdown-menu.dropdown-alerts.in {
        overflow-y: scroll;
        max-height: 600px;
    }
    span.pull-right.text-muted.small {
        position: absolute;
        top: 19px;
        right: -5px;
    }
    .productContainer{
        position: relative;
    }
</style>
<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="home.php">Online Shopping Cart</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-shopping-cart fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-alerts">
                <?php getUserShoppingCartItems() ?>
                <li>
                    <a class="text-center" href="orders.php">
                        <strong>Go To Checkout</strong>
                        <i class="fa fa-truck"></i>
                    </a>
                </li>
            </ul>
            <!-- /.dropdown-alerts -->
        </li>
        <!-- /.dropdown -->
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                </li>
                <li><a href="#"><i class="fa fa-gear fa-fw"></i> User Settings</a>
                </li>
                <li class="divider"></li>
                <li><a href="logout.php"><i
                            class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
            <!-- /.dropdown-user -->
        </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->

    <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                    <div class="input-group custom-search-form">
                        <form action="./search.php" name="yourForm" id="theForm" method="post">
                        <input type="text" id="searchText" name="searchText" class="form-control"  placeholder="Search For Products...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </form>
                    </div>
                    <!-- /input-group -->
                </li>
                <li>
                    <a href="home.php"><i class="fa fa-dashboard fa-fw"></i>My Home</a>
                </li>
                <li>
                    <a href="user_details.php"><i class="fa fa-user fa-fw"></i>User Details</a>
                </li>
            </ul>
        </div>
        <!-- /.sidebar-collapse -->
    </div>
    <!-- /.navbar-static-side -->
</nav>