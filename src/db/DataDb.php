<?php
class DataDb {
    public $connection = null;

    public function __construct() {
        $server = "localhost:3306";
        $database = "tourism_management";
        $user = "root";
        $password = "";

        $this->connection = new mysqli($server, $user, $password, $database);

        // Check connection
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }
}

?>
