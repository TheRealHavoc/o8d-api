<?php
    class Database
    {
        private $host = '185.227.81.30';
        private $dbName = 'runecher_ouderavond';
        private $username = 'runecher_ouderavond';
        private $password = 'Eq1rgNmkJr';

        public function __construct()
        {
            $conn = null;

            try {
                $conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->dbName, $this->username, $this->password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e)
            {
                echo "Connection failed: " . $e->getMessage();
            }

            return $conn;
        }
    }
?>