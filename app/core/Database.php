<?php
    class Database
    {
        /**
         * Database constructor.
         */
        private $conn;

        public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DATABASE, SQL_USER, SQL_PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                Response::go(
                    ['error' => $e->getMessage()],
                    500
                );
            }
        }

        public function insertDate(){
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

            Response::success("Resource deleted.");
        }
    }
?>