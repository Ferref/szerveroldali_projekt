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


}