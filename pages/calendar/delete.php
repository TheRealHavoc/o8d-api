<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    $auth = Auth::authenticateByToken($db, 3);

    if($calendarController->deleteDate()) {
        Response::success("Resource deleted.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }