<?php
    // $auth = Auth::authenticateByToken($db, 3);

    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    if(!$userController->uploadStudents())
        Response::error("Something went wrong",500);