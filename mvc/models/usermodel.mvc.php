<?php 

class UserModel extends DatabaseHandler {
    
    protected function userExists($userNev) {
        $query = "SELECT nev FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        if ($stmt->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }

    protected function emailExists($userNev) {
        $query = "SELECT email FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        if ($stmt->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }

    protected function userPassword($userNev) {
        $query = "SELECT jelszo FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        $result=$stmt->fetch(PDO::FETCH_ASSOC);
        return $result['jelszo'];
    }

    protected function insertUser($nev, $email, $jelszo, $szerep) {
        $query="INSERT INTO felhasznalok (nev, email, jelszo, szerep, profilkep_url, regisztracios_datum) VALUES (:nev, :email, :jelszo, :szerep, '', now())";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("email",$email,PDO::PARAM_STR);
        $stmt->bindValue("jelszo",password_hash($jelszo, PASSWORD_BCRYPT),PDO::PARAM_STR);
        $stmt->bindValue("szerep",$szerep,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function getUserInfo($userNev) {
        $query = "SELECT nev, email, szerep, profilkep_url, regisztracios_datum FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getAllUserInfo($page) {
        $query = "SELECT id, nev, email, szerep FROM felhasznalok LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getAllUserInfoPageNumber() {
        $query = "SELECT COUNT(id) as oldalak_szama FROM felhasznalok;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}