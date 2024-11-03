<?php

require '../config/db.php';

class UserModel{
    private $db;

    public function __construct($dbConnection)
    {
        $this->db = $dbConnection;
    }

    // Felhasznalo osszes adatanak visszateritese
    public function getAllUserData(){
        $query = "SELECT * FROM felhasznalok;";

        $result=$this->db->query($query);
        return $result->fetch_assoc();
    }



}