<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if($userController->createNewUser())
        Response::success("New user created.");
