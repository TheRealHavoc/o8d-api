<?php
    $auth = Auth::authenticateByToken($db, 3);

    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if(!$userController->createNewUser())
        Response::error("Something went wrong",500);

    Response::success("New user created.");