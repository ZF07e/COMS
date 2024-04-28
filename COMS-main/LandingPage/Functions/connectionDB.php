<?php
    class Database
    {
        private $hostname = "localhost";
        private $username = "root";
        private $password = "";
        private $dbName = "coms";
    
        public function __construct()
        {
            $this->conn = new mysqli($this->hostname, 
                                         $this->username, 
                                         $this->password, 
                                         $this->dbName);
    
                
            if($this->conn->connect_error)
            {
                die("Connection faild". $this->conn->connect_error);
            }
        }
    
        public function getConnection()
        {
            return $this->conn;
        }
    }
?>