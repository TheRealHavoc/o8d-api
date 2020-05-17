<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    $auth = Auth::authenticateByToken($db, 3);

    if($userController->createNewUser())
        Response::success("New user created.");
