<?php
    /**
     * Include controllers
     */
    require_once('app/controllers/CalendarController.php');

    if($calendarController->editDate()) {
        Response::success("Resource edited.");
    } else {
        Response::error(
            "Something went wrong",
            404
        );
    }