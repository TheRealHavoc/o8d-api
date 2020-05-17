<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if($userController->createUser()) {
        Response::success("User created.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }