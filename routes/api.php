<?php
    /**
     * Register your routes here
     */

    $router->url('', 'pages/index.php');

    /**
     * Authentication
     */
    $router->url('signin', 'pages/signin.php');
    $router->url('signout', 'pages/signout.php');

    /**
     * Calendar
     */
    $router->url('calendar/insert', 'pages/calendar/insert.php');
    $router->url('calendar/delete', 'pages/calendar/delete.php');
    $router->url('calendar/edit', 'pages/calendar/edit.php');

    /**
     * Admin
     */
    $router->url('admin/createnewuser', 'pages/admin/createnewuser.php');
?>