<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    $auth = Auth::authenticateByToken($db);

    if(!$userController->signout($auth['id']))
        Response::error("Something went wrong",500);

Response::success("User signed out.");