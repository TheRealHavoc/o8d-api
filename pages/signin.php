<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if(!$user = $userController->signin())
        Response::error("Something went wrong",500);

    Response::success(["user" => $user]);