<?php
    class CalendarController
    {
        private $conn;

        public function __construct($db)
        {
            $this->conn = $db->conn;
        }

        public function insertDate(){
            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE student_id = ?");

            if(!$sql->execute(array($_POST['student_id'])))
                Response::error("Something went wrong.", 500);

            if($res = $sql->fetch())
                Response::error("Student is alreayd planned in.", 404);


            $sql = $this->conn->prepare("INSERT INTO calendar (student_id, date, time, room) VALUES (?, ?, ?, ?)");

            if($sql->execute(array($_POST['student_id'], $_POST['date'], $_POST['time'],  $_POST['room']))){
                return true;
            } else {
                return false;
            }
        }

        public function deleteDate(){
            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            if(!$res = $sql->fetch())
                Response::error("Could not find resource.", 404);

            $sql = $this->conn->prepare("DELETE FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            return true;
        }

        public function editDate(){
            $sql = $this->conn->prepare("SELECT * FROM calendar WHERE id = ?");

            if(!$sql->execute(array($_POST['id'])))
                Response::error("Something went wrong.", 500);

            if(!$res = $sql->fetch())
                Response::error("Could not find resource.", 404);

            $sql = $this->conn->prepare("UPDATE calendar SET date = ?, time = ?, room = ? WHERE id = ?");

            if(!$sql->execute(array($_POST['date'], $_POST['time'], $_POST['room'], $_POST['id'])))
                Response::error("Something went wrong.", 500);

            Response::success("Resource updated.");
        }
    }

    $calendarController = new CalendarController($db);