<?php
    /**
     * Database connection
     * 
     * Handles the connection with the database
     */
    require_once('app/core/database.php');

    $db = new Database();

    /**
     * Routing
     * 
     * Handles requesting routes
     */
    require_once('app/core/routing.php');

    /**
     * Requested page
     */
    $response = (isset($response) ? $response : 'pages/error.php');

    require_once($response);
?>