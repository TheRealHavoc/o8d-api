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
    }
?>