<?php

    include "../../utilities/global_variables.php"
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
        logoutUserAndClearSession()
    ?>
