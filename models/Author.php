<?php

require '../config/db.php';

class WriterModel
{
    use Model;

    // Iro informacioinak lekerese
    public function getWriterInfo($writerId) {
        $query = "SELECT id, nev, profilkep_url FROM szerzok WHERE id = :writerId";
        $stm = $this->connect()->prepare($query);
        $stm->bindParam("writerId", $writerId, PDO::PARAM_INT);
        $check = $stm->execute();
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
    }

    // Iro konyveinek lekerese
    public function getWriterBooks($writerId) {
        $query = "SELECT k.id, k.cim, k.leiras, k.boritokep_url 
                  FROM konyvek k
                  JOIN konyv_szerzo ksz ON k.id = ksz.konyv_id
                  WHERE ksz.szerzo_id = :writerId";
        $stm = $this->connect()->prepare($query);
        $stm->bindParam("writerId", $writerId, PDO::PARAM_INT);
        $check = $stm->execute();
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_OBJ);
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
    }

    // Iro konyveinek atlagos ertekelese
    public function getWriterBooksAvgRating($writerId) {
        $query = "SELECT AVG(e.ertekeles) as atlag_ertekeles
                  FROM ertekelesek e
                  JOIN konyv_szerzo ksz ON e.konyv_id = ksz.konyv_id
                  WHERE ksz.szerzo_id = ?";
        $stm = $this->connect()->prepare($query);
        $stm->bindParam("writerId", $writerId, PDO::PARAM_INT);
        $check = $stm->execute();
        if($check)
        {
            $result = $stm->fetchAll(PDO::FETCH_ASSOC)["atlag_ertekeles"];
            if(is_array($result) && count($result))
            {
                return $result;
            }
        }
    }
}
?>
