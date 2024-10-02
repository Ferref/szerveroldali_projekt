<?php
class DatabaseHandler{

    // We dont want the users to access so make them to private
    private $servername;
    private $username;
    private $password;
    private $dbname;

    protected function connect(){
        // Change these if needed
        $this->servername = "localhost";
        $this->username = "root";
        $this->password = "";
        $this->dbname = "konyvajanlo";

        // You can use mysqli and PDO (PHP Data Objects), we use mysqli
        // https://www.w3schools.com/php/php_mysql_connect.asp
        // Connect to the database
        $conn = new mysqli(
            $this->servername,
            $this->username,
            $this->password,
            $this->dbname
        );

        return $conn;
    }
}

?>