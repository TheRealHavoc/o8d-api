<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    if($calendarController->insertDate()) {
        Response::success("Resource edited.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }