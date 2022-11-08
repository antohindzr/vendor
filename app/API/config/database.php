<?php
    class Database {
        private string $host = "127.0.0.1";
        private string $database_name = "vendorDB";
        private string $username = "root";
        private string $password = "";
        public $conn;
        public function getConnection(): ?PDO
        {
            $this->conn = null;
            try{
                $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->database_name, $this->username, $this->password);
                $this->conn->exec("set names utf8");
            }catch(PDOException $exception){
                echo "Database could not be connected: " . $exception->getMessage();
            }
            return $this->conn;
        }
    }
?>
