<?php 

class ReviewModel extends DatabaseHandler {

    protected function getBookReviews($bookId) {
        $query = "SELECT v.id, f.nev, v.velemeny, v.datum
                    FROM velemenyek v
                    JOIN konyvek k ON k.id = v.konyv_id
                    JOIN felhasznalok f ON f.id = v.felhasznalo_id
                    WHERE k.id = :konyvid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    


}