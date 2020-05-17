<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if($user = $userController->signin()) {
        Response::success(["user" => $user]);
    } else {
        Response::error(
            "Something went wrong.",
            500
        );
    }

