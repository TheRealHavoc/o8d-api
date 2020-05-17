<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    $auth = Auth::authenticateByToken($db);

    if($userController->signout($auth['id'])) {
        Response::success("User signed out.");
    } else {
        Response::error(
            "Something went wrong.",
            500
        );
    }
