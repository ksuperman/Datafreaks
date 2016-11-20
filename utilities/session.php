<?php

    include 'Zebra_Session.php';

    function sessionWrapper($dbConnection) {

        $securityCode = 'sEcUr1tY_c0dE';

        $session = new Zebra_Session( $dbConnection, $securityCode );

        return $session;

    }

