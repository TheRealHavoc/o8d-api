<?php
    class Database
    {
        public function __construct()
        {
            $conn = null;

            try {
                $conn = new PDO("mysql:host=" . SQL_HOST . ";dbname=" . SQL_DATABASE, SQL_USER, SQL_PASSWORD);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                Response::go(
                    ['error' => $e->getMessage()],
                    500
                );
            }

            return $conn;
        }
    }
?>