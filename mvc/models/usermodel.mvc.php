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

    protected function insertUser($nev, $email, $jelszo) {
        $query="INSERT INTO felhasznalok (nev, email, jelszo, profilkep_url, regisztracios_datum) VALUES (:nev, :email, :jelszo, '', now())";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("email",$email,PDO::PARAM_STR);
        $stmt->bindValue("jelszo",password_hash($jelszo, PASSWORD_BCRYPT),PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function getUserInfo($userNev) {
        $query = "SELECT nev, email, profilkep_url, regisztracios_datum FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}