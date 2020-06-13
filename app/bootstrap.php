<?php
    /**
     * Includes config file
     */
    require_once('_config/config.php');

    /**
     * Include helpers
     */
    require_once('app/helpers/Auth.php');
    require_once('app/helpers/Generate.php');
    require_once('app/helpers/Response.php');
    require_once('app/helpers/Token.php');

    /**
     * Database connection
     * 
     * Handles the connection with the database
     */
    require_once('app/core/Database.php');
    $db = new Database();

    /**
     * Routing
     * 
     * Handles requesting routes
     */
    require_once('app/core/Router.php');
    $router = new Router();

    require_once('routes/api.php');

    /**
     * Handle request
     */
    require_once('app/core/request.php');
?>