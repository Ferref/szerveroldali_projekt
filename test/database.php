<?php

class Database{
    private $servername = "localhost";
    private $username = "root";
    private $password = "";

    public function conn() {
        $conn = new mysqli($this->servername, $this->username, $this->password);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }
          echo "Connected successfully";
          return $conn;
    }
}

?>