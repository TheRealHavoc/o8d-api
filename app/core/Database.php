<?php
    class Database
    {
        /**
         * Database constructor.
         */
        public $conn;

        public function __construct()
        {
            try {
                $this->conn = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DATABASE, SQL_USER, SQL_PASSWORD);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                Response::error(
                    ['error' => $e->getMessage()],
                    500
                );
            }
        }
    }
?>