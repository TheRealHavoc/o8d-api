<?php
    /**
     * Database connection
     * 
     * Handles the connection with the database
     */
    require_once ('app/core/database.php');

    $db = new Database();

    /**
     * Routing
     * 
     * Handles requesting routes
     */
    require_once('app/core/router.php');

    /**
     * Handle request
     */
    require_once('app/core/request.php');
?>