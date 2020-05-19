<?php
    $auth = Auth::authenticateByToken($db, 3);

    /**
     * Include controllers
     */
    require_once('app/controllers/UserController.php');

    $role = null;

    if(isset($_GET['role']))
        $role = $_GET['role'];

    if(!$userData = $userController->indexAllUsers($role))
        Response::error("Something went wrong",500);

    Response::success($userData);