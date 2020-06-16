<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if(!$auth = Auth::authenticateByToken($db))
        Response::error("Nothing found",404);

    if(!$userController->resetPassword($auth['token']))
        Response::error("Something went wrong",500);

Response::success("User password changed.");