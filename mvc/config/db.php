<?php
$dbConnection = new mysqli('localhost', 'root', '', 'konyvajanlo');

if ($dbConnection->connect_error) {
    die("Connection failed: " . $dbConnection->connect_error);
}
?>
