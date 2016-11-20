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
        logErrorToConsole(var_export($_SESSION, true));
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
                        <h1 class="page-header">Blank</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
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
