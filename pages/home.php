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
    include("./content_helpers/home_helper.php");
    ?>

    <?php
    include("./partials/header_meta.php");
    ?>

    <title>Product Page</title>

    <?php
    include("./partials/header_links.php");
    ?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../dist/css/Home.css" type="text/css">
    <script type="text/javascript" src="../dist/js/Home.js"></script>
</head>

<body>

<div id="wrapper">

    <!-- Navigation -->
    <?php
    include("./partials/navbar_top.php");
    ?>

    <!-- Page Content -->
    <div id="page-wrapper">
        <div class="container-fluid productCatContainer">
            <div class="row">
                <div class="col-lg-12">
                    <div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Product Category
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs">
                                    <?php getAllCategory() ?>

                            </div>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
            </div>
            <!-- /.col-lg-12 -->
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
</div>
<!-- /#wrapper -->
    <!--<script type="application/javascript">
        $(document).ready(function(){
            $('button').click(function(){
                $.ajax({
                    url: './home.php?function=addToCart',
                    type: "POST",
                    data: {pid: this.id, functionName: "addToCart"},
                    success: function(data) {
                       alert("added to cart");
                    }
                });
            });
        });
    </script>-->
<?php
include("./partials/footer_js.php");
?>
</body>

</html>
