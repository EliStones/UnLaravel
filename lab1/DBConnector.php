<?php
    //Define means to create constants
    define('DB_SERVER', 'localhost');
    define('DB_NAME', 'btc3205');
    define('DB_USER', 'root');
    define('DB_PASS', '');
    

    class DBConnector{
        public $conn;

        function __construct()
        {
            $this->conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS) or die("Error: ".mysqli_error($this->conn));
            mysqli_select_db($this->conn,DB_NAME);
        }

        public function closeDatabase()
        {
            mysqli_close($this->conn);
        }
    }
?>