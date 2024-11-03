<?php
class AuthorModel extends DatabaseHandler
{

    // Iro informacioinak lekerese
    protected function getWriterInfo($writerId) {
        $query = "SELECT * FROM szerzok WHERE id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Iro konyveinek lekerese
    protected function getWriterBooks($writerId) {
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url 
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  WHERE ksz.szerzo_id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Iro konyveinek atlagos ertekelese
    protected function getWriterBooksAvgRating($writerId) {
        $query = "SELECT COUNT(ertekeles) AS ertekelesek_szama, AVG(e.ertekeles) as atlag_ertekeles
                  FROM ertekelesek e
                  JOIN konyv_szerzo ksz ON e.konyv_id = ksz.konyv_id
                  WHERE ksz.szerzo_id = :writerid";
        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerid",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    protected function getBookWriters($bookId){
        $query = "SELECT *
                  FROM szerzok
                  JOIN konyv_szerzo ON konyv_szerzo.szerzo_id = szerzok.id
                  JOIN konyvek ON konyvek.id = konyv_szerzo.konyv_id
                  WHERE konyvek.id = :konyvid;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("konyvid",$bookId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    protected function getWriterCategories($writerId) {
        $query = "SELECT DISTINCT nev
                  FROM kategoriak
                  JOIN konyv_kategoria ON konyv_kategoria.kategoria_id = kategoriak.id
                  JOIN konyv_szerzo ON konyv_szerzo.konyv_id = konyv_kategoria.konyv_id
                  WHERE konyv_szerzo.szerzo_id = :writerId;";

        $stmt = $this->connect()->prepare($query);
        $stmt->bindValue("writerId",$writerId,PDO::PARAM_INT); 
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

