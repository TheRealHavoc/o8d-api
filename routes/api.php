<?php
    /**
     * Register your routes here
     */

    $router->url('', 'pages/index.php');

    /**
     * Calendar
     */
    $router->url('calendar/insert', 'pages/calendar/insert.php');
    $router->url('calendar/delete', 'pages/calendar/delete.php');
    $router->url('calendar/edit', 'pages/calendar/edit.php');
?>