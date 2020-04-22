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
    }
?>