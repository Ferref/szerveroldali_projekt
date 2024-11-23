<?php 

class ReviewModel extends DatabaseHandler {

    protected function getBookReviews($bookId) {
        $query = "SELECT v.id, f.nev, v.velemeny, v.datum, f.profilkep_url
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    WHERE v.konyv_id = :konyvid
                    ORDER BY v.datum DESC;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function insertBookReview($felhasznalo_id, $konyv_id, $velemeny) {
        $query="INSERT INTO velemenyek (felhasznalo_id, konyv_id, velemeny, datum) VALUES (:felhasznalo_id, :konyv_id, :velemeny, now())";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("felhasznalo_id",$felhasznalo_id, PDO::PARAM_INT);
        $stmt->bindValue("konyv_id",$konyv_id,PDO::PARAM_INT);
        $stmt->bindValue("velemeny",$velemeny,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function getReview($id) {
        $query="SELECT velemeny FROM velemenyek WHERE id=:id;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function isReviewExist($reviewId) {
        $query = "SELECT id FROM velemenyek WHERE id=:reviewId";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("reviewId",$reviewId,PDO::PARAM_INT); 
        $stmt->execute();
        if ($stmt->rowCount()!=0){
            return true;
        } else {
            return false;
        }
    }

    protected function updateReview($id, $velemeny) {
        $query="UPDATE velemenyek SET velemeny=:velemeny WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id,PDO::PARAM_INT);
        $stmt->bindValue("velemeny",$velemeny,PDO::PARAM_STR);
        return $stmt->execute();
    }

    protected function deleteReview($id) {
        $query= "DELETE FROM velemenyek WHERE id=:id";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("id",$id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    protected function getAllReviewInfo($page) {
        $query = "SELECT v.id, f.nev, k.cim, v.datum
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    JOIN konyvek k On k.id=v.konyv_id
                    LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getAllReviewInfoPageNumber() {
        $query = "SELECT COUNT(id) as oldalak_szama FROM velemenyek;";
        $stmt = $this->connect()->prepare($query);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getReviewInfoName($name,$page) {
        $query = "SELECT v.id, f.nev, k.cim, v.datum
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    JOIN konyvek k On k.id=v.konyv_id
                    WHERE f.nev LIKE :nev
                    LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getReviewInfoNamePageNumber($name) {
        $query = "SELECT COUNT(v.id) as oldalak_szama 
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    WHERE f.nev LIKE :nev;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getReviewInfoBook($book,$page) {
        $query = "SELECT v.id, f.nev, k.cim, v.datum
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    JOIN konyvek k On k.id=v.konyv_id
                    WHERE k.cim LIKE :book
                    LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("book",'%'.$book.'%',PDO::PARAM_STR); 
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getReviewInfoBookPageNumber($book) {
        $query = "SELECT COUNT(v.id) as oldalak_szama 
                    FROM velemenyek v
                    JOIN konyvek k ON k.id = v.konyv_id
                    WHERE k.cim LIKE :book;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("book",'%'.$book.'%',PDO::PARAM_STR); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    protected function getReviewInfoNameBook($name,$book,$page) {
        $query = "SELECT v.id, f.nev, k.cim, v.datum
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    JOIN konyvek k On k.id=v.konyv_id
                    WHERE f.nev LIKE :nev OR k.cim LIKE :book
                    LIMIT :page,10;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("book",'%'.$book.'%',PDO::PARAM_STR);
        $stmt->bindValue("page",$page,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getReviewInfoNameBookPageNumber($name,$book) {
        $query = "SELECT COUNT(v.id) as oldalak_szama 
                    FROM velemenyek v
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    JOIN konyvek k ON k.id = v.konyv_id
                    WHERE k.cim LIKE :book OR f.nev LIKE :nev;";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("nev",'%'.$name.'%',PDO::PARAM_STR); 
        $stmt->bindValue("book",'%'.$book.'%',PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


}