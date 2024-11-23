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

    protected function emailExists($userEmail) {
        $query = "SELECT email FROM felhasznalok WHERE email = :userEmail";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userEmail",$userEmail,PDO::PARAM_STR); 
        $stmt->execute();
        if ($stmt->rowCount()>0){
            return true;
        } else {
            return false;
        }
    }

    protected function idExists($userId) {
        $query = "SELECT id FROM felhasznalok WHERE id = :userId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userId",$userId,PDO::PARAM_STR); 
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
        $query = "SELECT id, nev, email, szerep, profilkep_url, regisztracios_datum FROM felhasznalok WHERE nev = :userNev";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("userNev",$userNev,PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getUserInfoById($userId) {
        $query = "SELECT id, nev, email, profilkep_url FROM felhasznalok WHERE id = :id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$userId,PDO::PARAM_INT); 
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

    protected function getUserInfoName($name,$page) {
        $query = "SELECT id, nev, email, szerep FROM felhasznalok WHERE nev LIKE :nev LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getUserInfoNamePageNumber($name) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM felhasznalok WHERE nev LIKE :nev;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getUserInfoEmail($email,$page) {
        $query = "SELECT id, nev, email, szerep FROM felhasznalok WHERE email LIKE :email LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("email",'%'.$email.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getUserInfoEmailPageNumber($email) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM felhasznalok WHERE email LIKE :email;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("email",'%'.$email.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    protected function getUserInfoNameEmail($name,$email,$page) {
        $query = "SELECT id, nev, email, szerep FROM felhasznalok WHERE nev LIKE :nev OR email LIKE :email LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("email",'%'.$email.'%',PDO::PARAM_STR);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getUserInfoNameEmailPageNumber($name,$email) {
        $query = "SELECT COUNT(id) as oldalak_szama FROM felhasznalok WHERE nev LIKE :nev OR email LIKE :email;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("email",'%'.$email.'%',PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function updateUserWithoutPassword($id, $nev, $email, $profilkep_url) {
        $query="UPDATE felhasznalok SET nev=:nev, email=:email, profilkep_url=:profilkep_url WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("email",$email,PDO::PARAM_STR);
        $stmt->bindValue("profilkep_url",$profilkep_url,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function updateUserWithPassword($id, $nev, $email, $jelszo, $profilkep_url) {
        $query="UPDATE felhasznalok SET nev=:nev, email=:email, jelszo=:jelszo, profilkep_url=:profilkep_url WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        $stmt->bindValue("nev",$nev,PDO::PARAM_STR);
        $stmt->bindValue("email",$email,PDO::PARAM_STR);
        $stmt->bindValue("jelszo",password_hash($jelszo, PASSWORD_BCRYPT),PDO::PARAM_STR);
        $stmt->bindValue("profilkep_url",$profilkep_url,PDO::PARAM_STR);  
        return $stmt->execute();
    }

    protected function deleteUser($id) {
        $query= "DELETE FROM felhasznalok WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

}