<?php
class DatabaseHandler{


    protected function connect(){
        // Change these if needed
        try {
            $conn = new PDO("mysql:host=localhost;dbname=konyvajanlo;charset=utf8","root","");
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          } catch (PDOException $e){
            echo "<p class=\"error\">Adatbázis kapcsolódási hiba: {$e->getMessage()}</p>\n";
            die();
          }

        return $conn;
    }
}
