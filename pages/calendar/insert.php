<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    $auth = Auth::authenticateByToken($db, 3);

    if($calendarController->insertDate()) {
        Response::success("Resource added.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }